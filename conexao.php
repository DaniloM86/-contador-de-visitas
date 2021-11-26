<?php
  abstract class Conexao{
    public function conectar()
    {
        try {
            $conn = new PDO("mysql:host=localhost;dbname=visitaSite","root","");
            return $conn;
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }
}  