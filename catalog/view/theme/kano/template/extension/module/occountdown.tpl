<script type="text/javascript">
	if (typeof OC == 'undefined') OC = { };
	OC.Countdown = {
		TEXT_YEARS 		: '<?php echo $text_years ?>',
		TEXT_MONTHS 	: '<?php echo $text_months ?>',
		TEXT_WEEKS 		: '<?php echo $text_weeks ?>',
		TEXT_DAYS 		: '<?php echo $text_days ?>',
		TEXT_HOURS 		: '<?php echo $text_hours ?>',
		TEXT_MINUTES 	: '<?php echo $text_minutes ?>',
		TEXT_SECONDS 	: '<?php echo $text_seconds ?>'
	};
</script>
<script type="text/javascript" src="catalog/view/javascript/jquery.countdown.js"></script>
<?php
	  $count = 0;
	  $rows = 1;
   ?>
<div class="occountdown_module quickview-added qv-wtext">
<div class="countdown-title module-title"><h2><?php echo $title; ?></h2></div>
<?php if($products): ?>
	<div>
	<div class="countdown-product-inner">
    <?php foreach ($products as $product) : ?>
    <?php  if($count % $rows == 0 ) { echo '<div class="row_items">'; } $count++; ?>
            <div class="product-layout product-grid">
					<div class="product-thumb layout1">
						<div class="image">
							<a class="product-image" href="<?php echo $product['href']; ?>">
								<?php if($product['rotator_image']): ?>
								<img class="img-r lazy" src="<?php echo $product['rotator_image']; ?>" alt="<?php echo $product['name']; ?>" />
								<?php endif; ?>
								<img class="lazy" src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" />
							</a>
							<?php if($config_slide['f_show_label']): ?>
								<?php if($product['is_new'] && !$product['special']){ ?>
								  <div class="label-product l-new">
									  <span><?php echo $text_new; ?></span>
								  </div>
								  <?php } if(($product['special'] && $product['is_new'])||($product['special'] && !$product['is_new'])) { ?>
								  <div class="label-product">
									  <span><?php echo $text_sale; ?></span>
								  </div>
								  <?php }?>
							<?php endif; ?>
							<div class="actions-link"></div>
							</div><!-- image -->
					<div class="product-inner">
					
					
						<div class="product-caption">
							<?php if ($product['tags']) { ?>
						  <p class="tags-product">
							<?php for ($i = 0; $i < count($product['tags']); $i++) { ?>
							<?php if ($i < (count($product['tags']) - 1)) { ?>
							<a href="<?php echo $product['tags'][$i]['href']; ?>"><?php echo $product['tags'][$i]['tag']; ?></a>,
							<?php } else { ?>
							<a href="<?php echo $product['tags'][$i]['href']; ?>"><?php echo $product['tags'][$i]['tag']; ?></a>
							<?php } ?>
							<?php } ?>
						  </p>
					  <?php } ?>
							<h2 class="product-name">
								<a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
							</h2>
							<?php if (isset($product['rating'])) { ?>
								<div class="ratings">
									<div class="rating-box">
										<?php for ($i = 0; $i <= 5; $i++) { ?>
											<?php if ($product['rating'] == $i) {
												$class_r= "rating".$i;
												echo '<div class="'.$class_r.'">rating</div>';
											} 
										}  ?>
									</div>									
								</div>
							<?php } ?>
					<div class="description"><?php echo $product['description']; ?></div>
					
					<?php if ($product['orgprice']) { ?>
						<p class="price">
						  <?php if (!$product['special']) { ?>
							<?php echo $product['orgprice']; ?>
						  <?php } else { ?>
								<span class="price-new"><?php echo $product['special']; ?></span>
								<span class="price-old"><?php echo $product['orgprice']; ?></span>
						  <?php } ?>
						</p>
					<?php } ?>
					<?php if(strtotime($product['date_end'])) { ?>
					<p class="text-hurryup"><?php echo $text_hurryup; ?></p>
					<div id="Countdown<?php echo $product['product_id']?>" class="box-timer"></div>
					<?php if(strtotime($product['date_end'])) { ?>
						<script type="text/javascript">
							$(function () {
								var austDay = new Date();
								austDay = new Date(austDay.getFullYear() + 1, 1 - 1, 26);
								$('#Countdown<?php echo $product['product_id'];?>').countdown({
									until: new Date(
										<?php echo date("Y",strtotime($product['date_end']))?>,
										<?php echo date("m",strtotime($product['date_end']))?> -1, 
										<?php echo date("d",strtotime($product['date_end']))?>,
										<?php echo date("H",strtotime($product['date_end']))?>,
										<?php echo date("i",strtotime($product['date_end']))?>, 
										<?php echo date("s",strtotime($product['date_end']))?>
										),
										//format: 'S'
								});
								
								//$('#Countdown<?php echo $product['product_id'];?>').countdown('pause');
								
							});
						</script>
					<?php } ?>
				<?php } ?>
				</div>
				
				</div><!-- product-inner -->
				</div>				
				</div>
				<?php if($count % $rows == 0 || $count == count($products)): ?>
					</div>
				<?php endif; ?>
    <?php endforeach;  ?>
	</div>
	<?php if($use_thumbnail_slider): ?>
		<div class="col-sm-12 col-xs-12 list-thumb">
			<ul class="thumb">
				<?php $i=0; foreach ($products as $product) : ?>
					<li class="thumbinner<?php echo $i; echo ($i==0) ? ' active' : ''?>" onclick="timerslider(<?php echo $i; $i++;?>)">
						<img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" />
					</li>
				<?php endforeach;  ?>
			</ul><!-- list-thumb -->
		</div>
	<?php endif; ?>
	</div>
<?php else: ?>
<p><?php echo $text_empty; ?></p>
<?php endif; ?>
</div>

<script type="text/javascript">
	<?php if($use_thumbnail_slider): ?>
		$('.occountdown_module .list-thumb .thumb').owlCarousel({
			autoPlay : false,
			items : 6,
			itemsDesktop : [1199,4],
			itemsDesktopSmall : [991,3],
			itemsTablet: [768,2],
			itemsMobile : [480,1],
			slideSpeed : 1000,
			paginationSpeed : 3000,
			navigation : true,
			stopOnHover : true,
			pagination : false,
			scrollPerPage:true,
			addClassActive: true,
			lazyLoad : true,
			navigationText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
		});
	<?php endif; ?>
	$('.countdown-product-inner').owlCarousel({
		autoPlay : <?php if($config_slide['autoplay']) { echo 'true' ;} else { echo 'false';} ?>,
		items : <?php if($config_slide['items']) { echo $config_slide['items'] ;} else { echo 3;} ?>,
		itemsDesktop : [1199,1],
		itemsDesktopSmall : [991,2],
		itemsTablet: [768,2],
		itemsMobile : [480,1],
		slideSpeed : <?php if($config_slide['f_speed']) { echo $config_slide['f_speed'] ;} else { echo 2000;} ?>,
		paginationSpeed : 3000,
		navigation : <?php if($config_slide['f_show_nextback']) { echo 'true' ;} else { echo 'false';} ?>,
		stopOnHover : true,
		pagination : <?php if($config_slide['f_show_ctr']) { echo 'true' ;} else { echo 'false';} ?>,
		scrollPerPage:true,
		addClassActive: true,
		lazyLoad : true,
		navigationText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
		afterMove: function(){
			x = $( ".countdown-tab-content .owl-pagination .owl-page" ).index( $( ".countdown-tab-content .owl-pagination .active" ));
			var thumbinner = ".thumbinner"+x;
			$(".list-thumb .thumb li").removeClass('active');
			$(thumbinner).addClass('active');
		}
	});
	
	var owltimerslider = $(".countdown-product-inner").data('owlCarousel');
	function timerslider(x){
		owltimerslider.goTo(x)
	}
</script>