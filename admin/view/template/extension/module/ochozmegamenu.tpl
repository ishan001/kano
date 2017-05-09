<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-slideshow" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-slideshow" class="form-horizontal">
		<div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>
		<div style="display: none">
				<div class="margin-form">
					<input type="text" name="hactive" id="itemsInput" value="<?php if($hcate) { echo $hcate; }?>" size="70">
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
            <label class="col-sm-2 control-label" for="input-status"><?php echo $text_homepage; ?></label>
            <div class="col-sm-10">
        	  <select name="hhome" class="form-control">
						<option value="0" <?php if($hhome==0) {?> selected="selected" <?php } ?> >No</option>
						<option value="1" <?php if($hhome==1) {?> selected="selected" <?php } ?> >Yes</option>
				</select>
            </div>
          </div>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $text_depth; ?></label>
            <div class="col-sm-10">
        	  	<input class="form-control" type="text" name="hdepth" value="<?php if($hdepth) { echo $hdepth; }else{ echo 4;} ?>">
            </div>
          </div>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $text_level; ?></label>
            <div class="col-sm-10">
        	  <input class="form-control" type="text" name="hlevel" value="<?php if($hlevel) { echo $hlevel; }else{ echo 4;} ?>">
            </div>
          </div>
		 
		  <table id="setting" class="table table-striped table-bordered table-hover">
			<tr>
				<td>
				
					<select multiple="multiple"   id="availableItems" style="width: 300px; height: 160px;">
					<optgroup label="Infomations">
						<?php echo $cms_option; ?> 
					</optgroup>
					<optgroup label="Category">
						<?php echo $cate_option; ?>
					</optgroup>	
					<optgroup label="Cms Links">
						<?php echo $link_option; ?> 
					</optgroup>
					</select>
				</td>
				<td>
					<select multiple="multiple"  id="hactive" style="width: 300px; height: 160px;">
						<?php echo $option_active; ?> 
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<a href="#" id="addItem" style="border: 1px solid rgb(170, 170, 170); margin: 2px; padding: 2px; text-align: center; display: block; text-decoration: none; background-color: rgb(250, 250, 250); color: rgb(18, 52, 86);"><?php echo 'Add'; ?></a>
				</td>
				<td>
					<a href="#" id="removeItem" style="border: 1px solid rgb(170, 170, 170); margin: 2px; padding: 2px; text-align: center; display: block; text-decoration: none; background-color: rgb(250, 250, 250); color: rgb(18, 52, 86);">&lt;&lt; <?php echo 'Remove' ?></a>
				</td>
				<td >
						<a href="#" id="menuOrderUp" class="button" >&uarr;</a><br/>
						<a href="#" id="menuOrderDown" class="button">&darr;</a><br/>
				</td>
			</tr>
			<script type="text/javascript">
				function add()
				{
					$("#availableItems option:selected").each(function(i){
						var val = $(this).val();
						var text = $(this).text();
						text = text.replace(/(^\s*)|(\s*$)/gi,"");
						$("#hactive").append("<option value=\""+val+"\">"+text+"</option>");
					});
					serialize();
					return false;
				}

				function remove()
				{
					$("#hactive option:selected").each(function(i){
						$(this).remove();
					});
					serialize();
					return false;
				}

				function serialize()
				{
					var options = "";
					$("#hactive option").each(function(i){
						options += $(this).val() + ",";
					});
					$("#itemsInput").val(options.substr(0, options.length - 1));
				}

				function move(up)
				{
					var tomove = $("#hactive option:selected");
					if (tomove.length >1)
					{
						alert('Please select just one item');
						return false;
					}
					if (up)
						tomove.prev().insertAfter(tomove);
					else
						tomove.next().insertBefore(tomove);
					serialize();
					return false;
				}

				$(document).ready(function(){
					$("#addItem").click(add);
					$("#availableItems").dblclick(add);
					$("#removeItem").click(remove);
					$("#hactive").dblclick(remove);
					$("#menuOrderUp").click(function(e){
						e.preventDefault();
						move(true);
					});
					$("#menuOrderDown").click(function(e){
						e.preventDefault();
						move();
					});
				});
				</script>
		</table>
		  
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
$('input[name=\'product\']').autocomplete({
	'source': function(request, response) {
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
	'select': function(item) {
		$('#hozmegamenu-product' + item['value']).remove();
		
		$('#hozmegamenu-product').append('<div id="hozmegamenu-product' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" value="' + item['value'] + '" /></div>');	
	
		data = $.map($('#hozmegamenu-product input'), function(element) {
			return $(element).attr('value');
		});
						
		$('input[name=\'hozmegamenu_product\']').attr('value', data.join());	
	}	
});

$('#hozmegamenu-product').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();

	data = $.map($('#hozmegamenu-product input'), function(element) {
		return $(element).attr('value');
	});
					
	$('input[name=\'hozmegamenu_product\']').attr('value', data.join());	
});

<?php echo $footer; ?>