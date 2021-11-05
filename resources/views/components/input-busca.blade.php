<div class="form-row">

    <div class="form-group col-md-4">
        <label for="busca">Digite sua Busca</label>
        <input type="text" class="form-control" wire:model="filtros.busca">
    </div>
    <div class="form-group col-md-6"></div>
    <div class="form-group col-md-2">
        <label for="porpagina">Mostrar</label>
        <select class="form-control" wire:model="porPagina">
            <option>10</option>
            <option>50</option>
            <option>100</option>
        </select>
    </div>

</div>
