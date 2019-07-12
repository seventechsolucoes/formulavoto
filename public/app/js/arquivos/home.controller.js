$().ready(inicializar);

$("#tabelaUploadsContent").on("click", ".btn-visualizar", function () {
    let dados = new FormData($("#formBuscar")[0]);
    dados.append("ajax", true);
    dados.append("id", $(this).data("id"));

    $('#modalVisualizarPost').modal('show');

    axios.interceptors.request.use((request) => {
        $("#modalVisualizarPostLoader").html(`<div class="alert alert-primary" role="alert">
                                                <i class="fas fa-circle-notch fa-spin"></i> Buscar post
                                            </div>`);

        return request;
    });

    axios.interceptors.response.use((response) => {
        $("#modalVisualizarPostLoader").empty();

        return response;
    });

    axios.post($("head").data("info") + "ups/getPost", dados).then((response) => {
        if (response.data.resultado) {
            if (response.data.post.statusImagem != null) {
                $("#modalVisualizarPostLink").attr("target", "_blank");
                $("#modalVisualizarPostLink").attr("href", $("head").data("info") + `public/app/img/arquivos/${response.data.post.arquivo}`);
                $("#modalVisualizarPostImagem").attr("src", $("head").data("info") + `public/app/img/arquivos/${response.data.post.arquivo}`);
            }
            $("#evento").val(response.data.post.evento);
            $("#evento").val(response.data.post.evento);
            $("#local").val(response.data.post.local);
            $("#data").val(moment(response.data.post.data).format("DD/MM/YYYY"));
            $("#assunto").val(response.data.post.assunto);
            $("#publicoPresente").text(response.data.post.publicoPresente);
            $("#autoridades").text(response.data.post.autoridades);
            $("#observacoes").text(response.data.post.observacoes);
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
    }).catch((error) => {
        Swal.fire({
            type: 'error',
            title: 'Atenção',
            text: getMensagemErro(error.status)
        });
    });
});

$("#modalVisualizarPost").on("hide.bs.modal", () => {
    $("#modalVisualizarPostLink").removeAttr("target");
    $("#modalVisualizarPostLink").attr("href", "#");
    $("#modalVisualizarPostImagem").attr("src", $("head").data("info") + `public/app/img/sistema/sem-foto-post.png`);
    $("#formVisualizarPost").trigger("reset");
});

function inicializar() {
    let dados = new FormData($("#formBuscar")[0]);
    dados.append("ajax", true);

    axios.interceptors.request.use((config) => {
        iziToast.info({
            id: "toast-get-posts",
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
        iziToast.hide({}, $("#toast-get-posts")[0]);

        return response;
    });

    axios.post($("head").data("info") + "ups/get", dados).then((response) => {
        if (response.data.resultado) {
            renderizarTabelaPosts(response.data.posts);
            inicializarDataTable();
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
                    title: 'aAtenção',
                    text: response.data.msg
                });
            }
        }
    }).catch((error) => {
        Swal.fire({
            type: 'error',
            title: 'Atenção',
            text: getMensagemErro(error.status)
        });
    });
}

function inicializarDataTable() {
    $('#tabelaUploads').DataTable({
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        }
    });
}

function renderizarTabelaPosts(posts) {
    $("#tabelaUploadsContent").empty();

    if (posts.length > 0) {
        $.each(posts, (key, post) => {
            $("#tabelaUploadsContent").append(`<tr>
                                            <td style="vertical-align:middle" class="text-center">${post.id}</td>
                                            <td style="vertical-align:middle">${post.evento} - ${post.local}</td>
                                            <td style="vertical-align:middle" class="text-center">${moment(post.data).format("DD/MM/YYYY")}</td>
                                            <td style="vertical-align:middle" class="text-center">
                                                <span class="${post.status == "aguardando" ? 'badge badge-warning' : 'badge badge-success' }">
                                                    ${ucfirst(post.status)}
                                                </span>
                                            </td>
                                            <td style="vertical-align:middle" class="text-center">
                                                <span class="${post.statusImagem == "disponível" ? 'badge badge-success' : 'badge badge-danger'}">
                                                    ${ucfirst(post.statusImagem)}
                                                </span>
                                            </td>
                                            <td style="vertical-align:middle" class="text-center">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-primary btn-sm btn-visualizar" data-id="${post.id}" title="Visualizar POST"><i class="fas fa-eye"></i></button>
                                                </div>
                                            </td>
                                        </tr>`);
        });
    } else {
        $("#tabelaUploadsContent").html(`<tr>
                                    <td colspan="6" class="tabela-vazia">Nenhum post</td>
                                </tr>`);
    }
}