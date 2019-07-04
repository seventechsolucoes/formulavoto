<?php $this->load->view("static/template/head") ?>
<header id="header">
    <section id="section-header">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-12 col-md-4">
                    <img src="<?= base_url("/public/app/img/sistema/logo-formula-voto-horizontal.png") ?>" class="img-fluid mx-auto d-block" alt="Logo Fórmula do Voto">
                    <hr class="d-block d-sm-none" style="border: white solid 1px">
                </div>
                <div class="col-12 col-md-3">
                    <form id="formLogin">
                        <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                        <div class="form-row form-group mb-0">
                            <div class="col-12">
                                <span class="text-white">ÁREA RESTRITA</span>
                            </div>
                        </div>
                        <div class="form-row mb-1">
                            <div class="col-12 form-group mb-1">
                                <label class="text-white mb-0" for="usuario">Usuário</label>
                                <input type="text" class="form-control rounded-0" id="usuario" name="usuario" placeholder="Digite seu usuário">
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 form-group">
                                <label class="text-white mb-0" for="senha">Senha</label>
                                <input type="password" class="form-control rounded-0" id="senha" name="senha" placeholder="Digite sua senha">
                                <span class="invalid-feedback"></span>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-12 col-md-6 form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="formLoginCheckboxLembrar" name="formLoginCheckboxLembrar" style="margin-left: 2px">
                                <label class="form-check-label text-white" for="lembrar" style="margin-left: 25px">Lembrar</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <button type="submit" class="btn btn-primary btn-block btn-sm rounded-0" id="formLoginBtnEntrar">Entrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</header>
<main class="mt-4 mb-2">
    <section id="section-main">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-12 col-md-2 mt-2">
                    <div class="row bg-cinza justify-content-center p-2">
                        <div class="col-10">
                            <img src="<?= base_url("public/app/img/sistema/logo-formula-voto-vertical.png") ?>" class="img-fluid mx-auto d-block">
                        </div>
                    </div>
                    <div class="row bg-cinza">
                        <div class="col-12 text-center">
                            <span>
                                O que todo<br>
                                candidato<br>
                                deve saber
                            </span>
                        </div>
                    </div>
                    <div class="row bg-cinza justify-content-center p-2">
                        <div class="col-10">
                            <a href="#" class="btn btn-primary btn-block">Download</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-7 mt-2" style="border-left: orange solid 2px;border-right: orange solid 2px">
                    <div class="row mb-2">
                        <div class="col-12 text-center" id="titulo-videos-relacionados">
                            <span>VÍDEOS RELACIONADOS</span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12 col-md-4">
                            <img src="http://placehold.it/220x150" class="img-fluid mx-auto">
                        </div>
                        <div class="col-12 col-md-4">
                            <img src="http://placehold.it/220x150" class="img-fluid mx-auto">
                        </div>
                        <div class="col-12 col-md-4">
                            <img src="http://placehold.it/220x150" class="img-fluid mx-auto">
                        </div>
                    </div>
                    <div class="row mt-4 align-items-center bg-cinza">
                        <div class="col-12 col-md-8">
                            <img src="http://placehold.it/620x350" class="img-fluid mx-auto">
                        </div>
                        <div class="col-12 col-md-4">
                            <span id="titulo-video-destaque">Lorem ipsum dolor</span><br>
                            <span>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                Nunc sapien quam, ultrices in tincidunt a, ultricies in massa. 
                                Quisque vulputate eleifend tempor. 
                            </span>
                        </div>
                    </div>
                    <div class="row mt-4 mb-4">
                        <div class="col-12 text-center">
                            <span id="titulo-filiados">Filiados da Fórmula do Voto tem direito:</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-4 col-sm-4 text-center">
                            <div class="mb-4">
                                <img src="<?= base_url("public/app/img/sistema/icone-conversas.png") ?>" class="img-fluid mx-auto rounded-circle icone-dashboard">
                            </div>
                            <div>
                                <span>Fórum entre participantes para troca de ideias e estratégios</span>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-sm-4 text-center">
                            <div class="mb-4">
                                <img src="<?= base_url("public/app/img/sistema/icone-upload.png") ?>" class="img-fluid mx-auto rounded-circle icone-dashboard">
                            </div>
                            <div>
                                <span>Uploads de vídeos e fotos direto na plataforma</span>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-sm-4 text-center">
                            <div class="mb-4">
                                <img src="<?= base_url("public/app/img/sistema/icone-grafico.png") ?>" class="img-fluid mx-auto rounded-circle icone-dashboard">
                            </div>
                            <div>
                                <span>Relatórios individuais sobre o crescimento de suas redes sociais</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2 mt-2">
                    <div class="row bg-cinza justify-content-center p-2">
                        <div class="col-10">
                            <img src="<?= base_url("public/app/img/sistema/logo-formula-voto-vertical.png") ?>" class="img-fluid mx-auto d-block">
                        </div>
                    </div>
                    <div class="row bg-cinza">
                        <div class="col-12 text-center">
                            <span>
                                O que todo<br>
                                candidato<br>
                                deve saber
                            </span>
                        </div>
                    </div>
                    <div class="row bg-cinza justify-content-center p-2 mb-2">
                        <div class="col-10">
                            <a href="#" class="btn btn-primary btn-block">Download</a>
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col-12">
                            <span>Veja também</span>
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col-12">
                            <div class="row mb-2">
                                <div class="col-4 p-0">
                                    <img src="http://placehold.it/100x100" class="img-fluid mx-auto d-block">
                                </div>
                                <div class="col-8 pt-0 pb-0 pr-2 pl-2">
                                    <p class="text-justify noticia-home">Some quick example text to build on the card.</p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4 p-0">
                                    <img src="http://placehold.it/100x100" class="img-fluid mx-auto d-block">
                                </div>
                                <div class="col-8 pt-0 pb-0 pr-2 pl-2">
                                    <p class="text-justify noticia-home">Some quick example text to build on the card.</p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4 p-0">
                                    <img src="http://placehold.it/100x100" class="img-fluid mx-auto d-block">
                                </div>
                                <div class="col-8 pt-0 pb-0 pr-2 pl-2">
                                    <p class="text-justify noticia-home">Some quick example text to build on the card.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="<?= base_url("public/app/js/site/login.controller.js") ?>"></script>
<?php $this->load->view("static/template/end-page") ?>