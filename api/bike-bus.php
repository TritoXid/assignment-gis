<?php
//pripojenie na DB
require "db-config.php";

$data = $db->prepare("SELECT osm_id, highway, name, ST_AsGeoJSON(way) AS busstop FROM planet_osm_point WHERE highway='bus_stop'");
$data->execute();

//globalna premenna pre array
$points = [];

foreach ($data as $point){
    $busstop = json_decode($point["busstop"]);
    $name = $point["name"];

    $points[] = [
        "type"=> "Feature",
        "geometry"=> $busstop,
        "properties"=> [
            "title"=> $name. " Bus stop",
            "marker-color"=> "#9932CC",
            "marker-size"=> "small",
            "marker-symbol"=> "bus"
        ]
    ];
}

// kontrola co obsahuje json
echo json_encode ($points);
?>