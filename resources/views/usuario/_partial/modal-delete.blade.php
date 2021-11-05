<div class="modal fade" tabindex="-1" role="dialog" id="modal-deleta-anexo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluindo Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('mscurso.delete.anexo') }}" method="post">
                @csrf
                @method('DELETE')
            <div class="modal-body">
                <h3>Deseja excluir o registro?</h3>
                <input type="hidden" name="anexoid" id="anexoid" value="">
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Sim</button>
            </div>
            </form>
        </div>
    </div>
</div>
