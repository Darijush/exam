<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Category;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'book.index',
            [
                'books' => Book::orderBy('created_at', 'desc')->get(),
                'categories' => Category::orderBy('created_at', 'desc')->get(),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create', [
            'categories' => Category::orderBy('created_at', 'desc')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Book::create([
            'title' => $request->title,
            'summary' => $request->summary,
            'isbn' => $request->isbn,
            'pages' => $request->pages,
            'category_id' => $request->category_id,
        ])->addPhoto($request->file('photo'));

        return redirect()->route('b_index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('book.show', [
            'book' => $book,
            'categories' => Category::orderBy('created_at', 'desc')->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('book.edit', [
            'book' => $book,
            'categories' => Category::orderBy('created_at', 'desc')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request; $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $book
        ->deletePhoto($request->delete_photo)
        ->updatePhoto($request->file('photo'));
        $book->update([
            'title' => $request->title,
            'summary' => $request->summary,
            'isbn' => $request->isbn,
            'pages' => $request->pages,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('b_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        if ($book->url) {
            $book->deletePhoto($book->url);
        }
        $title = $book->title;
        $book->delete();
        return redirect()->route('b_index')->with('ok', "$title book deleted!");
    }
}
