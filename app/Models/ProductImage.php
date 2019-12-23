<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
	public $fillable = [
        'product_id',
        'image_id'
                 
    ];
   public function product(){
    	return $this->belongsTo(Product::class);
    }
}
