<?php
require_once('../conexao.php');

class Visitas extends Conexao{
    
    private $id_visita, $ip, $dia, $hora, $timeLimit;
    
    #construtor para setar os atributos
    public function __construct()
    {
        $this->id_visita=0;
        $this->ip =$_SERVER['REMOTE_ADDR'];
        $this->dia = date('Y/m/d');
        $this->hora = date("H:i");
        $this->timeLimit = 50;
    }
    #verifica se o site recebeu visitas
    public function VerificaVisitas()
    {
        $sql =$this->conectar()->prepare("SELECT * FROM tb_contador WHERE ip=:ip 
        AND dia=:dia ORDER BY id_visita DESC");
        $sql->bindParam(':ip', $this->ip, PDO::PARAM_STR);
        $sql->bindParam(':dia', $this->dia, PDO::PARAM_STR);
        $sql->execute();
        if($sql->rowCount() == 0){
            $this->InserirVisitas();
        }else{
            $fsql = $sql->fetch(PDO::FETCH_ASSOC);
            $HoraDB = strtotime($fsql['hora']);
            $HoraAtual = strtotime($this->hora);
            $resultHora = $HoraAtual-$HoraDB;

            if($resultHora > $this->timeLimit){
                $this->InserirVisitas();
            }
        }
        echo '<h2> Quantidade De Visitas No Site:'.$sql->rowCount().'</h2>';
    }
    #inseri a visita no banco de dados
    public function InserirVisitas()
    {
        $sql =$this->conectar()->prepare("INSERT INTO tb_contador(ip,dia,hora)
        VALUES(:ip,:dia,:hora)");
        $sql->bindParam(':ip', $this->ip, PDO::PARAM_STR);
        $sql->bindParam(':dia', $this->dia, PDO::PARAM_STR);
        $sql->bindParam(':hora',$this->hora, PDO::PARAM_STR);
        $sql->execute();
    }
}