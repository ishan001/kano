<h3><?php echo $title; ?></h3>
<div class="special-products-slider">
    <?php
        $count = 0;
        $rows = $config_slide['f_rows'];
        if(!$rows) { $rows=1; }
    ?>
    <?php if($products): ?>
    <?php foreach ($products as $product) { ?>
    <?php if($count++ % $rows == 0 ) { echo '<div ="row_items">'; } ?>
    <div class="item_product">
        <div class="product-thumb transition">
            <?php if($config_slide['f_show_label']): ?>
                <div class="label-pro-sale"><?php echo $text_sale; ?></div>
            <?php endif; ?>
            <div class="image">
                <a class="product-image" href="<?php echo $product['href']; ?>">
                    <?php if($product['rotator_image']): ?>
                        <img class="img2" src="<?php echo $product['rotator_image']; ?>" alt="<?php echo $product['name']; ?>" />
                    <?php endif; ?>
                    <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" />
                </a>
            </div>
            <div class="caption">
                <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
                <?php if($config_slide['f_show_des']){ ?>
                    <p><?php echo $product['description']; ?></p>
                <?php } ?>
                <?php if ($product['rating']) { ?>
                <div class="rating">
                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <?php if ($product['rating'] < $i) { ?>
                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                    <?php } else { ?>
                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i
                                class="fa fa-star-o fa-stack-2x"></i></span>
                    <?php } ?>
                    <?php } ?>
                </div>
                <?php } ?>
                <?php if($config_slide['f_show_price']){ ?>
                <?php if ($product['price']) { ?>
                <p class="price">
                    <?php if (!$product['special']) { ?>
                    <?php echo $product['price']; ?>
                    <?php } else { ?>
                    <span class="price-new"><?php echo $product['special']; ?></span> <span
                            class="price-old"><?php echo $product['price']; ?></span>
                    <?php } ?>
                    <?php if ($product['tax']) { ?>
                    <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
                    <?php } ?>
                </p> <?php } ?>
                <?php } ?>
            </div>
            <div class="button-group">
                <?php if($config_slide['f_show_addtocart']) { ?>
                <button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i
                            class="fa fa-shopping-cart"></i> <span
                            class="hidden-xs hidden-sm hidden-md"><?php echo $button_cart; ?></span></button>
                <?php } ?>
                <button type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>"
                        onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i>
                </button>
                <button type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>"
                        onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i>
                </button>
            </div>
        </div>
    </div>
    <?php if($count % $rows == 0 || $count == count($products)) { echo '</div>'; } ?>
    <?php } ?>
    <?php else: ?>
        <p><?php echo $text_empty; ?></p>
    <?php endif; ?>
</div>
<script type="text/javascript">
$(document).ready(function() {
  $(".special-products-slider").owlCarousel({
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