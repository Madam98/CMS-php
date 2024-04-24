<div class="container-fluid">

<div class="row">
<div class="col">
<div class="card">
  <div class="card-body">
    <h5 class="card-title mb-4 d-inline">Admins</h5>
    <a href="<?php echo Settings::PATH['base'] ?>/admin/create" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Username</th>
          <th scope="col">Name</th>
          <th scope="col">Surname</th>
          <th scope="col">Email</th>
          <th scope="col"></th>
          <th scope="col">Degrage</th>
        </tr>
      </thead>

        <tbody>
            <?php 
            $counter = 1; 
            foreach($admins as $admin) : ?>
                <tr>
                    <th scope="row"><?php echo $counter; ?></th>
                    <td><?php echo $authorization->getUsernameById($admin->getId()); ?></td>
                    <td><?php echo $admin->getName(); ?></td>
                    <td><?php echo $admin->getSurname(); ?></td>
                    <td><?php echo $admin->getEmail(); ?></td>  
                    <td><a  href="<?php echo Settings::PATH['base'] ?>/admin/create/<?php echo $admin->getId(); ?>" class="btn btn-warning text-white text-center ">Update</a></td>
                    <td><a  href="<?php echo Settings::PATH['base'] ?>/admin/delete/<?php echo $admin->getId(); ?>" class="btn btn-danger  text-center ">Delete</a></td> 
                </tr>
                <?php $counter++; ?>
            <?php endforeach; ?> 
        </tbody>
    </table> 
  </div>
</div>
</div>
</div>



</div>