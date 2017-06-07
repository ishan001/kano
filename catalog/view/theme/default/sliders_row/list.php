<?php
if (isset($columns)) {
    switch ($columns) :
        case 1:
            $class = 'col-sm-6 col-md-3 col-lg-3';
            break;
        case 2:
            $class = 'col-sm-12 col-md-6 col-lg-6';
            break;
        case 3:
            $class = 'col-sm-12 col-md-9 col-lg-9';
            break;
        case 4:
            $class = 'col-sm-12 col-md-12 col-lg-12';
            break;
    endswitch;
} else {
    $class = 'col-sm-6 col-md-3 col-lg-3';
}

$store_id = $config->get('config_store_id');

if ($store_id == 0) {
    $customisation_products = $config->get('customisation_products');
    if (isset($customisation_products["limit_description_inline"])) {$limit_description_inline = $customisation_products["limit_description_inline"];}
    if (isset($customisation_products["limit_description_popup"])) {$limit_description_popup = $customisation_products["limit_description_popup"];}
} else {
    $customisation_products = $config->get('customisation_products_store');
    if (isset($customisation_products["limit_description_inline"][$store_id])) {$limit_description_inline = $customisation_products["limit_description_inline"][$store_id];}
    if (isset($customisation_products["limit_description_popup"][$store_id])) {$limit_description_popup = $customisation_products["limit_description_popup"][$store_id];}
}


?>
<section class="<?php echo $class; ?> slider-products module">
<h3><?php echo $slider_title; ?></h3>
<div class="row">

<?php
if ($quick_type == 'popup') {
    if (isset($limit_description_popup) && is_numeric($limit_description_popup)) {
        $limit = $limit_description_popup;
    } else {
        $limit = 1500;
    }
} else {
    if (isset($limit_description_inline) && is_numeric($limit_description_inline)) {
        $limit = $limit_description_inline;
    } else {
        $limit = 2600;
    }
}





$width = $config->get('config_image_thumb_width');
$height = $config->get('config_image_thumb_height');

$width_popup = $config->get('config_image_popup_width');
$height_popup = $config->get('config_image_popup_height');

global $config, $loader, $registry, $settings,$db;
$lang = $config->get('config_language_id');

if ($store_id == 0) {
    $customisation_general = $config->get('customisation_general');
    if (isset($customisation_general[$lang]["new_text"])) {$new_text = $customisation_general[$lang]["new_text"];}
    if (isset($customisation_general[$lang]["sale_text"])) {$sale_text = $customisation_general[$lang]["sale_text"];}
    if (isset($customisation_products["discount_status"])) {$discount_status = $customisation_products["discount_status"];}
    if (isset($customisation_products["new_status"])) {$new_status = $customisation_products["new_status"];}
    if (isset($customisation_products["days"])) {$customisation_days = $customisation_products["days"];}
    if (isset($customisation_products["sale_status"])) {$sale_status = $customisation_products["sale_status"];}
    if (isset($customisation_products["product_catalog_mode"])) {$product_catalog_mode = $customisation_products["product_catalog_mode"];}
    if (isset($customisation_products["listing_quick_type"])) {$listing_quick_type = $customisation_products["listing_quick_type"];}
    if (isset($customisation_products["popup_small_status"])) {$popup_small_status = $customisation_products["popup_small_status"];}
} else {
    $customisation_general = $config->get('customisation_general_store');

    if (isset($customisation_general[$lang]["new_text"][$store_id])) {$new_text = $customisation_general[$lang]["new_text"][$store_id];}
    if (isset($customisation_general[$lang]["sale_text"][$store_id])) {$sale_text = $customisation_general[$lang]["sale_text"][$store_id];}
    if (isset($customisation_products["discount_status"][$store_id])) {$discount_status = $customisation_products["discount_status"][$store_id];}
    if (isset($customisation_products["new_status"][$store_id])) {$new_status = $customisation_products["new_status"][$store_id];}
    if (isset($customisation_products["days"][$store_id])) {$customisation_days = $customisation_products["days"][$store_id];}
    if (isset($customisation_products["sale_status"][$store_id])) {$sale_status = $customisation_products["sale_status"][$store_id];}
    if (isset($customisation_products["product_catalog_mode"][$store_id])) {$product_catalog_mode = $customisation_products["product_catalog_mode"][$store_id];}
    if (isset($customisation_products["listing_quick_type"][$store_id])) {$listing_quick_type = $customisation_products["listing_quick_type"][$store_id];}
    if (isset($customisation_products["popup_small_status"][$store_id])) {$popup_small_status = $customisation_products["popup_small_status"][$store_id];}
}



foreach ($products as $product) :

    $loader->model('catalog/product');
    $model = $registry->get('model_catalog_product');
    $product_info = $model->getProduct($product['product_id']);

    $loader->model('tool/image');
    $model_resize = $registry->get('model_tool_image');



    if ($product_info['image']) {
        $image_qv = $model_resize->resize($product_info['image'], $width, $height);
        $image_qv_popup = $model_resize->resize($product_info['image'], $width_popup, $height_popup);
        $image2x = $model_resize->resize($product_info['image'], $width_settings*2, $height_settings*2);
    } else {
        $image_qv = $model_resize->resize('placeholder.png', $width, $height);
        $image_qv_popup = $model_resize->resize('placeholder.png', $width_popup, $height_popup);
        $image2x = $model_resize->resize('placeholder.png', $width_settings*2, $height_settings*2);
    }



    if ((float)$product_info['special']) {
        if (!isset($discount_status) || $discount_status != 0) {
            $discount = '<li><span class="label">-'.round((($product_info['price'] - $product_info['special'])/$product_info['price'])*100, 0).'%</span></li>';
        } else {$discount = false;}
    } else {
        $discount = false;
    }

    $additional_images = $model->getProductImages($product['product_id']);

    if ($additional_images){
        $first = true;
        $additional_images_size = array();

        foreach ($additional_images as $additional_image) {
            if ($first) {
                $popup = $model_resize->resize($additional_image['image'], $width_settings, $height_settings);
                $popup2x = $model_resize->resize($additional_image['image'], $width_settings*2, $height_settings*2);
                $first = false;
            }

            $additional_images_size[] = array(
                'small'   	 => $model_resize->resize($additional_image['image'], $config->get('config_image_additional_width'), $config->get('config_image_additional_height')),
                'big'   	 => $model_resize->resize($additional_image['image'], $config->get('config_image_popup_width'), $config->get('config_image_popup_height'))
            );

        }
    } else {
        $additional_images_size = 0;
    }

    /*special end date output*/
    $query_date = $db->query("SELECT date_end FROM ".DB_PREFIX."product_special WHERE product_id='".(int)$product_info['product_id']."'");
    if ($query_date->rows) {
        $special_end_date = $query_date->row["date_end"];
    } else {
        $special_end_date = false;
    }

    $full_description = strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8'));
    $product_description_short = (strlen($product_info['description']) > $limit ? utf8_substr($full_description, 0, $limit) . '...' : $full_description);
    /*special end date output*/

    ?>
<div class="item">
    <div class="product-preview">
        <!--preview block-->
        <div class="preview <?php echo ($additional_images ? 'hover-slide ' : ''); ?>animate scale">
            <a class="preview-image main-image-<?php echo $product['product_id']; ?>" href="<?php echo $product['href']; ?>" title="<?php echo $product['name']; ?>">
                <?php if ($product['thumb']) : ?>
                <?php if ($additional_images) { ?>
                    <img class="img-responsive animate scale" src="<?php echo $popup; ?>" data-image2x="<?php echo $popup2x; ?>" alt="<?php echo $product['name']; ?>" />
                    <img class="img-responsive first-main-image first-main-image-<?php echo $product['product_id']; ?> product-retina" src="<?php echo $product['thumb']; ?>" data-image2x="<?php echo $image2x; ?>" alt="<?php echo $product['name']; ?>" />
                    <?php } else { ?>
                    <img class="img-responsive animate scale first-main-image first-main-image-<?php echo $product['product_id']; ?> product-retina" src="<?php echo $product['thumb']; ?>" data-image2x="<?php echo $image2x; ?>" alt="<?php echo $product['name']; ?>" />
                    <?php } ?>
                <?php endif; ?>
            </a>

            <!--countdown box-->
            <?php include('catalog/view/theme/countdown.php'); ?>
            <!--end countdown box-->


            <?php if (!isset($new_status) || ($new_status != 0)) : ?>
            <?php
            $day_range = 10;
            if ($customisation_days == '') {
                $days = $day_range;
            } else {
                $days = $customisation_days;
            }
            $day_number_to_range = date( "Y-m-d" ,  strtotime("-$days day")  );
            if ($product_info['date_available'] >= $day_number_to_range) :
                ?>
                <ul class="product-controls-list">
                    <li><span class="label label-new"><?php echo (isset($new_text) ? $new_text : 'NEW'); ?>
</span></li>
                </ul>
                <?php endif; ?>
            <?php endif; ?>

            <ul class="product-controls-list right">
                <?php if ($product['special']) : ?>
                <?php if (!isset($sale_status) || ($sale_status != 0)) : ?>
                    <li><span class="label label-sale"><?php echo (isset($sale_text) ? $sale_text : 'SALE'); ?>
</span></li>
                    <?php endif; ?>
                <?php endif; ?>
                <?php echo $discount; ?>
            </ul>
            <ul class="product-controls-list right hide-right">
                <li class="top-out"></li>
                <li><a class="circle" onclick="wishlist_theme.add('<?php echo $product['product_id']; ?>');"><span class="icon-heart"></span></a></li>
                <li><a class="circle" onclick="compare_theme.add('<?php echo $product['product_id']; ?>');"><span class="icon-justice"></span></a></li>
                <?php if (!isset($product_catalog_mode) || $product_catalog_mode != 1) : ?>
                <li class="button_slider_cart">
                    <a onclick="cart_theme.add('<?php echo $product['product_id']; ?>');" class="cart" title="<?php echo $button_cart; ?>">
                        <span class="icon-basket"></span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>

            <?php if (!isset($popup_small_status) || $popup_small_status != 0) : ?>
            <!--full quick view block-->
            <?php include('catalog/view/theme/quick_view_'.$quick_type.'.php'); ?>
            <!--end full quick view block-->
            <?php endif; ?>

        </div>
        <!--end preview block-->

        <h3 class="title"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h3>

        <!--colors options-->
        <!--end colors options-->
        <?php if (!isset($product_catalog_mode) || $product_catalog_mode != 1) : ?>
        <?php if ($product['price']) : ?>
            <div class="price_block">
                <?php if (!$product['special']) { ?>
                <span class="price"><?php echo $product['price']; ?></span>
                <?php } else { ?>
                <span class="price-old price old"><?php echo $product['price']; ?></span>
                <span class="price-new price new"><?php echo $product['special']; ?></span>
                <?php } ?>
            </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
    <?php endforeach; ?>

<div class="line-divider"></div>

</div>


</section>