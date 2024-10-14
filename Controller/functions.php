<?php

declare(strict_types=1);

require_once("Model/Event.php");
require_once("Model/constants.php");

function getUrlData(string $origin): array
{
    $originSplit = explode("/", $origin);
    $result = '';
    $data = [];

    if ((count($originSplit) >= 3
        && (strcmp($originSplit[0], 'https:') == 0))
    ){
        if (strcmp($originSplit[2], 'seatgeek.com') == 0) {
            //url de seatgeek
            $urlId = $originSplit[count($originSplit) - 1];
            $apiOrigin = urlFormat($origin, URL_TYPES["SEATGEEK"], $urlId);
            $clientId = $GLOBALS["SEATGEEK_AUTH"] ["CLIENT_ID"];
            $clientSecret = $GLOBALS["SEATGEEK_AUTH"] ["SECRET"];
            $auth = base64_encode("{$clientId}:{$clientSecret}");
            $result = file_get_contents(
                $apiOrigin,
                false,
                stream_context_create([
                    'http' =>
                    ['header' => 'Authorization: Basic ' . $auth]
                ])
            );

            if ($result) {
                $dataDecoded = json_decode($result, true);

                $data["idEvento"] = $dataDecoded["id"];
                $data["title"] = $dataDecoded["title"];
                $data["url"] = $dataDecoded["url"];
                $data["type"] = $dataDecoded["type"];
                $data["firstPerformerImage"] = $dataDecoded["performers"][0]["image"];
                $data["positions"] = [];
            }
        }
    } else {
        //fichero json local
        $result = file_get_contents($origin);

        if ($result) {
            $dataDecoded = json_decode($result, true);

            $data["idEvento"] = $dataDecoded["idEvento"];
            $data["title"] = $dataDecoded["title"];
            $data["url"] = $dataDecoded["url"];
            $data["type"] = $dataDecoded["type"];
            $data["firstPerformerImage"] = $dataDecoded["firstPerformerImage"];
            $data["positions"] = $dataDecoded["tickets"];
        }
    }

    return $data;
}

function urlFormat(string $url, string $type, string $id = ""): string
{
    $apiUrl = '';

    if ($type == URL_TYPES["FILE_JSON"]) {
        $apiUrl = $url;
    } else if ($type == URL_TYPES["SEATGEEK"]) {
        $apiUrl = "https://api.seatgeek.com/2/events/$id";
    }

    return $apiUrl;
}

function applySort(string $name, Event $evento)
{
    if ($name == 'SectorRow') {
        $evento->sortBySectorRow();
    } else if ($name == 'Price') {
        $evento->sortByPrice();
    }
}

function  renderView(string $template, array $data = [])
{
    extract($data);
    require("View/$template.php");
}
