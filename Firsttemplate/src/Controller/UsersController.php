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
        parent::initialize();
        $this->loadModel("UsersPost");

        



    }
    public function beforeFilter($event)
    {
        parent::beforeFilter($event);

        $this->loadModel("Users");
        $this->loadModel("UsersPost");
        $this->loadModel("UsersComment");


        // $this->url = Router::url("/", true);

    
        $this->viewBuilder()->setLayout("formlayout");
        // $this->loadComponent('Authentication.Authentication');
        $this->Authentication->addUnauthenticatedActions(['login','add']);

        // $this->Authentication->addUnauthenticatedActions(['controller'=>'User','action'=>'index']);
        // $this->Authentication->addUnauthenticatedActions(['controller'=>'Users','action'=>'login']);

       



    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    // public function index1()
    // {
    //     die('welcome');
    //     $users = $this->paginate($this->Users);

    //     $this->set(compact('users'));
    // }
    public function index()
    {
        
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

            //---------------------------------Login--------------------------------//

    public function login()
    {
        
        
        

        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();

        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            
            $email = $this->request->getData('email');
            // echo $email;
            $session = $this->getRequest()->getSession();
            $session->write('email', $email);
            // redirect to /articles after login success
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'users',
                'action' => 'index',
            ]);

            return $this->redirect($redirect);
        }
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
        }
        // die;
    }
            //---------------------------------View--------------------------------//

    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['UsersPost','UsersComment'],
        ]);

        $this->set(compact('user'));
    }

  
        //---------------------------------Add--------------------------------//


    public function add()
    {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if (!$result->isValid()) {
            $user = $this->Users->newEmptyEntity();
            if ($this->request->is('post')) {
                $user = $this->Users->patchEntity($user, $this->request->getData());
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The user has been saved.'));

                    return $this->redirect(['action' => 'login']);
                } else {
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
                
            }
            $this->set(compact('user'));
        }else{
            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

                     //----------------------------Edit-----------------------//


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
        // echo '<pre>';
        // print_r($user);
        // die();
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

                 //----------------------------Delete-----------------------//


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
    public function logout()
    {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $this->Authentication->logout();
            $this->redirect(['controller'=>'user','action' => 'index']);
        }
    }


    
                    //----------------------------Post Insert-----------------------//


        public function post($uc_id=null)
        {
        // echo $uc_id;
        // die;
            $post = $this->UsersPost->newEmptyEntity();
          
            if ($this->request->is('post')) {
                $post['uc_id'] = $uc_id;
                // echo '<pre>';
                //     print_r($uc_id);
                //  die;
            
                $data = $this->request->getData();
                $productImage = $this->request->getData("images");
                $fileName = $productImage->getClientFilename();
                $fileSize = $productImage->getSize();
                $data["image"] = $fileName;
                $data['uc_id'] = $uc_id;
                $post = $this->UsersPost->patchEntity($post, $data);
             
                if ($this->UsersPost->save($post)) {
    
                    $hasFileError = $productImage->getError();
    
                    if ($hasFileError > 0) {
                        $data["image"] = "";
                    } else {
                        $fileType = $productImage->getClientMediaType();
    
                        if ($fileType == "image/png" || $fileType == "image/jpeg" || $fileType == "image/jpg") {
                            $imagePath = WWW_ROOT . "img/" . $fileName;
                            $productImage->moveTo($imagePath);
                            $data["image"] = $fileName;
                        }
                    }
    
                    $this->Flash->success(__('The post has been saved.'));
    
                    return $this->redirect(['action' => 'view', $uc_id]);
                }
                $this->Flash->error(__('The post could not be saved. Please, try again.'));
            }
            //$users = $this->UsersPost->Users->find('list', ['limit' => 200])->all();
            $this->set(compact('post'));
        }

            //----------------------------Post View && Comment Delete-----------------------//


        public function postview($id=null,$uc_id=null){

            $user = $this->Authentication->getIdentity();
            $this->set(compact('user'));

            $post = $this->UsersPost->get($id, [
                'contain' => ['UsersComment'],
            ]);
            // echo "<pre>";
            // print_r($post);
            // die();
         
          
            $comment = $this->UsersComment->newEmptyEntity();
            if ($this->request->is(['patch','put','post'])) {
        
                $data=$this->request->getData();
           
                
                $comment = $this->UsersComment->patchEntity($comment,$data);
                $comment['post_id']= $id;
                $comment['name']=$user->first_name;
                // print_r($comment);
                // die;
                
                if ($this->UsersComment->save($comment)) {
        
                    $this->Flash->success(__('The Comment has been saved.'));
        
                    return $this->redirect(['action' => 'postview',$id]);
                }
                else{
        
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
                // $this->set(compact('comment'));  
            }
        
            $this->set(compact('post','comment'));  
        
           }

            //----------------------------Delete Comment-----------------------//


           public function commentDelete($id = null ,$postid=null)
           {
            // die($userid);
               $this->request->allowMethod(['post', 'delete']);
               $comment = $this->UsersComment->get($id);
               if ($this->UsersComment->delete($comment)) {
                   $this->Flash->success(__('The comment has been deleted.'));
               } else {
                   $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
               }
       
               return $this->redirect(['action' => 'postview',$postid]);
           }
           
    }

