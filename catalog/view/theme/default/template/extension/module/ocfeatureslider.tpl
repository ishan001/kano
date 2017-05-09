<div class="ocnewproductslider special-button-owl">
  <div class="ocnewproduct-title group-title">
    <h2><?php echo $title; ?></h2>
  </div>
  <?php
	  $count = 0;
	  $rows = $config_slide['f_rows'];
	  if(!$rows) { $rows=1; }
   ?>
  <div class="featured-product-slider">
    <?php if($products): ?>
            <?php foreach ($products as $product) { ?>
            <?php  if($count % $rows == 0 ) { echo '<div class="row_items">'; } $count++; ?>
            <div class="item">
              <div class="item-inner">
                <?php if($config_slide['f_show_label']): ?>
                  <?php if ($product['is_new']):
                    if($product['special']): ?>
                      <div class="label-pro-sale"><?php echo $text_sale; ?></div>
                    <?php else: ?>
                      <div class="label-pro-new"><?php echo $text_new; ?></div>
                    <?php endif; ?>
                  <?php else: ?>
                    <?php if($product['special']): ?>
                      <div class="label-pro-sale"><?php echo $text_sale; ?></div>
                    <?php endif; ?>
                  <?php endif; ?>
                <?php endif; ?>
                <div class="images-container">
                  <a class="product-image" href="<?php echo $product['href']; ?>">
                    <?php if($product['rotator_image']): ?>
                    <img class="img2" src="<?php echo $product['rotator_image']; ?>" alt="<?php echo $product['name']; ?>" />
                    <?php endif; ?>
                    <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" />
                  </a>
                  <div class="actions">
                    <ul class="add-to-links">
                      <li>
                        <a class="link-wishlist" title="<?php echo $button_wishlist; ?>" data-toggle="tooltip" onclick="wishlist.add('<?php echo $product['product_id']; ?>');">
                          <em><?php echo $button_wishlist; ?></em>
                        </a>
                      </li>
                      <li>
                        <a class="link-compare" title="<?php echo $button_compare; ?>" data-toggle="tooltip" onclick="compare.add('<?php echo $product['product_id']; ?>');">
                          <em><?php echo $button_compare; ?></em>
                        </a>
                      </li>
                    </ul>
                  </div><!-- actions -->
                  <?php if($config_slide['f_show_price']) { ?>
                  <?php if ($product['price']) { ?>
                  <?php if (!$product['special']) { ?>
                  <div class="price-box box-regular">
                                            <span class="regular-price">
                                                <span class="price"><?php echo $product['price']; ?></span>
                                            </span>
                  </div>
                  <?php } else { ?>
                  <div class="price-box box-special">
                    <p class="special-price"><span class="price"><?php echo $product['special']; ?></span></p>
                    <p class="old-price"><span class="price"><?php echo $product['price']; ?></span></p>
                  </div>
                  <?php } ?>
                  <?php } ?>
                  <?php } ?>
                </div><!--images-container-->
                <div class="des-container">
                  <h2 class="product-name">
                    <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                  </h2>
                  <?php if($config_slide['f_show_des']){ ?>
                  <p><?php echo $product['description']; ?></p>
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
                <?php if($config_slide['f_show_addtocart']) { ?>
                <button class="button btn-cart" type="button" data-toggle="tooltip" title="<?php echo $button_cart; ?>" onclick="cart.add('<?php echo $product['product_id']; ?>');">
                  <span><span><?php echo $button_cart; ?></span></span>
                </button>
                <?php } ?>
              </div><!--des-container-->
            </div> <!-- item-inner -->
          </div> <!-- item -->
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
    $(".featured-product-slider").owlCarousel({
      autoPlay: <?php if($config_slide['autoplay']) { echo 'true' ;} else { echo 'false'; } ?>,
    items : <?php if($config_slide['items']) { echo $config_slide['items'] ;} else { echo 3; } ?>,
    slideSpeed : <?php if($config_slide['f_speed']) { echo $config_slide['f_speed']; } else { echo 200;} ?>,
    navigation : <?php if($config_slide['f_show_nextback']) { echo 'true' ;} else { echo 'false'; } ?>,
    paginationNumbers : true,
            pagination : <?php if($config_slide['f_show_ctr']) { echo 'true' ;} else { echo 'false';} ?>,
    stopOnHover : false,
            itemsDesktop : [1199,3],
            itemsDesktopSmall : [991,2],
            itemsTablet: [700,2],
            itemsMobile : [400,1],
  });
  });
</script>