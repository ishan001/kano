<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-ocquickview" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-ocquickview" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                        <div class="col-sm-10">
                            <select name="ocquickview_status" id="input-status" class="form-control">
                                <?php if ($ocquickview_status) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-image"><?php echo $entry_image; ?></label>
                        <div class="col-sm-10">
                            <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title=""  /></a>
                            <input type="hidden" name="ocquickview_loader_img" value="<?php echo $ocquickview_loader_img; ?>" id="input-image" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="area-container"><span data-toggle="tooltip" title="<?php echo $help_quickview; ?>"><?php echo $entry_container; ?></span></label>
                        <div class="col-sm-5">
                            <?php if ($ocquickview_container) { ?>
                                <textarea id="area-container" name="ocquickview_container" cols="50" rows="10"><?php echo $ocquickview_container; ?></textarea>
                            <?php } else { ?>
                                <textarea id="area-container" name="ocquickview_container" cols="50" rows="10"></textarea>
                            <?php } ?>
                        </div>
                        <div class="col-sm-5">
                            <p>
                                <?php echo $note_guide; ?>
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-parent"><?php echo $entry_parent_element; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="ocquickview_parent_element" value="<?php echo $ocquickview_parent_element; ?>" placeholder="<?php echo $entry_parent_element; ?>" id="input-parent" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-children"><?php echo $entry_children_element; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="ocquickview_children_element" value="<?php echo $ocquickview_children_element; ?>" placeholder="<?php echo $entry_children_element; ?>" id="input-children" class="form-control" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>
