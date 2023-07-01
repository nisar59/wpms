<?php

namespace Modules\Donors\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donors extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','phone','country','state','district','address'];
    protected $table='donors';
    
    protected static function newFactory()
    {
        return \Modules\Donors\Database\factories\DonorsFactory::new();
    }
}
