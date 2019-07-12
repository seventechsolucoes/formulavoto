<div class="modal fade" id="modalVisualizarPost" tabindex="-1" role="dialog" aria-labelledby="modalVisualizarPost" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" id="modalVisualizarPostLoader">
                    </div>
                </div>
                <form id="formVisualizarPost">
                    <div class="form-row">
                        <div class="col-12">
                            <a href="#" id="modalVisualizarPostLink">
                                <img id="modalVisualizarPostImagem" src="<?= base_url("public/app/img/sistema/sem-foto-post.png") ?>" class="img-fluid mx-auto d-block" style="max-height: 300px;max-width: 300px">
                            </a>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 form-group">
                            <label for="evento">Evento</label>
                            <input disabled="disabled" type="text" id="evento" name="evento" class="form-control" placeholder="Informe o título do evento">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 col-md-6 col-sm-6 form-group">
                            <label for="local">Local</label>
                            <input disabled="disabled" type="text" id="local" name="local" class="form-control" placeholder="Informe o local do evento">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="col-12 col-md-6 col-sm-6 form-group">
                            <label for="data">Data</label>
                            <input disabled="disabled" type="tel" id="data" name="data" class="form-control" placeholder="00/00/0000">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 form-group">
                            <label for="assunto">Assunto</label>
                            <input disabled="disabled" type="text" id="assunto" name="assunto" class="form-control" placeholder="Informe o assunto do evento">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 col-md-4 form-group">
                            <label for="publicoPresente">Público presente</label>
                            <textarea disabled="disabled" id="publicoPresente" name="publicoPresente" class="form-control" rows="4" placeholder="Informe o público presente no evento"></textarea>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="col-12 col-md-4 form-group">
                            <label for="autoridades">Autoridades</label>
                            <textarea disabled="disabled" id="autoridades" name="autoridades" class="form-control" rows="4" placeholder="Informe quais autoridades estavam presentes"></textarea>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="col-12 col-md-4 form-group">
                            <label for="observacoes">Observações</label>
                            <textarea disabled="disabled" id="observacoes" name="observacoes" class="form-control" rows="4" placeholder="Observações sobre o evento ou sobre a postagem"></textarea>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>