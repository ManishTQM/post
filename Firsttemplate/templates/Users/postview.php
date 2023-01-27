<?= $this->Html->css([
        // 'vendor/aos/aos',
        // 'vendor/bootstrap/css/bootstrap.min',
        // 'vendor/bootstrap-icons/bootstrap-icons',
        // 'vendor/boxicons/css/boxicons.min',
        // 'vendor/glightbox/css/glightbox.min',
        // 'vendor/remixicon/remixicon',
        // 'vendor/swiper/swiper-bundle.min',
        'normalize.min',
        'milligram.min',
        'cake',
        'style'
          
        ]) ?>
                 <?php echo $this->Flash->render() ?>

<div class="column-responsive column-80">
<?= $this->Html->link('Back', ['controller'=>'Users','action' => 'index']) ?>
        <div class="users view content">
            <h3><?= h($post->uc_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                </tr>
                <div>

                    <td><?= h($post->title) ?></td>
                </div>
                <div>
                    <tr>
                        <th><?= __('Post image') ?></th>
                    </tr>

                </div>
                <div>
                    
                    <td><?= $this->Html->image($post->image,['class'=>"post-img"]) ?></td>
                </div>
               
            </table>
            <table>
            <tr>
                <th>Comment Name</th>
                <th>Comment</th>
                <th>Comment Time</th>
                <th class="actions"><?= __('Actions') ?></th>

                
            </tr>
            <?php foreach ($post->users_comment as $posts): ?>
            <tr>                
                    <td><?= h($posts->name) ?></td>
                    <td><?= h($posts->comment) ?></td>
                    <td><?= h($posts->comment_time) ?></td>
                   <td> <?= $this->Form->postLink(_('Delete'), [ 'action' => 'commentDelete',$posts->id, $post->id], ['confirm' => _('Are you sure you want to delete # {0}?'),$post->id]) ?></td>


                    
                </tr>

                <?php endforeach; ?>
            </table>

            <?= $this->Form->create($comment) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('comment');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>

</div>
</div>