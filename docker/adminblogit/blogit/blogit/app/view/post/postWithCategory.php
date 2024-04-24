<div class="row gx-4 gx-lg-5 justify-content-center">
    <div class="col-md-10 col-lg-8 col-xl-7">
        <?php foreach($posts as $post) : ?> 
            <!-- Post preview-->
                <div class="post-preview">
                    <a href="<?php echo Settings::PATH['base'] ?>/post/view/<?php echo $post->getId(); ?>">
                        <h2 class="post-title"> <?php echo $post->getTitle(); ?> </h2>
                        <h3 class="post-subtitle"> <?php echo $post->getSubtitle(); ?> </h3>
                    </a>
                    <p class="post-meta">
                        Posted by
                            <a href="#!"><?php echo $postController->returnName($post->getUser_id()) . ' ' . $postController->returnSurname($post->getUser_id()) ?></a>
                            <?php echo date('M', strtotime($post->getCreatedAt()))  . ',' .  date('d', strtotime($post->getCreatedAt())) . ' ' . date('Y', strtotime($post->getCreatedAt())); ?>
                    </p>

                    
                </div>
            <!-- Divider-->
            <hr class="my-4" />
        <?php endforeach; ?>
        <!-- Pager-->        
    </div>
</div>