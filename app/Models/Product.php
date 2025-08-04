<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function getFinalPriceAttribute()
    {
        $final_price = $this->regular_price;

        if ($this->discount_price > 0) {
            if ($this->discount_type === 'percent') {
                $final_price -= ($this->regular_price * $this->discount_price) / 100;
            } elseif ($this->discount_type === 'flat') {
                $final_price -= $this->discount_price;
            }
        }

        return $final_price;
    }


}
