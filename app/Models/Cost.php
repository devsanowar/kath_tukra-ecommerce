<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(CostCategory::class, 'category_id');
    }
    public function fieldOfCost()
    {
        return $this->belongsTo(FieldOfCost::class, 'field_of_cost_id');
    }
}
