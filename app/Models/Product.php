<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';
    
    protected $fillable = [
        'name',
        'code',
        'stock'
    ];

    public static function rules($id = null) {
        return [
            'name' => 'required',
            'code' => 'required|integer|unique:products,code,' . ($id ?: 'NULL'),
            'stock' => 'required|min:0'
        ];
    }
}
