<?php

namespace Modules\School\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Plants\Entities\Plants;
use Modules\Vendors\Entities\Vendors;

class SchoolPlants extends Model
{
    use HasFactory;
    
    protected $table='school_plants';
    protected $fillable = ['school_id','plant_id','vendor_id','donor_id','estimated_cost','status'];
    
    protected static function newFactory()
    {
        return \Modules\School\Database\factories\SchoolPlantsFactory::new();
    }


    public function Plant()
    {
       return $this->hasOne(Plants::class,'id','plant_id');
    }

    public function Vendor()
    {
        return $this->hasOne(Vendors::class, 'id','vendor_id');
    }

}
