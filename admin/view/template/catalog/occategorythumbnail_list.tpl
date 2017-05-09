<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
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
        <?php if ($success) { ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <?php if ($information) { ?>
        <div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $information; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <td class="text-left"><?php if ($sort == 'name') { ?>
                                <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                                <?php } ?></td>
                            <td class="text-center"><?php echo $column_thumbnail; ?></td>
                            <td class="text-center"><?php echo $column_homethumb; ?></td>
                            <td class="text-center"><?php echo $column_featured; ?></div>
                            <td class="text-right"><?php if ($sort == 'sort_order') { ?>
                                <a href="<?php echo $sort_sort_order; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sort_order; ?></a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_sort_order; ?>"><?php echo $column_sort_order; ?></a>
                                <?php } ?></td>
                            <td class="text-right"><?php echo $column_action; ?></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($categories) { ?>
                        <?php foreach ($categories as $category) { ?>
                        <tr>
                            <td class="text-left"><?php echo $category['name']; ?></td>
                            <td class="text-center"><?php if ($category['thumbnail_image']) { ?>
                                <img src="<?php echo $category['thumbnail_image']; ?>" alt="<?php echo $category['name']; ?>" class="img-thumbnail" />
                                <?php } else { ?>
                                <span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
                                <?php } ?></td>
                            <td class="text-center"><?php if ($category['homethumb_image']) { ?>
                                <img src="<?php echo $category['homethumb_image']; ?>" alt="<?php echo $category['name']; ?>" class="img-thumbnail" />
                                <?php } else { ?>
                                <span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
                                <?php } ?></td>
                            <td class="text-center">
                                <?php if($category['featured'] == 1): ?>
                                    <span>Yes</span>
                                <?php else: ?>
                                    <span>No</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-right"><?php echo $category['sort_order']; ?></td>
                            <td class="text-right"><a href="<?php echo $category['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                        <tr>
                            <td class="text-center" colspan="4"><?php echo $text_no_results; ?></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                    <div class="col-sm-6 text-right"><?php echo $results; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>