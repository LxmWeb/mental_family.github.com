$(listD);
function listD(){
	$.post('php\\doctorList.php', 
		     {}, 
		     function(data) {
		     	$('.list').html(data)
	});
}
$(more);
function more(){
	//对某元素下动态生成的子元素进行事件绑定
	$('.list').on("click","li",function() {
		var id = $(this).attr("id");
		var l = id.length;
		id = id.substr(6, l-6);
		window.location.href = "doctorDetails.html?id=" + id;
	});
}

// ------------------doctorDetails----------
$(details);
function details(){
	//获得url里?后面的东西
	// console.log(window.location.search);
	//获得=后面的参数
	var get = window.location.search.split('=');
	var i = get[1];
	$.post('php\\doctorDetail.php',
	         {index: i}, 
	         function(data) {
	         	$('.detail').html(data);
	});

}