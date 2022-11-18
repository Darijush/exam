@extends('layouts.app')

@section('content')
    <div class="container --content">
        <div class="row justify-content-center">
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <h2>Reserved Books</h2>
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
                                                <h5><a href="{{ $book->url }}" target="_BLANK">Photo</a></h5>
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
