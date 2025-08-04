<?php

namespace App\Models;

use App\Models\District;
use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
    protected $guarded = ['id'];

    public function district()
    {
        return $this->belongsTo(District::class); // An upazila belongs to a district
    }
}
