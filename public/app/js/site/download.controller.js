$(".btn-modal").on("click", function () {
    $("#modalFormDownloadTitulo").html($(this).data("title-modal"));
    $("#formDownload").trigger("reset");
    $("#conteudo").val($(this).data("conteudo"));
    $("#modalFormDownload").modal("show");
});

$("#formDownload").validate({
    rules: {
        nome: {required: true},
        email: {
            required: true,
            email: true
        },
        telefone: {required: true},
        municipio: {required: true},
        estado: {required: true},
        cargoPretendido: {required: true},
        conteudo: {required: true}
    },
    messages: {
        nome: {required: "Campo obrigatório"},
        email: {
            required: "Campo obrigatório",
            email: "E-mail inválido"
        },
        telefone: {required: "Campo obrigatório"},
        municipio: {required: "Campo obrigatório"},
        estado: {required: "Campo obrigatório"},
        cargoPretendido: {required: "Campo obrigatório"},
        conteudo: {required: "Campo obrigatório"},
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
        submitFormDownload();
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

async function submitFormDownload() {
    let dados = new FormData($("#formDownload")[0]);
    dados.append("ajax", true);

    $("#formDownloadBtnDownload")
            .html(`<i class="fas fa-circle-notch fa-spin"></i>`)
            .attr("disabled", "disabled");

    try {
        let response = await axios.post($("head").data("info") + "site/download", dados);

        if (response.status == 200 && response.data.resultado) {
            Swal.fire({
                type: 'success',
                title: 'Sucesso',
                text: response.data.msg
            }).then(() => {
                $("#modalFormDownload").modal("hide");
                location.href = $("head").data("info") + `baixar?permissao=${response.data.hash}`;
            });
        } else {
            Swal.fire({
                type: 'warning',
                title: 'Atenção',
                text: response.data.msg
            });
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

    $("#formDownloadBtnDownload")
            .html(`Download`)
            .removeAttr("disabled");
}