<?php

namespace Modules\Plants\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Plants\Entities\PlantsFilter;
use Modules\Filters\Entities\Filters;
class Plants extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $table='plants';
    
    protected static function newFactory()
    {
        return \Modules\Plants\Database\factories\PlantsFactory::new();
    }

    public function filters()
    {
        return $this->belongsToMany(Filters::class, PlantsFilter::class, 'plant_id','filter_id');
    }
    
}
