<?php
$this->load->view("static/template/head", ["title" => "Perfil::Atualizar | Fórmula do voto"]);
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
                                    <span><a href="<?= base_url("dashboard") ?>" title="Dashboard" class="btn"><i class="fas fa-arrow-left"></i></a> Editar perfil</span>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <a href="#" data-toggle="modal" data-target="#modalDadosAcesso"><small><i class="fas fa-key"></i> Dados de acesso</small></a>
                                        </div>
                                    </div>
                                    <form id="formAtualizar">
                                        <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                                        <div class="form-row">
                                            <div class="col-12 form-group">
                                                <label for="foto" style="cursor:pointer" class="mx-auto d-block">
                                                    <img id="foto-img" data-toggle="tooltip" data-placement="bottom" title="Clique para atualizar a foto" id="atualizar-perfil-foto" src="<?= getFotoPerfil($usuario->foto) ?>" class="img-fluid mx-auto d-block rounded-circle" style="max-width: 160px;max-height: 160px">
                                                </label>
                                                <input type="file" id="foto" name="foto" style="display:none">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 form-group">
                                                <label for="nome">Nome</label>
                                                <input type="text" id="nome" name="nome" class="form-control" placeholder="Informe o seu nome" value="<?= $usuario->nome ?>">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 form-group">
                                                <label for="email">E-mail</label>
                                                <input type="text" id="email" name="email" class="form-control" placeholder="Informe o seu e-mail" value="<?= $usuario->email ?>">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-row mb-3">
                                            <div class="col-12 col-md-6 form-group">
                                                <label for="estado">Estado</label>
                                                <select id="estado" name="estado" class="form-control">
                                                    <option value="">--</option>
                                                    <?php foreach ($estados as $estado) : ?>
                                                        <option <?= $estado->id == $usuario->idEstado ? "selected='selected'" : "" ?> value="<?= $estado->id ?>"><?= "{$estado->uf} - {$estado->estado}" ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <span class="invalid-feedback"></span>
                                            </div>
                                            <div class="col-12 col-md-6 form-group">
                                                <label for="cidade">Cidade</label>
                                                <select id="cidade" name="cidade" class="form-control">
                                                    <option value="">--</option>
                                                    <?php foreach ($cidades as $cidade) : ?>
                                                        <option <?= $cidade->id == $usuario->idCidade ? "selected='selected'" : "" ?> value="<?= $cidade->id ?>"><?= $cidade->cidade ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-row justify-content-end mb-4">
                                            <div class="col-12 col-md-4 col-sm-5 mb-3">
                                                <button type="submit" class="btn btn-success btn-block" id="formAtualizarBtnAtualizar">Atualizar</button>
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
<?php $this->load->view("static/modals/perfil/atualizar-dados-acesso")?>
<script src="<?= base_url("public/app/js/support/estados.controller.js") ?>"></script>
<script src="<?= base_url("public/app/js/perfil/atualizar.controller.js") ?>"></script>
<?php $this->load->view("static/template/end-page") ?>