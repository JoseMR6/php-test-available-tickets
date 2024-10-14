<?php
const PROJECT_NAME = "Test Available Tickets";

const LOCAL_JSON = "Model/mock.json";

const SEATGEEK_EXAMPLE_URL = "https://seatgeek.com/taylor-swift-tickets/toronto-canada-rogers-centre-2024-11-15-7-pm/concert/6109452";

const URL_TYPES=[
    "SEATGEEK"=>"seatgeek",
    "FILE_JSON"=>"fileJSON"
];

//utilizar tus claves de autentificacion personales
$GLOBALS["SEATGEEK_AUTH"] = [
    "CLIENT_ID" => "",
    "SECRET" => ""
];

include("Model/authentication.php");
?>