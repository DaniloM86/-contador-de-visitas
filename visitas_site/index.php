<?php

require_once('../visitas.php');

$visita = new Visitas();
$visita->VerificaVisitas();
$visita->InserirVisitas();
