<?php
namespace MyApp\Core;

use MyApp\Core\Model;
use MyApp\Models\TaskModel;
use MyApp\Config\Database;
use MyApp\Core\ResourceModelInterface;

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
        $sql = "SELECT * FROM $this->table";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function save($model)
    {
        $arrData= $model->getProperties();
        $placeInsert=[];
        $arrKey=[];
        $placeUpdate=[];

        if ($model->getId()===null)
        {
            unset($arrData['id']);
            foreach ($arrData as $key=>$value){
                $arrKey[] =$key;
                array_push($placeInsert, ':'.$key);
            }
            $strKey= implode(', ',$arrKey);
            $strPlaceholder=implode(', ',$placeInsert);
            $sql ="INSERT INTO $this->table ($strKey) VALUES ($strPlaceholder)";
            $req =Database::getBdd()->prepare($sql);
            return $req->execute($arrData);

        }else
        {
            foreach ($arrData as $key=>$value){
                array_push($placeUpdate, $key.' = :'.$key);
            }
            $strPlaceUpdate=implode(', ',$placeUpdate);
            $sql="UPDATE $this->table SET $strPlaceUpdate WHERE id=:id";
            $req=Database::getBdd()->prepare($sql);
            return $req->execute($arrData);
        }
    }

    public function find($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id =" . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$id]);
    }

}
?>
