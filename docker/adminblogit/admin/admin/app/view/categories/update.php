<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5 d-inline">Update Category</h5>
                <br></br>
                <!-- <h6 class="card-title mb-5 d-inline">Category name can have max 12 characters</h5> -->
                <form method="POST" action="/admin/categories/updatecategory/<?php echo $category->getId(); ?>">
                    <div class="form-outline mb-4 mt-4">
                        <input type="category" name="category" value="<?php echo $category->getName(); ?>" id="form2Example1" class="form-control" placeholder="category" />
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>
                </form>
            </div>
          </div>
        </div>
      </div>