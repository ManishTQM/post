<?php
declare(strict_types=1);

namespace App\Controller;
use Phinx\Db\Action\Action;
use Cake\ORM\TableRegistry;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    private function getFileExt($mime_type){
        $mimetypeArr = [
            'application/pdf' => '.pdf',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => '.xlsx',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => '.docx',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation' => '.pptx',
            'application/vnd.ms-excel' => '.xls',
            'application/msword' => '.doc',
            'application/vnd.ms-powerpoint' => '.ppt',
            'image/bmp' => '.bmp',
            'image/gif' => '.gif',
            'image/png' => '.png',
            'image/x-citrix-png' => '.png',
            'image/x-png' => '.png',
            'image/jpeg' => '.jpg',
            'image/x-citrix-jpeg' => '.jpg'
        ];

        return $mimetypeArr[$mime_type];
    }

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
        $result = $this->Authentication->getIdentity();

        if ($result->role == 0) {
            $users = $this->paginate($this->Users);

            $this->set(compact('users'));
        }else{
            $this->redirect(['Controller'=>'Users','action'=>'userview']);
            }
       
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
            $users = TableRegistry::get("Users");
            $data = $users->find('all')->where(['email' => $email])->first();
            // print_r($data->first_name);
            // die;
            $session = $this->getRequest()->getSession();
            $session->write('name', $data->first_name);

            $result = $this->Authentication->getIdentity();
            if ($result->role == '0') {

                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'users',
                    'action' => 'index',
                ]);
                   
                }else{
                    $redirect = $this->request->getQuery('redirect', [
                        'controller' => 'users',
                        'action' => 'userview',
                    ]);

                }
            
               
            // redirect to /articles after login success
           

            return $this->redirect($redirect);
        }
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
        }
        // die;
    }
            //---------------------------------AdminView--------------------------------//

    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['UsersPost','UsersComment'],
        ]);

        $this->set(compact('user'));
    }
     //---------------------------------UsersView--------------------------------//

              public function userview($id = null)
              {
                $result = $this->Authentication->getIdentity();
                if ($result->role == '0') {
                  $user = $this->Users->get($id, [
                 'contain' => ['UsersPost','UsersComment'],
                  ]);
              }else{
                   $user = $this->Users->get($result->id, [
                    'contain' => ['UsersPost','UsersComment'],
                ]);
                $users = $this->paginate($this->UsersPost);
                $this->set(compact('user','users'));
            }
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

                     //----------------------------Logout-----------------------//


    public function logout()
    {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
                $this->Authentication->logout();
                $session = $this->request->getSession();
                $session->destroy();
                return $this->redirect(['action' => 'login']);
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

            //----------------------------Post View && Comment -----------------------//


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


           public function commentDelete($id = null ,$uc_id=null)
           {
               // die($userid);
               
               $this->request->allowMethod(['post', 'delete']);
               $result = $this->Authentication->getIdentity();
               $comment = $this->UsersComment->get($id);
               if ($result->role == 0) {
                //    print_r($comment);
                //    die;
                   if ($this->UsersComment->delete($comment)) {
                       $this->Flash->success(__('The comment has been deleted.'));
                       return $this->redirect(['action' => 'postview',$uc_id]);
                       
                    }
                else {
                   $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
               }
            }else{
                $result = $this->Authentication->getIdentity();
                if ($result->role == 1) {
                    $comment = $this->UsersComment->get($result->id);
                    if ($this->UsersComment->delete($comment)) {
                        $this->Flash->success(__('The comment has been deleted.'));
                    } else {
                        $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
                    }
            }
        }  
               return $this->redirect(['action' => 'postview',$uc_id]);
           }



            //----------------------------Delete Post-----------------------//


            public function deletepost($id = null ,$uc_id=null)
            {
             // die($userid);
             $this->request->allowMethod(['post', 'delete']);
             $post = $this->UsersPost->get($id);
                // print_r($post);
                // die;
                if ($this->UsersPost->delete($post)) {
                    $this->Flash->success(__('The Post has been deleted.'));
                    return $this->redirect(['action' => 'view',$post->uc_id]);
                } else {
                    $this->Flash->error(__('The Post could not be deleted. Please, try again.'));
                }
        
            }


  public function saveUserAjax()
    {
        /** FILE CREATE */
        $image_data = $this->request->getData('image_data');

        $contents = $image_data;
        $contents = explode('base64,', $contents);
        $contents = base64_decode(str_replace(' ', '+', $contents[1]));
        
        
        $f = finfo_open();
        $mime_type = finfo_buffer($f, $contents, FILEINFO_MIME_TYPE);
        $ext = $this->getFileExt($mime_type);
        $unique = rand(9999, 99999).microtime();
        $path = 'files/';
        $path = WWW_ROOT . 'img' . DS. $unique.$ext;


        $path = str_replace(" ", "", $path);
        file_put_contents($path, $contents);

        dd('here');

        /** FILE CREATE END */
        
        $name = $this->request->getData('name');
        $email = $this->request->getData('email');
        $image = $this->request->getData('image');
        //save these field into database using patchEntity
        echo json_encode(array(
            "status" => 200,
            "message" => "Data Submitted Successfully",
            "name" => $name,
            "email" => $email,
            "image" => $image,
        ));
        die;
    }

            
           
    }

