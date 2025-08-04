<?php

namespace App\Models;

use App\Models\Upazila;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $guarded =['id'];

    public function upazilas(){
        return $this->hasMany(Upazila::class);
    }
}
