<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
App::uses('CakeTime', 'Utility');
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link https://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class UsersController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('User','Post');

/**
 * Displays a view
 *
 * @return CakeResponse|null
 * @throws ForbiddenException When a directory traversal attempt.
 * @throws NotFoundException When the view file could not be found
 *   or MissingViewException in debug mode.
 */
	public function index() {
		
	}
    
    
    public function dashboard() {
		$user_id = $this->Auth->User('id');
        $userDetails = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
        $last_share = $userDetails['User']['last_share'];
        if(!empty($last_share)){
            $createdobj = new DateTime($last_share);
            $days= $createdobj->diff(new DateTime('today'));
            $days=$days->format('%R%a');
        }else{
            $days = 10;
        }
        $this->set(compact('days'));
	}
    
    public function dashboardearnings() {
		$user_id = $this->Auth->User('id');
        $shares = $this->Post->find('all',array('conditions'=>array('Post.user_id'=>$user_id)));
        $earned=0;
        foreach ($shares as $key=>$share){
            $earned += $share['Post']['earned'];
            $shares[$key]['Post']['message'] = strlen($shares[$key]['Post']['message']) > 200 ? substr($shares[$key]['Post']['message'],0,200)."..." : $shares[$key]['Post']['message'];
            $ctime=new DateTime($shares[$key]['Post']['posted_on']);
            $shares[$key]['Post']['posted_on'] = $ctime->format("jS \of F Y, g:i a");
        }
        $this->set(compact('shares','earned'));
        
	}
    public function dashboardsettings() {
		$user_id = $this->Auth->User('id');
        $userDetails = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
        $name = $userDetails['User']['name'];
        $address  = $userDetails['User']['address'];
        $this->set(compact('name','address'));
        
        if($this->request->is('post') && !empty($this->request->data)){
            $address = $this->request->data['address'];
            $db = $this->User->getDataSource();
                $address1 = $db->value($address, 'string');
                $this->User->updateAll(
                    array('User.address'=>$address1),
                    array('User.id' => $user_id)
                );
            $this->Session->setFlash("Your setting have been Saved!", 'default', array('class' => 'message'));
            $this->redirect(array('controller' => 'users', 'action' => 'dashboardsettings'));
        }
	}
    
    public function login() {
         $this->autoRender = false;
        if($this->request->referer()==SITEPATH){
		if($this->request->is('post') && !empty($this->request->data)){
            $user_id = $this->request->data['user_id'];
            $user_name = $this->request->data['user_name'];
            $email = $this->request->data['email'];
            $password = $this->Auth->password($user_id);
            $check = $this->User->find('first',array('conditions'=>array('User.username'=>$user_id)));
            if(empty($check)){
            $user_arr = array("usertype_id" => 2,
                "password" => $password,
                "name" => $user_name,
                "username" => $user_id,
                "email" => $email,
            );
            if ($this->User->save($user_arr)) {
              $userId = $this->User->id;
                if (!empty($userId)) {
                  $userDetails = $this->User->find('first',array('conditions'=>array('User.id'=>$userId)));
              
                  if(!empty($userDetails)){
                   $this->request->data['User']['username'] = $userDetails['User']['username'];   
                   $this->request->data['User']['password'] =$password;
                    if ($this->Auth->login()) {
                    echo 'true';
                        exit;
                } else {
                        echo 'false';
                        exit;
                }
                  }

              }
            }
        }else{
             $this->request->data['User']['username'] = $user_id;  
                   $this->request->data['User']['password'] =$password;
                    if ($this->Auth->login()) {
                    echo 'true';
                        exit;
                } else {
                        echo 'false';
                        exit;
                }   
            }}}else{
            throw new ForbiddenException();
        }
	}
    
    public function earning() {
         $this->autoRender = false;
        if($this->request->referer()==SITEPATH.'users/dashboard'){
		if($this->request->is('post') && !empty($this->request->data)){
            
            $earned = $this->request->data['earned'];
            $user_id = $this->Auth->User('id');
            $ctime = $this->request->data['ctime'];
            $ctime=new DateTime($ctime);
            $ctime=$ctime->format('Y-m-d H:i:s');
            $pmessage = $this->request->data['pmessage'];
            $upid = $this->request->data['upid'];
            $userDetails = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
        $last_share = $userDetails['User']['last_share'];
        if(!empty($last_share)){
            $createdobj = new DateTime($last_share);
            $days= $createdobj->diff(new DateTime('today'));
            $days=$days->format('%R%a');
        }else{
            $days = 10;
        }
            if($days > 0){
                $chpost =$this->Post->find('first',array('conditions'=>array('Post.user_post_id'=>$upid)));
                if(empty($chpost)){
            
            $post_arr = array("user_id" => $user_id,
                "earned" => $earned,
                "posted_on" => $ctime,
                "message" => $pmessage,
                "user_post_id" => $upid,
            );
            if($this->Post->save($post_arr)) {
              $last_post = date('Y-m-d H:i:s');
                $db = $this->User->getDataSource();
                $last_post1 = $db->value($last_post, 'string');
                $this->User->updateAll(
                    array('User.last_share'=>$last_post1),
                    array('User.id' => $user_id)
                );
                echo 'true';
                exit;
            }else{
                echo 'false';
                exit;
            }
            }else{
                echo 'true';
                exit; 
            }
            }else{
               echo 'true';
                exit; 
            }
        }}else{
            throw new ForbiddenException();
        }
	}
    
    function admin_index() {
          if($this->request->is('post') && !empty($this->request->data)){
              if ($this->Auth->login()) {
                if($this->Auth->User('usertype_id')!=1){
                    $this->Auth->logout();
                    $this->Session->setFlash("You dont have permission to access admin area!", 'default', array('class' => 'message'));
                }   ;
                $this->redirect(array('controller' => 'users', 'action' => 'admin_dash','admin'=>1));
                } else {
                   $this->Session->setFlash("Wrong Username or Password!", 'default', array('class' => 'message'));
            $this->redirect(array('controller' => 'users', 'action' => 'index','admin'=>1));
                }   
          }
        
    }
    
    function admin_dash() {
        if($this->Auth->User('usertype_id')!=1){
                    $this->Auth->logout();
                    $this->Session->setFlash("You dont have permission to access admin area!", 'default', array('class' => 'message'));
                }   ;
        $users = $this->User->find('all');
        foreach($users as $key=>$user){
            $cutime=new DateTime($users[$key]['User']['last_share']);
            $users[$key]['User']['last_share'] = $cutime->format("Y-m-d");
             $users[$key]['sum']=0;
            foreach($user['Post'] as $post){
                $users[$key]['sum'] += $post['earned'];
            }
            $cutime = NULL;
        }
        $this->set(compact('users'));
        
        }
    
    function admin_userdet($userid=NULL) {
        if($this->Auth->User('usertype_id')!=1){
                    $this->Auth->logout();
                    $this->Session->setFlash("You dont have permission to access admin area!", 'default', array('class' => 'message'));
                };
        
        $shares = $this->Post->find('all',array('conditions'=>array('Post.user_id'=>$userid)));
        $user = $this->User->find('first',array('conditions'=>array('User.id'=>$userid)));
        $this->set(compact('shares','user'));
        
        }
    
     function admin_logout() {
            $this->autoRender = false;
            $this->Auth->logout();
            $this->redirect(array('controller' => 'users', 'action' => 'index','admin'=>1));       
        
        }
     function logout() {
            $this->autoRender = false;
            $this->Auth->logout();
            $this->redirect(array('controller' => 'users', 'action' => 'index'));       
        
        }
}
