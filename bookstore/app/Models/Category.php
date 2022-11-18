<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['title'];
    public function hasBooks()
    {
        return $this->hasMany(Book::class, "category_id", 'id');
    }
}
