@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-5">
                <div class="card">
                    <div class="card-header">
                        <h2>New Movie</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('m_store') }}" method="post" enctype="multipart/form-data">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Title</span>
                                <input type="text" name="title" class="form-control" value="{{ old('maker') }}">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Price</span>
                                <input type="text" name="price" class="form-control" value="{{ old('plate') }}">
                            </div>
                            <select name="category_id" class="form-select mt-3">
                                <option value="0">Choose category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($category->id == old('category_id')) selected @endif>
                                        {{ $category->title }}</option>
                                @endforeach
                            </select>
                            <div data-clone class="input-group mt-3">
                                <span class="input-group-text">Photo</span>
                                <input type="file" name="photo[]" multiple class="form-control">
                            </div>
                            @csrf
                            <button type="submit" class="btn btn-secondary mt-3">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
