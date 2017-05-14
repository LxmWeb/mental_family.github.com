$(postText);
function postText(){
$("#searchB").click(function() {
var name = $("#searchInput").val();
$.post('php\\firstSearch.php', {dis:name},function(data){
	$(".diseaseName").text(name);
	$('.intro-box').text(data);
})
});
}

$(returnPage);
function returnPage(){
	$(".return").click(function() {
		window.history.back();
	});
}