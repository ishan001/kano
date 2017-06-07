<?php echo $html;?>

<script type="text/javascript">
//<![CDATA[
jQuery(window).load(function($){
	$ = typeof($ !== 'funtion') ? jQuery : $;
		function remove_full(){
			
			
			
		}
		$('body').on('click','.sj_filter_color_delete',function(){
			var array_data = $(this).parent().attr('data-product').split('-'); 
			var tg = product_color;
			for(var i = 0; i < array_data.length; i++){
				if(tg.indexOf('-'+array_data[i]) != -1){
					tg = tg.replace('-'+array_data[i],'');
				}else if(tg.indexOf(array_data[i]) != -1){
					tg = tg.replace(array_data[i],'');
				}
			}
			product_color = tg;
			$(this).parent().find('.sj_count_item').css('display','block');
			$(this).parent().find('.sj_filter_color_delete').remove();
			getIdProduct();
			getCountProduct();
			setTimeout(function(){
					getCountField();
				},1000)
			getAjaxProduct();
			remove_full();
		})
		$('.so_filter_shop_by_item_category').append('<div class="sj_filter_loading"><i class="fa fa-cog fa-spin"></i></div>');
		$('.so_filter_shop_by_item_category').append('<div class="sj_filter_full"></div>');
		$('.so_filter_shop_by_item_category').each(function(){
				var item = $(this);
				var product = item.attr('data-product');
				if(typeof product == 'undefined'){
					item.find('.sj_filter_loading').css('display','none');
				}
				if(typeof product != 'undefined'){
					var length = product.split('-').length;
					setTimeout(function(){
							item.find('.sj_filter_loading').animate({opacity: "0"},200);
							setTimeout(function(){
								item.find('.sj_filter_loading').css('display','none');
								if(parseInt(product) != -1){
									item.append('<div class="sj_count_item">'+length+'</div>');
									item.find('.sj_filter_full').css('height','0');
									item.find('.sj_filter_full').css('width','0');
								}else{
									item.append('<div class="sj_count_item">0</div>');
									item.find('.sj_filter_full').css('height','100%');
									item.find('.sj_filter_full').css('width','100%');
								}
								
							},200)
					},500);
				}
		});
		
		$('.so_filter_shop_by_item_title').click(function(){
			if($(this).hasClass('sj_filter_title_click')){
				$(this).removeClass('sj_filter_title_click');
				$(this).parent().find('.so_filter_shop_by_item_content').slideUp();
				$(this).find('i').remove();
				$(this).append('<i class="fa fa-plus-circle"></i>');
			}else{
				$(this).addClass('sj_filter_title_click');
				$(this).parent().find('.so_filter_shop_by_item_content').slideDown();
				$(this).find('i').remove();
				$(this).append('<i class="fa fa-minus-circle"></i>');
			}
		});	
		var field_val = new Array();
		var field_category = '';
		$('.so_filter_shop_by_item_category input').click(function(){				
				var parent = $(this).parent().parent();
				var type = parent.attr('data-type');
				var val = $(this).parent().attr('data-value');
				if(typeof parent.attr('data-field') != "undefined"){
						var field = parent.attr('data-field');
						field = field.replace(/ /g,'_');
						if($(this).is(":checked")){
							
							if(typeof field_val[field] == 'undefined' || field_val[field]==''){
									field_val[field] = val;
							}else{
									field_val[field] = field_val[field]  + '--' + '--' + val;
							}
						}else{
							if(field_val[field].indexOf('----'+val) != -1){
									field_val[field] = field_val[field].replace('----'+val,'');
							}else if(field_val[field].indexOf(val) != -1){
									if(field_val[field].indexOf('----') != -1){
										field_val[field] = field_val[field].replace(val+'----','');
									}else{
										field_val[field] = field_val[field].replace(val,'');
									}	
							}	
						}
				}else if(type == "categories"){
						if($(this).is(":checked")){
							if(field_category == ''){
									field_category = val;
							}else{
									field_category = field_category + '----' + val;
							}
						}else{
							if(field_category.indexOf('----'+val) != -1){
									field_category = field_category.replace('----'+val,'');
							}else if(field_category.indexOf(val) != -1){
									if(field_category.indexOf('----') != -1){
										field_category = field_category.replace(val+'----','');
									}else{
										field_category = field_category.replace(val,'');
									}
							}
						}
				}
				
		});
		$('body').on('click','.sj_filter_shop_by_chose p',function(){				
				if($(this).parent().find('.sj_filter_action_item').length > 0){
					
				}else{
					$(this).parent().find('.sj_count_item').css('display','none');
					$(this).parent().append('<div class="sj_filter_action_item"><div class="sj_checked"><i class="fa fa-check-square"></i></div><div class="sj_delete_checked"><i class="fa fa-times"></i></div></div>');
					$(this).parent().find('.sj_checked').animate({width: "50%"},300);
					var parent = $(this).parent().parent();
					var type = parent.attr('data-type');
					var val = $(this).parent().attr('data-value');
					if(typeof parent.attr('data-field') != "undefined"){
						var field = parent.attr('data-field');
						field = field.replace(/ /g,'_');
						if(typeof field_val[field] == 'undefined' || field_val[field]==''){
							field_val[field] = val;
						}else{
							field_val[field] = field_val[field]  + '--' + '--' + val;
						}

					}else if(type == "categories"){
							if(field_category == ''){
									field_category = val;
							}else{
									field_category = field_category + '----' + val;
							}

					}
					
				}			
		});
		
		$('body').on('click','.sj_filter_action_item .sj_delete_checked',function(){
				var parent = $(this).parent().parent().parent();
				var type = parent.attr('data-type');
				var val = $(this).parent().parent().attr('data-value');
				$(this).parent().parent().find('.sj_count_item').css('display','block');
				$(this).parent().parent().removeClass('sj_filter_chose');
				if(typeof parent.attr('data-field') != "undefined" || type == "rating"){
					var field = parent.attr('data-field');
					field = field.replace(/ /g,'_');
					if(field_val[field].indexOf('----'+val) != -1){
						field_val[field] = field_val[field].replace('----'+val,'');
					}else if(field_val[field].indexOf(val) != -1){
						if(field_val[field].indexOf('----') != -1){
							field_val[field] = field_val[field].replace(val+'----','');
						}else{
							field_val[field] = field_val[field].replace(val,'');
							}	
					}
				}else if(type == "categories"){
					if(field_category.indexOf('----'+val) != -1){
						field_category = field_category.replace('----'+val,'');
					}else if(field_category.indexOf(val) != -1){
						if(field_category.indexOf('----') != -1){
							field_category = field_category.replace(val+'----','');
						}else{
							field_category = field_category.replace(val,'');
						}
					}

				}
				 if(type == "manufacturer"){
					var array_data = $(this).parent().parent().attr('data-product').split('-');
					var tg = product_manufacturer;
					for(var i = 0; i < array_data.length; i++){
						if(tg.indexOf('-'+array_data[i]) != -1){
							tg = tg.replace('-'+array_data[i],'');
						}else if(tg.indexOf(array_data[i]) != -1){
							tg = tg.replace(array_data[i],'');
						}
					}
					product_manufacturer = tg;
				}
				if($(this).parent().parent().parent().parent().attr('data-type') == 'rating'){
					$(this).parent().parent().parent().find('.so_filter_shop_by_item_category .sj_filter_full').css('height','0');
					$(this).parent().parent().parent().find('.so_filter_shop_by_item_category .sj_filter_full').css('width','0');
					id_rating = '';
				}
				getIdProduct();
				getCountProduct();
				setTimeout(function(){
					getCountField();
				},1000)
				
				getAjaxProduct();
				remove_full();
				$(this).parent().remove();
		});
		
		var scrollLeft = 0;
		var scrollLeft_x;
		var scrollLeft_left;
		var scrollLeft_right;
		var scrollLeft_obj;
		$('body').on('mousedown','.so_filter_shop_by_item_content_scroll_left',function(event){
			scrollLeft = 1;
			scrollLeft_left = parseInt($(this).css('left'));
			scrollLeft_x = event.pageX;
			scrollLeft_right = parseInt($(this).parent().css('width')) - parseInt($(this).parent().find('.so_filter_shop_by_item_content_scroll_right').css('right')) - 40;
			scrollLeft_obj = $(this);
			obj = $(this).parent().parent().parent();
			
		})
		var id_min_max = '';
		function getIdMinMax(obj){
			
			id_min_max = '';
			$('.so_filter_shop_by_item_content_min_max').each(function(){
				obj = $(this).parent();
				var min = obj.find('.so_filter_shop_by_item_content_input_min').html();
				var max = obj.find('.so_filter_shop_by_item_content_input_max').html();
				if(min != obj.find('.so_filter_shop_by_item_content_input_min').attr('data-min') || max != obj.find('.so_filter_shop_by_item_content_input_max').attr('data-max')){

					var data = obj.attr('data-product');	
					var array_data = data.split('-');
					if(id_min_max == ''){
						for(var i = 0; i < array_data.length; i++){
							var item = array_data[i];
							var array_item = item.split('**');
							if(parseInt(array_item[1]) >= parseInt(min) && parseInt(array_item[1]) <= parseInt(max)){
								if(id_min_max == ''){
									id_min_max = array_item[0];
								}else{
									id_min_max = id_min_max + '-' + array_item[0];
								}
							}
						}
					}else{
						var string = '';
						for(var i = 0; i < array_data.length; i++){
							var item = array_data[i];
							var array_item = item.split('**');
							if(parseInt(array_item[1]) >= parseInt(min) && parseInt(array_item[1]) <= parseInt(max)){
								if(id_min_max.indexOf(array_item[0]) != -1){
									if(string == ''){
										string = array_item[0];
									}else{
										string = string + '-' + array_item[0];
									}
								}
							}
						}
						id_min_max = string;
					}
					
				}
				
			});

			if(id_min_max == ''){
				obj_class.html(html);
				getIdProduct();
				getCountProduct();
				setTimeout(function(){
						getCountField();
				},1000)
				return;
			}else{
				getIdProduct();
				getCountProduct();
				setTimeout(function(){
						getCountField();
				},1000)
			}
			
			
		}
		var obj;
		$('body').mouseup(function(){
			if(scrollLeft == 1){
					scrollLeft = 0;
					getIdMinMax(obj);
					getAjaxProduct();
					remove_full();
			}
		})
		
		$('body').mousemove(function(event){
			if(scrollLeft == 1){
				var x = event.pageX;
				var left = scrollLeft_left + x - scrollLeft_x;
				if(left < 0){
					left = 0;
				}
				if(left > (parseInt(scrollLeft_obj.parent().css('width')) - 20))
				{
					left = parseInt(scrollLeft_obj.parent().css('width')) - 20;
				}
				scrollLeft_obj.css('left',left+'px');
					left = left;
					var ts = left / (parseInt(scrollLeft_obj.parent().css('width')) -20);
					var min_max = parseInt(scrollLeft_obj.parent().parent().parent().find('.so_filter_shop_by_item_content_min_max .so_filter_shop_by_item_content_input_max').attr('data-max'));
					var val_left = parseInt(min_max * ts) + parseInt(scrollLeft_obj.parent().parent().parent().find('.so_filter_shop_by_item_content_min_max .so_filter_shop_by_item_content_input_min').attr('data-min'));
					if(val_left <= 0){
						scrollLeft_obj.parent().parent().parent().find('.so_filter_shop_by_item_content_min_max .so_filter_shop_by_item_content_input_min').html(parseInt(scrollLeft_obj.parent().parent().parent().find('.so_filter_shop_by_item_content_min_max .so_filter_shop_by_item_content_input_min').attr('data-min')));
					}else{
						scrollLeft_obj.parent().parent().parent().find('.so_filter_shop_by_item_content_min_max .so_filter_shop_by_item_content_input_min').html(val_left);
					}
					
			}
			
		})
		
		var scrollRight = 0;
		var scrollRitgh_x;
		var scrollRitgh_left;
		var scrollRitgh_right;
		var scrollRitgh_obj;
		$('.so_filter_shop_by_item_content_scroll_right').css('left',(parseInt($('.so_filter_shop_by_item_scroll_content').css('width')) -20) +'px');
		$('body').on('mousedown','.so_filter_shop_by_item_content_scroll_right',function(event){
			scrollRight = 1;
			scrollRitgh_left = parseInt($(this).css('left'));
			scrollRitgh_x = event.pageX;
			scrollRitgh_right = parseInt($(this).parent().css('width')) - parseInt($(this).parent().find('.so_filter_shop_by_item_content_scroll_left').css('left')) - 40;
			scrollRitgh_obj = $(this);
			obj = $(this).parent().parent().parent();
		})
		
		$('body').mouseup(function(){
			if(scrollRight == 1){
					scrollRight = 0;
					getIdMinMax(obj);
					getAjaxProduct();
					remove_full();
			}
		})
		
		$('body').mousemove(function(event){
			if(scrollRight == 1){
				var x = event.pageX;
				var left = scrollRitgh_left + x - scrollRitgh_x;
				if(left < 0){
					left = 0;
				}
				if(left > (parseInt(scrollRitgh_obj.parent().css('width')) - 20))
				{
					left = parseInt(scrollRitgh_obj.parent().css('width')) - 20;
				}
				scrollRitgh_obj.css('left',left+'px');
				left = left;
				var ts = left / (parseInt(scrollRitgh_obj.parent().css('width')) -20);
				var min_max = parseInt(scrollRitgh_obj.parent().parent().parent().find('.so_filter_shop_by_item_content_min_max .so_filter_shop_by_item_content_input_max').attr('data-max'));
				var val_left = parseInt(min_max * ts);
				if(val_left == 0){
					scrollRitgh_obj.parent().parent().parent().find('.so_filter_shop_by_item_content_min_max .so_filter_shop_by_item_content_input_max').html(parseInt(scrollRitgh_obj.parent().parent().parent().find('.so_filter_shop_by_item_content_min_max .so_filter_shop_by_item_content_input_min').attr('data-min')));
				}else{
					scrollRitgh_obj.parent().parent().parent().find('.so_filter_shop_by_item_content_min_max .so_filter_shop_by_item_content_input_max').html(val_left);
				}	
			}
			
		});
		
		
		var id_product_field = new Array();
		var id_product_category = '';
		var key_field = new Array();
		var ajax_id_product;
		function getIdProduct(){
			id_product_category = '';
			if(id_min_max == ''){
				ajax_id_product = '';
			}else{
				ajax_id_product = id_min_max;
			}
			
			id_product_field = new Array();
			key_field = new Array();
			$('.sj_filter_chose').each(function(){
			
				if($(this).parent().attr('data-type') == 'categories'){
					if(id_product_category == ''){
						id_product_category = $(this).attr('data-product');
					}else{
						var array_product = $(this).attr('data-product').split('-');
						var id_string = '';
						for(var i = 0; i < array_product.length; i++){
							if(id_product_category.indexOf(array_product[i]) != -1){
								if(id_string == ''){
									id_string = array_product[i];
								}else{
									id_string = id_string + '-' + array_product[i];
								}	
							}	
						}
						id_product_category = id_string;
					}
				}
				
				if($(this).parent().attr('data-type') == 'filed_radio' || $(this).parent().attr('data-type') == 'field_chose'){
					var name_filed = $(this).parent().attr('data-field');
					var index_field = name_filed.replace(/ /g,'_');
					
					if(typeof id_product_field[index_field] == 'undefined' ||  id_product_field[index_field] ==''){
						key_field[key_field.length] = index_field;
						id_product_field[index_field] = $(this).attr('data-product');					
					}else{
						var array_product = $(this).attr('data-product').split('-');
						key_field[key_field.length] = index_field;
						var id_string = '';
						for(var i = 0; i < array_product.length; i++){
							if(id_product_field[index_field].indexOf(array_product[i]) == -1){
								id_product_field[index_field] = id_product_field[index_field] + '-' + array_product[i];
							}
						
						}
	
					}
				}
				
				if(id_product_category != ''){
					ajax_id_product = id_product_category;
				}
				if(ajax_id_product != ''){
					for(var i = 0; i < key_field.length; i++){
						var index = key_field[i];
						if(i == 0){
							ajax_id_product = id_product_field[index];
							continue;
						}
						
						var product_id = id_product_field[index].split('-');
						var string = '';
						for(var a = 0; a < product_id.length; a++){
							if(ajax_id_product.indexOf(product_id[a]) != -1){
								if(string == ''){
									string = product_id[a];
								}else{
									string = string + '-' + product_id[a];
								}
							}	
						}
						ajax_id_product = string;
					}
				}else{
					for(var i = 0; i < key_field.length; i++){
						var index = key_field[i];
						if(i == 0){
							ajax_id_product = id_product_field[index];
							continue;
						}						
					}
				}
				
				
			})
			if(product_manufacturer != ''){
					if(ajax_id_product == ''){
						ajax_id_product = product_manufacturer;
					}else{
						var array_manufacturer = product_manufacturer.split('-');
						var tg = '';
						for(var i = 0; i < array_manufacturer.length; i++){
							if(ajax_id_product.indexOf(array_manufacturer[i]) != -1){
								if(tg == ''){
									tg = array_manufacturer[i];
								}else{
									tg = tg + '-' + array_manufacturer[i];
								}
							}
						}
						ajax_id_product = tg;
					}
				}
				
				if(product_color != ''){
					
					if(ajax_id_product == ''){
						ajax_id_product = product_color;
					}else{
						var array_color = product_color.split('-');
						var tg = '';
						for(var i = 0; i < array_color.length; i++){
							if(ajax_id_product.indexOf(array_color[i]) != -1){
								if(tg == ''){
									tg = array_color[i];
								}else{
									tg = tg + '-' + array_color[i];
								}
							}
						}
						ajax_id_product = tg;
					}
					
				}
				
		}
		
		function getCountProduct(){
			if(ajax_id_product == ''){
				$('.so_filter_shop_by_item_category').each(function(){
					var item = $(this);
					var product = item.attr('data-product');
					if(typeof product == 'undefined'){
						item.find('.sj_filter_loading').css('display','none');
					}
					if(typeof product != 'undefined'){
						if(product == -1){
							length = 0; 
						}else{
							var length = product.split('-').length;
						}
						setTimeout(function(){
								item.find('.sj_filter_loading').animate({opacity: "0"},200);
								setTimeout(function(){
									item.find('.sj_filter_loading').css('display','none');
									if(length > 0 && product != -1){
										item.find('.sj_count_item').html(length);
										item.find('.sj_filter_full').css('height','0');
										item.find('.sj_filter_full').css('width','0');
									}else{
										item.find('.sj_count_item').html(length);
										item.find('.sj_filter_full').css('height','100%');
										item.find('.sj_filter_full').css('width','100%');
									}
									
								},200)
						},500);
					}
				});
			}else{
				$('.so_filter_shop_by_item_category').each(function(){
					var item = $(this);
					var product = item.attr('data-product');
					if(typeof product == 'undefined'){
						item.find('.sj_filter_loading').css('display','none');
					}
					if(typeof product != 'undefined'){
						var product_array = product.split('-');
						if(product == -1){
							length = 0; 
						}else{
							var length = product.split('-').length;
						}
						
						var count = 0;
						for (var i = 0; i < length;i++){
							if(ajax_id_product.indexOf(product_array[i]) != -1){
								count = count + 1;
							}
						}
						setTimeout(function(){
								item.find('.sj_filter_loading').animate({opacity: "0"},200);
								setTimeout(function(){
									item.find('.sj_filter_loading').css('display','none');
									if(count > 0 && product != -1){
										item.find('.sj_count_item').html(count);
										item.find('.sj_filter_full').css('height','0');
										item.find('.sj_filter_full').css('width','0');
									}else{
										item.find('.sj_count_item').html(0);
										item.find('.sj_filter_full').css('height','100%');
										item.find('.sj_filter_full').css('width','100%');
									}
									
								},200)
						},500);
					}
				});
			}
			
		}
		
		function getCountField(){
			var length = $('.so_filter_shop_by_item_category').length;
			for(var i = 0; i < length; i++){
				var item = $('.so_filter_shop_by_item_category').eq(i);
				if(item.parent().attr('data-type') == 'field_chose' || item.parent().attr('data-type') == 'filed_radio' || item.parent().attr('data-type') == 'color'){
					var parent = item.parent();
					if(parent.find('.sj_filter_chose').length > 0){
						var id = item.attr('data-product');
						var array_id = id.split('-');
						var field = parent.attr('data-field');
						var index = field.replace(/ /g,field);
						var count = 0;
						for(var a = 0; a < array_id.length; a++){
							if(id_product_category == ''){
								if(ajax_id_product.indexOf(array_id[a]) == -1){
									count++;
								}
							}else{
								if(ajax_id_product.indexOf(array_id[a]) == -1 && id_product_category.indexOf(array_id[a]) != -1){
									count++;
								}
							}
						}
						if(id == -1){
							count = 0;
						}
						if(count != 0){
							item.find('.sj_count_item').html('+'+count);
							item.find('.sj_filter_full').css('height','0');
							item.find('.sj_filter_full').css('width','0');
						}else{
							item.find('.sj_count_item').html('0');
							item.find('.sj_filter_full').css('height','100%');
							item.find('.sj_filter_full').css('width','100%');
						}
						
					}
				}
				
				
			}
			$('.sj_filter_chose .sj_filter_full').css('width','0');
			$('.sj_filter_chose .sj_filter_full').css('height','0');
			
		}
		
		$('body').on('click','.so_filter_shop_by_item_category input',function(){
			if($(this).parent().hasClass('sj_filter_chose')){
				$(this).parent().removeClass('sj_filter_chose');
				$(this).parent().find('.sj_count_item').css('display','block');
			}else{
				$(this).parent().addClass('sj_filter_chose');
				$(this).parent().find('.sj_count_item').css('display','none');
			}
			getIdProduct();
			getCountProduct();
			setTimeout(function(){
					getCountField();
				},1000)
			getAjaxProduct();
			remove_full();
		});
		var id_rating = '';
		var product_manufacturer = '';
		$('body').on('click','.sj_filter_shop_by_chose p',function(){
			if($(this).parent().hasClass('sj_filter_chose')){
				
			}else{
				$(this).parent().addClass('sj_filter_chose');
			}
			if($(this).parent().parent().parent().attr('data-type') == 'rating'){		
				id_rating = $(this).parent().attr('data-value');
				$(this).parent().parent().find('.so_filter_shop_by_item_category .sj_filter_full').css('height','100%');
				$(this).parent().parent().find('.so_filter_shop_by_item_category .sj_filter_full').css('width','100%');
				$(this).parent().parent().find('.sj_filter_chose .sj_filter_full').css('width','0');
				$(this).parent().parent().find('.sj_filter_chose .sj_filter_full').css('height','0');
			}
			
			getIdProduct();
			getCountProduct();
			setTimeout(function(){
					getCountField();
			},1000)
				
			
			getAjaxProduct();
			remove_full();
		});
		var search_string = '';
		$('.sj_filter_btn_search').click(function(){
				search_string = '';
				getIdProduct();
				getCountProduct();
				setTimeout(function(){
						getCountField();
				},1000)
				getAjaxProduct();
				search_string = $(this).parent().find('.sj_filter_shop_by_search').val();
				getAjaxProduct();
				remove_full();	
		})
		$('.sj_filter_btn_search_delete').click(function(){ 
				search_string = $(this).parent().find('.sj_filter_shop_by_search').val('');
				search_string = '';
				getIdProduct();
				getCountProduct();
				setTimeout(function(){
						getCountField();
				},1000)
				getAjaxProduct();
				remove_full();
		})
		var string_ajax = '';
		function getAjaxProduct(){
			string_ajax = '';
			if(ajax_id_product == '' && (string_ajax == '' || typeof string_ajax != 'undefined') && id_rating == '' && search_string == ''){
				obj_class.next().find('.text-right').css('display','block');
				obj_class.html(html);
				return;
			}
			if(ajax_id_product != ''){
				string_ajax = ajax_id_product;
			}
			
			if(string_ajax != '' && typeof string_ajax != 'undefined'){
				if(id_min_max != ''){
					var array_id = id_min_max.split('-');
					var string = '';
					for(var i = 0; i < array_id.length; i++){
						if(string_ajax.indexOf(array_id[i]) != -1){
							if(string == ''){
								string = array_id[i];
							}else{
								string = string + '-' + array_id[i];
							}
						}	
					}
					string_ajax = string;
				}
			}else{
				if(id_min_max != ''){
					string_ajax = id_min_max;
				}
			}

			if(string_ajax != '' && typeof string_ajax != 'undefined'){
				string_ajax = 'pid*' + string_ajax;
				if(search_string != ''){
					string_ajax = string_ajax + '--' + 'srch*' + search_string;
				}
				
				if(id_rating != ''){
					string_ajax = string_ajax + '--' + 'rat*' + id_rating;
				}
			}else{
				if(search_string != ''){
					string_ajax = 'srch*' + search_string;
				}
				
				if(id_rating != ''  && string_ajax != ''){
					string_ajax = string_ajax + '--' + 'rat*' + id_rating;
				}else if(id_rating != ''  && string_ajax == ''){
					string_ajax = 'rat*' + id_rating;
				}
			}
			if(typeof string_ajax == 'undefined'){
				obj_class.html(html);
				return;
			}
			if(string_ajax == ''){
				obj_class.html(html);
			}else{
				$.ajax({
					type: 'POST',
					url: '<?php echo HTTP_SERVER;?>/index.php?route=module/so_filter_shop_by/get_data',
					data: {
						string: string_ajax,
						url:'<?php echo HTTP_SERVER;?>/index.php?route=module/so_filter_shop_by/get_data',
					},
						success: function (data) {			
							obj_class.next().find('.text-right').css('display','none');
							obj_class.html(data['html']);
							if(obj_class.find(".product-layout").length > 0){
								var html = obj_class.find(".product-layout").eq(0).parent().html();
								ajax_id_product = $('.sj_filter_product_id').attr('data-id');
								obj_class.html(html);
								getCountProduct();
								setTimeout(function(){
									getCountField();
									$('.sj_filter_chose .sj_filter_full').css('width','0');
									$('.sj_filter_chose .sj_filter_full').css('height','0');
								},1000);
								
							}else{
								obj_class.html('Not product');
								obj_class.next().find('.text-right').css('display','none');
								$('.sj_filter_chose .sj_filter_full').css('width','0');
								$('.sj_filter_chose .sj_filter_full').css('height','0');
							}
							
							
						},
					dataType: 'json'
				});
			}							
		}
		var obj_class = $('<?php echo $class;?>').find('.product-layout').parent();
		if(obj_class){
			var html = obj_class.html();
		}
		
		$('.so_filter_shop_by_reset_all').click(function(){
				product_manufacturer = '';
				product_color = '';
				obj_class.html(html);
				$('.so_filter_shop_by_item_category').removeClass('sj_filter_chose');
				$('.so_filter_shop_by_item_category').find('input').prop('checked', false);
				$('.so_filter_shop_by_item_category .sj_filter_full').css('width','0');
				$('.so_filter_shop_by_item_category .sj_filter_full').css('height','0');
				id_min_max = '';
				id_rating = '';
				$('.so_filter_shop_by_item_category .sj_count_item').css('display','block');
				$('.so_filter_shop_by_item_category .sj_filter_action_item').remove();
				$('.so_filter_shop_by_item_scroll_content .so_filter_shop_by_item_content_scroll_left').css('left','0');
				$('.so_filter_shop_by_item_scroll_content .so_filter_shop_by_item_content_scroll_right').css('left',(parseInt($('.so_filter_shop_by_item_scroll_content').css('width')) -20) +'px');
				$('.so_filter_shop_by_item_content_min_max').each(function(){
					$(this).find('.so_filter_shop_by_item_content_input_max').html($(this).find('.so_filter_shop_by_item_content_input_max').attr('data-max'));
					$(this).find('.so_filter_shop_by_item_content_input_min').html($(this).find('.so_filter_shop_by_item_content_input_min').attr('data-min'));
				})
				getIdProduct();
				getCountProduct();
		})
		var product_color = '';
		$('.sj_filter_color_item .sj_img').click(function(){
			if($(this).attr('data-product') == -1)return;
			if(product_color == ''){
				product_color = $(this).parent().attr('data-product');
			}else{
				var array_data = $(this).parent().attr('data-product').split('-');
				for(var i = 0; i < array_data.length; i++){
					if(product_color.indexOf(array_data[i]) == -1){
						product_color = product_color + '-' + array_data[i];
					}
				}
			}
			
			$(this).parent().append('<div class="sj_filter_color_delete"><i class="fa fa-times"></i></div>');
			$(this).parent().find('.sj_count_item').css('display','none');
			getIdProduct();
			getCountProduct();
			setTimeout(function(){
				getCountField();
			},1000)
			getAjaxProduct();
			remove_full();
		})
		
		
		$('.sj_filter_manufacturer p').click(function(){
			if($(this).parent().find('input').length == 0){
				if(child == 1){
					child = 0;
					return;
				}
				if(product_manufacturer == ''){
					product_manufacturer = $(this).parent().attr('data-product');
				}else{
					var array_data = $(this).parent().attr('data-product').split('-');
					for(var i = 0; i < array_data.length; i++){
						if(product_manufacturer.indexOf(array_data[i]) == -1){
							product_manufacturer = product_manufacturer + '-' + array_data[i];
						}
					}
				}
				getIdProduct();
				getCountProduct();
				setTimeout(function(){
					getCountField();
				},1000)
				getAjaxProduct();
				remove_full();
			}
		})
		$('.sj_filter_manufacturer  input').click(function(){
			if($(this).is(":checked")){
				if(product_manufacturer == ''){
					product_manufacturer = $(this).parent().attr('data-product');
				}else{
					var array_data = $(this).parent().attr('data-product').split('-');
					for(var i = 0; i < array_data.length; i++){
						if(product_manufacturer.indexOf(array_data[i]) == -1){
							product_manufacturer = product_manufacturer + '-' + array_data[i];
						}
					}
				}
				getIdProduct();
				getCountProduct();
				setTimeout(function(){
						getCountField();
					},1000)
				getAjaxProduct();
				remove_full();	
			}else{
				var array_data = $(this).parent().attr('data-product').split('-');
					var tg = product_manufacturer;
					for(var i = 0; i < array_data.length; i++){
						if(tg.indexOf('-'+array_data[i]) != -1){
							tg = tg.replace('-'+array_data[i],'');
						}else if(tg.indexOf(array_data[i]) != -1){
							tg = tg.replace(array_data[i],'');
						}
					}
					product_manufacturer = tg;
			}
				
				
		})
		var child = 0;
		/* $('body').on('click','<?php echo $class;?> #grid-view',function(){
			$('<?php echo $class;?> .product-layout').attr('class','<?php echo $product_cls;?>');
		})
		$('body').on('click','<?php echo $class;?> #list-view',function(){
			$('<?php echo $class;?> .product-layout').attr('class','<?php echo $column_cls;?>');
		}) */
		$('.so_filter_shop_by_item_content_input_min').click(function(){
			if($(this).find('input').length > 0)return;
			var val = $(this).html();
			$(this).html('<input type="text" />');
			$(this).find('input').val(val);
			$(this).find('input').focus();
		})
		
		$('body').on('focusout','.so_filter_shop_by_item_content_input_min input',function(){
			var val = $(this).val();
			var min = $(this).parent().attr('data-min');
			var value = parseInt(val) - parseInt(min);
			if(value < 0){
				$(this).parent().parent().parent().find('.so_filter_shop_by_item_content_scroll .so_filter_shop_by_item_content_scroll_left').css('left','0');
				$(this).parent().html(min);
			}else{
				var width = parseInt($(this).parent().parent().parent().find('.so_filter_shop_by_item_scroll_content').css('width')) - 20;
				var max =  parseInt($(this).parent().parent().find('.so_filter_shop_by_item_content_input_max').attr('data-max'));
				var ts = value/max;
				var left = width*ts;
				$(this).parent().parent().parent().find('.so_filter_shop_by_item_content_scroll .so_filter_shop_by_item_content_scroll_left').css('left',left+'px');
				$(this).parent().html(val);
			}
			getIdMinMax(obj);
			getAjaxProduct();
			remove_full();
			
		})
		
		$('.so_filter_shop_by_item_content_input_max').click(function(){
			if($(this).find('input').length > 0)return;
			var val = $(this).html();
			$(this).html('<input type="text" />');
			$(this).find('input').val(val);
			$(this).find('input').focus();
		})
		
		$('body').on('focusout','.so_filter_shop_by_item_content_input_max input',function(){
			var val = $(this).val();
			var min = $(this).parent().parent().find('.so_filter_shop_by_item_content_input_min').attr('data-min');
			var max = $(this).parent().attr('data-max');
			var check = parseInt(val) - parseInt(max);
			var value = parseInt(val) - parseInt(min);
			if(check > 0){
				var width = parseInt($(this).parent().parent().parent().find('.so_filter_shop_by_item_scroll_content').css('width')) - 20;
				$(this).parent().parent().parent().find('.so_filter_shop_by_item_content_scroll .so_filter_shop_by_item_content_scroll_right').css('left',width+'px');
				$(this).parent().html(max);
			}else{
				var width = parseInt($(this).parent().parent().parent().find('.so_filter_shop_by_item_scroll_content').css('width')) - 20 ;
				var max =  parseInt($(this).parent().parent().find('.so_filter_shop_by_item_content_input_max').attr('data-max'));
				var ts = val/max;
				var right = width*ts;
				$(this).parent().parent().parent().find('.so_filter_shop_by_item_content_scroll .so_filter_shop_by_item_content_scroll_right').css('left',right+'px');
				$(this).parent().html(val);
			}
			getIdMinMax(obj);
			getAjaxProduct();
			remove_full();
			
		})
		$('body').on('keyup','.sj_filter_shop_by_search',function(){
			var val = $(this).val();
			if(val == '' ){
				search_string = $(this).parent().find('.sj_filter_shop_by_search').val();
				getAjaxProduct();
				remove_full();
			}
			if (event.keyCode == '13') {
				search_string = '';
				getIdProduct();
				getCountProduct();
				setTimeout(function(){
						getCountField();
				},1000)
				getAjaxProduct();
				search_string = $(this).parent().find('.sj_filter_shop_by_search').val();
				getAjaxProduct();
				remove_full();	
			}
		});
		
		
			$('.so_filter_shop_by_item_scroll_content').click(function(e){

				var offset = $(this).offset();
				var left = e.pageX - offset.left - 10;
				var width = parseInt(parseInt($(this).css('width'))/2);
				if(left < width ){
					scrollLeft_obj = $(this).find('.so_filter_shop_by_item_content_scroll_left');
					$(this).find('.so_filter_shop_by_item_content_scroll_left').css('left',left+'px');
					left = left;
					var ts = left / (parseInt(scrollLeft_obj.parent().css('width')) -20);
					var min_max = parseInt(scrollLeft_obj.parent().parent().parent().find('.so_filter_shop_by_item_content_min_max .so_filter_shop_by_item_content_input_max').attr('data-max'));
					var val_left = parseInt(min_max * ts) + parseInt(scrollLeft_obj.parent().parent().parent().find('.so_filter_shop_by_item_content_min_max .so_filter_shop_by_item_content_input_min').attr('data-min'));
					if(val_left <= 0){
						scrollLeft_obj.parent().parent().parent().find('.so_filter_shop_by_item_content_min_max .so_filter_shop_by_item_content_input_min').html(parseInt(scrollLeft_obj.parent().parent().parent().find('.so_filter_shop_by_item_content_min_max .so_filter_shop_by_item_content_input_min').attr('data-min')));
					}else{
						scrollLeft_obj.parent().parent().parent().find('.so_filter_shop_by_item_content_min_max .so_filter_shop_by_item_content_input_min').html(val_left);
					}
					scrollLeft = 0;
					getIdMinMax(obj);
					getAjaxProduct();
					remove_full();
				}else{
					scrollRitgh_obj = $(this).find('.so_filter_shop_by_item_content_scroll_right');
					scrollRitgh_obj.css('left',left+'px');
					left = left;
					var ts = left / (parseInt(scrollRitgh_obj.parent().css('width')) -20);
					var min_max = parseInt(scrollRitgh_obj.parent().parent().parent().find('.so_filter_shop_by_item_content_min_max .so_filter_shop_by_item_content_input_max').attr('data-max'));
					var val_left = parseInt(min_max * ts);
					if(val_left == 0){
						scrollRitgh_obj.parent().parent().parent().find('.so_filter_shop_by_item_content_min_max .so_filter_shop_by_item_content_input_max').html(parseInt(scrollRitgh_obj.parent().parent().parent().find('.so_filter_shop_by_item_content_min_max .so_filter_shop_by_item_content_input_min').attr('data-min')));
					}else{
						scrollRitgh_obj.parent().parent().parent().find('.so_filter_shop_by_item_content_min_max .so_filter_shop_by_item_content_input_max').html(val_left);
					}
					scrollLeft = 0;
					getIdMinMax(obj);
					getAjaxProduct();
					remove_full();
				}
			});
		
	});
	//]]>
</script>