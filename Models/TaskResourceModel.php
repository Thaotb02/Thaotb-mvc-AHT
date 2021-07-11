<?php

namespace MyApp\Models;

use MyApp\Core\ResourceModel;
use MyApp\Models\TaskModel;

class TaskResourceModel extends ResourceModel {

    public function __construct()
    {
        
       $task =new TaskModel();
       parent::call_init('tasks','id', $task );
    }
}


?>