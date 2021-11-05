<div class="form-row">
    <div class="form-group col-8 col-md-8 col-lg-8">
        <x-input-min-maxlength ncampo="txtnomecurso" legenda="Nome do Curso" min="15" max="120"/>
    </div>
    <div class="form-group col-4 col-md-4 col-lg-4">
        <x-input-numerico ncampo="txtquantidadecurso" legenda="Quantidade de Inscritos" />
    </div>

    <div class="form-group col-12 col-md-12 col-lg-12">
        <x-text-area-editor ncampo="txtdescricaocurso" legenda="Descricão" />
    </div>
    <div class="form-group col-4 col-md-4 col-lg-4">
        <x-input-monetario ncampo="txtvalorcurso" legenda="Valor do Curso" />
    </div>
    <div class="form-group col-4 col-md-4 col-lg-4">
        <x-input-datapiker ncampo="txtdatainicio" legenda="Data de Ínicio das Inscrições" />
    </div>
    <div class="form-group col-4 col-md-4 col-lg-4">
        <x-input-datapiker ncampo="txtdatafim" legenda="Data de Fim das Inscrições" />
    </div>


</div>

