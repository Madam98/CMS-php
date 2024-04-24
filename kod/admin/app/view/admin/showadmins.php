<?php 
if (isset($_SESSION['infoboxVisible'])) {
    $infoboxVisible['info'] = $_SESSION['infoboxVisible']; 
    unset($_SESSION['infoboxVisible']);
  }
if (!isset($infoboxVisible)) { 
    $infoboxVisible = "";
} 
?>



<div class="row">
<div class="col">
<div class="card">
  <div class="card-body">
    <h5 class="card-title mb-4 d-inline">Admins</h5>
    <a href="<?php echo Settings::PATH['base'] ?>/admins/create" class="btn btn-primary mb-4 text-center float-right"><?php echo $info3 ?></a>
    
    <?php if ($infoboxVisible): ?>
        <div class="infobox" style="color: red">You cannot make delete or demote operation because there is only 1 administrator</div>
    <?php endif; ?>




    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Username</th>
          <th scope="col">Name</th>
          <th scope="col">Surname</th>
          <th scope="col">Email</th>
          <th scope="col">Address</th>
          <th scope="col"><?php echo $infobox; ?></th>
          <th scope="col">Delete</th>
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
                    <td><?php echo $admin->getAddress(); ?></td>  
                    <td><a  href="<?php echo $linkinfo; ?><?php echo $admin->getId(); ?>" class="btn btn-warning text-white text-center "><?php echo $info; ?></a></td>
                    <td><a  href="<?php echo Settings::PATH['base'] ?>/admins/delete/<?php echo $admin->getId(); ?>" class="btn btn-danger text-white text-center "><?php echo $info2; ?></a></td>
                </tr>
                <?php $counter++; ?>
            <?php endforeach; ?> 
        </tbody>
    </table> 
  </div>
</div>
</div>
</div>


<script>
    setTimeout(function() {
        document.getElementById('infobox').style.display = 'none';
    }, 5000);
</script>