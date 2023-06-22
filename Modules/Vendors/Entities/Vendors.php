<?php

namespace Modules\Vendors\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendors extends Model
{
    use HasFactory;

    protected $table='vendors';
    protected $fillable = ['name','email','phone','province','district','shop_or_business_address','dealing_in'];
    
    protected static function newFactory()
    {
        return \Modules\Vendors\Database\factories\VendorsFactory::new();
    }
}
