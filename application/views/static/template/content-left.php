<div class="col-12 col-md-2 mt-2">
    <div class="row justify-content-center mb-2 rounded-0" id="box-perfil">
        <div class="col-12 mb-3" id="perfil-foto">
            <img src="<?= getFotoPerfil($this->session->fv_cliente_foto) ?>" class="img-fluid mx-auto d-block rounded-circle" alt="<?= getNomePerfil($this->session->fv_cliente_nome) ?>">
        </div>
        <div class="col-12 text-center" id="box-perfil-informacoes">
            <span id="box-perfil-informacoes-nome"><?= getNomePerfil($this->session->fv_cliente_nome) ?></span><br>
            <span id="box-perfil-informacoes-local"><?= "{$this->session->fv_cliente_cidade}/{$this->session->fv_cliente_uf}" ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-12 p-0">
            <div class="card rounded-0">
                <div class="card-body">
                    <h5 class="card-title cor-laranja">Lembre-se</h5>
                    <p class="card-text text-justify">Em caso de dúvidas ou dificuldades fale com seu mentor eleitoral pelo Whatsapp</p>
                </div>
            </div>
        </div>
    </div>
</div>