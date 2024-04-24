<!-- Page Header-->

        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <p><?php echo $post->getBody(); ?></p>
                        <?php if(isset($_SESSION['user_id']) AND $_SESSION['user_id'] == $post->getUser_id()) : ?>
                            <a href="<?php Settings::PATH['base']?>/blogit/post/delete/<?php echo $post->getId(); ?>" class="btn btn-danger text-center float-end">Delete</a>
                            <a href="<?php Settings::PATH['base']?>/blogit/post/edit/<?php echo $post->getId(); ?>" class="btn btn-warning text-center">Update</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </article>