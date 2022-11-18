<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'category.index',
            [
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
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Category::create([
            'title' => $request->title,
        ]);

        return redirect()->route('c_index')->with('ok', 'Category created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('category.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->update([
            'title' => $request->title,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->hasBooks()->count()) {
            return redirect()->route('c_index')->with('not', 'There are books in this category, can not delete it.');
        }
        $category->delete();
        return redirect()->route('c_index')->with('ok', 'Category deleted');
    }
    public function destroyAll(Category $category)
    {

        $ids = $category->hasBooks()->pluck('id')->all();
        $books = Book::where('id',$ids)->get();
        foreach($books as $book){
            unlink(public_path() . '/images/' . pathinfo($book->url, PATHINFO_FILENAME) . '.' . pathinfo($book->url, PATHINFO_EXTENSION));
        }
        Book::destroy($ids);
        return redirect()->route('c_index')->with('ok', 'Books deleted');
    }
}
