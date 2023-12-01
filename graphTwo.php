<?php
    header('Content-Type: application/json');
    $con = mysqli_connect("localhost", "root", "", "iot");
    if(!$con) {
        die("Conexion fallida: ".mysqli_connect_error());
    } else {
        $data_points = array();
        $result = mysqli_query($con, "SELECT * FROM information"); 
        while ($row = mysqli_fetch_array($result)) {
            $point = array("valorX" => $row['datahour'], "valorY" => $row['humidityAir']);
            array_push($data_points, $point);
        }
        echo json_encode($data_points);
    }
    mysqli_close($con);
?>