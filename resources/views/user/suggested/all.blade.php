@extends('layouts.app')

@section('title', 'Suggested Users')

@section('content')

<div class="row justify-content-center">
  <div class="col-4">
      <input type="text" class="brn form-control mb-3" placeholder="Search names...">
      <div class="col fw-bold mb-3">
        <h5>Suggested</h5>
      </div>

    @foreach($suggested_users as $user)
            <div class="row mb-3">
                <div class="col-auto">
                    <a href="{{ route('profile.show', $user->id)}}">
                        @if($user->avatar)
                            <img src="{{ $user->avatar }}" alt="" class="rounded-circle avatar-md">
                        @else 
                            <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                        @endif 
                    </a>
                </div>
                <div class="col ps-0 text-truncate">
                    <a href="{{ route('profile.show', $user->id)}}" class="text-decoration-none fw-bold text-dark">
                        {{ $user->name }}
                    </a>
                    <p class="mb-0 text-muted">{{ $user->email }}</p>
                    @if ($user->isFollower())
                    <p class="mb-0 text-muted">Follows you</p>
                    @elseif($user->followers->isNotEmpty())
                    <p class="mb-0 text-muted">{{ $user->followers->count() }} {{ $user->followers->count() == 1 ? 'follower' : 'followers'}}</p>
                    @else
                    <p class="mb-0 text-muted">No followers yet</p>
                    @endif
                    
                </div>
                <div class="col-auto align-self-center">
                    <form action="{{ route('follow.store', $user->id)}}" method="post">
                        @csrf 
                        <button type="submit" class="bg-transparent border-0 shadow-none p-0 text-primary">Follow</button>
                    </form>
                </div>
            </div>
        @endforeach
  </div>
</div>
@endsection