$("#formAtualizar").validate({
    rules: {
        nome: {required: true},
        email: {
            required: true,
            email: true
        },
        estado: {required: true},
        cidade: {required: true}
    },
    messages: {
        nome: {required: "Campo obrigatório"},
        email: {
            required: "Campo obrigatório",
            email: "Digite um e-mail válido"
        },
        estado: {required: "Campo obrigatório"},
        cidade: {required: "Campo obrigatório"}
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
        submitFormDadosPessoais();
    }
});

$("#formAtualizarDadosAcesso").validate({
    rules: {
        usuario: {
            required: true,
            minlength: 6
        },
        senha: {
            required: true,
            minlength: 6
        }
    },
    messages: {
        usuario: {
            required: "Campo obrigatório",
            minlength: "Digite pelo menos 6 caracteres"
        },
        senha: {
            required: "Campo obrigatório",
            minlength: "Digite pelo menos 6 caracteres"
        }
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
        submitFormDadosAcesso();
    }
});

$("#foto").on("change", async function () {
    let dados = new FormData($("#formAtualizar")[0]);
    dados.append("ajax", true);
    let toast = $("#toast-atualiza-foto-perfil")[0];

    console.log(toast !== undefined);
    toast !== undefined ? iziToast.hide({}, toast) : null;

    iziToast.info({
        id: "toast-atualiza-foto-perfil",
        title: 'Atualizando foto de perfil',
        position: 'topRight',
        theme: "light",
        timeout: 0,
        progressBar: false,
        close: false,
        layout: 2
    });

    try {
        let response = await axios.post($("head").data("info") + "perfil/atualizarFotoPerfil", dados);
        if (response.status == 200 && response.data.resultado) {
            Swal.fire({
                type: 'success',
                title: 'Sucesso',
                text: response.data.msg
            }).then(() => {
                $("#perfil-foto-foto").attr("src", $("head").data("info") + `public/app/img/perfis/${response.data.filename}`);
                $("#foto-img").attr("src", $("head").data("info") + `public/app/img/perfis/${response.data.filename}`);
            });
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

    iziToast.hide({}, $("#toast-atualiza-foto-perfil")[0]);
});

async function submitFormDadosPessoais() {
    let dados = new FormData($("#formAtualizar")[0]);
    dados.append("ajax", true);

    $("#formAtualizarBtnAtualizar")
            .html(`<i class="fas fa-circle-notch fa-spin"></i>`)
            .attr("disabled", "disabled");

    try {
        let response = await axios.post($("head").data("info") + "perfil/atualizarDadosPessoais", dados);
        if (response.status == 200 && response.data.resultado) {
            Swal.fire({
                type: 'success',
                title: 'Sucesso',
                text: response.data.msg
            }).then(() => {
                location.href = $("head").data("info") + "dashboard";
            });
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

    $("#formAtualizarBtnAtualizar")
            .html(`Atualizar`)
            .removeAttr("disabled");
}

async function submitFormDadosAcesso() {
    let dados = new FormData($("#formAtualizarDadosAcesso")[0]);
    dados.append("ajax", true);

    $("#formAtualizarDadosAcessoBtnAtualizar")
            .html(`<i class="fas fa-circle-notch fa-spin"></i>`)
            .attr("disabled", "disabled");

    try {
        let response = await axios.post($("head").data("info") + "perfil/atualizarDadosAcesso", dados);
        if (response.status == 200 && response.data.resultado) {
            Swal.fire({
                type: 'success',
                title: 'Sucesso',
                text: response.data.msg
            }).then(() => {
                $("#formAtualizarDadosAcesso").trigger("reset");
                $("#modalDadosAcesso").modal("hide");
            });
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

    $("#formAtualizarDadosAcessoBtnAtualizar")
            .html(`Atualizar`)
            .removeAttr("disabled");
}