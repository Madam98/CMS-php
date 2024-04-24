<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4 d-inline">Posts</h5>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Link</th>
                            <th scope="col">Category</th>
                            <th scope="col">User</th>
                            <th scope="col">Status</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $counter = 1;

                        foreach($posts as $post) : ?>
                            <tr>
                                <th scope="row"><?php echo $counter; ?></th>
                                <td><?php echo $post->getTitle(); ?></td>
                                <td><a href="<?php echo $postsController->createLink($post->getId()); ?>" target="_blank"><?php echo $postsController->createLink($post->getId()); ?></a></td>  
                                <td><?php echo $category->getCategoryById($post->getCategory_id()); ?></td>  
                                <td><?php echo $authorization->getUsernameById($post->getUser_id()); ?></td>         
                                <?php if($post->getstatus() == 0) : ?>
                                    <td><a href="<?php echo Settings::PATH['base'] ?>/posts/activate/<?php echo $post->getId(); ?>" class="btn btn-danger  text-center ">Deactivated</a></td>  
                                <?php else : ?>
                                    <td><a href="<?php echo Settings::PATH['base'] ?>/posts/deactivate/<?php echo $post->getId(); ?>" class="btn btn-primary  text-center ">Activated</a></td>
                                <?php endif; ?>  
                                <td><a href="<?php echo Settings::PATH['base'] ?>/posts/delete/<?php echo $post->getId(); ?>" class="btn btn-danger  text-center ">Delete</a></td>
                            </tr>
                            <?php $counter++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</div>
