@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-5">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Book</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('b_update', $book) }}" method="post" enctype="multipart/form-data">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Title</span>
                                <input type="text" name="title" class="form-control"
                                    value="{{ old('title', $book->title) }}">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">ISBN</span>
                                <input type="text" name="isbn" class="form-control" value="{{ old('isbn', $book->isbn) }}">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Number of pages</span>
                                <input type="text" name="pages" class="form-control" value="{{ old('pages', $book->pages) }}">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Summary</span>
                                <textarea name="summary" class="form-control" value="{{ old('summary', $book->summary) }}"></textarea>
                            </div>
                            <div class="input-group mt-3">
                                <span class="input-group-text">Photo</span>
                                <input type="file" name="photo" class="form-control">
                            </div>
                            @if ($book->url)
                                <div class="img-small mt-3">
                                    <img src="{{ $book->url }}" class="photos">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="del-photo"
                                            name="delete_photo">
                                        <label class="form-check-label" for="del-photo">
                                            Delete photo
                                        </label>
                                    </div>
                                </div>
                            @endif

                            <select name="category_id" class="form-select mt-3">
                                <option value="0">Choose category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($category->id == old('category_id', $book->category_id)) selected @endif>
                                        {{ $category->title }}</option>
                                @endforeach
                            </select>
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-secondary mt-4">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
