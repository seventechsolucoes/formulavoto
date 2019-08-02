$("#estado").on("change", async function () {
    if ($(this).val() !== "") {
        let toast = $("#toast-loader-cidades")[0];

        let dados = new FormData($("#formAtualizar")[0]);
        dados.append("ajax", true);
        dados.append("idEstado", $(this).val());

        toast !== undefined ? iziToast.hide({}, toast) : null;

        iziToast.info({
            id: `toast-loader-cidades`,
            title: 'Processando',
            message: `Buscando cidades`,
            position: 'topRight',
            theme: "light",
            timeout: 0,
            progressBar: false,
            close: false,
            layout: 2
        });

        try {
            let response = await axios.post($("head").data("info") + "support/getCidadesByEstado", dados);

            if (response.status == 200 && response.data.resultado) {
                renderizarSelectCidades(response.data.cidades);
            } else {
                renderizarSelectCidades([]);
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
                        type: 'info',
                        title: 'Atenção',
                        text: response.data.msg
                    });
                }
            }
        } catch (error) {
            if (error.response) {
                Swal.fire({
                    type: 'error',
                    title: 'Atenção',
                    text: getMensagemErro(error.response.status)
                });
            } else if (error.request) {
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Atenção',
                    text: "Falha na requisição"
                });
            }
        }

        iziToast.hide({}, $("#toast-loader-cidades")[0]);
    } else {
        renderizarSelectCidades([]);
    }
});

function renderizarSelectCidades(cidades) {
    $("#cidade").html(`<option value="">--</option>`);

    if (cidades.length > 0) {
        $.each(cidades, (key, cidade) => {
            $("#cidade").append(`<option value="${cidade.id}">${cidade.cidade}</option>`);
        });
    }
}