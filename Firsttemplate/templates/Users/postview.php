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
            <?php foreach ($post->users_comment as $posts): ?>
            <table>
                <tr>                
                    <td><?= h($posts->comment) ?></td>
                    
                </tr>

            </table>
            <?php endforeach; ?>

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