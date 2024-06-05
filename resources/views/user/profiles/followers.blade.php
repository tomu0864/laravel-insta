@extends('layouts.app')

@section('title', $user->name . " - Followers")

@section('content')
 @include('user.profiles.header')

 @if ($user->followers->isNotEmpty())
   <h4 class="h5 text-secondary text-center">Followers</h4>
   <div class="row justify-content-center">
     <div class="col-4">
       
          @foreach ($user->followers as $follower)
          <div class="row mb-3">
            <div class="col-auto">
                {{-- avatar/icon --}}
                @if($follower->follower->avatar)
                    <img src="{{ $follower->follower->avatar }}" alt="" class="rounded-circle avatar-sm">
                @else
                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                @endif 
            </div>
            <div class="col ps-0 text-truncate">
                {{-- user name --}}
                <a href="{{ route('profile.show', $follower->follower->id)}}" class="text-decoration-none text-dark fw-bold">{{ $follower->follower->name }}</a>
            </div>
            <div class="col-auto ">
              @if($follower->follower->id != Auth::user()->id)
                  @if($follower->follower->isFollowed())
                      <form action="{{ route('follow.destroy',$follower->follower->id)}}" method="post">
                          @csrf 
                          @method('DELETE')
                          <button type="submit" class="bg-transparent p-0 shadow-none border-0 text-secondary">following</button>
                      </form>
                  @else
                      <form action="{{ route('follow.store', $follower->follower->id)}}" method="post">
                          @csrf 
                          <button type="submit" class="bg-transparent p-0 shadow-none border-0 text-primary">Follow</button>
                      </form>
                  @endif
              @endif
          </div>
        </div>
          @endforeach
    
   </div>
 @else
   <h4 class="h5 texxt-secondary text-center">No followers yet.</h4>
 @endif
  
@endsection

