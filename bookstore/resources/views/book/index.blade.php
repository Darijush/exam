@extends('layouts.app')

@section('content')
    <div class="container --content">
        <div class="row justify-content-center">
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <h2>Books</h2>
                        <form action="{{ route('b_index') }}" method="get">
                            <div class="container">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-6">
                                                    {{-- <select name="mech" class="form-select mt-1">
                                                    <option value="0">All</option>
                                                    @foreach ($mechanics as $mechanic)
                                                    <option value="{{$mechanic->id}}" @if ($mech == $mechanic->id) selected @endif>{{$mechanic->name}} {{$mechanic->surname}}</option>
                                                    @endforeach
                                                </select> --}}
                                                </div>
                                                <div class="col-6">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="input-group mb-3">
                                                        {{-- <input type="text" name="s" class="form-control" value="{{$s}}"> --}}
                                                        <button type="submit" class="input-group-text">Search</button>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <a href="{{ route('b_index') }}" class="btn btn-secondary">Reset</a>
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
                                            <h4><span>Price: </span>{{ $book->price }}</h4>
                                            <h5>
                                                <span>Category: </span>
                                                <a href="{{ route('c_show', $book->getCategory->id) }}">
                                                    {{ $book->getCategory->title }}
                                                </a>
                                            </h5>
                                            @if ($book->url)
                                                <h5><a href="{{ $book->url }}" target="_BLANK">Photos</a></h5>
                                            @endif
                                        </div>
                                        <div class="buttons">
                                            <a href="{{ route('b_show', $book) }}" class="btn btn-info">Show</a>
                                            @if (Auth::user()->role >=10)
                                            <a href="{{ route('b_edit', $book) }}" class="btn btn-success">Edit</a>
                                            <form action="{{ route('b_delete', $book) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item">No books found</li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="me-3 mx-3">
                        {{-- {{ $books->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
