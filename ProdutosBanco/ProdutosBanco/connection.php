<?php
class connection {

    private static $conn = null;

    public static function getConnection() {

        if(self::$conn == null) {
       
            $opcoes = array(
           
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
       
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            );

            //ATENÇÃO: alterar os dados da conexão de acordo com o ambiente onde a 
            //aplicação será executada
            self::$conn = new PDO("mysql:host=localhost;dbname=produtos", 
                "root", "bancodedados", $opcoes);
        }

        return self::$conn;
    }
}
