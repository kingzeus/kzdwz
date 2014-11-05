//把a的target传给服务器用
$("a[target]").live("mousedown",function(){
	var target="target="+$(this).attr("target")
	var href=$(this).attr("href")
	
	if (href.indexOf("target=")<0){
		var isOne=href.indexOf("?");
		if (isOne<0)
			$(this).attr("href",href+"?"+target)
		else
			$(this).attr("href",href+"&"+target)
	}
	href=$(this).attr("href")
	if (href.indexOf("at=")<0){
		$(this).attr("href",href+"&at=dwz")
	}
})