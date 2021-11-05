<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class ItemPedido extends Model
{
    use HasFactory, Uuid, LogsActivity, SoftDeletes;

    protected $table    = 'item_pedido';
    protected $fillable = [
        'pedido_id',
        'produto_id',
        'descricao_produto',
        'quantidade',
        'valor'
    ];
    protected $dates = ['deleted_at'];

    public static $logAttributes = ['*'];//1|nota geral|recibo|3 nota serviço 0800 282 1309 ou 0800 881 2329];
    protected static $recordEvents  = ['created','updated','deleted'];
    protected $logName  = "Itens do Pedido";

    public function getLogNameToUse(string $eventName): string
    {
        if(Auth::check()){
            return Auth::user()->id;
        }else{
            return 'Itens do Pedido';
        }

    }

    public function pedidos()
    {
        return $this->hasOne(Pedido::class);
    }

    public function curso()
    {
        return $this->hasOne(Cursos::class,'id','produto_id');
    }

    public static $rules = [
        'txtnomeanexo' => 'required|min:5|max:120',
        'txtanexo'     => 'required|mimes:pdf|max:15048',
    ];

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
}
