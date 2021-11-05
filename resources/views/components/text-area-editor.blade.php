<label for="{{ $ncampo }}">{{ $legenda }}</label>
<div class="col-sm-12 col-md-12" wire:ignore>
    <textarea type="text" class="form-control {{ $ncampo }}" name="{{ $ncampo }}" wire:model.defer="{{ $ncampo }}">
        {{ $ncampo }}
    </textarea>
</div>
@error("$ncampo") <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">{{ $message }}</span> @enderror
<script>
    window.addEventListener('livewire:load', function () {
        $('.{{ $ncampo }}').summernote({
            tabsize: 2,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                @this.set('{{$ncampo}}', contents);
                }
            }
        });

    });
</script>
