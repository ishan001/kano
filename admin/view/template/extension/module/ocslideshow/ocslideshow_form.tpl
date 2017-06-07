<?php echo $header; ?><?php echo $column_left; ?>
<?php  $token_random = rand();  ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-html" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-html" class="form-horizontal">
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
                            <?php if ($error_name) { ?>
                            <div class="text-danger"><?php echo $error_name; ?></div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-effect"><?php echo $entry_effect; ?></label>
                        <div class="col-sm-10">
                            <select name="effect" id="input-effect" class="form-control">
                                <?php
						$effects = $effect_option; 
						if($effects ) {
							foreach($effects as $effect1) {
							?>
                                <option <?php if($effect1['value'] == $effect) { echo 'selected ="selected"'; } ?>  value=<?php echo $effect1['value'];?>><?php echo $effect1['label']; ?></option>
                                <?php
							}
						}
					?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-delay"><?php echo $entry_delay; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="delay" value="<?php echo $delay; ?>" placeholder="<?php echo $entry_delay; ?>" id="input-delay" class="form-control" />
                            <?php if ($error_delay) { ?>
                            <div class="text-danger"><?php echo $error_delay; ?></div>
                            <?php } ?>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-auto"><?php echo $entry_auto; ?></label>
                        <div class="col-sm-10">
                            <select name="auto" id="input-auto" class="form-control">
                                <?php if ($auto) { ?>
                                <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                <option value="0"><?php echo $text_no; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_yes; ?></option>
                                <option value="0" selected="selected"><?php echo $text_no; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-hover"><?php echo $entry_hover; ?></label>
                        <div class="col-sm-10">
                            <select name="hover" id="input-hover" class="form-control">
                                <?php if ($hover) { ?>
                                <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                <option value="0"><?php echo $text_no; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_yes; ?></option>
                                <option value="0" selected="selected"><?php echo $text_no; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-nextback"><?php echo $entry_nextback; ?></label>
                        <div class="col-sm-10">
                            <select name="nextback" id="input-nextback" class="form-control">
                                <?php if ($nextback) { ?>
                                <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                <option value="0"><?php echo $text_no; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_yes; ?></option>
                                <option value="0" selected="selected"><?php echo $text_no; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-contrl"><?php echo $entry_contrl; ?></label>
                        <div class="col-sm-10">
                            <select name="contrl" id="input-contrl" class="form-control">
                                <?php if ($contrl) { ?>
                                <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                <option value="0"><?php echo $text_no; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_yes; ?></option>
                                <option value="0" selected="selected"><?php echo $text_no; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                        <div class="col-sm-10">
                            <select name="status" id="input-status" class="form-control">
                                <?php if ($status) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <ul class="nav nav-pills nav-stacked" id="module">
                                <?php $module_row = 1; ?>
                                <?php foreach ($ocslideshow_images as $ocslideshow_image) { ?>
                                <li><a href="#tab-module<?php echo $ocslideshow_image['key']; ?>" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$('a[href=\'#tab-module<?php echo $ocslideshow_image['key']; ?>\']').parent().remove(); $('#tab-module<?php echo $ocslideshow_image['key']; ?>').remove(); $('#module a:first').tab('show');"></i> <?php echo $tab_banner . ' ' . $module_row; ?></a></li>
                                <?php $module_row++; ?>
                                <?php } ?>
                                <li id="module-add"><a onclick="addModule();"><i class="fa fa-plus-circle"></i> <?php echo $button_add_banner; ?></a></li>
                            </ul>
                        </div>
                        <div class="col-sm-10">
                            <div class="tab-content">
                                <?php $image_row = 0; ?>
                                <?php foreach ($ocslideshow_images as $ocslideshow_image) { ?>
                                <div class="tab-pane" id="tab-module<?php echo $ocslideshow_image['key']; ?>">
                                    <ul class="nav nav-tabs" id="language<?php echo $ocslideshow_image['key']; ?>">
                                        <?php foreach ($languages as $language) { ?>
                                        <li><a href="#tab-module<?php echo $ocslideshow_image['key']; ?>-language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                                        <?php } ?>
                                    </ul>
                                    <div class="tab-content">

                                        <?php foreach ($languages as $language) { ?>
                                        <div class="tab-pane" id="tab-module<?php echo $ocslideshow_image['key']; ?>-language<?php echo $language['language_id']; ?>">

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-title<?php echo $ocslideshow_image['key']; ?>-language<?php echo $language['language_id']; ?>"><?php echo $entry_title; ?></label>

                                                <div class="col-sm-10">
                                                    <input type="text" id="input-title<?php echo $ocslideshow_image['key']; ?>-language<?php echo $language['language_id']; ?>" name="ocslideshow_image[<?php echo $image_row; ?>][ocslideshow_image_description][<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($ocslideshow_image['ocslideshow_image_description'][$language['language_id']]) ? $ocslideshow_image['ocslideshow_image_description'][$language['language_id']]['title'] : ''; ?>" placeholder="<?php echo $entry_title; ?>" class="form-control" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-subtitle<?php echo $ocslideshow_image['key']; ?>-language<?php echo $language['language_id']; ?>"><?php echo $entry_subtitle; ?></label>

                                                <div class="col-sm-10">
                                                    <input type="text" id="input-subtitle<?php echo $ocslideshow_image['key']; ?>-language<?php echo $language['language_id']; ?>" name="ocslideshow_image[<?php echo $image_row; ?>][ocslideshow_image_description][<?php echo $language['language_id']; ?>][sub_title]" value="<?php echo isset($ocslideshow_image['ocslideshow_image_description'][$language['language_id']]) ? $ocslideshow_image['ocslideshow_image_description'][$language['language_id']]['sub_title'] : ''; ?>" placeholder="<?php echo $entry_title; ?>" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-description<?php echo $ocslideshow_image['key']; ?>-language<?php echo $language['language_id']; ?>"><?php echo $entry_description; ?></label>
                                                <div class="col-sm-10">
                                                    <textarea name="ocslideshow_image[<?php echo $image_row; ?>][ocslideshow_image_description][<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" id="input-description<?php echo $ocslideshow_image['key']; ?>-language<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($ocslideshow_image['ocslideshow_image_description'][$language['language_id']]) ? $ocslideshow_image['ocslideshow_image_description'][$language['language_id']]['description'] : ''; ?></textarea>
                                                </div>
                                            </div>

                                        </div>

                                        <?php } ?>


                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-link<?php echo $ocslideshow_image['key']; ?>-language<?php echo $language['language_id']; ?>"><?php echo $entry_link; ?></label>

                                            <div class="col-sm-10">
                                                <input type="text" id="input-link<?php echo $ocslideshow_image['key']; ?>-language<?php echo $language['language_id']; ?>" name="ocslideshow_image[<?php echo $image_row; ?>][link]" value="<?php echo isset($ocslideshow_image['link']) ? $ocslideshow_image['link'] : ''; ?>" placeholder="<?php echo $entry_link; ?>" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="thumb-image-<?php echo $ocslideshow_image['key'].'-'.$token_random;; ?>"><?php echo $entry_image; ?></label>
                                            <div class="col-sm-10">
                                                <a href="" id="thumb-image-<?php echo $ocslideshow_image['key'].'-'.$token_random;; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo isset($ocslideshow_image['thumb']) ? $ocslideshow_image['thumb'] :  $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                                                <input type="hidden"  name="ocslideshow_image[<?php echo $image_row; ?>][image]"  value="<?php echo $ocslideshow_image['image']; ?>" id="input-image<?php echo $ocslideshow_image['key'].'-'.$token_random; ?>" />
                                            </div>
                                        </div>

                                        <div class="form-group" style="display: none">
                                            <label class="col-sm-2 control-label" for="thumb-image-<?php echo $ocslideshow_image['key'].'-'.($token_random+1); ?>"><?php echo $entry_small_image; ?></label>
                                            <div class="col-sm-10">
                                                <a href="" id="thumb-image-<?php echo $ocslideshow_image['key'].'-'.($token_random+1); ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo isset($ocslideshow_image['small_thumb']) ? $ocslideshow_image['small_thumb'] :  $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                                                <input type="hidden"  name="ocslideshow_image[<?php echo $image_row; ?>][small_image]"  value="<?php echo $ocslideshow_image['small_image']; ?>" id="input-image<?php echo $ocslideshow_image['key'].'-'.($token_random+1); ?>" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-type"><?php echo $entry_type; ?></label>
                                            <div class="col-sm-10">
                                                <select name="ocslideshow_image[<?php echo $image_row; ?>][type]" id="input-type" class="form-control">
                                                    <?php if(isset($ocslideshow_image['type'])):?>
                                                    <?php if($ocslideshow_image['type'] == '1'): ?>
                                                    <option selected="selected" value="1">Type 1</option>
                                                    <?php else: ?>
                                                    <option value="1">Type 1</option>
                                                    <?php endif; ?>
                                                    <?php if($ocslideshow_image['type'] == '2'): ?>
                                                    <option selected="selected" value="2">Type 2</option>
                                                    <?php else: ?>
                                                    <option value="2">Type 2</option>
                                                    <?php endif; ?>
                                                    <?php if($ocslideshow_image['type'] == '3'): ?>
                                                    <option selected="selected" value="3">Type 3</option>
                                                    <?php else: ?>
                                                    <option value="3">Type 3</option>
                                                    <?php endif; ?>
                                                    <?php else: ?>
                                                    <option value="1">Type 1</option>
                                                    <option value="2">Type 2</option>
                                                    <option value="3">Type 3</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php
						$banner_store  = array(); 
						if(isset($ocslideshow_image['banner_store'])) {
							$banner_store = explode(',',$ocslideshow_image['banner_store']); 
						}
					?>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?php echo $entry_store; ?></label>
                                            <div class="col-sm-10">
                                                <div class="well well-sm" style="height: 150px; overflow: auto;">
                                                    <?php foreach ($stores as $store) { ?>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="ocslideshow_image[<?php echo $image_row; ?>][banner_store][]" value="<?php echo $store['store_id']; ?>" <?php if(in_array($store['store_id'],$banner_store)) echo 'checked="checked"';  ?>  />
                                                            <?php echo $store['name']; ?>
                                                        </label>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <?php $image_row++; ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
    <link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
    <script type="text/javascript" src="view/javascript/summernote/opencart.js"></script>

    <script type="text/javascript"><!--
    <?php foreach ($ocslideshow_images as $ocslideshow_image) { ?>
    <?php foreach ($languages as $language) { ?>
            $('#input-description<?php echo $ocslideshow_image['key']; ?>-language<?php echo $language['language_id']; ?>').summernote({
                height: 300
            });
        <?php } ?>
    <?php } ?>
    //--></script>
    <script type="text/javascript"><!--
    var module_row = <?php echo $module_row; ?>;

    function addModule() {
        var token = Math.random().toString(36).substr(2);

        html  = '<div class="tab-pane" id="tab-module' + token + '">';
        html += '  <ul class="nav nav-tabs" id="language' + token + '">';
    <?php foreach ($languages as $language) { ?>
            html += '    <li><a href="#tab-module' + token + '-language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>';
        <?php } ?>
        html += '  </ul>';

        html += '  <div class="tab-content">';


    <?php foreach ($languages as $language) { ?>
            html += '    <div class="tab-pane" id="tab-module' + token + '-language<?php echo $language['language_id']; ?>">';

            html += '      <div class="form-group">';
            html += '        <label class="col-sm-2 control-label" for="input-title' + token + '-language<?php echo $language['language_id']; ?>"><?php echo $entry_title; ?></label>';
            html += '        <div class="col-sm-10"><input type ="text" name="ocslideshow_image[' + token + '][ocslideshow_image_description][<?php echo $language['language_id']; ?>][title]"placeholder="<?php echo $entry_title; ?>" class="form-control" id="input-title' + token + '-language<?php echo $language['language_id']; ?>"/></div>';
            html += '      </div>';

            html += '      <div class="form-group">';
            html += '        <label class="col-sm-2 control-label" for="input-subtitle' + token + '-language<?php echo $language['language_id']; ?>"><?php echo $entry_subtitle; ?></label>';
            html += '        <div class="col-sm-10"><input class="form-control" type ="text" name="ocslideshow_image[' + token + '][ocslideshow_image_description][<?php echo $language['language_id']; ?>][sub_title]" placeholder="<?php echo $entry_subtitle; ?>" id="input-subtitle' + token + '-language<?php echo $language['language_id']; ?>"/></div>';
            html += '      </div>';



            html += '      <div class="form-group">';
            html += '        <label class="col-sm-2 control-label" for="input-description' + token + '-language<?php echo $language['language_id']; ?>"><?php echo $entry_description; ?></label>';
            html += '        <div class="col-sm-10"><textarea class="form-control summernote" name="ocslideshow_image[' + token + '][ocslideshow_image_description][<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" id="input-description' + token + '-language<?php echo $language['language_id']; ?>"></textarea></div>';
            html += '      </div>';
            html += '    </div>';
        <?php } ?>

        html += '      <div class="form-group">';
        html += '        <label class="col-sm-2 control-label" for="input-link' + token + '-language<?php echo $language['language_id']; ?>"><?php echo $entry_link; ?></label>';
        html += '        <div class="col-sm-10"><input class="form-control" type="text" name="ocslideshow_image[' + token + '][link]" placeholder="<?php echo $entry_link; ?>" id="input-link' + token + '-language<?php echo $language['language_id']; ?>"/></div>';
        html += '      </div>';

        html += '      <div class="form-group">';
        html += '        <label class="col-sm-2 control-label" for="input-image' + token + '-language<?php echo $language['language_id']; ?>"><?php echo $entry_image; ?></label>';

        html += '<div class="col-sm-10"><a href="" id="thumb-image' + token + '" data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="ocslideshow_image[' + token + '][image]" value="" id="input-image' + token + '" /></div>';
        html += '      </div>';

        html += '<div class="form-group" style="display: none;">';
        html += '<label class="col-sm-2 control-label" for="input-image">'+'<?php echo $entry_small_image; ?>'+'</label>';

        html += '<div class="col-sm-10">';
        html += '<a href="" id="thumb-image-'+'<?php echo $token_random+1; ?>'+'" data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>';
        html += '<input type="hidden"  name="ocslideshow_image['+ token +'][small_image]"  value="" id="input-image'+'<?php echo $token_random+1; ?>'+'" />';

        html += '</div>';
        html += '</div>';

        html +='  <div class="form-group">';
        html+='<label class="col-sm-2 control-label" for="input-image"><?php echo $entry_type; ?></label>';
        html +='<div class="col-sm-10">';
        html +='<select name="ocslideshow_image[' + token + '][type]" id="input-type" class="form-control">';
        html +='<option value="1" >Type 1</option><option value="2">Type 2</option><option value="3">Type 3</option>';
        html +='</select>'
        html +='</div></div>'

        html +='<div class="form-group">';
        html +='<label class="col-sm-2 control-label"><?php echo $entry_store; ?></label>';
        html +='<div class="col-sm-10">'
        html +='<div class="well well-sm" style="height: 150px; overflow: auto;">';
    <?php foreach ($stores as $store) { ?>
            html +='<div class="checkbox">';
            html +='<label>';
            html +='<input type="checkbox" name="ocslideshow_image[' + token + '][banner_store][]" value="<?php echo $store['store_id']; ?>"  /><?php echo $store['name']; ?>
            ';
            html +='</label>';
            html +='</div>';
        <?php } ?>
        html +='</div>';
        html +='</div>';
        html +='</div>';




        html += '  </div>';
        html += '</div>';

        $('.tab-content:first-child').prepend(html);

    <?php foreach ($languages as $language) { ?>
            $('#input-description' + token + '-language<?php echo $language['language_id']; ?>').summernote({
                height: 300
            });
        <?php } ?>

        $('#module-add').before('<li><a href="#tab-module' + token + '" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$(\'a[href=\\\'#tab-module' + token + '\\\']\').parent().remove(); $(\'#tab-module' + token + '\').remove(); $(\'#module a:first\').tab(\'show\');"></i> <?php echo $tab_banner; ?> ' + module_row + '</a></li>');

        $('#module a[href=\'#tab-module' + token + '\']').tab('show');

        $('#language' + token + ' li:first-child a').tab('show');

        module_row++;
    }
    //--></script>
    <script type="text/javascript"><!--
    $('#module li:first-child a').tab('show');
    <?php foreach ($ocslideshow_images as $ocslideshow_image) { ?>
        $('#language<?php echo $ocslideshow_image['key']; ?> li:first-child a').tab('show');
    <?php } ?>
    //--></script></div>
<style type="text/css">
    #module-add img {display:none!important;}
</style>
<?php echo $footer; ?>
