<?php
declare(strict_types=1);

require_once("Model/Event.php");
require_once("Model/constants.php");
require_once("Controller/functions.php");

//recoger url
$url=$_GET["url"];

if(($url==null)||(strcmp($url,'')==0)){
    renderView("catchUrl",[]);
    return;
}

//obtener json de repuesta
$data = getUrlData($url);

if(count($data)<=0){
    renderView("catchUrl",[]);
    return;
}

//crear modelo
$evento = new Event($data["idEvento"],$data["title"],
    $data["url"],$data["type"],$data["firstPerformerImage"],
    $data["positions"]
);

//ordenar
$sort = $_GET["sort"] ?? 'SectorRow';
applySort($sort, $evento);

//Mostrar Vista
renderView("homePage",["evento" => $evento]);

?>