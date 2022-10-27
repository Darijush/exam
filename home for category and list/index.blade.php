@extends('layouts.app')

@section('content')
    <div class="container --content">
        <div class="row justify-content-center">
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <h2>Movie</h2>
                        <form action="{{ route('home_list') }}" method="get">
                            <div class="container search-filter">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-xl-5 col-12">
                                                    <select name="cat" class="form-select mt-1">
                                                        <option value="0">All</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                @if ($cat == $category->id) selected @endif>
                                                                {{ $category->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-xl-5 col-12">
                                                    <select name="sort" class="form-select mt-1">
                                                        <option value="0">All</option>
                                                        @foreach ($sortSelect as $option)
                                                            <option value="{{ $option[0] }}"
                                                                @if ($sort == $option[0]) selected @endif>
                                                                {{ $option[1] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-2 mt-1">
                                                    <button type="submit" class="input-group-text">Sort</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        </form>
                        <form action="{{ route('home_list') }}" method="get">
                            <div class="col-9 mt-3">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xl-8 col-12">
                                            <div class="input-group mb-3">
                                                <input type="text" name="s" class="form-control"
                                                    value="{{ $s }}">
                                                <button type="submit" class="input-group-text">Search</button>
                                            </div>
                                        </div>
                                        <div class="col-2 ml-5">
                                            <a href="{{ route('home_list') }}" class="btn btn-secondary">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="card-body">
                <ul class="list-group nice-list">
                    @forelse($movies as $movie)
                        <li class="list-group-item nice-item">
                            <div class="item-list">
                                <div class="content">
                                    <h2><span>Title: </span>{{ $movie->title }}</h2>
                                    <h4><span>Price: </span>{{ $movie->price }}</h4>
                                    <h5>
                                        <span>Category: </span>
                                        <a href="{{ route('c_show', $movie->getCategory->id) }}">
                                            {{ $movie->getCategory->title }}
                                        </a>
                                    </h5>
                                    @if ($movie->getPhotos()->count())
                                        <h5><a href="{{ $movie->lastImageUrl() }}" target="_BLANK">Photos:
                                                {{ $movie->getPhotos()->count() }}</a></h5>
                                                <div class="slideshow-container">
                                                    @forelse($movie->getPhotos as $photo)
                                                        <div class="mySlides fade">
                                                            <img src="{{ $photo->url }}" style="width:100%">
                                                        </div>
                                                    @empty
                                                        <h2>No photos yet.</h2>
                                                    @endforelse
                                                </div>
                                    @endif
                                    <h4><span>Rating: </span>{{ $movie->rating ?? 'No rating' }}</h4>
                                </div>

                                <div class="buttons">
                                    <form action="{{ route('rate', $movie) }}" method="post">
                                        <select name="rate">
                                            @foreach (range(1, 10) as $value)
                                                <option value="{{ $value }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-info">Rate</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item">No movies found</li>
                    @endforelse
                </ul>
            </div>
            <div class="me-3 mx-3">
                {{-- {{ $movies->links() }} --}}
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
