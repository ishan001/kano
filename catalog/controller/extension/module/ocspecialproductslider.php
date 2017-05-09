<?php
class ControllerExtensionModuleOcspecialproductslider extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/ocspecialproductslider');

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
		$data['button_compare'] = $this->language->get('button_compare');;

		$data['products'] = array();

		if (empty($setting['limit'])) {
			$setting['limit'] = 10;
		}

		if(isset($setting['rotator']) && $setting['rotator']) {
			$product_rotator_status = (int) $this->config->get('ocproductrotator_status');
		} else {
			$product_rotator_status = 0;
		}

		$filter_data = array(
			'sort'  => 'pd.name',
			'order' => 'ASC',
			'start' => 0,
			'limit' => $setting['limit']
		);

		$results = $this->model_catalog_product->getProductSpecials($filter_data);

		if ($results) {
			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
				}

				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price_num = $this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax'));
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$price_num = false;
					$price = false;
				}

				if ((float)$result['special']) {
					$special_num = $this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax'));
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$special_num = false;
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price'], $this->session->data['currency']);
				} else {
					$tax = false;
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
				
				$result['name'] = strlen($result['name']) > 40 ? substr($result['name'],0,40)."..." : $result['name'];

				$data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'rotator_image' => $rotator_image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
					'price_num'       => $price_num,
					'price'       => $price,
					'special'     => $special,
					'special_num'     => $special_num,
					'tax'         => $tax,
					'tags'         => $data['tags'],
					'rating'      => $rating,
					'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])
				);
			}
		}

		$data['config_slide'] = array(
			'items' => $setting['item'],
			'autoplay' => $setting['autoplay'],
			'f_show_nextback' => $setting['shownextback'],
			'f_show_ctr' => $setting['shownav'],
			'f_show_label' => $setting['showlabel'],
			'f_speed' => $setting['speed'],
			'f_show_price' => $setting['showprice'],
			'f_show_des' => $setting['showdes'],
			'f_show_addtocart' => $setting['showaddtocart'],
			'f_rows' => $setting['rows']
		);

		return $this->load->view('extension/module/ocspecialproductslider', $data);
	}
}