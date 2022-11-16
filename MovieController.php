<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Models\Category;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('movie.index', [
            'movies' => Movie::orderBy('updated_at', 'desc')->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movie.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|unique:movies|max:255|min:3',
                'price' => 'required|numeric|min:1|max:200',
                'photo.*' => 'sometimes|required|image|max:2048',
            ],
            [
                'title' => 'required',
                'title.min' => 'too short',
                'title.unique' => 'exists',
                'price.required' => 'price please',
            ]
        );

        Movie::create([
            'title' => $request->title,
            'price' => $request->price,
        ])->addImages($request->file('photo'));

        return redirect()->route('m_index')->with('ok', 'All good!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return view('movie.show', [
            'movie' => $movie,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        return view('movie.edit', [
            'movie' => $movie,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request;  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        $request->validate(
            [
                'title' => 'required|max:255|min:3',
                'price' => 'required|numeric|min:1|max:200',
                'photo.*' => 'sometimes|required|image|max:2048',
            ],
            [
                'title' => 'required',
                'title.min' => 'too short',
                'title.unique' => 'exists',
                'price.required' => 'price please',
            ]
        );
        $title = $movie->title;
        $movie->update(
            [
                'title' => $request->title,
                'price' => $request->price,
            ]
        );
        $movie
            ->removeImages($request->delete_photo)
            ->addImages($request->file('photo'));

        return redirect()->route('m_index')->with('ok', "$title updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        if ($movie->getPhotos()->count()) {
            $delIds = $movie->getPhotos()->pluck('id')->all();
            $movie->removeImages($delIds);
        }
        $title = $movie->title;
        $movie->delete();
        return redirect()->route('m_index')->with('ok', "$title gone!");
    }
}
