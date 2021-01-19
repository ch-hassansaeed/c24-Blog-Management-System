<!-- Modal -->
<div class="modal fade" id="form_post" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="post_form" enctype="multipart/form-data" onsubmit="return false">
          <div class="form-group">
          <input type="hidden" name="form_action" value="post_add" value=""/>
            <label>Title</label>
            <input type="text" class="form-control" name="post_title" id="post_title" placeholder="Enter title">
            <label>content</label>
            <textarea type="text" class="form-control" name="post_content" id="post_content" placeholder="Enter content"></textarea>
            <label>photo</label>
            <input type="text" class="form-control" name="post_photo" id="post_photo" value="http://localhost:86/check24_blog/upload_imgaes/c24.jpg" placeholder="Browse Photo">
            <label>author</label>
            <input type="text" class="form-control" name="post_author" id="post_author" placeholder="Enter title">
          
            <small id="post_error" class="form-text text-muted"></small>
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>