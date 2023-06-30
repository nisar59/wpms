<?php

namespace Modules\WaterTestQualityParameter\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WaterTestQualityParameter extends Model
{
    use HasFactory;

    protected $fillable = ['name','parameter'];
    protected $table='water_test_quality_parameters';
    
    protected static function newFactory()
    {
        return \Modules\WaterTestQualityParameter\Database\factories\WaterTestQualityParameterFactory::new();
    }
}
