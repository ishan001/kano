<div class="list-group">
    <div class="filter-attribute-container filter-attribute-remove-container">
        <?php $is_filter = false; ?>
        <?php foreach($filter_groups as $filter_group): ?>
            <?php foreach ($filter_group['filter'] as $filter) : ?>
                <?php $filter_id = $filter['filter_id']; ?>
                <?php if (in_array($filter['filter_id'], $filter_category)) : ?>
                    <?php $is_filter = true; ?>
                    <div class="list-group-item filter-act-name">
                        <p><?php echo $filter['e_name']; ?></p>
                        <a class="a-filter remove-filter" href="javascript:void(0);" name="<?php echo $filter_id ?>"><span>Remove</span></a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
        <?php if($is_filter): ?>
            <div class="list-group-item filter-clear-all">
                <a class="clear-filter" href="javascript:void(0);" onclick="oclayerednavigationajax.filter('<?php echo $clear_action ?>')">Clear all</a>
            </div>
        <?php endif; ?>
    </div>
    <div class="filter-attribute-container">
        <label>Price</label>
        <div class="list-group-item">
            <div class="filter-price">
                <div id="slider-price"></div>
                <div class="slider-values">
                    <span><?php echo $currency_symbol; ?></span>
                    <input id="price-from" disabled="disabled" class="input-price" type="text" value="<?php echo $current_min_price ?>" placeholder="Min" name="price-from"/> -
                    <span><?php echo $currency_symbol; ?></span>
                    <input id="price-to" disabled="disabled" class="input-price" type="text" value="<?php echo $current_max_price ?>" placeholder="Max" name="price-to" />
                </div>
            </div>
        </div>
    </div>
    <?php foreach ($filter_groups as $filter_group) { ?>
    <div class="filter-attribute-container">
        <label><?php echo $filter_group['name']; ?></label>
        <div class="list-group-item">
            <div id="filter-group<?php echo $filter_group['filter_group_id']; ?>">
                <?php foreach ($filter_group['filter'] as $filter) { ?>
                <?php $filter_id = $filter['filter_id']; ?>
                <?php if (in_array($filter['filter_id'], $filter_category)) { ?>
                    <!-- Not show filter attribute -->
                <?php } else { ?>
                    <a class="a-filter add-filter" href="javascript:void(0);" name="<?php echo $filter_id ?>"><?php echo $filter['name']; ?></a>
                <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
