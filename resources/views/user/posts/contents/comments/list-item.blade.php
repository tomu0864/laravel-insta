<div class="mb-2">
  <a href="{{ route('profile.show', $comment->user->id) }}" class="text-decoration-none text-dark fw-bold">
    {{ $comment->user->name }}
  </a>
  &nbsp;
  <span class="fw-light">{{ $comment->body }}</span>
  <div class="text-muted small">
    {{ date('D, M d Y', strtotime($comment->created_at)) }} 
    @if ($comment->user->id == Auth::user()->id)
    &middot; 
    <form action="{{ route('comment.delete', $comment->id) }}" method="post" class="d-inline">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn bg-transparent shadow-none border-0 p-0 text-danger">
        Delete
      </button>
    </form>
    @endif
  </div>
</div>