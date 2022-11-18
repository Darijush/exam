@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <h2>Dish</h2>
                </div>
                <div class="card-body">
                    <div class="my-lists">
                        <div class="list-content">
                            <div class="line"><small>Title:</small>
                                <h5>{{$book->title}}</h5>
                            </div>
                            <div class="line"><small>Pages:</small>
                                <h6>{{$book->pages}}</h6>
                            </div>
                            <div class="line"><small>Summary:</small>
                                <h6>{{$book->summary}}</h6>
                            </div>
                            @if($book->url)
                            <div class="line"><small>Photo:</small>
                                <img src="{{$book->url}}" alt="" class="photos">
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
