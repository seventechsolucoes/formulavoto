$().ready(() => {
    $("#usuario").focus();
    if (window.localStorage.getItem("fv-lembrar")) {
        $("#formLoginCheckboxLembrar").prop("checked", true);
        $("#usuario").val(window.localStorage.getItem("fv-usuario"));
        $("#senha").val(window.localStorage.getItem("fv-senha"));
    }
});

$("#formLogin").validate({
    rules: {
        usuario: {required: true},
        senha: {required: true}
    },
    messages: {
        usuario: {required: "Campo obrigatório"},
        senha: {required: "Campo obrigatório"}
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
        let dados = new FormData($("#formLogin")[0]);
        dados.append("ajax", true);

        $("#formLoginBtnEntrar")
                .html(`<i class="fas fa-circle-notch fa-spin"></i>`)
                .attr("disabled", "disabled");

        fetch($("head").data("info") + "auth/login/autenticar", {
            method: "post",
            body: dados
        }).then((response) => {
            $("#formLoginBtnEntrar")
                    .html(`Entrar`)
                    .removeAttr("disabled");
            if (response.status == 200) {
                return response.json();
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Atenção',
                    text: getMensagemErro(response.status)
                });
            }
        }).then((data) => {
            lembrar($("#formLoginCheckboxLembrar"));
            if (data.resultado) {
                if (data.returnUrl) {
                    location.href = $("head").data("info") + data.returnUrl;
                } else {
                    location.href = $("head").data("info") + "dashboard";
                }
            } else {
                Swal.fire({
                    type: 'warning',
                    title: 'Atenção',
                    text: data.msg
                });
            }
        }).catch(() => {
            Swal.fire({
                type: 'error',
                title: 'Atenção',
                text: "Não foi possível processar a sua requisição"
            });
        });
    }
});

$("#formRecuperarSenha").validate({
    rules: {
        modalEsqueciSenhaUsuario: {
            required: true,
            email: true
        }
    },
    messages: {
        modalEsqueciSenhaUsuario: {
            required: "Campo obrigatório",
            email: "Digite um usuário válido"
        }
    },
    validClass: "has-success",
    errorClass: "text-danger",
    errorElement: 'small',
    errorPlacement: function (error, element) {
        element.closest('div.form-group').append(error);
    },
    highlight: function (element, errorClass) {
        $(element)
                .closest('div.form-group')
                .addClass("has-error");
    },
    unhighlight: function (element, errorClass) {
        $(element)
                .closest('div.form-group')
                .removeClass("has-error");
    },
    success: function (element) {
        element
                .closest('div.form-group')
                .addClass("has-success");
    },
    submitHandler: function () {
        var dados = new FormData($("#formRecuperarSenha")[0]);
        dados.append("ajax", true);
        dados.append("usuario", $("#modalEsqueciSenhaUsuario").val());

        $.ajax({
            type: 'POST',
            url: $("head").data("info") + "login/recuperarSenha",
            data: dados,
            dataType: 'JSON',
            processData: false,
            contentType: false,
            beforeSend: function () {
                $("#formRecuperarSenhaBtnRecuperar")
                        .html(`<i class="fas fa-circle-notch fa-spin"></i>`)
                        .attr("disabled", "disabled");
            }
        }).done(function (r) {
            if (r.resultado) {
                swal({
                    title: "Sucesso",
                    icon: "success",
                    text: r.msg
                }).then(() => {
                    $("#formRecuperarSenha").trigger("reset");
                    $("#modalEsqueciSenha").modal("hide");
                });
            } else {
                swal({
                    title: "Atenção",
                    icon: "warning",
                    text: r.msg
                });
            }
        }).fail(function (request) {
            swal({
                title: "Falha inesperada",
                icon: "error",
                text: getMenssagemErro(request.status)
            });
        }).always(function () {
            $("#formRecuperarSenhaBtnRecuperar")
                    .html(`Recuperar`)
                    .removeAttr("disabled");
        });
    }
});

$("#formLoginCheckboxLembrar").click(function () {
    lembrar($(this));
});

function lembrar(checkbox) {
    if (checkbox.is(":checked")) {
        window.localStorage.setItem("fv-lembrar", true);
        if ($("#usuario").val() != "") {
            window.localStorage.setItem("fv-usuario", $("#usuario").val());
        }
        if ($("#senha").val() != "") {
            window.localStorage.setItem("fv-senha", $("#senha").val());
        }
    } else {
        window.localStorage.removeItem('fv-lembrar');
        window.localStorage.removeItem('fv-usuario');
        window.localStorage.removeItem('fv-senha');
    }
}