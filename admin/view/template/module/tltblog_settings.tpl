<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-html" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
	<div class="alert alert-info">
    		<i class="fa fa-info-circle"></i>&nbsp;<?php echo $text_donation; ?><br />
  			<?php echo $text_copyright; ?>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-html" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-path"><span data-toggle="tooltip" title="<?php echo $help_path; ?>"><?php echo $entry_path; ?></label>
            <div class="col-sm-10">
              <input type="text" name="tltblog_path" value="<?php echo $tltblog_path; ?>" placeholder="<?php echo $entry_path; ?>" id="input-path" class="form-control" />
              <?php if ($error_path) { ?>
              <div class="text-danger"><?php echo $error_path; ?></div>
              <?php } ?>
            </div>
          </div>         
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-show-path"><span data-toggle="tooltip" title="<?php echo $help_show_path; ?>"><?php echo $entry_show_path; ?></label>
            <div class="col-sm-10">
              <select name="tltblog_show_path" id="input-show-path" class="form-control">
              	<?php if ($tltblog_show_path) { ?>
                	<option value="1" selected="selected"><?php echo $text_yes; ?></option>
                	<option value="0"><?php echo $text_no; ?></option>
               	<?php } else { ?>
                	<option value="1"><?php echo $text_yes; ?></option>
                	<option value="0" selected="selected"><?php echo $text_no; ?></option>
              	<?php } ?>
			  </select>
            </div>
          </div>
		  <?php foreach ($languages as $language) { ?>		
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-path<?php echo $language['language_id']; ?>"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" />&nbsp;<span data-toggle="tooltip" title="<?php echo $help_path_title; ?>"><?php echo $entry_path_title; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="tltblog_path_title[<?php echo $language['language_id']; ?>][path_title]" value="<?php echo isset($tltblog_path_title[$language['language_id']]['path_title']) ? $tltblog_path_title[$language['language_id']]['path_title'] : ''; ?>" placeholder="<?php echo $entry_path_title; ?>" id="input-path<?php echo $language['language_id']; ?>" class="form-control" />
                 <?php if (isset($error_path_title[$language['language_id']])) { ?>
                 <div class="text-danger"><?php echo $error_path_title[$language['language_id']]; ?></div>
                 <?php } ?>
                </div>
              </div> 
          <?php } ?>        
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-num-columns"><span data-toggle="tooltip" title="<?php echo $help_num_columns; ?>"><?php echo $entry_num_columns; ?></label>
            <div class="col-sm-10">
              <select name="tltblog_num_columns" id="input-num-columns" class="form-control">
                <?php if ($tltblog_num_columns == 1) { ?>
                <option value="1" selected="selected">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <?php } elseif ($tltblog_num_columns == 2) { ?>
                <option value="1">1</option>
                <option value="2" selected="selected">2</option>
                <option value="3">3</option>
                <?php } else { ?>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3" selected="selected">3</option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-show-image"><span data-toggle="tooltip" title="<?php echo $help_show_image; ?>"><?php echo $entry_show_image; ?></label>
            <div class="col-sm-10">
              <select name="tltblog_show_image" id="input-show-image" class="form-control">
              	<?php if ($tltblog_show_image) { ?>
                	<option value="1" selected="selected"><?php echo $text_yes; ?></option>
                	<option value="0"><?php echo $text_no; ?></option>
               	<?php } else { ?>
                	<option value="1"><?php echo $text_yes; ?></option>
                	<option value="0" selected="selected"><?php echo $text_no; ?></option>
              	<?php } ?>
			  </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-width"><?php echo $entry_width; ?></label>
            <div class="col-sm-10">
              <input type="text" name="tltblog_width" value="<?php echo $tltblog_width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-width" class="form-control" />
              <?php if ($error_width) { ?>
              <div class="text-danger"><?php echo $error_width; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-height"><?php echo $entry_height; ?></label>
            <div class="col-sm-10">
              <input type="text" name="tltblog_height" value="<?php echo $tltblog_height; ?>" placeholder="<?php echo $entry_height; ?>" id="input-height" class="form-control" />
              <?php if ($error_height) { ?>
              <div class="text-danger"><?php echo $error_height; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-seo"><span data-toggle="tooltip" title="<?php echo $help_seo; ?>"><?php echo $entry_seo; ?></label>
            <div class="col-sm-10">
              <select name="tltblog_seo" id="input-status" class="form-control">
                <?php if ($tltblog_seo) { ?>
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
            <label class="col-sm-2 control-label" for="input-status"><span data-toggle="tooltip" title="<?php echo $help_status; ?>"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="tltblog_status" id="input-status" class="form-control">
                <?php if ($tltblog_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php echo $footer; ?>