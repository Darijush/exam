@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <h2>Category</h2>
                    </div>
                    <div class="card-body">
                        <div class="categories">
                            <h5>{{ $category->title }}</h5>

                        </div>
                        <ul class="list-group">
                            @forelse($category->hasMovies as $movie)
                                <li class="list-group-item">
                                    <div class="movies-list">
                                        <div class="content">
                                            <h2><span>Title: </span>{{ $movie->title }}</h2>
                                            <h4><span>Price: </span>{{ $movie->price }}</h4>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item">No categories found</li>
                            @endforelse
                        </ul>
                        @if (Auth::user()->role >=10)
                        <div class="buttons mt-2">
                            <form action="{{route('c_delete_movies', $category)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete all movies</button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
