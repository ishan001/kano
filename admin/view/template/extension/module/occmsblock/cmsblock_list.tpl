<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $insert; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-cmsblock').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
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
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
         <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-cmsblock">
			<div class="table-responsive">
			<table class="table table-bordered table-hover">
			  <thead>
				<tr>
				  <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
				  <td class="left"><?php echo $column_title; ?></td>
				  <td class="left"><?php echo $column_status; ?></td>
				  <td class="right"><?php echo $column_action; ?></td>
				</tr>
			  </thead>
			  <tbody>
				<?php if ($cmsblocks) { ?>
				<?php foreach ($cmsblocks as $cmsblock) { ?>
				<tr>
				  <td style="text-align: center;"><?php if ($cmsblock['selected']) { ?>
					<input type="checkbox" name="selected[]" value="<?php echo $cmsblock['cmsblock_id']; ?>" checked="checked" />
					<?php } else { ?>
					<input type="checkbox" name="selected[]" value="<?php echo $cmsblock['cmsblock_id']; ?>" />
					<?php } ?></td>
				  <td class="left"><?php echo $cmsblock['title']; ?></td>
				  <td class="left"><?php echo $cmsblock['status']; ?></td>
				  <td class="right"><?php foreach ($cmsblock['action'] as $action) { ?>
					 <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> 
					<?php } ?></td>
				</tr>
				<?php } ?>
				<?php } else { ?>
				<tr>
				  <td class="center" colspan="4"><?php echo $text_no_results; ?></td>
				</tr>
				<?php } ?>
			  </tbody>
			</table>
			</div>
		  </form>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>