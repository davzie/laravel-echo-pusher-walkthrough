@extends('layout')

@section('content')
    <div class="container">

        <h1>Posts</h1>

        @foreach($posts as $post)
            @if( $post->isVisible() )
                <div class="post text-center col-xs-6">
                    <h2>{{ $post->title }}</h2>
                    <a href="{{ route('posts.show',$post->id) }}">
                        <img src="{{ $post->image }}" />
                    </a>
                </div>
            @endif
        @endforeach

    </div>
@stop