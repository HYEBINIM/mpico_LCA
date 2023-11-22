var timerID;

$(document).ready(function () {
    updateData();
});


function updateData() {
    $.ajax({
        url: "/php/dashboard.php",
        type: "post",
        cache: false,
        success: function (data) { // getvalue.php 파일에서 echo 결과값이 data 임

            var array = JSON.parse(data);
            //데이터 확인
            // console.log(array);

            let count = 1;
            let index = 0;
            for (; index < 153; index++) {
                $('#data' + count + '').html(array['' + index + '']);
                count++;
            }
            $('#data153').attr("src", '' + array[152] + '');
        }

    });
    timerID = setTimeout("updateData()", 1000); // 1초 단위로 갱신 처리

}
