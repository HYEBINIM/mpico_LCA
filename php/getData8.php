<?php
session_start();
$conn = new mysqli("localhost", "server", "00000000", "dataset");
date_default_timezone_set('Asia/Seoul');

for ($count = 0; $count <= 9; $count++) {
    //검사 이력 10개 추출
    $sql002 = "select * from result1 order by id desc limit " . $count . ", 1";
    $res002 = mysqli_query($conn, $sql002);
    $row002 = mysqli_fetch_array($res002);

    ${'data' . $count} = $row002['data8'];
}

$data = array(
    "cols" => array(
        array("id" => "", "label" => "aa", "pattern" => "", "type" => "number"),
        array("id" => "", "label" => "bb", "pattern" => "", "type" => "number")
    ),
    "rows" => array(
        array(
            "c" => array(
                array("v" => 9, "f" => null),
                array("v" => (int)$data0, "f" => null)
            )
        ),
        array(
            "c" => array(
                array("v" => 8, "f" => null),
                array("v" => (int)$data1, "f" => null)
            )
        ),
        array(
            "c" => array(
                array("v" => 7, "f" => null),
                array("v" => (int)$data2, "f" => null)
            )
        ),
        array(
            "c" => array(
                array("v" => 6, "f" => null),
                array("v" => (int)$data3, "f" => null)
            )
        ),
        array(
            "c" => array(
                array("v" => 5, "f" => null),
                array("v" => (int)$data4, "f" => null)
            )
        ),
        array(
            "c" => array(
                array("v" => 4, "f" => null),
                array("v" => (int)$data5, "f" => null)
            )
        ),
        array(
            "c" => array(
                array("v" => 3, "f" => null),
                array("v" => (int)$data6, "f" => null)
            )
        ),
        array(
            "c" => array(
                array("v" => 2, "f" => null),
                array("v" => (int)$data7, "f" => null)
            )
        ),
        array(
            "c" => array(
                array("v" => 1, "f" => null),
                array("v" => (int)$data8, "f" => null)
            )
        ),
        array(
            "c" => array(
                array("v" => 0, "f" => null),
                array("v" => (int)$data9, "f" => null)
            )
        )
    )
);

echo json_encode($data);