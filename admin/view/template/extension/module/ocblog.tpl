<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a href="<?php echo $list_action; ?>" data-toggle="tooltip" title="<?php echo $button_article_list; ?>" class="btn btn-default"><i class="fa fa-pencil-square-o"></i></a>
                <button type="submit" form="form-blog" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
            </div>
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
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-blog" class="form-horizontal">
                    <fieldset>
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
                            <label class="col-sm-2 control-label" for="input-title"><?php echo $entry_title; ?></label>
                            <div class="col-sm-10">
                                <?php foreach ($languages as $language) { ?>
                                <div class="input-group">
                                    <span class="input-group-addon"><?php echo $language['name']; ?></span>
                                    <input type="text" name="title[<?php echo $language['code']; ?>][title]" value="<?php echo isset($title[$language['code']]['title']) ? $title[$language['code']]['title'] : ''; ?>" placeholder="" id="input-title<?php echo $language['language_id']; ?>" class="form-control" />
                                </div>
                                <?php } ?>
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
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-list"><?php echo $entry_article_list; ?></label>
                            <div class="col-sm-10">
                                <select name="list" id="input-list" class="form-control">
                                <?php if ($article_lists) { ?>
                                    <?php foreach($article_lists as $article_list): ?>
                                        <?php if($list): ?>
                                            <?php if((int) $list == (int) $article_list['article_list_id']): ?>
                                                <option value="<?php echo $article_list['article_list_id']; ?>" selected="selected"><?php echo $article_list['name']; ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo $article_list['article_list_id']; ?>"><?php echo $article_list['name']; ?></option>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <option value="<?php echo $article_list['article_list_id']; ?>"><?php echo $article_list['name']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-width"><?php echo $entry_width; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="width" value="<?php echo $width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-width" class="form-control" />
                                <?php if ($error_width) { ?>
                                <div class="text-danger"><?php echo $error_width; ?></div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-height"><?php echo $entry_height; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="height" value="<?php echo $height; ?>" placeholder="<?php echo $entry_height; ?>" id="input-height" class="form-control" />
                                <?php if ($error_height) { ?>
                                <div class="text-danger"><?php echo $error_height; ?></div>
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
                            <label class="col-sm-2 control-label" for="input-items"><?php echo $entry_items; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="items" value="<?php echo $items; ?>" placeholder="<?php echo $entry_items; ?>" id="input-items" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-speed"><?php echo $entry_speed; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="speed" value="<?php echo $speed; ?>" placeholder="<?php echo $entry_speed; ?>" id="input-speed" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-rows"><?php echo $entry_rows; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="rows" value="<?php echo $rows; ?>" placeholder="<?php echo $entry_rows; ?>" id="input-rows" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-navigation"><?php echo $entry_navigation; ?></label>
                            <div class="col-sm-10">
                                <select name="navigation" id="input-navigation" class="form-control">
                                    <?php if ($navigation) { ?>
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
                            <label class="col-sm-2 control-label" for="input-pagination"><?php echo $entry_pagination; ?></label>
                            <div class="col-sm-10">
                                <select name="pagination" id="input-pagination" class="form-control">
                                    <?php if ($pagination) { ?>
                                    <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                    <option value="0"><?php echo $text_no; ?></option>
                                    <?php } else { ?>
                                    <option value="1"><?php echo $text_yes; ?></option>
                                    <option value="0" selected="selected"><?php echo $text_no; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-blog-limit"><span data-toggle="tooltip" title="<?php echo $help_article_limit; ?>"><?php echo $entry_article_limit; ?></span></label>
                            <div class="col-sm-10">
                                <input type="text" name="ocblog_article_limit" value="<?php echo $ocblog_article_limit; ?>" placeholder="<?php echo $entry_article_limit; ?>" id="input-blog-limit" class="form-control" />
                                <?php if ($error_article_limit) { ?>
                                <div class="text-danger"><?php echo $error_article_limit; ?></div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-blog-meta-title"><?php echo $entry_meta_title; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="ocblog_meta_title" value="<?php echo $ocblog_meta_title; ?>" placeholder="<?php echo $entry_meta_title; ?>" id="input-blog-meta-title" class="form-control" />
                                <?php if ($error_meta_title) { ?>
                                <div class="text-danger"><?php echo $error_meta_title; ?></div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-blog-meta-description"><?php echo $entry_meta_description; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="ocblog_meta_description" value="<?php echo $ocblog_meta_description; ?>" placeholder="<?php echo $entry_meta_description; ?>" id="input-blog-meta-description" class="form-control" />
                                <?php if ($error_meta_description) { ?>
                                <div class="text-danger"><?php echo $error_meta_description; ?></div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-blog-meta-keyword"><?php echo $entry_meta_keyword; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="ocblog_meta_keyword" value="<?php echo $ocblog_meta_keyword; ?>" placeholder="<?php echo $entry_meta_keyword; ?>" id="input-blog-meta-keyword" class="form-control" />
                                <?php if ($error_meta_keyword) { ?>
                                <div class="text-danger"><?php echo $error_meta_keyword; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>