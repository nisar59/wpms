<?php

namespace Modules\School\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolPlantFilters extends Model
{
    use HasFactory;

    protected $table='school_plant_filters';
    protected $fillable = ['school_plant_id','plant_id','filter_id','status','frequency','last_changed_date','next_change_date', 'total_stock','used_stock','available_stock','stock_date'];
    
    protected static function newFactory()
    {
        return \Modules\School\Database\factories\SchoolPlantFiltersFactory::new();
    }

}
