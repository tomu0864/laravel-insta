{{-- Delete Modal --}}
<div class="modal fade" id="delete-cat{{ $category->id }}">
  <div class="modal-dialog">
   <div class="modal-content border-danger">
     <div class="modal-header border-danger">
       <h4 class="h5">
        <i class="fa-solid fa-trash-can"></i> Delete Category
       </h4>
     </div>
     <div class="modal-body">
       <p>Are you sure you want to delete <span class="fw-bold">{{ $category->name }}</span> category?</p>
       <p>This action will affect all the posts under this category. Posts without a category will fall under uncategorized</p>
     </div>
     <div class="modal-footer">
       <form action="{{ route('admin.categories.delete', $category->id) }}" method="post">
         @csrf
         @method('DELETE')
         
         <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-danger">Cancel</button>
         <button type="submit" class="btn btn-sm btn-danger">Delete</button>
       </form>
     </div>
   </div>
  </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="edit-cat{{ $category->id }}">
  <div class="modal-dialog">
   <div class="modal-content">
     <form action="{{ route('admin.categories.update', $category->id) }}" method="post">
      @csrf
      @method('PATCH')
     <div class="modal-header border-warning">
       <h4 class="h5">
        <i class="fa-solid fa-pencil"></i> Edit Category
       </h4>
     </div>
     <div class="modal-body">
      <input type="text" name="category{{ $category->id }}" value="{{ old("category$category->id", $category->name) }}" class="form-control">
      @error("category" . $category->id)
      {{-- Can't use {{}} in directive --}}
        <p class="text-danger">{{ $message }}</p>
      @enderror
     </div>
     <div class="modal-footer">
         <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-warning">Cancel</button>
         <button type="submit" class="btn btn-sm btn-warning text-dark">Update</button>
        </div>
      </form>
   </div>
  </div>
</div>