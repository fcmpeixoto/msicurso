<label for="{{ $ncampo }}">{{ $legenda }}</label>
<input type="number" class="form-control text-right" name="{{ $ncampo }}" wire:model.defer="{{ $ncampo }}" required>
@error("$ncampo") <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">{{ $message }}</span> @enderror
