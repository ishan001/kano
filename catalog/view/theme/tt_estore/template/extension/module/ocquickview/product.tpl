<link href="catalog/view/javascript/jquery/magnific/magnific-popup.css" type="text/css" rel="stylesheet" media="screen" />
<link href="catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
<script src="catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery/datetimepicker/moment.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <div class="col-1 col-sm-5">
          <?php if ($thumb || $images) { ?>
          <div class="thumbnails">
            <?php if ($thumb) { ?>
                <a class="thumbnail" title="<?php echo $heading_title; ?>">
                     <img src="<?php echo $thumb; ?>" data-zoom-image="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" />
                 </a>
             <?php } ?>
          </div>
          <div class="image-additional-container owl-style3">
            <div class="image-additional2" id="gallery_02">
            <?php if ($thumb) { ?>
              <a class="thumbnail" style="display: none" href="javascript:void(0);" data-image="<?php echo $thumb; ?>" data-zoom-image="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a>
            <?php } ?>
            <?php if ($images) { ?>
              <?php foreach ($images as $image) { ?>
                  <a style="display: none" class="thumbnail" href="javascript:void(0);" data-image="<?php echo $image['thumb']; ?>" data-zoom-image="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>"> <img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a>
              <?php } ?>
            <?php } ?>
            </div>
            </div>
          <?php } ?>
        </div>
		<div class="col-2 col-sm-7">
			<h1 class="product-name"><?php echo $heading_title; ?></h1>
			<?php if ($review_status) { ?>
			  <div class="ratings">
				  <div class="rating-box">
					  <?php for ($i = 0; $i <= 5; $i++) { ?>
						  <?php if ($rating == $i) {
							  $class_r= "rating".$i;
							  echo '<div class="'.$class_r.'">rating</div>';
						  } 
					  }  ?>
				  </div>
			  </div>
		  <?php } ?>
		  <?php if ($price) { ?>
			  <ul class="list-unstyled price-product">
				<?php if (!$special) { ?>
				<li>
				  <span><?php echo $price; ?></span>
				</li>
				<?php } else { ?>
				<li><span class="new-price"><?php echo $special; ?></span><span class="old-price"><?php echo $price; ?></span></li>
				<?php } ?>
			  </ul>
			  <?php } ?>
		  <div class="form-group">
				<label class="control-label" for="input-quantity"><?php echo $entry_qty; ?></label>
				<div class="quantity-box">
					<input type="button" id="minus2" value="-" class="form-control" />
					<input type="text" name="quantity" value="<?php echo $minimum; ?>" size="2" id="input-quantity2" class="form-control" />
					<input type="button" id="plus2" value="&#43;" class="form-control"/>
				</div>
				<div class="clearfix"></div>
				<button class="button" type="button" id="button-cart2" data-loading-text="<?php echo $text_loading; ?>"><span><?php echo $button_cart; ?></span></button>
				<button class="btn-wishlist" type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="addWishlist('<?php echo $product_id; ?>');"><i class="icon-heart"></i></button>
				<button class="btn-compare" type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="addCompare('<?php echo $product_id; ?>');"><i class="icon-refresh"></i></button>
			</div> 		  			  
			  <?php if ($price) { ?>
			  <ul class="list-unstyled">
				<?php if ($tax) { ?>
				<li><?php echo $text_tax; ?><span class="ex-text"><?php echo $tax; ?></span></li>
				<?php } ?>
				<?php if ($points) { ?>
				<li><?php echo $text_points; ?><span class="ex-text"><?php echo $points; ?></span></li>
				<?php } ?>
				<?php if ($discounts) { ?>
				<?php foreach ($discounts as $discount) { ?>
				<li><?php echo $discount['quantity']; ?><?php echo $text_discount; ?><span class="ex-text"><?php echo $discount['price']; ?></span></li>
				<?php } ?>
				<?php } ?>
			  </ul>
			  <?php } ?>
          <ul class="list-unstyled">
            <?php if ($manufacturer) { ?>
            <li><?php echo $text_manufacturer; ?> <a href="<?php echo $manufacturers; ?>"><span class="ex-text"><?php echo $manufacturer; ?></span></a></li>
            <?php } ?>
            <li><?php echo $text_model; ?><span class="ex-text"><?php echo $model; ?></span></li>
            <?php if ($reward) { ?>
            <li><?php echo $text_reward; ?><span class="ex-text"><?php echo $reward; ?></span></li>
            <?php } ?>
            <li><?php echo $text_stock; ?><span class="ex-text"><?php echo $stock; ?></span></li>
          </ul>
			
			<input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
          <div id="product">
            <?php if ($options) { ?>
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
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <div id="input-option<?php echo $option['product_option_id']; ?>">
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                    <?php if ($option_value['image']) { ?>
                    <img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" class="img-thumbnail" /> 
                    <?php } ?>
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
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <div id="input-option<?php echo $option['product_option_id']; ?>">
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <div class="radio">
                  <label>
                    <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                    <img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" class="img-thumbnail" /> <?php echo $option_value['name']; ?>
                    <?php if ($option_value['price']) { ?>
                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                    <?php } ?>
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
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group date">
                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'datetime') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group datetime">
                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'time') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group time">
                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <?php } ?>
            <?php } ?>
            <?php } ?>
            <?php if ($recurrings) { ?>
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
            <?php if ($minimum > 1) { ?>
            <div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $text_minimum; ?></div>
            <?php } ?>
          </div>
		  <p class="short-des">
			  <?php echo $short_description; ?>
			  </p>
          <?php if ($tags) { ?>
			  <p><?php echo $text_tags; ?>
				<?php for ($i = 0; $i < count($tags); $i++) { ?>
				<?php if ($i < (count($tags) - 1)) { ?>
				<a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
				<?php } else { ?>
				<a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
				<?php } ?>
				<?php } ?>
			  </p>
			  <?php } ?>
			  <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style" data-url="<?php echo $share; ?>"><a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_pinterest_pinit"></a> <a class="addthis_counter addthis_pill_style"></a></div>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script>
            <!-- AddThis Button END -->
        </div>

<script type="text/javascript">
//<![CDATA[
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

    $('#button-cart2').on('click', function() {
      $.ajax({
        url: 'index.php?route=checkout/cart/add',
        type: 'post',
        data: $('input[name=\'product_id\'], #input-quantity2, #product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
        dataType: 'json',
        beforeSend: function() {
          $('#button-cart2').button('loading');
        },
        complete: function() {
          $('#button-cart2').button('reset');
        },
        success: function(json) {
          $('.alert, .text-danger').remove();
          $('.form-group').removeClass('has-error');

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
            $('#quickview-content').prepend('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

            $('#cart-total').html(json['total']);

            $('#quickview-content').animate({ scrollTop: 0 }, 'slow');

            $('#cart > ul').load('index.php?route=common/cart/info ul li');
          }
        }
      });
    });
    $(document).ajaxComplete(function() {
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

    $('#review').delegate('.pagination a', 'click', function(e) {
      e.preventDefault();

        $('#review').fadeOut('slow');

        $('#review').load(this.href);

        $('#review').fadeIn('slow');
    });

    //$('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

    $('#button-review').on('click', function() {
      $.ajax({
        url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
        type: 'post',
        dataType: 'json',
        data: $("#form-review").serialize(),
        beforeSend: function() {
          $('#button-review').button('loading');
        },
        complete: function() {
          $('#button-review').button('reset');
        },
        success: function(json) {
          $('.alert-success, .alert-danger').remove();

          if (json['error']) {
            $('#review').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
          }

          if (json['success']) {
            $('#review').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');

            $('input[name=\'name\']').val('');
            $('textarea[name=\'text\']').val('');
            $('input[name=\'rating\']:checked').prop('checked', false);
          }
        }
      });
    });

    $('.thumbnails').magnificPopup({
      type:'image',
      delegate: 'a',
      gallery: {
        enabled:true
      }
    });
  
    function addWishlist(product_id) {
      $.ajax({
        url: 'index.php?route=account/wishlist/add',
        type: 'post',
        data: 'product_id=' + product_id,
        dataType: 'json',
        success: function(json) {
          $('.alert').remove();

          if (json['success']) {
            $('#quickview-content').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
          }

          if (json['info']) {
            $('#quickview-content').prepend('<div class="alert alert-info"><i class="fa fa-info-circle"></i> ' + json['info'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
          }

          $('#wishlist-total span').html(json['total']);
          $('#wishlist-total').attr('title', json['total']);

          $('#quickview-content').animate({ scrollTop: 0 }, 'slow');
        }
      });
    }

    function addCompare(product_id) {
      $.ajax({
        url: 'index.php?route=product/compare/add',
        type: 'post',
        data: 'product_id=' + product_id,
        dataType: 'json',
        success: function(json) {
          $('.alert').remove();

          if (json['success']) {
            $('#quickview-content').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

            $('#compare-total').html(json['total']);

            $('#quickview-content').animate({ scrollTop: 0 }, 'slow');
          }
        }
      });
    }
	var minimum = <?php echo $minimum; ?>;
  $("#input-quantity2").change(function(){
    if ($(this).val() < minimum) {
      alert("Minimum Quantity: "+minimum);
      $("#input-quantity2").val(minimum);
    }
  });
  // increase number of product
  function minus(minimum){
      var currentval = parseInt($("#input-quantity2").val());
      $("#input-quantity2").val(currentval-1);
      if($("#input-quantity").val() <= 0 || $("#input-quantity2").val() < minimum){
          alert("Minimum Quantity: "+minimum);
          $("#input-quantity2").val(minimum);
     }
  };
  // decrease of product
  function plus(){
      var currentval = parseInt($("#input-quantity2").val());
     $("#input-quantity2").val(currentval+1);
  };
  $('#minus2').click(function(){
    minus(minimum);
  });
  $('#plus2').click(function(){
    plus();
  });
	// zoom
	$(".thumbnails img").elevateZoom({
		zoomType : "window",
		cursor: "crosshair",
		gallery:'gallery_02', 
		galleryActiveClass: "active", 
		imageCrossfade: true,
		responsive: true,
		zoomWindowOffetx: 0,
		zoomWindowOffety: 0,
	});
	// slider	 
	$(".image-additional2").owlCarousel({
		navigation: true,
		pagination: false,
		slideSpeed : 500,
		goToFirstSpeed : 1500,
		autoHeight : true,
		items : 3, 
		itemsDesktop : [1199,3],
		itemsDesktopSmall : [1024,3],
		itemsTablet: [640,3],
		itemsMobile : [480,3],
		navigationText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
		afterInit: function(){
			$('#gallery_02 .owl-wrapper .owl-item:first-child').addClass('active');
		},
		beforeInit: function(){
			$(".image-additional2 .thumbnail").show();
		}
	});	
	$('#gallery_02 .owl-item .thumbnail').each(function(){
		$(this).click(function(){
			$('#gallery_02 .owl-item').removeClass('active');
			$(this).parent().addClass('active');
		});
	});
//]]>
</script>