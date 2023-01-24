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
        <h3 class="mt-5 text-center">Registration Form</h3><br>
        <div class="col-sm-6">

        <?= $this->Form->create($user) ?>
        <?php
                    echo $this->Form->control('first_name',['required'=>false]);
                    echo $this->Form->control('last_name',['required'=>false]);
                    echo $this->Form->control('email',['required'=>false]);
                    echo $this->Form->control('phone_number',['required'=>false]);
                    echo $this->Form->control('password',['required'=>false]);
                    echo $this->Form->control('gender',['required'=>false]);
                    echo $this->Form->control('created_date');
                    echo $this->Form->control('modified_date', ['empty' => true]);
                    echo $this->Form->control('code');
                    echo $this->Form->control('updated_time', ['empty' => true]);
                ?>
                <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
        <div class="col-sm-6 mt-5">
            <?php echo $this->Html->image('reg.png',['class'=>'formimg'])?>
        </div>
    </div>

</div>
