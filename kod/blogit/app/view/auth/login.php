<?php

if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']); // Usuwanie błędów po użyciu
}

?>


<form method="POST" action="login/validate">

    <?php if (isset($error)) { ?>
        <h1 style="text-align: center; color: red;"> USERNAME OR PASSWORD INCORRECT! </h1>
    <?php } ?>


    <!-- Username input -->
    <div class="form-outline mb-4" style="text-align: center;">
        <input type="username" name="username"  value="<?php echo $authorization->getUsername(); ?>" id="form2Example1" class="form-control" style="width: 50%; margin: 0 auto;" placeholder="User"/>               
    </div> 
              
    <!-- Password input -->
    <div class="form-outline mb-4" style="text-align: center;">
        <input type="password" name="password" value="<?php echo $authorization->getPassword(); ?>" id="form2Example2" class="form-control" style="width: 50%; margin: 0 auto;"  placeholder="Password"/>                
    </div>

    <!-- Submit button -->
    <div class="form-outline mb-4" style="text-align: center;">
        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>
    </div>
    <!-- Register buttons -->
    <div class="text-center">
        <p>You are a new member? Create an acount<a href="<?php echo Settings::PATH['base'] ?>/register"> Register</a></p>
    </div>
  



  </form>