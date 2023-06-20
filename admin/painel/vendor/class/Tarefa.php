<?php
include_once "Database.php";

class Tarefa extends Database
{

    public function __construct()
    {
        parent::getInstancia();
    }

    public function verTudo($userId)
    {
        $database = Database::getInstancia();
        $database = $this->getInstancia();

        $sql = "SELECT *
      FROM tbl_tarefa WHERE user_id = $userId";
        $read = $database->query($sql);

        $tarefas = [];

        while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
            $tarefas[] = $row;
        }

        return $tarefas;
    }

    public function ver($id)
    {
        $database = Database::getInstancia();
        $database = $this->getInstancia();
        $sql = "select * from tbl_tarefa where id_tarefa = '{$id}'";
        $read = $database->query($sql);
        $tarefa = $read->fetch(PDO::FETCH_ASSOC);
        return $tarefa;
    }


    public function criarTarefa($userId)
    {
        $database = Database::getInstancia();

        $database = $this->getInstancia();

        $descricao = $_POST['descricao'];

        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $database->prepare("insert into tbl_tarefa(descricao_tafera,status_tarefa,user_id) values (:descricao,:status,:userId)");

        $query->bindValue(":descricao", "$descricao");
        $query->bindValue(":status", 1);
        $query->bindValue(":userId", $userId);
        $query->execute();
        header("Location: index.php");
    }

    public function deletarTarefa()
    {
        $database = Database::getInstancia();

        $database = $this->getInstancia();
        $sql = "delete from tbl_tarefa where id_tarefa='{$_POST['idDeletar']}'";
        $database->query($sql);
    }

    public function editarTarefa()
    {
        $database = Database::getInstancia();

        $database = $this->getInstancia();

        $id = $_POST['idTarefa'];
        $descricao = $_POST['descricao'];


        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $database->prepare("update tbl_tarefa set descricao_tafera= :descricao where id_tarefa = $id");
        $query->bindValue(":descricao", "$descricao");
        $query->execute();
        header("Location: index.php");
    }
}
