<?php
declare(strict_types=1);

require_once("Model/Event.php");
require_once("Controller/functions.php");

const ORIGIN = "Model/mock.json";

//obtener json de repuesta
$data = getUrlData(ORIGIN);

//crear modelo
$evento = new Event($data);

//ordenar
$sort = $_GET["sort"] ?? 'SectorRow';
applySort($sort, $evento);

//Mostrar Vista
renderView("homePage",["evento" => $evento]);

?>