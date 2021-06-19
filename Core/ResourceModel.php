<?php
namespace MyApp\Core;

use MyApp\Core\Model;
use MyApp\Models\TaskModel;
use MyApp\Config\Database;
use MyApp\Core\ResourceModelInterface;
use PDO;

class ResourceModel 
{
    private $id,
            $model,
            $table;

    public function call_init($table, $id, $model)
    {
        $this->id = $id;
        $this->table = $table;
        $this->model = $model;
    }
    
    public function getAll()
    {
        $class = get_class($this->model);
        $sql = "SELECT * FROM $this->table";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_CLASS,$class);
    }

    public function save($model)
    {
        $arrData= $model->getProperties();
        // print_r($arrData) ;
        // die();
        $placeInsert=[];
        $arrKey=[];
        $placeUpdate=[];

        foreach ($arrData as $key=>$value)
        {
            $arrKey[] =$key;
            array_push($placeInsert, ':'.$key);
            array_push($placeUpdate, $key.' = :'.$key);
        }

        if ($model->getId()===null)
        {
            $strKey= implode(', ',$arrKey);
            $strPlaceholder=implode(', ',$placeInsert);
            $sql ="INSERT INTO $this->table ($strKey) VALUES ($strPlaceholder)";
            $req =Database::getBdd()->prepare($sql);
            return $req->execute($arrData);

        }else
        {
            $strPlaceUpdate=implode(', ',$placeUpdate);
            $sql="UPDATE $this->table SET $strPlaceUpdate WHERE id=:id";
            $req=Database::getBdd()->prepare($sql);
            return $req->execute($arrData);
        }
    }

    public function find($id)
    {
        $class = get_class($this->model);
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$id]);
       $result=$req->fetchObject($class);
        return $result;

    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$id]);
    }

}
?>
