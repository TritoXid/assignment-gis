<?php
//pripojenie na DB
require "db-config.php";

$data = $db->prepare("SELECT osm_id, bicycle, highway, route, name, ST_AsGeoJSON(way) AS bikeway FROM planet_osm_line WHERE bicycle='yes' OR route='bicycle'");
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
        "properties"=> [
            "color"=> "red",
            "weight"=> 5,
            "opacity"=> 0.6
            ]
    ];

}

/*$points = [
    [48.1712548, 17.2304242],[48.1710026, 17.2286062],
    [48.1709953, 17.228313],[48.1712533, 17.2283351],
    [48.1715717, 17.2283351],[48.1718186, 17.2283673],
];*/

// kontrola co obsahuje json
echo json_encode ($points);
?>