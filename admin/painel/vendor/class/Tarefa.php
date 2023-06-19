<?php
include_once "Database.php";

class Tarefa extends Database
{

    public function __construct()
    {
        parent::getInstancia();
    }

    public function readAll()
    {
        parent::getInstancia();
        $database = Database::getInstancia();
        $database = $this->getInstancia();

        $sql = "SELECT *
      FROM tbl_post
      INNER JOIN tbl_catagoria
      ON tbl_post.categoriaId = tbl_catagoria.idCategoria;";
        $read = $database->query($sql);

        $posts = [];

        while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
            $posts[] = $row;
        }

        return $posts;
    }


    public function readCategory($idCategoria)
    {
        parent::getInstancia();
        $database = Database::getInstancia();
        $database = $this->getInstancia();

        $sql = "SELECT *
      FROM tbl_post
      INNER JOIN tbl_catagoria
      ON tbl_post.categoriaId = tbl_catagoria.idCategoria
      where tbl_post.categoriaId = '{$idCategoria}'";
        $read = $database->query($sql);

        $postsCategory = [];

        while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
            $postsCategory[] = $row;
        }
        
        return $postsCategory;
    }


    public function read($id)
    {
        parent::getInstancia();
        $database = Database::getInstancia();

        $database = $this->getInstancia();
        $sql = "select * from tbl_catagoria where idCategoria = '{$id}'";
        $read = $database->query($sql);
        $categoria = $read->fetch(PDO::FETCH_ASSOC);
        return $categoria;
    }


    public function createPost()
    {
        $database = Database::getInstancia();

        $database = $this->getInstancia();



        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $categoria = $_POST['categoria'];
        $userId = $_POST['userId'];


        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $database->prepare("insert into tbl_post(tituloPost,descricaoPost,categoriaId,usuarioId) values (:tituloPost,:descricaoPost,:categoria,:userId)");

        $query->bindValue(":tituloPost", "$titulo");
        $query->bindValue(":descricaoPost", "$descricao");
        $query->bindValue(":categoria", "$categoria");
        $query->bindValue(":userId", "$userId");
        $query->execute();
    }

    public function deletar()
    {
        parent::getInstancia();
        $database = Database::getInstancia();

        $database = $this->getInstancia();
        $sql = "delete from tbl_catagoria where idCategoria='{$_POST['id']}'";
        $database->query($sql);
    }

    public function updateCategory()
    {
        $database = Database::getInstancia();

        $database = $this->getInstancia();

        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];


        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $database->prepare("update tbl_catagoria set 
        tituloCategoria = :tituloCategoria,descricaoCategoria= :descricaoCategoria where idCategoria = $id");

        $query->bindValue(":tituloCategoria", "$titulo");
        $query->bindValue(":descricaoCategoria", "$descricao");
        $query->execute();
    }
}
