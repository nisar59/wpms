<?php

namespace Modules\Plants\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Plants\Entities\PlantsFilter;

class PlantsFilter extends Model
{
    use HasFactory;

    protected $fillable = ['plant_id','filter_id'];
    protected $table ='plant_filters';
    
    protected static function newFactory()
    {
        return \Modules\Plants\Database\factories\PlantsFilterFactory::new();
    }
    
    
}
