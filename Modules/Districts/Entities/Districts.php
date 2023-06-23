<?php

namespace Modules\Districts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Districts extends Model
{
    use HasFactory;

    protected $fillable = ['country_id','state_id','name'];
    protected $table='districts';
    
    protected static function newFactory()
    {
        return \Modules\Districts\Database\factories\DistrictsFactory::new();
    }
}
