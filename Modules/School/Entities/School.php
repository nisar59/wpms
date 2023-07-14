<?php

namespace Modules\School\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\WaterQualityTest\Entities\WaterQualityTest;
use Modules\School\Entities\SchoolPlants;

class School extends Model
{
    use HasFactory;

    protected $fillable = ['name','province','district','address','tehsil','emis_code','name_of_focal_person','contact_of_focal_person','relation_of_focal_person','gps_coordinate','school_gender','no_of_students','no_of_male_teachers','no_of_female_teachers','image'];
    protected $table='school';
    
    protected static function newFactory()
    {
        return \Modules\School\Database\factories\SchoolFactory::new();
    }

    public function WaterQualityTest()
    {
      return $this->hasMany(WaterQualityTest::class, 'school_id','id')->orderBy('id','ASC');  
    }

    public function WaterQualityTestSampleCollected()
    {
        return $this->hasOne(WaterQualityTest::class, 'school_id','id')->where('status',1);
    }


    public function SchoolPlants()
    {
        return $this->hasMany(SchoolPlants::class, 'school_id');
    }
    public function SchoolPlantsInProcess()
    {
        return $this->hasMany(SchoolPlants::class, 'school_id')->where('school_plants.status',1);
    }
    public function SchoolPlantsInstalled()
    {
        return $this->hasMany(SchoolPlants::class, 'school_id')->whereNot('school_plants.status',1)->whereNot('school_plants.status',0);
    }

}
