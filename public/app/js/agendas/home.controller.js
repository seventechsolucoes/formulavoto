$().ready(() => {
    inicializar();
});

$("#formBuscar").validate({
    rules: {
        titulo: {minlength: 3},
    },
    messages: {
        titulo: {minlength: "Digite pelo menos 3 caracteres"},
    },
    errorClass: 'is-invalid',
    validClass: "is-valid",
    errorElement: "small",
    errorPlacement: function (error, element) {
        $(element)
                .closest(".form-group")
                .find(".invalid-feedback")
                .append(error);
    },
    submitHandler: function () {
        let dados = new FormData($("#formBuscar")[0]);
        dados.append("ajax", true);

        axios.interceptors.request.use((config) => {
            $("#formBuscarBtnBuscar")
                    .html("Buscando")
                    .attr("disabled", "disabled");

            return config;
        });

        axios.interceptors.response.use((response) => {
            $("#formBuscarBtnBuscar")
                    .html("Buscar")
                    .removeAttr("disabled");

            return response;
        });

        axios.post($("head").data("info") + "agendas/filtrar", dados).then((response) => {
            if (response.data.resultado) {
                renderizarCardsEventos(response.data.eventos);
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
});

$("#cards-eventos").on("click", ".btn-status", function () {
    let dados = new FormData($("#formBuscar")[0]);
    dados.append("ajax", true);
    dados.append("id", $(this).data("id"));
    dados.append("status", $(this).data("status"));

    axios.interceptors.request.use((config) => {
        if (config.url.endsWith('atualizarStatus')) {
            iziToast.info({
                class: "toast-atualizando-status",
                title: 'Atualizando status',
                position: 'topRight',
                theme: "light",
                timeout: 0,
                progressBar: false,
                close: false,
                layout: 2
            });
        }

        return config;
    });

    axios.interceptors.response.use((response) => {
        if (response.config.url.endsWith('atualizarStatus')) {
            iziToast.hide({}, $(".toast-atualizando-status")[0]);
        }

        return response;
    });

    axios.post($("head").data("info") + "agendas/atualizarStatus", dados).then((response) => {
        if (response.data.resultado) {
            renderizarCardsEventos(response.data.eventos);
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
});

$("#cards-eventos").on("click", ".btn-excluir", function () {
    Swal.fire({
        type: 'warning',
        title: 'Atenção',
        text: "Deseja realmente excluir esse evento ?",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        confirmButtonText: 'Excluir',
        cancelButtonColor: '#3085d6',
        cancelButtonText: 'Cancelar',
        focusConfirm: false,
        focusCancel: true
    }).then((result) => {
        if (result.value) {
            let dados = new FormData($("#formBuscar")[0]);
            dados.append("ajax", true);
            dados.append("id", $(this).data("id"));

            axios.interceptors.request.use((config) => {
                if (config.url.endsWith('excluir')) {
                    iziToast.info({
                        class: "toast-excluindo-evento",
                        title: 'Excluindo evento',
                        position: 'topRight',
                        theme: "light",
                        timeout: 0,
                        progressBar: false,
                        close: false,
                        layout: 2
                    });
                }

                return config;
            });

            axios.interceptors.response.use((response) => {
                if (response.config.url.endsWith('excluir')) {
                    iziToast.hide({}, $(".toast-excluindo-evento")[0]);
                }

                return response;
            });

            axios.post($("head").data("info") + "agendas/excluir", dados).then((response) => {
                if (response.data.resultado) {
                    renderizarCardsEventos(response.data.eventos);
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
    });
});

function inicializar() {
    let dados = new FormData($("#formBuscar")[0]);
    dados.append("ajax", true);

    axios.interceptors.request.use((config) => {
        if (config.url.endsWith('get')) {
            iziToast.info({
                class: "toast-get-eventos",
                title: 'Buscando eventos',
                position: 'topRight',
                theme: "light",
                timeout: 0,
                progressBar: false,
                close: false,
                layout: 2
            });
        }

        return config;
    });

    axios.interceptors.response.use((response) => {
        if (response.config.url.endsWith('get')) {
            iziToast.hide({}, $(".toast-get-eventos")[0]);
        }

        return response;
    });

    axios.post($("head").data("info") + "agendas/get", dados).then((response) => {
        if (response.data.resultado) {
            renderizarCardsEventos(response.data.eventos);
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

function renderizarCardsEventos(eventos) {
    $("#cards-eventos").empty();

    if (eventos.length > 0) {
        $.each(eventos, (key, evento) => {
            if (evento.status != "excluído") {
                $("#cards-eventos").append(`<div class="col-12 col-md-6 col-sm-6 d-flex mb-4">
                                                    <div class="card" style="width:100%">
                                                        <div class="card-header">
                                                            <span title="${evento.titulo}">${getTituloEvento(evento.titulo)}</span>
                                                        </div>
                                                        <div class="card-body">
                                                            <p class="card-text">
                                                                <i class="fas fa-calendar-day"></i> <strong>${moment(evento.data).format("DD/MM/YYYY")}</strong><br>
                                                                <i class="far fa-clock"></i> ${evento.hora != null ? evento.hora : "--:--"}<br>
                                                                <i class="far fa-calendar-check"></i> <span class="badge ${getBadgeEvento(evento.status)}">${ucfirst(evento.status)}</span>
                                                            </p>
                                                        </div>
                                                        <div class="card-footer">
                                                            <a href="${$("head").data("info") + `agenda/${evento.id}`}" class="btn btn-sm btn-primary btn-editar ${desabilitar(evento.status, true)}" title="Atualizar evento"><i class="far fa-edit"></i></a>
                                                            <button type="button" class="btn btn-sm btn-success btn-status" ${desabilitar(evento.status, false)} data-id="${evento.id}" data-status="concluído" title="Evento concluído"><i class="far fa-thumbs-up"></i></button>
                                                            <button type="button" class="btn btn-sm btn-warning btn-status" ${desabilitar(evento.status, false)} data-id="${evento.id}" data-status="cancelado" title="Evento cancelado"><i class="far fa-thumbs-down"></i></button>
                                                            <button type="button" class="btn btn-sm btn-danger btn-excluir" ${desabilitar(evento.status, false)} title="Excluir evento"  data-id="${evento.id}"><i class="far fa-trash-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>`);
            }
        });
    } else {
        $("#cards-eventos").html();
    }
}

function getBadgeEvento(status) {
    switch (status) {
        case "aguardando":
            return 'badge-info';
        case "concluído":
            return 'badge-success';
        case "atrasado":
            return 'badge-Warning';
        case "cancelado":
            return 'badge-danger';
        default:
            return 'badge-secondary';
    }
}

function desabilitar(status, link) {
    switch (status) {
        case "aguardando":
            return "";
        case "concluído":
            if (link) {
                return "disabled";
            } else {
                return `disabled="disabled"`;
            }
        case "atrasado":
            return "";
        case "cancelado":
            if (link) {
                return "disabled";
            } else {
                return `disabled="disabled"`;
            }
        default:
            return 'badge-secondary';
    }
}

function getTituloEvento(titulo) {
    if (titulo.length <= 27) {
        return titulo;
    } else {
        if (titulo.length > 27 && titulo.length < 30) {
            return titulo;
        } else {
            return titulo.substr(0, 26) + "...";
        }
    }
}