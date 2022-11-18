<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookUser;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function homeList(Request $request)
    {
        //filter
        if ($request->s) {
            $search = explode(' ', $request->s);
            if (count($search) == 1) {
                $books = Book::where('title', 'like', '%' . $request->s . '%');
            } else {
                $books = Book::where('title', 'like', '%' . $search[0] . '%' . $search[1] . '%')
                    ->orWhere('title', 'like', '%' . $search[1] . '%' . $search[0] . '%')
                    ->orWhere('title', 'like', '%' . $search[0] . '%')
                    ->orWhere('title', 'like', '%' . $search[1] . '%');
            }
        } else {
            $books = Book::where('id', '>', 0);
        }
        //sort
        if ($request->sort == 'title_asc') {
            $books = $books->orderBy('title');
        } elseif ($request->sort == 'title_desc') {
            $books = $books->orderBy('rating', 'desc');
        } elseif ($request->sort == 'price_asc') {
            $books = $books->orderBy('price');
        } elseif ($request->sort == 'price_desc') {
            $books = $books->orderBy('price', 'desc');
        }
        return view('home.index', [
            'books' => $books->get(),
            'categories' => Category::orderBy('title', 'asc')->get(),
            'cat' => $request->cat ?? 0,
            'sort' => $request->sort ?? 0,
            'sortSelect' => Book::SORT_SELECT,
            's' => $request->s ?? ''
        ]);
    }
    public function reserveBook(Book $book, Auth $user)
    {
        $book->update([
            'user_id' => $user->id,
        ]);
        return redirect()->route('b_index');
    }

    public function addFavouriteBook(Book $book, Auth $user)
    {
        BookUser::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
        ]);

        return redirect()->route('b_index');
    }
}
