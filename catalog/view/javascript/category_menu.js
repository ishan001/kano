$(document).ready(function() {
	$('#category_menu > ul > li > a + div').each(function(index, element) {		var menu = $('#category_menu').offset();
		var dropdown = $(this).parent().offset();

		i = (dropdown.left + $(this).outerWidth()) - (menu.left + $('#category_menu').outerWidth());

		if (i > 0) {
			$(this).css('margin-left', '-' + ($(this).outerWidth() - $(this).parent().outerWidth()) + 'px');
		}
	});

	$('#category_menu > ul > li > div > ul > li > a + div').each(function(index, element) {		var menu = $('#category_menu').offset();
		var dropdown = $(this).parent().offset();

		i = (dropdown.left + $(this).parent().outerWidth() + $(this).outerWidth()) - (menu.left + $('#category_menu').outerWidth());

		if (i > 0) {
			$(this).css('margin-left', '-' + ($(this).outerWidth() + $(this).parent().outerWidth()) + 'px').addClass("leftDropDown");
		}
	});
});