<?php
include 'vendor/class/Tarefa.php';
$checkbox = isset($_POST['checkbox']) ? $_POST['checkbox'] : "";
// echo "<script>alert('$checkbox')</script>";

$valor = isset($_POST['valor']) ? $_POST['valor'] : "";
// echo "<script>alert('$valor')</script>";
$marcado = isset($_POST['marcado']) ? $_POST['marcado'] : "";
// echo "<script>alert('$marcado')</script>";
if ($marcado == "true") {
    $marcado = 1;
   
    $querytarefa->status($marcado,$valor);
    header("Location:index.php");
} else if ($marcado == "false") {
    $marcado = 0;
    
    $querytarefa->status($marcado,$valor);
    header("Location:index.php");
}
?>