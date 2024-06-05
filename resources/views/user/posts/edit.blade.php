@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
  <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <p class="fw-bold mb-1">
      Category <span class="fw-light">
        (up to 3)
      </span>
    </p>
    <div>
      @if ($all_categories)
        @foreach ($all_categories as $category)
        <div class="form-check form-check-inline">
          @if (in_array($category->id, $selected_categories))
            {{-- Checked --}}
            <input type="checkbox" name="categories[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input" checked>
            <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
          @else
          
          <input type="checkbox" name="categories[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input">
          <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
          @endif
        </div>
        @endforeach
      @endif
    </div>
    @error('categories')
      <p class="mb-0 text-danger small">{{ $message }}</p>
    @enderror

    <label for="description" class="form-label fw-bold mt-3">Description</label>
    <textarea name="description" id="description" class="form-control" placeholder="What's on your mind" rows="3">{{ old('description', $post->description) }}</textarea>
    @error('description')
    <p class="mb-0 text-danger small">{{ $message }}</p>
    @enderror

    <label for="image" class="form-label fw-bold mt-3">Image</label>
    <div class="row">
      <div class="col-6">
    <img src="{{ $post->image }}" alt="{{ $post->title }}" class="img-thumbnail mb-2">
    <input type="file" name="image" id="image" class="form-control">
    <p class="form-text">
      Acceptable formats: jpeg, jpg, png, gif only <br>
      Max size is 1048KB
    </p>
    @error('image')
    <p class="mb-0 text-danger small">{{ $message }}</p>
    @enderror
      </div>
    </div>

    <button type="submit" class="btn btn-warning mt-4 px-4">Save</button>
  </form>
@endsection