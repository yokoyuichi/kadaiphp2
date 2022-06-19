<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>わなまっぷ</title>
</head>
<body>
    
    <!-- MAP[START] -->
    
    <h1>Pushpin-Text</h1>
    <div id="myMap" style='width:100%;height:97%;'></div>
    <button id="button">記録</button>
    <!-- MAP[END] -->

    
</body>

<!-- jQuery&GoogleMapsAPI -->
<script src='https://code.jquery.com/jquery-2.1.4.min.js' type='text/javascript'></script>
<!-- /jQuery&GoogleMapsAPI -->
<script src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=ApXo3--EVXEFu9rGcEVMM4EUg-v5AMG6vSaMpEq4Olb7pEKJuBdbjyemGeq3AFVd' async defer type='text/javascript'></script>
<script src="BmapQuery.js" type="text/javascript"></script>
<!-- javascript -->

<script type="text/javascript">
 
  function mapsInit(position) {
    //lat=緯度、lon=経度 を取得
    let lat = position.coords.latitude;
    let lon = position.coords.longitude;
     <?php
     $lat = lat;
     $lon = lon;
     echo $lat;
     echo $lon;
     ?>
        map.startMap(lat, lon, "load", 15); 
        let pin = map.pinText(lat, lon, "現在地","ここ","You");
    }

  function mapsError(error){
    if(error.code==1){
      alert("位置情報の取得が許可されていない")
    }
    else if(error.code==2){
      alert("位置情報の取得が利用できない")
    }
    if(error.code==3){
      alert("タイムアウト")
    }
  }

  //3.位置情報取得オプション
  var set ={
    enableHighAccuracy: true, //より高精度な位置を求める
    maximumAge: 20000,        //最後の現在地情報取得が20秒以内であればその情報を再利用する設定
    timeout: 10000            //10秒以内に現在地情報を取得できなければ、処理を終了
  };
  function GetMap(){
    //------------------------------------------------------------------------
    //1. Instance
    //------------------------------------------------------------------------
    map = new Bmap("#myMap");
    //Main:位置情報を取得する処理 //getCurrentPosition :or: watchPosition
    navigator.geolocation.getCurrentPosition(mapsInit, mapsError, set);
}

// $("#button").on("click", function(){
//     navigator.geolocation.getCurrentPosition(mapsInit, mapsError, set);

//     function mapsInit(position) {
//     //lat=緯度、lon=経度 を取得
//     lat = position.coords.latitude;
//     lon = position.coords.longitude;
//     console.log(lat)
//     console.log(lon)
//         map.startMap(lat, lon, "load", 15); 
//         let pin = map.pinText(lat, lon, "現在地","ここ","You");
//     }
  
//   function mapsError(error){
//     if(error.code==1){
//       alert("位置情報の取得が許可されていない")
//     }
//     else if(error.code==2){
//       alert("位置情報の取得が利用できない")
//     }
//     if(error.code==3){
//       alert("タイムアウト")
//     }
//   }

//   //3.位置情報取得オプション
//   var set ={
//     enableHighAccuracy: true, //より高精度な位置を求める
//     maximumAge: 20000,        //最後の現在地情報取得が20秒以内であればその情報を再利用する設定
//     timeout: 10000            //10秒以内に現在地情報を取得できなければ、処理を終了
//   };
  
// })

//ここまでMap
</script>
</html>