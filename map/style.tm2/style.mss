Map {
  background-color: #eeeeee;
}

@water: blue;
@forest: green;
@pub_services: white;
@industry: #ff8;
@other_landuse: lightgreen;
@airport: darkviolet;
@border: gray;
@building: gray;
@wetland: lightblue;
@traffic: #aaaa00;
@administration: black;
@tunnel: gray;
@rail: black;
@tram: red;
@road_outer: #d83;
@road_inner: #fe3;
@water_labels: #036;
@road_labels: black;

#landuse {
  [class= 'forest'] { polygon-fill: @forest; }
  [class= 'cemetery'],
    [class= 'hospital'],
    [class= 'school'] { polygon-fill: @pub_services; }
  [class= 'industrial'] { polygon-fill: @industry; }
  
  polygon-fill: @other_landuse;
}

#waterway {
  line-color: @water;
  line-width: 0.5;
  [zoom >= 12] { line-width: 1; }
  [zoom >= 14] { line-width: 2; }
  [zoom >= 16] { line-width: 3; }
}

#water {
  polygon-fill: @water;
  polygon-gamma: 0.6;
}

#aeroway {
  line-color: @airport;
  polygon-fill: @airport;
}

#barrier_line {
  line-color: @border;
  line-width: 0.5;
  [zoom >= 12] { line-width: 1; }
  [zoom >= 14] { line-width: 2; }
}

#building {
  line-color: @building;
  polygon-fill: @building;
}

#tunnel {
  ::case {
    [zoom >= 14] { line-width: 12; }
    [zoom >= 15] { line-width: 14; }
    [zoom >= 16] { line-width: 16; }
    [zoom >= 17] { line-width: 18; }
    [zoom >= 18] { line-width: 24; }
    [zoom >= 19] { line-width: 27; }
    [zoom >= 20] { line-width: 30; }
    line-color: @tunnel;
    line-dasharray: 4, 3;
  }
  ::fill {
    [zoom >= 14] { line-width: 6; }
    [zoom >= 15] { line-width: 7; }
    [zoom >= 16] { line-width: 8; }
    [zoom >= 17] { line-width: 9; }
    [zoom >= 18] { line-width: 12; }
    [zoom >= 19] { line-width: 13.5; }
    [zoom >= 20] { line-width: 15; }
    line-color: #fff;
  }
}

#road, #bridge {
  ::case {
    [zoom >= 14] { line-width: 2; }
    [zoom >= 15] { line-width: 4; }
    [zoom >= 16] { line-width: 6; }
    [zoom >= 17] { line-width: 8; }
    [zoom >= 18] { line-width: 14; }
    [zoom >= 19] { line-width: 17; }
    [zoom >= 20] { line-width: 20; }
    line-color: @road_outer;
  }
  ::fill {
    [zoom >= 14] { line-width: 1; }
    [zoom >= 15] { line-width: 2; }
    [zoom >= 16] { line-width: 3; }
    [zoom >= 17] { line-width: 4; }
    [zoom >= 18] { line-width: 7; }
    [zoom >= 19] { line-width: 8.5; }
    [zoom >= 20] { line-width: 10; }
    line-color: @road_inner;
  }
}

#railway {
  [class= 'rail'] {
    ::line {
      [zoom >= 14] { line-width: 2; }
      [zoom >= 15] { line-width: 4; }
      [zoom >= 16] { line-width: 6; }
      [zoom >= 17] { line-width: 8; }
      [zoom >= 18] { line-width: 14; }
      [zoom >= 19] { line-width: 17; }
      [zoom >= 20] { line-width: 20; }
      line-color: @rail;
    }
    ::dash {
      [zoom >= 14] { line-width: 1; line-dasharray: 6, 6; }
      [zoom >= 15] { line-width: 2; line-dasharray: 12, 12; }
      [zoom >= 16] { line-width: 3; line-dasharray: 18, 18; }
      [zoom >= 17] { line-width: 4; line-dasharray: 24, 24; }
      [zoom >= 18] { line-width: 7; line-dasharray: 42, 42; }
      [zoom >= 19] { line-width: 8.5; line-dasharray: 51, 51; }
      [zoom >= 20] { line-width: 10; line-dasharray: 60, 60; }
      line-color: white;
    }
  }
  
  [class= 'tram'] {
    ::line {
      [zoom >= 14] { line-width: 2; }
      [zoom >= 15] { line-width: 4; }
      [zoom >= 16] { line-width: 6; }
      [zoom >= 17] { line-width: 8; }
      [zoom >= 18] { line-width: 14; }
      [zoom >= 19] { line-width: 17; }
      [zoom >= 20] { line-width: 20; }
      line-color: @tram;
    }
    ::dash {
      [zoom >= 14] { line-width: 1; line-dasharray: 6, 6; }
      [zoom >= 15] { line-width: 2; line-dasharray: 12, 12; }
      [zoom >= 16] { line-width: 3; line-dasharray: 18, 18; }
      [zoom >= 17] { line-width: 4; line-dasharray: 24, 24; }
      [zoom >= 18] { line-width: 7; line-dasharray: 42, 42; }
      [zoom >= 19] { line-width: 8.5; line-dasharray: 51, 51; }
      [zoom >= 20] { line-width: 10; line-dasharray: 60, 60; }
      line-color: white;
    }
  }
}

#administrative_level {
}

#waterway_label, #water_label {
  text-name: [name];
  text-face-name: 'Open Sans Condensed Bold';
  text-fill: @water_labels;
  text-placement: line;
  text-placement-type: simple;
  text-placements: "N,S,E,W,NE,SE,NW,SW,16,14,12";
  text-halo-fill: fadeout(white, 30%);
  text-halo-radius: 2.5;
  text-wrap-width: 80;
  text-wrap-before: true;
  text-size: 18;
  text-max-char-angle-delta: 15;
  
}

#road_label {
  text-name: [name];
  text-face-name: 'Open Sans Condensed Bold';
  text-fill: @road_labels;
  text-placement: line;
}