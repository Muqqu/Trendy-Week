<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class variantTypes extends Model
{
    use HasFactory;
    protected $table = "product_variations";
    public function variationData()
    {
        return $this->hasMany('App\Models\VariationData','variant_type_id','id');
    }
}
