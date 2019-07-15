$().ready(() => {
    $("#hora").mask("00:00");
    $("#data").mask("00/00/0000");

    $('#hora').clockpicker({autoclose: true});
    $("#data").datepicker({
        format: "dd/mm/yyyy",
        language: "pt-BR",
        toggleActive: true,
        autoclose: true
    });
});

$.validator.addMethod("dataValida", function (value, element) {
    return moment().format("DD/MM/YYYY") == value || moment(moment(value.split("/").reverse().join("-")), "YYYY-MM-DD").isSameOrAfter(moment().format("YYYY-MM-DD"));
}, "Data retroativa não permitida");

$("#formAtualizar").validate({
    rules: {
        id: {required: true},
        cliente: {required: true},
        status: {required: true},
        titulo: {required: true},
        data: {
            required: true,
            minlength: 10,
            dataValida: true
        }
    },
    messages: {
        titulo: {required: "Campo obrigatório"},
        data: {
            required: "Campo obrigatório",
            minlength: "Data incompleta"
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
        let dados = new FormData($("#formAtualizar")[0]);
        dados.append("ajax", true);

        axios.interceptors.request.use((config) => {
            $("#formAtualizarBtnAtualizar")
                    .html(`<i class="fas fa-circle-notch fa-spin"></i>`)
                    .attr("disabled", "disabled");

            return config;
        });

        axios.interceptors.response.use((response) => {
            $("#formAtualizarBtnAtualizar")
                    .html(`Atualizar`)
                    .removeAttr("disabled");

            return response;
        }, (error) => {
            $("#formAtualizarBtnAtualizar")
                    .html(`Atualizar`)
                    .removeAttr("disabled");
        });

        axios.post($("head").data("info") + "agendas/atualizar", dados).then((response) => {
            if (response.data.resultado) {
                Swal.fire({
                    type: 'success',
                    title: 'Tudo certo',
                    text: response.data.msg,
                }).then(() => {
                    location.href = $("head").data("info") + "agendas";
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
        }).catch((response) => {
            Swal.fire({
                type: 'error',
                title: 'Atenção',
                text: getMensagemErro(response.status)
            });
        });
    }
});