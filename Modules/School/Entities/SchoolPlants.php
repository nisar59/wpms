<?php

namespace Modules\School\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolPlants extends Model
{
    use HasFactory;

    protected $fillable = ['plant_id','school_id'];
    protected $table='school_plants';
    
    protected static function newFactory()
    {
        return \Modules\School\Database\factories\SchoolPlantsFactory::new();
    }
}
