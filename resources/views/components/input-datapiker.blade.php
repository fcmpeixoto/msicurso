<label for="{{ $ncampo }}">{{ $legenda }}</label>
<input type="text" class="form-control datepicker text-right" name="{{ $ncampo }}" wire:model.defer="{{ $ncampo }}" onchange="@this.set('{{ $ncampo }}',this.value)">
@error("$ncampo") <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">{{ $message }}</span> @enderror
