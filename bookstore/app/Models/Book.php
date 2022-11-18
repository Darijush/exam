<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'summary', 'isbn', 'url', 'pages', 'category_id', 'user_id'];
    const SORT_SELECT = [
        ['title_asc', 'Title A-Z'],
        ['title_decs', 'Title Z-A'],
    ];

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function addPhoto($photo)
    {
        if ($photo) {

            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name . '-' . rand(100000, 999999) . '.' . $ext;
            $photo->move(public_path() . '/images', $file);
            $url = asset('/images') . '/' . $file;
            Book::where('id', $this->id)
                ->update(['url' => $url]);
        }
        return $this;
    }

    public function deletePhoto($photo)
    {
        if ($photo) {
            $url = null;
            Book::where('id', $this->id)
                ->update(['url' => $url]);
            unlink(public_path() . '/images/' . pathinfo($this->url, PATHINFO_FILENAME) . '.' . pathinfo($this->url, PATHINFO_EXTENSION));
        }
        return $this;
    }

    public function updatePhoto($photo)
    {
        if ($photo) {
            if ($this->url) {
                unlink(public_path() . '/images/' . pathinfo($this->url, PATHINFO_FILENAME) . '.' . pathinfo($this->url, PATHINFO_EXTENSION));
            }
            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name . '-' . rand(100000, 999999) . '.' . $ext;
            $photo->move(public_path() . '/images', $file);
            $url = asset('/images') . '/' . $file;
            Book::where('id', $this->id)
                ->update(['url' => $url]);
        }
        return $this;
    }
}
