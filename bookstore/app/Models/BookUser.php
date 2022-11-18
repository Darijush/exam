<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookUser extends Model
{
    use HasFactory;
    protected $fillable = ['book_id', 'user_id'];
    public function getBooks()
    {
        return $this->belongsToMany(Book::class, 'book_users', 'user_id', 'book_id');
    }

}
