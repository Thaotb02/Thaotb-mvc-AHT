<?php

namespace MyApp\Models;

use MyApp\Core\Model;

class TaskModel extends Model {

  protected $title,
            $description,
            $id,
            $updated_at,
            $created_at;

    public function getId()
    {
        return $this->id;
    }

     public function setId($id)
     {
        return $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

     public function setTitle($title)
     {
        return $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        return $this->description = $description;
    }

     public function getCreateAt()
     {
        return $this->created_at;
    }

    public function setCreateAt($created_at)
    {
        return $this->created_at = $created_at;
    }

    public function getUpdateAt()
    {
        return $this->updated_at;
    }

    public function setUpdateAt($updated_at)
    {
        return $this->updated_at = $updated_at;
    }

}
?>