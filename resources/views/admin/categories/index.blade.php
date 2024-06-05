@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')


    <div class="row">
      <div class="col-12 col-md-5">
        <form action="{{ route('admin.categories.store') }}" method="post" class="d-flex align-items-center">
          @csrf
          <input type="text" name="category" class="form-control me-2 flex-grow-1" value="{{ old('category') }}" placeholder="Add a category...">
          <button type="submit" class="btn btn-primary flex-shrink-0">
            <i class="fa-solid fa-plus"></i> Add
          </button>
        </form>
        @error('category')
          <p class="text-danger">{{ $message }}</p>
        @enderror
      </div>
    </div>


   {{-- text setting wouldn't be apply for th with bootstrap --}}
   {{-- Use color inherit on style.css--}}
   <table class="table border table-hover bg-white align-middle text-secondary text-center mt-4">
     <thead class="text-secondary table-warning text-uppercase small">
       <tr>
         <th>#</th>
         <th>NAME</th>
         <th>COUNT</th>
         <th>LAST UPDATED</th>
         <th></th>
       </tr>
     </thead>
     <tbody>
        @forelse ($all_categories as $category)

           <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ count($category->categoryPosts) }}</td>
            <td>{{ $category->updated_at }}</td>
            <td>
              <button class="btn btn-outline-warning me-1 mb-1" data-bs-toggle="modal" data-bs-target="#edit-cat{{ $category->id }}">
                <i class="fa-solid fa-pencil"></i>
              </button>
          
              <button href="" class="btn btn-outline-danger me-1 mb-1" data-bs-toggle="modal" data-bs-target="#delete-cat{{ $category->id }}">
                <i class="fa-solid fa-trash-can"></i>
              </button>
            </td>
           </tr>
           @include('user.posts.contents.modals.category')

        @empty
          <tr>
            <td class="text-center" colspan="5">No Posts found.</td>
          </tr>

        @endforelse
        <tr>
          <td>0</td>
          <td>Uncategorized</td>
          <td>{{ $uncategorized_count }}</td>
          <td></td>
          <td></td>
        </tr>
     </tbody>
   </table>

   {{ $all_categories->links() }}
  
@endsection