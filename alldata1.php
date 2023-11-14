<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>LCA 풀푸르프 데이터 시트</title>
    <style>
        body {
            background-color: #333;
            color: #fff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px;
        }
        table, th, td {
            border: 1px solid #555;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>LCA 풀푸르프 데이터 시트</h1>

    <?php

    $host = "127.0.0.1";
    $username = "root";
    $password = "autoset";
    $database = "dataset";
    $table = "alldata";


    $conn = new mysqli($host, $username, $password, $database);
    $conn->set_charset("utf8");


    if ($conn->connect_error) {
        die("데이터베이스 연결 실패: " . $conn->connect_error);
    }


    $sql = "SELECT * FROM $table order by id desc limit 500";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Machine_Name</th>";
        echo "<th>Additional_Info</th>";
        echo "<th>TimeStamp</th>";
        echo "<th>Shot_Number</th>";
        echo "<th>NGmark</th>";
        echo "<th>Injection_Time</th>";
        echo "<th>Filling_Time</th>";
        echo "<th>Plasticizing_Time</th>";
        echo "<th>Cycle_Time</th>";
        echo "<th>Clamp_Close_Time</th>";
        echo "<th>Cushion_Position</th>";
        echo "<th>Switch_Over_Position</th>";
        echo "<th>Plasticizing_Position</th>";
        echo "<th>Clamp_Open_Position</th>";
        echo "<th>Max_Injection_Speed</th>";
        echo "<th>Max_Screw_RPM</th>";
        echo "<th>Average_Screw_RPM</th>";
        echo "<th>Max_Injection_Pressure</th>";
        echo "<th>Max_Switch_Over_Pressure</th>";
        echo "<th>Max_Back_Pressure</th>";
        echo "<th>Average_Back_Pressure</th>";
        echo "<th>Barrel_Temperature</th>";
        echo "<th>Mold_Temperature</th>";
        echo "<th>Inj_Velocity</th>";
        echo "<th>Inj_Pressure</th>";
        echo "<th>Inj_Position</th>";
        echo "<th>SOV_Time</th>";
        echo "<th>SOV_Position</th>";
        echo "<th>Hld_Pressure</th>";
        echo "<th>Hld_Time</th>";
        echo "<th>Hld_Vel</th>";
        echo "<th>Chg_Position</th>";
        echo "<th>Chg_Speed</th>";
        echo "<th>BackPressure</th>";
        echo "<th>Suckback_Position</th>";
        echo "<th>Suckback_Speed</th>";
        echo "<th>program</th>";
        echo "<th>lot_name</th>";
        echo "<th>lot_num</th>";
        echo "<th>contents</th>";
        echo "<th>고정금형 온도</th>";
        echo "<th>이동금형 온도</th>";
        echo "<th>냉각수IN 온도</th>";
        echo "<th>냉각수OUT 온도</th>";
        echo "<th>온수기IN 온도</th>";
        echo "<th>온수기OUT 온도</th>";
        echo "<th>호퍼 온도</th>";
        echo "<th>벨트 온도</th>";
        echo "<th>중량 그램</th>";
        echo "<th>기기내부 온도</th>";
        echo "<th>img_name</th>";
        echo "<th>conclusion1</th>";
        echo "<th>index1</th>";
        echo "<th>ct1</th>";
        echo "</tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["Machine_Name"] . "</td>";
            echo "<td>" . $row["Additional_Info"] . "</td>";
            echo "<td>" . $row["TimeStamp"] . "</td>";
            echo "<td>" . $row["Shot_Number"] . "</td>";
            echo "<td>" . $row["NGmark"] . "</td>";
            echo "<td>" . $row["Injection_Time"] . "</td>";
            echo "<td>" . $row["Filling_Time"] . "</td>";
            echo "<td>" . $row["Plasticizing_Time"] . "</td>";
            echo "<td>" . $row["Cycle_Time"] . "</td>";
            echo "<td>" . $row["Clamp_Close_Time"] . "</td>";
            echo "<td>" . $row["Cushion_Position"] . "</td>";
            echo "<td>" . $row["Switch_Over_Position"] . "</td>";
            echo "<td>" . $row["Plasticizing_Position"] . "</td>";
            echo "<td>" . $row["Clamp_Open_Position"] . "</td>";
            echo "<td>" . $row["Max_Injection_Speed"] . "</td>";
            echo "<td>" . $row["Max_Screw_RPM"] . "</td>";
            echo "<td>" . $row["Average_Screw_RPM"] . "</td>";
            echo "<td>" . $row["Max_Injection_Pressure"] . "</td>";
            echo "<td>" . $row["Max_Switch_Over_Pressure"] . "</td>";
            echo "<td>" . $row["Max_Back_Pressure"] . "</td>";
            echo "<td>" . $row["Average_Back_Pressure"] . "</td>";
            echo "<td>" . $row["Barrel_Temperature"] . "</td>";
            echo "<td>" . $row["Mold_Temperature"] . "</td>";
            echo "<td>" . $row["Inj_Velocity"] . "</td>";
            echo "<td>" . $row["Inj_Pressure"] . "</td>";
            echo "<td>" . $row["Inj_Position"] . "</td>";
            echo "<td>" . $row["SOV_Time"] . "</td>";
            echo "<td>" . $row["SOV_Position"] . "</td>";
            echo "<td>" . $row["Hld_Pressure"] . "</td>";
            echo "<td>" . $row["Hld_Time"] . "</td>";
            echo "<td>" . $row["Hld_Vel"] . "</td>";
            echo "<td>" . $row["Chg_Position"] . "</td>";
            echo "<td>" . $row["Chg_Speed"] . "</td>";
            echo "<td>" . $row["BackPressure"] . "</td>";
            echo "<td>" . $row["Suckback_Position"] . "</td>";
            echo "<td>" . $row["Suckback_Speed"] . "</td>";
            echo "<td>" . $row["program"] . "</td>";
            echo "<td>" . $row["lot_name"] . "</td>";
            echo "<td>" . $row["lot_num"] . "</td>";
            echo "<td>" . $row["contents"] . "</td>";
            echo "<td>" . $row["data1"] . "</td>";
            echo "<td>" . $row["data2"] . "</td>";
            echo "<td>" . $row["data3"] . "</td>";
            echo "<td>" . $row["data4"] . "</td>";
            echo "<td>" . $row["data5"] . "</td>";
            echo "<td>" . $row["data6"] . "</td>";
            //echo "<td>" . $row["data7"] . "</td>";
            echo "<td>" . "120" . "</td>"; // 호퍼 온도 강제
            echo "<td>" . $row["data8"] . "</td>";
            echo "<td>" . $row["data9"] . "</td>";
            echo "<td>" . $row["data10"] . "</td>";
            echo "<td>" . $row["img_name"] . "</td>";
            echo "<td>" . $row["conclusion1"] . "</td>";
            echo "<td>" . $row["index1"] . "</td>";
            echo "<td>" . $row["ct1"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "데이터가 없습니다.";
    }

    $conn->close();
    ?>
</body>
</html>
