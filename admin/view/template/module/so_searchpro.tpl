<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
		<div class="pull-right">
			<button type="submit" form="form-sosearchpro" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $button_save; ?></button>
			<a class="btn btn-success" onclick="$('#action').val('save_edit');$('#form-sosearchpro').submit();" data-toggle="tooltip" title="<?php echo $button_save_and_edit; ?>" ><i class="fa fa-pencil-square-o"></i> <?php echo $button_save_and_edit; ?></a>
			<a class="btn btn-info" onclick="$('#action').val('save_new');$('#form-sosearchpro').submit();" data-toggle="tooltip" title="<?php echo $button_save_and_new; ?>" ><i class="fa fa-book"></i>  <?php echo $button_save_and_new; ?></a>
			<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-danger"><i class="fa fa-reply"></i><?php echo $button_cancel; ?></a>
		</div>
      <h1><?php echo $heading_title_so; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-sosearchpro" class="form-horizontal">
							<!-- Nav tabs -->
			<div class="row">
			  <ul class="nav nav-tabs" role="tablist">
				<li <?php if( $moduleid ==0 ) { ?>class="active" <?php } ?>> <a href="<?php echo $link; ?>"> <span class="fa fa-plus"></span> <?php echo $entry_button_add; ?></a></li>
				<?php $i=1; foreach( $moduletabs as $key => $module ){ ?>
				<li role="presentation" <?php if( $module['module_id']==$moduleid ) {?>class="active"<?php } ?>>
				  <a href="<?php echo $link; ?>&module_id=<?php echo $module['module_id']?>" aria-controls="bannermodule-<?php echo $key; ?>"  >
					<span class="fa fa-pencil"></span> <?php echo $module['name']?>
				   </a>
				  </li>
				<?php $i++ ;} ?>
			  </ul>
			</div>
			<div class="row">
					<div class="col-sm-12">
						<?php $module_row = 1; ?>
						<?php foreach ($modules as $module) { ?>
						<?php if( $moduleid ){ ?>
							<div class="pull-right">
								<a href="<?php echo $action;?>&delete=1" class="remove btn btn-danger" ><span><i class="fa fa-remove"></i> <?php echo $entry_button_delete; ?></span></a>
							</div>
						<?php } ?>
						<div  id="tab-module<?php echo $module_row; ?>" class="col-sm-12">	  
		<div class="form-group">
			<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?> <b style="color:#f00">*</b></label>
			<div class="col-sm-10">
				<div class="col-sm-5">
					<input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
				</div>
				<?php if ($error_name) { ?>
				<div class="text-danger col-sm-12"><?php echo $error_name; ?></div>
				<?php }else{ ?>
				<i class="col-sm-12" style="font-weight:normal; color:#ccc"><?php echo $entry_name_desc ?></i>
				<?php } ?>
			</div>
		</div>
		<div class="form-group">
			<input type="hidden" name="action" id="action" value=""/>
			<input type="hidden" name="moduleid" value="<?php echo isset($_GET['module_id']) && !empty($_GET['module_id']) ? $_GET['module_id'] : $moduleid; ?>" />
			<label class="col-sm-2 control-label" for="input-head_name"><?php echo $entry_head_name; ?> <b style="color:#f00">*</b></label>
				<div class="col-sm-10">
					<div class="col-sm-5">
						<?php 
						$i = 0;
						foreach ($languages as $language) { $i++; ?>
							 <input type="text" name="module_description[<?php echo $language['language_id']; ?>][head_name]" placeholder="<?php echo $entry_head_name; ?>" id="input-head-name-<?php echo $language['language_id']; ?>" value="<?php echo isset($module_description[$language['language_id']]['head_name']) ? $module_description[$language['language_id']]['head_name'] : ''; ?>" class="form-control <?php echo ($i>1) ? ' hide ' : ' first-name'; ?>" />
							 <?php
							 if($i == 1){ ?> 
								<input type="hidden" class="form-control" id="input-head_name" placeholder="Module Head Name" value="<?php echo isset($module_description[$language['language_id']]['head_name']) ? $module_description[$language['language_id']]['head_name'] : ''; ?>" name="head_name">
							 <?php }
							 ?>
						<?php } ?>
					</div>
					<div class="col-sm-2">
						<select  class="form-control" id="language">
						 <?php foreach ($languages as $language) { ?>
							<option value="<?php echo $language['language_id']; ?>">
							<?php echo $language['name']; ?></option>
						<?php } ?>
						</select>
					</div>
					<?php if ($error_head_name) { ?>
						<div class="text-danger col-sm-12"><?php echo $error_head_name; ?></div>
					<?php }else { ?>
						<i class="col-sm-12" style="font-weight:normal; color:#ccc"><?php echo $entry_head_name_desc ?></i>
					<?php } ?>
					
				</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="input-disp_title_module"><?php echo $entry_display_title_module; ?></label>
			<div class="col-sm-10">
				<div class="col-sm-5">
					<select name="disp_title_module" id="input-disp_title_module" class="form-control">
						<?php 
						if ($disp_title_module) { ?>
						<option value="1" selected="selected"><?php echo $text_yes; ?></option>
						<option value="0"><?php echo $text_no; ?></option>
						<?php } else { ?>
						<option value="1"><?php echo $text_yes; ?></option>
						<option value="0" selected="selected"><?php echo $text_no; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="input-class"><?php echo $entry_class; ?></label>
			<div class="col-sm-10">
				<div class="col-sm-5">
				  <input type="text" name="class" value="<?php echo $class; ?>" placeholder="<?php echo $entry_class; ?>" id="input-class" class="form-control" />
				  <?php if ($error_class) { ?>
				  <div class="text-danger"><?php echo $error_class; ?></div>
				  <?php } ?>
				</div>
			</div>
		</div>		

		<div class="form-group">
		<label class="col-sm-2 control-label" for="input-width"><?php echo $entry_width; ?> <b style="color:#f00">*</b></label>
		<div class="col-sm-10">
			<div class="col-sm-5">
			  <input type="text" name="width" value="<?php echo $width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-width" class="form-control" />
			  <?php if ($error_width) { ?>
			  <div class="text-danger"><?php echo $error_width; ?></div>
			  <?php } ?>
			</div>
		</div>
		</div>

		<div class="form-group">
		<label class="col-sm-2 control-label" for="input-height"><?php echo $entry_height; ?> <b style="color:#f00">*</b></label>
		<div class="col-sm-10">
			<div class="col-sm-5">
			  <input type="text" name="height" value="<?php echo $height; ?>" placeholder="<?php echo $entry_height; ?>" id="input-height" class="form-control" />
			  <?php if ($error_height) { ?>
			  <div class="text-danger"><?php echo $error_height; ?></div>
			  <?php } ?>
			</div>
		</div>
		</div>			
		
		<div class="form-group">
		<label class="col-sm-2 control-label" for="input-limit"><?php echo $entry_limit; ?> <b style="color:#f00">*</b></label>
		<div class="col-sm-10">
			<div class="col-sm-5">
			  <input type="text" name="limit" value="<?php echo $limit; ?>" placeholder="<?php echo $entry_limit; ?>" id="input-limit" class="form-control" />
			  <?php if ($error_limit) { ?>
			  <div class="text-danger"><?php echo $error_limit; ?></div>
			  <?php } ?>
			</div>  
		</div>
		</div>	
		
		<div class="form-group">
		<label class="col-sm-2 control-label" for="input-character"><?php echo $entry_character; ?> <b style="color:#f00">*</b></label>
		<div class="col-sm-10">
			<div class="col-sm-5">
			  <input type="text" name="character" value="<?php echo $character; ?>" placeholder="<?php echo $entry_character; ?>" id="input-character" class="form-control" />
			  <?php if ($error_character) { ?>
			  <div class="text-danger"><?php echo $error_character; ?></div>
			  <?php } ?>
			</div>  
		</div>
		</div>				
		
		<div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_showcategory; ?></label>
            <div class="col-sm-10">
				<div class="col-sm-5">
				  <select name="showcategory" id="input-status" class="form-control">
					<?php if ($showcategory) { ?>
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
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_showimage; ?></label>
            <div class="col-sm-10">
				<div class="col-sm-5">
				  <select name="showimage" id="input-status" class="form-control">
					<?php if ($showimage) { ?>
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
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_showprice; ?></label>
            <div class="col-sm-10">
				<div class="col-sm-5">
				  <select name="showprice" id="input-status" class="form-control">
					<?php if ($showprice) { ?>
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
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
				<div class="col-sm-5">
				  <select name="status" id="input-status" class="form-control">
					<?php if ($status) { ?>
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
		  </div>
		</div>
	  </div>		  
        </form>
      </div>
	  <?php } ?>
    </div>
  </div>
</div>

<script type="text/javascript">
	$('.first-name').change(function(){
		$('input[name="head_name"]').val($(this).val());
	});
	
	$('#language').change(function(){
		var that = $(this), opt_select = $('option:selected', that).val() , _input = $('#input-head-name-'+opt_select);
		$('[id^="input-head-name-"]').addClass('hide');
		_input.removeClass('hide');
	});
	
</script>
<?php echo $footer; ?>
