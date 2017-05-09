<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button onclick="$('#form').submit();" type="submit" form="form-cmsblock" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo 'Edit Form'; ?></h3>
      </div>
      <div class="panel-body">
		  <div class="tab-content">
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_type; ?></label>
					<div class="col-sm-10">
						<select name="type" class="form-control">
							<?php if ($type) { ?>
							<option value="1" selected="selected"><?php echo $text_description; ?></option>
							<option value="0"><?php echo $text_link; ?></option>
							<?php } else { ?>
							<option value="1"><?php echo $text_description; ?></option>
							<option value="0" selected="selected"><?php echo $text_link; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_identify; ?></label>
					<div class="col-sm-10">
						<input type="text" name="identify" value="<?php echo $identify; ?>" class="form-control" />
					</div>
				</div>

				<div class="form-group entry_link">
					<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_link; ?></label>
					<div class="col-sm-10">
						<input type="text" name="link" value="<?php echo $link; ?>" class="form-control" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
					<div class="col-sm-10">
						<select name="status" class="form-control">
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

				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_sort_order; ?></label>
					<div class="col-sm-10">
						<input type="text" name="sort_order" value="<?php echo $sort_order; ?>" class="form-control" />
					</div>
				</div>

				<?php
				foreach ($languages as $language) {
				   if(isset($cmsblock_description[$language['language_id']]['banner_store'])) {
					 $banner_store = explode(',',$cmsblock_description[$language['language_id']]['banner_store']);
				   } else {
					 $banner_store  = array(0);
				   }
				}
				?>

				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo $entry_store; ?></label>
					<div class="col-sm-10">
						<div class="well well-sm" style="height: 150px; overflow: auto;">
							<?php foreach ($stores as $store) {  ?>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="banner_store[]" value="<?php echo $store['store_id']; ?>" <?php if(in_array($store['store_id'],$banner_store)) echo 'checked="checked"';  ?>  />
									<?php echo $store['name']; ?>
								</label>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>

				<div class="tab-pane active" id="tab-general">
				   <ul class="nav nav-tabs" id="languages">
					<?php foreach ($languages as $language) { ?>
					   <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
					<?php } ?>
				  </ul>

				  <div class ="tab-content">
					 <?php foreach ($languages as $language) { ?>
						<div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_title; ?></label>
								<div class="col-sm-10">
									<input  class="form-control" type="text" name="cmsblock_description[<?php echo $language['language_id']; ?>][title]" size="100" value="<?php echo 	isset($cmsblock_description[$language['language_id']]) ? $cmsblock_description[$language['language_id']]['title'] : ''; ?>" />
									  <?php if (isset($error_title[$language['language_id']])) { ?>
									  <span class="error"><?php echo $error_title[$language['language_id']]; ?></span>
									  <?php } ?>
								</div>
							</div>

						   	<div class="form-group entry_des">
								<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_description; ?></label>
								<div class="col-sm-10">
									<textarea class="form-control" name="cmsblock_description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>">
										<?php echo isset($cmsblock_description[$language['language_id']]) ? $cmsblock_description[$language['language_id']]['description'] : ''; ?>
									</textarea>
									<?php if (isset($error_description[$language['language_id']])) { ?>
										<span class="error"><?php echo $error_description[$language['language_id']]; ?></span>
									<?php } ?>
								</div>
						   	</div>
					  	</div>
					 <?php } ?>
				  </div>
				</div>
			</form>
		  </div>
      </div>
    </div>
  </div>
	<script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
	<link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
	<script type="text/javascript" src="view/javascript/summernote/opencart.js"></script>

  <script type="text/javascript"><!--
	<?php foreach ($languages as $language) { ?>
		$('#description<?php echo $language['language_id']; ?>').summernote({
		height: 300
	});
	<?php } ?>
//--></script>
	
<script type="text/javascript"><!--
	<?php
		foreach ($languages as $language) { ?>
			$('#languages li:first-child a').tab('show');
		<?php }
	?>

	var type_cur = "<?php echo $type ; ?>";
		if(type_cur == 0) {
			$('.entry_des').hide();
			$('.entry_link').show();
		} else {
			$('.entry_link').hide();
			$('.entry_des').show();
		}
	$('select[name="type"]').bind('change', function() {
		var type = $(this).val();
		if(type == 0) {
			$('.entry_des').hide();
			$('.entry_link').show();
		} else {
			$('.entry_link').hide();
			$('.entry_des').show();
		}
	});
//--></script> 
<?php echo $footer; ?>