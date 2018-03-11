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
        if(!session_id()) {
    session_start();
}
        require APP . 'Vendor' . DS. 'autoload.php';
        $fb = new Facebook\Facebook([
          'app_id' => F_AID,
          'app_secret' => F_SEC,
          'default_graph_version' => 'v2.10',
            'persistent_data_handler'=>'session'
          ]);

        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email','public_profile','user_friends','user_posts']; // Optional permissions
        $loginUrl = $helper->getLoginUrl(SITEPATH.'login', $permissions);
        $this->set(compact('loginUrl'));
		
	}
    
    
    public function dashboard() {
        if(!session_id()) {
            session_start();
        }
		$user_id = $this->Auth->User('id');
        $accessToken = $this->Auth->User('accessToken');
        require APP . 'Vendor' . DS. 'autoload.php';
        $fb = new Facebook\Facebook([
          'app_id' => F_AID,
          'app_secret' => F_SEC,
          'default_graph_version' => 'v2.10',
            'persistent_data_handler'=>'session'
          ]);
        try {
  // Returns a `Facebook\FacebookResponse` object
              $response = $fb->get('/me/friends', $accessToken);
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
              echo 'Graph returned an error: ' . $e->getMessage();
              exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
              echo 'Facebook SDK returned an error: ' . $e->getMessage();
              exit;
            }
        $friendsEdge = $response->getGraphEdge();
        $fcount = $friendsEdge->getTotalCount();
        $fcount = 0.01*$fcount;
        $this->Session->write('fcount', $fcount);
        $userDetails = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
        $last_share = $userDetails['User']['last_share'];
        if(!empty($last_share)){
            $createdobj = new DateTime($last_share);
            $now = new DateTime('now');
            $days= $createdobj->diff(new DateTime('now'));
            $days=$days->format('%R%a');
        }else{
            $days = 10;
        }
        $this->set(compact('days','fcount','createdobj','now'));
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
        $twitter  = $userDetails['User']['twitter'];
        $btctalk  = $userDetails['User']['btctalk'];
        $telegram  = $userDetails['User']['telegram'];
        $this->set(compact('name','address','twitter','btctalk','telegram'));
        
        if($this->request->is('post') && !empty($this->request->data)){
            
            $address = $this->request->data['address'];
            $twitter = $this->request->data['twitter'];
            $btctalk = $this->request->data['btctalk'];
            $telegram = $this->request->data['telegram'];
            if(!empty($this->request->data['address'])){
            if (preg_match("/^F[0-9a-zA-Z]{33}$/", $this->request->data['address'])) {
            } else {
                $this->Flash->error(__('Invalid FRG address'));
                return $this->redirect(array('controller'=>'users','action' => 'dashboardsettings'));
            }}else{
                 $frg_wallet=NULL;
             }
            $db = $this->User->getDataSource();
                $address1 = $db->value($address, 'string');
                $twitter1 = $db->value($twitter, 'string');
                $btctalk1 = $db->value($btctalk, 'string');
                $telegram1 = $db->value($telegram, 'string');
                $this->User->updateAll(
                    array('User.address'=>$address1,'User.twitter'=>$twitter1,'User.btctalk'=>$btctalk1,'User.telegram'=>$telegram1,),
                    array('User.id' => $user_id)
                );
            $this->Session->setFlash("Your setting have been Saved!", 'default', array('class' => 'message'));
            $this->redirect(array('controller' => 'users', 'action' => 'dashboardsettings'));
        }
	}
    
    public function retrieve() {
         $this->autoRender = false;
        $user_id = $this->Auth->User('id');
        $accessToken = $this->Auth->User('accessToken');
        require APP . 'Vendor' . DS. 'autoload.php';
        $fb = new Facebook\Facebook([
          'app_id' => F_AID,
          'app_secret' => F_SEC,
          'default_graph_version' => 'v2.10',
            'persistent_data_handler'=>'session'
          ]);
        
        try {
  // Returns a `Facebook\FacebookResponse` object
              $response = $fb->get('me/feed?fields=created_time,link,message&limit=5', $accessToken);
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
              echo 'Graph returned an error: ' . $e->getMessage();
              exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
              echo 'Facebook SDK returned an error: ' . $e->getMessage();
              exit;
            }
        
        $feedEdge = $response->getGraphEdge();
        foreach ($feedEdge as $graphNode) {
        if(isset($graphNode['link'])){
        if($graphNode['link']=="https://theforgenetwork.com/"||$graphNode['link']=="https://shop.theforgenetwork.com/"||$graphNode['link']=="https://bounty.theforgenetwork.com/"){
            
            $now = new DateTime();
            $then = $graphNode['created_time']; // "2012-07-18 21:11:12" for example
            $diff = $now->diff($then);
            $minutes = ($diff->format('%a') * 1440) + // total days converted to minutes
                       ($diff->format('%h') * 60) +   // hours converted to minutes
                        $diff->format('%i');          // minutes
            if ($minutes <= 5) {
                var_dump($graphNode['link']);
                var_dump($graphNode['created_time']);
                $earned = $this->Session->read('fcount');
            $user_id = $this->Auth->User('id');
            $ctime = $graphNode['created_time'];
            $ctime->setTimezone(new DateTimeZone('Africa/Lagos'));
            $ctime=$ctime->format('Y-m-d H:i:s');
            if(isset($graphNode['message'])){
                $pmessage = $graphNode['message'];
            }else{
                 $pmessage = 'N/A';
            }
            $upid = $graphNode['id'];
            $userDetails = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
        $last_share = $userDetails['User']['last_share'];
        if(!empty($last_share)){
            $createdobj = new DateTime($last_share);
            $days= $createdobj->diff(new DateTime('now'));
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
              $last_post = $ctime;
                $db = $this->User->getDataSource();
                $last_post1 = $db->value($last_post, 'string');
                $this->User->updateAll(
                    array('User.last_share'=>$last_post1),
                    array('User.id' => $user_id)
                );
                $this->Flash->success(__('Post Found!, You earned '.$earned.' FRG. Check Earnings tab for more details'));
                return $this->redirect(array('controller'=>'users','action' => 'dashboard'));
            }else{
               $this->Flash->error(__('Post Found!, but something went wrong'));
                return $this->redirect(array('controller'=>'users','action' => 'dashboard'));
            }
            }else{
                $this->Flash->error(__('Duplicate post discarded!'));
                return $this->redirect(array('controller'=>'users','action' => 'dashboard')); 
            }
            }else{
               $this->Flash->error(__('Its less than 24 hours since last share!'));
                return $this->redirect(array('controller'=>'users','action' => 'dashboard')); 
            }
                break;
            }
            
        }else{
           
        }}
        }
         $this->Flash->error(__('No Elligible Post found!'));
                return $this->redirect(array('controller'=>'users','action' => 'dashboard')); 
        
	}
    
    public function login() {
         $this->autoRender = false;
        if(!session_id()) {
    session_start();
}
        require APP . 'Vendor' . DS. 'autoload.php';
        
        $fb = new Facebook\Facebook([
          'app_id' => F_AID,
          'app_secret' => F_SEC,
          'default_graph_version' => 'v2.10',
            'persistent_data_handler'=>'session'
          ]);

        $helper = $fb->getRedirectLoginHelper();

        try {
          $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
          // When Graph returns an error
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
          // When validation fails or other local issues
          echo 'Facebook SDK1 returned an error: ' . $e->getMessage();
          exit;
        }

        if (! isset($accessToken)) {
          if ($helper->getError()) {
            header('HTTP/1.0 401 Unauthorized');
            echo "Error: " . $helper->getError() . "\n";
            echo "Error Code: " . $helper->getErrorCode() . "\n";
            echo "Error Reason: " . $helper->getErrorReason() . "\n";
            echo "Error Description: " . $helper->getErrorDescription() . "\n";
          } else {
            header('HTTP/1.0 400 Bad Request');
            echo 'Bad request';
          }
          exit;
        }

        // Logged in
        //echo '<h3>Access Token</h3>';
        //var_dump($accessToken->getValue());

        // The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();

        // Get the access token metadata from /debug_token
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);
       

        // Validation (these will throw FacebookSDKException's when they fail)
        $tokenMetadata->validateAppId(F_AID);
        // If you know the user ID this access token belongs to, you can validate it here
        //$tokenMetadata->validateUserId('123');
        $tokenMetadata->validateExpiration();

        if (! $accessToken->isLongLived()) {
          // Exchanges a short-lived access token for a long-lived one
          try {
            $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
          } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
            exit;
          }

         // echo '<h3>Long-lived</h3>';
         // var_dump($accessToken->getValue());
        }
        $accessToken = (string) $accessToken;
        
        try {
  // Returns a `Facebook\FacebookResponse` object
              $response = $fb->get('/me?fields=id,name,email', $accessToken);
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
              echo 'Graph returned an error: ' . $e->getMessage();
              exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
              echo 'Facebook SDK2 returned an error: ' . $e->getMessage();
              exit;
            }

            $user = $response->getGraphUser();
            $user_id = $user['id'];
            $user_name = $user['name'];
            $email = $user['email'];
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
                        $this->Session->write('Auth.User.accessToken', $accessToken);
                        return $this->redirect(array('controller'=>'users','action' => 'dashboard'));
                    
                } else {
                        $this->Flash->error(__('Something went wonrg. Try again later'));
                return $this->redirect(array('controller'=>'users','action' => 'index'));
                }
                  }

              }
            }
        }else{
             $this->request->data['User']['username'] = $user_id;  
                   $this->request->data['User']['password'] =$password;
                    if ($this->Auth->login()) {
                    $this->Session->write('Auth.User.accessToken', $accessToken);
                    return $this->redirect(array('controller'=>'users','action' => 'dashboard'));
                } else {
                        $this->Flash->error(__('Something went wonrg. Try again later'));
                return $this->redirect(array('controller'=>'users','action' => 'index'));
                }   
            }

           // echo '<h3>Long-lived</h3>';
          //var_dump($user);

        // User is logged in with a long-lived access token.
        // You can redirect them to a members-only page.
        //header('Location: https://example.com/members.php');
	}
    
    public function earning() {
         $this->autoRender = false;
        
            
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
            if(!empty($users[$key]['User']['last_share'])){
            $cutime=new DateTime($users[$key]['User']['last_share']);
            $users[$key]['User']['last_share'] = $cutime->format("Y-m-d");
            $cutime = NULL;
            }
             $users[$key]['sum']=0;
            foreach($user['Post'] as $post){
                $users[$key]['sum'] += $post['earned'];
            }
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
            $this->Session->delete('oauth');
            $this->Auth->logout();
            $this->redirect(array('controller' => 'users', 'action' => 'index'));       
        
        }
}
