//-- show/hide drop down
$(document).ready(function() {
	$("ul#nav li.parent").hover(
	  function () {
		$(this).addClass("over");
	  },
	  function () {
		$(this).removeClass("over");
	  }
	);
});