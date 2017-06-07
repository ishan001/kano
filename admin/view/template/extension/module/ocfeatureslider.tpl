<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-ocfeatureslider" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-ocfeatureslider" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-title"><?php echo $entry_title; ?></label>
                <div class="col-sm-10">
                    <?php foreach ($languages as $language) { ?>
                    <div class="input-group">
                        <span class="input-group-addon"><?php echo $language['name']; ?></span>
                        <input type="text" name="title[<?php echo $language['code']; ?>][title]" value="<?php echo isset($title[$language['code']]['title']) ? $title[$language['code']]['title'] : ''; ?>" placeholder="" id="input-title<?php echo $language['language_id']; ?>" class="form-control" />
                    </div>
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
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-product"><span data-toggle="tooltip" title="<?php echo $help_product; ?>"><?php echo $entry_product; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="product" value="" placeholder="<?php echo $entry_product; ?>" id="input-product" class="form-control" />
              <div id="ocfeatureslider-product" class="well well-sm" style="height: 150px; overflow: auto;">
                <?php foreach ($products as $product) { ?>
                <div id="ocfeatureslider-product<?php echo $product['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product['name']; ?>
                  <input type="hidden" name="product[]" value="<?php echo $product['product_id']; ?>" />
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-rotator"><?php echo $entry_rotator; ?></label>
            <div class="col-sm-10">
              <select name="rotator" id="input-rotator" class="form-control">
                <?php if ($rotator) { ?>
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
            <label class="col-sm-2 control-label" for="input-limit"><?php echo $entry_limit; ?></label>
            <div class="col-sm-10">
              <input type="text" name="limit" value="<?php echo $limit; ?>" placeholder="<?php echo $entry_limit; ?>" id="input-limit" class="form-control" />
            </div>
          </div>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-item"><?php echo $entry_item; ?></label>
            <div class="col-sm-10">
              <input type="text" name="item" value="<?php echo $item; ?>" placeholder="<?php echo $entry_item; ?>" id="input-item" class="form-control" />
            </div>
          </div>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-speed"><?php echo $entry_speed; ?></label>
            <div class="col-sm-10">
              <input type="text" name="speed" value="<?php echo $speed; ?>" placeholder="<?php echo $entry_speed; ?>" id="input-speed" class="form-control" />
            </div>
          </div>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-autoplay"><?php echo $entry_autoplay; ?></label>
            <div class="col-sm-10">
              <select name="autoplay" id="input-autoplay" class="form-control">
                <?php if ($autoplay) { ?>
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
            <label class="col-sm-2 control-label" for="input-rows"><?php echo $entry_rows; ?></label>
            <div class="col-sm-10">
              <input type="text" name="rows" value="<?php echo $rows; ?>" placeholder="<?php echo $entry_rows; ?>" id="input-rows" class="form-control" />
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-width"><?php echo $entry_width; ?></label>
            <div class="col-sm-10">
              <input type="text" name="width" value="<?php echo $width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-width" class="form-control" />
              <?php if ($error_width) { ?>
              <div class="text-danger"><?php echo $error_width; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-height"><?php echo $entry_height; ?></label>
            <div class="col-sm-10">
              <input type="text" name="height" value="<?php echo $height; ?>" placeholder="<?php echo $entry_height; ?>" id="input-height" class="form-control" />
              <?php if ($error_height) { ?>
              <div class="text-danger"><?php echo $error_height; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-showlabel"><?php echo $entry_showlabel ?></label>
            <div class="col-sm-10">
              <select id="input-showlabel" name="showlabel" class="form-control">
                <option value="0" <?php if($showlabel==0) { ?> selected="selected" <?php } ?> >No</option>
                <option value="1" <?php if($showlabel==1) { ?> selected="selected" <?php } ?> >Yes</option>
              </select>
            </div>
          </div>
		   <div class="form-group">
            <label class="col-sm-2 control-label" for="input-showprice"><?php echo $entry_showprice ?></label>
            <div class="col-sm-10">
			 <select id="input-showprice" name="showprice" class="form-control">
					<option value="0" <?php if($showprice==0) { ?> selected="selected" <?php } ?> >No</option>
					<option value="1" <?php if($showprice==1) { ?> selected="selected" <?php } ?> >Yes</option>
			</select>
            </div>
          </div> 
		   <div class="form-group">
            <label class="col-sm-2 control-label" for="input-showdes"><?php echo $entry_showdes ?></label>
            <div class="col-sm-10">
			 <select id="input-showdes" name="showdes" class="form-control">
					<option value="0" <?php if($showdes==0) { ?> selected="selected" <?php } ?> >No</option>
					<option value="1" <?php if($showdes==1) { ?> selected="selected" <?php } ?> >Yes</option>
			</select>
            </div>
          </div> 
		   <div class="form-group">
            <label class="col-sm-2 control-label" for="input-showaddtocart"><?php echo  $entry_showaddtocart ?></label>
            <div class="col-sm-10">
			 <select id="input-showaddtocart" name="showaddtocart" class="form-control">
					<option value="0" <?php if($showaddtocart==0) { ?> selected="selected" <?php } ?> >No</option>
					<option value="1" <?php if($showaddtocart==1) { ?> selected="selected" <?php } ?> >Yes</option>
			</select>
            </div>
          </div> 
		   <div class="form-group">
            <label class="col-sm-2 control-label" for="input-shownextback"><?php echo $entry_shownextback ?></label>
            <div class="col-sm-10">
			 <select id="input-shownextback" name="shownextback" class="form-control">
					<option value="0" <?php if($shownextback==0) { ?> selected="selected" <?php } ?> >No</option>
					<option value="1" <?php if($shownextback==1) { ?> selected="selected" <?php } ?> >Yes</option>
			</select>
            </div>
          </div> 
		   <div class="form-group">
            <label class="col-sm-2 control-label" for="input-shownav"><?php echo $entry_shownav ?></label>
            <div class="col-sm-10">
			 <select id="input-shownav" name="shownav" class="form-control">
					<option value="0" <?php if($shownav==0) { ?> selected="selected" <?php } ?> >No</option>
					<option value="1" <?php if($shownav==1) { ?> selected="selected" <?php } ?> >Yes</option>
			</select>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
$('input[name=\'product\']').autocomplete({
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	select: function(item) {
		$('input[name=\'product\']').val('');
		
		$('#ocfeatureslider-product' + item['value']).remove();
		
		$('#ocfeatureslider-product').append('<div id="ocfeatureslider-product' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product[]" value="' + item['value'] + '" /></div>');	
	}
});
	
$('#ocfeatureslider-product').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
//--></script></div>
<?php echo $footer; ?>