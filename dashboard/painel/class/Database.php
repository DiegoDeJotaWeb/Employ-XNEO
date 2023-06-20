<?php
class PdoConexao {
    private static $instancia;
   
    // Impedir instanciação
    private function __construct() { }
    // Impedir clonar
    private function __clone() { }
   
    //Impedir utilização do Unserialize
    public function __wakeup() { }
 
    public static function getInstancia() {
        if(!isset(self::$instancia)) {
             try {
                $dsn = "mysql:host=localhost;dbname=usuario"; 
                $usuario = "root"; 
                $senha = ""; 
               
                 self::$instancia = new PDO( $dsn, $usuario, $senha );
                                  
                 self::$instancia->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
             
             } catch ( PDOException $excecao ){
                 echo $excecao->getMessage();
             
                 exit();
             }
         }
         return self::$instancia;
        }
   }
?>