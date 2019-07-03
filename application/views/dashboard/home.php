<?php
$this->load->view("static/template/head", [
    "title" => "Dashboard | Fórmula do voto",
    "scripts" => [ROOT . "/node_modules/jquery-countdown/dist/jquery.countdown.min.js"]
])
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
                <?php $this->load->view("static/template/content-left") ?>
                <div class="col-12 col-md-7 mt-2" style="border-left: orange solid 2px;border-right: orange solid 2px">
                    <div class="row">
                        <div class="col-12 col-md-4 col-sm-4 mb-4 d-flex">
                            <div class="card rounded-0">
                                <div class="card-body">
                                    <div class="card-title"><img src="<?= base_url("public/app/img/sistema/icone-calendario.png") ?>" class="icone-dashboard img-fluid rounded-circle mx-auto d-block"></div>
                                    <div class="card-text"><p class="text-center cor-cinza">Informe sua agenda para os próximos 7 dias</p></div>
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn btn-primary btn-sm btn-block">Acessar</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-sm-4 mb-4 d-flex">
                            <div class="card rounded-0">
                                <div class="card-body">
                                    <div class="card-title"><img src="<?= base_url("public/app/img/sistema/icone-videos.png") ?>" class="icone-dashboard img-fluid rounded-circle mx-auto d-block"></div>
                                    <div class="card-text"><p class="text-center cor-cinza">Assistir conteúdos exclusivos produzidos pela Fórmula do Voto</p></div>
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn btn-primary btn-sm btn-block">Acessar</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-sm-4 mb-4 d-flex">
                            <div class="card rounded-0">
                                <div class="card-body">
                                    <div class="card-title"><img src="<?= base_url("public/app/img/sistema/icone-lupa.png") ?>" class="icone-dashboard img-fluid rounded-circle mx-auto d-block"></div>
                                    <div class="card-text"><p class="text-center cor-cinza">Confira dicas de filmes e livros sobre campanhas eleitoras</p></div>
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn btn-primary btn-sm btn-block">Acessar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-4 col-sm-4 mb-4 d-flex">
                            <div class="card rounded-0">
                                <div class="card-body">
                                    <div class="card-title"><img src="<?= base_url("public/app/img/sistema/icone-conversas.png") ?>" class="icone-dashboard img-fluid rounded-circle mx-auto d-block"></div>
                                    <div class="card-text"><p class="text-center cor-cinza">Fórum entre participantes para trocar de ideas e estratégias</p></div>
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn btn-primary btn-sm btn-block">Acessar</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-sm-4 mb-4 d-flex">
                            <div class="card rounded-0">
                                <div class="card-body">
                                    <div class="card-title"><img src="<?= base_url("public/app/img/sistema/icone-upload.png") ?>" class="icone-dashboard img-fluid rounded-circle mx-auto d-block"></div>
                                    <div class="card-text"><p class="text-center cor-cinza">Upload de vídeos e fotos direto na plataforma</p></div>
                                </div>
                                <div class="card-footer">
                                    <a href="<?= base_url("upload") ?>" class="btn btn-primary btn-sm btn-block">Acessar</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-sm-4 mb-4 d-flex">
                            <div class="card rounded-0">
                                <div class="card-body">
                                    <div class="card-title"><img src="<?= base_url("public/app/img/sistema/icone-grafico.png") ?>" class="icone-dashboard img-fluid rounded-circle mx-auto d-block"></div>
                                    <div class="card-text"><p class="text-center cor-cinza">Relatórios individuais sobre o crescimento de suas redes sociais</p></div>
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn btn-primary btn-sm btn-block">Acessar</a>
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
<?php $this->load->view("static/template/end-page") ?>