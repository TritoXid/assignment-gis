<?php
//pripojenie na DB
require "db-config.php";

$data = $db->prepare("SELECT osm_id,amenity,name,ST_AsGeoJSON(way) AS parking FROM planet_osm_point WHERE amenity in ('bicycle_parking')");
$data->execute();

//globalna premenna pre array
$points = [];


foreach ($data as $point){
    $parking = json_decode($point["parking"]);
    $name = $point["name"];

    $points[] = [
        "type"=> "Feature",
        "geometry"=> $parking,
        "properties"=> [
            "title"=> $name. " Parking place",
            "marker-color"=> "#00FF00",
            "marker-size"=> "small",
            "marker-symbol"=> "bicycle"
        ]
    ];
}

// kontrola co obsahuje json
echo json_encode ($points);
?>