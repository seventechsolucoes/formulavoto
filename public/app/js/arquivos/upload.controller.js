$().ready(() => {
    $("#data").mask("00/00/0000");
});

$("#arquivo").change(function () {
    var extencoesImg = ['jpeg', 'jpg', 'png'];
    var extencoesVideos = ['avi', 'mp4'];
    var extensoesDocs = ['doc', 'docx', 'pdf'];

    if ($.inArray($(this).val().split('.').pop().toLowerCase(), extencoesImg) > 0) {
        $("#tipo").val("imagem");
    }

    if ($.inArray($(this).val().split('.').pop().toLowerCase(), extencoesVideos) > 0) {
        $("#tipo").val("video");
    }

    if ($.inArray($(this).val().split('.').pop().toLowerCase(), extensoesDocs) > 0) {
        $("#tipo").val("documento");
    }
});

$("#formUpload").validate({
    rules: {
        tipo: {required: true},
        evento: {required: true},
        local: {required: true},
        data: {
            required: true,
            minlength: 10
        },
        assunto: {required: true},
        arquivo: {
            required: true,
            extension: "png|jpg|jpeg|avi|mp4|pdf|doc|docx"
        }
    },
    messages: {
        evento: {required: "Campo obrigatório"},
        local: {required: "Campo obrigatório"},
        data: {
            required: "Campo obrigatório",
            minlength: "Data incompleta"
        },
        assunto: {required: "Campo obrigatório"},
        arquivo: {
            required: "Campo obrigatório",
            extension: "Extensões permitidas: PNG | JPG | JPEG | AVI | MP4 | PDF | DOC | DOCX"
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
        let dados = new FormData($("#formUpload")[0]);
        dados.append("ajax", true);

        $("#formUploadBtnEnviar")
                .html(`<i class="fas fa-circle-notch fa-spin"></i>`)
                .attr("disabled", "disabled");

        fetch($("head").data("info") + "ups/enviar", {
            method: "post",
            body: dados
        }).then((response) => {
            $("#formUploadBtnEnviar")
                    .html(`Enviar`)
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
            if (data.resultado) {
                Swal.fire({
                    type: 'success',
                    title: 'Tudo certo',
                    text: data.msg
                }).then(() => {
                    location.href = $("head").data("info") + "dashboard";
                });
            } else {
                if (data.sessaoExpirada) {
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
                        text: data.msg
                    });
                }
            }
        }).catch(() => {
            Swal.fire({
                type: 'error',
                title: 'Atenção',
                text: getMensagemErro(response.status)
            });
        });
    }
});