<?php 
/******************************************************
 * @package	SO Theme Framework for Opencart 2.0.x
 * @author	http://www.magentech.com
 * @license	GNU General Public License
 * @copyright(C) 2008-2015 Magentech.com. All rights reserved.
*******************************************************/
?>
<?php // Header Blocks =========================================?>
<?php echo $header; ?>
<style type="text/css">
	body{background:none;}
	#wrapper{box-shadow:none;background:#fff;}
	#wrapper > *:not(.product-detail){display: none;}
	.container{width:100%;}
	.product-info .product-view{margin:0;}
	.left-content-product .content-product-right .box-info-product .cart input{padding:12px 16px;}
	.left-content-product .content-product-right .box-info-product .add-to-links{ width: auto;  float: none; margin-top: 0px; }
</style>

<?php
	
    global $config, $loader, $registry, $session;
	$db = $registry->get('db');
	$store_id = $config->get('config_store_id');
	$lang = $config->get('config_language_id');
	
	$model_catalog = $registry->get('model_catalog_product');
	$model_product = $registry->get('model_custom_general');
	$product_info = $model_catalog->getProduct($product_id);
	
	
    if ($store_id == 0) {
        $soconfig_pages = $config->get('soconfig_pages');
        $soconfig_lang = $config->get('soconfig_lang');
		if (isset($soconfig_pages[$lang]["new_text"])) {$new_text = $soconfig_pages[$lang]["new_text"];}
		if (isset($soconfig_pages[$lang]["sale_text"])) {$sale_text = $soconfig_pages[$lang]["sale_text"];}
		if (isset($soconfig_pages["sale_status"])) 	{$sale_status = $soconfig_pages["sale_status"];}
		if (isset($soconfig_pages["new_status"])) 	{$new_status = $soconfig_pages["new_status"];}
    } else {
        $soconfig_pages = $config->get('soconfig_pages_store');
        $soconfig_lang = $config->get('soconfig_lang_store');
		$text_product = array(
			'thumbnails_position',
			'product_enablezoom',
			'product_zoommode',
			'product_zoomlenssize',
			'tabs_position',
			'related_status',
			'product_page_button',
			'discount_status',
		);
		foreach ($text_product as $text) {
			if (isset($soconfig_pages[$store_id][$text])) 	{$soconfig_pages[$text] = $soconfig_pages[$store_id][$text];}
		}
		if (isset($soconfig_lang[$lang][$store_id]["view_details"])) {$soconfig_lang[$lang]["view_details"]  = $soconfig_lang[$lang][$store_id]["view_details"];}

    }
	
	$view_details =  $soconfig_lang[$lang]["view_details"] ;
	$limit = 700;
	$full_description = strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8'));
    $product_description_short = (strlen($product_info['description']) > $limit ? utf8_substr($full_description, 0, $limit) . '...' : $full_description);
	
?>


<?php // Content Detail Blocks ========================================= ?>
<div class="product-detail">
    <div id="product-quick" class="product-info">
      
        <div class="product-view row">
		  <div class="left-content-product ">
			<?php //Img Gallery Block -------?>
			
                <div class="content-product-left  col-sm-6">
                   
                        <div class="large-image ">
                            <img itemprop="image" class="product-image-zoom" src="<?php echo $popup; ?>" data-zoom-image="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" />
                        </div>
						<div class="box-label">
							<!--New Label-->
							<?php if (!isset($new_status) || ($new_status != 0)) : ?>
							<?php
							$soconfig_days='';
							$day_range = 10;
							if ($soconfig_days == '') {
								$days = $day_range;
							} else {
								$days = $soconfig_days;
							}
							$day_number_to_range = date( "Y-m-d" ,  strtotime("-$days day")  );
							if ($product_info['date_available'] >= $day_number_to_range) :
								?>
								<span class="label-product label-new"><?php echo (isset($new_text) ? $new_text : 'NEW'); ?></span>
								<?php endif; ?>
							<?php endif; ?>
						
							<!--Sale Label-->
							<?php if ($product_info['special']) : ?>
								<?php if (!isset($sale_status) || ($sale_status != 0)) : ?>
									<span class="label-product label-sale"><?php echo (isset($sale_text) ? $sale_text : 'SALE'); ?></span>
								<?php endif; ?>
							<?php endif; ?>
						</div>
						
						<?php if ($images ) :  ?>
	                        <div id="thumb-slider" class="owl-theme owl-loaded owl-drag <?php echo ((count($images) < 3 ) ? 'not_full_slider' : 'full_slider'); ?> ">
								<?php
								if (sizeof($images) > 0) {
									$firstimg = array('popup' => $popup,'thumb' => $thumb);
									array_unshift($images, $firstimg);
								}
								if ($images) : ?>
									<?php $i=-1; foreach ($images as $image) : $i++ ?>
										<a data-index="<?php echo $i; ?>" class="img thumbnail" data-image="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>">
											<img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" />
										</a>
									<?php endforeach; ?>
								<?php endif; ?>
								
	                        </div>
							<script type="text/javascript"><!--
								jQuery(function ($) {
									var thumbWidth = $(".large-image img").width()+2, thumbHeight = $("#thumb-slider .img").height() ;
									var $nav = $("#thumb-slider");
									
									$nav.each(function () {
										$(this).owlCarousel2({
											nav:true,
											dots: false,
											slideBy: 1,
											margin:10,
											navText: ['',''],
											<?php if($direction=='rtl'):?> rtl:true, <?php endif;?>
											responsive:{
												0:{
													items: 2,
												},
												481:{
													items:4,
												},
												768:{
													items:4,	
												},
												992:{
													items:3
												},
												1200:{
													items:4
												}
											}
										});
									})
									
								});
							//--></script>
	                    <?php endif; ?>
						<?php //End Bottom Thumbnails previews -------?>
					
                </div>
           
			<?php //End Img Gallery Block -------?>

			<?php //Product info Block -------?>
			<div class="content-product-right col-sm-6">
				<div class="title-product">
					<h1><?php echo $heading_title; ?></h1>
				</div>
				
				<!-- Review ---->
				<?php if ($review_status) { ?>
				    <div class="box-review">
					   <div class="ratings">
						  <div class="rating-box">
						  <?php for ($i = 1; $i <= 5; $i++) { ?>
						  <?php if ($rating < $i) { ?>
						  <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
						  <?php } else { ?>
						  <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
						  <?php } ?>
						  <?php } ?>
						  </div>
					  </div>
			 
					   <?php if ($rating > $i) { ?>
							<?php $i = 0; $i <= 5; $i++ ?>
						   	<a class="reviews_button" href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"><?php echo $reviews; ?></a> 
						    <?php } else { ?>
						    <a class="reviews_button" href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"><?php echo (isset($review) ? $review : '0 Review'); ?></a> 
					    <?php } ?>
				    </div>
				<?php } ?>
				
				<?php //Product label -------?>
                <div class="product-label">
					
					   <?php if (!isset($soconfig_pages['product_catalog_mode']) || $soconfig_pages['product_catalog_mode'] != 1) : ?>
						<?php if ($price) : ?>
						<div class="product_page_price price" itemprop="offerDetails" itemscope itemtype="http://data-vocabulary.org/Offer">
							
							<?php if (!$special) { ?>
							<?php echo '<span class="price" itemprop="price">'.$price.'</span>'; ?>
							<?php } else { ?>
							<span class="price-new" itemprop="price"><?php echo $special; ?></span>
							<span class="price-old"><?php echo $price; ?></span>
							<?php } ?>
							
							
							
							<?php if ($discounts) { ?>
							<div class="discount">
								<?php foreach ($discounts as $discount) { ?>
								 <?php echo $discount['quantity']; ?><?php echo $text_discount; ?><?php echo $discount['price']; ?>
								<?php } ?>
							</div>
							<?php } ?>
						</div>
						<?php endif; ?>
					<?php endif; ?>
					<div class="stock"><span><?php echo $text_stock; ?></span> <span class="status-stock"><?php echo $stock; ?></span></div>

                </div>
                <?php //End Product label -------?>	
			 
				<?php //Product Description -------?>
				<p class="form-group"><?php echo $product_description_short; ?></p>
				<?php // End Product Description -------?>
				
				
				
				<?php if ($options) { ?>
				<div id="product">	
				<h3><?php echo $text_option; ?></h3>
				<?php foreach ($options as $option) { ?>
					<?php if ($option['type'] == 'select') { ?>
					<div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
						<label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
						<select name="option[<?php echo $option['product_option_id']; ?>]" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control">
							<option value=""><?php echo $text_select; ?></option>
							<?php foreach ($option['product_option_value'] as $option_value) { ?>
							<option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
								<?php if ($option_value['price']) { ?>
								(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
								<?php } ?>
							</option>
							<?php } ?>
						</select>
					</div>
					<?php } ?>
				
					<?php if ($option['type'] == 'radio') { ?>
					<div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
						<label class="control-label"><?php echo $option['name']; ?></label>
						<div id="input-option<?php echo $option['product_option_id']; ?>">
							<?php foreach ($option['product_option_value'] as $option_value) { ?>
							<div class="radio">
								<label>
									<input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" />
									<?php echo $option_value['name']; ?>
									<?php if ($option_value['price']) { ?>
									(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
									<?php } ?>
								</label>
							</div>
							<?php } ?>
						</div>
					</div>
					<?php } ?>
				
					<?php if ($option['type'] == 'checkbox') { ?>
					<div class="box-checkbox form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
						<label class="control-label"><?php echo $option['name']; ?></label>
						<div id="input-option<?php echo $option['product_option_id']; ?>">
							<?php foreach ($option['product_option_value'] as $option_value) { ?>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" />
									<?php echo $option_value['name']; ?>
									<?php if ($option_value['price']) { ?>
									(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
									<?php } ?>
								</label>
							</div>
							<?php } ?>
						</div>
					</div>
					<?php } ?>
				
					<?php if ($option['type'] == 'image') { ?>
					<div class="image_option_type form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
						<label class="control-label"><?php echo $option['name']; ?></label>
						<div class="product-options clearfix" id="input-option<?php echo $option['product_option_id']; ?>">
							<?php foreach ($option['product_option_value'] as $option_value) { ?>
							<div class="radio">
								<label>
									<input class="image_radio" type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" />
									<img data-toggle="tooltip" title="<?php echo $option_value['name']; ?><?php if ($option_value['price']) { ?>
									(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
									<?php } ?>" src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" class="img-thumbnail icon icon-color" />
								</label>
							</div>
							<?php } ?>
						</div>
					</div>
					<?php } ?>
				
					<?php if ($option['type'] == 'text') { ?>
					<div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
						<label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
						<input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
					</div>
					<?php } ?>
					
					<?php if ($option['type'] == 'textarea') { ?>
					<div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
						<label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
						<textarea name="option[<?php echo $option['product_option_id']; ?>]" rows="5" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control"><?php echo $option['value']; ?></textarea>
					</div>
					<?php } ?>
					
					<?php if ($option['type'] == 'file') { ?>
					<div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
						<label class="control-label"><?php echo $option['name']; ?></label>
						<button type="button" id="button-upload<?php echo $option['product_option_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default btn-block"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
						<input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" id="input-option<?php echo $option['product_option_id']; ?>" />
					</div>
					<?php } ?>
				
					<?php if ($option['type'] == 'date') { ?>
					<div class="box-date form-group<?php echo ($option['required'] ? ' required' : ''); ?> col-sm-12 col-xs-12">
						<label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
						<div class="input-group date">
							<input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
							<span class="input-group-btn">
							<button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
							</span>
						</div>
					</div>
					<?php } ?>
				
					<?php if ($option['type'] == 'datetime') { ?>
					<div class="box-date form-group<?php echo ($option['required'] ? ' required' : ''); ?> col-sm-12 col-xs-12">
						<label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
						<div class="input-group datetime">
							<input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
							<span class="input-group-btn">
							<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
							</span>
						</div>
					</div>
					<?php } ?>
				
					<?php if ($option['type'] == 'time') { ?>
					<div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
						<label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
						<div class="input-group time">
							<input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
							<span class="input-group-btn">
							<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
							</span>
						</div>
					</div>
					<?php } ?>
				
				<?php } ?>
				</div>
				<?php } ?>
				
				
				<?php
					
				if ($recurrings) { ?>
				<hr>
				<h3><?php echo $text_payment_recurring ?></h3>
				<div class="form-group required">
					<select name="recurring_id" class="form-control">
						<option value=""><?php echo $text_select; ?></option>
						<?php foreach ($recurrings as $recurring) { ?>
						<option value="<?php echo $recurring['recurring_id'] ?>"><?php echo $recurring['name'] ?></option>
						<?php } ?>
					</select>
					<div class="help-block" id="recurring-description"></div>
				</div>
				<?php } ?>
				
				
			   <div class="form-group box-info-product">
				   <div class="option quantity">
						
					  <div class="input-group quantity-control">
						  <label><?php echo $entry_qty; ?></label>
						  <input class="form-control" type="text" name="quantity" value="<?php echo $minimum; ?>" />
						  <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
						  <span class="input-group-addon product_quantity_down fa fa-caret-down"></span>
						  <span class="input-group-addon product_quantity_up fa fa-caret-up"></span>
					  </div>
				   </div>
			   </div>
			   <?php if ((isset($soconfig_pages["thumbnails_position"]) && $soconfig_pages["thumbnails_position"] == 'left')) : ?>
				<p class="clearfix clear form-group"></p>
			   <?php endif;?>
				<div class="form-group box-info-product form-cart">
					<div class="cart">
						<input type="button" data-toggle="tooltip" title="<?php echo $button_cart; ?>" value="<?php echo $button_cart; ?>" data-loading-text="<?php echo $text_loading; ?>" id="button-cart" class="btn btn-mega btn-lg " />
					</div>
					<div class="add-to-links wish_comp">
						<ul class="blank">
							<li class="wishlist">
								<a class="icon" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product_id; ?>');"><i class="fa fa-heart"></i></a>
							</li>
							<li class="compare">
								<a class="icon" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product_id; ?>');"><i class="fa fa-exchange"></i></a>
							</li>
							<li class="compare">
							<?php $our_url = $registry->get('url');  ?>
								<a href="<?php echo $our_url->link('product/product','product_id='.$product_info['product_id']);?>" data-toggle="tooltip" title="<?php echo $button_detail; ?>" target="_top"  class="icon" ><i class="fa fa-chevron-right"></i> </a>
							</li>
						</ul>
					</div>
				</div>
				<?php if ($minimum > 1) : ?><p class="minimum" style="clear:both"><?php echo $text_minimum; ?></p><?php endif; ?>

					
			
            </div>
			<?php //End Product info Block -------?>
		  </div><!-- end - left-content-product --->

		</div>

	
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		var zoomCollection = '.large-image img';
		$( zoomCollection ).elevateZoom({
			<?php if( $soconfig_pages['product_zoommode'] != 'basic' ) { ?>
			zoomType        : "<?php echo isset($soconfig_pages['product_zoommode']) ? $soconfig_pages['product_zoommode'] : '';?>",
			<?php } ?>
			lensSize    :"<?php echo isset($soconfig_pages['product_zoomlenssize']) ? $soconfig_pages['product_zoomlenssize'] : '';?>",
			easing:true,
			gallery:'thumb-slider',
			cursor: 'pointer',
			galleryActiveClass: "active"
		});
		
		
		
	});
			
</script>

<script type="text/javascript"><!--
$('select[name=\'recurring_id\'], input[name="quantity"]').change(function(){
	$.ajax({
		url: 'index.php?route=product/product/getRecurringDescription',
		type: 'post',
		data: $('input[name=\'product_id\'], input[name=\'quantity\'], select[name=\'recurring_id\']'),
		dataType: 'json',
		beforeSend: function() {
			$('#recurring-description').html('');
		},
		success: function(json) {
			$('.alert, .text-danger').remove();
			
			if (json['success']) {
				$('#recurring-description').html(json['success']);
			}
		}
	});
});
//--></script> 

<script type="text/javascript"><!--
$('#button-cart').on('click', function() {
	$.ajax({
		url: 'index.php?route=soconfig/cart/add',
		type: 'post',
		data: $('#product-quick input[type=\'text\'], #product-quick input[type=\'hidden\'], #product-quick input[type=\'radio\']:checked, #product-quick input[type=\'checkbox\']:checked, #product-quick select, #product-quick textarea'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-cart').button('loading');
		},
		complete: function() {
			$('#button-cart').button('reset');
		},
		success: function(json) {
			
			if (json['error']) {
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						var element = $('#input-option' + i.replace('_', '-'));
						
						if (element.parent().hasClass('input-group')) {
							element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						} else {
							element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						}
					}
				}
				
				if (json['error']['recurring']) {
					$('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
				}
				
				// Highlight any found errors
				$('.text-danger').parent().addClass('has-error');
			}
			
			if (json['success']) {
				parent.addProductNotice(json['title'], json['thumb'], json['success'], 'success');
				
				// Need to set timeout otherwise it wont update the total
				setTimeout(function () {
					parent.$('#cart .text-shopping-cart').html(json['total'] );
					$('.text-danger').remove();
				}, 100);
				parent.$('#cart > ul').load('index.php?route=common/cart/info ul li');
			}
			
		}
	});
});

var wishlist = {
	'add': function(product_id) {
		$.ajax({
			url: 'index.php?route=soconfig/wishlist/add',
			type: 'post',
			data: 'product_id=' + product_id,
			dataType: 'json',
			success: function(json) {
				
				if (json['success']) {
					parent.addProductNotice(json['title'], json['thumb'], json['success'], 'success');
				}
				if (json['info']) {
				  parent.addProductNotice(json['title'], json['thumb'], json['info'], 'warning');
				}
				parent.$('#wishlist-total').html(json['total']);
				parent.$('#wishlist-total').attr('title', json['total']);
			}
		});
	}
}

var compare = {
	'add': function(product_id) {
		$.ajax({
			url: 'index.php?route=soconfig/compare/add',
			type: 'post',
			data: 'product_id=' + product_id,
			dataType: 'json',
			success: function(json) {
				if (json['success']) {
					parent.addProductNotice(json['title'], json['thumb'], json['success'], 'success');
					parent.$('#compare-total').html(json['total']);
				}
			}
		});
	}
	
}
//--></script> 
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});

$('.time').datetimepicker({
	pickDate: false
});

$('button[id^=\'button-upload\']').on('click', function() {
	var node = this;
	
	$('#form-upload').remove();
	
	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');
	
	$('#form-upload input[name=\'file\']').trigger('click');
    if (typeof timer != 'undefined') {
        clearInterval(timer);
    }
	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);
			
			$.ajax({
				url: 'index.php?route=tool/upload',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(node).button('loading');
				},
				complete: function() {
					$(node).button('reset');
				},
				success: function(json) {
					$('.text-danger').remove();
					
					if (json['error']) {
						$(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
					}
					
					if (json['success']) {
						alert(json['success']);
						
						$(node).parent().find('input').attr('value', json['code']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});
//--></script> 


