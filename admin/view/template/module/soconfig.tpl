<?php 
/******************************************************
 * @package	SO Theme Framework for Opencart 2.0.x
 * @author	http://www.magentech.com
 * @license	GNU General Public License
 * @copyright(C) 2008-2015 Magentech.com. All rights reserved.
*******************************************************/
?>

<?php echo $header; ?><?php echo $column_left; ?>

<?php 
    global $config;
	$template = $config->get('theme_default_directory');
	
	$logos = array(
		'left' => 'Left',
		'center'  => 'Center',
	);
	$layouts = array(
		'normal' => 'Responsive normal (960px)',
		'large'  => 'Responsive large (>1200px)',
		'fixed'  => 'No Responsive'
	);
	$fonts = array(
		'standard' => 'Standard',
		'google'  => 'Google Fonts',
	);
	
	$columns = array(
		'1' => '1 columns',
		'2' => '2 columns',
		'3' => '3 columns',
		'4' => '4 columns',
		'5' => '5 columns',
		'6' => '6 columns',
	);
	
	$secondimg = array(
		'1' => 'One image',
		'2' => 'Second images',
	);
	
	$refine_search = array(
		'0' => 'With images',
		'1' => 'Text only',
		'2' => 'Disable',
	);
	
	$devices = array(
		'md' => '<i class="fa fa-desktop"></i> Desktops',
		'sm' => '<i class="fa fa-tablet"></i> Tablets',
		'xs' => '<i class="fa fa-mobile"></i> Phones',
	);
	
	$fonts_normal = array(
		'inherit' => 'No Use',
		'Arial, Helvetica, sans-serif'  => 'Arial',
		'Verdana, Geneva, sans-serif'  => 'Verdana',
		'Georgia,Times New Roman, Times, serif'  => 'Georgia',
		'Impact, Arial, Helvetica, sans-serif'  => 'Impact',
		'Tahoma, Geneva, sans-serif'  => 'Tahoma',
		'Trebuchet MS, Arial, Helvetica, sans-serif'  => 'Trebuchet MS',
		'Arial Black, Gadget, sans-serif'  => 'Arial Black',
		'Times, Times New Roman, serif'  => 'Times',
		'Palatino Linotype, Book Antiqua, Palatino, serif'  => 'Palatino Linotype',
		'Lucida Sans Unicode, Lucida Grande", sans-serif'  => 'Lucida Sans Unicode',
		'MS Serif, New York, serif'  => 'MS Serif',
		'Comic Sans MS, cursive'  => 'Comic Sans MS',
		'Courier New, Courier, monospace'  => 'Courier New',
		'Lucida Console, Monaco, monospace'  => 'Lucida Console',
	);
	
	$themesColor = array(
		'red' => 'Red Color',
		'orange' => 'Orange Color',
		'blue' => 'Blue Color',
		'green' => 'Green Color',
		'cyan' => 'Cyan Color',
				
	);
	
	$layoutStyle = array(
		'full' => 'Full Layout',
		'boxed' => 'Boxed',
		'iframed' => 'Iframed',
		'rounded' => 'Rounded',
	);
	
	$content_bg_mode = array(
		'repeat' => 'Repeat',
		'no-repeat' => 'No-Repeat',
	);
	$content_attachment = array(
		'scroll' => 'Scroll',
		'fixed' => 'Fixed',
	);
	
	$categoryStyle = array(
		'1' => 'Opencart',
		'2' => 'Vertical',
		'3' => 'Horizontal',
		'4' => 'Horizontal 2',
	);
	
	$brands = array(
		'1' => 'Name',
		'2' => 'Logo',
		'3' => 'Logo width name',
	);


	$thumbnailPos = array(
		'bottom' => 'bottom',
		'left' => 'Left',
	);

	$zoommode = array(
		'basic' => 'Basic Zoom',
		'inner' => 'Inner Zoom',
		'lens' => 'Lens Zoom',
	);

	$tabs_position = array(
		'1' => 'Bottom vertical',
		'2' => 'Bottom horizontal',
		'3' => 'Collapsed in product description',
	);
	
	$toppanel_type = array(
		'1' => 'Clickable',
		'2' => 'Floating'
	);
	
?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
                <h1>Theme Control Panel</h1>
                <ul class="breadcrumb">
                    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                    <?php } ?>
                </ul>
				<div class="pull-right">
					<a onclick="buttonApply();" data-toggle="tooltip" title="Apply Changes" class="btn btn-success"><i class="fa fa-check"></i> Save & Stay</a>
					<button type="submit" form="form-optimus" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
					<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-close"></i></a>
				</div>
        </div>
    </div>

    <div class="container-fluid">
        <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <?php if ($success) { ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-brand">SO Theme Config <span class="label label-default" style="font-weight:normal"> <?php echo $theme_version; ?></span></h3>
				<div class="pull-right"style="margin:-6px">
					<a class="products_button label-default" href="<?php echo $mproduct; ?>" data-toggle="tooltip" data-original-title="Additional Product Options" target="_blank"> <i class="fa fa-plus-circle"></i>  Products Options</a>
					 <a class="products_button label-default" href="<?php echo $mcategory; ?>" data-toggle="tooltip" data-original-title="Additional Categories Options" target="_blank"><i class="fa fa-plus-circle"></i> Categories Options</a>
					<a class="products_button btn-info" href="#"> <i class="fa fa-question-circle"></i> Help</a>
				</div>
            </div>
            <div class="panel-body">
                <form name="settingsform" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-optimus" class="form-horizontal">

                <div class="form-horizontal row">
                    <ul class="nav nav-tabs main_tabs_vertical store_tabs col-sm-2">
                        <li class="active"><a href="#tab-store0" data-toggle="tab">Default Store</a></li>
                        <?php if (sizeof($stores) != 0) : ?>
                            <?php foreach ($stores as $store) : ?>
                                <li><a href="#tab-store<?php echo $store['store_id']; ?>" data-toggle="tab"><?php echo $store["name"]; ?></a></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                    <div class="tab-content col-sm-10">
                        <div class="tab-pane active" id="tab-store0">
                            <?php $store["store_id"] = 0; ?>
                            <?php include('options_stores_default.php'); ?>
                        </div>
                        <?php if (sizeof($stores) != 0) : ?>
                            <?php foreach ($stores as $store) : ?>
                                <div class="tab-pane" id="tab-store<?php echo $store['store_id']; ?>">
                                    <?php include('options_stores.php'); ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                </div>


                <input name="buttonForm" type="hidden"  value="" />
                </form>


            </div>
        </div>

    </div>

</div>


<script type="text/javascript"><!--
$(document).ready(function(){

    /* initialisation of store 0 default */
    <?php foreach ($languages as $language) : ?>
    $('#input-description-customblock<?php echo $language['language_id']; ?>-0').summernote({height: 150});
    $('#input-description-footer_socials<?php echo $language['language_id']; ?>-0').summernote({height: 150});
    $('#input-description-footerpayment<?php echo $language['language_id']; ?>-0').summernote({height: 100});
    $('#input-description-custom_block1_content<?php echo $language['language_id']; ?>-0').summernote({height: 150});
    $('#input-description-custom_block2_content<?php echo $language['language_id']; ?>-0').summernote({height: 150});
    $('#input-description-slide_video<?php echo $language['language_id']; ?>-0').summernote({height: 150});
    $('#input-description-slide_custom<?php echo $language['language_id']; ?>-0').summernote({height: 150});
    <?php endforeach; ?>


	jQuery("#soconfig_colors_bgcolor0").ColorPicker({
		color: jQuery('#soconfig_colors_bgcolor0').val(),
			onShow: function (colpkr) {
		jQuery(colpkr).fadeIn(500);
		return false;
		},
		onHide: function (colpkr) {
			jQuery(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#soconfig_colors_bgcolor0').css('backgroundColor', '#' + hex);
			jQuery('#soconfig_colors_bgcolor0').val('#' + hex);
		}
	});


	/* end initialisation of store 0 default */

    /* stores */
    <?php if (sizeof($stores) != 0) : ?>
    <?php foreach ($stores as $store) : ?>

	jQuery("#soconfig_colors_bgcolor<?php echo $store['store_id']; ?>").ColorPicker({
        color: jQuery('#soconfig_colors_bgcolor<?php echo $store['store_id']; ?>').val(),
        onShow: function (colpkr) {
            jQuery(colpkr).fadeIn(500);
            return false;
        },
        onHide: function (colpkr) {
            jQuery(colpkr).fadeOut(500);
            return false;
        },
        onChange: function (hsb, hex, rgb) {
            jQuery('#soconfig_colors_bgcolor<?php echo $store['store_id']; ?>').css('backgroundColor', '#' + hex);
            jQuery('#soconfig_colors_bgcolor<?php echo $store['store_id']; ?>').val('#' + hex);
        }
    });
    /**************************************************** initialisation for multstore options begin */
    
    /* end initialisation for multstore options begin */

    <?php foreach ($languages as $language) : ?>
    $('#input-description-contactpopup<?php echo $language['language_id']; ?>-<?php echo $store['store_id']; ?>').summernote({height: 300});
    $('#input-description-customblock<?php echo $language['language_id']; ?>-<?php echo $store['store_id']; ?>').summernote({height: 150});
    $('#input-description-footer_socials<?php echo $language['language_id']; ?>-<?php echo $store['store_id']; ?>').summernote({height: 150});
    $('#input-description-footerpayment<?php echo $language['language_id']; ?>-<?php echo $store['store_id']; ?>').summernote({height: 150});
    $('#input-description-custom_block1_content<?php echo $language['language_id']; ?>-<?php echo $store['store_id']; ?>').summernote({height: 150});
    $('#input-description-custom_block2_content<?php echo $language['language_id']; ?>-<?php echo $store['store_id']; ?>').summernote({height: 150});
    $('#input-description-slide_video<?php echo $language['language_id']; ?>-<?php echo $store['store_id']; ?>').summernote({height: 150});
    $('#input-description-slide_custom<?php echo $language['language_id']; ?>-<?php echo $store['store_id']; ?>').summernote({height: 150});
    <?php endforeach; ?>


    <?php endforeach; ?>
    <?php endif; ?>

    /* end stores */

});

function buttonApply() {document.settingsform.buttonForm.value='apply'; $('#form-optimus').submit();}
function installMegamenu() { 
    if (confirm("Are you sure you want to install sample data?") == true) {
        document.settingsform.buttonForm.value='mega'; $('#form-optimus').submit();
    }
	
}
//--></script>

<?php echo $footer; ?>