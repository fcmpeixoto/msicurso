<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;
trait Uuid
{
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $model->keyType = 'string';
            $model->incrementing = false;

            //$model->uuid = RamseyUuid::uuid4();
            $model->{$model->getKeyName()} = $model->{$model->getKeyName()} ?: (string) Str::orderedUuid();
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
