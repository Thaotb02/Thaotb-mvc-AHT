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
            $arr= new TaskModel();
            $arr->setTitle($_POST['title']);
            $arr->setDescription($_POST['description']);
            $arr->setCreateAt(date("Y-m-d H:i:s"));
            $task = new TaskRepository();
            if($task->add($arr)){
               header("Location: " . WEBROOT . "Tasks/index");
            }   
        }else{
                echo "lỗi";
            }
    }

    public function edit($id)
    {
        $task= new TaskRepository();
        $d["task"] = $task->get($id);
        $this->set($d);
        $this->render("edit");

        if (isset($_POST["title"]))
        {
            $arr=new TaskModel();
            $arr->setId($id);
            $arr->setTitle($_POST['title']);
            $arr->setDescription($_POST['description']);
            $arr->setUpdateAt(date("Y-m-d H:i:s"));
            
            $task= new TaskRepository();
            if ($task->update($arr)){
                header("Location: " . WEBROOT . "Tasks/index");
            }
        }
    }

    public function delete($id)
    {
        $task = new TaskRepository();
        $task->delete($id);
        header("Location: " . WEBROOT . "Tasks/index");
    }
}

?>
