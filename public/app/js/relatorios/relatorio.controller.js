$().ready(inicializar);

function inicializar() {
    let dados = new FormData($("#formEstatisticas")[0]);
    dados.append("ajax", true);

    axios.interceptors.request.use((config) => {
        iziToast.info({
            id: "toast-get-grafico",
            title: 'Buscando posts',
            position: 'topRight',
            theme: "light",
            timeout: 0,
            progressBar: false,
            close: false,
            layout: 2
        });

        return config;
    });

    axios.interceptors.response.use((response) => {
        iziToast.hide({}, $(".iziToast")[0]);

        return response;
    });

    axios.post($("head").data("info") + "relatorios/getEstatisticas", dados)
            .then((response) => {
                if (response.data.resultado) {
                    renderizarGráficos(response.data);
                } else {
                    if (response.data.sessaoExpirada) {
                        Swal.fire({
                            type: 'info',
                            title: 'Atenção',
                            text: "Sua sessão expirou"
                        }).then(() => {
                            location.href = $("head").data("info");
                        });
                    } else {
                        Swal.fire({
                            type: 'warning',
                            title: 'Atenção',
                            text: response.data.msg
                        });
                    }
                }
            }).catch((response) => {
        Swal.fire({
            type: 'error',
            title: 'Atenção',
            text: getMensagemErro(response.status)
        });
    });
}

function renderizarGráficos(data) {
    var ctxFacebook = document.getElementById('graficoFacebook');
    var ctxInstagram = document.getElementById('graficoInstagram');

    if (data.facebook) {
        let labels = [];
        let curtidas = [];
        let alcance = [];
        let seguidores = [];

        $.each(data.graficos.facebook, (key, dados) => {
            labels.push(dados.data);
            curtidas.push(dados.curtidas);
            alcance.push(dados.alcance);
            seguidores.push(dados.seguidores);
        });

        var chartFacebook = new Chart(ctxFacebook, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Curtidas',
                        data: curtidas,
                        backgroundColor: ["#6060b1", 'rgba(255, 99, 132, 0.2)'],
                        borderColor: ['#6060b1']
                    },
                    {
                        label: 'Alcance',
                        data: alcance,
                        backgroundColor: ['#269758', 'rgba(102, 123, 187, 0.2)'
                        ],
                        borderColor: ['#269758']
                    },
                    {
                        label: 'Seguidores',
                        data: seguidores,
                        borderColor: ['#efdd16']
                    }
                ]
            }
        });
    }

    if (data.instagram) {
        let labels = [];
        let curtidas = [];
        let alcance = [];
        let seguidores = [];

        $.each(data.graficos.instagram, (key, dados) => {
            labels.push(dados.data);
            curtidas.push(dados.curtidas);
            alcance.push(dados.alcance);
            seguidores.push(dados.seguidores);
        });

        var chartInstagram = new Chart(ctxInstagram, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Curtidas',
                        data: curtidas,
                        backgroundColor: ["#6060b1", 'rgba(255, 99, 132, 0.2)'],
                        borderColor: ['#6060b1']
                    },
                    {
                        label: 'Alcance',
                        data: alcance,
                        backgroundColor: ['#269758', 'rgba(102, 123, 187, 0.2)'
                        ],
                        borderColor: ['#269758']
                    },
                    {
                        label: 'Seguidores',
                        data: seguidores,
                        borderColor: ['#efdd16']
                    }
                ]
            }
        });
    }
}