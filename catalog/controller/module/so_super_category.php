<?php
class ControllerModuleSosupercategory extends Controller {
	public function index($setting) {
		$this->load->language('module/so_super_category');
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_tax'] = $this->language->get('text_tax');
		$data['text_date'] = $this->language->get('text_date');
		$data['text_sale'] = $this->language->get('text_sale');
		$data['text_new'] = $this->language->get('text_new');
		
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
		
		
		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');
		$data['mod_quickview'] 	  = $this->language->get('mod_quickview');
		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$this->load->model('module/so_super_category');
		$this->load->model('tool/image');
		// Add Style
		$this->document->addStyle('catalog/view/javascript/so_super_category/css/style.css');
		
		if (!defined ('OWL_CAROUSEL'))
		{
			$this->document->addStyle('catalog/view/javascript/so_super_category/css/animate.css');
			$this->document->addStyle('catalog/view/javascript/so_super_category/css/owl.carousel.css');
			$this->document->addScript('catalog/view/javascript/so_super_category/js/owl.carousel.js');
			define( 'OWL_CAROUSEL', 1 );
		}
		
		$data['moduleid'] 					= $setting['moduleid'] ;
		$data['tag_id'] 					= 'so_super_category_'.$data['moduleid'];
		$data['disp_title_module'] 			= (int)$setting['disp_title_module'];
		if (isset($setting['module_description'][$this->config->get('config_language_id')])) {
			$data['head_name'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['head_name'], ENT_QUOTES, 'UTF-8');
		}else{
			$data['head_name']  = $setting['head_name'];
		}
		$data['advanced_mod_class_suffix'] 	= $setting['advanced_mod_class_suffix'] ;
		$data['product_delay'] 				= $setting['product_delay'];
		$data['product_duration'] 			= $setting['product_duration'];
		$data['effect'] 					= $setting['effect'];
		$data['category_title_maxlength'] 	= $setting['category_title_maxlength'];
		$data['display_slide_category'] 	= $setting['display_slide_category'];
		$data['show_category_type'] 		= $setting['show_category_type'];
		$data['item_link_target'] 			= $setting['item_link_target'];
		$data['display_title_sub_category'] = $setting['display_title_sub_category'];
		$data['category_parent'] 			= $this->model_catalog_category->getCategory($setting['category']);
		$data['category_parent']['link']    = $this->url->link('product/category', 'path=' .$setting['category']);
		$data['type_show'] 					= $setting['type_show'] ;
		$data['limitation'] 				= $setting['limitation'];
		$data['all_ready_label']			= $this->language->get('all_ready_label');
		$data['load_more_label']			= $this->language->get('load_more_label');
		$data['rows'] 						= $setting['rows'];
		$data['setting'] 					= serialize($setting);
		// Product
		$data['product_column0'] 			= $setting['product_column0'];
		$data['product_column1'] 			= $setting['product_column1'];
		$data['product_column2'] 			= $setting['product_column2'];
		$data['product_column3'] 			= $setting['product_column3'];
		$data['product_column4'] 			= $setting['product_column4'];
		$data['class_spcat']				= 'spcat00-' . $data['product_column0'] . ' spcat01-' . $data['product_column0'] . ' spcat02-' . $data['product_column1'] . ' spcat03-' . $data['product_column2'] . ' spcat04-' . $data['product_column3'];
		$data['slider_display_navigation'] 		= $setting['slider_display_navigation'] == 1 ? 'true' : 'false';
		$data['slider_display_loop'] 			= $setting['slider_display_loop'] == 1 ? 'true' : 'false';
		$data['slider_auto_play'] 				= $setting['slider_auto_play'] == 1 ? 'true' : 'false';
		$data['slider_auto_hover_pause'] 		= $setting['slider_auto_hover_pause'] == 1 ? 'true' : 'false';
		$data['slider_auto_interval_timeout'] 	= $setting['slider_auto_interval_timeout'];
		$data['slider_auto_play_speed'] 		= $setting['slider_auto_play_speed'] ;
		$data['slider_mouse_drag'] 				= $setting['slider_mouse_drag'] == 1 ? 'true' : 'false';
		$data['slider_touch_drag'] 				= $setting['slider_touch_drag'] == 1 ? 'true' : 'false';
		$data['product_display_title'] 			= $setting['product_display_title'];
		$data['product_display_description'] 	= $setting['product_display_description'];
		$data['product_display_price'] 			= $setting['product_display_price'];
		$data['product_display_add_to_cart'] 	= $setting['product_display_add_to_cart'];
		$data['product_display_wishlist'] 				= $setting['display_wishlist'];
		$data['product_display_compare'] 				= $setting['display_compare'];
		$data['product_image'] 					= $setting['product_image'];
		// Category
		$data['display_slide_category'] 	= $setting['display_slide_category'];
		$data['category_column0'] 			= $setting['category_column0'];
		$data['category_column1'] 			= $setting['category_column1'];
		$data['category_column2'] 			= $setting['category_column2'];
		$data['category_column3'] 			= $setting['category_column3'];
		$data['category_column4'] 			= $setting['category_column4'];
		//effect
		$data['subcategory_center'] = $setting['subcategory_center'] == 1 ? 'true' : 'false';
		$data['subcategory_display_navigation'] = $setting['subcategory_display_navigation'] == 1 ? 'true' : 'false';
		$data['subcategory_display_loop'] = $setting['subcategory_display_loop'] == 1 ? 'true' : 'false';
		
		$data['subcategory_margin_right'] = ( (int)$setting['subcategory_margin_right'] >= 0) ? $setting['subcategory_margin_right'] : 5;
		
		$data['subcategory_slideby'] = ( $setting['subcategory_slideby'] > 0 ) ? $setting['subcategory_slideby'] : 1;
		
		$data['subcategory_auto_play'] = $setting['subcategory_auto_play'] == 1 ? 'true' : 'false';
		
		$data['subcategory_auto_interval_timeout'] = ( $setting['subcategory_auto_interval_timeout'] >= 0  ) ? $setting['subcategory_auto_interval_timeout'] : 5000;
		
		$data['subcategory_auto_hover_pause'] = ($setting['subcategory_auto_hover_pause'] == 1) ? 'true' : 'false';
		
		$data['subcategory_auto_play_speed'] = ($setting['subcategory_auto_play_speed'] >= 0) ? $setting['subcategory_auto_play_speed'] : 5000;
		
		$data['subcategory_navigation_speed'] = ($setting['subcategory_navigation_speed'] >= 0 ) ? $setting['subcategory_navigation_speed'] : 5000;
		
		$data['subcategory_start_position'] = ( $setting['subcategory_start_position'] >= 0 ) ? $setting['subcategory_start_position'] : 0;
		
		$data['subcategory_mouse_drag'] = $setting['subcategory_mouse_drag'] == 1 ? 'true' : 'false';
		$data['subcategory_touch_drag'] = $setting['subcategory_touch_drag'] == 1 ? 'true' : 'false';
		
		$data['display_rating'] 		= (int)$setting['display_rating'] ;
		$data['display_sale'] 			= $setting['display_sale'];
		$data['display_new'] 			= $setting['display_new'];
		$data['product_image_num'] 		= (int)$setting['product_image_num'];
		//Tab Advanced
		$data['pre_text'] 				= $setting['pre_text'];
		$data['post_text'] 				= $setting['post_text'];
		
		$data['NoItem'] = $this->language->get('text_noitem');
		// get category son
		$listCategory_son = self::getCategoryson($setting);
		foreach($listCategory_son as $item)
		{
			$info_category = $this->model_catalog_category->getCategory($item);
			if ($info_category['image'] != "") {
				$image = $this->model_tool_image->resize($info_category['image'], $setting['category_width'], $setting['category_height']);
			}else {
				$url = file_exists("image/so_super_category/images/".$setting['category_placeholder_path']);
				if ($url) {
					$image_name = "so_super_category/images/".$setting['category_placeholder_path'];
				} else {
					$image_name = "no_image.png";
				}
				$image = $this->model_tool_image->resize($image_name, $setting['category_width'], $setting['category_height']);
				
			}

			$data['category_tree'][] = array(
				'category_id' 		=> $info_category['category_id'],
				'name'				=> $info_category['name'],
				'name_maxlength' 	=> ((strlen($info_category['name']) > $setting['sub_category_title_maxlength'] && $setting['sub_category_title_maxlength'] !=0)  ? utf8_substr(strip_tags(html_entity_decode($info_category['name'], ENT_QUOTES, 'UTF-8')), 0, $setting['sub_category_title_maxlength']) . '..' : $info_category['name']),
				'link' 				=> $this->url->link('product/category', 'path=' . $item),
				'image' 			=> $image
			);
		}
		
		$tabs = array();
		$filters = $setting['field_product_tab'];
		$articles_filter = array();
		$filter_preload = $setting['field_preload'];
		
		$setting['product_sort'] = $filter_preload;
		$setting['start']             	=0;
		$data['rl_loaded'] 				= $setting['start'] ;
		$data['direction'] =  $this->language->get('direction') == 'rtl' ?  'true' : 'false';
		$is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
		if($is_ajax && isset($_POST['is_ajax_super_category']) && $_POST['is_ajax_super_category'] )
		{
			
			
			
			foreach ($filters as $filter) {
				$filter_data = array(
					'filter_category_id'  	=> implode(',',$listCategory_son),
					'sort'         			=> $setting['product_sort'],
					'order'        			=> $setting['product_ordering'],
					'limit'        			=> $setting['limitation'],
					'start' 	   			=> $setting['start']
				);
				$aritles['count'] = $this->model_module_so_super_category->getTotalProducts_super_category($filter_data);
				$aritles['category_id'] = $filter;
				$aritles['title'] = $this->getLabel($filter);
				array_unshift($articles_filter, $aritles);
			}
			
			foreach ($articles_filter as $filter) {
				if ($filter['count'] > 0) {
					if ($filter['category_id'] == $filter_preload) {
						$filter['sel'] = 'sel';
						$setting['product_sort'] = $filter_preload;
						$filter['child'] = self::getProducts($listCategory_son, $setting);
					}
					$tabs[$filter['category_id']] = $filter;
				}
			}
			
			$tabs = $tabs;
			$setting 						= unserialize($_POST['setting']);
			$listCategory_son = self::getCategoryson($setting);
			$setting['start'] 				= $_POST['ajax_reslisting_start'];
			$start							= $setting['start'];
			$product_image 					= $setting['product_image'];
			$direction 						=  $this->language->get('direction') == 'rtl' ?  'true' : 'false';
			$type_show 						= $setting['type_show'];
			$product_display_title 			= $setting['product_display_title'];
			$product_display_description 	= $setting['product_display_description'];
			$product_display_price 			= $setting['product_display_price'];
			$product_image					= $setting['product_image'];
			$product_display_add_to_cart    = $setting['product_display_add_to_cart'];
			$product_display_wishlist   	= $setting['display_wishlist'];
			$product_display_compare    	= $setting['display_compare'];
			$product_column0				= $setting['product_column0'];
			$product_column1				= $setting['product_column1'];
			$product_column2				= $setting['product_column2'];
			$product_column3 				= $setting['product_column3'];
			$product_column4 				= $setting['product_column4'];
			$moduleid						= $setting['moduleid'];
			$slider_display_navigation 		= $setting['slider_display_navigation'];
			$slider_display_loop 			= $setting['slider_display_loop'];
			$slider_auto_play 				= $setting['slider_auto_play'];
			$slider_auto_hover_pause 		= $setting['slider_auto_hover_pause'];
			$slider_auto_interval_timeout 	= $setting['slider_auto_interval_timeout'];
			$slider_auto_play_speed 		= $setting['slider_auto_play_speed'];
			$slider_mouse_drag				= $setting['slider_mouse_drag'];
			$slider_touch_drag 				= $setting['slider_touch_drag'];
			$display_rating 				= (int)$setting['display_rating'] ;
			$display_sale 					= $setting['display_sale'];
			$display_new 					= $setting['display_new'];
			$product_image_num 				= (int)$setting['product_image_num'];
			$text_sale 						= $this->language->get('text_sale');
			$text_new 						= $this->language->get('text_new');
			
			$rows							= $setting['rows'];
			$tag_id							= 'so_super_category_'.$_POST['lbmoduleid'];
			$setting['product_sort'] 		= $_POST['fieldorder'];
			$item_link_target 				= $setting['item_link_target'];
			$button_cart 					= $this->language->get('button_cart');
			$button_wishlist 				= $this->language->get('button_wishlist');
			$button_compare 				= $this->language->get('button_compare');
			$mod_quickview    				= $this->language->get('mod_quickview');
			$text_tax 						= $this->language->get('text_tax');
			$text_date 						= $this->language->get('text_date');
			$child_items 					= self::getProducts($listCategory_son,$setting);
			$rl_loaded = $start;
			$result = new stdClass();
			ob_start();
			
			if(version_compare(VERSION, '2.1.0.2', '>')) {
				if (file_exists(DIR_TEMPLATE . $this->config->get('theme_default_directory') . '/template/module/so_super_category/default.tpl')) {
					include(DIR_TEMPLATE .$this->config->get('theme_default_directory') . '/template/module/so_super_category/default_items.tpl');
				} else {
					include(DIR_TEMPLATE .'default/template/module/so_super_category/default_items.tpl');
				}
			} else {
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/so_super_category/default.tpl')) {
					include(DIR_TEMPLATE .$this->config->get('config_template') . '/template/module/so_super_category/default_items.tpl');
				} else {
					include(DIR_TEMPLATE .'default/template/module/so_super_category/default_items.tpl');
				}
			}
		
			
			$buffer = ob_get_contents();
			$result->items_markup = preg_replace(
					array(
							'/ {2,}/',
							'/<!--.*?-->|\t|(?:\r?\n[ \t]*)+/s'
					),
					array(
							' ',
							''
					),
					$buffer
			);
			ob_end_clean();
			die (json_encode($result));
		}
		foreach ($filters as $filter) {
			$filter_data = array(
				'filter_category_id'  	=> implode(',',$listCategory_son),
				'sort'         			=> $setting['product_sort'],
				'order'        			=> $setting['product_ordering'],
				'limit'        			=> $setting['limitation'],
				'start' 	   			=> $setting['start']
			);
			$aritles['count'] = $this->model_module_so_super_category->getTotalProducts_super_category($filter_data);
			$aritles['category_id'] = $filter;
			$aritles['title'] = $this->getLabel($filter);
			array_unshift($articles_filter, $aritles);
		}
		
		foreach ($articles_filter as $filter) {
			if ($filter['count'] > 0) {
				if ($filter['category_id'] == $filter_preload) {
					$filter['sel'] = 'sel';
					$setting['product_sort'] = $filter_preload;
					$filter['child'] = self::getProducts($listCategory_son, $setting);
				}
				$tabs[$filter['category_id']] = $filter;
			}
		}
		
		$data['tabs'] = $tabs;
		
		// Check Version
		if(version_compare(VERSION, '2.1.0.2', '>')) {
			return $this->load->view('module/so_super_category/default.tpl', $data);
		} else {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/so_super_category/default.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/so_super_category/default.tpl', $data);
			} else {
				return $this->load->view('default/template/module/so_super_category/default.tpl', $data);
			}
		}
		
	
	}
	private  function getCategoryson($setting){
		$setting['category'] = array($setting['category']);
		for($i=1; $i<=$setting['category_depth'];$i++)
		{
			foreach ($setting['category'] as $categorys)
			{
				$filter_data = array(
					'category_id'  => $categorys,
				);
				$categoryss = $this->model_module_so_super_category->getCategories_son($filter_data);
				foreach ($categoryss as $category)
				{
					$setting['category'][]  = $category['category_id'];
				}
			}
		}
		$listCategory_son = array_unique($setting['category']);
		return $listCategory_son;
	}
	
	public function getProducts($category_id_list,$setting)
	{
		$list = array();
		if(is_array($category_id_list))
		{
			$filter_data = array(
				'filter_category_id'  => implode(',',$category_id_list),
				'sort'         => $setting['product_sort'],
				'order'        => $setting['product_ordering'],
				'limit'        => (int)$setting['limitation'],
				'start' 	   => $setting['start']
			);
		}else{
			$filter_data = array(
				'filter_category_id'  => $category_id_list,
				'sort'         => $setting['product_sort'],
				'order'        => $setting['product_ordering'],
				'limit'        => (int)$setting['source_limit'],
				'start' 	   => $setting['start']
			);
		}
		
		$cat['count'] = $this->model_module_so_super_category->getTotalProducts_super_category($filter_data);
		if ($cat['count'] > 0) 
		{
			$products_arr = $this->model_module_so_super_category->getProducts_super_category($filter_data);
			foreach($products_arr as $product_info)
			{
				$product_image = $this->model_catalog_product->getProductImages($product_info['product_id']);
				$setting['product_width'] = ($setting['product_width'] == 0 ? "30px" : $setting['product_width']);
				$setting['product_height'] = ($setting['product_height'] == 0 ? "30px" : $setting['product_height']);
				$product_image_first = array_shift($product_image);
				$image2 = $this->model_tool_image->resize('placeholder.png', $setting['product_width'], $setting['product_height']);
				if($product_image_first != null)
				{
					$image2 = $this->model_tool_image->resize($product_image_first['image'], $setting['product_width'], $setting['product_height']);
				}
				if (($product_info['image'] != null) && ($setting['product_get_image_data'] == 1)) {
					$image = $this->model_tool_image->resize($product_info['image'], $setting['product_width'], $setting['product_height']);
				}elseif(isset($product_image_first['image']) && $setting['product_get_image_image'] == 1){
					$image = $this->model_tool_image->resize($product_image_first['image'], $setting['product_width'], $setting['product_height']);
				} else {
					$url = file_exists("image/so_super_category/images/".$setting['product_placeholder_path']);
					if ($url) {
						$image_name = "so_super_category/images/".$setting['product_placeholder_path'];
					} else {
						$image_name = "no_image.png";
					}
					$image = $this->model_tool_image->resize($image_name, $setting['product_width'], $setting['product_height']);
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
				$name = (($setting['product_title_maxlength'] != 0 && strlen($product_info['name']) > $setting['product_title_maxlength']) ? utf8_substr(strip_tags(html_entity_decode($product_info['name'], ENT_QUOTES, 'UTF-8')), 0, $setting['product_title_maxlength']) . '..' : $product_info['name']);
				$description = (($setting['product_description_maxlength'] != 0 && strlen($product_info['description']) > $setting['product_description_maxlength']) ? utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $setting['product_description_maxlength']) . '..' : $product_info['description']);
				
				$datetimeNow = new DateTime();
				$datetimeCreate = new DateTime($product_info['date_available']);
				$interval = $datetimeNow->diff($datetimeCreate);
				$dateDay = $interval->format('%a');
				$productNew = ($dateDay <= $setting['date_day'] ? 1 : 0);
				
				$cat['child'][] = array(
					'product_id'  		=> $product_info['product_id'],
					'thumb'       		=> $image,
					'thumb2'       		=> $image2,
					'name'        		=> $name,
					'nameFull'			=> $product_info['name'],
					'name_maxlength' 	=> $name,
					'description' 		=> $description,
					'price'       		=> $price,
					'special'     		=> $special,
					'productNew'		=> $productNew,
					'tax'         		=> $tax,
					'rating'      		=> $rating,
					'date_added'  		=> $product_info['date_added'],
					'model'  	  		=> $product_info['model'],
					'quantity'    		=> $product_info['quantity'],
					'link'        		=> $this->url->link('product/product', 'product_id=' . $product_info['product_id']),
				);
			}
			$list = $cat['child'];
		}
		return $list;
	}
	private  function getLabel($filter){
		switch ($filter) {
			case 'p_price' 			: return $this->language->get('value_price');
			case 'pd_name' 			: return $this->language->get('value_name');
			case 'p_model' 			: return $this->language->get('value_model');
			case 'p_quantity' 		: return $this->language->get('value_quantity');
			case 'rating' 			: return $this->language->get('value_rating');
			case 'p_sort_order' 	: return $this->language->get('value_sort_add');
			case 'p_date_added' 	: return $this->language->get('value_date_add');
			case 'sales' 			: return $this->language->get('value_sale');
		}
	}
}