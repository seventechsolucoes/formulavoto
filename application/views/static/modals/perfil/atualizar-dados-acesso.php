<div class="modal fade" id="modalDadosAcesso">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dados de acesso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formAtualizarDadosAcesso">
                <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-12 form-group">
                            <label for="usuario">Usuário</label>
                            <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Informe o usuário">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 form-group">
                            <label for="senha">Senha</label>
                            <input type="password" id="senha" name="senha" class="form-control" placeholder="Informe a senha">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-block" id="formAtualizarDadosAcessoBtnAtualizar">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>