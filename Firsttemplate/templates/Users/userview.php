<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
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
<div class="row">
    
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Create_Post'), ['action' => 'post', $user->id], ['class' => 'button float-right']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
            <h3><?= h($user->id) ?></h3>
            <table>
       
                <tr>
                    <th><?= __('First Name') ?></th>
                    <td><?= h($user->first_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Name') ?></th>
                    <td><?= h($user->last_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Gender') ?></th>
                    <td><?= h($user->gender) ?></td>
                </tr>
                <tr>
                    <th><?= __('Code') ?></th>
                    <td><?= h($user->code) ?></td>
                </tr>
                
                <th>
                    <tr>
                        <th><?= __('Id') ?></th>
                        <td><?= $this->Number->format($user->id) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Phone Number') ?></th>
                        <td><?= $this->Number->format($user->phone_number) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Created Date') ?></th>
                        <td><?= h($user->created_date) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Modified Date') ?></th>
                        <td><?= h($user->modified_date) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Updated Time') ?></th>
                        <td><?= h($user->updated_time) ?></td>
                    </tr>
                  
                 <!-- <tr>
                      <th><?= __('Image') ?></th>  
                      <?php foreach($user->users_post as $post):?>              
                         <td><?php echo $this->Html->image($post->image);?></td>
                     <?php endforeach; ?>
                 </tr> -->
                 </table>
                 <!-- <div class="related">
                <h4><?= __('Related Comments') ?></h4>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Comment') ?></th>
                            <th><?= __('Comment time') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach($user->users_comment as $post):?>              
                        <tr>
                       <td><?= h($post->id);?></td>
                       <td><?= h($post->post_id);?></td>
                       <td><?= h($post->comment);?></td>
                       <td><?= h($post->comment_time);?></td>
                            
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $post->id]) ?>
                                <?= $this->Html->link(__('Edit'), [ 'action' => 'edit', $post->id]) ?>
                                <?= $this->Form->postLink(_('Delete'), [ 'action' => 'commentDelete',$post->id, $user->id], ['confirm' => _('Are you sure you want to delete # {0}?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div> -->
                  <div class="related">
                <h4><?= __('Related Posts') ?></h4>
                <?php if (!empty($user->users_post)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Image') ?></th>
                           
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->users_post as $posts) : ?>
                        <tr>
                            <td><?= h($posts->id) ?></td>
                            <td><?= h($posts->uc_id) ?></td>
                            <td><?= h($posts->post_name) ?></td>
                            <td><?= h($posts->image) ?></td>
                            
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Users','action' => 'postview', $posts->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $posts->id]) ?>
                                <!-- <?= $this->Html->link(__('Delete'), ['controller' => 'Users', 'action' => 'deletepost', $posts->id,$posts->uc_id]) ?> -->
                                <?= $this->Form->postLink(_('Delete'), ['controller' => 'Users', 'action' => 'deletepost', $posts->id, $posts->uc_id], ['confirm' => _('Are you sure you want to delete # {0}?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>

            <div class="related">
                <h4><?= __('All Posts') ?></h4>
                <?php if (!empty($user->users_post)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Image') ?></th>
                           
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($users as $posts) : ?>
                        <tr>
                            <td><?= h($posts->id) ?></td>
                            <td><?= h($posts->uc_id) ?></td>
                            <td><?= h($posts->post_name) ?></td>
                            <td><?= h($posts->image) ?></td>
                            
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Users','action' => 'postview', $posts->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $posts->id]) ?>
                                <!-- <?= $this->Html->link(__('Delete'), ['controller' => 'Users', 'action' => 'deletepost', $posts->id,$posts->uc_id]) ?> -->
                                <?= $this->Form->postLink(_('Delete'), ['controller' => 'Users', 'action' => 'deletepost', $posts->id, $posts->uc_id], ['confirm' => _('Are you sure you want to delete # {0}?')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>

     

                
        
        </div>
    </div>
          
        </div>
    </div>
</div>






































