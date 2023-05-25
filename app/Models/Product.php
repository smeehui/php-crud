<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'price', 'quantity', 'description','deleted_at'];

    use SoftDeletes;
    public function getPrice() {
        if($this->price != '') {
            return $this->format_price($this->price);
        }else{
            return 'Liên hệ';
        }
    }
    public function format_price($price) {
        if ($price == 0) {
            return "Liên hệ";
        }else{
            return number_format($price, '.', '.').' VND';
        }
    }
}
