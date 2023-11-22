<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>개별 데이터 그래프</title>
    <link rel="stylesheet" href="/css/alldata2.css">
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
        <h1>개별 데이터 그래프</h1>

        <?php
    // 데이터베이스 연결 설정
    $host = "127.0.0.1";
    $username = "root";
    $password = "autoset";
    $database = "dataset";
    $table = "alldata";

    // 데이터베이스 연결에서 UTF-8 설정 추가
    $conn = new mysqli($host, $username, $password, $database);
    $conn->set_charset("utf8");

    // 연결 오류 처리
    if ($conn->connect_error) {
        die("데이터베이스 연결 실패: " . $conn->connect_error);
    }

    // 데이터베이스에서 데이터 가져오기
    $sql = "SELECT * FROM $table ORDER BY id ASC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $keys = array_keys($row);

        echo "<div class='chart-container'>";

        // 개별 데이터 그래프 생성
        $count = 0;
        foreach ($keys as $key) {
            if ($key == "id" || $key == "TimeStamp") {
                continue; // ID 및 TimeStamp 필드는 제외
            }

            // '/'로 구분된 데이터에서 숫자로 된 값만 사용
            $value = $row[$key];
            $values = array_filter(explode('/', $value), 'is_numeric');

            if (!empty($values)) {
                $label = htmlspecialchars($key);
                $numeric_value = floatval(reset($values));

                echo "<div class='graph-box'>";
                echo "<h2>$label</h2>";
                echo "<div class='chart-container'>";
                echo "<canvas id='barChart_$key'></canvas>";
                echo "</div>";

                echo "<script src='https://cdn.jsdelivr.net/npm/chart.js'></script>";
                echo "<script>";
                echo "var data_$key = {";
                echo "  labels: ['$label'],";
                echo "  datasets: [{";
                echo "    label: '$label',";
                echo "    data: [$numeric_value],";
                echo "    backgroundColor: 'rgba(75, 192, 192, 0.2)',";
                echo "    borderColor: 'rgba(75, 192, 192, 1)',";
                echo "    borderWidth: 1";
                echo "  }]";
                echo "};";
                echo "var ctx_$key = document.getElementById('barChart_$key').getContext('2d');";
                echo "var myChart_$key = new Chart(ctx_$key, {";
                echo "  type: 'bar',";
                echo "  data: data_$key";
                echo "});";
                echo "</script>";
                echo "</div>";

                $count++;
                if ($count % 4 == 0) {
                    echo "</div><div class='chart-container'>";
                }
            }
        }

        echo "</div>";
    } else {
        echo "데이터가 없습니다.";
    }

    // 데이터베이스 연결 닫기
    $conn->close();
    ?>
    </div>
</body>

</html>