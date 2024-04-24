<?php

if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']); // Usuwanie błędów po użyciu
}
if (isset($_SESSION['form_values'])) {
    $form_values = $_SESSION['form_values'];
    unset($_SESSION['form_values']);
}
if (!isset($form_values["name"])) {$form_values["name"] = "";}
if (!isset($form_values["surname"])) {$form_values["surname"] = "";}
if (!isset($form_values["email"])) {$form_values["email"] = "";}
if (!isset($form_values["telephone"])) {$form_values["telephone"] = "";}
if (!isset($form_values["address"])) {$form_values["address"] = "";}
if (!isset($form_values["username"])) {$form_values["username"] = "";}   
?>

<h2 class="page-header text-center">
    <?php echo $user->getId() != null ? $user->getId() : 'Welcome! Begin your adventure today with IT world!'; ?>
</h2>



<form method="POST" class="py-4" action="register/save" enctype="multipart/form-data">

    <h2 class="page-header text-center">
        <?php echo $user->getId() != null ? $user->getId() : 'Your personal information'; ?>
    </h2>


    <!-- <pre>
        <?php var_dump($error) ?>
    </pre>

    <pre>
        <?php var_dump($form_values) ?>
    </pre> -->


    <!-- Name input -->
    <div class="form-outline mb-4" style="text-align: center;">
        <input type="name" name="name" value="<?php echo ucfirst($form_values["name"]); ?>" id="form2Example1" class="form-control <?php if (isset($error['NAME_CAN_NOT_BE_EMPTY!']) && $error['NAME_CAN_NOT_BE_EMPTY!'] == Settings::ERRORS['NAME_CAN_NOT_BE_EMPTY!']) echo 'is-invalid'; ?>" style="width: 50%; margin: 0 auto;" placeholder="Name (obligatory)"/>  
        <?php if (isset($error['NAME_CAN_NOT_BE_EMPTY!']) && $error['NAME_CAN_NOT_BE_EMPTY!'] == Settings::ERRORS['NAME_CAN_NOT_BE_EMPTY!']) { ?>
            <div class="invalid-feedback">
                NAME CAN NOT BE EMPTY!
            </div>
        <?php } ?>
    </div> 

    <!-- Surname input -->
    <div class="form-outline mb-4" style="text-align: center;">
        <input type="surname" name="surname" value="<?php echo ucfirst($form_values["surname"]); ?>" id="form2Example2" class="form-control <?php if (isset($error['SURNAME_CAN_NOT_BE_EMPTY!']) && $error['SURNAME_CAN_NOT_BE_EMPTY!'] == Settings::ERRORS['SURNAME_CAN_NOT_BE_EMPTY!']) echo 'is-invalid'; ?>" style="width: 50%; margin: 0 auto;" placeholder="Surname (obligatory)" />       
        <?php if (isset($error['SURNAME_CAN_NOT_BE_EMPTY!']) && $error['SURNAME_CAN_NOT_BE_EMPTY!'] == Settings::ERRORS['SURNAME_CAN_NOT_BE_EMPTY!']) { ?>
            <div class="invalid-feedback">
                SURNAME CAN NOT BE EMPTY!
            </div>
        <?php } ?>
    </div>

    <!-- Email input -->
    <div class="form-outline mb-4" style="text-align: center;">
        <input type="email" name="email" value="<?php echo $form_values["email"]; ?>" id="form2Example3" class="form-control 
        <?php if (
                    (isset($error['EMAIL_CAN_NOT_BE_EMPTY!']) && 
                    ($error['EMAIL_CAN_NOT_BE_EMPTY!'] == Settings::ERRORS['EMAIL_CAN_NOT_BE_EMPTY!']))
                    || 
                    (isset($error['USER_WITH_THIS_EMAIL_EXISTS!']) && 
                    ($error['USER_WITH_THIS_EMAIL_EXISTS!'] == Settings::ERRORS['USER_WITH_THIS_EMAIL_EXISTS!']))
                )
                    
        echo 'is-invalid'?>" style="width: 50%; margin: 0 auto;" placeholder="Email (obligatory)" />       
        
        <?php if (isset($error['EMAIL_CAN_NOT_BE_EMPTY!']) && $error['EMAIL_CAN_NOT_BE_EMPTY!'] == Settings::ERRORS['EMAIL_CAN_NOT_BE_EMPTY!']) { ?>
            <div class="invalid-feedback">
                EMAIL CAN NOT BE EMPTY!
            </div>
        <?php } ?>
        <?php if (isset($error['USER_WITH_THIS_EMAIL_EXISTS!']) && $error['USER_WITH_THIS_EMAIL_EXISTS!'] == Settings::ERRORS['USER_WITH_THIS_EMAIL_EXISTS!']) { ?>
            <div class="invalid-feedback">
                USER WITH THIS EMAIL EXISTS!
            </div>
        <?php } ?>
    </div>

    <!-- Telephone input -->
    <div class="form-outline mb-4" style="text-align: center;">
        <input type="tel" name="telephone" value="<?php echo $form_values["telephone"]; ?>" id="form2Example4" placeholder="Telephone" style="width: 50%; margin: 0 auto;" class="form-control" pattern="\+?[0-9]{3,}" title="Phone number must start with a + and include 3 or more digits" />       
    </div>

    <!-- Address input -->
    <div class="form-outline mb-4" style="text-align: center;">
        <input type="address" name="address" value="<?php echo $form_values["address"]; ?>" id="form2Example5" placeholder="Address" style="width: 50%; margin: 0 auto;" class="form-control" />       
    </div>

    </br>
    <h2 class="page-header text-center">
        <?php echo $user->getId() != null ? $user->getId() : 'Set your login credentials'; ?>
    </h2>

    <h4 class="page-header text-center" style="color: red;">
    Password requirements:
    </h4>
    
    <h6 class="page-header text-center">
    <ul>
    - Be at least 12 characters long<br>
    - Contain at least one uppercase letter<br>
    - Contain at least one lowercase letter<br>
    - Contain at least two numbers<br>
    - Does not contain special character<br>

    </ul>
    </h6>

    <!-- Username input -->
    <div class="form-outline mb-4" style="text-align: center;">
        <input type="username" name="username" value="<?php echo $form_values["username"];?>" id="form2Example6" class="form-control 
        
        <?php if (
                    (isset($error['USERNAME_CAN_NOT_BE_EMPTY!']) && 
                    $error['USERNAME_CAN_NOT_BE_EMPTY!'] == Settings::ERRORS['USERNAME_CAN_NOT_BE_EMPTY!']) 
                    ||
                    (isset($error['USER_WITH_THIS_USERNAME_EXISTS!']) && 
                    $error['USER_WITH_THIS_USERNAME_EXISTS!'] == Settings::ERRORS['USER_WITH_THIS_USERNAME_EXISTS!'])) 
                    echo 'is-invalid'; ?>"         
        style="width: 50%; margin: 0 auto;" placeholder="Username (obligatory)"/>       
        
        <?php if (isset($error['USERNAME_CAN_NOT_BE_EMPTY!']) && $error['USERNAME_CAN_NOT_BE_EMPTY!'] == Settings::ERRORS['USERNAME_CAN_NOT_BE_EMPTY!']) { ?>
            <div class="invalid-feedback">
                USERNAME CAN NOT BE EMPTY!
            </div>
        <?php } ?>

        <?php if (isset($error['USER_WITH_THIS_USERNAME_EXISTS!']) && $error['USER_WITH_THIS_USERNAME_EXISTS!'] == Settings::ERRORS['USER_WITH_THIS_USERNAME_EXISTS!']) { ?>
            <div class="invalid-feedback">
                USER WITH THIS USERNAME EXISTS!
            </div>
        <?php } ?>

    </div>  
    
    <!-- Password input -->
    <div class="form-outline mb-4" style="text-align: center;">
        <input type="password" name="password" id="form2Example7" placeholder="Password (obligatory)" style="width: 50%; margin: 0 auto;" class="form-control 
        <?php if (
                    (isset($error['PASSWORD_CAN_NOT_BE_EMPTY!']) && 
                    $error['PASSWORD_CAN_NOT_BE_EMPTY!'] == Settings::ERRORS['PASSWORD_CAN_NOT_BE_EMPTY!']) 
                    ||
                    (isset($error['INVALID_PASSWORD!']) && 
                    $error['INVALID_PASSWORD!'] == Settings::ERRORS['INVALID_PASSWORD!'])) 
                    echo 'is-invalid'; ?>" />       
        
        <?php if (isset($error['PASSWORD_CAN_NOT_BE_EMPTY!']) && $error['PASSWORD_CAN_NOT_BE_EMPTY!'] == Settings::ERRORS['PASSWORD_CAN_NOT_BE_EMPTY!']) { ?>
            <div class="invalid-feedback">
                PASSWORD CAN NOT BE EMPTY!
            </div>
        <?php } ?>

        <?php if (isset($error['INVALID_PASSWORD!']) && $error['INVALID_PASSWORD!'] == Settings::ERRORS['INVALID_PASSWORD!']) { ?>
            <div class="invalid-feedback">
                INVALID PASSWORD!
            </div>
        <?php } ?>

    </div>


    <!-- Submit button -->
    <div class="form-outline mb-4" style="text-align: center;">
        <button type="submit" name="submit" class="btn btn-primary mb-4 text-center" style="width: 50%; margin: 0 auto; display: block;">Register</button>
    </div>

    <!-- Register buttons -->
    <div class="text-center">
        <p>Aleardy a member? <a href="<?php echo Settings::PATH['base'] ?>/login">Login</a></p>
    </div>

</form>