<?php

class MediasController extends AppController {

    var $uses = array('User');

    function beforeFilter() {
        // $id = $this->Auth->user('id');
        $this->Auth->allow('authenticatewith', 'applyoffer');
    }

    public function index() {

    }

    public function authenticatewith() {
       $var= $this->Auth->password('obumneke');



        $this->set('test', $var);
    }


}
