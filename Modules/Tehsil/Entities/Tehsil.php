<?php

namespace Modules\Tehsil\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tehsil extends Model
{
    use HasFactory;

    protected $fillable = ['country_id','state_id','district_id','name'];
    protected $table='tehsil';
    
    protected static function newFactory()
    {
        return \Modules\Tehsil\Database\factories\TehsilFactory::new();
    }
}
