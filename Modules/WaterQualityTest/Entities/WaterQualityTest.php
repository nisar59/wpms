<?php

namespace Modules\WaterQualityTest\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WaterQualityTest extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\WaterQualityTest\Database\factories\WaterQualityTestFactory::new();
    }
}
