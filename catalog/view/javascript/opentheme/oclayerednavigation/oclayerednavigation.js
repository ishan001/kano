$(document).ready(function() {
    oclayerednavigationajax.productViewChange();
    oclayerednavigationajax.paginationChangeAction();
});

var oclayerednavigationajax = {

    /* Filter action */
    'filter' : function(filter_url) {
        var old_route = 'route=product/category';
        var new_route = 'route=extension/module/oclayerednavigation/category';
        if(filter_url.search(old_route) != -1) {
            filter_url = filter_url.replace(old_route, new_route);
        }

        if(filter_url.search(new_route) != -1) {
            $.ajax({
                url         : filter_url,
                type        : 'get',
                beforeSend  : function () {
                    $('.layered-navigation-block').show();
                    $('.ajax-loader').show();
                },
                success     : function(json) {
                    $('.filter-url').val(json['filter_action']);
                    $('.price-url').val(json['price_action']);
                    $('.custom-category').html(json['result_html']);
                    $('.layered').html(json['layered_html']);
                    oclayerednavigationajax.paginationChangeAction();
                    oclayerednavigationajax.productViewChange();
                    $('.layered-navigation-block').hide();
                    $('.ajax-loader').hide();
                }
            });
        }

    },

    /* Use again and update ajaxComplete from common.js */
    'productViewChange' : function() {
        // Product List
        $('#list-view').click(function() {
            $('#content .product-layout > .clearfix').remove();

            $('#content .product-layout').attr('class', 'product-layout product-list col-xs-12');

            localStorage.setItem('display', 'list');
        });

        // Product Grid
        $('#grid-view').click(function() {
            $('#content .product-layout > .clearfix').remove();

            // What a shame bootstrap does not take into account dynamically loaded columns
            cols = $('#column-right, #column-left').length;

            if (cols == 2) {
                $('#content .product-layout').attr('class', 'product-layout product-grid col-md-6 col-sm-12 col-xs-12 two-items');
            } else if (cols == 1) {
                $('#content .product-layout').attr('class', 'product-layout product-grid col-md-4 col-sm-6 col-xs-12 three-items');
            } else {
                $('#content .product-layout').attr('class', 'product-layout product-grid col-md-3 col-sm-6 col-xs-12 four-items');
            }

            localStorage.setItem('display', 'grid');
        });

        if (localStorage.getItem('display') == 'list') {
            $('#list-view').trigger('click');
        } else {
            $('#grid-view').trigger('click');
        }
    },
    
    /* Modify pagination links */
    paginationChangeAction: function () {
        $('.layer-category .custom-category .pagination a').each(function () {
            var href = $(this).attr('href');
            $(this).attr('onclick', 'oclayerednavigationajax.filter("'+ href +'")');
            $(this).attr('href', 'javascript:void(0);');
        });
    }

};