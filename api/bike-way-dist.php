<?php

extract($_GET);

//pripojenie na DB
require "db-config.php";

$data = $db->prepare("SELECT name, ST_AsGeoJSON(way) AS bikeway FROM (
	SELECT bicycle, highway, route, name, way FROM planet_osm_line WHERE bicycle='yes' OR route='bicycle'
) AS bikeway
WHERE
ST_Distance(way::geography, 'POINT($lon $lat)'::geography) < $dist
OR
ST_Distance(way::geography, 'POINT($lon $lat)'::geography) < $dist");
$data->execute();

//globalna premenna pre array
$points = [];
$style = [];

foreach ($data as $point){
    $bikeway = json_decode($point["bikeway"]);
    $name = $point["name"];

    // zo selectu musim dostat iba suradnice ciest
    $roads = [];
    foreach ($bikeway->coordinates as $road){
        $roads[] = $road;
    }

    $points[] = [
        "type"=> "Feature",
        "geometry"=> [
            "type"=> $bikeway->type,
            "coordinates"=> $roads
        ],
        "style"=> [
            "color"=> "#ff0000",
            "weight"=> "3",
            "opacity"=> 0.6
        ]
    ];
}


// kontrola co obsahuje json
echo json_encode ($points);
?>