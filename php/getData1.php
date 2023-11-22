<?php
session_start();
$conn = new mysqli("localhost", "server", "00000000", "dataset");
date_default_timezone_set('Asia/Seoul');

for ($count = 0; $count <= 9; $count++) {
    //검사 이력 10개 추출
    $sql002 = "select * from result1 order by id desc limit " . $count . ", 1";
    $res002 = mysqli_query($conn, $sql002);
    $row002 = mysqli_fetch_array($res002);

    ${'data1' . $count} = $row002['data1'];
    ${'data2' . $count} = $row002['data2'];
    ${'data3' . $count} = $row002['data3'];
    ${'data4' . $count} = $row002['data4'];
    ${'data5' . $count} = $row002['data5'];
    ${'data6' . $count} = $row002['data6'];
    ${'data7' . $count} = $row002['data7'];
    ${'data8' . $count} = $row002['data8'];

    array_push($data, ${'data1' . $count});
    array_push($data, ${'data2' . $count});
    array_push($data, ${'data3' . $count});
    array_push($data, ${'data4' . $count});
    array_push($data, ${'data5' . $count});
    array_push($data, ${'data6' . $count});
    array_push($data, ${'data7' . $count});
    array_push($data, ${'data8' . $count});
}

echo json_encode($data);
