<?php
$this->load->view("static/template/head", [
    "title" => "Upload::Home | Fórmula do voto",
    "styles" => ["https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"],
    "scripts" => ["https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"]
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
                                    <span><a href="<?= base_url("dashboard") ?>" title="Agendas" class="btn"><i class="fas fa-arrow-left"></i></a> Upload</span>
                                </div>
                                <div class="card-body">
                                    <form id="formBuscar">
                                        <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                                        <div class="form-row justify-content-end">
                                            <div class="col-12 col-md-3">
                                                <a href="<?= base_url("uploads/upload") ?>" class="btn btn-primary btn-block">Fazer upload</a>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="row">
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                            <table id="tabelaUploads" class="table table-bordered table-hover" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th style="vertical-align:middle" class="text-center">#</th>
                                                        <th style="vertical-align:middle">Evento - Local</th>
                                                        <th style="vertical-align:middle" class="text-center">Data</th>
                                                        <th style="vertical-align:middle" class="text-center">Status do Post</th>
                                                        <th style="vertical-align:middle" class="text-center">Imag. disponível</th>
                                                        <th style="vertical-align:middle"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tabelaUploadsContent">
                                                    <tr>
                                                        <td colspan="6" class="tabela-vazia">Nenhum post</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
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
<?php $this->load->view("static/modals/uploads/visualizar"); ?>
<script src="<?= base_url("public/app/js/arquivos/home.controller.js") ?>"></script>
<?php $this->load->view("static/template/end-page") ?>