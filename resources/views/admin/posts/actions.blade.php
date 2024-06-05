{{-- hide post modal --}}
<div class="modal fade" id="hide-post{{ $post->id }}">
  <div class="modal-dialog">
    <div class="modal-content border-danger">
       <div class="modal-header border-danger">
         <h4 class="h5 text-danger">
          <i class="fa-solid fa-eye-slash"></i> Hide Post
         </h4>
       </div>
       <div class="modal-body">
         <h6 class="mb-3">Are you sure you want to hide this post</h6>
         @if($post->image)
            <img src="{{ $post->image }}" alt="" class="image-lg d-block">
         @else
            <i class="fa-solid fa-circle-user text-secondary icon-sm align-middle"></i>
         @endif
         <p class="mt-2">{{ $post->description }}</p>
       </div>
       <div class="modal-footer border-0">
         <form action="{{ route('admin.posts.hide', $post->id) }}" method="post">
           @csrf
           @method('DELETE')
           <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-danger">Cancel</button> 
           <button type="submit" class="btn btn-sm btn-danger">Hide</button>
         </form>
       </div>
    </div>
  </div>
</div>

{{-- unhide post modal --}}
<div class="modal fade" id="unhide-post{{ $post->id }}">
  <div class="modal-dialog">
    <div class="modal-content border-primary">
       <div class="modal-header border-primary">
         <h4 class="h5 text-primary">
          <i class="fa-solid fa-eye"></i> Unhide Post
         </h4>
       </div>
       <div class="modal-body">
         <h6 class="mb-3">Are you sure you want to unhide this post</h6>
         @if($post->image)
            <img src="{{ $post->image }}" alt="" class="image-lg d-block">
         @else
            <i class="fa-solid fa-circle-user text-secondary icon-sm align-middle"></i>
         @endif
         <p class="mt-2">{{ $post->description }}</p>
       </div>
       <div class="modal-footer border-0">
         <form action="{{ route('admin.posts.unhide', $post->id) }}" method="post">
           @csrf
           @method('PATCH')
           <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-primary">Cancel</button> 
           <button type="submit" class="btn btn-sm btn-primary">Unhide</button>
         </form>
       </div>
    </div>
  </div>
</div>