<!-- Modal -->
		<div class="modal fade" id="category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <form id="category_form" onsubmit="return false">
				  <div class="form-group">
				    <label>Category Name</label>
				    <input type="text" class="form-control" id="category_name" name="category_name">
				    <small id="cat_error" class="form-text text-muted">.</small>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Password</label>
				    <select id="parent_cat" name="parent_cat" class="form-control">
				    </select>
				  </div>
				  <button type="submit" class="btn btn-primary">Submit</button>
				</form>
		      </div>
		      <div class="modal-footer">
		      </div>
		    </div>
		  </div>
		</div>