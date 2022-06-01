<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded  = ['id'];

    public function category()
    {
        return $this->hasOne(Category::class);
    }
    public function subcategory()
    {
        return $this->hasOne(Subcategory::class);
    }
    public function customer()
    {
        return $this->hasOne(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
