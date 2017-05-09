$(document).ready(function() {
	$('.btn-toggle').click(function() {
		$(this).find('.btn').toggleClass('active btn-success');  
		
		if ($(this).find('.btn-primary').size()>0) {
			$(this).find('.btn').toggleClass('btn-primary');
		}
		if ($(this).find('.btn-danger').size()>0) {
			$(this).find('.btn').toggleClass('btn-danger');
		}
		if ($(this).find('.btn-success').size()>0) {
			//$(this).find('.btn').toggleClass('btn-success');
		}
		if ($(this).find('.btn-info').size()>0) {
			$(this).find('.btn').toggleClass('btn-info');
		}
	});
	
	//Create Cookies 
	var store_id ='';
	$('.main_tabs li a').bind('click', function(){
		menuTabs = $(this).attr('href').replace('#', '').replace ('tab-', '');
		storeId = menuTabs.substr(menuTabs.length - 1);
		$.cookie('main_tabs',menuTabs);
		$.cookie('store_id',storeId);
		
	});
	main_tabs = $.cookie('main_tabs');
	store_id = $.cookie('store_id');
	if (main_tabs) changeMainTabs(main_tabs,store_id);
	
	$('.store_tabs li a').bind('click', function(){
		$.cookie('stores',$(this).attr('href').replace('#', '').replace ('tab-', ''));
	});
	store_tabs = $.cookie('stores');
	if (store_tabs) changeStoreTabs(store_tabs);
	
	//Font Setting
	$(".fonts-change").each( function(){
		var $this = this;
		$(".items-font",$this).hide();  
		$(".font-"+$(".type-fonts:checked",$this).val(), this).show();
	 
		$(".type-fonts", this).change( function(){
			$(".items-font",$this).hide();
			$(".font-"+$(this).val(), $this).show();
		} );
	});
	
	//Custom Code
	custom_code('soconfig_cssfile');
	custom_code('soconfig_cssfile_store');
	custom_code('soconfig_jsfile');
	custom_code('soconfig_jsfile_store');
	
})

function changeStoreTabs($menuItem){
	$(".store_tabs").find('> li').removeClass('active');
	$(".store_tabs > li").each(function() {
		if($(this).find('a').attr('href').indexOf($menuItem)!= -1) $(this).addClass('active');
	});
	$(".store_tabs +.tab-content").find('> .tab-pane').removeClass('active');
	$(".store_tabs +.tab-content > .tab-pane").each(function() {
		$("#tab-" + $menuItem).addClass('active');
		
	});
}

function changeMainTabs($menuItem,$store_id){
	$store_tab = 'tab-store'+$store_id;
	$('#'+$store_tab+' .main_tabs').find('> li').removeClass('active');
	$('#'+$store_tab+' .main_tabs > li').each(function() {
		if($(this).find('a').attr('href').indexOf($menuItem)!= -1) $(this).addClass('active');
	});
	$('#'+$store_tab+' .main_tabs+.tab-content').find('> .tab-pane').removeClass('active');
	$('#'+$store_tab+' .main_tabs+.tab-content > .tab-pane').each(function() {
		$("#tab-" + $menuItem).addClass('active');
		
	});
}

function custom_code($input_file){
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".customcode_wrap"); //Fields wrapper
    var add_button      = $(".add-"+$input_file); //Add button ID
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
			var $box_html = $('<div class="form-group"><label class="col-sm-2 control-label" >Enter file path</label><div class="col-sm-9"><input class="form-control" type="text" name="'+$input_file+'[]"/></div><div class="col-sm-1"><a href="#" class="btn btn-success remove_field"><i class="fa fa-times"></i></a></div></div>');
            $(this).closest(".so-panel").find('.panel-container').append($box_html); //add input box
        }
    });
	
	$(window).load(function () {
		
		var $input_values = $('input[name^="'+$input_file+'"]');
		$input_values.each(function() {
			var url_file = $(this).val();
			if( url_file ){
				var ext = url_file.split(".").pop().toLowerCase();
			}
			if($input_file =='soconfig_cssfile' && $.inArray(ext, ['css']) == -1){
				$(this).after('<p class="pic_error" >Add file formats should be .css</p>');
			}else if($input_file =='soconfig_jsfile' && $.inArray(ext, ['js']) == -1){
				$(this).after('<p class="pic_error" >Add file formats should be .js</p>');
			}
		});
	});
	
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parents('.form-group').remove(); x--;
    })

}
