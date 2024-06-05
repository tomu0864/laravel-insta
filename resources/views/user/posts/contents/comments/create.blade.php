<form action="{{ route('comment.store', $post->id) }}" method="post" class="mt-2">
  @csrf
  <div class="input-group">
    {{-- without post_id on name, validation error will be shown on every anthor post, Input name should be unique --}}
    <textarea name="comment_body{{ $post->id }}" rows="1" placeholder="add a comment" 
              class="form-control form-control-sm"></textarea>
    <button type="submit" class="btn btn-sm btn-outline-secondary">Post</button>
  </div>
  @error('comment_body' .$post->id)
  <p class="mb-0 text-danger small">{{ $message }}</p>
  @enderror
</form>