<?php
$this->load->view("static/template/head", [
    "title" => "Agendas | Fórmula do voto",
    "styles" => [
        base_url("public/app/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css"),
    ],
    "scripts" => [
        ROOT . "/node_modules/jquery-countdown/dist/jquery.countdown.min.js",
        base_url("public/app/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"),
        base_url("public/app/libs/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js")
    ]
]);
?>
<?php $this->load->view("static/template/header-autenticado") ?>
<main class="pt-4 mb-2 bg-main">
    <section id="section-main">
        <div class="container">
            <div class="row justify-content-around">
                <?php $this->load->view("static/template/content-left"); ?>
                <div class="col-12 col-md-7 mt-2" style="border-left: orange solid 2px;border-right: orange solid 2px">
                    <form id="formEstatisticas">
                        <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                    </form>
                    <div class="row">
                        <div class="col-12">
                            <div class="card rounded-0">
                                <div class="card-header">
                                    <span><a href="<?= base_url("dashboard") ?>" title="Dashboard" class="btn"><i class="fas fa-arrow-left"></i></a> Agendas</span>
                                </div>
                                <div class="card-body">
                                    <form id="formBuscar">
                                        <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                                        <div class="row">
                                            <div class="col-12 form-group">
                                                <label for="titulo">Título</label>
                                                <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Título do evento">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-4 form-group">
                                                <label for="dataInicial">Data inicial</label>
                                                <input type="text" id="dataInicial" name="dataInicial" class="form-control" placeholder="Data inicial">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                            <div class="col-12 col-md-4 form-group">
                                                <label for="dataFinal">Data final</label>
                                                <input type="text" id="dataFinal" name="dataFinal" class="form-control" placeholder="Data final">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                            <div class="col-12 col-md-4 form-group">
                                                <label for="status">Status</label>
                                                <select id="status" name="status" class="form-control">
                                                    <option value="todos">Todos</option>
                                                    <option value="aguardando">Aguardando</option>
                                                    <option value="concluido">Concluído</option>
                                                    <option value="atrasado">Atrasado</option>
                                                    <option value="cancelado">Cancelado</option>
                                                </select>
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-12 col-md-3 col-sm-4 form-group">
                                                <button type="submit" class="btn btn-primary btn-sm btn-block" title="Filtrar" id="formBuscarBtnFiltrar">Filtrar</button>
                                            </div>
                                            <div class="col-12 col-md-3 col-sm-4 form-group">
                                                <a href="<?= base_url("agenda/adicionar") ?>" class="btn btn-success btn-sm btn-block" title="Adicionar">Adicionar</a>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12">
                                                <hr>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="row" id="cards-eventos">
                                    </div>
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
<script src="<?= base_url("public/app/js/agendas/home.controller.js") ?>"></script>
<?php $this->load->view("static/template/end-page") ?>