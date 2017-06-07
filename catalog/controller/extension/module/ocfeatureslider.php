<?php
class ControllerExtensionModuleOcfeatureslider extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/ocfeatureslider');

		$this->load->model('catalog/product');
		$this->load->model('catalog/ocproductrotator');
		$this->load->model('tool/image');

		$data = array();

		$data['heading_title'] = $this->language->get('heading_title');

		$lang_code = $this->session->data['language'];

		if(isset($setting['title']) && $setting['title']) {
			$data['title'] = $setting['title'][$lang_code]['title'];
		} else {
			$data['title'] = $this->language->get('heading_title');
		}

		$data['text_tax'] = $this->language->get('text_tax');
		$data['text_empty'] = $this->language->get('text_empty');
		$data['text_sale'] = $this->language->get('text_sale');
		$data['text_new'] = $this->language->get('text_new');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');

		$data['products'] = array();
		
		if (empty($setting['limit'])) {
			$setting['limit'] = 4;
		}

		$new_filter_data = array(
				'sort'  => 'p.date_added',
				'order' => 'DESC',
				'start' => 0,
				'limit' => 10
		);

		$new_results = $this->model_catalog_product->getProducts($new_filter_data);

		if(isset($setting['rotator']) && $setting['rotator']) {
			$product_rotator_status = (int) $this->config->get('ocproductrotator_status');
		} else {
			$product_rotator_status = 0;
		}

		$products = array_slice($setting['product'], 0, (int)$setting['limit']);

		foreach ($products as $product_id) {
			$product_info = $this->model_catalog_product->getProduct($product_id);

			if ($product_info) {
				if ($product_info['image']) {
					$image = $this->model_tool_image->resize($product_info['image'], $setting['width'], $setting['height']);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
				}

				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$price = false;
				}

				if ((float)$product_info['special']) {
					$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price'], $this->session->data['currency']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = $product_info['rating'];
				} else {
					$rating = false;
				}

				if($product_rotator_status == 1) {
					$product_id = $product_info['product_id'];
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
						if($product_info['product_id'] == $new_r['product_id']) {
							$is_new = true;
						}
					}
				}
				
				$data['tags'] = array();

				if ($product_info['tag']) {
					$tags = explode(',', $product_info['tag']);

					foreach ($tags as $tag) {
						$data['tags'][] = array(
							'tag'  => trim($tag),
							'href' => $this->url->link('product/search', 'tag=' . trim($tag))
						);
					}
				}
				
				$product_info['name'] = strlen($product_info['name']) > 40 ? substr($product_info['name'],0,40)."..." : $product_info['name'];

				$data['products'][] = array(
					'product_id'  => $product_info['product_id'],
					'is_new' => $is_new,
					'thumb'       => $image,
					'rotator_image' => $rotator_image,
					'name'        => $product_info['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'tags'         => $data['tags'],
					'rating'      => $rating,
					'href'        => $this->url->link('product/product', 'product_id=' . $product_info['product_id'])
				);
			}
		}
		
		$data['config_slide'] = array(
				'items' => $setting['item'],
				'autoplay' => $setting['autoplay'],
				'f_show_nextback' => $setting['shownextback'],
				'f_show_ctr' => $setting['shownav'],
				'f_speed' => $setting['speed'],
				'f_show_label' => $setting['showlabel'],
				'f_show_price' => $setting['showprice'],
				'f_show_des' => $setting['showdes'],
				'f_show_addtocart' => $setting['showaddtocart'],
				'f_rows' => $setting['rows']
		);

		return $this->load->view('extension/module/ocfeatureslider', $data);
	}
}