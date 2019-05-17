@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <a href='#'> {{$thread->creator->name}} </a> posted:
                {{$thread->title}}</div>

                <div class="card-body">
                    {{$thread->body}}
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
    @foreach ($thread->replies as $reply)
        @include ('threads.reply')
    @endforeach
    </div>

    @if (auth()->check())
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method='POST' action="{{ $thread->path() . '/replies' }}">

            @csrf

            <div class="form-group">
                <textarea class="form-control" name="body" id="body" placeholder="Have something to say?" rows="5"></textarea>
            </div>

            <button type="submit" class="btn btn-primary mb-2">Post</button>

            </form>
        </div>
    </div>
    @else
    <p class="text-center">Please <a href="{{route('login')}}">sign in</a> to particioate in this discussion</p>
    @endif
</div>
@endsection
