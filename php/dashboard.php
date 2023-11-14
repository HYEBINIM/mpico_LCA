<?php
session_start();
$conn = new mysqli("localhost", "server", "00000000", "dataset");
date_default_timezone_set('Asia/Seoul');

$data = array();

//////////////////////////////////////////////////최근 검사
//가장 최근 검사
$sql00 = "select * from alldata order by id desc limit 1";
$res00 = mysqli_query($conn, $sql00);
$row00 = mysqli_fetch_array($res00);

$date = date('Y-m-d', strtotime($row00['TimeStamp']));
$time = date('H:i:s', strtotime($row00['TimeStamp']));
$item_name = $row00['Machine_Name'];

$sql000 = "select * from result1 order by id desc limit 1";
$res000 = mysqli_query($conn, $sql000);
$row000 = mysqli_fetch_array($res000);

//임시 result1 사용
//conclusion은 숫자로 되어있으므로 변환함
if ($row000['conclusion1'] == 1) {
    $conclusion = "합격";
} else {
    $conclusion = "불합격";
}
// 검사날짜
// 검사시각
// 제품명
// 합격여부
array_push($data, $date);
array_push($data, $time);
array_push($data, $item_name);
array_push($data, $conclusion);

////////////////////////////////////////////////// 검사이력 테이블
for ($count = 1; $count <= 10; $count++) {

    //이전 행 검사하기 위해 끝에서 두번째부터 10개 추출
    $sql01 = "select * from alldata order by id desc limit " . ($count + 1) . ", 1";
    $res01 = mysqli_query($conn, $sql01);
    $row01 = mysqli_fetch_array($res01);

    //이전 행 검사하기 위해 끝에서 두번째부터 10개 추출
    $sql001 = "select * from result1 order by id desc limit " . ($count + 1) . ", 1";
    $res001 = mysqli_query($conn, $sql001);
    $row001 = mysqli_fetch_array($res001);

    //검사 이력 10개 추출
    $sql02 = "select * from alldata order by id desc limit " . $count . ", 1";
    $res02 = mysqli_query($conn, $sql02);
    $row02 = mysqli_fetch_array($res02);

    //검사 이력 10개 추출
    $sql002 = "select * from result1 order by id desc limit " . $count . ", 1";
    $res002 = mysqli_query($conn, $sql002);
    $row002 = mysqli_fetch_array($res002);

    //시간 차이 구함
    $sql03 = "SELECT TIMESTAMPDIFF(SECOND, '" . $row01['TimeStamp'] . "', '" . $row02['TimeStamp'] . "') as diff";
    $res03 = mysqli_query($conn, $sql03);
    $row03 = mysqli_fetch_array($res03);

    //시간 차이 = CT
    // echo $row03['diff'];

    ${$date . $count} = date('Y-m-d', strtotime($row02['TimeStamp']));
    ${$time . $count} = date('H:i:s', strtotime($row02['TimeStamp']));

    //conclusion은 숫자로 되어있으므로 변환함
    if ($row002['conclusion1'] == 1) {
        $con = "합격";
    } else {
        $con = "불합격";
    }

    ${$conclusion . $count} = $con;
    ${$ct . $count} = $row03['diff'];

    //검사이력 날짜
    //검사이력 시간
    //검사이력 합격여부
    //검사이력 CT
    array_push($data, ${$date . $count});
    array_push($data, ${$time . $count});
    array_push($data, ${$conclusion . $count});
    array_push($data, ${$ct . $count});
}

//////////////////////////////////////////////////검사이력 오늘의 수량
//전체 수량 파악
$sql04 = "select count(*) from alldata where date = '" . date('Y-m-d') . "'";
$res04 = mysqli_query($conn, $sql04);
$row04 = mysqli_fetch_array($res04);

//전체 수량 파악
$sql004 = "select count(*) from result1 where date = '" . date('Y-m-d') . "'";
$res004 = mysqli_query($conn, $sql004);
$row004 = mysqli_fetch_array($res004);

//양품
$sql05 = "select count(*) from alldata where date = '" . date('Y-m-d') . "' and conclusion1 = 1";
$res05 = mysqli_query($conn, $sql05);
$row05 = mysqli_fetch_array($res05);

//양품
$sql005 = "select count(*) from result1 where date = '" . date('Y-m-d') . "' and conclusion1 = 1";
$res005 = mysqli_query($conn, $sql005);
$row005 = mysqli_fetch_array($res005);

//불량
$sql06 = "select count(*) from alldata where date = '" . date('Y-m-d') . "' and conclusion1 = 2";
$res06 = mysqli_query($conn, $sql06);
$row06 = mysqli_fetch_array($res06);

//불량
$sql006 = "select count(*) from result1 where date = '" . date('Y-m-d') . "' and conclusion1 = 2";
$res006 = mysqli_query($conn, $sql006);
$row006 = mysqli_fetch_array($res006);

if ($row004['count(*)'] == null) {
    $sumcount = 0;
} else {
    $sumcount = $row004['count(*)'];
}

if ($row005['count(*)'] == null) {
    $okcount = 0;
} else {
    $okcount = $row005['count(*)'];
}

if ($row006['count(*)'] == null) {
    $ngcount = 0;
} else {
    $ngcount = $row006['count(*)'];
}

//목표수량
//생산수량
//양품
//불량
array_push($data, $sumcount);
array_push($data, $okcount);
array_push($data, $ngcount);

//////////////////////////////////////////////////풀프루프
if ($row00['data1'] == null) {
    $data1 = 0;
} else {
    $data1 = $row00['data1'];
}
if ($row00['data2'] == null) {
    $data2 = 0;
} else {
    $data2 = $row00['data2'];
}
if ($row00['data3'] == null) {
    $data3 = 0;
} else {
    $data3 = $row00['data3'];
}
if ($row00['data4'] == null) {
    $data4 = 0;
} else {
    $data4 = $row00['data4'];
}
if ($row00['data5'] == null) {
    $data5 = 0;
} else {
    $data5 = $row00['data5'];
}
if ($row00['data6'] == null) {
    $data6 = 0;
} else {
    $data6 = $row00['data6'];
}
if ($row00['data7'] == null) {
    $data7 = 0;
} else {
    $data7 = $row00['data7'];
}
if ($row00['data8'] == null) {
    $data8 = 0;
} else {
    $data8 = $row00['data8'];
}

//금형1
//금형2
//냉각IN
//냉각OUT
//온수IN
//온수OUT
//벨트중간
//벨트끝
array_push($data, $data1);
array_push($data, $data2);
array_push($data, $data3);
array_push($data, $data4);
array_push($data, $data5);
array_push($data, $data6);
array_push($data, $data7);
array_push($data, $data8);

//////////////////////////////////////////////////사출기 데이터
//전체 수량
$sql07 = "select count(*) from alldata";
$res07 = mysqli_query($conn, $sql07);
$row07 = mysqli_fetch_array($res07);

if ($row07['count(*)'] == null) {
    $allcount = 0;
} else {
    $allcount = $row07['count(*)'];
}

//사출속도
//사출압력
//사출위치
//배럴온도
//금형온도
//충전위치
//충전속도
//석백위치
//석백속도
//SOV시간
//SOV위치
//유지압력
//유지시간
//유지속도
//백프레셔
//사출시간
//충전시간
//냉각시간
//CT
//클램프닫힘시간
//쿠션위치
//클램프열림위치
//최대사출스피드
//최대스크류RPM
//평균스크류RPM
//최대사출압력
//최대스위치압력
//최대복귀압력
//평균복귀압력
$Inj_Velocity = explode('/', $row00['Inj_Velocity']);
$Inj_Pressure = explode('/', $row00['Inj_Pressure']);
$Inj_Position = explode('/', $row00['Inj_Position']);
$Barrel_Temperature = explode('/', $row00['Barrel_Temperature']);
$Mold_Temperature = explode('/', $row00['Mold_Temperature']);
$Hld_Pressure = explode('/', $row00['Hld_Pressure']);
$Hld_Time = explode('/', $row00['Hld_Time']);
$Hld_Vel = explode('/', $row00['Hld_Vel']);
$Chg_Position = explode('/', $row00['Chg_Position']);
$Chg_Speed = explode('/', $row00['Chg_Speed']);
$BackPressure = explode('/', $row00['BackPressure']);
$Suckback_Position = explode('/', $row00['Suckback_Position']);
$Suckback_Speed = explode('/', $row00['Suckback_Speed']);
$SOV_Time = explode('/', $row00['SOV_Time']);
$SOV_Position = explode('/', $row00['SOV_Position']);
$Injection_Time = explode('/', $row00['Injection_Time']);
$Filling_Time = explode('/', $row00['Filling_Time']);
$Plasticizing_Time = explode('/', $row00['Plasticizing_Time']);
$Cycle_Time = explode('/', $row00['Cycle_Time']);
$Clamp_Close_Time = explode('/', $row00['Clamp_Close_Time']);
$Cushion_Position = explode('/', $row00['Cushion_Position']);
$Clamp_Open_Position = explode('/', $row00['Clamp_Open_Position']);
$Max_Injection_Speed = explode('/', $row00['Max_Injection_Speed']);
$Max_Screw_RPM = explode('/', $row00['Max_Screw_RPM']);
$Average_Screw_RPM = explode('/', $row00['Average_Screw_RPM']);
$Max_Injection_Pressure = explode('/', $row00['Max_Injection_Pressure']);
$Max_Switch_Over_Pressure = explode('/', $row00['Max_Switch_Over_Pressure']);
$Max_Back_Pressure = explode('/', $row00['Max_Back_Pressure']);
$Average_Back_Pressure = explode('/', $row00['Average_Back_Pressure']);

//수량
array_push($data, $allcount);
//사출속도
for ($i = 0; $i < 10; $i++) {
    array_push($data, $Inj_Velocity[$i]);
}
for ($i = 0; $i < 10; $i++) {
    array_push($data, $Inj_Pressure[$i]);
}
for ($i = 0; $i < 10; $i++) {
    array_push($data, $Inj_Position[$i]);
}
for ($i = 0; $i < 7; $i++) {
    array_push($data, $Barrel_Temperature[$i]);
}
for ($i = 0; $i < 12; $i++) {
    array_push($data, $Mold_Temperature[$i]);
}
for ($i = 0; $i < 5; $i++) {
    array_push($data, $Hld_Pressure[$i]);
}
for ($i = 0; $i < 5; $i++) {
    array_push($data, $Hld_Time[$i]);
}
for ($i = 0; $i < 5; $i++) {
    array_push($data, $Hld_Vel[$i]);
}
for ($i = 0; $i < 4; $i++) {
    array_push($data, $Chg_Position[$i]);
}
for ($i = 0; $i < 4; $i++) {
    array_push($data, $Chg_Speed[$i]);
}
for ($i = 0; $i < 4; $i++) {
    array_push($data, $BackPressure[$i]);
}
for ($i = 0; $i < 2; $i++) {
    array_push($data, $Suckback_Position[$i]);
}
for ($i = 0; $i < 2; $i++) {
    array_push($data, $Suckback_Speed[$i]);
}
for ($i = 0; $i < 1; $i++) {
    array_push($data, $SOV_Time[$i]);
}
for ($i = 0; $i < 1; $i++) {
    array_push($data, $SOV_Position[$i]);
}
for ($i = 0; $i < 1; $i++) {
    array_push($data, $Injection_Time[$i]);
}
for ($i = 0; $i < 1; $i++) {
    array_push($data, $Filling_Time[$i]);
}
for ($i = 0; $i < 1; $i++) {
    array_push($data, $Plasticizing_Time[$i]);
}
for ($i = 0; $i < 1; $i++) {
    array_push($data, $Cycle_Time[$i]);
}
for ($i = 0; $i < 1; $i++) {
    array_push($data, $Clamp_Close_Time[$i]);
}
for ($i = 0; $i < 1; $i++) {
    array_push($data, $Cushion_Position[$i]);
}
for ($i = 0; $i < 1; $i++) {
    array_push($data, $Clamp_Open_Position[$i]);
}
for ($i = 0; $i < 1; $i++) {
    array_push($data, $Max_Injection_Speed[$i]);
}
for ($i = 0; $i < 1; $i++) {
    array_push($data, $Max_Screw_RPM[$i]);
}
for ($i = 0; $i < 1; $i++) {
    array_push($data, $Average_Screw_RPM[$i]);
}
for ($i = 0; $i < 1; $i++) {
    array_push($data, $Max_Injection_Pressure[$i]);
}
for ($i = 0; $i < 1; $i++) {
    array_push($data, $Max_Switch_Over_Pressure[$i]);
}
for ($i = 0; $i < 1; $i++) {
    array_push($data, $Max_Back_Pressure[$i]);
}
for ($i = 0; $i < 1; $i++) {
    array_push($data, $Average_Back_Pressure[$i]);
}

array_push($data, $row000['img_name']);


echo json_encode($data);
