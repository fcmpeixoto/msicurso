<?php


namespace App\Services;


use Illuminate\Support\Facades\Storage;

class ArquivosUpload
{
    public static function upload($cusroId, $anexo)
    {

        $novoNome = null;

        $noArquivo = uniqid(date('HisYmd'));

        $extensaoArquivo = $anexo->clientExtension();

        $novoNome = "{$noArquivo}.{$extensaoArquivo}";

        if(!Storage::disk('anexo')->exists($cusroId))
        {
            Storage::disk('anexo')->makeDirectory($cusroId);
        }

        Storage::disk('anexo')->put("{$cusroId}/{$novoNome}");

        return $noArquivo;
    }
}
