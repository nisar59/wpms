<?php

namespace Modules\School\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class School extends Model
{
    use HasFactory;

    protected $fillable = ['name','province','district','address','tehsil','emis_code','name_of_focal_person','contact_of_focal_person','gps_coordinate','school_gender','no_of_male_teachers','no_of_female_teachers'];
    protected $table='school';
    
    protected static function newFactory()
    {
        return \Modules\School\Database\factories\SchoolFactory::new();
    }
}
