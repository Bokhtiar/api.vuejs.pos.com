<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Company;

class Product extends Model
{
    use HasFactory;
    protected $guarded;

    public function category(){
      return $this->belongsTo(Category::class);
    }

    public function brand(){
      return $this->belongsTo(Brand::class);
    }

    public function company(){
      return $this->belongsTo(Company::class);
    }

}
