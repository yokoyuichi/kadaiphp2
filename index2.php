<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>わなまっぷ</title>
</head>
<body>
    
    <!-- Main[Start] -->
    <form>
    <div class="jumbotron">
    <fieldset>
        <legend>狩猟フォーム</legend>
        <label>名前：（任意）<input type="text" name="name" id="name"></label><br>
        <label>猟の種類：<select name="trap" id="trap">
            <option hidden selected>何を用いて捕まえたか、選択してください</option>
            <option value = "銃猟">銃猟</option>
            <option value = "箱罠">箱罠</option>
            <option value = "くくり罠">くくり罠</option>
            <option value = "囲い罠">囲い罠</option>
            <option value = "その他">その他</option>
        </select>  
        </label><br>
        <label>捕獲数：<select name="number" id="number">
            <option hidden selected>捕獲数を選択してください</option>
            <option value = "1">1</option>
            <option value = "2">2</option>
            <option value = "3">3</option>
            <option value = "4">4</option>
            <option value = "5">5</option>
            <option value = "6">6</option>
            <option value = "7">7</option>
            <option value = "8">8</option>
            <option value = "9">9</option>
        </select>  
        </label><br>
        <label>メモ：<textArea name="memo" id="memo"></textArea></label><br>
        <button type="submit" id="button">記録</button>
        </fieldset>
    </div>
    </form>

    <!-- Main[End] -->
    <!-- <div id="myMap" style='width:100%;height:97%;'></div> -->
    
</body>

<!-- jQuery&GoogleMapsAPI -->
<script src='https://code.jquery.com/jquery-2.1.4.min.js' type='text/javascript'></script>
<!-- /jQuery&GoogleMapsAPI -->
<script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=ApXo3--EVXEFu9rGcEVMM4EUg-v5AMG6vSaMpEq4Olb7pEKJuBdbjyemGeq3AFVd' async defer></script>
<script type='text/javascript' src="BmapQuery.js"></script>
<!-- javascript -->

<script type="text/javascript" defer>

//map表示
let map
let lat
let lon

// function GetMap(){
//     //------------------------------------------------------------------------
//     //1. Instance
//     //------------------------------------------------------------------------
//     map = new Bmap("#myMap");
//     //Main:位置情報を取得する処理 //getCurrentPosition :or: watchPosition
//     navigator.geolocation.getCurrentPosition(mapsInit, mapsError, set);
// }

//ここまでMap

//ボタンを押したら…、
$(document).ready(function() {
$("#button").on("click", function(){
    // 位置情報の取得可否により分岐
    navigator.geolocation.getCurrentPosition(success, fail, set);

// 位置情報が取得できた場合
function success(position) {
            var dateoriginal = new Date(position.timestamp);
            let date = dateoriginal.toLocaleString()        // 日時
            let lat = position.coords.latitude              // 緯度
            let lon = position.coords.longitude             // 経度
            let name = $("#name").val()
            let trap = $("#trap").val()
            let number = $("#number").val()
            let memo = $("#memo").val()
            // const pos = {
            //     date: date.toLocaleString(),                // 日時
            //     lat: position.coords.latitude,              // 緯度
            //     lon: position.coords.longitude,             // 経度
            //     alt: position.coords.altitude,              // 高度
            //     posacc: position.coords.accuracy,           // 位置精度
            //     altacc: position.coords.altitudeAccuracy,   // 高度精度
            //     head: position.coords.heading,              // 移動方向
            //     speed: position.coords.speed                // 速度
            // };

            // サーバーサイドへPOSTする
            $.ajax({
                type: "post",
                url: "submit.php",
                data: {
                    "name": name,
                    "trap": trap,
                    "number": number,
                    "memo": memo,
                    "date": date,
                    "lat": lat,
                    "lon": lon,
                    // "alt": pos.alt,
                    // "posacc": pos.posacc,
                    // "altacc": pos.altacc,
                    // "head": pos.head,
                    // "speed": pos.speed
                },
                // 通信が成功した場合　
                 success: function(data, dataType) {
                     alert(data); // サーバーサイドからの返答を表示させてみる
                 },
                // 通信が失敗した場合
                 error: function() {
                     alert('失敗らしい');
                 }
            });
        }

        // 位置情報が取得できなかった場合
        function fail(error) {
            if (error.code == 1) alert('位置情報を取得する時に許可がない')
            if (error.code == 2) alert('何らかのエラーが発生し位置情報が取得できなかった。')
            if (error.code == 3) alert('タイムアウト　制限時間内に位置情報が取得できなかった。')
        }
        var set ={
            enableHighAccuracy: true, //より高精度な位置を求める
            maximumAge: 20000,        //最後の現在地情報取得が20秒以内であればその情報を再利用する設定
            timeout: 10000            //10秒以内に現在地情報を取得できなければ、処理を終了
        };

    });
});

</script>
</html>