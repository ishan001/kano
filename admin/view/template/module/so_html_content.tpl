<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<button type="submit" form="form-featured" data-toggle="tooltip" title="<?php echo $objlang->get('entry_button_save'); ?>" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $objlang->get('entry_button_save')?></button>
				<a class="btn btn-success" onclick="$('#action').val('save_edit');$('#form-featured').submit();" data-toggle="tooltip" title="<?php echo $objlang->get('entry_button_save_and_edit'); ?>" ><i class="fa fa-pencil-square-o"></i> <?php echo $objlang->get('entry_button_save_and_edit')?></a>
				<a class="btn btn-info" onclick="$('#action').val('save_new');$('#form-featured').submit();" data-toggle="tooltip" title="<?php echo $objlang->get('entry_button_save_and_new'); ?>" ><i class="fa fa-book"></i>  <?php echo $objlang->get('entry_button_save_and_new')?></a>
				<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $objlang->get('entry_button_cancel'); ?>" class="btn btn-danger"><i class="fa fa-reply"></i>  <?php echo $objlang->get('entry_button_cancel')?></a>
			</div> <!--/.pull-right-->
			<h1><?php echo $objlang->get('heading_title_so'); ?></h1>
			<ul class="breadcrumb">
				<?php foreach ($breadcrumbs as $breadcrumb) { ?>
				<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
				<?php } ?>
			</ul>
		</div> <!--/.container-fluid-->
	</div> <!--/.page-header-->
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
		<div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $text_layout; ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
		<?php } ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $subheading; ?></h3>
			</div> <!--/.panel-heading-->
			<div class="panel-body">
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-featured" class="form-horizontal">
					<!-- Nav tabs -->
					<div class="row">
						<ul class="nav nav-tabs" role="tablist">
							<li <?php if( $selectedid ==0 ) { ?>class="active" <?php } ?>> <a href="<?php echo $link; ?>"> <span class="fa fa-plus"></span> <?php echo $objlang->get('button_add_module');?></a></li>
							<?php $i=1; foreach( $moduletabs as $key => $module ){ ?>
							<li role="presentation" <?php if( $module['module_id']==$selectedid ) { ?>class="active"<?php } ?>>
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
							<?php if( $selectedid ){ ?>
							<div class="pull-right">
								<a href="<?php echo $action;?>&delete=1" class="remove btn btn-danger" ><span><i class="fa fa-remove"></i> <?php echo $objlang->get('entry_button_delete');?></span></a>
							</div>
							<?php } ?>
							<div  id="tab-module<?php echo $module_row; ?>" class="col-sm-12">
								<div class="form-group">
									<input type="hidden" name="action" id="action" value=""/>
									<label class="col-sm-2 control-label" for="input-name"><?php echo $objlang->get('entry_name'); ?></label>
									<div class="col-sm-10">
									  <input type="text" name="name" value="<?php echo $module['name']; ?>" placeholder="<?php echo $objlang->get('entry_name'); ?>" id="input-name" class="form-control" />
									  <?php if (isset($error['name'])) { ?>
									  <div class="text-danger"><?php echo $error['name']; ?></div>
									  <?php } ?>
									</div>
								</div> <!--/.form-group-->     
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-status"><?php echo $objlang->get('entry_status'); ?></label>
									<div class="col-sm-10">
									  <select name="status" id="input-status" class="form-control">
										<?php if ($module['status']) { ?>
										<option value="1" selected="selected"><?php echo $objlang->get('text_enabled'); ?></option>
										<option value="0"><?php echo $objlang->get('text_disabled'); ?></option>
										<?php } else { ?>
										<option value="1"><?php echo $objlang->get('text_enabled'); ?></option>
										<option value="0" selected="selected"><?php echo $objlang->get('text_disabled'); ?></option>
										<?php } ?>
									  </select>
									</div>
								  </div>
								  
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-name"><?php echo $objlang->get('entry_suffix'); ?></label>
										<div class="col-sm-10">
										  <input type="text" name="class_suffix" value="<?php echo $module['class_suffix']; ?>" placeholder="" id="input-name" class="form-control" />
										  
										</div>
									</div>
									
								  <div class="tab-pane">
									<ul class="nav nav-tabs" id="language">
									  <?php foreach ($languages as $language) { ?>
									  <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab">
										<?php // Check Version
										if(version_compare(VERSION, '2.1.0.2', '>')) {
										?>
											<img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?>
										<?php } else { ?>
											<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?>
										<?php }?>
											</a>
										</li>
									  <?php } ?>
									</ul>
									<div class="tab-content">
									  <?php foreach ($languages as $language) {?>
									  <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
										<div class="form-group">
										  <label class="col-sm-2 control-label" for="input-title<?php echo $language['language_id']; ?>"><?php echo $objlang->get('entry_title'); ?></label>
										  <div class="col-sm-10">
											<input type="text" name="module_description[<?php echo $language['language_id']; ?>][title]" placeholder="<?php echo $objlang->get('entry_title'); ?>" id="input-heading<?php echo $language['language_id']; ?>" value="<?php echo isset($module_description[$language['language_id']]['title']) ? $module_description[$language['language_id']]['title'] : ''; ?>" class="form-control" />
										  </div>
										</div>
										<div class="form-group">
										  <label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $objlang->get('entry_description'); ?></label>
										  <div class="col-sm-10">
											<textarea name="module_description[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $objlang->get('entry_description'); ?>" id="input-description<?php echo $language['language_id']; ?>" class="form-control summernote"><?php echo isset($module_description[$language['language_id']]['description']) ? $module_description[$language['language_id']]['description'] : ''; ?></textarea>
										  </div>
										</div>
									  </div>
									  <?php } ?>
									</div>
								  </div>
							</div>
								<?php $module_row++; ?>
							<?php } ?>
						</div>
					</div>
				</form>
			</div> <!--/.panel-body-->
        </div> <!--/.panel panel-default-->
    </div>	<!--/.container-fluid-->
	<?php // Check Version
	if(version_compare(VERSION, '2.2.0.0', '<')) {
	?>
		<script type="text/javascript"><!--
		<?php foreach ($languages as $language) { ?>
		$('#input-description<?php echo $language['language_id']; ?>').summernote({height: 300});
		<?php } ?>
	//--></script> 
	<?php }?>
	<script type="text/javascript"><!--
		$('#language a:first').tab('show');
	//--></script>
</div> <!--#content-->
<?php echo $footer; ?>