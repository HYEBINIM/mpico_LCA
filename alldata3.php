<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI 알고리즘 기반 파라메터 세팅 알림</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1rem;
        }

        .container {
            display: flex;
            justify-content: space-around;
            margin: 20px;
        }

        .column {
            width: 30%;
            padding: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <header>
        <h1>AI 알고리즘 기반 파라메터 세팅 알림</h1>
    </header>

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

    // 가장 최근 1개의 데이터를 가져오기
    $sql_last_row = "SELECT Inj_velocity, Inj_pressure, Inj_Position FROM $table ORDER BY TimeStamp DESC LIMIT 1";
    $result_last_row = $conn->query($sql_last_row);

    // 'program'이 'master'인 행을 찾기
    $sql_master = "SELECT Inj_velocity, Inj_pressure, Inj_Position FROM $table WHERE program = 'master' ORDER BY TimeStamp DESC LIMIT 1";
    $result_master = $conn->query($sql_master);

    if ($result_last_row->num_rows > 0 && $result_master->num_rows > 0) {
        $row_last_row = $result_last_row->fetch_assoc();
        $row_master = $result_master->fetch_assoc();

        // 4개 값만 사용
        $velocity_diff = array_slice(explode('/', $row_last_row['Inj_velocity']), 0, 4);
        $pressure_diff = array_slice(explode('/', $row_last_row['Inj_pressure']), 0, 4);
        $position_diff = array_slice(explode('/', $row_last_row['Inj_Position']), 0, 4);

        $velocity_master = array_slice(explode('/', $row_master['Inj_velocity']), 0, 4);
        $pressure_master = array_slice(explode('/', $row_master['Inj_pressure']), 0, 4);
        $position_master = array_slice(explode('/', $row_master['Inj_Position']), 0, 4);

        // 결과 표시
        echo "<div class='container'>";
        
        echo "<div class='column'>";
        echo "<table>";
        echo "<tr><th></th><th>Last Row</th></tr>";
        echo "<tr><td>Inj_velocity</td><td>" . implode('</td></tr><tr><td>Inj_velocity</td><td>', $velocity_diff) . "</td></tr>";
        echo "<tr><td>Inj_pressure</td><td>" . implode('</td></tr><tr><td>Inj_pressure</td><td>', $pressure_diff) . "</td></tr>";
        echo "<tr><td>Inj_Position</td><td>" . implode('</td></tr><tr><td>Inj_Position</td><td>', $position_diff) . "</td></tr>";
        echo "</table>";
        echo "</div>";
        
        echo "<div class='column'>";
        echo "<table>";
        echo "<tr><th></th><th>Master Program</th></tr>";
        echo "<tr><td>Inj_velocity</td><td>" . implode('</td></tr><tr><td>Inj_velocity</td><td>', $velocity_master) . "</td></tr>";
        echo "<tr><td>Inj_pressure</td><td>" . implode('</td></tr><tr><td>Inj_pressure</td><td>', $pressure_master) . "</td></tr>";
        echo "<tr><td>Inj_Position</td><td>" . implode('</td></tr><tr><td>Inj_Position</td><td>', $position_master) . "</td></tr>";
        echo "</table>";
        echo "</div>";
        
        echo "<div class='column'>";
        echo "<table>";
        echo "<tr><th></th><th>Diff</th></tr>";
        echo "<tr><td>Inj_velocity</td><td>" . implode('</td></tr><tr><td>Inj_velocity</td><td>', array_map(function($a, $b) { return $a - $b; }, $velocity_diff, $velocity_master)) . "</td></tr>";
        echo "<tr><td>Inj_pressure</td><td>" . implode('</td></tr><tr><td>Inj_pressure</td><td>', array_map(function($a, $b) { return $a - $b; }, $pressure_diff, $pressure_master)) . "</td></tr>";
        echo "<tr><td>Inj_Position</td><td>" . implode('</td></tr><tr><td>Inj_Position</td><td>', array_map(function($a, $b) { return $a - $b; }, $position_diff, $position_master)) . "</td></tr>";
        echo "</table>";
        echo "</div>";

        echo "</div>";
    }

    $conn->close();
    ?>
</body>
</html>
