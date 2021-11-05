<div>

    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">

            <div class="card">

                <div class="card-body">
                    <form wire:submit.prevent="store()" autocomplete="off">
                        @csrf
                        @include('livewire.curso._partial.form')
                        <x-button-salvar-sumit legenda="Salvar" />
                    </form>
                </div>
            </div>

        </div>
    </div>
    @if($grupoAnexo)
        @include('livewire.anexo.create')
    @endif
    <x-modal-delete />
</div>

