<?php
namespace MyApp\Controllers;

use MyApp\Core\Controller;
use MyApp\Core\ResourceModel;
use MyApp\Models\TaskModel;
use MyApp\Models\TaskRepository;

class TasksController extends Controller
{
    function index()
    {
        $task = new TaskRepository();
        $d['tasks'] = $task->getAll();
        $this->set($d);
        $this->render("index");
    }

    public function create()
    {
        $this->render("create");
        if (!empty($_POST["title"]) && !empty($_POST["description"]))
        {
            $task= new TaskModel();
            $task->setTitle($_POST['title']);
            $task->setDescription($_POST['description']);
            $task->setCreateAt(date("Y-m-d H:i:s"));
            $taskR = new TaskRepository();
            if($taskR->add($task)){
               header("Location: " . WEBROOT . "Tasks/index");
            }   
        }
    }

    public function edit($id)
    {
        $taskR= new TaskRepository();
        $d["tasks"] = $taskR->get($id);
        if (isset($_POST["title"]))
        {
            $task=new TaskModel();
            $task->setId($id);
            $task->setTitle($_POST['title']);
            $task->setDescription($_POST['description']);
            $task->setUpdateAt(date("Y-m-d H:i:s"));
            
            if ($taskR->update($task)){
                header("Location: " . WEBROOT . "Tasks/index");
            }
        }
        $this->set($d);
        $this->render("edit");
    }

    public function delete($id)
    {
        $task = new TaskRepository();
        $task->delete($id);
        header("Location: " . WEBROOT . "Tasks/index");
    }
}

?>
