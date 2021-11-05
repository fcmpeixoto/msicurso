<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Cursos extends Model
{
    use HasFactory, Uuid, LogsActivity, SoftDeletes;

    protected $fillable = [
        'nome',
        'descricao',
        'valor',
        'data_inicio',
        'data_fim',
        'qtd_inscritos',
    ];
    protected $dates = ['deleted_at'];

    public static $logAttributes = ['*'];//1|nota geral|recibo|3 nota serviço 0800 282 1309 ou 0800 881 2329];
    protected static $recordEvents  = ['created','updated','deleted'];
    protected $logName  = "Curso";

    public function getLogNameToUse(string $eventName): string
    {
        return Auth::user()->id;
    }

    public function anexos()
    {
        return $this->belongsToMany(Anexos::class);
    }

    public function setValorAttribute($value)
    {
        $valures =  preg_replace('/[^0-9]/', "", $value);

        $this->attributes['valor'] = number_format($valures , 2, '.', '');
    }

    public function getValorAttribute($value)
    {
        $valor =  number_format($value , 2, ',', '.');

        return number_format($value , 2, ',', '.');
    }

    public function setDataInicioAttribute($value)
    {
        setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
        date_default_timezone_set( 'America/Sao_Paulo' );

        $date    = str_replace('/', '-', $value);
        $newDate = date("Y-m-d", strtotime($date));

        $this->attributes['data_inicio'] = $newDate;
    }

    public function getDataInicioAttribute($value)
    {
        setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
        date_default_timezone_set( 'America/Sao_Paulo' );

        return Carbon::parse($value)->format('d/m/Y');
    }

    public function setDataFimAttribute($value)
    {
        setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
        date_default_timezone_set( 'America/Sao_Paulo' );

        $date    = str_replace('/', '-', $value);
        $newDate = date("Y-m-d", strtotime($date));

        $this->attributes['data_fim'] = $newDate;
    }

    public function getDataFimAttribute($value)
    {
        setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
        date_default_timezone_set( 'America/Sao_Paulo' );

        return Carbon::parse($value)->format('d/m/Y');
    }

}
