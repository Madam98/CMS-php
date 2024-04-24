<section>
    <div class="container my-5 py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10 col-xl-8">
                <h3 class="mb-5">Comments</h3>
                <?php if(count($comments) > 0) : ?>
                    <?php foreach($comments as $comment) : ?>            
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-start align-items-center">             
                                    <div>
                                        <h6 class="fw-bold text-primary"><?php echo $comment->getUsername(); ?>
                                        <h8 class="p-3 text-black">(<?php echo date('M', strtotime($comment->getCreatedAt()))  . ',' .  date('d', strtotime($comment->getCreatedAt())) . ' ' . date('Y', strtotime($comment->getCreatedAt())); ?>)</h8></h6>
                                    </div>
                                    </div>
                            <?php if ($comment->getStatus() == 0): ?>
                                <p class="alert alert-warning">Comment block by administrator</p>
                            <?php else: ?>
                                <p class="mt-3 mb-4 pb-2" style="color: black"><?php echo $comment->getBody(); ?></p>
                            <?php endif; ?>
                            <hr class="my-4" />
                            </div>
                    <?php endforeach; ?>
                        <?php else : ?>
                        <div class="text-center">No comments for this post, be the first comment
                        </div>
                <?php endif; ?>        
                    
                <?php if(isset($_SESSION['username'])) : ?>
                    <form method="POST" action="<?php Settings::PATH['base'] ?>/blogit/post/addComment/<?php echo $post->getId(); ?> ">
                        <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                            <div class="d-flex flex-start w-100">
                                <div class="form-outline w-100">
                                    <textarea class="form-control" placeholder="Add comment" rows="4" name="comment"></textarea>
                                </div>
                            </div>
                            <div class="float-end mt-2 pt-1">
                                <button type="submit" name="submit" class="btn btn-primary btn-sm mb-3">Post comment</button>
                            </div>
                        </div>
                    </form>
                    <?php else : ?>
                        <div class="bg-danger alert alert-danger text-white">
                            Login or register to comment 
                        </div>
                    <?php endif; ?>       
                </div>
            </div>
        </div>
    </div>
</section>