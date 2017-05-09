<?php if($widgets): ?>
	<?php $row_count = 0; ?>
    <?php foreach ($widgets as $rows): ?>
    <div class="main-row <?php echo $rows['class']; ?>">
        <div class="container">
            <div class="row">
                <?php foreach($rows['main_cols'] as $main_col): ?>
                <div class="main-col col-sm-12 col-md-<?php echo $main_col['format']; ?>">
                    <?php foreach($main_col['sub_rows'] as $sub_row): ?>
                    <div class="row sub-row">
                        <?php foreach($sub_row as $sub_col): ?>
                            <div class="sub-col col-sm-12 col-md-<?php echo $sub_col['format']; ?>">
                                <?php if(isset($sub_col['info'])): ?>
                                    <?php foreach($sub_col['info'] as $modules): ?>
                                        <?php echo $modules; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div><!-- sub-col -->
                        <?php endforeach; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
		<?php $row_count++; ?>
    </div><!-- end row <?php echo $row_count; ?>-->
    <?php endforeach; ?>
<?php endif; ?>