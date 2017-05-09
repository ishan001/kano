<div id="search-by-category">
    <div class="search-container">
        
        <div class="categories-container">
            <div class="hover-cate">
            <p><span class="cate-selected" data-value="0"><?php echo $text_category; ?></span><i class="fa fa-caret-down"></i></p>

            <ul class="cate-items">
                <li class="item-cate" data-value="0"><?php echo $text_category; ?></li>
                <?php foreach ($categories as $category_1) { ?>
                <?php if ($category_1['category_id'] == $category_id) { ?>
                <li data-value="<?php echo $category_1['category_id']; ?>" class="selected item-cate" ><?php echo $category_1['name']; ?></li>
                <?php } else { ?>
                <li data-value="<?php echo $category_1['category_id']; ?>" class="item-cate"><?php echo $category_1['name']; ?></li>
                <?php } ?>
                <?php foreach ($category_1['children'] as $category_2) { ?>
                <?php if ($category_2['category_id'] == $category_id) { ?>
                <li data-value="<?php echo $category_2['category_id']; ?>" class="selected item-cate f1"><?php echo $category_2['name']; ?></li>
                <?php } else { ?>
                <li data-value="<?php echo $category_2['category_id']; ?>" class="item-cate f1"><?php echo $category_2['name']; ?></li>
                <?php } ?>
                <?php foreach ($category_2['children'] as $category_3) { ?>
                <?php if ($category_3['category_id'] == $category_id) { ?>
                <li data-value="<?php echo $category_3['category_id']; ?>" class="selected item-cate f2"><?php echo $category_3['name']; ?></li>
                <?php } else { ?>
                <li data-value="<?php echo $category_3['category_id']; ?>" class="item-cate f2"><?php echo $category_3['name']; ?></li>
                <?php } ?>
                <?php } ?>
                <?php } ?>
                <?php } ?>
            </ul>
            </div>
        </div>
        <input type="text" name="search" id="text-search" value="" placeholder="<?php echo $text_search; ?>" class=""  />
        
    </div>
    <div id="sp-btn-search" class="">
            <button type="button" id="btn-search-category" class="btn btn-default btn-lg">
                <span><i class="fa fa-search"></i></span>
            </button>
        </div>
    <div class="search-ajax">
        <div class="ajax-loader-container" style="display: none;">
            <img src="<?php echo $ocsearchcategory_loader_img ?>" class="ajax-load-img" width="30" height="30" alt="plazathemes.com" />
        </div>
        <div class="ajax-result-container">
            <!-- Content of search results -->
        </div>
    </div>
    <input type="hidden" id="ajax-search-enable" value="<?php echo $ocsearchcategory_ajax_enabled ?>" />
</div>

<script type="text/javascript">


    $(document).ready(function () {
        
        var flag = false;
        var ajax_search_enable = $('#ajax-search-enable').val();
        
        var current_cate_value = $('ul.cate-items li.selected').data('value');
        var current_cate_text = $('ul.cate-items li.selected').html();
        
        $('.cate-selected').attr('data-value', current_cate_value);
        $('.cate-selected').html(current_cate_text);
        
        $('.hover-cate p').click(function () {
            $( ".cate-items" ).toggle("slow");
        });
        
        $('.ajax-result-container').hover(
            function() {
                flag = true;
            },
            function() {
                flag = false;
            }
        );
        
        $('.hover-cate').hover(
            function() {
                flag = true;
            },
            function() {
                flag = false;
            }
        );
        
        $('#search-by-category').focusout(function() {
            if(flag == true) {
                $('.ajax-result-container').show();
            } else {
                $('.ajax-result-container').hide();
            }
        });
        
        $('#search-by-category').focusin(function() {
            $('.ajax-result-container').show();
        });

        $('#btn-search-category').click(function () {
            var url = '<?php echo $search_action; ?>';
            var text_search = $('#text-search').val();
            if(text_search) {
                url += '&search=' + encodeURIComponent(text_search);
            }

            var category_search = $('.cate-selected').attr("data-value");
            if(category_search) {
                url += '&category_id=' + encodeURIComponent(category_search);
            }

            location = url;
        });

        if(ajax_search_enable == '1') {
            $('#text-search').keyup(function(e) {
                var text_search = $(this).val();
                var cate_search = $('.cate-selected').attr("data-value");
                if(text_search != null && text_search != '') {
                    ajaxSearch(text_search, cate_search);
                } else {
                    $('.ajax-result-container').html('');
                    $('.ajax-loader-container').hide();
                }
            });

            $('ul.cate-items li.item-cate').click(function() {
                var cate_search = $(this).data('value');
                var text_search = $('#text-search').val();
                $('.cate-selected').attr('data-value', cate_search);
                $('.cate-selected').html($(this).html());
                if(text_search != null && text_search != '') {
                    ajaxSearch(text_search, cate_search);
                } else {
                    $('.ajax-result-container').html('');
                    $('.ajax-loader-container').hide();
                }
                $( ".cate-items" ).hide();
                $('#text-search').focus();
            });

        }
        
        function ajaxSearch(text_search, cate_search) {
            $.ajax({
                url         : '<?php echo $search_ajax_action ?>',
                type        : 'post',
                data        : { text_search : text_search, cate_search : cate_search },
                beforeSend  : function () {
                    $('.ajax-loader-container').show();
                },
                success     : function(json) {
                    if(json['success'] == true) {
                        $('.ajax-result-container').html(json['result_html']);
                        $('.ajax-loader-container').hide();
                    }
                }
            });
        }

    });    
</script>