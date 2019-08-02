<div class="modal fade" id="modalFormDownload">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormDownloadTitulo">Download</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formDownload">
                <input type="hidden" name="<?= $csrf["name"] ?>" value="<?= $csrf["hash"] ?>">
                <input type="hidden" id="conteudo" name="conteudo">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-12 form-group">
                            <label for="nome">Nome</label>
                            <input type="text" id="nome" name="nome" class="form-control" placeholder="Informe o seu nome">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="email">E-mail</label>
                            <input type="text" id="email" name="email" class="form-control" placeholder="Informe o seu e-mail">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="telefone">Telefone</label>
                            <input type="text" id="telefone" name="telefone" class="form-control" placeholder="Informe o seu telefone">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="municipio">Município</label>
                            <input type="text" id="municipio" name="municipio" class="form-control" placeholder="Informe o seu município">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="estado">Estado</label>
                            <input type="text" id="estado" name="estado" class="form-control" placeholder="Informe o seu estado">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 form-group">
                            <label for="cargoPretendido">Cargo pretendido</label>
                            <select id="cargoPretendido" name="cargoPretendido" class="form-control">
                                <option value="prefeito">Prefeito</option>
                                <option value="vereador">Vereador</option>
                            </select>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-block" id="formDownloadBtnDownload">Download</button>
                </div>
            </form>
        </div>
    </div>
</div>