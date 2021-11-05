<div class="modal fade" tabindex="-1" role="dialog" id="modal-deleta-anexo" wire:ignore.self>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluindo Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>Deseja excluir o registro?</h3>
                <input type="hidden" name="anexoid" id="anexoid" value="">
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button  class="btn btn-success" wire:click="fecharModalDeleteAnexo">Cancelar</button>
                <button  class="btn btn-danger" wire:click="deleteConfirmarAnexo">Sim</button>
            </div>
        </div>
    </div>
</div>
