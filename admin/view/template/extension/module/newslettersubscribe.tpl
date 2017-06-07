<?php echo $header; ?><?php echo $column_left; ?>
<?php  $token_random = rand();  ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-html" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
		<a id="button-send"  class="btn btn-default" onclick="send('index.php?route=module/newslettersubscribe/send&token=<?php echo $token; ?>');" class="button"><?php echo $button_send; ?></a>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo 'Edit Form'; ?></h3>
      </div>
      <div class="panel-body">
	  
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-html" class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
							<div class="col-sm-10">
							  <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
							  <?php if ($error_name) { ?>
							  <div class="text-danger"><?php echo $error_name; ?></div>
							  <?php } ?>
							</div>
						  </div>
					   <div class="form-group">
						<label class="col-sm-2 control-label" for="input-popup"><?php echo $entry_popup; ?></label>
						<div class="col-sm-10">
						  <select name="popup" id="input-popup" class="form-control">
							<?php if ($popup) { ?>
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
					   
					  
			   <div class="row">
					  <div class="col-sm-2">
						 <div class="tab-pane" id="tab-module">
							  <ul class="nav nav-pills nav-stacked" id="module">
									<li>
										<a href="#tab-general" class="selected"  data-toggle="tab" ><?php echo $tab_general; ?></a>
									</li>
									<li>
										<a href="#tab-list"  class="" data-toggle="tab" ><?php echo $tab_list; ?></a>
									</li>
									<li>
										<a href="#tab-mail"  data-toggle="tab" ><?php echo $tab_mail; ?></a>
									</li>
								
							  </ul>
						  </div>
					  </div>
					  <div class="col-sm-10">
						   <div class="tab-content">
								<div class="tab-pane" id ="tab-general">
										<div class="form-group required">
											<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_unsubscribe; ?></label>
											 <div class="col-sm-10">
											  <select class="form-control" name="newslettersubscribe_unsubscribe">
												  <?php if ($newslettersubscribe_unsubscribe) { ?>
												  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
												  <option value="0"><?php echo $text_disabled; ?></option>
												  <?php } else { ?>
												  <option value="1"><?php echo $text_enabled; ?></option>
												  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
												  <?php } ?>
												</select>
											</div>
										</div>
										<div class="form-group required">
											<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_mail; ?></label>
											 <div class="col-sm-10">
											  <select class="form-control" name="newslettersubscribe_mail_status">
												  <?php if ($newslettersubscribe_mail_status) { ?>
												  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
												  <option value="0"><?php echo $text_disabled; ?></option>
												  <?php } else { ?>
												  <option value="1"><?php echo $text_enabled; ?></option>
												  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
												  <?php } ?>
												</select>
											</div>
										</div>

										<div class="form-group required">
											<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_thickbox; ?></label>
											 <div class="col-sm-10">
											  <select class="form-control" name="newslettersubscribe_thickbox">
												  <?php if ($newslettersubscribe_thickbox) { ?>
												  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
												  <option value="0"><?php echo $text_disabled; ?></option>
												  <?php } else { ?>
												  <option value="1"><?php echo $text_enabled; ?></option>
												  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
												  <?php } ?>
												</select>
											</div>
										</div>
										<div class="form-group required">
											<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_registered; ?></label>
											 <div class="col-sm-10">
											 <select class="form-control" name="newslettersubscribe_registered">
											  <?php if ($newslettersubscribe_registered) { ?>
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
								<div class="tab-pane" id ="tab-list">
									<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead>
											<thead>
												<tr>
													<td class="left"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
													<td class="left">No</td>
													<td class="left">Email</td>
													<td class="left">Name</td>
													<td class="right">Action</td>
												</tr>
											</thead>
											<tbody>
												<?php if($users) { ?>
												<?php foreach ($users as $key => $user) { ?>
												<tr>
													<td class="left">
														<?php if ($user['selected']) { ?>
														<input type="checkbox" name="selected[]" value="<?php echo $user['id']; ?>" checked="checked" />
														<?php } else { ?>
														<input type="checkbox" name="selected[]" value="<?php echo $user['id']; ?>" />
														<?php } ?>
													</td>
													<td class="left"><?php echo $page_nav+$key+1; ?></td>
													<td class="left"><?php echo $user['email_id']; ?></td>
													<td class="left"><?php echo $user['name']; ?></td>
													<td class="right">
													<?php foreach ($user['action'] as $action) { ?>
													[ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
													<?php } ?>
													</td>
												</tr>
												<?php } ?>
												<?php } else { ?>
												<tr>
												  <td class="center" colspan="8"><?php echo $text_no_results; ?></td>
												</tr>
												<?php } ?>
											</tbody>
									</table>
									<div class="pagination"><?php echo $pagination; ?></div>
									</div>
								</div>
								<div class="tab-pane" id ="tab-mail">
											<div class="table-responsive">
												<table id="mail"  class="table table-bordered table-hover">
												  <tr>
													<td><?php echo $entry_store; ?></td>
													<td><select name="store_id">
														<option value="0"><?php echo $text_default; ?></option>
														<?php foreach ($stores as $store) { ?>
														<option value="<?php echo $store['store_id']; ?>"><?php echo $store['name']; ?></option>
														<?php } ?>
													  </select></td>
												  </tr>
												  <tr>
													<td><?php echo $entry_to; ?></td>
													<td><select name="to">
														<option value="sendall"><?php echo $text_sendall; ?></option>
														<option value="newsletter"><?php echo $text_newsletter; ?></option>
														<option value="lbnewsletter"><?php echo $text_lbnewsletter; ?></option>
														<option value="customer_all"><?php echo $text_customer_all; ?></option>
														<option value="customer_group"><?php echo $text_customer_group; ?></option>
														<option value="affiliate_all"><?php echo $text_affiliate_all; ?></option>
													  </select></td>
												  </tr>
												  <tbody id="to-customer-group" class="to">
													<tr>
													  <td><?php echo $entry_customer_group; ?></td>
													  <td><select name="customer_group_id">
														  <?php foreach ($customer_groups as $customer_group) { ?>
														  <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
														  <?php } ?>
														</select></td>
													</tr>
												  </tbody>
												  <tbody id="to-customer" class="to">
													<tr>
													  <td><?php echo $entry_customer; ?></td>
													  <td><input type="text" name="customers" value="" /></td>
													</tr>
													<tr>
													  <td>&nbsp;</td>
													  <td><div id="customer" class="scrollbox"></div></td>
													</tr>
												  </tbody>
												  <tbody id="to-affiliate" class="to">
													<tr>
													  <td><?php echo $entry_affiliate; ?></td>
													  <td><input type="text" name="affiliates" value="" /></td>
													</tr>
													<tr>
													  <td>&nbsp;</td>
													  <td><div id="affiliate" class="scrollbox"></div></td>
													</tr>
												  </tbody>
												  <tbody id="to-product" class="to">
													<tr>
													  <td><?php echo $entry_product; ?></td>
													  <td><input type="text" name="products" value="" /></td>
													</tr>
													<tr>
													  <td>&nbsp;</td>
													  <td><div id="product" class="scrollbox"></div></td>
													</tr>
												  </tbody>
												  <tr>
													<td><span class="required">*</span> <?php echo $entry_subject; ?></td>
													<td><input type="text" name="subject" value="" /></td>
												  </tr>
												  <tr>
													<td><span class="required">*</span> <?php echo $entry_message; ?></td>
													<td>   <textarea name="message"  id="input-description" class="form-control">conten email here.....</textarea></td>
												  </tr>
												</table>
											</div>
										
									
								</div>
								<div class="tab-pane" id ="tab-statistic">
										<script type="text/javascript" src="https://www.google.com/jsapi"></script>
										<script type="text/javascript">
										  google.load("visualization", "1", {packages:["corechart"]});
										  google.setOnLoadCallback(drawChart);
										  function drawChart() {
											var data = google.visualization.arrayToDataTable([
											  ['Date', 'Users'],
											  <?php foreach($jack as $key => $j) { ?> 
											  ['<?php echo date("d M",strtotime($key)); ?>',  <?php echo $j; ?>],
											  <?php } ?>
											]);
									
											var options = {
												title: 'Last 15 Days Newsletter Report',
												width: 1800, 
												height: 500,
												vAxis: {title: 'Users Per Day', titleTextStyle: {color: '#000'}},
												hAxis: {title: 'Date', titleTextStyle: {color: '#000'}},
												
											};
											

											var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
											chart.draw(data, options);

										  }
										</script>
										<div id="chart_div" style="width: 100%; height: 500px;"></div>
										
								</div>
						   </div>
						
					  </div>
			   </div>
			  
        </form>
		
      </div>
    </div>
  </div>
 <script type="text/javascript"><!--
function addModule() {
	var token = Math.random().toString(36).substr(2);
			
	html  = '<tr id="module-row' + token + '">';
	html += '  <td class="text-right">' + ($('tbody tr').length + 1) + '</td>';
	html += '  <td class="text-left"><input type="text" name="newslettersubscribe_module[' + token + '][limit]" value="5" placeholder="<?php echo $entry_limit; ?>" class="form-control" /></td>';
	html += '  <td class="text-left"><input type="text" name="newslettersubscribe_module[' + token + '][width]" value="200" placeholder="<?php echo $entry_width; ?>" class="form-control" /> <input type="text" name="newslettersubscribe_module[' + token + '][height]" value="200" placeholder="<?php echo $entry_height; ?>" class="form-control" /></td>';	
	html += '  <td class="text-left"><button type="button" onclick="$(\'#module-row' + token + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';
	
	$('#module tbody').append(html);
}
//--></script></div> 
<script  type ="text/javascript">
	$('#module li:first-child a').tab('show');
	$('#input-description').summernote({
		height: 300
	});
</script> 
<script type="text/javascript"><!--	
$('select[name=\'to\']').bind('change', function() {
	$('#mail .to').hide();
	$('#mail #to-' + $(this).val().replace('_', '-')).show();
	
});

$('select[name=\'to\']').trigger('change');
//--></script> 
<script type="text/javascript"><!--
$.widget('custom.catcomplete', $.ui.autocomplete, {
	_renderMenu: function(ul, items) {
		var self = this, currentCategory = '';
		
		$.each(items, function(index, item) {
			if (item.category != currentCategory) {
				ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');
				
				currentCategory = item.category;
			}
			
			self._renderItemData (ul, item);
		});
	}
});

$('input[name=\'customers\']').catcomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {	
				response($.map(json, function(item) {
					return {
						category: item.customer_group,
						label: item.name,
						value: item.customer_id
					}
				}));
			}
		});
		
	}, 
	select: function(event, ui) {
		$('#customer' + ui.item.value).remove();
		
		$('#customer').append('<div id="customer' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="customer[]" value="' + ui.item.value + '" /></div>');

		$('#customer div:odd').attr('class', 'odd');
		$('#customer div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});

$('#customer div img').bind('click', function() {
	$(this).parent().remove();
	
	$('#customer div:odd').attr('class', 'odd');
	$('#customer div:even').attr('class', 'even');	
});
//--></script> 
<script type="text/javascript"><!--	
$('input[name=\'affiliates\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=sale/affiliate/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.affiliate_id
					}
				}));
			}
		});
		
	}, 
	select: function(event, ui) {
		$('#affiliate' + ui.item.value).remove();
		
		$('#affiliate').append('<div id="affiliate' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="affiliate[]" value="' + ui.item.value + '" /></div>');

		$('#affiliate div:odd').attr('class', 'odd');
		$('#affiliate div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});

$('#affiliate div img').bind('click', function() {
	$(this).parent().remove();
	
	$('#affiliate div:odd').attr('class', 'odd');
	$('#affiliate div:even').attr('class', 'even');	
});

$('input[name=\'products\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.product_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('#product' + ui.item.value).remove();
		
		$('#product').append('<div id="product' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product[]" value="' + ui.item.value + '" /></div>');

		$('#product div:odd').attr('class', 'odd');
		$('#product div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});

$('#product div img').bind('click', function() {
	$(this).parent().remove();
	
	$('#product div:odd').attr('class', 'odd');
	$('#product div:even').attr('class', 'even');	
});

function send(url) { 
	$('textarea[name="message"]').val($('.note-editable').html());
	
	$.ajax({
		url: url,
		type: 'post',
		data: $('select, input, textarea'),		
		dataType: 'json',
		beforeSend: function() {
			$('#button-send').attr('disabled', true);
			$('#button-send').before('<span class="wait"><img src="view/image/loading.gif" alt="" />&nbsp;</span>');
		},
		complete: function() {
			$('#button-send').attr('disabled', false);
			$('.wait').html('Sent mail successfully');
		},				
		success: function(json) {
			$('.success, .warning, .error').remove();
			
			if (json['error']) {
				if (json['error']['warning']) {
					$('.box').before('<div class="warning" style="display: none;">' + json['error']['warning'] + '</div>');
			
					$('.warning').fadeIn('slow');
				}
				
				if (json['error']['subject']) {
					$('input[name=\'subject\']').after('<span class="error">' + json['error']['subject'] + '</span>');
				}	
				
				if (json['error']['message']) {
					$('textarea[name=\'message\']').parent().append('<span class="error">' + json['error']['message'] + '</span>');
				}									
			}			
			
			if (json['next']) {
				if (json['success']) {
					$('.box').before('<div class="success">' + json['success'] + '</div>');
					
					send(json['next']);
				}		
			} else {
				if (json['success']) {
					$('.box').before('<div class="success" style="display: none;">' + json['success'] + '</div>');
			
					$('.success').fadeIn('slow');
				}					
			}				
		}
	});
}
//--></script>
  
<?php echo $footer; ?>
