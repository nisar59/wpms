<?php

namespace Modules\Filters\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Filters extends Model
{
    use HasFactory;

    protected $fillable = ['name','filter_change_frequency'];
    protected $table='filter';
    
    protected static function newFactory()
    {
        return \Modules\Filters\Database\factories\FiltersFactory::new();
    }
}
