<?php
class Post extends AppModel {
     var $name = 'Post';
     public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            ),
         );
}
?>