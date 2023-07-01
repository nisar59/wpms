<?php

namespace Modules\WaterQualityTest\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WaterQualityTest extends Model
{
    use HasFactory;

    protected $table='water_quality_test';
    protected $fillable = ['school_id','sample_collected_date','status','test_completed_date','results','remarks'];
    
    protected static function newFactory()
    {
        return \Modules\WaterQualityTest\Database\factories\WaterQualityTestFactory::new();
    }
}
