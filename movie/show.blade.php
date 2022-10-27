@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <h2>Movie</h2>
                    </div>
                    <div class="card-body">
                        <div class="movie-show">
                            <div class="line"><small>Title:</small>
                                <h5>{{ $movie->title }}</h5>
                            </div>
                            <div class="line"><small>Price:</small>
                                <h5>{{ $movie->price }}</h5>
                            </div>
                            <div class="line"><small>Category:</small>
                                <h5>{{ $movie->getCategory->title }}</h5>
                            </div>
                            <div class="slideshow-container">
                                @forelse($movie->getPhotos as $photo)
                                    <div class="mySlides fade">
                                        <img src="{{ $photo->url }}" style="width:100%">
                                    </div>
                                @empty
                                    <h2>No photos yet.</h2>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
