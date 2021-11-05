<label for="{{ $ncampo }}">{{ $legenda }}</label>
<div class="custom-file">
    <input type="file" class="custom-file-input" name="txtanexo" wire:model="{{ $ncampo }}">
    <label class="custom-file-label" for="customFile">Material de Apoio</label>
</div>
@error("$ncampo") <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">{{ $message }}</span> @enderror
<div wire:loading wire:target="{{ $ncampo }}">Carregando...</div>
