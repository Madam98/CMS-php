<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Comments</h5>
            
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Post title</th>
                    <th scope="col">Link</th>
                    <th scope="col">Author</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Created</th>
                    <th scope="col">Status</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $counter = 1;
                  foreach($comments as $comment) : ?>
                    <tr>
                      <th scope="row"><?php echo $counter; ?></th>
                      <td><?php echo $postModel->getTitleById($comment->getPost_id()); ?></td>
                      <td style="word-wrap: break-word; max-width: 100px;"><a href="<?php echo $commentsController->createLink($comment->getPost_id()); ?>" target="_blank"><?php echo $commentsController->createLink($comment->getPost_id()); ?></a></td> 
                      <td><?php echo $comment->getUsername(); ?></td>
                      <td style="word-wrap: break-word; max-width: 300px;"><?php echo $comment->getBody(); ?></td>
                      <td><?php echo $comment->getCreatedAt(); ?></td>
                      <?php if($comment->getStatus() == 0) : ?>
                        <td><a href="<?php echo Settings::PATH['base'] ?>/comments/activate/<?php echo $comment->getId(); ?>"class="btn btn-danger  text-center ">Deactivated</a></td>
                      <?php else : ?>
                        <td><a href="<?php echo Settings::PATH['base'] ?>/comments/deactivate/<?php echo $comment->getId(); ?>" class="btn btn-primary  text-center ">Activated</a></td> 
                      <?php endif; ?>  
                      <td><a href="<?php echo Settings::PATH['base'] ?>/comments/delete/<?php echo $comment->getId(); ?>" class="btn btn-danger  text-center ">Delete</a></td>
                    </tr>
                    <?php $counter++ ?>
                 <?php endforeach; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
</div>