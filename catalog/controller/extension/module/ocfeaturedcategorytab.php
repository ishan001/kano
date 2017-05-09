<?php
class ControllerExtensionModuleOcfeaturedcategorytab extends Controller {

    public function index($setting) {
        $this->load->model('catalog/product');
        $this->load->model('catalog/category');
        $this->load->model('extension/module/ocfeaturedcategory');
        $this->load->model('catalog/ocproductrotator');
        $this->load->model('tool/image');
		
		$this->load->language('extension/module/ocfeaturedcategorytab');

        if (empty($setting['limit'])) {
            $setting['limit'] = 10;
        }

        if(isset($setting['rotator']) && $setting['rotator']) {
            $product_rotator_status = (int) $this->config->get('ocproductrotator_status');
        } else {
            $product_rotator_status = 0;
        }

        if(isset($setting['thumbnail']) && $setting['thumbnail']) {
            $use_thumbnail = true;
        } else {
            $use_thumbnail = false;
        }

        $filter_data = array(
            'rotator_status' => $product_rotator_status,
            'sort'  => 'p.date_added',
            'order' => 'DESC',
            'start' => 0,
            'limit' => $setting['limit']
        );

        $data = array();
        $data['categories'] = array();
        $_featured_categories = $this->model_extension_module_ocfeaturedcategory->getFeaturedCategories();
        if ($_featured_categories) {
            foreach ($_featured_categories as $_category) {
                if ($use_thumbnail) {
                    if ($_category['homethumb_image']) {
                        $homethumb_image = $this->model_tool_image->resize($_category['homethumb_image'], 100, 100);
                    } else {
                        $homethumb_image = $this->model_tool_image->resize('placeholder.png', 100, 100);
                    }

                    if ($_category['thumbnail_image']) {
                        $thumbnail_image = $this->model_tool_image->resize($_category['thumbnail_image'], 129, 76);
                    } else {
                        $thumbnail_image = $this->model_tool_image->resize('placeholder.png', 129, 76);
                    }
                } else {
                    $thumbnail_image = false;
                    $homethumb_image = false;
                }


                $filter_data['filter_category_id'] = $_category['category_id'];

                $data['categories'][] = array(
                    'category_id'  		=> $_category['category_id'],
                    'homethumb_image'   => $homethumb_image,
					'thumbnail_image'   => $thumbnail_image,
                    'name'        		=> $_category['name'],
                    'description' 		=> utf8_substr(strip_tags(html_entity_decode($_category['description'], ENT_QUOTES, 'UTF-8')), 0, 80) . 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod',
                    'href'        		=> $this->url->link('product/category', 'path=' . $_category['category_id']),
                    'products'          => $this->getProductFromData($filter_data,$setting)
                );
            }

            $data['config_slide'] = array(
                'items' => $setting['item'],
                'autoplay' => $setting['autoplay'],
                'shownextback' => $setting['shownextback'],
                'shownav' => $setting['shownav'],
                'speed' => $setting['speed'],
                'showprice' => $setting['showprice'],
                'showlabel' => $setting['showlabel'],
                'showdes' => $setting['showdes'],
                'showaddtocart' => $setting['showaddtocart'],
                'f_rows' => $setting['rows']
            );

            $alias = str_replace(' ','_',$setting['name']);
            $data['category_alias'] = $alias;

            $data['heading_title'] = $this->language->get('heading_title');

            $lang_code = $this->session->data['language'];

            if(isset($setting['title']) && $setting['title']) {
                $data['title'] = $setting['title'][$lang_code]['title'];
            } else {
                $data['title'] = $this->language->get('heading_title');
            }
            
            $data['tab_effect'] = 'wiggle';

            $data['text_tax'] = $this->language->get('text_tax');
            $data['text_sale'] = $this->language->get('text_sale');
            $data['text_new'] = $this->language->get('text_new');

            $data['button_cart'] = $this->language->get('button_cart');
            $data['button_wishlist'] = $this->language->get('button_wishlist');
            $data['button_compare'] = $this->language->get('button_compare');
            $data['exist_fcate'] = true;
        } else {
            $data['exist_fcate'] = false;
        }

        $data['status'] = $setting['status'];
		$data['text_empty_categories'] = $this->language->get('text_empty_categories');
		$data['text_empty_products'] = $this->language->get('text_empty_products');

        if($data['categories']) {
            return $this->load->view('extension/module/ocfeaturedcategorytab', $data);
        }
    }
    public function getProductFromData($data= array(), $setting = array()) {
        $product_list = array();

        if($data['rotator_status']) {
            $product_rotator_status = (int) $this->config->get('ocproductrotator_status');
        } else {
            $product_rotator_status = 0;
        }

        /* Get new product */
        $filter_data = array(
            'sort'  => 'p.date_added',
            'order' => 'DESC',
            'start' => 0,
            'limit' => 10
        );

        $new_results = $this->model_catalog_product->getProducts($filter_data);
        /* End */

		$results = $this->model_catalog_product->getProducts($data);
        foreach ($results as $result) {
            if ($result['image']) {
                $image = $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']);
            } else {
                $image = false;
            }

            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
                $price_num = $this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax'));
            } else {
                $price = false;
                $price_num = false;
            }

            if ((float)$result['special']) {
                $special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
                $special_num = $this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax'));
            } else {
                $special = false;
                $special_num = false;
            }

            if ($this->config->get('config_review_status')) {
                $rating = $result['rating'];
            } else {
                $rating = false;
            }

            if($product_rotator_status == 1) {
                $product_id = $result['product_id'];
                $product_rotator_image = $this->model_catalog_ocproductrotator->getProductRotatorImage($product_id);

                if($product_rotator_image) {
                    $rotator_image = $this->model_tool_image->resize($product_rotator_image, $setting['width'], $setting['height']);
                } else {
                    $rotator_image = false;
                }
            } else {
                $rotator_image = false;
            }
				

			$is_new = false;
            if ($new_results) {
                foreach($new_results as $new_r) {
                    if($result['product_id'] == $new_r['product_id']) {
                        $is_new = true;
                    }
                }
            }
			$data['tags'] = array();

			if ($result['tag']) {
				$tags = explode(',', $result['tag']);

				foreach ($tags as $tag) {
					$data['tags'][] = array(
						'tag'  => trim($tag),
						'href' => $this->url->link('product/search', 'tag=' . trim($tag))
					);
				}
			}
			
			$result['name'] = strlen($result['name']) > 30 ? substr($result['name'],0,30)."..." : $result['name'];

            $product_list[] = array(
                'product_id' => $result['product_id'],
                'thumb'   	 => $image,
				'rotator_image' => $rotator_image,
                'name'    	 => $result['name'],
                'price'   	 => $price,
                'price_num'   	 => $price_num,
                'special' 	 => $special,
                'special_num' 	 => $special_num,
				'is_new'      => $is_new,
                'rating'     => $rating,
				'tags'         => $data['tags'],
                'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
                'reviews'    => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
                'href'    	 => $this->url->link('product/product', 'product_id=' . $result['product_id']),
            );
        }

        return $product_list;
    }
}