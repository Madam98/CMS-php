<?php

if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']); // Usuwanie błędów po użyciu
}
if (isset($_SESSION['form_values'])) {
    $form_values = $_SESSION['form_values'];
    // var_dump($_SESSION['form_values']);
    // echo $form_values['body'];
    unset($_SESSION['form_values']);
}


if (!isset($form_values["title"])) {$form_values["title"] = "";}
if (!isset($form_values["subtitle"])) {$form_values["subtitle"] = "";}
if (!isset($form_values["category"])) {$form_values["category"] = "";}
if (!isset($form_values["body"])) {$form_values["body"] = "";}

?>


<form method="POST" action="./save" enctype="multipart/form-data">

    <!-- Title input -->
    <div class="form-outline mb-4" style="text-align: center;">
        <input type="text" name="title" value="<?php echo $post->getTitle(); ?>" id="form2Example1" class="form-control <?php if (isset($error['TITLE_CAN_NOT_BE_EMPTY!']) && $error['TITLE_CAN_NOT_BE_EMPTY!'] == Settings::ERRORS['TITLE_CAN_NOT_BE_EMPTY!']) echo 'is-invalid'; ?>" style="width: 50%; margin: 0 auto;" placeholder="Title (obligatory)" />      
        <?php if (isset($error['TITLE_CAN_NOT_BE_EMPTY!']) && $error['TITLE_CAN_NOT_BE_EMPTY!'] == Settings::ERRORS['TITLE_CAN_NOT_BE_EMPTY!']) { ?>
            <div class="invalid-feedback">
                TITLE CAN NOT BE EMPTY!
            </div>
        <?php } ?>
    </div>



    <!-- Subtitle input -->
    <div class="form-outline mb-4" style="text-align: center;">
        <input type="text" name="subtitle" value="<?php echo $form_values['subtitle']; ?>" id="form2Example1" class="form-control" style="width: 50%; margin: 0 auto;" placeholder="Subtitle" />
    </div>

    <!-- Category chose button -->
    <div class="form-outline mb-4" style="text-align: center;">
        <select name="category_id" class="form-select" style="width: 50%; margin: 0 auto;" aria-label="Default select example">
        <option value="" <?php if($form_values['category'] == "NULL") echo 'selected'; ?>>Open this select menu to set category</option>    
        <?php foreach($categories as $cat) : ?>
                <option value="<?php echo $cat->getId(); ?>" <?php if(isset($form_values['category_id']) && $form_values['category_id'] == $cat->getId()) echo 'selected'; ?>><?php echo $cat->getName(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    

    <!-- Body input -->
    <div class="form-outline mb-4" style="text-align: center;">
        <textarea type="text" name="body" id="form2Example2" class="form-control" style="width: 75%; margin: 0 auto;" placeholder="Contents" rows="10"><?php echo $form_values['body']; ?></textarea>
    </div>
     

    <!-- Chose image input -->
    <div class="form-outline mb-4" style="text-align: center;">
        <input type="file" name="image" value="<?php echo $post->getImageName(); ?>" id="form2Example3" class="form-control" style="width: 50%; margin: 0 auto;" placeholder="image" />
    </div>

    <!-- Submit button -->
    <div class="form-outline mb-4" style="text-align: center;">
        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Create</button>      
    </div>

    <!-- <h1>Numer Sesji: <?php echo $_SESSION['user_id']; ?></h1> -->

</form>