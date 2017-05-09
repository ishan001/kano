<?php
class ControllerModuleSocategoryslider extends Controller {
	public function index($setting) {
		static $module = 1;
		$this->load->language('module/so_category_slider');
		$data['heading_title'] = $setting['name'];
		$data['text_tax'] = $this->language->get('text_tax');
		// Config default 
		if(!isset($setting['date_day']))
		{
			$setting['date_day'] = 7;
		}
		if(!isset($setting['display_rating']))
		{
			$setting['display_rating'] = 1;
		}
		if(!isset($setting['display_sale']))
		{
			$setting['display_sale'] = 1 ;
		}
		if(!isset($setting['display_new']))
		{
			$setting['display_new'] = 1 ;
		}
		if(!isset($setting['product_image_num']))
		{
			$setting['product_image_num'] = 2 ;
		}
		if(!isset($setting['pre_text']))
		{
			$setting['pre_text'] = '';
		}
		if(!isset($setting['post_text']))
		{
			 $setting['post_text'] = '';
		}
		
		$this->load->model('design/banner');
		$this->load->model('tool/image');
		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$this->load->model('module/so_category_slider');
		$this->document->addStyle('catalog/view/javascript/so_category_slider/css/slider.css');
		$this->document->addStyle('catalog/view/javascript/so_category_slider/css/animate.css');
		if (!defined ('OWL_CAROUSEL'))
		{
			$this->document->addScript('catalog/view/javascript/so_category_slider/js/owl.carousel.js');
			$this->document->addStyle('catalog/view/javascript/so_category_slider/css/owl.carousel.css');
			define( 'OWL_CAROUSEL', 1 );
		}
		if (!isset($setting['start'])) {
			$setting['start'] = 0;
		}
		$this->load->model('localisation/language');
		$data['languages'] 			= $this->model_localisation_language->getLanguages();
		$data['button_cart'] 		= $this->language->get('button_cart');
		$data['button_wishlist'] 	= $this->language->get('button_wishlist');
		$data['button_compare'] 	= $this->language->get('button_compare');
		$data['start'] 				= $setting['start'];
		$data['text_sale']			= $this->language->get('text_sale');
		$data['text_new']			= $this->language->get('text_new');
		//General 
		$data['item_link_target'] 	= $setting['item_link_target'];
		$data['class_suffix'] 		= $setting['class_suffix'];
		$data['moduleid']  			= $setting['moduleid'];
		$data['tag_id'] 			= 'so_category_slider_'.$data['moduleid'];
		$data['nb_column0'] 		= $setting['nb_column0'];
		$data['nb_column1'] 		= $setting['nb_column1'];
		$data['nb_column2'] 		= $setting['nb_column2'];
		$data['nb_column3'] 		= $setting['nb_column3'];
		$data['nb_column4'] 		= $setting['nb_column4'];

		//Category Option
		$data['cat_title_display'] 			= $setting['cat_title_display'];
		$data['cat_image_display'] 			= $setting['cat_image_display'];
		$data['cat_title_maxcharacs'] 		= $setting['cat_title_maxcharacs'];
		$data['cat_sub_title_maxcharacs'] 	= $setting['cat_sub_title_maxcharacs'];
		$data['cat_all_product'] 			= $setting['cat_all_product'];
		$data['height_cat'] 				= $setting['height_cat'];
		$data['width_cat'] 					= $setting['width_cat'];
		$data['placeholder_path'] 			= $setting['placeholder_path'];
		$data['disp_title_module'] 			= (int)$setting['disp_title_module'] ;
		if (isset($setting['module_description'][$this->config->get('config_language_id')])) {
			$data['head_name'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['head_name'], ENT_QUOTES, 'UTF-8');
		}else{
			$data['head_name']  = $setting['head_name'];
		}
		// Product option
		$data['display_title'] 			= $setting['display_title'];
		$data['display_description'] 	= $setting['display_description'];
		$data['product_image'] 			= $setting['product_image'];
		$data['product_image_num'] 		= (int)$setting['product_image_num'];
		$data['height'] 				= $setting['height'];
		$data['width'] 					= $setting['width'];
		$data['nb_rows'] 				= $setting['nb_row'];
		$data['display_rating'] 		= (int)$setting['display_rating'] ;
		$data['display_price'] 			= $setting['display_price'];
		$data['display_addtocart'] 		= $setting['display_add_to_cart'];
		$data['display_wishlist'] 		= $setting['display_wishlist'];
		$data['display_compare'] 		= $setting['display_compare'];
		$data['display_sale'] 			= $setting['display_sale'];
		$data['display_new'] 			= $setting['display_new'];

		//tabs effect options
		$data['autoplay'] 				= $setting['autoplay'];
		if ($data['autoplay'] == 1) {
			$data['autoplay_timeout'] 	= $setting['autoplay_timeout'];
		}else{
			$data['autoplay_timeout'] 	= 0;
		}
		$data['margin'] 		= $setting['margin'];
		$data['slideBy'] 		= $setting['slideBy'];
		$data['effect'] 		= $setting['effect'];
		$data['duration'] 		= $setting['duration'];
		$data['delay'] 			= $setting['delay'];
		$data['pausehover'] 	= $setting['pausehover'];
		$data['autoplaySpeed'] 	= $setting['autoplaySpeed'];
		$data['startPosition'] 	= $setting['startPosition'];
		$data['mouseDrag'] 		= $setting['mouseDrag'];
		$data['touchDrag'] 		= $setting['touchDrag'];
		$data['nav'] 			= ($setting['navs'] == 1 ? "true" : "false");
		$data['navSpeed'] 		= $setting['navSpeed'];
		$data['NoItem'] 		= $this->language->get('text_noitem');
		
		//Tab Advanced
		$data['pre_text'] 		= $setting['pre_text'];
		$data['post_text'] 		= $setting['post_text'];
		
		//Default
		$catids = array();
		$catids[] = $setting['category'];
		if($setting['child_category'])
		{
			for($i=1; $i<=$setting['category_depth'];$i++)
			{
				foreach ($catids as $categorys)
				{
					$filter_data = array(
						'category_id'  => $categorys,
					);
					$categoryss = $this->model_module_so_category_slider->getCategories_son($filter_data);
					foreach ($categoryss as $category)
					{
						$catids[]  = $category['category_id'];
					}
				}
			}
		}
		$catids = array_unique($catids);
		$product = self::getProducts($catids,$setting);

		$list = array();
		$cats = array();
		$_catids = (array)self::processCategory($catids);
		foreach($_catids as $category_id)
		{
			$category_info = $this->model_catalog_category->getCategory($category_id);
			$title = (($setting['cat_title_maxcharacs'] != 0 && strlen($category_info['name']) > $setting['cat_title_maxcharacs']) ? utf8_substr(strip_tags(html_entity_decode($category_info['name'], ENT_QUOTES, 'UTF-8')), 0, $setting['cat_title_maxcharacs']) . '..' : $category_info['name']);
			if ($category_info['image'] != null) {
				$image = $this->model_tool_image->resize($category_info['image'], $setting['width_cat'], $setting['height_cat']);
			}else {
				$url = file_exists("image/so_category_slider/images/".$setting['placeholder_path']);
				if ($url) {
					$image_name = "so_category_slider/images/".$setting['placeholder_path'];
				} else {
					$image_name = "no_image.png";
				}
				$image = $this->model_tool_image->resize($image_name, $setting['width_cat'], $setting['height_cat']);
			}
			if(isset($category_info['name']))
			{
				$data['list'][] = array(
					'title' 	 	=> $title,
					'titleFull'		=> $category_info['name'],
					'image'		 	=> $image,
					'link'  	 	=> $this->url->link('product/category', 'path=' . $category_id),
					'child_cat' 	=> self::getCategoryson($category_id,$setting),
					'product_image' => $setting['product_image'],
					'product' 		=> $product,
				);
			}
		}
		$data['module'] = $module++;
		// Check Version
		if(version_compare(VERSION, '2.1.0.2', '>')) {
			return $this->load->view('module/so_category_slider/default.tpl', $data);
		} else {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/so_category_slider/so_category_slider.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/so_category_slider/default.tpl', $data);
			} else {
				return $this->load->view('default/template/module/so_category_slider/default.tpl', $data);
			}
		}
	}
	public function getCategoryson($category_id, $setting)
	{
		$categoryss = array();
		if($setting['child_category_cat'] ==1)
		{
			$filter_data = array(
				'category_id'  => $category_id,
				'limit'        => $setting['source_limit_cat'],
				'start' 	   => 0,
				'width'        => $setting['width'],
				'height'       => $setting['height'],
				'category_depth' => $setting['category_depth']
			);
			$categoryss = $this->model_module_so_category_slider->getCategories_son_categories($filter_data);
		}
		return $categoryss;
	}
	public function getProducts($category_id_list,$setting)
	{
		$filter_data = array(
			'filter_category_id'  => implode(',',$category_id_list),
			'sort'         => $setting['product_sort'],
			'order'        => $setting['product_ordering'],
			'limit'        => $setting['source_limit'],
			'start' 	   => $setting['start']
		);
		$cat['count'] = $this->model_module_so_category_slider->getTotalProducts_categories($filter_data);
		if ($cat['count'] > 0)
		{
			$products_arr = $this->model_module_so_category_slider->getProducts_categories($filter_data);
			foreach($products_arr as $product_info)
			{
				$product_image = $this->model_catalog_product->getProductImages($product_info['product_id']);
				$image2 = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
				if(count($product_image) >0)
				{
					$image2 = $this->model_tool_image->resize($product_image[0]['image'], $setting['width'], $setting['height']);
				}
				if ($product_info['image']) {
					$image = $this->model_tool_image->resize($product_info['image'], $setting['width'], $setting['height']);
				}elseif(isset($product_image[0]['image'])){
					$image = $this->model_tool_image->resize($product_image[0]['image'], $setting['width'], $setting['height']);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
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

				$name = (($setting['title_maxlength'] != 0 && strlen($product_info['name']) > $setting['title_maxlength']) ? utf8_substr(strip_tags(html_entity_decode($product_info['name'], ENT_QUOTES, 'UTF-8')), 0, $setting['title_maxlength']) . '..' : $product_info['name']);
				$description = (($setting['description_maxlength'] != 0 && strlen($product_info['description']) > $setting['description_maxlength']) ? utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $setting['description_maxlength']) . '..' : $product_info['description']);
				
				$datetimeNow = new DateTime();
				$datetimeCreate = new DateTime($product_info['date_available']);
				$interval = $datetimeNow->diff($datetimeCreate);
				$dateDay = $interval->format('%a');
				$productNew = ($dateDay <= $setting['date_day'] ? 1 : 0);
				//Check deals
				$specialPriceToDate = '';
				if (isset($product_info['date_start']) && isset($product_info['date_end']) && strtotime ($product_info['date_start']) != false && strtotime ($product_info['date_end']) != false)
				{
					$current = date ('Y/m/d H:i:s');
					$start_date = date ('Y/m/d H:i:s', strtotime ($product_info['date_start']));
					$date_end = date ('Y/m/d H:i:s', strtotime ($product_info['date_end']));
					if (strtotime ($date_end) >= strtotime ($current) && strtotime ($start_date) <= strtotime ($date_end))
						$specialPriceToDate = $date_end;
				}
				$cat['child'][] = array(
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
					'date_added'  	=> $product_info['date_added'],
					'model'  	  	=> $product_info['model'],
					'quantity'    	=> $product_info['quantity'],
					'href'        	=> $this->url->link('product/product', 'product_id=' . $product_info['product_id']),
					'specialPriceToDate' => $specialPriceToDate,
				);
			}
			$list = $cat['child'];
			return $list;
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