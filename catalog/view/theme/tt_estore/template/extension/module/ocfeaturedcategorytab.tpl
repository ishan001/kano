<?php if($status): ?>
	<?php if($exist_fcate): ?>
		<script type="text/javascript">
			$(document).ready(function() {
				$(".featured-categorytab .tab_content_category").hide();
				$(".featured-categorytab .tab_content_category:first").show();
				$(".featured-categorytab div.featured-category .tabs-featured").click(function() {
					$(".featured-categorytab .tab_content_category").hide();
					$(".featured-categorytab .tab_content_category").removeClass("animate1 <?php echo $tab_effect;?>");
					var activeTab = $(this).attr("rel");
					$(".featured-categorytab #" + activeTab).addClass("animate1 <?php echo $tab_effect;?>");
					$(".featured-categorytab #" + activeTab).fadeIn();
				});
			});
		</script>
		
		<?php
			$rows = $config_slide['f_rows'];
			if(!$rows) { $rows = 1; }
		?>
<div class="product-tabs-category-container-slider featured-categorytab">
	<div class="featured-category-title modules-title">
		<h2><?php echo $title; ?></h2>
	</div>
	<div class="featured-category-icon">
		<div>
			<div class="featured-category">
				<?php $count = 0; ?>
				<?php foreach($categories as $category ): ?>
					<div class="tabs-featured  tab_cate<?php echo $category['category_id']; ?>" rel="tab_fcate<?php echo $category['category_id']; ?>">
						<div>
							<?php //if($category['homethumb_image']): ?>
								<!-- <img class="image" src="<?php echo $category['homethumb_image'] ?>" alt="" /> -->
							<?php //endif; ?>
							<?php if($category['thumbnail_image']): ?>
								<img class="imagehover" src="<?php echo $category['thumbnail_image'] ?>" alt="" />
							<?php endif; ?>
							<!-- <span><?php echo $category['name']; ?></span> -->
						</div>
					</div>
					<?php $count = $count+1; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<div class="tab_featured_category">
		<div>
		<?php $count = 0; ?>
		<?php foreach($categories as $category): ?>
		<div id="tab_fcate<?php echo $category['category_id']; ?>" class="tab_content_category">
			<?php if($category['products']): ?>
				<div class="productTabContent owl-demo-tabcate">
					<?php $products = $category['products']; $i = 0; ?>
					<?php foreach ($products as $product): ?>
						<?php  if($count % $rows == 0 ) { echo '<div class="row_items">'; } $count++; ?>
						<div class="product-layout product-grid">
							<div class="product-thumb layout2">
							  <div class="image">
							  <?php if($config_slide['showlabel']){ ?>
								  <?php if($product['is_new'] && !$product['special']){ ?>
								  <div class="label-product l-new">
									  <span><?php echo $text_new; ?></span>
								  </div>
								  <?php } if(($product['special'] && $product['is_new'])||($product['special'] && !$product['is_new'])) { ?>
								  <div class="label-product">
									  <span><?php echo $text_sale; ?></span>
								  </div>
								  <?php }?>
								  <?php }?>
								  <a href="<?php echo $product['href']; ?>">
								  <?php if ($product['thumb']) { ?>
									<img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive lazy" />
									<?php if($product['rotator_image']){ ?>
										<img class="img-r lazy" src="<?php echo $product['rotator_image']; ?>" alt="<?php echo $product['name']; ?>" />
									<?php } ?>
								  <?php } else { ?>
									<img src="image/cache/no_image-100x100.png" alt="<?php echo $product['name']; ?>" />
								  <?php } ?>
								  </a>
								  <div class="actions-link">				
										<a class="btn-wishlist" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="icon-heart"></i></a>
										<a class="btn-compare" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="icon-refresh"></i></a>						
									</div>				  
								</div>
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
								  <h2 class="product-name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h2>
								  
								  
									<?php if($config_slide['showdes']) { ?>
									<p class="product-des"><?php echo $product['description']; ?></p>
									<?php } ?>
									<?php if($config_slide['showprice']) { ?>
								  <?php if ($product['price']) { ?>
									<p class="price">
									  <?php if (!$product['special']) { ?>
									  <?php echo $product['price']; ?>
									  <?php } else { ?>
									  <span class="price-new"><?php echo $product['special']; ?></span>
									  <span class="price-old"><?php echo $product['price']; ?></span>
									  <?php } ?>
									</p>
									<?php } ?>
									<?php } ?>
								  <div class="product-intro">
										<div class="actions-link2">
										<?php if($config_slide['showaddtocart']) { ?>
											<a class="btn-cart" onclick="cart.add('<?php echo $product['product_id']; ?>');"><span class="button"><?php echo $button_cart; ?></span></a>
										<?php } ?>
										<a class="btn-wishlist" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="icon-heart"></i></a>
										<a class="btn-compare" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="icon-refresh"></i></a>						
									</div>
									</div>
								  </div>
								</div>
							  </div>
							</div>
						<?php if($count % $rows == 0 ): ?>
    	</div>
     <?php else: ?>
    	<?php if($count == count($products)): ?>
    		</div>
    	<?php endif; ?>
     <?php endif; ?>
					<?php endforeach; ?>
				</div>
			<?php else: ?>
				<p><?php echo $text_empty_products; ?></p>
			<?php endif; ?>
		</div>
		<?php endforeach; ?>
		</div>
	</div> <!-- .tab_container_category -->
</div>
		<script type="text/javascript">
			$(document).ready(function() {
				$(".featured-categorytab .owl-demo-tabcate").owlCarousel ({
					autoPlay: <?php if($config_slide['autoplay']) { echo 'true'; } else { echo 'false'; } ?>,
					items : <?php if($config_slide['items']) { echo $config_slide['items']; } else { echo 4; } ?>,
					slideSpeed : <?php if($config_slide['speed']) { echo $config_slide['speed']; } else { echo 3000; } ?>,
					navigation : <?php if($config_slide['shownextback']) { echo 'true'; } else { echo 'false'; } ?>,
					paginationNumbers : true,
					pagination : <?php if($config_slide['shownav']) { echo 'true'; } else { echo 'false'; } ?>,
					stopOnHover : false,
					lazyLoad : true,
					itemsDesktop : [1199,2],
					itemsDesktopSmall : [991,2],
					itemsTablet: [768,2],
					itemsMobile : [480,1],
					navigationText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
				$(".featured-categorytab .featured-category").owlCarousel ({
					autoPlay: false,
					items : 9,
					slideSpeed : <?php if($config_slide['speed']) { echo $config_slide['speed']; } else { echo 3000; } ?>,
					navigation : false,
					paginationNumbers : false,
					pagination : false,
					stopOnHover : false,
					itemsDesktop : [1199,5],
					itemsDesktopSmall : [991,3],
					itemsTablet: [768,2],
					itemsMobile : [360,1],
					addClassActive: true,
					lazyLoad : true,					
					afterInit : function(){
						//remove class active
							this.$owlItems.removeClass('first')
							this.$owlItems.removeClass('last')

							//add class first and last
							this.$owlItems .eq(this.currentItem).addClass('first');
							this.$owlItems .eq(this.currentItem + (this.owl.visibleItems.length - 1)).addClass('last');
					},
					afterAction: function(el){
							//remove class active
							this.$owlItems.removeClass('first')
							this.$owlItems.removeClass('last')
							//add class first and last
							this.$owlItems .eq(this.currentItem).addClass('first');
							this.$owlItems .eq(this.currentItem + (this.owl.visibleItems.length - 1)).addClass('last');
					},
				});
				$('.featured-category .owl-item').each(function(){
					$('.featured-category .owl-item:first').addClass('current-item');
					$(this).click(function(){
						$('.featured-category .owl-item').removeClass('current-item');
						$(this).addClass('current-item');
					});
				});
			});
		</script>
	<?php else: ?>
		<p class="category-not"><?php echo $text_empty_categories; ?></p>
	<?php endif; ?>
<?php endif; ?>




