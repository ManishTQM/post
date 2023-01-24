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
         <?php echo $this->Flash->render() ?>

<div class="container">
    <div class="row custm">
        <h3 class="mt-5 text-center">Post</h3><br>
        <div class="col-sm-12">

       <?php echo $this->Form->create($post,['type'=>'file']);?>
        <?php
                    echo $this->Form->control('post_name',['required'=>false]);
                    echo $this->Form->control('images',['type'=>'file']);
                  
                ?>
                <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
        
    </div>

</div>
