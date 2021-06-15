<?php

namespace MyApp\Models;

use MyApp\Models\TaskResourceModel;

class TaskRepository 
{
    public function getAll()
    {
        $task=new TaskResourceModel();
        return $task->getAll();
    }

    public function add($model)
    {
        $task=new TaskResourceModel();
        return $task->save($model);
    }
    public function get($id)
    {
        $task= new TaskResourceModel();
        return $task->find($id);
    }
    public function delete($id)
    {
        $task=new TaskResourceModel();
        return $task->delete($id);
        
    }
    public function update($model){
        $task=new TaskResourceModel();
        return $task->save($model);
    }
}