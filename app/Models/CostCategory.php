<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CostCategory extends Model
{
    protected $guarded = ['id'];

    public function costs()
    {
        return $this->hasMany(Cost::class, 'category_id', 'id');
    }
}
