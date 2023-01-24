<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function initialize(): void
    {
       

        $this->Model = $this->loadModel('Posts');
        $this->Model = $this->loadModel('Comments');
        $this->loadComponent('Flash');
        $this->loadComponent('Authentication.Authentication');

       
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function beforeFilter(\Cake\Event\EventInterface $event)
{
    parent::beforeFilter($event);
    // Configure the login action to not require authentication, preventing
    // the infinite redirect loop issue
    $this->Authentication->addUnauthenticatedActions(['login','add']);
}

public function login()
{
    $this->request->allowMethod(['get', 'post']);
    $result = $this->Authentication->getResult();

    // regardless of POST or GET, redirect if user is logged in
    if ($result && $result->isValid()) {

        $email = $this->request->getData('email');
        $session = $this->getRequest()->getSession();
        $session->write('email',$email);     

        // redirect to /articles after login success
        $redirect = $this->request->getQuery('redirect', ['controller' => 'Users','action' => 'index',]);

        return $this->redirect($redirect);
    }
    // display error if user submitted and authentication failed
    if ($this->request->is('post') && !$result->isValid()) {
        $this->Flash->error(__('Invalid username or password'));
    }
}

public function logout()
{
    $result = $this->Authentication->getResult();
    // regardless of POST or GET, redirect if user is logged in
    if ($result && $result->isValid()) {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }
}



   


    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Comments', 'Posts'],
        ]);

        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            $image = $this->request->getData('image_file');

            $name = $image->getClientFilename();

            $targetPath = WWW_ROOT.'img'.DS.$name;

            if($name)  
                $image->moveTo($targetPath);
                $user->image = $name;


            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    // add user post.. 

   public function postadd($userid){

    $post = $this->Posts->newEmptyEntity();

    if ($this->request->is('post')) {
        $data=$this->request->getData();

        $data['user_id']= $userid;

        $post = $this->Posts->patchEntity($post,$data) ;
        $image = $this->request->getData('Post_file');
        
        $name = $image->getClientFilename();
        
        // print_r($name);
        // die;
        $targetPath = WWW_ROOT.'img'.DS.$name;

        if($name)  
            $image->moveTo($targetPath);
            $post->image = $name;


        if ($this->Posts->save($post)) {
            $this->Flash->success(__('The user has been saved.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The user could not be saved. Please, try again.'));
    }
    $this->set(compact('post'));

   

   }

 /....post data view.../

   public function postview($id=null,$userid=null){

    $post = $this->Posts->get($id, [
        'contain' => ['Comments'],
    ]);
 
  
    $comment = $this->Comments->newEmptyEntity();
    if ($this->request->is('post')) {

        $data=$this->request->getData();
        
        $comment = $this->Comments->patchEntity($comment,$data);
        $comment['post_id']= $id;
    //    echo'<pre>';
    //     print_r($comment);
    //     die;

        if ($this->Comments->save($comment)) {

            $this->Flash->success(__('The user has been saved.'));

            // return $this->redirect(['action' => 'postview',$post->$post_id]);
        }
        else{

            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
    }

    $this->set(compact('post','comment'));  

   }


   public function commentDelete($id = null)
   {
       $this->request->allowMethod(['post', 'Delete']);
       $comment = $this->comments->get($id);
       if ($this->comments->delete($comment)) {
           $this->Flash->success(__('The user has been deleted.'));
       } else {
           $this->Flash->error(__('The user could not be deleted. Please, try again.'));
       }

       return $this->redirect(['action' => 'postview']);
   }



   public function home(){

    $posts = $this->paginate($this->Posts);

    $this->set(compact('posts'));
}

}




































<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(_('Delete User'), ['action' => 'delete', $user->id], ['confirm' => _('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
            <?= $this->Html->link(__('New Post'), ['action' => 'postadd' ,$user->id] , ['class' => 'button float-right']) ?>
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
                    <th><?= __('Address') ?></th>
                    <td><?= h($user->address) ?></td>
                </tr>
                <tr>
                    <th><?= __('Image') ?></th>
                    <td><?= h($user->image) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Comments') ?></h4>
                <?php if (!empty($user->comments)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Comment') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->comments as $comments) : ?>
                        <tr>
                            <td><?= h($comments->id) ?></td>
                            <td><?= h($user->id) ?></td>
                            <td><?= h($comments->comment) ?></td>
                            <td class="actions">
                                <!-- <?= $this->Html->link(__('View'), ['controller' => 'Comments', 'action' => 'view', $comments->id]) ?> -->
                                <!-- <?= $this->Html->link(__('Edit'), ['controller' => 'Comments', 'action' => 'edit', $comments->id]) ?> -->
                                <?= $this->Form->postLink(_('Delete'), ['controller' => 'Users', 'action' => 'commentDelete', $comments->id], ['confirm' => _('Are you sure you want to delete # {0}?', $user->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Posts') ?></h4>
                <?php if (!empty($user->posts)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Image') ?></th>
                            <th><?= __('Body') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->posts as $posts) : ?>
                        <tr>
                            <td><?= h($posts->id) ?></td>
                            <td><?= h($posts->user_id) ?></td>
                            <td><?= h($posts->title) ?></td>
                            <td><?= h($posts->image) ?></td>
                            <td><?= h($posts->body) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), [ 'action' => 'postview', $posts->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Posts', 'action' => 'edit', $posts->id]) ?>
                                <?= $this->Form->postLink(_('Delete'), ['controller' => 'Posts', 'action' => 'delete', $posts->id], ['confirm' => _('Are you sure you want to delete # {0}?', $posts->id)]) ?>
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




















<div class="column-responsive column-80">
<?= $this->Html->link(__('back'), ['action' => 'view']) ?>
        <div class="users view content">
            <h3><?= h($post->id) ?></h3>
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
                <div>

                    <tr><th><?= __('Body') ?></th></tr>
                </div>
                <div>
                    
                    <td><?= h($post->body) ?></td>
                </div>
            </table>

            <?php foreach ($post['comments'] as $comments): ?>
                <tr>                
                    <td><?= h($comments->comment).'<br>'?></td>
                    
                </tr>

                <?php endforeach; ?>
            <?= $this->Form->create($comment) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('comment');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit',$post->id)) ?>
            <?= $this->Form->end() ?>

</div>
</div>


















<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
?>
<div class="users index content">
    <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Users Posts') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('image') ?></th>
                    <th><?= $this->Paginator->sort('body') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?= $this->Number->format($post->id) ?></td>
                    <td><?= h($post->title) ?></td>
                    <td><?= $this->Html->image($post->image,['width'=>'100px']);?></td>
                    <td><?= h($post->body) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'postview', $post->id]) ?>
                </td>    
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    </div>


































