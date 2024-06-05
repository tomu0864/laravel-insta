@extends('layouts.app')

@section('title', $user->name . " - Following")

@section('content')
 @include('user.profiles.header')

 @if ($user->follows->isNotEmpty())

   <h4 class="h5 text-secondary text-center">Following</h4>
   <div class="row justify-content-center">
     <div class="col-4">
        
          @foreach ($user->follows as $follow)
          <div class="row mb-3">
            <div class="col-auto">
                {{-- avatar/icon --}}
                @if($follow->user->avatar)
                    <img src="{{$follow->user->avatar }}" alt="" class="rounded-circle avatar-sm">
                @else
                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                @endif 
            </div>
            <div class="col ps-0 text-truncate">
                {{-- user name --}}
                <a href="{{ route('profile.show', $follow->user->id)}}" class="text-decoration-none text-dark fw-bold">{{$follow->user->name }}</a>
            </div>
            <div class="col-auto ">
              @if($follow->user->id != Auth::user()->id)
                  @if($follow->user->isFollowed())
                      <form action="{{ route('follow.destroy',$follow->user->id)}}" method="post">
                          @csrf 
                          @method('DELETE')
                          <button type="submit" class="bg-transparent p-0 shadow-none border-0 text-secondary">following</button>
                      </form>
                  @else
                      <form action="{{ route('follow.store', $follow->user->id)}}" method="post">
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

