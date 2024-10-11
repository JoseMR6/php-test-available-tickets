<?php
declare(strict_types=1);

require_once("Model/Event.php");

function getUrlData(string $origin):array{
    $result = file_get_contents($origin);
    $data = json_decode($result, true);

    return $data;
}

function applySort(string $name,Event $evento){
    if($name == 'SectorRow'){
        $evento->sortBySectorRow();
    }else if($name == 'Price'){
        $evento->sortByPrice();
    }
}

function  renderView(string $template, array $data = []){
    extract($data);
    require("View/$template.php");
}
?>