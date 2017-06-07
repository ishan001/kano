
<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<button data-toggle="tooltip" title="<?php echo $button_save; ?>" data-action="" class="btn btn-primary sj_filter_submit"><i class="fa fa-save"></i> <?php echo $objlang->get('entry_button_save');?></button>
				<button class="btn btn-success sj_filter_submit"  data-action="save_edit" data-toggle="tooltip" title="<?php echo $objlang->get('entry_button_save_and_edit'); ?>" ><i class="fa fa-pencil-square-o"></i> <?php echo $objlang->get('entry_button_save_and_edit');?></button>	
				<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $objlang->get('entry_button_cancel'); ?>" class="btn btn-danger"><i class="fa fa-reply"></i>  <?php echo $objlang->get('entry_button_cancel');?></a>
			</div>
			<h1><?php echo $objlang->get('heading_title'); ?></h1>
			<ul class="breadcrumb">
				<?php foreach ($breadcrumbs as $breadcrumb) { ?>
				<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
	
	<div class="container-fluid">
		<?php if (isset($error['warning'])) { ?>
		<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error['warning']; ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
		<?php } ?>
		<?php if (isset($success) && !empty($success)) { ?>
		<div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
		<div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo 'After you have installed and configured a module you can add it to a layout <a href="http://localhost/opencart/admin/index.php?route=design/layout&amp;token=hBZR8eMFmhE1KezjdzpdmIfKCyR5Hlke" class="alert-link">here</a>'; ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
		<?php } ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
			</div>
		<div class="panel-body">
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-featured" class="form-horizontal sj_filter_form">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?> <b style="color:#f00">*</b></label>
							<div class="col-sm-10">
								<div class="col-sm-5">
									<input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
								</div>
								<?php if ($error_name) { ?>
									<div class="text-danger col-sm-12"><?php echo $error_name; ?></div>
								<?php }else{?>
									<i class="col-sm-12" style="font-weight:normal; color:#ccc"><?php echo $entry_name_desc ?></i>
								<?php } ?>
							</div>
					</div>
					<div class="form-group"><!--Header title-->
					<label class="col-sm-2 control-label" for="input-head_name"><b style="color:#f00">*</b> <span data-toggle="tooltip" title="<?php echo $objlang->get('entry_head_name_desc'); ?>"><?php echo $objlang->get('entry_head_name'); ?></span></label>
									
									<div class="col-sm-9">
										<div class="col-sm-5">
											<?php
												$i = 0;
												foreach ($languages as $language) { $i++; ?>
											<input type="text" name="module_description[<?php echo $language['language_id']; ?>][head_name]" placeholder="<?php echo $objlang->get('entry_head_name'); ?>" id="input-head-name-<?php echo $language['language_id']; ?>" value="<?php echo isset($module_description[$language['language_id']]['head_name']) ? $module_description[$language['language_id']]['head_name'] : ''; ?>" class="form-control <?php echo ($i>1) ? ' hide ' : ' first-name'; ?>" />
											<?php
													 if($i == 1){ ?>
											<input type="hidden" class="form-control" id="input-head_name" placeholder="<?php echo $objlang->get('entry_head_name'); ?>" value="<?php echo isset($module_description[$language['language_id']]['head_name']) ? $module_description[$language['language_id']]['head_name'] : ''; ?>" name="head_name">
											<?php }
													 ?>
											<?php } ?>
										</div>
										<div class="col-sm-3">
											<select  class="form-control" id="language">
												<?php foreach ($languages as $language) { ?>
												<option value="<?php echo $language['language_id']; ?>" style="background:url('../image/flags/<?php echo $language['image']; ?>') left center no-repeat; padding-left: 20px;"> <?php echo $language['name']; ?> </option>
												<?php } ?>
											</select>
										</div>
										<?php if (isset($head_name) && $head_name != '') { ?>
										<div class="text-danger col-sm-12"><?php echo $head_name; ?></div>
										<?php } ?>
									</div>
								</div>
								<div class="form-group"> <!--Display header title -->
									<label class="col-sm-2 control-label" for="input-disp_title_module"><span data-toggle="tooltip" title="<?php echo $objlang->get('entry_display_title_module_desc'); ?>"><?php echo $objlang->get('entry_display_title_module'); ?></span></label>
									<div class="col-sm-9">
										<div class="col-sm-5">
											<select name="disp_title_module" id="input-disp_title_module" class="form-control">
												<?php if ($module['disp_title_module']) { ?>
												<option value="1" selected="selected"><?php echo $objlang->get('text_yes'); ?></option>
												<option value="0"><?php echo $objlang->get('text_no'); ?></option>
												<?php } else { ?>
												<option value="1"><?php echo $objlang->get('text_yes'); ?></option>
												<option value="0" selected="selected"><?php echo $objlang->get('text_no'); ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-name"><?php echo 'In CLass'; ?></label>
							<div class="col-sm-10">
								<div class="col-sm-5">
									<input type="text" name="in_class" value="<?php echo $in_class; ?>" id="input-class" class="form-control" />
								</div>
								
							</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-name"><?php echo 'Class Suffix'; ?></label>
							<div class="col-sm-10">
								<div class="col-sm-5">
									<input type="text" name="cls_suffix" value="<?php echo $cls_suffix; ?>" id="input-class" class="form-control" />
								</div>
								
							</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
						<div class="col-sm-10">
							<div class="col-sm-5">
								<select name="status" id="input-status" class="form-control">
									<?php if (isset($status) && $status) { ?>
									<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
									<option value="0"><?php echo $text_disabled; ?></option>
									<?php } else { ?>
									<option value="1"><?php echo $text_enabled; ?></option>
									<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-name"><?php echo 'Build Field Color Using Type Color:'; ?></label>
							<div class="col-sm-10">
								<div class="col-sm-5">
									<select name="build_color" id="input-status" class="form-control">
											<?php if ($build_color) { ?>
											<option value="1" selected="selected">Yes</option>
											<option value="0">No</option>
											<?php } else { ?>
											<option value="1">Yes</option>
											<option value="0" selected="selected">No</option>
											<?php } ?>
									</select>
								</div>
								
							</div>
					</div>
					<input type="hidden" name="action" id="action" value=""/>
					<input type="hidden" name="moduleid" value="<?php echo $mod_id; ?>" />
					<input type="hidden" name="database" value="<?php if(isset($database) && $database != '')echo $database;?>" class="sj_filter_shop_by_database"/>
					<input type="hidden" name="language" value="<?php if(isset($language)) echo $language['language_id'];?>" class="sj_filter_shop_by_language"/>
			</form>
			
      </div>
	  <div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-paw"></i> <?php echo $text_edit_content; ?></h3>
				<div class="chose_language">
					<div class="show_languege" data-id="<?php echo $all_languge[0]['language_id'];?>"><div class="img_languege"><img src="<?php echo HTTP_CATALOG.'image/flags/'.$all_languge[0]['image']?>" alt/></div><div class="name_languege"><?php echo $all_languge[0]['name'];?></div></div>
					<div class="wrap">
					<?php foreach($all_languge as $index => $lg){
						if($index == 0){
							$cls = ' show_languege_chose';
						}else{
							$cls = '';
						}
					?>
							
						  <div class="language_item<?php echo $cls;?>" data-id="<?php echo $lg['language_id'];?>"><div class="img_languege"><img src="<?php echo HTTP_CATALOG.'image/flags/'.$lg['image']?>" alt/></div><div class="name_languege"><?php echo $lg['name'];?></div></div>
					<?php } ?>
				</div>
				</div>
	 </div>
	 <div class="panel-body">
	 <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------->
				<div class="col-sm-4 sj_filter_shop_by_content_menu">
						<div class="btn btn-warning sj_filter_shop_by_content_menu_title">Content</div>
						<div class="sj_filter_shop_by_content_menu_content">
							
							
						</div>
						<div class="sj_fulll_absolute"></div>
						<div class="sj_filter_list_field_atribute">
							<?php foreach($field_atribute as $index => $field){
								if(($index+1) == count($field_atribute)){
									$cls = ' sj_filter_field_last';
								}else{
									$cls = '';
								}
								echo '<div class="sj_filter_field_atribute_item'.$cls.'" data-id="'.$field['id'].'" data-id-languge="'.$field['language_id'].'" data-val="'.$field['name'].'">'.ucwords($field['name']).'</div>';
							}?>
						</div>
						<div class="sj_filter_list_field_default">
							<?php foreach($field_default as $index => $field){
								if(($index+1) == count($field_atribute)){
									$cls = ' sj_filter_field_last';
								}else{
									$cls = '';
								}
								echo '<div class="sj_filter_field_default_item'.$cls.'" data-val="'.$field.'">'.ucwords($field).'</div>';
							}?>
						</div>
						<div class="sj_filter_list_manufacture">
							<?php foreach($manufacture as $index => $field){
								if(($index+1) == count($field_atribute)){
									$cls = ' sj_filter_field_last';
								}else{
									$cls = '';
								}
								echo '<div class="sj_filter_list_manufacture_item'.$cls.'" data-id="'.$field['manufacturer_id'].'" data-image="'.$field['image'].'" data-name="'.$field['name'].'">'.$field['name'].'</div>';
							}?>
						</div>
						<div class="sj_filter_list_field_color">
							<?php if($field_color != 0){ ?>
							<?php foreach($field_color as $index => $field){
								if(($index+1) == count($field_color)){
									$cls = ' sj_filter_field_last';
								}else{
									$cls = '';
								}
								echo '<div class="sj_filter_list_field_color_item'.$cls.'">'.$field['name'].'</div>';
							}?>
							<?php }else{ 
								echo 'Not Field Chose';
							} ?>
						</div>
						<div class="sj_filter_list_color_item"></div>
						<div class="sj_filter_text_field_attribute_list"></div>
				</div>
				 <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------->
				 <div class="col-sm-4 sj_filter_shop_by_content_menu_type">
						<div class="btn btn-warning sj_filter_shop_by_content_menu_title">Chose Type Filter</div>
						<div class="sj_wrap_border">
							<div class="sj_wrap">
								<div class="bg-success sj_item_type_filter" data-type="categories"><div class="sj_move_type_filter">Categories</div><div class="sj_action_type_filter"><i class="fa fa-paper-plane-o"></i></div></div>
								<div class="bg-success sj_item_type_filter" data-type="filed_min_max"><div class="sj_move_type_filter">Field Min Max</div><div class="sj_action_type_filter"><i class="fa fa-paper-plane-o"></i></div></div>
								<div class="bg-success sj_item_type_filter" data-type="field_chose"><div class="sj_move_type_filter">Field Chose</div><div class="sj_action_type_filter"><i class="fa fa-paper-plane-o"></i></div></div>
								<div class="bg-success sj_item_type_filter" data-type="search"><div class="sj_move_type_filter">Search</div><div class="sj_action_type_filter"><i class="fa fa-paper-plane-o"></i></div></div>
								<!-- <div class="bg-success sj_item_type_filter" data-type="model"><div class="sj_move_type_filter">Model</div><div class="sj_action_type_filter"><i class="fa fa-paper-plane-o"></i></div></div> -->
								<div class="bg-success sj_item_type_filter" data-type="filed_radio"><div class="sj_move_type_filter">Field Radio</div><div class="sj_action_type_filter"><i class="fa fa-paper-plane-o"></i></div></div>
								<div class="bg-success sj_item_type_filter" data-type="manufacturer"><div class="sj_move_type_filter">Manufacturer</div><div class="sj_action_type_filter"><i class="fa fa-paper-plane-o"></i></div></div>
								<div class="bg-success sj_item_type_filter" data-type="color"><div class="sj_move_type_filter">Color</div><div class="sj_action_type_filter"><i class="fa fa-paper-plane-o"></i></div></div>
								<div class="bg-success sj_item_type_filter" data-type="reset_all"><div class="sj_move_type_filter">Reset All</div><div class="sj_action_type_filter"><i class="fa fa-paper-plane-o"></i></div></div>
								<div class="bg-success sj_item_type_filter" data-type="rating"><div class="sj_move_type_filter">Rating</div><div class="sj_action_type_filter"><i class="fa fa-paper-plane-o"></i></div></div>
							</div>
						</div>						
				 </div>
				  <div class="col-sm-4 sj_filter_shop_by_content_menu_categories">
						<div class="btn btn-warning sj_filter_shop_by_content_menu_title sj_chose_categories_title">Chose Category<input class="sj_filter_search_categories"type="text" readonly="true"/></div>
						<div class="sj_wrap_border sj_chose_categories_relative">
							<div class="sj_wrap sj_chose_categories">
						<?php 
						foreach($categories as $ca){ 
							$str_name = str_replace('&nbsp;','',$ca['name']);
							$array_str_name = explode('&gt;',$str_name);
							$data_name = $array_str_name[count($array_str_name) - 1];
						?>
							<div class="bg-success sj_item_category" data-name="<?php echo $data_name;?>" data-language_id="<?php echo $ca['language_id'];?>" data-id="<?php echo $ca['category_id'];?>"><div class="sj_move_category_filter" data-html="<?php echo $ca['name'];?>"><?php echo $ca['name'];?></div><div class="sj_action_category_filter"><i class="fa fa-paper-plane-o"></i></div></div>
						<?php } ?>
							</div>
							<div class="sj_not_chose"></div>
						</div>
				  </div>
	</div>
    </div>	
		
  </div>
</div>	
<div class="sj_filter_type_move"></div>
<div class="bg-success sj_filter_type_move_category"></div>

<?php echo $footer; ?>

<script type="text/javascript">
	$(document).ready(function(){
		
		var id_language = $('.sj_filter_shop_by_language').val();
		$('.language_item').each(function(){
			var id = $(this).attr('data-id');
			if(id == id_language){
				html = $(this).html();
				$('.chose_language').find('.show_languege').html(html);
				$('.language_item').removeClass('show_languege_chose');
				$(this).addClass('show_languege_chose');
			}
		})
		var index;
		var val_database = $('.sj_filter_shop_by_database').val();
		var height_title_item;
		function checkCategory(){
			$('.sj_chose_categories .sj_not_action_category_item').addClass('sj_item_category');
			$('.sj_chose_categories .sj_item_category').removeClass('sj_not_action_category_item');
			var length = $('.sj_filter_group_categories').find('.sj_filter_category_item_wrap').length;
			if(length == 0)return;
			var string = '';
			$('.sj_filter_group_categories').find('.sj_filter_category_item_wrap ').each(function(){
				string = string + '--' + $(this).find('.sj_name_category').attr('data-id');
			});
			
			$('.sj_chose_categories .sj_item_category').each(function(){
				var id = $(this).attr('data-id');
				if(string.indexOf(id) != -1){
					$(this).removeClass('sj_item_category');
					$(this).addClass('sj_not_action_category_item');					
				}
			})
		}
		
		
		
		if(val_database != ''){
			var array_item_content = val_database.split('-----');
			for(var i = 0; i < array_item_content.length; i++){
					$('.sj_filter_shop_by_content_menu_content').append('<div class="sj_filter_shop_by_content_menu_conten_item_wrap"></div>');
					var element = $('.sj_filter_shop_by_content_menu_content .sj_filter_shop_by_content_menu_conten_item_wrap').eq(i);
					var array_info = array_item_content[i].split('---');
					var type = array_info[0];
					element.html('<div class="bg-success sj_filter_shop_by_content_menu_title_item" data-type="'+array_info[0]+'">'+
												'<div class="sj_title_item"><p>Categories</p><input type="text" value="Categories"/></div>'+
												'<div class="sj_action_item">'+
													'<div class="sj_action_item_action sj_action_item_remove"><i class="fa fa-times"></i></div>'+
													'<div class="sj_action_item_action sj_action_item_move"><i class="fa fa-arrows"></i></div>'+
													'<div class="sj_action_item_action sj_action_item_edit"><i class="fa fa-pencil"></i></div>'+
												'</div>');
					
					if(type != 'search' && type != 'reset_all'){
						element.append('<div class="sj_filter_shop_by_content_menu_conten_item"></div>');
					}
					if(type == 'field_chose' || type == 'filed_radio'){
						element.find('.sj_filter_shop_by_content_menu_conten_item').append('<div class="sj_content_wrap"></div><div class="sj_finter_input_add bg-success">Add<i class="fa fa-plus"></i></div>');
					}
					if(type == 'categories'){
						element.append('<div class="sj_filter_shop_by_content_category_type" style="display:none;"></div>');
						var info =  array_info[2].split('--');
						for(var t = 0; t < info.length; t++){
								if(info[t] == 1){
									var bg = 'darkgoldenrod';
									var text = 'Show';
								}else{
									var bg = 'darkgray';
									var text = 'Hide';
								}
								if(t == 0){
									var cls = 'logo';
									var text_c = 'Logo';
								}else{
									var cls = 'radio';
									var text_c = 'Radio';
								}
								element.find('.sj_filter_shop_by_content_category_type').append('<div class="sj_filter_category_show_'+cls+'" data-val="'+info[t]+'" style="background: '+bg+'">'+text+' '+text_c+'</div>');
						}	
					}
					if(type == 'manufacturer'){
						element.append('<div class="sj_filter_shop_by_content_category_type" style="display:none;"></div>');
						var info =  array_info[2].split('--');
						for(var t = 0; t < info.length; t++){
								if(info[t] == 1){
									var bg = 'darkgoldenrod';
									var text = 'Show';
								}else{
									var bg = 'darkgray';
									var text = 'Hide';
								}
								if(t == 0){
									var cls = 'logo';
									var text_c = 'Logo';
								}else{
									var cls = 'radio';
									var text_c = 'Radio';
								}
								element.find('.sj_filter_shop_by_content_category_type').append('<div class="sj_filter_category_show_'+cls+'" data-val="'+info[t]+'" style="background: '+bg+'">'+text+' '+text_c+'</div>');
						}	
					}
					
					var array_e = array_info[1].split('--');
					for(var e = 0; e < array_e.length; e++){
							if(e == 0){
									element.find('.sj_title_item p').html(array_e[e]);
									element.find('.sj_title_item input').val(array_e[e]);
							}else{
									if(type == 'categories'){
										var info_caregory = array_e[e].split('-');
										element.find('.sj_filter_shop_by_content_menu_conten_item').append('<div class="sj_filter_category_item_wrap bg-success" style="height: auto;"><div class="sj_name_category" data-id="'+info_caregory[0]+'">'+info_caregory[1].split('*')[0]+'</div><div class="sj_action_category"><div class="sj_action_category_delete"><i class="fa fa-times"></i></div></div></div>')
									}
									if(type == 'manufacturer'){
										var info_caregory = array_e[e].split('-');
										var img = info_caregory[2].split('*')[0];
										element.find('.sj_filter_shop_by_content_menu_conten_item').append('<div class="sj_manufacture_item bg-success" style="height: auto;" data-id="'+info_caregory[0]+'" data-name="'+info_caregory[1]+'" data-image="'+img+'"><p>'+info_caregory[1]+'</p><div class="sj_manufacture_item_delete"><i class="fa fa-times"></i></div></div>')
									}
									if(type == 'filed_min_max'){
										if(e == 1){
											var name_f = 'Field:'
											if(array_info[2] == 0){
												var color = "red";
											}else{
												var color = "#000";
											}
											var html_f = '<div class="sj_finter_input_chose_type_field" data-type ="'+array_info[2]+'" style="color:'+color+'"><i class="fa fa-bars"></i></div>';
										}
										if(e == 2){
											var name_f = 'Max:'
											var html_f = '';
										}
										if(e == 3){
											var name_f = 'Min:'
											var html_f = '';
										}
										if(e == 4)continue;
										element.find('.sj_filter_shop_by_content_menu_conten_item').append('<div class="sj_finter_input bg-success">'+
																																						'<div class="sj_wrap_item">'+
																																						'<div class="sj_finter_input_name">'+name_f+'</div>'+
																																						'<div class="sj_finter_input_content"><input type="text" value="'+array_e[e]+'"/></div>'+
																																						'</div>'+html_f+
																																					'</div>');
																																					
									}
									if(type == 'field_chose' || type == 'filed_radio'){
											if(e == 1){
												var name_f = 'Field:'
												var data = array_e[e];
												if(array_info[2] == 0){
													var color = "red";
												}else{
													var color = "#000";
												}
												var html_f = '<div class="sj_finter_input_chose_type_field" data-type ="'+array_info[2]+'" style="color:'+color+'"><i class="fa fa-bars"></i></div>';
											}else{
												var name_f = 'Value:';
												var data = array_e[e].split('*')[0];
												var html_f = '<div class="sj_finter_input_delete"><i class="fa fa-times"></i></div>';
											}
											
											element.find('.sj_filter_shop_by_content_menu_conten_item .sj_content_wrap').append('<div class="sj_finter_input bg-success"><div class="sj_wrap_item"><div class="sj_finter_input_name">'+name_f+'</div><div class="sj_finter_input_content"><input type="text" value="'+data+'"/></div></div>'+html_f +'</div>');
									}
									if(type == 'color'){
										if(e == 1){
											var name_f = 'Field:'
											var data = array_e[e];
											if(array_info[2] == 0){
												var color = "red";
											}else{
												var color = "#000";
											}
											var html_f = '<div class="sj_finter_input_action_color"><i class="fa fa-arrow-right"></i></div>';
											element.find('.sj_filter_shop_by_content_menu_conten_item').append('<div class="sj_content_wrap"></div>');
											element.find('.sj_filter_shop_by_content_menu_conten_item .sj_content_wrap').append('<div class="sj_finter_input bg-success"><div class="sj_wrap_item"><div class="sj_finter_input_name">'+name_f+'</div><div class="sj_finter_input_content"><input type="text" value="'+data+'"/></div></div>'+html_f +'</div>');
											element.find('.sj_filter_shop_by_content_menu_conten_item .sj_content_wrap').append('<div class="sj_finter_input_list_color"></div>');
										}else{
											var data = array_e[e].split('-');
											var img = data[1].split('*')[0]+'-100x100.jpg';
											element.find('.sj_filter_shop_by_content_menu_conten_item .sj_content_wrap .sj_finter_input_list_color').append('<div class="sj_filter_color_item_content"><div class="sj_color_html" data-id="'+data[0]+'"><img src="'+img+'"></div><div class="sj_action_color"><i class="fa fa-times"></i></div></div>')
										}
									}
							}							
					}
					height_title_item = 28;					
			}
		}
		var array_html_type = new Array();
		array_html_type['categories']       = '<div class="bg-success sj_filter_shop_by_content_menu_title_item" data-type="categories">'+
																	'<div class="sj_title_item"><p>Categories</p><input type="text" value="Categories"/></div>'+
																	'<div class="sj_action_item">'+
																	'<div class="sj_action_item_action sj_action_item_remove"><i class="fa fa-times"></i></div>'+
																	'<div class="sj_action_item_action sj_action_item_move"><i class="fa fa-arrows"></i></div>'+
																	'<div class="sj_action_item_action sj_action_item_edit"><i class="fa fa-pencil"></i></div>'+
																	'</div>'+
																'</div>'+
																'<div class="sj_filter_shop_by_content_menu_conten_item">'+
																		
																'</div>'+
																'<div class="sj_filter_shop_by_content_category_type" style="display:none;">'+
																	'<div class="sj_filter_category_show_logo" data-val="1">Show Logo</div>'+
																	'<div class="sj_filter_category_show_radio" data-val="1">Show Radio</div>'+
																'</div>';
		array_html_type['manufacturer']       = '<div class="bg-success sj_filter_shop_by_content_menu_title_item" data-type="manufacturer">'+
																	'<div class="sj_title_item"><p>Manufacturer</p><input type="text" value="Manufacturer"/></div>'+
																	'<div class="sj_action_item">'+
																	'<div class="sj_action_item_action sj_action_item_remove"><i class="fa fa-times"></i></div>'+
																	'<div class="sj_action_item_action sj_action_item_move"><i class="fa fa-arrows"></i></div>'+
																	'<div class="sj_action_item_action sj_action_item_edit"><i class="fa fa-pencil"></i></div>'+
																	'</div>'+
																'</div>'+
																'<div class="sj_filter_shop_by_content_menu_conten_item">'+
																		
																'</div>'+
																'<div class="sj_filter_shop_by_content_category_type" style="display:none;">'+
																	'<div class="sj_filter_category_show_logo" data-val="1">Show Logo</div>'+
																	'<div class="sj_filter_category_show_radio" data-val="1">Show Radio</div>'+
																'</div>';
		array_html_type['reset_all']       = '<div class="bg-success sj_filter_shop_by_content_menu_title_item" data-type="reset_all">'+
																	'<div class="sj_title_item"><p>Reset All</p><input type="text" value="Reset All"/></div>'+
																	'<div class="sj_action_item">'+
																	'<div class="sj_action_item_action sj_action_item_remove"><i class="fa fa-times"></i></div>'+
																	'<div class="sj_action_item_action sj_action_item_move"><i class="fa fa-arrows"></i></div>'+
																	'<div class="sj_action_item_action sj_action_item_edit"><i class="fa fa-pencil"></i></div>'+
																	'</div>'+
																'</div>';
																
		array_html_type['filed_min_max'] = '<div class="bg-success sj_filter_shop_by_content_menu_title_item" data-type="filed_min_max">'+
																	'<div class="sj_title_item"><p>Min Max</p><input type="text" value="Min Max"/></div>'+
																	'<div class="sj_action_item">'+
																	'<div class="sj_action_item_action sj_action_item_remove"><i class="fa fa-times"></i></div>'+
																	'<div class="sj_action_item_action sj_action_item_move"><i class="fa fa-arrows"></i></div>'+
																	'<div class="sj_action_item_action sj_action_item_edit"><i class="fa fa-pencil"></i></div>'+
																	'</div>'+
																'</div>'+
																'<div class="sj_filter_shop_by_content_menu_conten_item">'+
																		'<div class="sj_finter_input bg-success">'+
																			'<div class="sj_wrap_item">'+
																			'<div class="sj_finter_input_name">Field:</div>'+
																			'<div class="sj_finter_input_content"><input type="text" readonly="true"/></div>'+
																			'</div>'+
																			'<div class="sj_finter_input_chose_type_field" data-type ="0" data-toggle="tooltip" data-placement="top" title="Chose Filed Atribute Or Field Default"><i class="fa fa-bars"></i></div>'+	
																		'</div>'+
																		'<div class="sj_finter_input bg-success">'+
																			'<div class="sj_wrap_item">'+
																			'<div class="sj_finter_input_name">Max</div>'+
																			'<div class="sj_finter_input_content"><input type="text"/></div>'+
																			'</div>'+
																		'</div>'+
																		'<div class="sj_finter_input bg-success">'+
																			'<div class="sj_wrap_item">'+
																			'<div class="sj_finter_input_name">Min</div>'+
																			'<div class="sj_finter_input_content"><input type="text"/></div>'+
																			'</div>'+
																		'</div>'+
																'</div>';	
		array_html_type['field_chose'] = '<div class="bg-success sj_filter_shop_by_content_menu_title_item" data-type="field_chose">'+
																	'<div class="sj_title_item"><p>Field Chose</p><input type="text" value="Field Chose"/></div>'+
																	'<div class="sj_action_item">'+
																	'<div class="sj_action_item_action sj_action_item_remove"><i class="fa fa-times"></i></div>'+
																	'<div class="sj_action_item_action sj_action_item_move"><i class="fa fa-arrows"></i></div>'+
																	'<div class="sj_action_item_action sj_action_item_edit"><i class="fa fa-pencil"></i></div>'+
																	'</div>'+
																'</div>'+
																'<div class="sj_filter_shop_by_content_menu_conten_item">'+
																	'<div class="sj_content_wrap">'+
																		'<div class="sj_finter_input bg-success">'+
																			'<div class="sj_wrap_item">'+
																			'<div class="sj_finter_input_name">Field:</div>'+
																			'<div class="sj_finter_input_content"><input type="text" readonly="true"/></div>'+
																			'</div>'+
																			'<div class="sj_finter_input_chose_type_field" data-type ="0" data-toggle="tooltip" data-placement="top" title="Chose Filed Atribute Or Field Default"><i class="fa fa-bars"></i></div>'+	
																		'</div>'+
																		'<div class="sj_finter_input bg-success">'+
																			'<div class="sj_wrap_item">'+
																			'<div class="sj_finter_input_name">Value</div>'+														
																			'<div class="sj_finter_input_content"><input type="text"/></div>'+
																			'</div>'+
																			'<div class="sj_finter_input_delete"><i class="fa fa-times"></i></div>'+		
																		'</div>'+
																		
																	'</div>'+
																	'<div class="sj_finter_input_add bg-success">Add<i class="fa fa-plus"></i>'+
																		
																	'</div>'+
																'</div>';	
		array_html_type['color'] = '<div class="bg-success sj_filter_shop_by_content_menu_title_item" data-type="color">'+
																	'<div class="sj_title_item"><p>Color</p><input type="text" value="Color" /></div>'+
																	'<div class="sj_action_item">'+
																	'<div class="sj_action_item_action sj_action_item_remove"><i class="fa fa-times"></i></div>'+
																	'<div class="sj_action_item_action sj_action_item_move"><i class="fa fa-arrows"></i></div>'+
																	'<div class="sj_action_item_action sj_action_item_edit"><i class="fa fa-pencil"></i></div>'+
																	'</div>'+
																'</div>'+
																'<div class="sj_filter_shop_by_content_menu_conten_item">'+
																	'<div class="sj_content_wrap">'+
																		'<div class="sj_finter_input bg-success">'+
																			'<div class="sj_wrap_item">'+
																			'<div class="sj_finter_input_name">Field Color:</div>'+
																			'<div class="sj_finter_input_content"><input type="text" readonly="true"/></div>'+
																			'</div>'+
																			'<div class="sj_finter_input_action_color" data-toggle="tooltip" data-placement="top" title="Chose Value Color"><i class="fa fa-arrow-right"></i></div>'+	
																		'</div>'+
																		'<div class="sj_finter_input_list_color">'+
																			
																		'</div>'+
																		
																	'</div>'+
																	
																'</div>';														
		array_html_type['filed_radio'] = '<div class="bg-success sj_filter_shop_by_content_menu_title_item" data-type="filed_radio">'+
																	'<div class="sj_title_item"><p>Field Radio</p><input type="text" value="Field Radio"/></div>'+
																	'<div class="sj_action_item">'+
																	'<div class="sj_action_item_action sj_action_item_remove"><i class="fa fa-times"></i></div>'+
																	'<div class="sj_action_item_action sj_action_item_move"><i class="fa fa-arrows"></i></div>'+
																	'<div class="sj_action_item_action sj_action_item_edit"><i class="fa fa-pencil"></i></div>'+
																	'</div>'+
																'</div>'+
																'<div class="sj_filter_shop_by_content_menu_conten_item">'+
																	'<div class="sj_content_wrap">'+
																		'<div class="sj_finter_input bg-success">'+
																			'<div class="sj_wrap_item">'+
																			'<div class="sj_finter_input_name">Field:</div>'+
																			'<div class="sj_finter_input_content"><input type="text" readonly="true"/></div>'+
																			'</div>'+
																			'<div class="sj_finter_input_chose_type_field" data-type ="0" data-toggle="tooltip" data-placement="top" title="Chose Filed Atribute Or Field Default"><i class="fa fa-bars"></i></div>'+	
																		'</div>'+
																		'<div class="sj_finter_input bg-success">'+
																			'<div class="sj_wrap_item">'+
																			'<div class="sj_finter_input_name">Value</div>'+														
																			'<div class="sj_finter_input_content"><input type="text"/></div>'+
																			'</div>'+
																			'<div class="sj_finter_input_delete"><i class="fa fa-times"></i></div>'+				
																		'</div>'+
																		
																	'</div>'+
																	'<div class="sj_finter_input_add bg-success">Add<i class="fa fa-plus"></i>'+
																		
																	'</div>'+
																'</div>';
																
		array_html_type['search'] = '<div class="bg-success sj_filter_shop_by_content_menu_title_item" data-type="search">'+
																	'<div class="sj_title_item"><p>Search</p><input type="text" value="Search"/></div>'+
																	'<div class="sj_action_item">'+
																	'<div class="sj_action_item_action sj_action_item_remove"><i class="fa fa-times"></i></div>'+
																	'<div class="sj_action_item_action sj_action_item_move"><i class="fa fa-arrows"></i></div>'+
																	'<div class="sj_action_item_action sj_action_item_edit"><i class="fa fa-pencil"></i></div>'+
																	'</div>'+
																'</div>';
		array_html_type['rating'] = '<div class="bg-success sj_filter_shop_by_content_menu_title_item" data-type="rating">'+
																	'<div class="sj_title_item"><p>Rating</p><input type="text" value="Rating"/></div>'+
																	'<div class="sj_action_item">'+
																	'<div class="sj_action_item_action sj_action_item_remove"><i class="fa fa-times"></i></div>'+
																	'<div class="sj_action_item_action sj_action_item_move"><i class="fa fa-arrows"></i></div>'+
																	'<div class="sj_action_item_action sj_action_item_edit"><i class="fa fa-pencil"></i></div>'+
																	'</div>'+
																'</div>';
																
		var move_on = 0;
		$('body').on('click','.sj_filter_shop_by_content_menu_conten_item_wrap .sj_title_item',function(){
				var type = $(this).parent().attr('data-type');
				if(type == 'search' || type == 'reset_all'){
					$('.sj_filter_shop_by_content_menu_conten_item').slideUp();
					index = -1;
					$('.sj_not_chose').css('display','block');
					$('.sj_chose_categories_title input').attr('readonly','true');
					$('.sj_filter_shop_by_content_menu_conten_item_wrap').find('.sj_filter_shop_by_content_menu_conten_item').removeClass('sj_filter_group_categories');
					$('.sj_filter_shop_by_content_category_type').css('display','none');
					$('.sj_filter_list_manufacture').css('display','none');
					return;
				}
				
				if(index == $(this).parent().parent().index()){
					$('.sj_filter_shop_by_content_menu_conten_item').slideUp();
					index = -1;
					$('.sj_not_chose').css('display','block');
					$('.sj_chose_categories_title input').attr('readonly','true');
					$('.sj_filter_shop_by_content_menu_conten_item_wrap').find('.sj_filter_shop_by_content_menu_conten_item').removeClass('sj_filter_group_categories');
					$('.sj_filter_shop_by_content_category_type').css('display','none');
					$('.sj_filter_list_manufacture').css('display','none');
					return;
				}
				
				$('.sj_filter_shop_by_content_menu_conten_item_wrap').find('.sj_filter_shop_by_content_menu_conten_item').removeClass('sj_filter_group_categories');
				$('.sj_filter_shop_by_content_category_type').css('display','none');
				$('.sj_filter_list_manufacture').css('display','none');
				if(type == 'manufacturer'){
					$(this).parent().parent().find('.sj_filter_shop_by_content_category_type').css('display','block');
					$('.sj_filter_list_manufacture').css('display','block');
					obj_aa = $(this).parent().parent();
					check_manufacturer();
					
				}
				if(type == 'categories'){
					$('.sj_not_chose').css('display','none');
					
					$('.sj_chose_categories_title input').removeAttr('readonly');
					$(this).parent().parent().find('.sj_filter_shop_by_content_menu_conten_item').addClass('sj_filter_group_categories');
					$(this).parent().parent().find('.sj_filter_shop_by_content_category_type').css('display','block');
					checkCategory();
				}else{
					$('.sj_not_chose').css('display','block');
					$('.sj_chose_categories_title input').attr('readonly','true');
					
				}
				if(type == 'color'){
					var val = $(this).parent().parent().find('.sj_filter_shop_by_content_menu_conten_item .sj_content_wrap .sj_finter_input').eq(0).find('input').val();
					$.ajax({
						type: 'POST',
						url: '<?php echo HTTP_CATALOG;?>/index.php?route=module/so_filter_shop_by/get_content_field_color',
						data: {
						val: val,
					},
					success: function (data) {
						$('.sj_filter_list_color_item').html('');
						if(data['html'] == 1){
							$('.sj_filter_list_color_item').html('Not content.');
						}else{
							var array_val = data['html'].split('-----');
							for(var i = 0; i < array_val.length; i++){
								var array = array_val[i].split('--');
								$('.sj_filter_list_color_item').append('<div class="sj_filter_color_item" data-id="'+array[0]+'"><img src="<?php echo HTTP_CATALOG.'image/';?>'+array[1]+'"/></div>');
							}
							$('.sj_filter_text_field_attribute_list_item').eq(i).addClass('sj_filter_field_last');
						}	
					},
						dataType: 'json'
					});
						}
						if(type == 'field_chose' || type == 'filed_radio'){
							var val = $(this).parent().parent().find('.sj_filter_shop_by_content_menu_conten_item .sj_content_wrap .sj_finter_input').eq(0).find('input').val();
							
							if(val != ''){
								var type_field = $(this).find('.sj_finter_input').eq(0).find('.sj_finter_input_chose_type_field').attr('data-type');
								if(type_field == 1){
									$.ajax({
										type: 'POST',
										url: '<?php echo HTTP_CATALOG;?>/index.php?route=module/so_filter_shop_by/get_content_field_default',
										data: {
											string: val,
										},
										success: function (data) {
											$('.sj_filter_text_field_attribute_list').html('');
											if(data['html'] == 1){
												$('.sj_filter_text_field_attribute_list').html('Not content.');
											}else{
												var array_val = data['html'].split('-----');
												for(var i = 0; i < array_val.length; i++){
													$('.sj_filter_text_field_attribute_list').append('<div class="sj_filter_text_field_attribute_list_item">'+array_val[i]+'</div>');
												}
												$('.sj_filter_text_field_attribute_list_item').eq(i).addClass('sj_filter_field_last');
											}	
										},
										dataType: 'json'
									});
								}else{
									var id;
									$('.sj_filter_list_field_atribute .sj_filter_field_atribute_item').each(function(){
										if($(this).html() == val){										
											id = $(this).attr('data-id');
										}
									});
									$.ajax({
										type: 'POST',
										url: '<?php echo HTTP_CATALOG;?>/index.php?route=module/so_filter_shop_by/get_content_field_atribute',
										data: {
											id: id,
										},
										success: function (data) {
											$('.sj_filter_text_field_attribute_list').html('');
											if(data['html'] == 1){
												$('.sj_filter_text_field_attribute_list').html('Not content.');
											}else{
												var array_val = data['html'].split('-----');
												for(var i = 0; i < array_val.length; i++){
													var array_content = array_val[i].split('--');
													$('.sj_filter_text_field_attribute_list').append('<div class="sj_filter_text_field_attribute_list_item" data-id-language="'+array_content[1]+'">'+array_content[0]+'</div>');
									
												}
												$('.sj_filter_text_field_attribute_list_item').eq(i).addClass('sj_filter_field_last');
											}
											var id_language = $('.chose_language .show_languege_chose').attr('data-id');
					
											$('.sj_filter_text_field_attribute_list_item').each(function(){
												var id_language_item = $(this).attr('data-id-language');
												if(id_language_item != id_language){
													$(this).css('display','none');
												}
											})											
										},
										dataType: 'json'
									});
								}
							}	
						}
				$('.sj_filter_shop_by_content_menu_conten_item').slideUp();
				$(this).parent().parent().find('.sj_filter_shop_by_content_menu_conten_item').slideDown();
				index = $(this).parent().parent().index();
		});

		var move_on_tab_y;
		var on_mouse_down = 0;
		var move_on_tab_top;
		var move_on_tab_html;
		
		$('body').on('click','.sj_filter_shop_by_content_menu_conten_item_wrap .sj_action_item .sj_action_item_remove',function(event){
				var type = $(this).parent().parent().attr('data-type');
				
				$(this).parent().parent().parent().remove();
				if(type == 'manufacturer'){
					check_manufacturer();
				}
		})
		$('body').on('mousedown','.sj_filter_shop_by_content_menu_conten_item_wrap .sj_action_item .sj_action_item_move',function(event){
				$('.sj_filter_shop_by_content_menu_conten_item').slideUp();
				move_on_tab_y = event.pageY;
				on_mouse_down = 1;
				var height = parseInt($(this).parent().parent().parent().css('height'));
				height_title_item = height;
				$('.sj_fulll_absolute').css('display','block');
				var index = parseInt($(this).parent().parent().parent().index());
				move_on_tab_html = $(this).parent().parent().parent().html();
				var css_height = height * index ;		
				//alert(css_height);		
				move_on_tab_top = css_height;
				var margin = 10*index + 10;
				move_on_tab_top = css_height + margin;
				//alert(margin);
				//alert(css_height + margin);
				$('.sj_filter_shop_by_content_menu_content').find('.sj_filter_shop_by_content_menu_conten_item_wrap').eq(index).after('<div class="sj_move_on_menu"></div>')
				$('.sj_filter_shop_by_content_menu_content .sj_move_on_menu').css('height',height + 'px');
				$(this).parent().parent().parent().addClass('sj_move_on_menu_absolute');
				$('.sj_filter_shop_by_content_menu_content .sj_move_on_menu_absolute').css('top',(css_height + margin) + 'px');
		});
		
		$('body').mouseup(function(){
				if(on_mouse_down == 1){
					on_mouse_down = 0;
					$('.sj_fulll_absolute').css('display','none');
					$('.sj_filter_shop_by_content_menu_content .sj_move_on_menu').addClass('sj_filter_shop_by_content_menu_conten_item_wrap');
					$('.sj_filter_shop_by_content_menu_content .sj_move_on_menu').html(move_on_tab_html);
					$('.sj_filter_shop_by_content_menu_content .sj_move_on_menu').css('height','auto');
					$('.sj_filter_shop_by_content_menu_content .sj_filter_shop_by_content_menu_conten_item_wrap').removeClass('sj_move_on_menu');
					$('.sj_filter_shop_by_content_menu_content .sj_move_on_menu_absolute').remove();
				}else{
					return;
				}
		});
		
		$('body').mousemove(function(event){
			if(on_mouse_down == 1){
				var move_on_y = event.pageY;
				var css_top =move_on_tab_top + parseInt(move_on_y) - parseInt(move_on_tab_y);
				$('.sj_filter_shop_by_content_menu_content .sj_move_on_menu').remove();
				$('.sj_filter_shop_by_content_menu_content .sj_move_on_menu_absolute').css('top',css_top + 'px');
				var index = parseInt((css_top)/(height_title_item+10));
				if(index < 0){
						
						$('.sj_filter_shop_by_content_menu_content').prepend('<div class="sj_move_on_menu"></div>');
						$('.sj_filter_shop_by_content_menu_content .sj_move_on_menu').css('marginTop','10px');
				}else if(index > (parseInt($('.sj_filter_shop_by_content_menu_content .sj_filter_shop_by_content_menu_conten_item_wrap').length)-1)){
						$('.sj_filter_shop_by_content_menu_content').append('<div class="sj_move_on_menu"></div>');
				}else{
						$('.sj_filter_shop_by_content_menu_content').find('.sj_filter_shop_by_content_menu_conten_item_wrap').eq(index).after('<div class="sj_move_on_menu"></div>')
				}			
				$('.sj_filter_shop_by_content_menu_content .sj_move_on_menu').css('height',height_title_item + 'px');
			}	
		});
		
		$('.sj_filter_shop_by_content_menu_type .sj_item_type_filter .sj_action_type_filter').on('click',function(){
				var type= $(this).parent().attr('data-type');
		});
		
		$('body').on('click','.sj_filter_shop_by_content_menu_title_item .sj_action_item .sj_action_item_edit',function(){
				$(this).parent().parent().find('.sj_title_item p').css('display','none');
				$(this).parent().parent().find('.sj_title_item input').css('display','block');
				$(this).parent().parent().find('.sj_title_item input').focus();
		});
		
		$('body').on('focusout','.sj_filter_shop_by_content_menu_title_item .sj_title_item input',function(){
				var val = $(this).val();
				$(this).parent().parent().find('.sj_title_item p').css('display','block');
				$(this).parent().parent().find('.sj_title_item p').html(val);
				$(this).css('display','none');
		});
	
		var on_move_type = 0;
		var on_move_type_x;
		var on_move_type_y;
		var css_move_type_top;
		var css_move_type_left;
		$('body').on('mousedown','.sj_filter_shop_by_content_menu_type .sj_item_type_filter',function(event){
				var type = $(this).attr('data-type');
				<?php if($field_color == 0 && $build_color == 0){ ?>
					if(type == 'color'){
						alert('Not Field Color');
						return;
					}
				<?php } ?>
				$('.sj_filter_shop_by_content_category_type').css('display','none');
				$('.sj_filter_list_manufacture').css('display','none');
				$('.sj_filter_shop_by_content_menu_conten_item').slideUp();
				index = -1;
				var type = $(this).attr('data-type');
				
				on_move_type = 1;
				var scroll = $(window).scrollTop();
				var offset = $(this).offset();
				var left = offset.left;
				var top = offset.top - scroll;
				on_move_type_x = event.screenX;
				on_move_type_y = event.screenY;
				css_move_type_top = top;
				css_move_type_left = left;
				$('.sj_filter_type_move').css('top',top+'px');
				$('.sj_filter_type_move').css('left',left+'px');
				$('.sj_filter_type_move').css('display','block');
				$('.sj_filter_type_move').css('height',$(this).css('height'));
				$('.sj_filter_type_move').css('width',$(this).css('width'));
				height_title_item = parseInt($(this).css('height'));
				$('.sj_filter_type_move').empty();
				$('.sj_filter_type_move').html(array_html_type[type]);
				move_on_tab_html = array_html_type[type];
		});
		
		$('body').mousemove(function(event){
				if(on_move_type == 1){
					var x = event.screenX;
					var y = event.screenY;
					var top = css_move_type_top + y - on_move_type_y;
					var left = css_move_type_left + x - on_move_type_x;
					$('.sj_filter_type_move').css('top',top+'px');
					$('.sj_filter_type_move').css('left',left+'px');
					$('.sj_filter_shop_by_content_menu_content .sj_move_on_menu').remove();
					var offset = $('.sj_filter_shop_by_content_menu_content').offset();
					var top = offset.top;
					var left = offset.left;
					var y = event.pageY;
					var x = event.pageX;
					var top =  y - top;
					var height = $('.sj_filter_shop_by_content_menu_content').css('height');
					var max_width = left + parseInt($('.sj_filter_shop_by_content_menu_content').css('width'));
					if(top > 0 && top < parseInt(height) && x < max_width && x > left){
						index =  parseInt((top)/(height_title_item + 10));
						if(top < 20 || parseInt($('.sj_filter_shop_by_content_menu_content .sj_filter_shop_by_content_menu_conten_item_wrap').length) == 0){

							$('.sj_filter_shop_by_content_menu_content').prepend('<div class="sj_move_on_menu"></div>');
							$('.sj_filter_shop_by_content_menu_content .sj_move_on_menu').css('marginTop','10px');
						}else if(index > (parseInt($('.sj_filter_shop_by_content_menu_content .sj_filter_shop_by_content_menu_conten_item_wrap').length)-1)){
							$('.sj_filter_shop_by_content_menu_content').append('<div class="sj_move_on_menu"></div>');
			
						}else{
							$('.sj_filter_shop_by_content_menu_content').find('.sj_filter_shop_by_content_menu_conten_item_wrap').eq(index).after('<div class="sj_move_on_menu"></div>');

						}			
						$('.sj_filter_shop_by_content_menu_content .sj_move_on_menu').css('height',height_title_item + 'px');
						
					}else{
						$('.sj_filter_shop_by_content_menu_content .sj_move_on_menu').remove();
					}								
				}
		})
		var on_hover_content = 0;
		var obj_aa;
		$('body').mouseup(function(){
				if(on_move_type == 1){
						on_move_type = 0;
						$('.sj_filter_type_move').css('display','none');
						if($('.sj_filter_shop_by_content_menu_content .sj_move_on_menu').length == 1){						
						
						$('.sj_filter_shop_by_content_menu_content .sj_move_on_menu').addClass('sj_filter_shop_by_content_menu_conten_item_wrap');
						$('.sj_filter_shop_by_content_menu_content .sj_move_on_menu').html(move_on_tab_html);
						$('.sj_filter_shop_by_content_menu_content .sj_move_on_menu').css('height','auto');
						
						$('.sj_move_on_menu').find('.sj_filter_shop_by_content_menu_conten_item').slideDown();
						obj_aa = $('.sj_move_on_menu');
						var type = $('.sj_move_on_menu').find('.sj_filter_shop_by_content_menu_title_item').attr('data-type');
						$('.sj_filter_shop_by_content_menu_conten_item_wrap').find('.sj_filter_shop_by_content_menu_conten_item').removeClass('sj_filter_group_categories');
						if(type == 'manufacturer'){
							$('.sj_move_on_menu').find('.sj_filter_shop_by_content_category_type').css('display','block');
							$('.sj_filter_list_manufacture').css('display','block');
						}
						
	
						if(type == 'categories'){
							$('.sj_not_chose').css('display','none');
							$('.sj_chose_categories_title input').removeAttr('readonly');
							$('.sj_move_on_menu').find('.sj_filter_shop_by_content_menu_conten_item').addClass('sj_filter_group_categories');
							$('.sj_move_on_menu').find('.sj_filter_shop_by_content_category_type').css('display','block');
							checkCategory();
						}else{
							$('.sj_not_chose').css('display','block');
							$('.sj_chose_categories_title input').attr('readonly','true');
						}
						if(parseInt($('.sj_filter_shop_by_content_menu_content .sj_filter_shop_by_content_menu_conten_item_wrap').length) == 0){
							index = 0;
						}else{
							for(var i = 0; i < parseInt($('.sj_filter_shop_by_content_menu_content .sj_filter_shop_by_content_menu_conten_item_wrap').length); i++){
									if($('.sj_filter_shop_by_content_menu_content .sj_filter_shop_by_content_menu_conten_item_wrap').eq(i).hasClass('sj_move_on_menu')){
										index = i;
										break;
									}
							}
						}
						if(type == 'color'){
							var val = $('.sj_move_on_menu').find('.sj_finter_input').eq(0).find('input').val();
							$.ajax({
								type: 'POST',
								url: '<?php echo HTTP_CATALOG;?>/index.php?route=module/so_filter_shop_by/get_content_field_color',
								data: {
									val: val,
								},
								success: function (data) {
									$('.sj_filter_list_color_item').html('');
									if(data['html'] == 1){
										$('.sj_filter_list_color_item').html('Not content.');
									}else{
										var array_val = data['html'].split('-----');
										for(var i = 0; i < array_val.length; i++){
											var array = array_val[i].split('--');
											$('.sj_filter_list_color_item').append('<div class="sj_filter_color_item" data-id="'+array[0]+'"><img src="<?php echo HTTP_CATALOG.'image/';?>'+array[1]+'"/></div>');
										}
										$('.sj_filter_text_field_attribute_list_item').eq(i).addClass('sj_filter_field_last');
									}	
								},
								dataType: 'json'
							});
						}
						move_on = 1;
						$('.sj_filter_shop_by_content_menu_content .sj_filter_shop_by_content_menu_conten_item_wrap').removeClass('sj_move_on_menu');
						}
				}
		})

		$('.sj_filter_search_categories').keyup(function(){
				var low = $(this).val();
				var val = $(this).val();
				$('.sj_item_category').css('display','block');
				if(val == ''){
					for(var i = 0; i < $('.sj_item_category').length; i++){
						var change = $('.sj_item_category').eq(i).find('.sj_move_category_filter').attr('data-html');
						$('.sj_item_category').eq(i).find('.sj_move_category_filter').html(change);
					}
					return;
				}
				val = val.toUpperCase();
				var data;
				for(var i = 0; i < $('.sj_item_category').length; i++){
						data = $('.sj_item_category').eq(i).attr('data-name');
						data = data.toUpperCase();
						if(parseInt(data.indexOf(val)) == -1){
							$('.sj_item_category').eq(i).css('display','none')
						}else{
							var change = $('.sj_item_category').eq(i).find('.sj_move_category_filter').attr('data-html');
							var array_change = change.split('  ');
							var ss = array_change[(array_change.length-1)];

							change = '';
							
							if(array_change.length > 1){							
									for(var b = 0; b < (array_change.length - 1); b++){
										change = change + array_change[b] + '&nbsp;&nbsp;&gt;&nbsp;&nbsp;';
									}
									
							}
							change = change + ss.replace(low,'<span class="sj_search">'+low+'</span>');							
							$('.sj_item_category').eq(i).find('.sj_move_category_filter').html(change);
						}
				}
				
				var array_val = val.split(' ');
				if(array_val.length == 1){
						return;
				}else{
						for(var a = 0; a < array_val.length; a++){
								val = array_val[a];
								for(var e = 0; e < $('.sj_item_category').length; e++){
										data = $('.sj_item_category').eq(e).attr('data-name');
										data = data.toUpperCase();
										if(parseInt(data.indexOf(val)) != -1){
											$('.sj_item_category').eq(e).css('display','block')
										}
								}
						}
				}
				
		});
		
		$('body').on('click','.sj_filter_shop_by_content_menu_conten_item .sj_finter_input_add',function(){
				var parent = $(this).parent();
				var input = '<div class="sj_finter_input bg-success"><div class="sj_wrap_item"><div class="sj_finter_input_name">Value:</div><div class="sj_finter_input_content"><input type="text" value="8gb"></div></div><div class="sj_finter_input_delete"><i class="fa fa-times"></i></div></div>';
				parent.find('.sj_content_wrap').append(input);
				parent.find('.sj_content_wrap .sj_finter_input input').eq(parseInt(parent.find('.sj_content_wrap .sj_finter_input').length) - 1).val('');
		});
		var move_category = 0;
		var move_category_x;
		var move_category_y;
		var move_category_left;
		var move_category_top;
		var move_category_html;
		$('body').on('mousedown','.sj_chose_categories .sj_move_category_filter',function(event){
			if($(this).parent().hasClass('sj_not_action_category_item'))return;
			move_category = 1;
			var scroll = $(window).scrollTop();
			var offset = $(this).offset();
			var left = offset.left;
			var top = offset.top - scroll;
			var id = $(this).parent().attr('data-id');
			move_category_top = top;
			move_category_left = left;
			move_category_x = event.screenX;
			move_category_y = event.screenY;
			var height = $(this).parent().css('height');
			var html = $(this).attr('data-html');
			var width = $(this).parent().css('width');
			$('.sj_filter_type_move_category').css('height',height);
			$('.sj_filter_type_move_category').css('display','block');
			$('.sj_filter_type_move_category').css('width',width);
			$('.sj_filter_type_move_category').css('top',top+'px');
			$('.sj_filter_type_move_category').css('left',left+'px');
			$('.sj_filter_type_move_category').html('<div class="sj_name_category" data-id="'+id+'">'+html+'</div><div class="sj_action_category"><div class="sj_action_category_delete"><i class="fa fa-times"></i></div></div>');			
			move_category_html = $('.sj_filter_type_move_category').html();
		});
		$('body').mousemove(function(event){
			if(move_category == 1){
					var x = event.screenX;
					var y = event.screenY;
					var top = move_category_top + y - move_category_y;
					var left = move_category_left + x - move_category_x;
					$('.sj_filter_type_move_category').css('top',top+'px');
					$('.sj_filter_type_move_category').css('left',left+'px');
					var offset = $('.sj_filter_group_categories').offset();
					var top = offset.top;
					var left = offset.left;
					var y = event.pageY;
					var x = event.pageX;
					var top =  y - top;
					var height = $('.sj_filter_group_categories').css('height');
					var max_width = left + parseInt($('.sj_filter_group_categories').css('width'));
					$('.sj_filter_group_categories .sj_move_on_categories').remove();
	
					if(top > 0 && top < parseInt(height) && x < max_width && x > left){
						var index =  parseInt((top)/(height_title_item + 10));
						if(top < 20 || parseInt($('.sj_filter_group_categories .sj_filter_category_item_wrap').length) == 0){

							$('.sj_filter_group_categories').prepend('<div class="sj_move_on_categories"></div>');

						}else if(index > (parseInt($('.sj_filter_group_categories .sj_filter_category_item_wrap').length)-1)){
							$('.sj_filter_group_categories').append('<div class="sj_move_on_categories"></div>');
			
						}else{
							$('.sj_filter_group_categories').find('.sj_filter_category_item_wrap').eq(index).after('<div class="sj_move_on_categories"></div>');

						}			

						
					}else{
						$('.sj_filter_group_categories .sj_move_on_categories').remove();
					}
			}
		})
		$('body').mouseup(function(){
				if(move_category == 1){
					move_category = 0;
					$('.sj_filter_type_move_category').css('display','none');
					if($('.sj_move_on_categories').length > 0){
						$('.sj_move_on_categories').html(move_category_html);
						$('.sj_move_on_categories').addClass('sj_filter_category_item_wrap');
						$('.sj_move_on_categories').addClass('bg-success');
						$('.sj_move_on_categories').css('height','auto');
						$('.sj_filter_category_item_wrap').removeClass('sj_move_on_categories');
					}
					checkCategory();
				}
		})
		
		$('body').on('click','.sj_filter_category_show_logo',function(){
			$(this).css('background','darkgray');
			var attr = $(this).attr('data-val');
			if(attr == 1){
				$(this).css('background','darkgray');
				$(this).attr('data-val',0);		
				$(this).html('Hide Logo');		
			}else{
				$(this).css('background','darkgoldenrod');
				$(this).attr('data-val',1);	
				$(this).html('Show Logo');		
			}
		});
		
		$('body').on('click','.sj_filter_category_show_radio',function(){
			$(this).css('background','darkgray');
			var attr = $(this).attr('data-val');
			if(attr == 1){
				$(this).css('background','darkgray');
				$(this).attr('data-val',0);		
				$(this).html('Hide Radio');		
			}else{
				$(this).css('background','darkgoldenrod');
				$(this).attr('data-val',1);	
				$(this).html('Show Radio');		
			}
		});
		
		$('body').on('click','.sj_action_category_delete',function(){
				$(this).parent().parent().remove();
				checkCategory();
		});
		function getHtml(){
			var length_wrap = $('.sj_filter_shop_by_content_menu_content .sj_filter_shop_by_content_menu_conten_item_wrap').length;
			for(var i = 0; i < length_wrap; i++){
				var item = $('.sj_filter_shop_by_content_menu_content .sj_filter_shop_by_content_menu_conten_item_wrap').eq(i);
				var type = item.find('.sj_filter_shop_by_content_menu_title_item').attr('data-type');
				if(type == 'field_chose' || type == 'filed_radio'){
					var check = item.find('.sj_content_wrap');
					if(check.find('.sj_finter_input').eq(0).find('input').val() == ''){
						item.addClass('sj_remove');
					}else{
						for(var a = 1; a < check.find('.sj_finter_input').length; a++){
							if(check.find('.sj_finter_input').eq(a).find('input').val() == ''){
								check.find('.sj_finter_input').eq(a).addClass('sj_remove');
							}
						}
					}
				}
				if(type == 'categories'){
					var length = item.find('.sj_filter_shop_by_content_menu_conten_item .sj_filter_category_item_wrap');
					if(length == 0){
						item.addClass('sj_remove');
					}
				}
				if(type == 'manufacturer'){
					var length = item.find('.sj_filter_shop_by_content_menu_conten_item .sj_manufacture_item');
					if(length == 0){
						item.addClass('sj_remove');
					}
				}
			}
			$('.sj_remove').remove();
			for(var i = 0; i < length_wrap; i++){
				var item = $('.sj_filter_shop_by_content_menu_content .sj_filter_shop_by_content_menu_conten_item_wrap').eq(i);
				var type = item.find('.sj_filter_shop_by_content_menu_title_item').attr('data-type');
				if(type == 'field_chose' || type == 'filed_radio'){
					var check = item.find('.sj_content_wrap');
					if(check.find('.sj_finter_input').length == 1){
						item.addClass('sj_remove');
					}
				}
				
			}
			$('.sj_remove').remove();
		}
		$('.sj_filter_submit').click(function(){
			
				var val;
				check_html_submit();
				getHtml();
				$('#action').val($(this).attr('data-action'));
				var length_wrap = $('.sj_filter_shop_by_content_menu_content .sj_filter_shop_by_content_menu_conten_item_wrap').length;
				for(var i = 0; i < length_wrap; i++){
						var element = $('.sj_filter_shop_by_content_menu_content .sj_filter_shop_by_content_menu_conten_item_wrap').eq(i);
						var type = $('.sj_filter_shop_by_content_menu_content .sj_filter_shop_by_content_menu_conten_item_wrap').eq(i).find('.sj_filter_shop_by_content_menu_title_item').attr('data-type');
						if(i == 0){
							val = '';
						}else{
							val = val + "-----";
						}
						val = val + type + '---';
						var name = $('.sj_filter_shop_by_content_menu_content .sj_filter_shop_by_content_menu_conten_item_wrap').eq(i).find('.sj_filter_shop_by_content_menu_title_item .sj_title_item p').html();
						val = val + name;
						if(type == 'categories'){
							var length = element.find('.sj_filter_shop_by_content_menu_conten_item .sj_filter_category_item_wrap').length;
							for(var a = 0; a < length; a++){
									var id = element.find('.sj_filter_shop_by_content_menu_conten_item .sj_filter_category_item_wrap').eq(a).find('.sj_name_category').attr('data-id');
									val = val + '--' + id ;
									var nameE = element.find('.sj_filter_shop_by_content_menu_conten_item .sj_filter_category_item_wrap').eq(a).find('.sj_name_category').html();
									val = val + '-' + nameE ;
							}
							element.find('.sj_filter_shop_by_content_category_type');
							val = val + '---' + element.find('.sj_filter_shop_by_content_category_type .sj_filter_category_show_logo').attr('data-val');
							val = val + '--' + element.find('.sj_filter_shop_by_content_category_type .sj_filter_category_show_radio').attr('data-val');
							continue;
						}
						if(type == 'manufacturer'){
							var length = element.find('.sj_filter_shop_by_content_menu_conten_item .sj_manufacture_item').length;
							for(var a = 0; a < length; a++){
									var id = element.find('.sj_filter_shop_by_content_menu_conten_item .sj_manufacture_item').eq(a).attr('data-id');
									val = val + '--' + id ;
									var name = element.find('.sj_filter_shop_by_content_menu_conten_item .sj_manufacture_item').eq(a).attr('data-name');
									val = val + '-' + name ;
									var img = element.find('.sj_filter_shop_by_content_menu_conten_item .sj_manufacture_item').eq(a).attr('data-image');
									val = val + '-' + img ;
							}
							val = val + '---' + element.find('.sj_filter_shop_by_content_category_type .sj_filter_category_show_logo').attr('data-val');
							val = val + '--' + element.find('.sj_filter_shop_by_content_category_type .sj_filter_category_show_radio').attr('data-val');
							continue;
						}
						if(type == 'color'){
							var input = element.find('.sj_filter_shop_by_content_menu_conten_item .sj_finter_input').eq(0).find('.sj_finter_input_content input').val();
							val = val + '--' + input ;
							var length = element.find('.sj_filter_shop_by_content_menu_conten_item .sj_finter_input_list_color .sj_filter_color_item_content').length;
							for(var a = 0; a < length; a++){
								var id =element.find('.sj_filter_shop_by_content_menu_conten_item .sj_finter_input_list_color .sj_filter_color_item_content').eq(a).find('.sj_color_html').attr('data-id');
								val = val + '--' + id ;
								var name = element.find('.sj_filter_shop_by_content_menu_conten_item .sj_finter_input_list_color .sj_filter_color_item_content').eq(a).find('.sj_color_html img').attr('src');
								val = val + '-' + name ;
							}
							continue;
						}
						
						if(type == "filed_min_max"){
								var length = element.find('.sj_filter_shop_by_content_menu_conten_item .sj_finter_input').length;
								for(var a = 0; a < length; a++){
									var input = element.find('.sj_filter_shop_by_content_menu_conten_item .sj_finter_input').eq(a).find('.sj_finter_input_content input').val();
									val = val + '--' + input ;
								}
								val = val + '---' + element.find('.sj_finter_input_chose_type_field').attr('data-type');
							continue;
						}
						if(type == "search" || type == "reset_all"){
							continue;
						}
						if(type == "field_chose" || type == "filed_radio"){
								var length = element.find('.sj_filter_shop_by_content_menu_conten_item .sj_content_wrap .sj_finter_input').length;
								for(var a = 0; a < length; a++){
									var input = element.find('.sj_filter_shop_by_content_menu_conten_item .sj_content_wrap .sj_finter_input').eq(a).find('.sj_finter_input_content input').val();
									val = val + '--' + input ;
								}
								val = val + '---' + element.find('.sj_finter_input_chose_type_field').attr('data-type');
								continue;
						}
				}

				if(val != undefined){					
					$('.sj_filter_shop_by_database').val(val);
					$('.sj_filter_form').submit();
						
				}else{
					$('.sj_filter_form').submit();
				}
						
		})
		$('body').on('click','.sj_finter_input_delete',function(){
			$(this).parent().remove();
		})
		var check_focus_in_field = 0;
		var obj_focus_in_field;
		var check_focus_in_field_text = 0;
		var obj_focus_in_field_text;
		var check_focus_in_field_default = 0;
		var obj_focus_in_field_default;
		var check_focus_in_field_color = 0;
		var obj_focus_in_field_color;
		$('body').on('focusin','.sj_finter_input input',function(){
			var check_C = $(this).parent().parent().parent().parent().parent().parent().find('.sj_filter_shop_by_content_menu_title_item').attr('data-type');
			var html = $(this).parent().parent().find('.sj_finter_input_name').html();
			if(html == 'Field:' && check_C != 'color'){
				if($(this).parent().parent().parent().find('.sj_finter_input_chose_type_field').attr('data-type') == 0){
					check_focus_in_field = 1;
					$('.sj_filter_list_field_atribute').css('display','block');
					obj_focus_in_field = $(this);
				}else{
					check_focus_in_field_default = 1;
					$('.sj_filter_list_field_default').css('display','block');
					obj_focus_in_field_default = $(this);
				}
			}else if((html == 'Value' || html == 'Value:') && check_C != 'color' ){
				check_focus_in_field_text = 1;
				$('.sj_filter_text_field_attribute_list').css('display','block');
				obj_focus_in_field_text = $(this);
			}else if(check_C == 'color'){
				check_focus_in_field_color = 1;
				obj_focus_in_field_color = $(this);
				$('.sj_filter_list_field_color').css('display','block');
			}
		})
		$('body').on('focusout','.sj_finter_input input',function(){
			var html = $(this).parent().parent().find('.sj_finter_input_name').html();
			if(check_focus_in_field == 1){
				setTimeout(function(){
					check_focus_in_field = 0;
					$('.sj_filter_list_field_atribute').css('display','none');
				},200)
				
			}
			if(check_focus_in_field_text == 1){
				setTimeout(function(){
					check_focus_in_field_text = 0;
					$('.sj_filter_text_field_attribute_list').css('display','none');
				},200)
				
			}
			if(check_focus_in_field_default == 1){
				setTimeout(function(){
					check_focus_in_field_default = 0;
					$('.sj_filter_list_field_default').css('display','none');
				},200)				
			}
			
			if(check_focus_in_field_color == 1){
				setTimeout(function(){
					check_focus_in_field_color = 0;
					$('.sj_filter_list_field_color').css('display','none');
				},200)				
			}
			
		})
		$('body').on('keyup','.sj_finter_input input',function(){
			if(check_focus_in_field_color == 1){
				var val  = $(this).val();
				$('.sj_filter_list_field_color_item').css('display','block');
				$('.sj_filter_list_field_color_item').removeClass('sj_filter_field_last');
				var index = 0;
				if(val != ''){
					val = val.toLowerCase();
					$('.sj_filter_list_field_color_item').each(function(){
						var html = $(this).html().toLowerCase();
						if(html.indexOf(val) == -1){
							index++;
							$(this).css('display','none');
						}
					})
				}
				if(index == 0){
					index = $('.sj_filter_list_field_color_item').length - 1;
				}else{
					index--;
				}
				$('.sj_filter_list_field_color_item').eq(index).addClass('sj_filter_field_last');
			}	
			if(check_focus_in_field == 1){
				var val  = $(this).val();
				$('.sj_filter_field_atribute_item').css('display','block');
				$('.sj_filter_field_atribute_item').removeClass('sj_filter_field_last');
				var index = 0;
				if(val != ''){
					val = val.toLowerCase();
					$('.sj_filter_field_atribute_item').each(function(){
						var html = $(this).html().toLowerCase();
						if(html.indexOf(val) == -1){
							index++;
							$(this).css('display','none');
						}
					})
				}
				if(index == 0){
					index = $('.sj_filter_field_atribute_item').length - 1;
				}else{
					index--;
				}
				$('.sj_filter_field_atribute_item').eq(index).addClass('sj_filter_field_last');
			}
			if(check_focus_in_field_text == 1){
				var val  = $(this).val();
				$('.sj_filter_text_field_attribute_list_item').css('display','block');
				$('.sj_filter_text_field_attribute_list_item').removeClass('sj_filter_field_last');
				var index;
				if(val != ''){
					val = val.toLowerCase();
					$('.sj_filter_text_field_attribute_list_item').each(function(){
						var html = $(this).html().toLowerCase();
						if(html.indexOf(val) == -1){
							index++;
							$(this).css('display','none');
						}
					})
				}
				if(index == 0){
					index = $('.sj_filter_text_field_attribute_list_item').length - 1;
				}else{
					index--;
				}
				$('.sj_filter_text_field_attribute_list_item').eq(index).addClass('sj_filter_field_last');
			}
			if(check_focus_in_field_default == 1){
				var val  = $(this).val();
				$('.sj_filter_field_default_item').css('display','block');
				$('.sj_filter_field_default_item').removeClass('sj_filter_field_last');
				var index;
				if(val != ''){
					val = val.toLowerCase();
					$('.sj_filter_field_default_item').each(function(){
						var html = $(this).html().toLowerCase();
						if(html.indexOf(val) == -1){
							index++;
							$(this).css('display','none');
						}
					})
				}
				if(index == 0){
					index = $('.sj_filter_field_default_item').length - 1;
				}else{
					index--;
				}
				$('.sj_filter_field_default_item').eq(index).addClass('sj_filter_field_last');
			}
		})
		$('body').on('click','.sj_filter_list_field_color_item',function(){
			obj_focus_in_field_color.val($(this).html());
			var val = $(this).html();
			$.ajax({
				type: 'POST',
				url: '<?php echo HTTP_CATALOG;?>/index.php?route=module/so_filter_shop_by/get_content_field_color',
				data: {
					val: val,
				},
				success: function (data) {
					$('.sj_filter_list_color_item').html('');
					if(data['html'] == 1){
						$('.sj_filter_list_color_item').html('Not content.');
					}else{
						var array_val = data['html'].split('-----');
						for(var i = 0; i < array_val.length; i++){
							var array = array_val[i].split('--');
							$('.sj_filter_list_color_item').append('<div class="sj_filter_color_item" data-id="'+array[0]+'"><img src="<?php echo HTTP_CATALOG.'image/';?>'+array[1]+'"/></div>');
						}
						$('.sj_filter_text_field_attribute_list_item').eq(i).addClass('sj_filter_field_last');
					}	
				},
				dataType: 'json'
			});	
		});
		$('.sj_filter_field_atribute_item').click(function(){

			obj_focus_in_field.val($(this).attr('data-val'));
			var id = $(this).attr('data-id');

			$.ajax({
				type: 'POST',
				url: '<?php echo HTTP_CATALOG;?>index.php?route=module/so_filter_shop_by/get_content_field_atribute',
				data: {
					id: id,
				},
				success: function (data) {
					$('.sj_filter_text_field_attribute_list').html('');
					if(data['html'] == 1){
						$('.sj_filter_text_field_attribute_list').html('Not content.');
					}else{
						var array_val = data['html'].split('-----');
						for(var i = 0; i < array_val.length; i++){
							var array_content = array_val[i].split('--');
							$('.sj_filter_text_field_attribute_list').append('<div class="sj_filter_text_field_attribute_list_item" data-id-language="'+array_content[1]+'">'+array_content[0]+'</div>');
						}
						$('.sj_filter_text_field_attribute_list_item').eq(i).addClass('sj_filter_field_last');
					}
					var id_language = $('.chose_language .show_languege_chose').attr('data-id');
					
					$('.sj_filter_text_field_attribute_list_item').each(function(){
						var id_language_item = $(this).attr('data-id-language');
						if(id_language_item != id_language){
							$(this).css('display','none');
						}
					})
				},
				dataType: 'json'
			});	
		});

		$('.sj_filter_field_default_item').click(function(){
			obj_focus_in_field_default.val($(this).attr('data-val'));
			var string = $(this).html();
			$.ajax({
				type: 'POST',
				url: '<?php echo HTTP_CATALOG;?>/index.php?route=module/so_filter_shop_by/get_content_field_default',
				data: {
					string: string,
				},
				success: function (data) {
					$('.sj_filter_text_field_attribute_list').html('');
					if(data['html'] == 1){
						$('.sj_filter_text_field_attribute_list').html('Not content.');
					}else{
						var array_val = data['html'].split('-----');
						var array_check = new Array();
						var k = 0;
						for(var i = 0; i < array_val.length; i++){
							if(array_check.indexOf(array_val[i]) == -1){
								array_check[k] = array_val[i];
								k++;
								$('.sj_filter_text_field_attribute_list').append('<div class="sj_filter_text_field_attribute_list_item">'+array_val[i]+'</div>');
							}
						}
						$('.sj_filter_text_field_attribute_list_item').eq(i).addClass('sj_filter_field_last');
					}	
				},
				dataType: 'json'
			});	
		});
		$('body').on('click','.sj_filter_text_field_attribute_list_item',function(){
			obj_focus_in_field_text.val($(this).html());	
		});
		
		$('body').on('click','.sj_finter_input_chose_type_field',function(){
			var type = $(this).attr('data-type');
			if(type == 0){
				$(this).attr('data-type','1');
				$(this).css('color','#000');
			}else{
				$(this).attr('data-type','0');
				$(this).css('color','red');
			}
		})
		$('.sj_filter_list_manufacture_item').click(function(){
			if($(this).hasClass('sj_filter_list_manufacture_item_not'))return;
			var wrap = obj_aa.find('.sj_filter_shop_by_content_menu_conten_item');
			var name = $(this).html();
			var id = $(this).attr('data-id');
			var img = $(this).attr('data-image');
			wrap.append('<div class="sj_manufacture_item bg-success" data-id="'+id+'" data-image="'+img+'" data-name="'+name+'"><p>'+name+'</p><div class="sj_manufacture_item_delete"><i class="fa fa-times"></i></div></div>');
			check_manufacturer();
		});
		$('body').on('click','.sj_manufacture_item_delete',function(){
			$(this).parent().remove();
			check_manufacturer();
		})
		var click_color = 1;
		var obj_click_color;
		var obj_action_color;
		var show_color = 0;
		$('body').on('click','.sj_finter_input_action_color',function(){
			if(show_color == 0){
				show_color = 1;
				$('.sj_filter_list_color_item').css('display','block');
				$('.sj_filter_list_color_item').addClass('sj_click_color');
				obj_click_color = $(this).parent().parent().find('.sj_finter_input_list_color');
				obj_action_color = $(this);
				obj_action_color.html('<i class="fa fa-arrow-left"></i>');
			}else{	
				show_color = 0;
				$('.sj_filter_list_color_item').css('display','none');
				$('.sj_filter_list_color_item').removeClass('sj_click_color');
				obj_action_color.html('<i class="fa fa-arrow-right"></i>');
			}
			
		});
		var click_item_color = 0 ;
		var check_color;
		$('body').on('click','.sj_filter_color_item',function(){
			var id = $(this).attr('data-id');
			$('.sj_filter_shop_by_content_menu_conten_item_wrap').each(function(){
				var item = $(this);
				var type = item.find('.sj_filter_shop_by_content_menu_title_item').attr('data-type');
				if(type == 'color'){
					for(var i = 0; i < parseInt(item.find('.sj_filter_color_item_content').length); i++){
						var id_c = item.find('.sj_filter_color_item_content').eq(i).find('.sj_color_html').attr('data-id');
						if(id == id_c){
							check_color = 1;
							return;
						}else{
							check_color = 0;
						}
					}
				}
			});
			if(check_color == 1){
				alert('Have Color');
				return;
			}
			var html = $(this).html();
			var id = $(this).attr('data-id');
			obj_click_color.append('<div class="sj_filter_color_item_content"><div class="sj_color_html" data-id="'+id+'">'+html+'</div><div class="sj_action_color"><i class="fa fa-times"></i></div></div>');
			click_item_color = 1;
		})
		
		$('body').click(function(){
				if($('.sj_filter_list_color_item').hasClass('sj_click_color')){
					$('.sj_filter_list_color_item').removeClass('sj_click_color');
					return;
				}else{
					if(click_item_color == 1){
						click_item_color = 0;
						return;
					}else{
						$('.sj_filter_list_color_item').css('display','none');
						if(typeof obj_action_color != 'undefined'){
							obj_action_color.html('<i class="fa fa-arrow-right"></i>');
						}
						
					}
				}
					
		});
		$('body').on('click','.sj_finter_input_list_color',function(){
			click_item_color = 1;
		})
		$('body').on('click','.sj_filter_color_item_content .sj_action_color',function(){
			$(this).parent().remove();
		})
		var chose_languege = 0;
		$('.chose_language').click(function(){
			chose_languege = 1;
			if($(this).hasClass('slideDown')){
				$(this).removeClass('slideDown');	
				$(this).find('.wrap').slideUp();	
			}else{
				$(this).addClass('slideDown');	
				$(this).find('.wrap').slideDown();	
			}			
		});
		$('.language_item').click(function(){
			var id = $(this).attr('data-id');
			$('.sj_filter_shop_by_language').val(id);
			var html = $(this).html();
			$('.chose_language').find('.show_languege').html(html);
			$('.language_item').removeClass('show_languege_chose');
			$(this).addClass('show_languege_chose');
			var id_language = $('.chose_language .show_languege_chose').attr('data-id');
			$('.sj_filter_list_field_atribute .sj_filter_field_atribute_item').css('display','block');
			$('.sj_filter_list_field_atribute .sj_filter_field_atribute_item').each(function(){
				var id_language_item = $(this).attr('data-id-languge');
				if(id_language_item != id_language){
					$(this).css('display','none');
				}
			})
			$('.sj_filter_text_field_attribute_list_item').css('display','block');
			$('.sj_filter_text_field_attribute_list_item').each(function(){
				var id_language_item = $(this).attr('data-id-language');
				if(id_language_item != id_language){
					$(this).css('display','none');
				}
			})
			$('.sj_item_category').css('display','block');
			$('.sj_item_category').each(function(){

				var id_language_item = $(this).attr('data-language_id');
				if(id_language_item != id_language){
					$(this).css('display','none');
				}
			})
		});
		$('body').click(function(){
			if(chose_languege == 1){
				chose_languege == 0;
			}else{
				if($('.chose_language').hasClass('slideDown')){
					$(this).removeClass('slideDown');	
					$(this).find('.wrap').slideUp();	
				}
			}
			
		});
		
		var id_language = $('.chose_language .show_languege_chose').attr('data-id');
		$('.sj_filter_list_field_atribute .sj_filter_field_atribute_item').each(function(){
			var id_language_item = $(this).attr('data-id-languge');
			if(id_language_item != id_language){
				$(this).css('display','none');
			}
		})
		$('.sj_item_category').each(function(){

			var id_language_item = $(this).attr('data-language_id');
			if(id_language_item != id_language){
				$(this).css('display','none');
			}
		})
		function check_manufacturer(){
		$('.sj_filter_list_manufacture .sj_filter_list_manufacture_item').removeClass('sj_filter_list_manufacture_item_not');
		$('.sj_filter_shop_by_content_menu_conten_item_wrap').each(function(){
			
			var item = $(this);
			var type = item.find('.sj_filter_shop_by_content_menu_title_item').attr('data-type');
			if(type == 'manufacturer'){
				
				for(var i = 0; i < parseInt(item.find('.sj_manufacture_item').length); i++){
					var id_m = item.find('.sj_manufacture_item').eq(i).attr('data-id');
					for(var a = 0; a < $('.sj_filter_list_manufacture .sj_filter_list_manufacture_item').length; a++){
						if(id_m == $('.sj_filter_list_manufacture .sj_filter_list_manufacture_item').eq(a).attr('data-id') ){	
							$('.sj_filter_list_manufacture .sj_filter_list_manufacture_item').eq(a).addClass('sj_filter_list_manufacture_item_not');
						}
					}
				}
			}
		});
		}
		check_manufacturer();
		function check_html_submit(){
			$('.sj_filter_shop_by_content_menu_content .sj_filter_shop_by_content_menu_conten_item_wrap').each(function(){
				var type = $(this).find('.sj_filter_shop_by_content_menu_title_item').attr('data-type');
				if(type == 'field_chose' || type == 'filed_radio'){
					for(var i = 0; i < $(this).find('.sj_filter_shop_by_content_menu_conten_item .sj_finter_input').length; i++){
						var item = $(this).find('.sj_filter_shop_by_content_menu_conten_item .sj_finter_input').eq(i);
						if(i == 0){
							var val = item.find('.sj_finter_input_content input').val();
							if(val == ''){
								item.parent().parent().parent().addClass('filter_remove');
							}
						}else{
							var val = item.find('.sj_finter_input_content input').val();
							if(val == ''){
								item.addClass('filter_remove');
							}
						}
					}
				}
				if(type == 'filed_min_max' ){
					for(var i = 0; i < $(this).find('.sj_filter_shop_by_content_menu_conten_item .sj_finter_input').length; i++){
						var item = $(this).find('.sj_filter_shop_by_content_menu_conten_item .sj_finter_input').eq(i);
						var val = item.find('.sj_finter_input_content input').val();
						if(val == ''){
							item.parent().parent().parent().addClass('filter_remove');
						}
					}
					var max = $(this).find('.sj_filter_shop_by_content_menu_conten_item .sj_finter_input').eq(1).find('.sj_finter_input_content input').val();
					var min = $(this).find('.sj_filter_shop_by_content_menu_conten_item .sj_finter_input').eq(2).find('.sj_finter_input_content input').val();
					
					if(parseInt(min) > parseInt(max)){
						$(this).find('.sj_filter_shop_by_content_menu_conten_item .sj_finter_input').eq(1).find('.sj_finter_input_content input').val(min);
						$(this).find('.sj_filter_shop_by_content_menu_conten_item .sj_finter_input').eq(2).find('.sj_finter_input_content input').val(max);
					}
				}
			})
			$('.filter_remove').remove();
		}
		$('body').on('mouseenter','.sj_finter_input_chose_type_field',function(){
			$(this).append('<div class="so_filter_tooltip"><div class="so_relative">Chose Filed Atribute Or Field Default</div></div>');
		})
		
		$('body').on('mouseleave','.sj_finter_input_chose_type_field',function(){
			$(this).find('.so_filter_tooltip').remove();
		})
		$('body').on('mouseenter','.sj_finter_input_action_color',function(){
			$(this).append('<div class="so_filter_tooltip"><div class="so_relative">Chose Value Color</div></div>');
		})
		
		$('body').on('mouseleave','.sj_finter_input_action_color',function(){
			$(this).find('.so_filter_tooltip').remove();
		})
		
	})
</script>
<script type="text/javascript"><!--

	$('#language').change(function(){
		var that = $(this), opt_select = $('option:selected', that).val() , _input = $('#input-head-name-'+opt_select);
		$('[id^="input-head-name-"]').addClass('hide');
		_input.removeClass('hide');
	});

	$('.first-name').change(function(){
		$('input[name="head_name"]').val($(this).val());
	});
//--></script>