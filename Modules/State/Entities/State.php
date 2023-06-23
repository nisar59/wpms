<?php

namespace Modules\State\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
    use HasFactory;

    protected $fillable = ['country_id','name'];
    protected $table='states';
    
    protected static function newFactory()
    {
        return \Modules\State\Database\factories\StateFactory::new();
    }
}
