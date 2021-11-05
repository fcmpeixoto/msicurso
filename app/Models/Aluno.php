<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Aluno extends Model
{
    use HasFactory, Uuid, LogsActivity;

    protected $fillable = [
        'users_id',
        'tipo_pessoa',
        'matricula',
        'cpf',
        'data_nascimento',
        'telefone',
        'celular'
    ];
    protected $dates = ['deleted_at'];

    public static $logAttributes = ['*'];//1|nota geral|recibo|3 nota serviço 0800 282 1309 ou 0800 881 2329];
    protected static $recordEvents  = ['created','updated','deleted'];
    protected $logName  = "Aluno";

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

    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }

    public function cursos()
    {
        return $this->belongsToMany(Cursos::class,'alunos_cursos','alunos_id')->withPivot('autorizado','code_verificacao');
    }

    public function setDataNascimentoAttribute($value)
    {
        setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
        date_default_timezone_set( 'America/Sao_Paulo' );

        $date    = str_replace('/', '-', $value);
        $newDate = date("Y-m-d", strtotime($date));

        $this->attributes['data_nascimento'] = $newDate;
    }

    public function getDataNascimentoAttribute($value)
    {
        setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
        date_default_timezone_set( 'America/Sao_Paulo' );

        return Carbon::parse($value)->format('d/m/Y');
    }

    public function setCepAttribute($value)
    {

        $this->attributes['cep'] = preg_replace('/[^0-9]/', "", $value);
    }

    public function getCepAttribute($value)
    {

        return getCep($value);
    }

    public function setCpfAttribute($value)
    {

        $this->attributes['cpf'] = preg_replace('/[^0-9]/', "", $value);
    }

    public function getCpfAttribute($value)
    {
        return getCpfCnpj($value);
    }

    public function setTelefoneAttribute($value)
    {
       //$novoValor = preg_replace('/[^0-9]/', "", $value);
        $this->attributes['telefone'] = preg_replace('/[^0-9]/', "", $value);
    }

    public function getTelefoneAttribute($value)
    {
        return getFixoCelular($value);
    }

    public function setCelularAttribute($value)
    {

        $this->attributes['celular'] = preg_replace('/[^0-9]/', "", $value);
    }

    public function getCelularAttribute($value)
    {
        return getFixoCelular($value);
    }

    public function getTipoPessoaAttribute($value)
    {
        $tipopessoa = [
            1 => 'Estudante',
            2 => 'Profissional',
            3 => 'Associado',
        ];

        return $tipopessoa[$value];
    }
}
