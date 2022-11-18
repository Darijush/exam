@extends('layouts.app')

@section('content')
<div class="container --content">
    <div class="row justify-content-center">
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <h2>Categories</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($categories as $category)
                        <li class="list-group-item">
                            <div class="categories-list">
                                <div class="content">
                                    <h2>{{$category->title}}</h2>
                                    <small>{{{$category->hasMovies()->count()}}}</small>
                                </div>
                                <div class="buttons">
                                    <a href="{{route('c_show', $category)}}" class="btn btn-info">Show</a>
                                    @if (Auth::user()->role >=10)
                                    <a href="{{route('c_edit', $category)}}" class="btn btn-success">Edit</a>
                                    <form action="{{route('c_delete', $category)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">No categories found</li>
                        @endforelse
                    </ul>
                </div>
                <div class="me-3 mx-3">
                    {{-- {{ $categories->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
