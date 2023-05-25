<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes; 
    use HasFactory; 
    protected $table = 'products';
    protected $fillable = ['name', 'price', 'quantity', 'description','deleted_at','category_id'];

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }
}
