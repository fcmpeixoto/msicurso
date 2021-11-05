<div class="modal fade" tabindex="-1" role="dialog" id="modal-edita-status" wire:ignore.self>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alterar Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>Alterando Status do Pedido</h3>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputState">Parcelas</label>
                        <select id="inputState" name="status" class="form-control" wire:model="status">
                            <option value="1">Aguardando pagamento</option>
                            <option value="2">Em análise</option>
                            <option value="3">Paga</option>
                            <option value="4">Disponível</option>
                            <option value="5">Em disputa</option>
                            <option value="6">Devolvida</option>
                            <option value="7">Cancelada</option>
                            <option value="8">Debitado</option>
                            <option value="9">Retenção temporária</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button  class="btn btn-success" wire:click="fecharModalEdit">Cancelar</button>
                <button  class="btn btn-danger" wire:click="editConfirmar">Sim</button>
            </div>
        </div>
    </div>
</div>
