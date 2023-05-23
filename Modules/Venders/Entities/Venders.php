<?php

namespace Modules\Venders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Venders extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','phone','province','district','gps_coordinates','shop_or_business_address'];
    protected $table='venders';
    
    protected static function newFactory()
    {
        return \Modules\Venders\Database\factories\VendersFactory::new();
    }
}
