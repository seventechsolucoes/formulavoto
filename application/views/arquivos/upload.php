<?php
$this->load->view("static/template/head", [
    "title" => "Upload | Fórmula do voto",
    "scripts" => [ROOT . "/node_modules/jquery-countdown/dist/jquery.countdown.min.js"]
]);
$this->output->enable_profiler(TRUE);
?>
<header id="header">
    <section id="section-header">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-6 col-md-4">
                    <img src="<?= base_url("/public/app/img/sistema/logo-formula-voto-horizontal.png") ?>" class="img-fluid mx-auto d-block" alt="Logo Fórmula do Voto">
                </div>
                <div class="col-6 col-md-3">
                    <img src="<?= base_url("/public/app/img/sistema/logo-ave.png") ?>" class="img-fluid mx-auto d-block" alt="Logo AVE">
                </div>
            </div>
        </div>
    </section>
</header>
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
                                    <span>Upload de Vídeos e Fotos</span>
                                </div>
                                <div class="card-body">
                                    <form id="formUpload">
                                        <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                                        <input type="hidden" id="tipo" name="tipo" class="form-control">
                                        <div class="form-row">
                                            <div class="col-12 form-group">
                                                <label for="evento">Evento</label>
                                                <input type="text" id="evento" name="evento" class="form-control" placeholder="Informe o título do evento">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 col-md-6 col-sm-6 form-group">
                                                <label for="local">Local</label>
                                                <input type="text" id="local" name="local" class="form-control" placeholder="Informe o local do evento">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                            <div class="col-12 col-md-6 col-sm-6 form-group">
                                                <label for="data">Data</label>
                                                <input type="tel" id="data" name="data" class="form-control" placeholder="00/00/0000">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 form-group">
                                                <label for="publicoPresente">Público presente</label>
                                                <textarea id="publicoPresente" name="publicoPresente" class="form-control" rows="4" placeholder="Informe o público presente no evento"></textarea>
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 form-group">
                                                <label for="assunto">Assunto</label>
                                                <input type="text" id="assunto" name="assunto" class="form-control" placeholder="Informe o assunto do evento">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 form-group">
                                                <label for="autoridades">Autoridades</label>
                                                <textarea id="autoridades" name="autoridades" class="form-control" rows="4" placeholder="Informe quais autoridades estavam presentes"></textarea>
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
                                        <div class="form-row">
                                            <div class="col-12 form-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="arquivo" name="arquivo">
                                                    <label class="custom-file-label" for="arquivo" data-browse="Arquivo">Selecione um arquivo</label>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row justify-content-end">
                                            <div class="col-12 col-md-4 col-sm-5">
                                                <button type="submit" class="btn btn-success btn-block" id="formUploadBtnEnviar">Enviar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2 mt-2">
                    <div class="row mb-2">
                        <div class="col-12" id="countdown">
                            <div class="row">
                                <div class="col-12 text-center" id="countdown-header">
                                    <span class="text-white">Faltam</span>
                                </div>
                            </div>
                            <div class="row text-center pt-2 pb-2">
                                <div class="col-12" id="countdown-eleicao"></div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center" id="countdown-text">
                                    <span class="text-white">
                                        Para as<br>
                                        eleições 2020
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 p-0">
                            <div class="card rounded-0" id="card-calendario-eleitoral">
                                <div class="card-body">
                                    <div class="card-title">Calendário<br>eleitoral</div>
                                    <div class="card-text">
                                        <p class="text-justify text-white">
                                            O prazo final ara filiações partidárias termina em 30 de julho de 2019.
                                            Até essa data todos os pré-candidatos devem estar filiados a um partido político.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="<?= base_url("public/app/js/countdown/controller.js") ?>"></script>
<script src="<?= base_url("public/app/js/arquivos/upload.controller.js") ?>"></script>
<?php $this->load->view("static/template/end-page") ?>