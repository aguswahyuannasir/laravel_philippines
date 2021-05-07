<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\BaseModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BaseModel query()
 * @mixin \Eloquent
 */
class BaseModel extends Model
{
    const CREATED_AT = 'TglRecord';
    const UPDATED_AT = 'TglUpdate';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            if (array_key_exists('IdUserUpdate', $model->getAttributes())) {
                if (auth()->user() == null) 
                    $model->IdUserUpdate = 0;
                else
                    $model->IdUserUpdate = auth()->user()->getAuthIdentifier();
            }
        });

        static::creating(function ($model) {
            if (auth()->user() == null) 
                $model->IdUserRecord = 0;
            else
                $model->IdUserRecord = auth()->user()->getAuthIdentifier();
        });
    }

    public function setAttribute($key, $value)
    {
        return parent::setAttribute(Str::studly($key), $value);
    }
}
