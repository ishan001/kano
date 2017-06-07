<?php
class ControllerModuleSoextraslider extends Controller {
	public function index($setting) {
		$this->load->language('module/so_extra_slider');
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_tax'] = $this->language->get('text_tax');
		// Config Default
		if(!isset($setting['product_image_num']))
		{
			$setting['product_image_num'] = 2;
		}
		if(!isset($setting['display_new']))
		{
			$setting['display_new'] = 1;
		}
		if(!isset($setting['display_sale']))
		{
			$setting['display_sale'] =1;
		}
		if(!isset($setting['display_rating']))
		{
			$setting['display_rating'] = 1;
		}
		if(!isset($setting['pre_text']))
		{
			$setting['pre_text'] = '';
		}
		if(!isset($setting['post_text']))
		{
			$setting['post_text'] = '';
		}
		if(!isset($setting['date_day']))
		{
			$setting['date_day'] = 7;
		}
		
		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');
		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$this->load->model('module/so_extra_slider');
		$this->load->model('tool/image');
		$this->document->addStyle('catalog/view/javascript/so_extra_slider/css/style.css');
		$this->document->addStyle('catalog/view/javascript/so_extra_slider/css/css3.css');
		if (!defined ('OWL_CAROUSEL'))
		{
			$this->document->addStyle('catalog/view/javascript/so_extra_slider/css/animate.css');
			$this->document->addStyle('catalog/view/javascript/so_extra_slider/css/owl.carousel.css');
			$this->document->addScript('catalog/view/javascript/so_extra_slider/js/owl.carousel.js');
			define( 'OWL_CAROUSEL', 1 );
		}
		$setting['category'] = self::processCategory($setting['category']); // check category (disable)
		
		if($setting['child_category'])
		{
			for($i=1; $i<=$setting['category_depth'];$i++)
			{
				foreach ($setting['category'] as $categorys)
				{
					$filter_data = array(
						'category_id'  => $categorys,
					);
					$categoryss = $this->model_module_so_extra_slider->getCategories_son($filter_data);
					foreach ($categoryss as $category)
					{
						$setting['category'][]  = $category['category_id'];
					}
				}

			}
		}
		$setting['category'] = array_unique($setting['category']);
		
		$str_categorys = implode(",",$setting['category']);

		$filter_data = array(
			'filter_category_id'  => $str_categorys,
			'sort'         => $setting['product_sort'],
			'order'        => $setting['product_ordering'],
			'limit'        => $setting['limitation'] ,
			'start'        => '0'
		);

		$products_arr = $this->model_module_so_extra_slider->getProducts_extra_slider($filter_data);
		if (!isset($setting['limit'])) {
			$setting['limit'] = 3;
		}
		if (!isset($setting['width'])) {
			$setting['width'] = 100;
		}
		if (!isset($setting['height'])) {
			$setting['height'] = 200;
		}

		foreach($products_arr as $product_info)
		{
			$product_image = $this->model_module_so_extra_slider->getImageExtra_slider($product_info['product_id']);
			$product_image_first = array_shift($product_image);
			$image2 = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
			if($product_image_first != null)
			{
				$image2 = $this->model_tool_image->resize($product_image_first['image'], $setting['width'], $setting['height']);
			}
			if ($product_info['image'] && $setting['product_get_image_data'] && $setting['product_image']) {
				$image = $this->model_tool_image->resize($product_info['image'], $setting['width'], $setting['height']);
			}elseif($product_image_first['image'] && $setting['product_get_image_image'] && $setting['product_image']){
				$image = $this->model_tool_image->resize($product_image_first['image'], $setting['width'], $setting['height']);
			} else {
				$url = file_exists("image/so_extra_slider/images/".$setting['placeholder_path']);
					if ($url) {
						$image_name = "so_extra_slider/images/".$setting['placeholder_path'];
					} else {
						$image_name = "no_image.png";
					}
					$image = $this->model_tool_image->resize($image_name, $setting['width'], $setting['height']);
			}
			// Check Version
			if(version_compare(VERSION, '2.1.0.2', '>')) {
				if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
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
			} else {
				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}

				if ((float)$product_info['special']) {
					$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = $product_info['rating'];
				} else {
					$rating = false;
				}
			}
			$name = ((strlen($product_info['name']) > $setting['title_maxlength'] && $setting['title_maxlength'] !=0)  ? utf8_substr(strip_tags(html_entity_decode($product_info['name'], ENT_QUOTES, 'UTF-8')), 0, $setting['title_maxlength']) . '..' : $product_info['name']);
			$description = ((strlen($product_info['description']) > $setting['description_maxlength'] && $setting['description_maxlength'] != 0) ? utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $setting['description_maxlength']) . '..' : $product_info['description']);
			
			$datetimeNow = new DateTime();
			$datetimeCreate = new DateTime($product_info['date_available']);
			$interval = $datetimeNow->diff($datetimeCreate);
			$dateDay = $interval->format('%a');
			$productNew = ($dateDay <= $setting['date_day'] ? 1 : 0);
			$data['products'][] = array(
				'product_id'  	=> $product_info['product_id'],
				'thumb'       	=> $image,
				'thumb2'       	=> $image2,
				'name'        	=> $name,
				'nameFull'		=> $product_info['name'],
				'description' 	=> $description,
				'price'       	=> $price,
				'special'     	=> $special,
				'productNew'	=> $productNew,	
				'tax'         	=> $tax,
				'rating'      	=> $rating,
				'href'        	=> $this->url->link('product/product', 'product_id=' . $product_info['product_id'])
			);

		}
		$data['nb_column0'] = $setting['nb_column0'];
		$data['nb_column1'] = $setting['nb_column1'];
		$data['nb_column2'] = $setting['nb_column2'];
		$data['nb_column3'] = $setting['nb_column3'];
		$data['nb_column4'] = $setting['nb_column4'];
		$data['class_suffix'] = $setting['class_suffix'];
		$data['item_link_target'] = $setting['item_link_target'];
		$data['display_title'] = $setting['display_title'];
		$data['display_description'] = $setting['display_description'];
		$data['display_readmore_link'] = $setting['display_readmore_link'];
		$data['display_addtocart'] = $setting['display_add_to_cart'];
		$data['display_wishlist'] = $setting['display_wishlist'];
		$data['display_compare'] = $setting['display_compare'];
		$data['display_price'] = $setting['display_price'];
		$data['product_image'] = $setting['product_image'];
		$data['width'] = $setting['width'];
		$data['height'] = $setting['height'];
		$data['NoItem'] = $this->language->get('text_noitem');
		$data['direction']					=  $this->language->get('direction') == 'rtl' ?  'true' : 'false';
		if (isset($setting['module_description'][$this->config->get('config_language_id')])) {
			$data['head_name'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['head_name'], ENT_QUOTES, 'UTF-8');
		}else{
			$data['head_name']  = $setting['head_name'];
		}
		$data['moduleid']  = $setting['moduleid'];
		$data['disp_title_module'] = (int)$setting['disp_title_module'];
		$data['autoplay'] = $setting['autoplay'];
		if ($data['autoplay'] == 1) {
			$data['autoplayTimeout'] = $setting['autoplayTimeout'];
		}else{
			$data['autoplayTimeout'] = 0;
		}
		$data['margin'] = $setting['margin'];
		$data['slideBy'] = $setting['slideBy'];
		$data['effect'] = $setting['effect'];
		$data['duration'] = $setting['duration'];
		$data['delay'] = $setting['delay'];
		$data['autoplayHoverPause'] = $setting['autoplayHoverPause'];
		
		$data['autoplaySpeed'] = $setting['autoplaySpeed'];
		$data['startPosition'] = $setting['startPosition'];
		$data['mouseDrag'] = $setting['mouseDrag'];
		$data['touchDrag'] = $setting['touchDrag'];
		$data['dots'] 	= ($setting['dots'] == 1) ? "true" : "false";
		$data['dotsSpeed'] 				= $setting['dotsSpeed'];
		$data['loop'] 					= ($setting['loop'] == 1 ? "true" : "false");
		$data['nav'] 					= ($setting['navs'] == 1 ? "true" : "false");
		$data['navSpeed'] 				= $setting['navSpeed'];

		$data['nb_rows'] = $setting['nb_row'];
		$data['count'] = $setting['limitation'];
		$data['button_page'] = $setting['button_page'];
		$data['products_style'] = $setting['products_style'];
		$readmore = html_entity_decode($setting['readmore_text']);
		if($readmore){
			$data['readmore_text'] = $readmore;
		}else{
			$data['readmore_text'] = 'Read more';
		}
		
		$data['text_sale']				= $this->language->get('text_sale');
		$data['text_new']				= $this->language->get('text_new');
		
		$data['display_rating'] 		= (int)$setting['display_rating'] ;
		$data['display_sale'] 			= $setting['display_sale'];
		$data['display_new'] 			= $setting['display_new'];
		$data['product_image_num'] 		= (int)$setting['product_image_num'];
		//Tab Advanced
		$data['pre_text'] 		= $setting['pre_text'];
		$data['post_text'] 		= $setting['post_text'];
		
		
		// Check Version
		if(version_compare(VERSION, '2.1.0.2', '>')) {
			return $this->load->view('module/so_extra_slider/default.tpl', $data);
		} else {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/so_extra_slider/default.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/so_extra_slider/default.tpl', $data);
			} else {
				return $this->load->view('default/template/module/so_extra_slider/default.tpl', $data);
			}
		}
		

	}
	private function processCategory($catids)
	{
		$catpubid = array();
		if (empty($catids)) return;
		foreach ($catids as $i => $cid) {
			$category = $this->model_catalog_category->getCategory($cid);
			$cats[$i] = $category;
			if (empty($category)) {
				unset($cats[$i]);
			} else {
				$catpubid[] = $category['category_id'];
			}
		}
		return $catpubid;
	}

}