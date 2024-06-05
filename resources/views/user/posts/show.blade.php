@extends('layouts.app')

@section('title', 'show Post')

<style>
  .col-4{
    overflow-y: scroll;
  }
  .card-body {
    position: absolute;
    top: 65px;
  }
</style>

@section('content')
  <div class="row shadow border">
    <div class="col p-0 border-end">
      <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-100">
    </div>
    <div class="col-4 px-0 bg-white">
      <div class="card border-0">
        @include('user.posts.contents.title')
        <div class="card-body w-100">
          @include('user.posts.contents.body')

          {{-- Comments --}}
          @include('user.posts.contents.comments.create')

          @foreach ($post->comments as $comment)
            @include('user.posts.contents.comments.list-item')
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection