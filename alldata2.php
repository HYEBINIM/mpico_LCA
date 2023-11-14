<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>개별 데이터 그래프</title>
    <style>
        body {
            background-color: #333;
            color: #fff;
        }
        .chart-container {
            max-width: 1920px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .graph-box {
            width: 23%;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #555;
            background-color: #444;
        }
    </style>
</head>
<body>
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
</body>
</html>
