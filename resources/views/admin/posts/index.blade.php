@extends('layouts.app')

@section('title', 'Admin: Posts')

@section('content')
 

<div class="row justify-content-end">
  <div class="col-sm-6 col-md-3">
    <form action="{{ route('admin.posts') }}" method="get">
      <input type="search" name="search" class="form-control form-control-sm" placeholder="Search..." autofocus>
    </form>
  </div>
</div>
   {{-- text setting wouldn't be apply for th with bootstrap --}}
   {{-- Use color inherit on style.css--}}
   <table class="table border table-hover bg-white align-middle text-secondary mt-3">
     <thead class="text-secondary table-primary text-uppercase small">
       <tr>
         <th></th>
         <th></th>
         <th>CATEGORY</th>
         <th>OWNER</th>
         <th>CREATED AT</th>
         <th>STATUS</th>
         <th></th>
       </tr>
     </thead>
     <tbody>
        @forelse ($all_posts as $post)

           <tr>
            <td class="text-end">{{ $post->id }}</td>
            <td>
               {{-- avatar/icon --}}
               @if ($post->image)
                 <a href="{{ route('post.show', $post->id) }}"><img src="{{ $post->image }}" alt="" class="image-lg d-block mx-auto"></a>
               @else
                 <i class="fa-solid fa-circle-user icon-md d-block text-secondary text-center"></i>
               @endif
            </td>
            <td>
              @forelse ($post->categoryPosts as $category_post)
               <div class="badge bg-secondary bg-opacity-50">
                 {{ $category_post->category->name }}
               </div>
              @empty
               <div class="badge bg-dark">
                 Uncategorized
               </div>
             @endforelse
            </td>
            <td>
               {{-- Owner Name --}}
               <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none fw-bold text-dark">
                 {{ $post->user->name }}
              </a>
            </td>
            <td>{{ $post->created_at }}</td>
            <td>
              {{-- status --}}
              @if($post->trashed())
              <i class="fa-solid fa-circle-minus text-secondary"></i> Hidden
              @else
                <i class="fa-solid fa-circle text-primary"></i> Visible  
              @endif
            </td>
            <td>
              @if($post->user->id != Auth::user()->id)
              <div class="dropdown">
                <button class="btn btn-sm border-0" data-bs-toggle="dropdown">
                  <i class="fa-solid fa-ellipsis"></i>
                </button>

                <div class="dropdown-menu">
                  @if ($post->trashed())

                    <button class="dropdown-item text-primary" data-bs-toggle="modal" data-bs-target="#unhide-post{{ $post->id }}">
                      <i class="fa-solid fa-eye"></i></i> Unhide post{{ $post->id }}
                    </button>
                  @else

                    <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#hide-post{{ $post->id }}">
                      <i class="fa-solid fa-eye-slash"></i> Hide post{{ $post->id }}
                    </button>

                  @endif
                </div>

                @include('admin.posts.actions')
              </div>
              @endif
            </td>
           </tr>

        @empty
          <tr>
            <td class="text-center" colspan="6">No Posts found.</td>
          </tr>

        @endforelse
     </tbody>
   </table>

   {{ $all_posts->links() }}
  
@endsection