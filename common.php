<?php

sleep(rand(100,500)/100.);

header("Content-type: application/javascript; charset=UTF-8");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

?>

function transform<?= $number ?>() {
	$.each($("#container<?= $number ?>").children(), function() {
		var element = $(this);
		element.html("<b>"+element.html()+"</b>").css("cursor","pointer").click(function() {
			element.toggleClass("selected");
		});
	});
}