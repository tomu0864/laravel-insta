<style>
  .modal-body{
    max-height: 400px;
    overflow-y: auto;
  }
</style>

{{-- Show Recent postr modal --}}
<div class="modal fade" id="showComment{{ $user->id }}">
  <div class="modal-dialog">
    <div class="modal-content text-secondary">
      <div class="modal-header">
        <h4>
          Recent Comments
        </h4>
      </div>
      <div class="modal-body px-4">
        @forelse ($user->comments as $comment)
          <div class="row card border-primary text-secondary py-2 mb-2">
            <div class="col">
              <p class="mb-0">{{ $comment->body }}</p>
            </div>
            <div class="col-12">
              <hr class="text-primary">
            </div>
            <div class="col">
              Replied to <a href="{{ route('post.show', $comment->post->id) }}" class="text-decoration-none">{{ $comment->post->user->name }}'s post</a>
            </div>
          </div>
        @empty
          <h5>No Recent Comments yet</h5>
        @endforelse
      </div>
      <div class="modal-footer border-0 pt-0">
        <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-secondary">Cancel</button> 
      </div>
    </div>
  </div>
</div>
