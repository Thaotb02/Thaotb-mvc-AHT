<?php

namespace MyApp\Models;

use MyApp\Models\TaskResourceModel;
use MyApp\Models\TaskModel;

class TaskRepository 
{
    protected $taskResourceModel;
    public function __construct()
    {
        $task =new TaskModel();
        $this->taskResourceModel = new TaskResourceModel('tasks', 'id', $task);
    }

    public function getAll()
    {
        return $this->taskResourceModel->getAll();
    }

    public function add($model)
    {
        return $this->taskResourceModel->save($model);
    }
    public function get($id)
    {
        return $this->taskResourceModel->find($id);
    }
    public function delete($id)
    {
        return $this->taskResourceModel->delete($id);
        
    }
    public function update($model)
    {
        return $this->taskResourceModel->save($model);
    }
}