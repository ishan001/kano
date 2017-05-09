<?php 
/******************************************************
 * @package	SO Theme Framework for Opencart 2.0.x
 * @author	http://www.magentech.com
 * @license	GNU General Public License
 * @copyright(C) 2008-2015 Magentech.com. All rights reserved.
*******************************************************/


?>

<ul class="nav nav-tabs main_tabs">
    <li class="<?php echo ($store['store_id'] == 0 ? 'active' : ''); ?>"><a href="#tab-general<?php echo $store['store_id']; ?>" data-toggle="tab"><?php echo $maintabs_general; ?></a></li>
    <li><a href="#tab-layout<?php echo $store['store_id']; ?>" data-toggle="tab"><?php echo $maintabs_layout; ?></a></li>
    <li><a href="#tab-products<?php echo $store['store_id']; ?>" data-toggle="tab"><?php echo $maintabs_products; ?></a></li>
    <li><a href="#tab-fonts<?php echo $store['store_id']; ?>" data-toggle="tab"><?php echo $maintabs_fonts; ?></a></li>
    <li><a href="#tab-slide<?php echo $store['store_id']; ?>" data-toggle="tab"><?php echo $maintabs_social; ?></a></li>
    <li><a href="#tab-custom<?php echo $store['store_id']; ?>" data-toggle="tab"><?php echo $maintabs_custom; ?></a></li>
	<li><a href="#tab-sampledata<?php echo $store['store_id']; ?>" data-toggle="tab"><?php echo $maintabs_sampledata; ?></a></li>
</ul>
<div class="tab-content">
    <!-------------------------------------Tab General---------------------------------->
    <div class="tab-pane active" id="tab-general<?php echo $store['store_id']; ?>">
        <ul class="nav nav-tabs  main_tabs_2 ">
            <li class="<?php echo ($store['store_id'] == 0 ? 'active' : ''); ?>"><a href="#tab-general-layout1-<?php echo $store['store_id']; ?>" class="selected" data-toggle="tab"><?php echo $general_tab_general; ?></a></li>
            <li><a href="#tab-general-layout2-<?php echo $store['store_id']; ?>" data-toggle="tab"><?php echo $general_tab_header; ?></a></li>
            <li><a href="#tab-general-layout3-<?php echo $store['store_id']; ?>" data-toggle="tab"><?php echo $general_tab_footer; ?> </a></li>
			<li><a href="#tab-general-layout4-<?php echo $store['store_id']; ?>" data-toggle="tab"><?php echo $general_tab_language; ?></a></li>
        </ul>

        <div class="tab-content ">
			<?php // General  Blocks--------------------------------------------- ?>
            <div class="tab-pane active" id="tab-general-layout1-<?php echo $store['store_id']; ?>">
				<div class="so-panel">
					<h3 class="panel-title">General</h3>
					<div class="panel-container">
						
						<div class="form-group">
							<label class="col-sm-2 control-label" >Themes Color</label>
							<div class="col-sm-3">
								<select name="soconfig_general[themecolor]" class="form-control">
									<?php foreach ($themesColor as $fv => $fc) { ?>
										<?php ($fv == $soconfig_general["themecolor"] ) ? $current = 'selected' : $current=''; ?>
										<option value="<?php echo $fv; ?>" <?php echo $current; ?> ><?php echo $fc; ?></option>	
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" ><?php echo $general_res_layout; ?> </label>
							<div class="col-sm-10">
								<div class="btn-group btn-toggle" data-toggle="buttons">
									<label class="btn btn-default btn-sm <?php if ($soconfig_general["layouts"] == 1): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_general[layouts]" value="1" <?php if ($soconfig_general["layouts"] == 1): ?> checked="checked"<?php endif; ?>>ON
									</label>
									<label class="btn btn-default btn-sm <?php if ($soconfig_general["layouts"] == 0): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_general[layouts]" value="0" <?php if ($soconfig_general["layouts"] == 0): ?> checked="checked"<?php endif; ?>>OFF
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" ><?php echo $general_cpanel; ?> </label>
							<div class="col-sm-10">
								<div class="btn-group btn-toggle" data-toggle="buttons">
									<label class="btn btn-default btn-sm <?php if ($soconfig_general["cpanel"] == 1): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_general[cpanel]" value="1" <?php if ($soconfig_general["cpanel"] == 1): ?> checked="checked"<?php endif; ?>>ON
									</label>
									<label class="btn btn-default btn-sm <?php if ($soconfig_general["cpanel"] == 0): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_general[cpanel]" value="0" <?php if ($soconfig_general["cpanel"] == 0): ?> checked="checked"<?php endif; ?>>OFF
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" ><?php echo $general_back_top; ?> </label>
							<div class="col-sm-10">
								<div class="btn-group btn-toggle" data-toggle="buttons">
									<label class="btn btn-default btn-sm <?php if ($soconfig_general["backtop"] == 1): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_general[backtop]" value="1" <?php if ($soconfig_general["backtop"] == 1): ?> checked="checked"<?php endif; ?>>ON
									</label>
									<label class="btn btn-default btn-sm <?php if ($soconfig_general["backtop"] == 0): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_general[backtop]" value="0" <?php if ($soconfig_general["backtop"] == 0): ?> checked="checked"<?php endif; ?>>OFF
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">
								<span data-toggle="tooltip" title="Lazy Load is delays loading of images in long web pages">Lazy Loader</span>
							</label>
							<div class="col-sm-10">
								<div class="btn-group btn-toggle" data-toggle="buttons">
									<label class="btn btn-default btn-sm <?php if ($soconfig_general["scroll_animation"] == 1): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_general[scroll_animation]" value="1" <?php if ($soconfig_general["scroll_animation"] == 1): ?> checked="checked"<?php endif; ?>>ON
									</label>
									<label class="btn btn-default btn-sm <?php if ($soconfig_general["scroll_animation"] == 0): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_general[scroll_animation]" value="0" <?php if ($soconfig_general["scroll_animation"] == 0): ?> checked="checked"<?php endif; ?>>OFF
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">  <?php echo $general_copyright; ?>  </label>
							<div class="col-sm-4">
								<input type="text" name="soconfig_general[copyright]" value="<?php echo $soconfig_general["copyright"]; ?>" placeholder="Footer copyright content" id="meta-title<?php echo $store["store_id"]; ?>" class="form-control" />
							</div>
						</div>
					</div>
                </div>
            </div>
           

			<?php // Header  Blocks--------------------------------------------- ?>
            <div id="tab-general-layout2-<?php echo $store['store_id']; ?>" class="tab-pane">
			
			
			<div class="so-panel">
				<h3 class="panel-title">Top Panel</h3>
				<div class="panel-container">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="logo_position<?php echo $store["store_id"]; ?>">
							Status:
						</label>
						<div class="col-sm-10">
							<div class="btn-group btn-toggle" data-toggle="buttons">
								<label class="btn btn-default btn-sm <?php if ($soconfig_general["toppanel_status"] == 1): ?>btn-success active <?php endif; ?>">
									<input type="radio" name="soconfig_general[toppanel_status]" value="1" <?php if ($soconfig_general["toppanel_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
								</label>
								<label class="btn btn-default btn-sm <?php if ($soconfig_general["toppanel_status"] == 0): ?>btn-success active <?php endif; ?>">
									<input type="radio" name="soconfig_general[toppanel_status]" value="0" <?php if ($soconfig_general["toppanel_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
								</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" >
							Type:
						</label>
						<div class="col-sm-10">
							
							<select name="soconfig_general[toppanel_type]" id="toppanel_type<?php echo $store["store_id"]; ?>" class="form-control width15">
								<?php foreach ($toppanel_type as $fv => $fc) { ?>
									<?php ($fv ==  $soconfig_general["toppanel_type"]) ? $current = 'selected' : $current='2'; ?>
									<option value="<?php echo $fv; ?>" <?php echo $current; ?> ><?php echo $fc; ?></option>	
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">
							<span data-toggle="tooltip" title="Upload image in path: image/catalog/ and write the name here">Image (Top panel):</span>
						</label>
						<div class="col-sm-9">
							<?php if (!isset($store['store_id']) || $store['store_id'] == 0) { ?>
								<a href="" id="thumb-toppanel" data-toggle="image" class="img-thumbnail">
									<img src="<?php echo $rightimg; ?>" alt="" title="" data-placeholder="Background Image:" />
								</a>
								<input type="hidden" name="soconfig_toppanel" value="<?php echo $soconfig_toppanel; ?>" id="input-toppanel" />
							<?php } else { ?>
								<div>
									<div class="help-block">Upload image in path: catalog/ and write here only name as "image.png"</div>
									<input type="text" name="soconfig_general_store[<?php echo $store["store_id"]; ?>][soconfig_toppanel]"   value="<?php echo (isset($soconfig_general_store[$store['store_id']]['soconfig_toppanel'])   ? $soconfig_general_store[$store['store_id']]['soconfig_toppanel']   : ''); ?>" placeholder="Background image" id="toppanel<?php echo $store["store_id"]; ?>" class="form-control width30" />
								</div>
							<?php } ?>
						</div>
					</div>
                </div>
			</div>	
			
			<div class="so-panel">	
				<h3 class="panel-title">Top Bar</h3>
				<div class="panel-container">
					<div class="form-group">
						<label class="col-sm-2 control-label">Telephone No</label>
						<div class="col-sm-2" id="soconfig_general_headerspy_container">
							<div class="btn-group btn-toggle" data-toggle="buttons">
								<label class="btn btn-default btn-sm <?php if ($soconfig_general["phone_status"] == 1): ?>btn-success active <?php endif; ?>">
									<input type="radio" name="soconfig_general[phone_status]" value="1" <?php if ($soconfig_general["phone_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
								</label>
								<label class="btn btn-default btn-sm <?php if ($soconfig_general["phone_status"] == 0): ?>btn-success active <?php endif; ?>">
									<input type="radio" name="soconfig_general[phone_status]" value="0" <?php if ($soconfig_general["phone_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
								</label>
							</div>
						</div>
						<div class="col-sm-8" >
							<div class="tab-horizontal">
								<ul class="nav nav-tabs main_tabs_horizontal">
									<?php foreach ($languages as $language) : ?>
									<li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#language-contact_number<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
									<?php endforeach; ?>
								</ul>
								<div class="tab-content">
									<?php foreach ($languages as $language) : ?>
									<div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="language-contact_number<?php echo $language['language_id']; ?>">
										<input type="text" name="soconfig_general[<?php echo $language['language_id']; ?>][contact_number]" value="<?php echo isset($soconfig_general[$language['language_id']]['contact_number']) ? $soconfig_general[$language['language_id']]['contact_number'] : ''; ?>" id="name-contact_number<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>" class="form-control" />
									</div>
									<?php endforeach; ?>
								</div>
							</div>	
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Welcome Message</label>
						<div class="col-sm-2" >
							<div class="btn-group btn-toggle" data-toggle="buttons">
								<label class="btn btn-default btn-sm <?php if ($soconfig_general["welcome_message_status"] == 1): ?>btn-success active <?php endif; ?>">
									<input type="radio" name="soconfig_general[welcome_message_status]" value="1" <?php if ($soconfig_general["welcome_message_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
								</label>
								<label class="btn btn-default btn-sm <?php if ($soconfig_general["welcome_message_status"] == 0): ?>btn-success active <?php endif; ?>">
									<input type="radio" name="soconfig_general[welcome_message_status]" value="0" <?php if ($soconfig_general["welcome_message_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
								</label>
							</div>
						
						</div>
						<div class="col-sm-8" >
							<div class="tab-horizontal">
								<ul class="nav nav-tabs main_tabs_horizontal" >
									<?php foreach ($languages as $language) : ?>
									<li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#language-welcome_message<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
									<?php endforeach; ?>
								</ul>
								<div class="tab-content">
									<?php foreach ($languages as $language) : ?>
									<div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="language-welcome_message<?php echo $language['language_id']; ?>">
										<input type="text" name="soconfig_general[<?php echo $language['language_id']; ?>][welcome_message]" value="<?php echo isset($soconfig_general[$language['language_id']]['welcome_message']) ? $soconfig_general[$language['language_id']]['welcome_message'] : ''; ?>" id="name-welcome_message<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>" class="form-control" />
									</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Wishlist Link</label>
						<div class="col-sm-3" >
							<div class="btn-group btn-toggle" data-toggle="buttons">
								<label class="btn btn-default btn-sm <?php if ($soconfig_general["wishlist_status"] == 1): ?>btn-success active <?php endif; ?>">
									<input type="radio" name="soconfig_general[wishlist_status]" value="1" <?php if ($soconfig_general["wishlist_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
								</label>
								<label class="btn btn-default btn-sm <?php if ($soconfig_general["wishlist_status"] == 0): ?>btn-success active <?php endif; ?>">
									<input type="radio" name="soconfig_general[wishlist_status]" value="0" <?php if ($soconfig_general["wishlist_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
								</label>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Checkout Link</label>
						<div class="col-sm-3" >
							<div class="btn-group btn-toggle" data-toggle="buttons">
								<label class="btn btn-default btn-sm <?php if ($soconfig_general["checkout_status"] == 1): ?>btn-success active <?php endif; ?>">
									<input type="radio" name="soconfig_general[checkout_status]" value="1" <?php if ($soconfig_general["checkout_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
								</label>
								<label class="btn btn-default btn-sm <?php if ($soconfig_general["checkout_status"] == 0): ?>btn-success active <?php endif; ?>">
									<input type="radio" name="soconfig_general[checkout_status]" value="0" <?php if ($soconfig_general["checkout_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
								</label>
							</div>
						</div>
					</div>
					
					<div class="form-group last">
						<label class="col-sm-2 control-label">Language/Currency Title</label>
						<div class="col-sm-3" >
							<div class="btn-group btn-toggle" data-toggle="buttons">
								<label class="btn btn-default btn-sm <?php if ($soconfig_general["lang_status"] == 1): ?>btn-success active <?php endif; ?>">
									<input type="radio" name="soconfig_general[lang_status]" value="1" <?php if ($soconfig_general["lang_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
								</label>
								<label class="btn btn-default btn-sm <?php if ($soconfig_general["lang_status"] == 0): ?>btn-success active <?php endif; ?>">
									<input type="radio" name="soconfig_general[lang_status]" value="0" <?php if ($soconfig_general["lang_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
								</label>
							</div>
						</div>
					</div>
				</div>
            </div>
			
            </div>

			
			<?php // Footer Blocks ----------------------------------------------- ?>
            <div id="tab-general-layout3-<?php echo $store['store_id']; ?>" class="tab-pane">
				
				<div class="so-panel">
					<h3 class="panel-title">Payment Block</h3>
					<div class="panel-container">
						<div class="form-group">
							<label class="col-sm-3 control-label" > Status: </label>
							<div class="col-sm-9">
								<div class="margin-bot1x btn-group btn-toggle" data-toggle="buttons">
									<label class="btn btn-default btn-sm <?php if ($soconfig_general["imgpayment_status"] == 1): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_general[imgpayment_status]" value="1" <?php if ($soconfig_general["imgpayment_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
									</label>
									<label class="btn btn-default btn-sm <?php if ($soconfig_general["imgpayment_status"] == 0): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_general[imgpayment_status]" value="0" <?php if ($soconfig_general["imgpayment_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" >
								<span data-toggle="tooltip" title="Edit content here Footer Custom Block.">
									Image (Payment block):
								</span>
							</label>
							<div class="col-sm-9">
								<?php if (!isset($store['store_id']) || $store['store_id'] == 0) { ?>
									<a href="" id="thumb-imgpayment" data-toggle="image" class="img-thumbnail">
										<img src="<?php echo $imgpayment; ?>" alt="" title="" data-placeholder="Background Image:" />
									</a>
									<input type="hidden" name="soconfig_imgpayment" value="<?php echo $soconfig_imgpayment; ?>" id="input-imgpayment" />
								<?php } else { ?>
									<div>
										<div class="help-block">Upload image in path: catalog/ and write here only name as "image.png"</div>
										<input type="text" name="soconfig_general_store[<?php echo $store["store_id"]; ?>][soconfig_imgpayment]" value="<?php echo (isset($soconfig_general_store[$store['store_id']]['soconfig_imgpayment']) ? $soconfig_general_store[$store['store_id']]['soconfig_imgpayment'] : ''); ?>" placeholder="Background image" id="toppanel<?php echo $store["store_id"]; ?>" class="form-control" />
									</div>
								<?php } ?>
							</div>
						</div>
						
					</div>
				</div>
				
				<div class="so-panel">
					<h3 class="panel-title">Custom Block 1</h3>
					<div class="panel-container">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="name-footer_socials_title<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>">
								 <span data-toggle="tooltip" title="Set On/Off for Custom Block 1">
									Status:
								 </span>
							</label>
							<div class="col-sm-9">
								<div class="margin-bot1x btn-group btn-toggle" data-toggle="buttons">
									<label class="btn btn-default btn-sm <?php if ($soconfig_general["socials_status"] == 1): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_general[socials_status]" value="1" <?php if ($soconfig_general["socials_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
									</label>
									<label class="btn btn-default btn-sm <?php if ($soconfig_general["socials_status"] == 0): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_general[socials_status]" value="0" <?php if ($soconfig_general["socials_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" >
								<span data-toggle="tooltip" title="Edit content here Footer Custom Block">
									Content :
								</span>
							</label>
							<div class="col-sm-9">
								
								<ul class="nav nav-tabs" id="language-footer_socials_title">
									<?php foreach ($languages as $language) : ?>
									<li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#language-footer_socials_title<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
									<?php endforeach; ?>
								</ul>
								<div class="tab-content">
									<?php foreach ($languages as $language) : ?>
									<div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="language-footer_socials_title<?php echo $language['language_id']; ?>">
										<textarea name="soconfig_general[<?php echo $language['language_id']; ?>][footer_socials]" placeholder="Footer Social Block content" id="input-description-footer_socials<?php echo $language['language_id']; ?>-<?php echo $store['store_id']; ?>"><?php echo isset($soconfig_general[$language['language_id']]['footer_socials']) ? $soconfig_general[$language['language_id']]['footer_socials'] : ''; ?></textarea>
									</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
						
					</div>
				</div>
				
				<div class="so-panel">
					<h3 class="panel-title">Custom Block 2</h3>
					<div class="panel-container">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="name-footer_socials_title<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>">
								 <span data-toggle="tooltip" title="Set On/Off for Custom Block 2">
									Status:
								 </span>
							</label>
							<div class="col-sm-9">
								<div class="btn-group btn-toggle margin-bot1x" data-toggle="buttons">
									<label class="btn btn-default btn-sm <?php if ($soconfig_general["footerpayment_status"] == 1): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_general[footerpayment_status]" value="1" <?php if ($soconfig_general["footerpayment_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
									</label>
									<label class="btn btn-default btn-sm <?php if ($soconfig_general["footerpayment_status"] == 0): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_general[footerpayment_status]" value="0" <?php if ($soconfig_general["footerpayment_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">
								<span data-toggle="tooltip" title="Edit content here Footer Custom Block">
									Content:
								</span>
							</label>
							<div class="col-sm-9">
								<ul class="nav nav-tabs" id="language-custom_html_title">
									<?php foreach ($languages as $language) : ?>
									<li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#language-footerpayment_title<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
									<?php endforeach; ?>
								</ul>
								<div class="tab-content">
									<?php foreach ($languages as $language) : ?>
									<div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="language-footerpayment_title<?php echo $language['language_id']; ?>">
										<textarea name="soconfig_general[<?php echo $language['language_id']; ?>][footerpayment_html]" placeholder="Custom footer block content" id="input-description-footerpayment<?php echo $language['language_id']; ?>-<?php echo $store['store_id']; ?>"><?php echo isset($soconfig_general[$language['language_id']]['footerpayment_html']) ? $soconfig_general[$language['language_id']]['footerpayment_html'] : ''; ?></textarea>
									</div>
									<?php endforeach; ?>
								</div>
								
							</div>
						</div>
					</div>
				</div>
				
				<div class="so-panel">
					<h3 class="panel-title">Custom Block 3</h3>
					<div class="panel-container">
						<div class="form-group">
							<label class="col-sm-3 control-label">
								<span data-toggle="tooltip" title="Set title for Footer Custom Block.">
									status:
								</span>
							</label>
							<div class="col-sm-9">
								<div class="btn-group btn-toggle top1x" data-toggle="buttons">
									<label class="btn btn-default btn-sm <?php if ($soconfig_general["customblock_status"] == 1): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_general[customblock_status]" value="1" <?php if ($soconfig_general["customblock_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
									</label>
									<label class="btn btn-default btn-sm <?php if ($soconfig_general["customblock_status"] == 0): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_general[customblock_status]" value="0" <?php if ($soconfig_general["customblock_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
									</label>
								</div>
								
							</div>
						</div>
							
						
						<div class="form-group">
							<label class="col-sm-3 control-label" >
								<span data-toggle="tooltip" title="Edit content here Footer Custom Block">
									Content:
								</span>
							</label>
							<div class="col-sm-9">
								<ul class="nav nav-tabs" id="language-custom_html_title">
									<?php foreach ($languages as $language) : ?>
									<li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#language-custom_html_title<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
									<?php endforeach; ?>
								</ul>
								<div class="tab-content">
									<?php foreach ($languages as $language) : ?>
									<div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="language-custom_html_title<?php echo $language['language_id']; ?>">
										<textarea name="soconfig_general[<?php echo $language['language_id']; ?>][customblock_html]" placeholder="Custom footer block content" id="input-description-customblock<?php echo $language['language_id']; ?>-<?php echo $store['store_id']; ?>"><?php echo isset($soconfig_general[$language['language_id']]['customblock_html']) ? $soconfig_general[$language['language_id']]['customblock_html'] : ''; ?></textarea>
									</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
						
					</div>
				</div>
            
            </div>
            
			
			<!--Some language variables-->
            <div id="tab-general-layout4-<?php echo $store['store_id']; ?>" class="tab-pane">
                <div class="so-panel">
					<h3 class="panel-title">Other Block</h3>
					<div class="panel-container">
						<span class="help-block">Keep in mind, if you leave some field empty corresponding block will not be displayed.</span>
						<ul class="nav nav-tabs" id="translation">
							<?php foreach ($languages as $language) : ?>
							<li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#translation<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
							<?php endforeach; ?>
						</ul>
						<div class="tab-content">
							<?php foreach ($languages as $language) : ?>
							<div style="padding:0" class="tab-pane panel-container <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="translation<?php echo $language['language_id']; ?>">
								
								<div class="form-group">
									<label class="col-sm-4 control-label" for="view_details<?php echo $store["store_id"]; ?>">"Todays Deals" title in category page:</label>
									<div class="col-sm-7">
										<input type="text" name="soconfig_lang[<?php echo $language['language_id']; ?>][view_details]" value="<?php echo (isset($soconfig_lang[$language['language_id']]['view_details']) ? $soconfig_lang[$language['language_id']]['view_details'] : ''); ?>" placeholder="'view details' button" id="view_details<?php echo $store["store_id"]; ?>" class="form-control" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="tags_tab_title<?php echo $store["store_id"]; ?>">"tags" tab title on Product page:</label>
									<div class="col-sm-7">
										<input type="text" name="soconfig_lang[<?php echo $language['language_id']; ?>][tags_tab_title]" value="<?php echo (isset($soconfig_lang[$language['language_id']]['tags_tab_title']) ? $soconfig_lang[$language['language_id']]['tags_tab_title'] : ''); ?>" placeholder="'tags' tab" id="tags_tab_title<?php echo $store["store_id"]; ?>" class="form-control" />
									</div>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
				
				<div class="so-panel">
					<h3 class="panel-title">Countdown block</h3>
					<div class="panel-container">
						<span class="help-block">Keep in mind, if you leave some field empty corresponding block will not be displayed.</span>
						<ul class="nav nav-tabs" id="translation">
							<?php foreach ($languages as $language) : ?>
							<li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#translation_countdown_<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
							<?php endforeach; ?>
						</ul>
						<div class="tab-content">
							<?php foreach ($languages as $language) : ?>
							<div style="padding:0" class="tab-pane panel-container <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="translation_countdown_<?php echo $language['language_id']; ?>">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="countdown_title<?php echo $store["store_id"]; ?>">Title:</label>
									<div class="col-sm-7">
										<input type="text" name="soconfig_lang[<?php echo $language['language_id']; ?>][countdown_title]" value="<?php echo isset($soconfig_lang[$language['language_id']]['countdown_title']) ? $soconfig_lang[$language['language_id']]['countdown_title'] : ''; ?>" placeholder="This limited  offer ends" id="countdown_title<?php echo $store["store_id"]; ?>" class="form-control" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="countdown_title_day<?php echo $store["store_id"]; ?>">"Day" title:</label>
									<div class="col-sm-7">
										<input type="text" name="soconfig_lang[<?php echo $language['language_id']; ?>][countdown_title_day]" value="<?php echo isset($soconfig_lang[$language['language_id']]['countdown_title_day']) ? $soconfig_lang[$language['language_id']]['countdown_title_day'] : ''; ?>" placeholder="Day" id="countdown_title_day<?php echo $store["store_id"]; ?>" class="form-control" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="countdown_title_hour<?php echo $store["store_id"]; ?>">"Hour" title:</label>
									<div class="col-sm-7">
										<input type="text" name="soconfig_lang[<?php echo $language['language_id']; ?>][countdown_title_hour]" value="<?php echo isset($soconfig_lang[$language['language_id']]['countdown_title_hour']) ? $soconfig_lang[$language['language_id']]['countdown_title_hour'] : ''; ?>" placeholder="Hour" id="countdown_title_hour<?php echo $store["store_id"]; ?>" class="form-control" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="countdown_title_minute<?php echo $store["store_id"]; ?>">"Minute" title:</label>
									<div class="col-sm-7">
										<input type="text" name="soconfig_lang[<?php echo $language['language_id']; ?>][countdown_title_minute]" value="<?php echo isset($soconfig_lang[$language['language_id']]['countdown_title_minute']) ? $soconfig_lang[$language['language_id']]['countdown_title_minute'] : ''; ?>" placeholder="Minute" id="countdown_title_minute<?php echo $store["store_id"]; ?>" class="form-control" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="countdown_title_second<?php echo $store["store_id"]; ?>">"Second" title:</label>
									<div class="col-sm-7">
										<input type="text" name="soconfig_lang[<?php echo $language['language_id']; ?>][countdown_title_second]" value="<?php echo isset($soconfig_lang[$language['language_id']]['countdown_title_second']) ? $soconfig_lang[$language['language_id']]['countdown_title_second'] : ''; ?>" placeholder="Second" id="countdown_title_second<?php echo $store["store_id"]; ?>" class="form-control" />
									</div>
								</div>

							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>


            </div>
            <!--end Some language variables-->
        </div>
    </div>
    <!-------------------------------------end tab General---------------------------------->

    <!-------------------------------------Tab Layout---------------------------------------->
    <div class="tab-pane" id="tab-layout<?php echo $store['store_id']; ?>">
		<!--subtabs: General -->
		<div class="tab-pane active" id="tab-colors-layout1-<?php echo $store['store_id']; ?>">
			<div class="so-panel">
				<h3 class="panel-title">Theme Layout Settings</h3>
				<div class="panel-container">
					<div class="form-group">
						<label class="col-sm-3 control-label" >
							<span data-toggle="tooltip" title="With the boxed layout you can choose additional options such as custom background images, patterns and solid colors">Layout Style</span>
						</label>
						<div class="col-sm-9">
							<div class="btn-group btn-toggle block-group " data-toggle="buttons">
								<select name="soconfig_layout[layoutstyle]" class="form-control">
								<?php foreach ($layoutStyle as $fv => $fc) { ?>
									<?php ($fv == $soconfig_layout["layoutstyle"] ) ? $current = 'selected' : $current='4'; ?>
									<option value="<?php echo $fv; ?>" <?php echo $current; ?> ><?php echo $fc; ?></option>	
								<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" ">
							 <span data-toggle="tooltip" title="Set background color for all content.">Body Background Color:</span>
						</label>
						<div class="col-sm-9">
							<input class="form-control width30" id="soconfig_colors_bgcolor<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $soconfig_layout['general_bgcolor']; ?>;color:white" type="text" name="soconfig_layout[general_bgcolor]" value="<?php echo $soconfig_layout['general_bgcolor']; ?>" placeholder="Background color:" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label" >Overlay pattern</label>
						<div class="col-sm-9">
							<?php for ($i = 1; $i <= 45; $i++) { ?>
								<div class="img-patt"><small><?php echo $i; ?></small><img src="../catalog/view/theme/<?php echo $template;?>/images/patterns/<?php echo $i; ?>.png" alt="pattern <?php echo $i; ?>"></div>
							<?php } ?>
						  
							<select class="form-control width30" name="soconfig_layout[pattern]" >
								<option value="none"selected="selected">None</option>
								<?php 
									for ($i = 1; $i <= 45; $i++) { 
										
									($soconfig_layout["pattern"]== $i) ? $currentpat = 'selected' : $currentpat = '';
								?>
								<option value="<?php echo $i; ?>" <?php echo $currentpat; ?>><?php echo $i; ?></option>
								<?php } ?>
							</select>
							<small class="help-block">Select a pattern number if you want to use one.</small>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">
							<span data-toggle="tooltip" title="Set background image for all site.">Background Image:</span>
						</label>
						<div class="col-sm-9">
							<?php if (!isset($store['store_id']) || $store['store_id'] == 0) { ?>
								<a href="" id="thumb-contentbg" data-toggle="image" class="img-thumbnail">
									<img src="<?php echo $contentbg; ?>" alt="" title="" data-placeholder="Background Image:" />
								</a>
								<input type="hidden" name="soconfig_contentbg" value="<?php echo $soconfig_contentbg; ?>" id="input-contentbg" />
							<?php } else { ?>
								<div>
									<div class="help-block">Upload image in path: catalog/ and write here only name as "image.png"</div>
								<input type="text" name="soconfig_layout_store[<?php echo $store["store_id"]; ?>][soconfig_contentbg]" value="<?php echo (isset($soconfig_layout_store[$store['store_id']]['soconfig_contentbg']) ? $soconfig_layout_store[$store['store_id']]['soconfig_contentbg'] : ''); ?>" placeholder="Background image" id="contentbg<?php echo $store["store_id"]; ?>" class="form-control width30" />
								</div>
							<?php } ?>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" >
							 <span data-toggle="tooltip" title="Set background image display mode">
								 Background Image display mode
							 </span>
						</label>
						<div class="col-sm-9">
							<select name="soconfig_layout[content_bg_mode]" id="content_bg_mode<?php echo $store["store_id"]; ?>" class="form-control width30">
								<option <?php if (isset($soconfig_layout['content_bg_mode']) && $soconfig_layout['content_bg_mode'] == 'repeat') : ?> selected="selected" <?php endif; ?> value="repeat">Repeat</option>
								<option <?php if (isset($soconfig_layout['content_bg_mode']) && $soconfig_layout['content_bg_mode'] == 'no-repeat') : ?> selected="selected" <?php endif; ?> value="no-repeat">no-repeat</option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label" >
							Background Image display Attachment
						</label>
						<div class="col-sm-9">
							<select name="soconfig_layout[content_attachment]" id="content_attachment<?php echo $store["store_id"]; ?>" class="form-control width30">
								<option <?php if (isset($soconfig_layout['content_attachment']) && $soconfig_layout['content_attachment'] == 'scroll') : ?> selected="selected" <?php endif; ?> value="scroll">Scroll</option>
								<option <?php if (isset($soconfig_layout['content_attachment']) && $soconfig_layout['content_attachment'] == 'fixed') : ?> selected="selected" <?php endif; ?> value="fixed">Fixed</option>
							</select>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!--subtabs: General -->
    </div>
    <!-------------------------------------end tab Colors,backgrounds,fonts-->

    <!-------------------------------------Tab Products sliders, products listings-->
    <div class="tab-pane" id="tab-products<?php echo $store['store_id']; ?>">

        <ul class="nav nav-tabs  main_tabs_2">
            <li class="active"><a href="#tab-products-layout1-<?php echo $store['store_id']; ?>" class="selected" data-toggle="tab"><?php echo $pages_pro_listings; ?></a></li>
            <li><a href="#tab-products-layout2-<?php echo $store['store_id']; ?>" data-toggle="tab"><?php echo $pages_pro_label; ?></a></li>
            <li><a href="#tab-products-layout3-<?php echo $store['store_id']; ?>" data-toggle="tab"><?php echo $pages_pro_detail; ?></a></li>
        </ul>
        <div class="tab-content">
            <!--subtabs: Listings -->
            <div class="tab-pane active wrapper-tabcategory" id="tab-products-layout1-<?php echo $store['store_id']; ?>">
				
				<div class="so-panel">
					<h3 class="panel-title ">Refine Search</h3>
					<div class="panel-container">
						<div class="form-group">
							<label class="col-sm-3 control-label" >
								<?php echo $product_catalog_refine ?>
							</label>
							<div class="col-sm-9">
								<select name="soconfig_pages[product_catalog_refine]" id="input-product_catalog_refine" class="form-control width30">
									<?php foreach ($refine_search as $fv => $fc) { ?>
										<?php ($fv ==  $soconfig_pages["product_catalog_refine"]) ? $current = 'selected' : $current='3'; ?>
										<option value="<?php echo $fv; ?>" <?php echo $current; ?> ><?php echo $fc; ?></option>	
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="input-product_catalog_refine_col"><?php echo $product_catalog_refine_col ?></span>
							</label>
							<div class="col-sm-9">
								<ul class="nav nav-tabs" >
									<?php foreach ($devices as $subfix => $device) : ?>
									<li class="<?php echo ($subfix == 'md' ? 'active' : ''); ?>"><a href="#language-catalog_refine_<?php echo $subfix ?>" data-toggle="tab"><?php echo $device ?></a></li>
									<?php endforeach; ?>
								</ul>
								<div class="tab-content">
									<?php foreach ($devices as $subfix => $device) : ?>
									<div class="tab-pane <?php echo ($subfix == 'md' ? 'active' : ''); ?>" id="language-catalog_refine_<?php echo $subfix ?>">
										<select name="soconfig_pages[product_catalog_refine_col_<?php echo $subfix; ?>]" class="form-control width30">
										   <?php foreach ($columns as $fv => $fc) { ?>
												<?php ($fv == $soconfig_pages["product_catalog_refine_col_".$subfix] ) ? $current = 'selected' : $current='4'; ?>
												<option value="<?php echo $fv; ?>" <?php echo $current; ?> ><?php echo $fc; ?></option>	
											<?php } ?>
										</select>
									</div>
									<?php endforeach; ?>
									<span class="help-block"><?php echo $entry_catalog_column_help; ?></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="so-panel">
					<h3 class="panel-title">Category Page</h3>
					<div class="panel-container">
						<div class="form-group">
							<label class="col-sm-3 control-label">Display deals today</label>
							<div class="col-sm-9">
								<div class="btn-group btn-toggle" data-toggle="buttons">
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["deals_today"] == 1): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[deals_today]" value="1" <?php if ($soconfig_pages["deals_today"] == 1): ?> checked="checked"<?php endif; ?>>ON
									</label>
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["deals_today"] == 0): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[deals_today]" value="0" <?php if ($soconfig_pages["deals_today"] == 0): ?> checked="checked"<?php endif; ?>>OFF
									</label>
								</div>
								
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo $product_catalog_title; ?></label>
							<div class="col-sm-9">
								<div class="btn-group btn-toggle" data-toggle="buttons">
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["lsttitle_cate_status"] == 1): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[lsttitle_cate_status]" value="1" <?php if ($soconfig_pages["lsttitle_cate_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
									</label>
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["lsttitle_cate_status"] == 0): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[lsttitle_cate_status]" value="0" <?php if ($soconfig_pages["lsttitle_cate_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
									</label>
								</div>
								
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo $product_catalog_image; ?></label>
							<div class="col-sm-9">
								<div class="btn-group btn-toggle" data-toggle="buttons">
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["lstimg_cate_status"] == 1): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[lstimg_cate_status]" value="1" <?php if ($soconfig_pages["lstimg_cate_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
									</label>
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["lstimg_cate_status"] == 0): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[lstimg_cate_status]" value="0" <?php if ($soconfig_pages["lstimg_cate_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
									</label>
								</div>
								
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo $product_list_compare; ?></label>
							<div class="col-sm-9">
								<div class="btn-group btn-toggle" data-toggle="buttons">
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["lstcompare_status"] == 1): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[lstcompare_status]" value="1" <?php if ($soconfig_pages["lstcompare_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
									</label>
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["lstcompare_status"] == 0): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[lstcompare_status]" value="0" <?php if ($soconfig_pages["lstcompare_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
									</label>
								</div>
								
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label" for="input-product_catalog_mode">
								<span data-toggle="tooltip" title="Create your listings into simple catalog."><?php echo $product_catalog_mode ?></span>
							</label>
							<div class="col-sm-9">
								<select name="soconfig_pages[product_catalog_mode]" id="input-product_catalog_mode" class="form-control width30">
									<option <?php if (isset($soconfig_pages['product_catalog_mode']) && $soconfig_pages['product_catalog_mode'] == 0) : ?> selected="selected" <?php endif; ?> value="0">Grid</option>
									<option <?php if (isset($soconfig_pages['product_catalog_mode']) && $soconfig_pages['product_catalog_mode'] == 1) : ?> selected="selected" <?php endif; ?> value="1">List</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="input-listing_quick_type"><?php echo $product_catalog_column ?></label>
							<div class="col-sm-9">
								<ul class="nav nav-tabs" >
									<?php foreach ($devices as $subfix => $device) : ?>
									<li class="<?php echo ($subfix == 'md' ? 'active' : ''); ?>"><a href="#language-product_catalog_<?php echo $subfix ?>" data-toggle="tab"><?php echo $device ?></a></li>
									<?php endforeach; ?>
								</ul>
								<div class="tab-content">
									<?php foreach ($devices as $subfix => $device) : ?>
									<div class="tab-pane <?php echo ($subfix == 'md' ? 'active' : ''); ?>" id="language-product_catalog_<?php echo $subfix ?>">
										<select name="soconfig_pages[product_catalog_column_<?php echo $subfix; ?>]" class="form-control width30">
										   <?php foreach ($columns as $fv => $fc) { ?>
												<?php ($fv == $soconfig_pages["product_catalog_column_".$subfix] ) ? $current = 'selected' : $current='4'; ?>
												<option value="<?php echo $fv; ?>" <?php echo $current; ?> ><?php echo $fc; ?></option>	
											<?php } ?>
										</select>
									</div>
									<?php endforeach; ?>
									<span class="help-block"><?php echo $entry_catalog_column_help; ?></span>
								</div>
							</div>
						</div>
						
					</div>
				</div>
				
				<div class="so-panel">
					<h3 class="panel-title">Product Item</h3>
					<div class="panel-container">
						<div class="form-group">
						
							<label class="col-sm-3 control-label">Slide to 2nd image automatically</label>
							<div class="col-sm-9">
								<select name="soconfig_pages[secondimg]" class="form-control width30">
								   <?php foreach ($secondimg as $fv => $fc) { ?>
										<?php ($fv == $soconfig_pages["secondimg"] ) ? $current = 'selected' : $current='2'; ?>
										<option value="<?php echo $fv; ?>" <?php echo $current; ?> ><?php echo $fc; ?></option>	
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Show rating</label>
							<div class="col-sm-9">
								<div class="btn-group btn-toggle" data-toggle="buttons">
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["rating_status"] == 1): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[rating_status]" value="1" <?php if ($soconfig_pages["rating_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
									</label>
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["rating_status"] == 0): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[rating_status]" value="0" <?php if ($soconfig_pages["rating_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
									</label>
								</div>
							   
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo $show_product_item_desc; ?></label>
							<div class="col-sm-9">
								<div class="btn-group btn-toggle" data-toggle="buttons">
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["lstdescription_status"] == 1): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[lstdescription_status]" value="1" <?php if ($soconfig_pages["lstdescription_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
									</label>
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["lstdescription_status"] == 0): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[lstdescription_status]" value="0" <?php if ($soconfig_pages["lstdescription_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
									</label>
								</div>
								<span class="help-block">Only for "Grid" view. This option performs</span>
							</div>
						</div>
					</div>
				</div>
				
			</div>

            <!--subtabs: labels -->
            <div id="tab-products-layout2-<?php echo $store['store_id']; ?>" class="tab-pane">
				<div class="so-panel">
					<h3 class="panel-title">Product labels</h3>
					<div class="panel-container">
						<div class="form-group">
							<label class="col-sm-3 control-label">Show "Sale" label:</label>
							<div class="col-sm-9">
								<div class="btn-group btn-toggle" data-toggle="buttons">
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["sale_status"] == 1): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[sale_status]" value="1" <?php if ($soconfig_pages["sale_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
									</label>
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["sale_status"] == 0): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[sale_status]" value="0" <?php if ($soconfig_pages["sale_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="sale_text1">Title for "Sale" label:</label>
							<div class="col-sm-9">
								<div class="tab-horizontal">
									<ul class="nav nav-tabs main_tabs_horizontal" id="sale_text">
										<?php foreach ($languages as $language) : ?>
										<li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#sale_text<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
										<?php endforeach; ?>
									</ul>
									<div class="tab-content">
										<?php foreach ($languages as $language) : ?>
										<div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="sale_text<?php echo $language['language_id']; ?>">
											<input type="text" name="soconfig_pages[<?php echo $language['language_id']; ?>][sale_text]" value="<?php echo isset($soconfig_pages[$language['language_id']]['sale_text']) ? $soconfig_pages[$language['language_id']]['sale_text'] : ''; ?>" placeholder="'Sale' label title:" id="sale_text1" class="form-control width30" />
										</div>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Show "New" label:</label>
							<div class="col-sm-9">
								<div class="btn-group btn-toggle" data-toggle="buttons">
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["new_status"] == 1): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[new_status]" value="1" <?php if ($soconfig_pages["new_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
									</label>
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["new_status"] == 0): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[new_status]" value="0" <?php if ($soconfig_pages["new_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
									</label>
								</div>
								
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="new_text1">Title for "New" label:</label>
							<div class="col-sm-9">
								<div class="tab-horizontal">
									<ul class="nav nav-tabs main_tabs_horizontal" id="new_text">
										<?php foreach ($languages as $language) : ?>
										<li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#new_text<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
										<?php endforeach; ?>
									</ul>
									<div class="tab-content">
										<?php foreach ($languages as $language) : ?>
										<div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="new_text<?php echo $language['language_id']; ?>">
											<input type="text" name="soconfig_pages[<?php echo $language['language_id']; ?>][new_text]" value="<?php echo isset($soconfig_pages[$language['language_id']]['new_text']) ? $soconfig_pages[$language['language_id']]['new_text'] : ''; ?>" placeholder="'new' label title:" id="new_text1" class="form-control width30" />
										</div>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="input-days">
								<span data-toggle="tooltip" title="Number of days from the date "Date Available" to today date for a product.">
								Period of holding "New" label:
								</span>
							</label>
							<div class="col-sm-9">
								<input type="text" name="soconfig_pages[days]" value="<?php echo (isset($soconfig_pages['days']) ? $soconfig_pages['days'] : ''); ?>" placeholder="Period of holding 'New' label:" id="input-days" class="form-control width30" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">
								<span data-toggle="tooltip" title="Set display or not 'QUICK VIEW' function on products in sliders.">Show "QUICK VIEW" function:</span>
							</label>
							<div class="col-sm-9">
								<div class="btn-group btn-toggle" data-toggle="buttons">
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["quick_status"] == 1): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[quick_status]" value="1" <?php if ($soconfig_pages["quick_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
									</label>
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["quick_status"] == 0): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[quick_status]" value="0" <?php if ($soconfig_pages["quick_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
									</label>
								</div>
								
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="quick_view_text1">Title for "Quick view" label:</label>
							<div class="col-sm-9">
								<div class="tab-horizontal">
									<ul class="nav nav-tabs main_tabs_horizontal" id="quick_view_text">
										<?php foreach ($languages as $language) : ?>
										<li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#quick_view_text<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
										<?php endforeach; ?>
									</ul>
									<div class="tab-content">
										<?php foreach ($languages as $language) : ?>
										<div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="quick_view_text<?php echo $language['language_id']; ?>">
											<input type="text" name="soconfig_pages[<?php echo $language['language_id']; ?>][quick_view_text]" value="<?php echo isset($soconfig_pages[$language['language_id']]['quick_view_text']) ? $soconfig_pages[$language['language_id']]['quick_view_text'] : ''; ?>" placeholder="'Quick view' label title:" id="quick_view_text1" class="form-control width30" />
										</div>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">
								<span data-toggle="tooltip" title="Set display or not 'Discount' label.">Show "Discount" label:</span>
							</label>
							<div class="col-sm-9">
								<div class="btn-group btn-toggle" data-toggle="buttons">
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["discount_status"] == 1): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[discount_status]" value="1" <?php if ($soconfig_pages["discount_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
									</label>
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["discount_status"] == 0): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[discount_status]" value="0" <?php if ($soconfig_pages["discount_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
									</label>
								</div>
								
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">
								<span data-toggle="tooltip" title="Set display or not countdown of Special Offer in product sliders.">Show countdown of Special Offer:</span>
							</label>
							<div class="col-sm-9">
								<div class="btn-group btn-toggle" data-toggle="buttons">
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["countdown_status"] == 1): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[countdown_status]" value="1" <?php if ($soconfig_pages["countdown_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
									</label>
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["countdown_status"] == 0): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[countdown_status]" value="0" <?php if ($soconfig_pages["countdown_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>

            <!--subtabs: product page -->
            <div id="tab-products-layout3-<?php echo $store['store_id']; ?>" class="tab-pane">
                <div class="so-panel">
					<h3 class="panel-title">Product labels</h3>
					<div class="panel-container">
				
						<div class="form-group">
							<label class="col-sm-3 control-label" for="input-thumbnails_position">Position of block with thumbnails previews:</label>
							<div class="col-sm-9">
								<select name="soconfig_pages[thumbnails_position]" id="input-thumbnails_position" class="form-control width30">
									<option <?php if ($soconfig_pages['thumbnails_position'] == 'bottom') : ?> selected="selected" <?php endif; ?> value="bottom">Bottom</option>
									<option <?php if ($soconfig_pages['thumbnails_position'] == 'left') : ?> selected="selected" <?php endif; ?> value="left">Left</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="input-cloudzoom_mode">
								<span data-toggle="tooltip" title="Choose position of cloudzoom image preview on product page.">Enable Product Zoom</span>
							</label>
							<div class="col-sm-9">
							   <div class="btn-group btn-toggle" data-toggle="buttons">
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["product_enablezoom"] == 1): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[product_enablezoom]" value="1" <?php if ($soconfig_pages["product_enablezoom"] == 1): ?> checked="checked"<?php endif; ?>>ON
									</label>
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["product_enablezoom"] == 0): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[product_enablezoom]" value="0" <?php if ($soconfig_pages["product_enablezoom"] == 0): ?> checked="checked"<?php endif; ?>>OFF
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="input-tabs_position">Product Zoom Mode</label>
							<div class="col-sm-9">
								<select name="soconfig_pages[product_zoommode]" id="input-tabs_position" class="form-control width30">
									<option <?php if ($soconfig_pages['product_zoommode'] == 'basic') : ?> selected="selected" <?php endif; ?> value="basic">Basic Zoom</option>
									<option <?php if ($soconfig_pages['product_zoommode'] == 'inner') : ?> selected="selected" <?php endif; ?> value="inner">Inner Zoom</option>
									<option <?php if ($soconfig_pages['product_zoommode'] == 'lens') : ?> selected="selected" <?php endif; ?> value="lens">Lens Zoom</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							
							<label class="col-sm-3 control-label">
								<span data-toggle="tooltip" title="Lens Zoom Size is viewport size to move and enlarge the image. Please enter number style and not negative number">Lens Zoom Size</span>
							</label>
							<div class="col-sm-2">
								<input type="text" name="soconfig_pages[product_zoomlenssize]" value="<?php echo $soconfig_pages["product_zoomlenssize"]; ?>"  class="form-control input-mini" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label" for="input-tabs_position">Tabs block:</label>
							<div class="col-sm-9">
								<select name="soconfig_pages[tabs_position]" id="input-tabs_position" class="form-control width30">
									<option <?php if ($soconfig_pages['tabs_position'] == 1) : ?> selected="selected" <?php endif; ?> value="1">Bottom vertical</option>
									<option <?php if ($soconfig_pages['tabs_position'] == 2) : ?> selected="selected" <?php endif; ?> value="2">Bottom horizontal</option>
									<option <?php if ($soconfig_pages['tabs_position'] == 3) : ?> selected="selected" <?php endif; ?> value="3">Collapsed in product description</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="input-related">Related products</label>
							<div class="col-sm-9">
								<div class="btn-group btn-toggle" data-toggle="buttons">
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["related_status"] == 1): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[related_status]" value="1" <?php if ($soconfig_pages["related_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
									</label>
									<label class="btn btn-default btn-sm <?php if ($soconfig_pages["related_status"] == 0): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_pages[related_status]" value="0" <?php if ($soconfig_pages["related_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="input-listing_quick_type">Related product number per row</label>
							<div class="col-sm-9">
								<ul class="nav nav-tabs" >
									<?php foreach ($devices as $subfix => $device) : ?>
									<li class="<?php echo ($subfix == 'md' ? 'active' : ''); ?>"><a href="#language-product_related_<?php echo $subfix ?>" data-toggle="tab"><?php echo $device ?></a></li>
									<?php endforeach; ?>
								</ul>
								<div class="tab-content">
									<?php foreach ($devices as $subfix => $device) : ?>
									<div class="tab-pane <?php echo ($subfix == 'md' ? 'active' : ''); ?>" id="language-product_related_<?php echo $subfix ?>">
										<select name="soconfig_pages[product_related_column_<?php echo $subfix; ?>]" class="form-control width30">
										   <?php foreach ($columns as $fv => $fc) { ?>
												<?php ($fv == $soconfig_pages["product_related_column_".$subfix] ) ? $current = 'selected' : $current='4'; ?>
												<option value="<?php echo $fv; ?>" <?php echo $current; ?> ><?php echo $fc; ?></option>	
											<?php } ?>
										</select>
									</div>
									<?php endforeach; ?>
									<span class="help-block"><?php echo $entry_catalog_column_help; ?></span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="input-meta-keyword">
								<span data-toggle="tooltip" title="Here you can enter any html of iframe content of buttons">
									Social buttons:
								</span>
							</label>
							<div class="col-sm-9">
								<textarea name="soconfig_pages[product_page_button]" rows="5" placeholder="Footer payment icons images:" id="input-meta-keyword" class="form-control"><?php echo $soconfig_pages['product_page_button']; ?></textarea>
							</div>
						</div>

						
					</div>
				</div>
            </div>
        </div>

    </div>
    <!------------------------------------end tab Pages-->

    <!-------------------------------------Tab Fonts-->
    <div class="tab-pane" id="tab-fonts<?php echo $store['store_id']; ?>">
		
		<div class="so-panel">
			<h3 class="panel-title">Fonts<span class="help-block">If you want to speed up your site use one of the common fonts instead of the fonts from Google.</span></h3>
			<div class="panel-container">
				<div class="form-group">
					
					<label class="col-sm-3 control-label" ><?php echo $fonts_body; ?> </label>
					<div class="col-sm-9">
						<div class="block-group fonts-change">
							<div class="btn-group btn-toggle block-group " data-toggle="buttons">
								<label class="btn btn-default btn-sm <?php if ($soconfig_fonts["body_status"] == 'standard'): ?>btn-success active <?php endif; ?>">
									<input class="type-fonts" type="radio" name="soconfig_fonts[body_status]" value="standard" <?php if ($soconfig_fonts["body_status"] == 'standard'): ?> checked="checked"<?php endif; ?>>Standard
								</label>
								<label class="btn btn-default btn-sm <?php if ($soconfig_fonts["body_status"] == 'google'): ?>btn-success active <?php endif; ?>">
									<input class="type-fonts" type="radio" name="soconfig_fonts[body_status]" value="google" <?php if ($soconfig_fonts["body_status"] == 'google'): ?> checked="checked"<?php endif; ?>>Google Fonts
								</label>
							</div>
							<div class="block-group items-font font-standard" >
								<select name="soconfig_fonts[normal_body]" class="form-control">
									<?php foreach ($fonts_normal as $fv => $fc) { ?>
										<?php ($fv ==  $soconfig_fonts["normal_body"]) ? $current = 'selected' : $current='15'; ?>
										<option value="<?php echo $fv; ?>" <?php echo $current; ?> ><?php echo $fc; ?></option>	
									<?php } ?>
								</select>
							</div>
							<div class="block-group items-font font-google" >
								<label class="control-label">  <?php echo $entry_google_url; ?>  </label>
								<div class="">
									<input type="text" name="soconfig_fonts[url_body]" value="<?php echo $soconfig_fonts["url_body"]; ?>" id="meta-title<?php echo $store["store_id"]; ?>" class="form-control" />
									<span class="help-block"><?php echo $entry_google_url_help ?></span>
								</div>
							</div>
							<div class="block-group items-font font-google" >
								<label class=" control-label"> <?php echo $entry_google_family ?></label>
								<div class="">
									<input type="text" name="soconfig_fonts[family_body]" value="<?php echo $soconfig_fonts["family_body"]; ?>" id="meta-title<?php echo $store["store_id"]; ?>" class="form-control" />
									<span class="help-block"> <?php echo $entry_google_family_help ?></span>
								</div>
							</div>
						</div>
						<div class="block-group">
							<textarea name="soconfig_fonts[selector_body]" rows="5" placeholder="Add css selectors"  class="form-control"><?php echo $soconfig_fonts['selector_body']; ?></textarea>
							
						</div>
					</div>
				</div>
		
				<div class="form-group">
					<label class="col-sm-3 control-label" ><?php echo $fonts_menu; ?> </label>
					<div class="col-sm-9">
						<div class="block-group fonts-change">
							<div class="btn-group btn-toggle block-group " data-toggle="buttons">
								<label class="btn btn-default btn-sm <?php if ($soconfig_fonts["menu_status"] == 'standard'): ?>btn-success active <?php endif; ?>">
									<input class="type-fonts" type="radio" name="soconfig_fonts[menu_status]" value="standard" <?php if ($soconfig_fonts["menu_status"] == 'standard'): ?> checked="checked"<?php endif; ?>><?php echo $entry_standard ?>
								</label>
								<label class="btn btn-default btn-sm <?php if ($soconfig_fonts["menu_status"] == 'google'): ?>btn-success active <?php endif; ?>">
									<input class="type-fonts" type="radio" name="soconfig_fonts[menu_status]" value="google" <?php if ($soconfig_fonts["menu_status"] == 'google'): ?> checked="checked"<?php endif; ?>><?php echo $entry_google_font ?>
								</label>
							</div>
							<div class="block-group items-font font-standard" >
								<select name="soconfig_fonts[normal_menu]" class="form-control">
									<?php foreach ($fonts_normal as $fv => $fc) { ?>
										<?php ($fv ==  $soconfig_fonts["normal_menu"]) ? $current = 'selected' : $current='15'; ?>
										<option value="<?php echo $fv; ?>" <?php echo $current; ?> ><?php echo $fc; ?></option>	
									<?php } ?>
								</select>
							</div>
							<div class="block-group items-font font-google" >
								<label class="control-label">  <?php echo $entry_google_url; ?>  </label>
								<div class="">
									<input type="text" name="soconfig_fonts[url_menu]" value="<?php echo $soconfig_fonts["url_menu"]; ?>" id="meta-title<?php echo $store["store_id"]; ?>" class="form-control" />
									<span class="help-block"><?php echo $entry_google_url_help ?></span>
								</div>
							</div>
							<div class="block-group items-font font-google" >
								<label class=" control-label"> <?php echo $entry_google_family ?></label>
								<div class="">
									<input type="text" name="soconfig_fonts[family_menu]" value="<?php echo $soconfig_fonts["family_menu"]; ?>" id="meta-title<?php echo $store["store_id"]; ?>" class="form-control" />
									<span class="help-block"> <?php echo $entry_google_family_help ?></span>
								</div>
							</div>
						</div>
						<div class="block-group">
							<textarea name="soconfig_fonts[selector_menu]" rows="5"  placeholder="Add css selectors" class="form-control"><?php echo $soconfig_fonts['selector_menu']; ?></textarea>
						</div>
					</div>
				</div>	
				
				<div class="form-group">
					<label class="col-sm-3 control-label" ><?php echo $fonts_heading; ?> </label>
					<div class="col-sm-9">
						<div class="block-group fonts-change">
							<div class="btn-group btn-toggle block-group " data-toggle="buttons">
								<label class="btn btn-default btn-sm <?php if ($soconfig_fonts["heading_status"] == 'standard'): ?>btn-success active <?php endif; ?>">
									<input class="type-fonts" type="radio" name="soconfig_fonts[heading_status]" value="standard" <?php if ($soconfig_fonts["heading_status"] == 'standard'): ?> checked="checked"<?php endif; ?>><?php echo $entry_standard ?>
								</label>
								<label class="btn btn-default btn-sm <?php if ($soconfig_fonts["heading_status"] == 'google'): ?>btn-success active <?php endif; ?>">
									<input class="type-fonts" type="radio" name="soconfig_fonts[heading_status]" value="google" <?php if ($soconfig_fonts["heading_status"] == 'google'): ?> checked="checked"<?php endif; ?>><?php echo $entry_google_font ?>
								</label>
							</div>
							<div class="block-group items-font font-standard" >
								<select name="soconfig_fonts[normal_heading]" class="form-control">
									<?php foreach ($fonts_normal as $fv => $fc) { ?>
										<?php ($fv ==  $soconfig_fonts["normal_heading"]) ? $current = 'selected' : $current='15'; ?>
										<option value="<?php echo $fv; ?>" <?php echo $current; ?> ><?php echo $fc; ?></option>	
									<?php } ?>
								</select>
							</div>
							<div class="block-group items-font font-google" >
								<label class="control-label"> <?php echo $entry_google_url; ?> </label>
								<div class="">
									<input type="text" name="soconfig_fonts[url_heading]" value="<?php echo $soconfig_fonts["url_heading"]; ?>" id="meta-title<?php echo $store["store_id"]; ?>" class="form-control" />
									<span class="help-block"><?php echo $entry_google_url_help ?></span>
								</div>
							</div>
							<div class="block-group items-font font-google" >
								<label class=" control-label"> <?php echo $entry_google_family ?></label>
								<div class="">
									<input type="text" name="soconfig_fonts[family_heading]" value="<?php echo $soconfig_fonts["family_heading"]; ?>" id="meta-title<?php echo $store["store_id"]; ?>" class="form-control" />
									<span class="help-block"> <?php echo $entry_google_family_help ?></span>
								</div>
							</div>
						</div>
						<div class="block-group">
							<textarea name="soconfig_fonts[selector_heading]" rows="5"  placeholder="Add css selectors" class="form-control"><?php echo $soconfig_fonts['selector_heading']; ?></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>				
    </div>
    <!-------------------------------------end tab Fonts-->
	
	<!-------------------------------------Tab Custom-->
	<div class="tab-pane" id="tab-slide<?php echo $store['store_id']; ?>">
		<div class="so-panel">
			<h3 class="panel-title">Social Accounts (right fixed panel)</h3>
			<div class="panel-container">
				<div class="form-group">
					<label class="col-sm-3 control-label" >Right fixed panel with social widgets </label>
					<div class="col-sm-9">
						<div class="btn-group btn-toggle " data-toggle="buttons">
							<label class="btn btn-default btn-sm <?php if ($soconfig_social["social_status"] == 1): ?>btn-success active <?php endif; ?>">
								<input type="radio" name="soconfig_social[social_status]" value="1" <?php if ($soconfig_social["social_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
							</label>
							<label class="btn btn-default btn-sm <?php if ($soconfig_social["social_status"] == 0): ?>btn-success active <?php endif; ?>">
								<input type="radio" name="soconfig_social[social_status]" value="0" <?php if ($soconfig_social["social_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" >
						Facebook profile name
					</label>
					<div class="col-sm-9">
						<input type="text" name="soconfig_social[facebook]" value="<?php echo (isset($soconfig_social['facebook']) ? $soconfig_social['facebook'] : ''); ?>" placeholder="Facebook profile name"  class="form-control" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" >
						Twitter account 
					</label>
					<div class="col-sm-9">
						<input type="text" name="soconfig_social[twitter]" value="<?php echo (isset($soconfig_social['twitter']) ? $soconfig_social['twitter'] : ''); ?>" placeholder="Twitter account name"  class="form-control" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label" >
						Youtube code
						<span class="help" data-toggle="tooltip" title="Video button in right fixed panel">
							For example, enter only code: HhEPvNx0OYw<br>
							<a href="https://support.google.com/youtube/answer/171780" target="_blank">Read here</a>
						</span>
					</label>
					<div class="col-sm-9">
						<input type="text" name="soconfig_social[video_code]" value="<?php echo (isset($soconfig_social['video_code']) ? $soconfig_social['video_code'] : ''); ?>" placeholder="Youtube code"  class="form-control" />
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-------------------------------------Tab Sample Data-->
	<div class="tab-pane" id="tab-sampledata<?php echo $store['store_id']; ?>">
		<div class="so-panel">
			<h3 class="panel-title">Install sample data <span class="help-block">If you want to make your shop look exactly like our demo. Install sample data.</span></h3>
			<div class="panel-container">
				<div class="form-group">
					<label class="col-sm-3 control-label" > Install Store Configuration </label>
					<div class="col-sm-9">
						<div class="btn-group btn-toggle " data-toggle="buttons">
							<a onclick="installMegamenu();" data-toggle="tooltip" title="Intall Data" class="btn btn-success"><i class="fa fa-check"></i> Intall Data</a>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<!-------------------------------------Tab Custom-->
	<div class="tab-pane" id="tab-custom<?php echo $store['store_id']; ?>">
		<div class="tab-horizontal">
			<ul class="nav nav-tabs  main_tabs_2">
				<li class="<?php echo ($store['store_id'] == 0 ? 'active' : ''); ?>"><a href="#tab-custom-layout1-<?php echo $store['store_id']; ?>" class="selected" data-toggle="tab"><?php echo $custom_tab_css_input; ?></a></li>
				<li><a href="#tab-custom-layout2-<?php echo $store['store_id']; ?>" data-toggle="tab"><?php echo $custom_tab_css_file; ?></a></li>
				<li><a href="#tab-custom-layout3-<?php echo $store['store_id']; ?>" data-toggle="tab"><?php echo $custom_tab_js_input; ?></a></li>
				<li><a href="#tab-custom-layout4-<?php echo $store['store_id']; ?>" data-toggle="tab"><?php echo $custom_tab_js_file; ?></a></li>

			</ul>
		</div>
        <div class="tab-content ">
			<?php // Custom  CSS--------------------------------------------- ?>
		
            <div class="tab-pane active" id="tab-custom-layout1-<?php echo $store['store_id']; ?>">
				<div class="so-panel">
					<h3 class="panel-title">CSS CODE DIRECT INPUT</h3>
					<div class="panel-container">
						<div class="form-group">
							<label class="col-sm-2 control-label" >Status </label>
							<div class="col-sm-10">
								<div class="btn-group btn-toggle " data-toggle="buttons">
									<label class="btn btn-default btn-sm <?php if ($soconfig_custom["cssinput_status"] == 1): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_custom[cssinput_status]" value="1" <?php if ($soconfig_custom["cssinput_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
									</label>
									<label class="btn btn-default btn-sm <?php if ($soconfig_custom["cssinput_status"] == 0): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_custom[cssinput_status]" value="0" <?php if ($soconfig_custom["cssinput_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
									</label>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-12">
								<textarea name="soconfig_custom[custom_css]" rows="20"  class="custom-code form-control code-input"><?php echo $soconfig_custom['custom_css']; ?></textarea>
							</div>
						</div>
					</div>
				</div>
            </div>
           
            <div id="tab-custom-layout2-<?php echo $store['store_id']; ?>" class="customcode_wrap tab-pane">
				<div class="so-panel">
					<div class="form-group no-margin" >
						<h3 class="col-sm-2 panel-title ">ADD CSS FILES</h3>
						<div class="col-sm-10 text-right"><a class="btn btn-success add-soconfig_cssfile" > <i class="fa fa-plus-circle"></i> Add file</a></div>
					</div>
					<div class="panel-container">
						
						<div class="form-group">
							<label class="col-sm-2 control-label" >Status </label>
							<div class="col-sm-10">
								<div class="btn-group btn-toggle " data-toggle="buttons">
									<label class="btn btn-default btn-sm <?php if ($soconfig_custom["cssfile_status"] == 1): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_custom[cssfile_status]" value="1" <?php if ($soconfig_custom["cssfile_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
									</label>
									<label class="btn btn-default btn-sm <?php if ($soconfig_custom["cssfile_status"] == 0): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_custom[cssfile_status]" value="0" <?php if ($soconfig_custom["cssfile_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
									</label>
								</div>
							</div>
						</div>
						
						<?php if(isset($soconfig_cssfile)){
							foreach ($soconfig_cssfile as $file_css) {
								if(!empty($file_css)){?>
								<div class="form-group">
									<label class="col-sm-2 control-label" >Enter file path</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="soconfig_cssfile[]" value="<?php echo $file_css; ?>" />
									</div>
									<div class="col-sm-1">
										<a href="#" class="btn btn-success remove_field"><i class="fa fa-times"></i></a>
									</div>
								</div>
							<?php }
							}
						}else {?>
							<div class="form-group">
								<label class="col-sm-2 control-label" >Enter file path</label>
								<div class="col-sm-9">
									<input class="form-control" type="text" name="soconfig_cssfile[]" value="catalog/view/theme/<?php echo $template;?>/css/custom.css" />
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>

			<?php // Custom  JS--------------------------------------------- ?>
            <div id="tab-custom-layout3-<?php echo $store['store_id']; ?>" class="tab-pane">
				<div class="so-panel">
					<h3 class="panel-title ">JS CODE DIRECT INPUT</h3>
					<div class="panel-container">
						<div class="form-group">
							<label class="col-sm-2 control-label" >Status </label>
							<div class="col-sm-10">
								<div class="btn-group btn-toggle " data-toggle="buttons">
									<label class="btn btn-default btn-sm <?php if ($soconfig_custom["jsinput_status"] == 1): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_custom[jsinput_status]" value="1" <?php if ($soconfig_custom["jsinput_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
									</label>
									<label class="btn btn-default btn-sm <?php if ($soconfig_custom["jsinput_status"] == 0): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_custom[jsinput_status]" value="0" <?php if ($soconfig_custom["jsinput_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
									</label>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-12">
								<textarea name="soconfig_custom[custom_js]" rows="20" class="custom-code form-control code-input"><?php echo $soconfig_custom['custom_js']; ?></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="tab-custom-layout4-<?php echo $store['store_id']; ?>" class="customcode_wrap tab-pane">
				<div class="so-panel">
					
					<div class="form-group no-margin" >
						<h3 class="col-sm-2 panel-title ">ADD JS FILES</h3>
						<div class="col-sm-10 text-right"><a class="btn btn-success add-soconfig_jsfile" > <i class="fa fa-plus-circle"></i> Add file</a></div>
					</div>
					<div class="panel-container">
						<div class="form-group">
							<label class="col-sm-2 control-label" >Status </label>
							<div class="col-sm-10">
								<div class="btn-group btn-toggle " data-toggle="buttons">
									<label class="btn btn-default btn-sm <?php if ($soconfig_custom["jsfile_status"] == 1): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_custom[jsfile_status]" value="1" <?php if ($soconfig_custom["jsfile_status"] == 1): ?> checked="checked"<?php endif; ?>>ON
									</label>
									<label class="btn btn-default btn-sm <?php if ($soconfig_custom["jsfile_status"] == 0): ?>btn-success active <?php endif; ?>">
										<input type="radio" name="soconfig_custom[jsfile_status]" value="0" <?php if ($soconfig_custom["jsfile_status"] == 0): ?> checked="checked"<?php endif; ?>>OFF
									</label>
								</div>
							</div>
						</div>
						
						<?php 
						if(isset($soconfig_jsfile)){
							foreach ($soconfig_jsfile as $file_js) {
								if(!empty($file_js)){?>
								<div class="form-group">
									<label class="col-sm-2 control-label" >Enter file path</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="soconfig_jsfile[]" value="<?php echo $file_js; ?>" />
									</div>
									<div class="col-sm-1">
										<a href="#" class="btn btn-success remove_field"><i class="fa fa-times"></i></a>
									</div>
								</div>
							<?php }
							}
						}else {?>
							<div class="form-group">
								<label class="col-sm-2 control-label" >Enter file path</label>
								<div class="col-sm-9">
									<input class="form-control" type="text" name="soconfig_jsfile[]" value="catalog/view/theme/<?php echo $template;?>/js/custom.js" />
								</div>
							</div>
						<?php } ?>	
					</div>
				</div>
			</div>
			
		</div>
	 
	</div>
	<!-------------------------------------end tab Custom-->
</div>
