$().ready(() => {
    $("#data").mask("00/00/0000");
    console.log();
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

$.validator.addMethod("dataValida", function (value, element) {

    return moment().format("DD/MM/YYYY") == value || moment(moment(value.split("/").reverse().join("-")), "YYYY-MM-DD").isBefore(moment().format("YYYY-MM-DD"));
}, "Data futura não permitida");

$("#formUpload").validate({
    rules: {
        tipo: {required: true},
        evento: {required: true},
        local: {required: true},
        data: {
            required: true,
            minlength: 10,
            dataValida: true
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

        axios.interceptors.request.use((config) => {
            $("#formUploadBtnEnviar").attr("disabled", "disabled");
            $("#progress-upload").removeClass("invisible");

            return config;
        });

        axios.interceptors.response.use((response) => {
            $("#formUploadBtnEnviar").removeAttr("disabled");

            $("#progress-upload").addClass("sinvisible");

            return response;
        });

        axios.post($("head").data("info") + "ups/enviar", dados, {
            onUploadProgress: (progressEvent) => {
                if (progressEvent.lengthComputable) {
                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);

                    $("#progress-upload-bar").removeAttr("style");
                    $("#progress-upload-bar").attr("style", `width:${percentCompleted}%`);
                    $("#progress-upload-bar").attr("aria-valuenow", percentCompleted);

                    if (percentCompleted >= 100) {
                        $("#progress-upload-bar").html(`<i class="fas fa-circle-notch fa-spin"></i> Processando upload`);
                    } else {
                        $("#progress-upload-bar").html(`${percentCompleted}%`);
                    }
                }
            }
        }).then((response) => {
            if (response.data.resultado) {
                Swal.fire({
                    type: 'success',
                    title: 'Tudo certo',
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
        }).catch((response) => {
            Swal.fire({
                type: 'error',
                title: 'Atenção',
                text: getMensagemErro(response.status)
            });
        });
    }
});