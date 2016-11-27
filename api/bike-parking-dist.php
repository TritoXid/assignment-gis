<?php

extract($_GET);

//pripojenie na DB
require "db-config.php";

$data = $db->prepare("SELECT amenity, name, way, ST_AsGeoJSON(way) AS parking 
FROM planet_osm_point 
WHERE amenity='bicycle_parking' 
AND ST_Distance(way::geography, 'POINT($lon $lat)'::geography) < $dist");
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