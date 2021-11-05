<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Anexos extends Model
{
    use HasFactory, Uuid, LogsActivity;

    protected $fillable = [
        'titulo',
        'caminho'
    ];
    protected $dates = ['deleted_at'];

    public static $logAttributes = ['*'];//1|nota geral|recibo|3 nota serviço 0800 282 1309 ou 0800 881 2329];
    protected static $recordEvents  = ['created','updated','deleted'];
    protected $logName  = "Anexos";

    public function getLogNameToUse(string $eventName): string
    {
        return Auth::user()->id;
    }

    public static $rules = [
        'txtnomeanexo' => 'required|min:5|max:120',
        'txtanexo'     => 'required|mimes:pdf|max:15048',
    ];

    public function curso()
    {
        return $this->belongsToMany(Cursos::class);
    }

    public function getCreatedAtAttribute($value)
    {
        setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
        date_default_timezone_set( 'America/Sao_Paulo' );

        return Carbon::parse($value)->format('d/m/Y');
    }
}
