<?php
$this->load->view("static/template/head", [
    "title" => "Agenda::Adicionar | Fórmula do voto",
    "styles" => [
        base_url("public/app/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css"),
        base_url("public/app/libs/clockpicker/dist/bootstrap-clockpicker.min.css")
    ],
    "scripts" => [
        ROOT . "/node_modules/jquery-countdown/dist/jquery.countdown.min.js",
        base_url("public/app/libs/clockpicker/dist/bootstrap-clockpicker.min.js"),
        base_url("public/app/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"),
        base_url("public/app/libs/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js"),
    ]
]);
?>
<?php $this->load->view("static/template/header-autenticado"); ?>
<main class="pt-4 mb-2 bg-main">
    <section id="section-main">
        <div class="container">
            <div class="row justify-content-around">
                <?php $this->load->view("static/template/content-left"); ?>
                <div class="col-12 col-md-7 mt-2" style="border-left: orange solid 2px;border-right: orange solid 2px">
                    <div class="row">
                        <div class="col-12">
                            <div class="card rounded-0">
                                <div class="card-header">
                                    <span><a href="<?= base_url("agendas") ?>" title="Agendas" class="btn"><i class="fas fa-arrow-left"></i></a> Adicionar evento</span>
                                </div>
                                <div class="card-body">
                                    <form id="formAdicionar">
                                        <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                                        <input type="hidden" id="cliente" name="cliente" value="<?= base64_decode($this->session->fv_cliente_usuario) ?>">
                                        <div class="form-row">
                                            <div class="col-12 form-group">
                                                <label for="titulo">Título</label>
                                                <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Informe o título do evento">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 col-md-6 col-sm-6 form-group">
                                                <label for="data">Hora</label>
                                                <input type="text" id="hora" name="hora" class="form-control clockpicker" placeholder="00:00">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                            <div class="col-12 col-md-6 col-sm-6 form-group">
                                                <label for="data">Data</label>
                                                <input type="text" id="data" name="data" class="form-control" placeholder="00/00/0000">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 form-group">
                                                <label for="descricao">Descrição</label>
                                                <textarea id="descricao" name="descricao" class="form-control" rows="4" placeholder="Informe a descrição do evento"></textarea>
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 form-group">
                                                <label for="observacoes">Observações</label>
                                                <textarea id="observacoes" name="observacoes" class="form-control" rows="4" placeholder="Observações sobre o evento ou sobre a postagem"></textarea>
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-row justify-content-between mb-4">
                                            <div class="col-12 col-md-4 col-sm-5 mb-3">
                                                <a href="<?= base_url("agendas") ?>" class="btn btn-secondary btn-block">Voltar</a>
                                            </div>
                                            <div class="col-12 col-md-4 col-sm-5 mb-3">
                                                <button type="submit" class="btn btn-success btn-block" id="formAdicionarBtnAdicionar">Adicionar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $this->load->view("static/template/content-right"); ?>
            </div>
        </div>
    </section>
</main>
<script src="<?= base_url("node_modules/moment/moment.js") ?>"></script>
<script src="<?= base_url("public/app/js/countdown/controller.js") ?>"></script>
<script src="<?= base_url("public/app/js/agendas/adicionar.controller.js") ?>"></script>
<?php $this->load->view("static/template/end-page") ?>