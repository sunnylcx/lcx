<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<style type="text/css">
		body, html {margin:0;font-family:"微软雅黑";font-family:"微软雅黑";}
		#allmap{width:100%;height:500px;}
		.store{width:300px;height:134px;border:1px solid #fd6614;margin-top:100px;padding-top:20px;}
		.store .store_left{float:left;height:60px;}
		.store .store_right{float:left;height:60px;margin-left:10px;}
		.store .address{clear:both;height:40px;line-height:40px;border-top:1px solid #eeedec;margin-top:20px;}
	</style>
	<script type="text/javascript" src="./jquery.js"></script>
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=aGcyMBvIrfa4EsqhFAwD7HUM"></script>
	<title>地图单击事件</title>
</head>
<body>
    <div class="store">
		<div class="store_left"><img src="1.jpg"/></div>
		<div class="store_right">
			<p>爱是慢不宜窗帘</p>
			<p>*******</p>
		</div>
		<div class="address">北京市海淀区上地7街</div>
	</div>
	<div id="allmap"></div>
</body>
</html>

<script type="text/javascript">
  var cityName='';    //当前城市
  //获取店铺地址获

    var map = new BMap.Map("allmap");
    map.centerAndZoom(new BMap.Point(116.404, 39.915), 12); // 初始化地图,设置城市和地图级别。

// 百度地图API功能
	var sContent =
	' <div class="store"><div class="store_left"><img src="1.jpg"/></div><div class="store_right"><p>爱是慢不宜窗帘</p>' + 
	'<p>*******</p></div><div class="address">北京市海淀区上地7街</div></div>';
	var sContent2 =
	"<h4 style='margin:0 0 5px 0;padding:0.2em 0'>天安门</h4>" + 
	"<img style='float:right;margin:4px' id='imgDemo' src='http://app.baidu.com/map/images/tiananmen.jpg' width='139' height='104' title='天安门'/>" + 
	"<p style='margin:0;line-height:1.5;font-size:13px;text-indent:2em'>天安门坐落在中国北京市中心,故宫的南侧,与天安门广场隔长安街相望,是清朝皇城的大门...</p>" + 
	"</div>";

	// 百度地图API功能
	var map = new BMap.Map("allmap");
	var point = new BMap.Point(116.331398,39.897445);
	map.centerAndZoom(point,12);

	//var message;
	var storeArr = new Array();

	var storeArr = [["北京市海淀区上地十街",sContent],["北京市海淀区上地七街",sContent2]];
	for (x in storeArr)
	{
		getPoint(storeArr[x][0],storeArr[x][1]);
	}
	
	function getPoint(addr,info){
		// 创建地址解析器实例
		var myGeo = new BMap.Geocoder();
		// 将地址解析结果显示在地图上,并调整地图视野
		myGeo.getPoint(addr,function(pp){
			if (pp) {
				addInfo(pp.lng,pp.lat,info)
			}else{
				alert("您选择地址没有解析到结果!");
			}
		}, "北京市");
	}

function addInfo(x,y,info){
	var cpoint = new BMap.Point(x, y);
	var marker = new BMap.Marker(cpoint);
	var infoWindow = new BMap.InfoWindow(info);  // 创建信息窗口对象
	map.centerAndZoom(cpoint, 15);
	map.addOverlay(marker);
	marker.addEventListener("click", function(){          
	   this.openInfoWindow(infoWindow);
	   infoWindow.redraw();
	   //图片加载完毕重绘infowindow
	   document.getElementById('imgDemo').onload = function (){
		   infoWindow.redraw();   //防止在网速较慢，图片未加载时，生成的信息框高度比图片的总高度小，导致图片部分被隐藏
	   }
	});
}




    
</script>
