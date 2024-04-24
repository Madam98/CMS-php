    <!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row justify-content-center">
        <?php foreach ($categories as $category) : ?>
            <div class="col-md-6 mb-4 "> <!-- Dodana klasa w-100 -->
                <a href="<?php echo Settings::PATH['base'] ?>/home/category/<?php echo $category->getId() ?>" class="d-flex justify-content-center">
                    <div style="width: 80%; margin-bottom: 5px; padding: 5px; border-radius: 10px; background-color: #00D9C6; box-sizing: border-box;">
                        <div class="text-center text-white rounded p-3">
                            <h2><?php echo $category->getName(); ?></h2>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<div class="container px-4 px-lg-5">
    <div class="row">
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto"> <!-- Dodana klasa mx-auto -->
            <?php foreach($posts as $post) : ?>
                <div class="post-preview text-center"> <!-- Dodana klasa text-center -->
                    <a href="<?php echo Settings::PATH['base'] ?>/post/view/<?php echo $post->getId(); ?>">
                        <h2 class="post-title"><?php echo $post->getTitle(); ?></h2>
                        <h3 class="post-subtitle"><?php echo $post->getSubtitle(); ?></h3>
                    </a>
                    <p class="post-meta">
                        Posted by <a href="#!"><?php echo $postController->returnName($post->getUser_id()) . ' ' . $postController->returnSurname($post->getUser_id()) ?></a>
                        <?php echo date('M', strtotime($post->getCreatedAt()))  . ',' .  date('d', strtotime($post->getCreatedAt())) . ' ' . date('Y', strtotime($post->getCreatedAt())); ?>
                    </p>
                </div>


                <?php
                // Sprawdzenie, czy wartość jest różna od null
                if ($postController->getCategoryName($post->getCategory_id()) !== 'NULL') {
                ?>
                
                <div class="row justify-content-center align-items-center"> 
                    <div class="col-md-5 mb-2 mx-auto"> 
                        <a class="d-flex justify-content-center">
                            <div style="width: 50%; margin-bottom: 2px; padding: 1px; border-radius: 10px; background-color: #00D9C6; box-sizing: border-box;">
                                <div class="text-center text-white rounded p-2">
                                    <h6><?php echo $postController->getCategoryName($post->getCategory_id()); ?></h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <?php
                }
                ?>

            </div>
            <!-- Divider-->
            <hr class="my-4" />
        <?php endforeach; ?>
    <!-- Pager-->   
        </div>             
    </div>
</div>