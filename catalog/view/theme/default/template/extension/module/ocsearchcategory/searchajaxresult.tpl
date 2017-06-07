<?php if(count($products) == 0): ?>
    <p class="ajax-result-msg"><?php echo $text_empty ?></p>
<?php else: ?>
    <ul class="ajax-result-list">
        <?php $i=0; foreach($products as $product): $i++;?>
            <li class="ajax-result-item col-lg-6 col-md-6 col-xs-12 col-sm-12">
                
                    <div class="product-info">
                        <?php if($product_img_enabled == '1'): ?>
                            <a class="product-image" href="<?php echo $product['href']; ?>">
                                <div class="product-image">
                                    <img class="img2" src="<?php echo $product['rotator_image']; ?>" alt="<?php echo $product['name']; ?>" />
                                    <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" />
                                </div>
                            </a>
                        <?php endif; ?>
                        <div class="detail">
                            <h2 class="product-name">
                                <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                            </h2>
                            <?php if($product_price_enabled == '1'): ?>
                            <?php if ($product['price']) { ?>
                            <div class="price-box">
                                <?php if (!$product['special']) { ?>
                                    <span class="price"><?php echo $product['price']; ?></span>
                                <?php } else { ?>
                                    <p class="old-price"><span class="price"><?php echo $product['price']; ?></span></p>
                                    <p class="special-price"><span class="price"><?php echo $product['special']; ?></span></p>
                                <?php } ?>
                            </div>
                            <?php } ?>
                            <?php endif; ?>
                        </div>
                    </div>
                
            </li><?php if($i%2==0){ ?>
            <div style="clear:both"></div>
            <?php }?>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>