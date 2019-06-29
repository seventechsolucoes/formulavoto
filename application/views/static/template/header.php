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
                        <div class="form-row form-group mb-0">
                            <div class="col-12">
                                <span class="text-white">ÁREA RESTRITA</span>
                            </div>
                        </div>
                        <div class="form-row mb-1">
                            <div class="col-12 form-group mb-1">
                                <label class="text-white mb-0" for="usuario">Usuário</label>
                                <input type="text" class="form-control rounded-0" id="usuario" name="senha" placeholder="Digite seu usuário">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 form-group">
                                <label class="text-white mb-0" for="senha">Senha</label>
                                <input type="text" class="form-control rounded-0" id="senha" name="senha" placeholder="Digite sua senha">
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-12 col-md-6 form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="lembrar" name="lembrar" style="margin-left: 2px">
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