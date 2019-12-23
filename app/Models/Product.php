<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{	
	public $fillable = [
        'category_id',
        'brand_id',
        'title',
        'description',
        'slug',
        'quantity',
        'price',
        'status',
        'offer_price',
        'admin_id'         
    ];
    public function images(){

    	return $this->hasMany(ProductImage::class);
    }
    public function category(){

    	return $this->belongsTo(Category::class);
    }

    public function brand(){

    	return $this->belongsTo(Brand::class);
    }
    public function cart(){

        return $this->hasOne(Cart::class);
    } 
} 

