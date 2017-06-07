<?php 
class ControllerExtensionModuleOcquickview extends Controller
{
	public function index() {

		$this->load->language('product/product');
		$this->load->model('catalog/product');

		$json = array();

		if (isset($this->request->get['product_id'])) {
			$product_id = (int)$this->request->get['product_id'];
		} else {
			$product_id = 0;
		}

		$product_info = $this->model_catalog_product->getProduct($product_id);
		$data['product_name'] = $product_info['name'];

		$data['heading_title'] = $product_info['name'];

		$data['text_select'] = $this->language->get('text_select');
		$data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$data['text_model'] = $this->language->get('text_model');
		$data['text_reward'] = $this->language->get('text_reward');
		$data['text_points'] = $this->language->get('text_points');
		$data['text_stock'] = $this->language->get('text_stock');
		$data['text_discount'] = $this->language->get('text_discount');
		$data['text_tax'] = $this->language->get('text_tax');
		$data['text_option'] = $this->language->get('text_option');
		$data['text_minimum'] = sprintf($this->language->get('text_minimum'), $product_info['minimum']);
		$data['text_write'] = $this->language->get('text_write');
		$data['text_login'] = sprintf($this->language->get('text_login'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));
		$data['text_note'] = $this->language->get('text_note');
		$data['text_tags'] = $this->language->get('text_tags');
		$data['text_related'] = $this->language->get('text_related');
		$data['text_loading'] = $this->language->get('text_loading');

		$data['entry_qty'] = $this->language->get('entry_qty');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_review'] = $this->language->get('entry_review');
		$data['entry_rating'] = $this->language->get('entry_rating');
		$data['entry_good'] = $this->language->get('entry_good');
		$data['entry_bad'] = $this->language->get('entry_bad');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');
		$data['button_upload'] = $this->language->get('button_upload');
		$data['button_continue'] = $this->language->get('button_continue');

		$this->load->model('catalog/review');

		$data['tab_description'] = $this->language->get('tab_description');
		$data['tab_attribute'] = $this->language->get('tab_attribute');
		$data['tab_review'] = sprintf($this->language->get('tab_review'), $product_info['reviews']);

		$data['product_id'] = (int)$this->request->get['product_id'];
		$data['manufacturer'] = $product_info['manufacturer'];
		$data['manufacturers'] = $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $product_info['manufacturer_id']);
		$data['model'] = $product_info['model'];
		$data['reward'] = $product_info['reward'];
		$data['points'] = $product_info['points'];
		$data['description'] = html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8');
		$data['short_description'] = utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..';

		if ($product_info['quantity'] <= 0) {
			$data['stock'] = $product_info['stock_status'];
		} elseif ($this->config->get('config_stock_display')) {
			$data['stock'] = $product_info['quantity'];
		} else {
			$data['stock'] = $this->language->get('text_instock');
		}

		$this->load->model('tool/image');

		if ($product_info['image']) {
			$data['popup'] = $this->model_tool_image->resize($product_info['image'], $this->config->get($this->config->get('config_theme') . '_image_popup_width'), $this->config->get($this->config->get('config_theme') . '_image_popup_height'));
		} else {
			$data['popup'] = '';
		}

		if ($product_info['image']) {
			$data['thumb'] = $this->model_tool_image->resize($product_info['image'], $this->config->get($this->config->get('config_theme') . '_image_thumb_width'), $this->config->get($this->config->get('config_theme') . '_image_thumb_height'));
		} else {
			$data['thumb'] = '';
		}

		$data['images'] = array();

		$results = $this->model_catalog_product->getProductImages($this->request->get['product_id']);

		foreach ($results as $result) {
			$data['images'][] = array(
				'popup' => $this->model_tool_image->resize($result['image'], $this->config->get($this->config->get('config_theme') . '_image_popup_width'), $this->config->get($this->config->get('config_theme') . '_image_popup_height')),
				'thumb' => $this->model_tool_image->resize($result['image'], $this->config->get($this->config->get('config_theme') . '_image_additional_width'), $this->config->get($this->config->get('config_theme') . '_image_additional_height'))
			);
		}

		if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
			$data['price'] = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
		} else {
			$data['price'] = false;
		}

		if ((float)$product_info['special']) {
			$data['special'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
		} else {
			$data['special'] = false;
		}

		if ($this->config->get('config_tax')) {
			$data['tax'] = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price'], $this->session->data['currency']);
		} else {
			$data['tax'] = false;
		}

		$discounts = $this->model_catalog_product->getProductDiscounts($this->request->get['product_id']);

		$data['discounts'] = array();

		foreach ($discounts as $discount) {
			$data['discounts'][] = array(
				'quantity' => $discount['quantity'],
				'price'    => $this->currency->format($this->tax->calculate($discount['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency'])
			);
		}
		
		$data['short_description'] = utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..';

		$data['options'] = array();

		foreach ($this->model_catalog_product->getProductOptions($this->request->get['product_id']) as $option) {
			$product_option_value_data = array();

			foreach ($option['product_option_value'] as $option_value) {
				if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
					if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price']) {
						$price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->config->get('config_tax') ? 'P' : false), $this->session->data['currency']);
					} else {
						$price = false;
					}

					$product_option_value_data[] = array(
						'product_option_value_id' => $option_value['product_option_value_id'],
						'option_value_id'         => $option_value['option_value_id'],
						'name'                    => $option_value['name'],
						'image'                   => $this->model_tool_image->resize($option_value['image'], 50, 50),
						'price'                   => $price,
						'price_prefix'            => $option_value['price_prefix']
					);
				}
			}

			$data['options'][] = array(
				'product_option_id'    => $option['product_option_id'],
				'product_option_value' => $product_option_value_data,
				'option_id'            => $option['option_id'],
				'name'                 => $option['name'],
				'type'                 => $option['type'],
				'value'                => $option['value'],
				'required'             => $option['required']
			);
		}

		if ($product_info['minimum']) {
			$data['minimum'] = $product_info['minimum'];
		} else {
			$data['minimum'] = 1;
		}

		$data['review_status'] = $this->config->get('config_review_status');

		if ($this->config->get('config_review_guest') || $this->customer->isLogged()) {
			$data['review_guest'] = true;
		} else {
			$data['review_guest'] = false;
		}

		if ($this->customer->isLogged()) {
			$data['customer_name'] = $this->customer->getFirstName() . '&nbsp;' . $this->customer->getLastName();
		} else {
			$data['customer_name'] = '';
		}

		$data['reviews'] = sprintf($this->language->get('text_reviews'), (int)$product_info['reviews']);
		$data['rating'] = (int)$product_info['rating'];

		$data['share'] = $this->url->link('product/product', 'product_id=' . (int)$this->request->get['product_id']);

		$data['attribute_groups'] = $this->model_catalog_product->getProductAttributes($this->request->get['product_id']);

		$this->model_catalog_product->updateViewed($this->request->get['product_id']);

		// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('review', (array)$this->config->get('config_captcha_page'))) {
			$data['captcha'] = $this->load->controller('captcha/' . $this->config->get('config_captcha'));
		} else {
			$data['captcha'] = '';
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

		$data['recurrings'] = $this->model_catalog_product->getProfiles($this->request->get['product_id']);

		if(!$json) {
			$json['html'] = $this->load->view('extension/module/ocquickview/product.tpl', $data);
			$json['success'] = true;
		}
		$this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));

	}

	public function seoview() {

		$this->load->language('product/product');
		$this->load->model('catalog/product');
		$this->load->model('extension/module/ocquickview');
		$this->load->language('module/ocquickview');

		$json = array();

		if(!$json) {
			if (isset($this->request->get['ourl'])) {
				$seo_url = $this->request->get['ourl'];

				$product_id = $this->model_extension_module_ocquickview->getProductBySeoUrl($seo_url);

				$product_info = $this->model_catalog_product->getProduct($product_id);

				$data['product_name'] = $product_info['name'];

				$data['heading_title'] = $product_info['name'];

				$data['text_select'] = $this->language->get('text_select');
				$data['text_quickview'] = $this->language->get('text_quickview');
				$data['text_manufacturer'] = $this->language->get('text_manufacturer');
				$data['text_model'] = $this->language->get('text_model');
				$data['text_reward'] = $this->language->get('text_reward');
				$data['text_points'] = $this->language->get('text_points');
				$data['text_stock'] = $this->language->get('text_stock');
				$data['text_discount'] = $this->language->get('text_discount');
				$data['text_tax'] = $this->language->get('text_tax');
				$data['text_option'] = $this->language->get('text_option');
				$data['text_minimum'] = sprintf($this->language->get('text_minimum'), $product_info['minimum']);
				$data['text_write'] = $this->language->get('text_write');
				$data['text_login'] = sprintf($this->language->get('text_login'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));
				$data['text_note'] = $this->language->get('text_note');
				$data['text_tags'] = $this->language->get('text_tags');
				$data['text_related'] = $this->language->get('text_related');
				$data['text_loading'] = $this->language->get('text_loading');

				$data['entry_qty'] = $this->language->get('entry_qty');
				$data['entry_name'] = $this->language->get('entry_name');
				$data['entry_review'] = $this->language->get('entry_review');
				$data['entry_rating'] = $this->language->get('entry_rating');
				$data['entry_good'] = $this->language->get('entry_good');
				$data['entry_bad'] = $this->language->get('entry_bad');

				$data['button_cart'] = $this->language->get('button_cart');
				$data['button_wishlist'] = $this->language->get('button_wishlist');
				$data['button_compare'] = $this->language->get('button_compare');
				$data['button_upload'] = $this->language->get('button_upload');
				$data['button_continue'] = $this->language->get('button_continue');

				$this->load->model('catalog/review');

				$data['tab_description'] = $this->language->get('tab_description');
				$data['tab_attribute'] = $this->language->get('tab_attribute');
				$data['tab_review'] = sprintf($this->language->get('tab_review'), $product_info['reviews']);

				$data['product_id'] = (int) $product_id;
				$data['manufacturer'] = $product_info['manufacturer'];
				$data['manufacturers'] = $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $product_info['manufacturer_id']);
				$data['model'] = $product_info['model'];
				$data['reward'] = $product_info['reward'];
				$data['points'] = $product_info['points'];
				$data['description'] = html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8');

				if ($product_info['quantity'] <= 0) {
					$data['stock'] = $product_info['stock_status'];
				} elseif ($this->config->get('config_stock_display')) {
					$data['stock'] = $product_info['quantity'];
				} else {
					$data['stock'] = $this->language->get('text_instock');
				}

				$this->load->model('tool/image');

				if ($product_info['image']) {
					$data['popup'] = $this->model_tool_image->resize($product_info['image'], $this->config->get($this->config->get('config_theme') . '_image_popup_width'), $this->config->get($this->config->get('config_theme') . '_image_popup_height'));
				} else {
					$data['popup'] = '';
				}

				if ($product_info['image']) {
					$data['thumb'] = $this->model_tool_image->resize($product_info['image'], $this->config->get($this->config->get('config_theme') . '_image_thumb_width'), $this->config->get($this->config->get('config_theme') . '_image_thumb_height'));
				} else {
					$data['thumb'] = '';
				}

				$data['images'] = array();

				$results = $this->model_catalog_product->getProductImages($product_id);

				foreach ($results as $result) {
					$data['images'][] = array(
						'popup' => $this->model_tool_image->resize($result['image'], $this->config->get($this->config->get('config_theme') . '_image_popup_width'), $this->config->get($this->config->get('config_theme') . '_image_popup_height')),
						'thumb' => $this->model_tool_image->resize($result['image'], $this->config->get($this->config->get('config_theme') . '_image_additional_width'), $this->config->get($this->config->get('config_theme') . '_image_additional_height'))
					);
				}

				if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
					$data['price'] = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$data['price'] = false;
				}

				if ((float)$product_info['special']) {
					$data['special'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$data['special'] = false;
				}

				if ($this->config->get('config_tax')) {
					$data['tax'] = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price'], $this->session->data['currency']);
				} else {
					$data['tax'] = false;
				}

				$discounts = $this->model_catalog_product->getProductDiscounts($product_id);

				$data['discounts'] = array();

				foreach ($discounts as $discount) {
					$data['discounts'][] = array(
						'quantity' => $discount['quantity'],
						'price'    => $this->currency->format($this->tax->calculate($discount['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency'])
					);
				}
				
				$data['short_description'] = utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..';

				$data['options'] = array();

				foreach ($this->model_catalog_product->getProductOptions($product_id) as $option) {
					$product_option_value_data = array();

					foreach ($option['product_option_value'] as $option_value) {
						if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
							if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price']) {
								$price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->config->get('config_tax') ? 'P' : false), $this->session->data['currency']);
							} else {
								$price = false;
							}

							$product_option_value_data[] = array(
								'product_option_value_id' => $option_value['product_option_value_id'],
								'option_value_id'         => $option_value['option_value_id'],
								'name'                    => $option_value['name'],
								'image'                   => $this->model_tool_image->resize($option_value['image'], 50, 50),
								'price'                   => $price,
								'price_prefix'            => $option_value['price_prefix']
							);
						}
					}

					$data['options'][] = array(
						'product_option_id'    => $option['product_option_id'],
						'product_option_value' => $product_option_value_data,
						'option_id'            => $option['option_id'],
						'name'                 => $option['name'],
						'type'                 => $option['type'],
						'value'                => $option['value'],
						'required'             => $option['required']
					);
				}

				if ($product_info['minimum']) {
					$data['minimum'] = $product_info['minimum'];
				} else {
					$data['minimum'] = 1;
				}

				$data['review_status'] = $this->config->get('config_review_status');

				if ($this->config->get('config_review_guest') || $this->customer->isLogged()) {
					$data['review_guest'] = true;
				} else {
					$data['review_guest'] = false;
				}

				if ($this->customer->isLogged()) {
					$data['customer_name'] = $this->customer->getFirstName() . '&nbsp;' . $this->customer->getLastName();
				} else {
					$data['customer_name'] = '';
				}

				$data['reviews'] = sprintf($this->language->get('text_reviews'), (int)$product_info['reviews']);
				$data['rating'] = (int)$product_info['rating'];

				$data['share'] = $this->url->link('product/product', 'product_id=' . (int)$product_id);

				$data['attribute_groups'] = $this->model_catalog_product->getProductAttributes($product_id);

				$this->model_catalog_product->updateViewed($product_id);

				// Captcha
				if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('review', (array)$this->config->get('config_captcha_page'))) {
					$data['captcha'] = $this->load->controller('captcha/' . $this->config->get('config_captcha'));
				} else {
					$data['captcha'] = '';
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

				$data['recurrings'] = $this->model_catalog_product->getProfiles($product_id);

				$json['success'] = true;

				$json['html'] = $this->load->view('extension/module/ocquickview/product.tpl', $data);

			} else {
				$json['success'] = false;
				$json['html'] = "There is no product";
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function container() {
		$this->load->model('tool/image');
		$this->load->language('extension/module/ocquickview');
		
		$data['text_quickview'] = $this->language->get('text_quickview');
		$data['ocquickview_loader_img'] = $this->config->get('config_url') . 'image/' . $this->config->get('ocquickview_loader_img');
		$data['ocquickview_status'] = (int) $this->config->get('ocquickview_status');
		$data['ocquickview_container'] = $this->config->get('ocquickview_container');
		$data['ocquickview_parent_element'] = $this->config->get('ocquickview_parent_element');
		$data['ocquickview_children_element'] = $this->config->get('ocquickview_children_element');

		return $this->load->view('extension/module/ocquickview/qvcontainer.tpl', $data);
	}

	public function appendcontainer() {
		$this->response->setOutput($this->container());
	}
}