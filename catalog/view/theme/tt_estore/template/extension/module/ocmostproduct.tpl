<div class="mostviewed-product-slider special-button-owl">
   <div class="module-title">
	  <h2>
		<?php 
			$title2 = explode(' ',$title,3); 
			for($i=0;$i<count($title2);$i++){ 
				$j=$i+1;
				echo $j>2 ? "<span class='word2'> ".$title2[$i]." </span>" : "<span> ".$title2[$i]." </span>";
			}
		?>
		</h2>
   </div>
   <?php 
	  $count = 0;
	  $rows = $config_slide['f_rows']; 
	  if(!$rows) { $rows=1; }
   ?>
   <div class="most-viewed-products-slider">
	   	<?php if($products): ?>
			<?php foreach ($products as $product) { ?>
			<?php  if($count % $rows == 0 ) { echo '<div class="row_items">'; } $count++; ?>
			<div class="product-layout product-grid">
					<div class="product-thumb layout2">
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
					<?php if($config_slide['f_show_des']) { ?>
						<p class="product-des"><?php echo $product['description']; ?></p>
					<?php } ?>
					
					<?php if($config_slide['f_show_price']) { ?>
						<p class="price">
						  <?php if (!$product['special']) { ?>
							<?php echo $product['price']; ?>
						  <?php } else { ?>
								<span class="price-new"><?php echo $product['special']; ?></span>
								<span class="price-old"><?php echo $product['price']; ?></span>
						  <?php } ?>
						</p>
						<?php } ?>
					<div class="product-intro">
						<div class="actions-link">
							<a class="btn-compare" data-toggle="tooltip" title="<?php echo $button_compare; ?>"  onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="icon-refresh" aria-hidden="true"></i></a>
							<?php if($config_slide['f_show_addtocart']) { ?>
							<a class="btn-cart" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-shopping-basket"></i><span class="button"><?php echo $button_cart; ?></span></a>
							<?php } ?>
							<a class="btn-wishlist" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>"  onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="icon-heart" aria-hidden="true"></i></a>
						</div>						
					</div>
				</div>
				
				</div><!-- product-inner -->
				</div>				
				</div>
			<?php if($count % $rows == 0 || $count == count($products)): ?>
			</div>
			<?php endif; ?>
			<?php } ?>
		<?php else: ?>
			<p><?php echo $text_empty; ?></p>
		<?php endif; ?>
   </div>
</div>
<script type="text/javascript">
$(document).ready(function() { 
  $(".most-viewed-products-slider").owlCarousel({
		autoPlay: <?php if($config_slide['autoplay']) { echo 'true' ;} else { echo 'false'; } ?>,
		items : <?php if($config_slide['items']) { echo $config_slide['items'] ;} else { echo 3; } ?>,
		slideSpeed : <?php if($config_slide['f_speed']) { echo $config_slide['f_speed']; } else { echo 200;} ?>,
		navigation : <?php if($config_slide['f_show_nextback']) { echo 'true' ;} else { echo 'false'; } ?>,
		paginationNumbers : true,
		pagination : <?php if($config_slide['f_show_ctr']) { echo 'true' ;} else { echo 'false';} ?>,
		stopOnHover : false,
		lazyLoad : true,
		itemsDesktop : [1199,1],
		itemsDesktopSmall : [991,2],
		itemsTablet: [768,2],
		itemsMobile : [480,1],
		navigationText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
  });
});
</script>