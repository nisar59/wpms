<?php

namespace Modules\Country\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $table='country';
    protected static function newFactory()
    {
        return \Modules\Country\Database\factories\CountryFactory::new();
    }
}
