<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Uuid, LogsActivity, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
    ];

    public static $logAttributes = ['*'];//1|nota geral|recibo|3 nota serviço 0800 282 1309 ou 0800 881 2329];
    protected static $recordEvents  = ['created','updated','deleted'];
    protected $logName  = "User";

    public function getLogNameToUse(string $eventName): string
    {
        if(Auth::check()){
            return Auth::user()->id;
        }else{
            return 'Gravado pelo Aluno';
        }

    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function aluno()
    {
        return $this->hasOne(Aluno::class,'users_id');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class,'user_id');
    }

}
