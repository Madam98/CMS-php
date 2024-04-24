<header class="masthead" style="background-image: url('<?php echo $postController->returnImage($post->getImageName(), $post->getUser_id() ); ?>')">   
        <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1 style="text-align: center"><?php echo $post->getTitle(); ?></h1>
                            <h2 style="text-align: center" class="subheading"><?php echo $post->getSubtitle(); ?></h2>
                            </br>
                            <span class="meta">
                                Posted by
                                <a href="#!"><?php echo $postController->returnName($post->getUser_id()) . ' ' . $postController->returnSurname($post->getUser_id()) ?></a>
                                <?php echo date('M', strtotime($post->created_at))  . ', ' .  date('d', strtotime($post->created_at)) . ' ' . date('Y', strtotime($post->created_at)); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
</header>