<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Endereco extends Model
{
    use HasFactory, Uuid, LogsActivity;

    protected $table = 'endereco';
    protected $fillable = [
        'aluno_id',
        'cep',
        'logradouro',
        'complemento',
        'numero',
        'bairro',
        'localidade',
        'uf',
    ];
    protected $dates = ['deleted_at'];

    public static $logAttributes = ['*'];//1|nota geral|recibo|3 nota serviço 0800 282 1309 ou 0800 881 2329];
    protected static $recordEvents  = ['created','updated','deleted'];
    protected $logName  = "Endereço";

    public function getLogNameToUse(string $eventName): string
    {
        if(Auth::check()){
            return Auth::user()->id;
        }else{
            return 'Gravado pelo Aluno';
        }

    }

    public static $rules = [
        'txtnomeanexo' => 'required|min:5|max:120',
        'txtanexo'     => 'required|mimes:pdf|max:15048',
    ];

    public function aluno()
    {
        return $this->hasOne(Aluno::class);
    }

    public function setCepAttribute($value)
    {

        $this->attributes['cep'] = preg_replace('/[^0-9]/', "", $value);
    }
}
