<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI 알고리즘 기반 파라메터 세팅 알림</title>
    <link rel="stylesheet" href="/css/alldata3.css">
</head>

<body>
    <!-- 전체 판넬 -->
    <div class="wrapper">

        <!-- 상단바 -->
        <div class="top_bar">
            <div class="logo">
                <a class='logo_item' href="/index.html">EAST</a>
            </div>
            <div class="menu">
                <a class='menu_item active' href="/index.html">대시보드</a>
                <a class='menu_item' href="/alldata1.php">F/P 데이터</a>
                <a class='menu_item' href="/alldata2.php">개별 데이터</a>
                <a class='menu_item' href="/alldata3.php">AI 파라미터</a>
                <!-- <a class='menu_item' href="/page/set1.html">실시간검사화면</a>
        <a class='menu_item' href="/page/set2.html">검사이력</a>
        <a class='menu_item' href="/page/set4.html">사출기화면</a>
        <a class='menu_item' href="/page/set4.html">로봇화면</a>
        <a class='menu_item' href="/page/set3.html">풀프루프화면</a>
        <a class='menu_item' href="/page/set3.html">풀프루프설정</a> -->
            </div>
        </div>
        <h1>AI 알고리즘 기반 파라메터 세팅 알림</h1>

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
    </div>
</body>

</html>