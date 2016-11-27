<?php

extract($_GET);

//pripojenie na DB
require "db-config.php";

$data = $db->prepare("WITH
place AS (SELECT landuse, name, way, ST_AsGeoJSON(way) AS park FROM planet_osm_polygon WHERE landuse IN('grass','forest','village_green')
ORDER BY ST_Distance(way::geography, 'POINT($lon $lat)'::geography))

SELECT place.park, ST_AsGeoJSON(other.way) AS otherpoint, other.amenity
FROM place
JOIN planet_osm_point AS other ON ST_Contains(place.way, other.way)
WHERE other.amenity IN ('drinking_water','water_point','fountain','bench','shelter','bicycle_parking')
OR other.leisure IN ('playground','picnic_table','firepit')
AND other.amenity IS NOT null
LIMIT 5");
$data->execute();

//globalna premenna pre array
$points = [];
$park = [];

foreach ($data as $point){
    $place = json_decode($point["park"]);
    $otherpoint= json_decode($point["otherpoint"]);

    // zo selectu musim dostat iba suradnice ciest
    $parks = [];
    foreach ($place->coordinates as $park){
        $parks[] = $park;
    }

    $points[] = [
        "type"=> "Feature",
        "geometry"=> [
            "type"=> $place->type,
            "coordinates"=> $parks
        ]
    ];

    switch ($point["amenity"])
    {
        case "drinking_water": $symbol = "water"; $color = "#0000CD"; break; //color -> MediumBlue
        case "water_point":$symbol = "water"; $color = "#1E90FF"; break; //color -> DodgerBlue
        case "fountain": $symbol = "water"; $color = "#00008B"; break; //color -> DarkBlue

        case "bicycle_parking":$symbol = "bicycle"; $color = "#00FF00"; break; //color -> Lime

        case "bench": $symbol = "marker"; $color = "#FF0000"; break; //lavicka, color -> Red
        case "shelter":$symbol = "marker"; $color = "#A0522D"; break; //pristresok, color -> Sienna

        case "playground":$symbol = "marker"; $color = "#FFFF00"; break; //ihrisko pre deti, color -> Yellow

        case "picnic_table": $symbol = "marker"; $color = "#808000"; break; //piknikovy stol, color -> Olive
        case "firepit":$symbol = "marker"; $color = "#FF4500"; break; //camping, color -> OrangeRed

        default: $symbol = "marker"; $color = "#F5F5F5"; // color -> Orange
    }

    $points[] = [
        "type"=> "Feature",
        "geometry"=> $otherpoint,
        "properties"=> [
            "marker-name"=> $point["amenity"],
            "marker-color"=> $color,
            "marker-size"=> "small",
            "marker-symbol"=> $symbol
        ]
    ];

}


// kontrola co obsahuje json
echo json_encode ($points);
?>