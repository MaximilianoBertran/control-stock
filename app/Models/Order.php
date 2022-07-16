<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'orders';
    
    protected $fillable = [
        'admin_id'
    ];

    public function products() {
        return $this->belongsToMany(Product::class);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }
}
