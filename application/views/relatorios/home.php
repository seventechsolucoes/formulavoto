<?php
$this->load->view("static/template/head", [
    "title" => "Relatórios | Fórmula do voto",
    "styles" => [ROOT . "/node_modules/chart.js/dist/Chart.min.css"],
    "scripts" => [ROOT . "/node_modules/chart.js/dist/Chart.min.js"]
]);
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
                    <form id="formEstatisticas">
                        <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                    </form>
                    <div class="row">
                        <div class="col-12">
                            <div class="card rounded-0">
                                <div class="card-header">
                                    <span><a href="<?= base_url("dashboard") ?>" title="Dashboard" class="btn"><i class="fas fa-arrow-left"></i></a> Relatórios</span>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-12 text-center">
                                            <span style="font-size: 1.2em">Estatísticas do Facebook</span>
                                        </div>
                                        <div class="col-12">
                                            <canvas id="graficoFacebook"></canvas>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <span style="font-size: 1.2em">Estatísticas do Instagram</span>
                                        </div>
                                        <div class="col-12">
                                            <canvas id="graficoInstagram"></canvas>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 50px">
                                        <div class="col-12 col-md-6 mb-4">
                                            <div id="fb-root"></div>
                                            <div class="fb-page" data-href="https://www.facebook.com/aformuladovoto/" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/aformuladovoto/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/aformuladovoto/">Carregando feed</a></blockquote></div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <?php
                                            $access_token = "13490098691.36dfc13.73980315b560434da73fec78f1050f04";
                                            $media = file_get_contents("https://api.instagram.com/v1/users/self/media/recent/?access_token=$access_token&count=12");
                                            $media = json_decode($media, true)['data'];
                                            ?>
                                            <?php if (!empty($media)) : ?>
                                                <div class="row d-flex align-content-center">
                                                    <?php foreach ($media as $data) : ?>
                                                        <div class='col-4 p-0'>
                                                            <a href="<?= $data["link"] ?>" target="_blank">
                                                                <img src="<?= $data["images"]["low_resolution"]["url"] ?>" class='img-fluid'>
                                                            </a>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
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
<script src="<?= base_url("public/app/js/countdown/controller.js") ?>"></script>
<script src="<?= base_url("public/app/js/relatorios/relatorio.controller.js") ?>"></script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v3.3&appId=1387747514621666&autoLogAppEvents=1"></script>
<?php $this->load->view("static/template/end-page") ?>