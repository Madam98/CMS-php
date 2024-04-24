<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Categories</h5>
             <a  href="<?php echo Settings::PATH['base'] ?>/categories/create" class="btn btn-primary mb-4 text-center float-right">Create Categories</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $counter = 1; 
                  foreach($categories as $category) : ?>
                  <tr>
                    <th scope="row"><?php echo $counter; ?></th>
                    <td><?php echo $category->getName(); ?></td>
                    <td><a  href="<?php echo Settings::PATH['base'] ?>/categories/update/<?php echo $category->getId(); ?>" class="btn btn-warning text-white text-center ">Update</a></td>
                    <td><a  href="<?php echo Settings::PATH['base'] ?>/categories/delete/<?php echo $category->getId(); ?>" class="btn btn-danger  text-center ">Delete</a></td>
                  </tr>
                  <?php $counter++; ?>
                <?php endforeach; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>