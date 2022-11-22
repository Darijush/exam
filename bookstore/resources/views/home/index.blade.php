@extends('layouts.app')

@section('content')
    <div class="container --content">
        <div class="row justify-content-center">
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <h2>Books</h2>
                        <form action="{{ route('home_list') }}" method="get">
                            <div class="container search-filter">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-xl-5 col-12">
                                                    <span>Categories</span>
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
                                                    <span>Sort by title</span>
                                                    <select name="sort" class="form-select mt-1">
                                                        <option value="0">All</option>
                                                        @foreach ($sortSelect as $option)
                                                            <option value="{{ $option[0] }}"
                                                                @if ($sort == $option[0]) selected @endif>
                                                                {{ $option[1] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-2 mt-4">
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
                    @forelse($books as $book)
                        <li class="list-group-item nice-item">
                            <div class="item-list">
                                <div class="content">
                                    <h2><span>Title: </span>{{ $book->title }}</h2>
                                    <h4><span>Pages: </span>{{ $book->pages }}</h4>
                                    <h4><span>ISBN(book code): </span>{{ $book->isbn }}</h4>
                                    <h5>
                                        <span>Category: </span>
                                        <a href="{{ route('c_show', $book->getCategory->id) }}">
                                            {{ $book->getCategory->title }}
                                        </a>
                                    </h5>
                                    @if ($book->url)
                                        <h5><a href="{{ $book->url }}" target="_BLANK">Photo</a></h5>
                                    @endif
                                </div>

                                @if ($book->user_id)
                                <h4>Books is reserved</h4>
                                @else
                                <div class="buttons">
                                    <form action="{{ route('reserve_Book', $book) }}" method="post">
                                        <input type="hidden" value="{{$book->id}}">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-info">Reserve</button>
                                    </form>
                                </div>
                                @endif
                                <div class="buttons">
                                    <form action="{{ route('favourite_Book', $book) }}" method="post">
                                        <input type="hidden" value="{{$book->id}}">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-info">Add to favourites</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item">No books found</li>
                    @endforelse
                </ul>
            </div>
            <div class="me-3 mx-3">
                {{ $books->links() }}
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
