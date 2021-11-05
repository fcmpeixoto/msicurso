<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PHPUnit\Exception;
use Spatie\Activitylog\Traits\LogsActivity;

class Pedido extends Model
{

    use HasFactory, Uuid, LogsActivity, SoftDeletes;

    protected $table    = 'pedido';
    protected $fillable = [
        'user_id',
        'referencia',
        'code',
        'status',
        'valor',
        'formapagamento',
        'parcelas',
    ];

    protected $dates = ['deleted_at'];

    public static $logAttributes = ['*'];//1|nota geral|recibo|3 nota serviço 0800 282 1309 ou 0800 881 2329];
    protected static $recordEvents  = ['created','updated','deleted'];
    protected $logName  = "Pedido";

    public function getLogNameToUse(string $eventName): string
    {
        if(Auth::check()){
            return Auth::user()->id;
        }else{
            return 'Pedido';
        }

    }

    public function itemnspedido()
    {
        return $this->hasMany(ItemPedido::class,'pedido_id','id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function scopeUser($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    public function newOrderProducts($cart, $reference, $code, $status = 1, $paymentMethod = 2, $parcelas = 12)
    {

        DB::transaction(function () use ($cart, $reference, $code, $status , $paymentMethod , $parcelas) {

            $pedido = self::create([
                'user_id'           => auth()->user()->id,
                'referencia'        => $reference,
                'code'              => $code,
                'status'            => $status,
                'valor'             => Session::get('_cart')->total(),
                'formapagamento'    => $paymentMethod,
                'parcelas'          => $parcelas,
            ]);


            $itemsCart = $cart->getItems();

            foreach ($itemsCart as $item){

                $pedido->itemnspedido()->create([
                    'pedido_id'         => $pedido->id,
                    'produto_id'        => $item['itemDescription']->id,
                    'descricao_produto' => $item['itemDescription']->nome,
                    'quantidade'        => $item['itemQuantity'],
                    'valor'             => $item['itemDescription']->valor
                ]);
            }
        });

    }
    
    public function getStatusAttribute($status)
    {
        $statusA = [
            1 => 'Aguardando pagamento',
            2 => 'Em análise',
            3 => 'Paga',
            4 => 'Disponível',
            5 => 'Em disputa',
            6 => 'Devolvida',
            7 => 'Cancelada',
            8 => 'Debitado',
            9 => 'Retenção temporária',
        ];
        
        return $statusA[$status];
    }
    
    public function getFormapagamentoAttribute($method)
    {
        $paymentsMethods = [
            1 => 'Cartão de crédito',
            2 => 'Boleto',
            3 => 'Débito online (TEF)',
            4 => 'Saldo PagSeguro',
            5 => 'Oi Paggo',
            7 => 'Depósito em conta',
        ];
        
        return $paymentsMethods[$method];
    }
    
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
    
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
    
    public function changeStatus($newStatus)
    {
        $this->status = $newStatus;
        $this->save();
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
}
