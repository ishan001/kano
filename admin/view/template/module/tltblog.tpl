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
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>         
          <?php foreach ($languages as $language) { ?>
          	<div class="form-group required">
            	<label class="col-sm-2 control-label" for="input-title<?php echo $language['language_id']; ?>"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" />&nbsp;<?php echo $entry_title; ?></label>
              	<div class="col-sm-10">
                	<input type="text" name="module_description[<?php echo $language['language_id']; ?>][title]" placeholder="<?php echo $entry_title; ?>" id="input-heading<?php echo $language['language_id']; ?>" value="<?php echo isset($module_description[$language['language_id']]['title']) ? $module_description[$language['language_id']]['title'] : ''; ?>" class="form-control" />
                     <?php if (isset($error_title[$language['language_id']])) { ?>
                     <div class="text-danger"><?php echo $error_title[$language['language_id']]; ?></div>
                     <?php } ?>
               	</div>
           	</div>
          <?php } ?>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-show-title"><?php echo $entry_show_title; ?></label>
            <div class="col-sm-10">
              <select name="show_title" id="input-show-title" class="form-control">
              	<?php if ($show_title) { ?>
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
            <label class="col-sm-2 control-label" for="input-show-blogs"><span data-toggle="tooltip" title="<?php echo $help_show_blogs; ?>"><?php echo $entry_show_blogs; ?></label>
            <div class="col-sm-10">
              <select name="show_blogs" id="input-show-blogs" class="form-control">
              	<?php if ($show_blogs) { ?>
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
            <label class="col-sm-2 control-label" for="input-num-columns"><?php echo $entry_num_columns; ?></label>
            <div class="col-sm-10">
              <select name="num_columns" id="input-num-columns" class="form-control">
                <?php if ($num_columns == 1) { ?>
                <option value="1" selected="selected">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <?php } elseif ($num_columns == 2) { ?>
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
            <label class="col-sm-2 control-label" for="input-limit"><span data-toggle="tooltip" title="<?php echo $help_limit; ?>"><?php echo $entry_limit; ?></label>
            <div class="col-sm-10">
              <input type="text" name="limit" value="<?php echo $limit; ?>" placeholder="<?php echo $entry_limit; ?>" id="input-limit" class="form-control" />
              <?php if ($error_limit) { ?>
              <div class="text-danger"><?php echo $error_limit; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort"><span data-toggle="tooltip" title="<?php echo $help_sort; ?>"><?php echo $entry_sort; ?></label>
            <div class="col-sm-10">
              <select name="sort" id="input-sort" class="form-control">
                <?php if ($sort == "sortorder") { ?>
                <option value="sortorder" selected="selected"><?php echo $text_sortorder; ?></option>
                <option value="random"><?php echo $text_random; ?></option>
                <?php } else { ?>
                <option value="sortorder"><?php echo $text_sortorder; ?></option>
                <option value="random" selected="selected"><?php echo $text_random; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-show-image"><?php echo $entry_show_image; ?></label>
            <div class="col-sm-10">
              <select name="show_image" id="input-show-image" class="form-control">
              	<?php if ($show_image) { ?>
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
              <input type="text" name="width" value="<?php echo $width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-width" class="form-control" />
              <?php if ($error_width) { ?>
              <div class="text-danger"><?php echo $error_width; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-height"><?php echo $entry_height; ?></label>
            <div class="col-sm-10">
              <input type="text" name="height" value="<?php echo $height; ?>" placeholder="<?php echo $entry_height; ?>" id="input-height" class="form-control" />
              <?php if ($error_height) { ?>
              <div class="text-danger"><?php echo $error_height; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-tags-to-show"><span data-toggle="tooltip" title="<?php echo $help_tags_to_show; ?>"><?php echo $entry_tags_to_show; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="tags" value="" placeholder="<?php echo $entry_tags_to_show; ?>" id="input-tags-to-show" class="form-control" />
              <div id="tags-to-show" class="well well-sm" style="height: 150px; overflow: auto;">
                <?php foreach ($tags_to_show as $tag_to_show) { ?>
                <div id="tag-to-show<?php echo $tag_to_show['tlttag_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $tag_to_show['title']; ?>
                  <input type="hidden" name="tags_to_show[]" value="<?php echo $tag_to_show['tlttag_id']; ?>" />
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-template"><span data-toggle="tooltip" title="<?php echo $help_template; ?>"><?php echo $entry_template; ?></label>
            <div class="col-sm-10">
              <input type="text" name="template" value="<?php echo $template; ?>" placeholder="<?php echo $entry_template; ?>" id="input-template" class="form-control" />
              <?php if ($error_template) { ?>
              <div class="text-danger"><?php echo $error_template; ?></div>
              <?php } ?>
            </div>
          </div>         
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
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
        </form>
      </div>
    </div>
  </div>
<script type="text/javascript"><!--
// Tags
$('input[name=\'tags\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=tltblog/tlttag/autocomplete&token=<?php echo $token; ?>&filter_title=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['title'],
						value: item['tlttag_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'tags\']').val('');
		
		$('#tags-to-show' + item['value']).remove();
		
		$('#tags-to-show').append('<div id="tags-to-show' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="tags_to_show[]" value="' + item['value'] + '" /></div>');	
	}	
});

$('#tags-to-show').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
//--></script> 
<?php echo $footer; ?>
