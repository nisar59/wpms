<?php

namespace Modules\Stock\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory;
    
    protected $table='stocks';
    protected $fillable = ['school_id', 'filter_id', 'no_of_filter','used_filters','available_filters','received_date'];
    
    protected static function newFactory()
    {
        return \Modules\Stock\Database\factories\StockFactory::new();
    }
}
