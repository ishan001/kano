<?php
class ControllerModuleSolistingtabs extends Controller {
	public function index($setting) {
		$module = 'so_listing_tabs';
		$this->load->language('module/so_listing_tabs');
		$data['heading_title'] = $this->language->get('heading_title');
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
		if(!isset($setting['margin']))
		{
			 $setting['margin'] = 0;
		}
		
		$this->load->model('design/banner');
		$this->load->model('tool/image');
		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$this->load->model('module/so_listing_tabs');
		$this->document->addStyle('catalog/view/javascript/so_listing_tabs/css/so-listing-tabs.css');
	
		if (!defined ('OWL_CAROUSEL'))
		{
			$this->document->addStyle('catalog/view/javascript/so_listing_tabs/css/animate.css');
			$this->document->addStyle('catalog/view/javascript/so_listing_tabs/css/owl.carousel.css');
			$this->document->addScript('catalog/view/javascript/so_listing_tabs/js/owl.carousel.js');
			define( 'OWL_CAROUSEL', 1 );
		}
		if (!isset($setting['limit'])) {
			$setting['limit'] = 3;
		}
		if (!isset($setting['start'])) {
			$setting['start'] = 0;
		}
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');
		$setting['width'] = ((int)$setting['width'] == 0 ? "150" : (int)$setting['width']);
		$setting['height'] = ((int)$setting['height'] == 0 ? "150" : (int)$setting['height']);
		$setting['imgcfgcat_width'] = ((int)$setting['imgcfgcat_width'] == 0 ? "30" : (int)$setting['imgcfgcat_width']);
		$setting['imgcfgcat_height'] = ((int)$setting['imgcfgcat_height'] == 0 ? "30" : (int)$setting['imgcfgcat_height']);
		//General 
		$data['item_link_target'] 	= $setting['item_link_target'];
		$data['start'] 				= $setting['start'];
		// Source Option
		$data['type_source'] 			= $setting['type_source'];
		$_catids__ = (array)self::processCategory($setting['category']);
		$category_id_list = array();
		if (!empty($_catids__))
		{
			$category_id_list = self::getCategoryson($_catids__,$setting);
		}
		
		
		$data['setting'] = serialize($setting);
		
		$data['category_id_list'] 		= implode(',',$category_id_list);
		
		//Tabs Option
		$data['tab_all_display'] 	= $setting['tab_all_display'];
		$data['tab_max_characters'] = $setting['tab_max_characters'];
		$data['tab_icon_display'] 	= $setting['tab_icon_display'];
		$data['imgcfgcat_width'] 	= (int)$setting['imgcfgcat_width'];
		$data['imgcfgcat_height'] 	= (int)$setting['imgcfgcat_height'];
		$data['source_limit'] 		= (int)$setting['source_limit'];
		$data['child_category'] 		= (int)$setting['child_category'];
		$data['category_depth'] 		= (int)$setting['category_depth'];
		
		//Items Option
		$data['display_title'] 			= $setting['display_title'];
		$data['title_maxlength'] 		= $setting['title_maxlength'];
		$data['display_description'] 	= $setting['display_description'];
		$data['description_maxlength'] 	= $setting['description_maxlength'];
		
		//Image Option
		$data['product_image'] 		= $setting['product_image'];
		$data['effect'] 			= $setting['effect'];
		$data['duration'] 			= $setting['duration'];
		$data['delay'] 				= $setting['delay'];
		$data['margin'] 			= $setting['margin'];
		
		//Advanced
		$data['type_show']			= $setting['type_show'];
		//Default	
		$data['text_sale']				= $this->language->get('text_sale');
		$data['text_new']				= $this->language->get('text_new');
		
		$data['display_rating'] 		= (int)$setting['display_rating'] ;
		$data['display_sale'] 			= $setting['display_sale'];
		$data['display_new'] 			= $setting['display_new'];
		$data['product_image_num'] 		= (int)$setting['product_image_num'];
		//Tab Advanced
		$data['pre_text'] 				= $setting['pre_text'];
		$data['post_text'] 				= $setting['post_text'];
		
		if (isset($setting['module_description'][$this->config->get('config_language_id')])) {
			$data['head_name'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['head_name'], ENT_QUOTES, 'UTF-8');
		}else{
			$data['head_name']  = $setting['head_name'];
		}
		
		$data['class_suffix'] 		= $setting['class_suffix'];
		$data['moduleid']  			= $setting['moduleid'];
		$data['tag_id'] 			= 'so_listing_tabs_'.$data['moduleid'];
		$data['nb_column0'] 		= $setting['nb_column0'];
		$data['nb_column1'] 		= $setting['nb_column1'];
		$data['nb_column2'] 		= $setting['nb_column2'];
		$data['nb_column3'] 		= $setting['nb_column3'];
		$data['nb_column4'] 		= $setting['nb_column4'];
		$data['nb_rows'] 			= (int)$setting['nb_row'];
		$data['autoplay'] 			= (int)$setting['autoplay'] > 0 ? 'true' : 'false' ;
		$data['display_nav'] 		= (int)$setting['display_nav'] > 0 ? 'true' : 'false' ;
		$data['display_loop'] 		= (int)$setting['display_loop'] > 0 ? 'true' : 'false' ;
		$data['touchdrag'] 			= (int)$setting['touchdrag'] > 0 ? 'true' : 'false' ;
		$data['mousedrag'] 			= (int)$setting['mousedrag'] > 0 ? 'true' : 'false' ;
		$data['pausehover'] 		= (int)$setting['pausehover'] > 0 ? 'true' : 'false' ;
		$data['autoplayTimeout'] 	= (int)$setting['autoplayTimeout'] ;
		$data['autoplaySpeed'] 		= (int)$setting['autoplaySpeed'] ;
		$data['disp_title_module'] 	= (int)$setting['disp_title_module'] ;
		$data['class_ltabs'] 		= 'ltabs00-' . $setting['nb_column0'] . ' ltabs01-' . $setting['nb_column0'] . ' ltabs02-' . $setting['nb_column1'] . ' ltabs03-' . $setting['nb_column2'] .' ltabs04-' . $setting['nb_column4'] ;
		$data['direction'] 			=  $this->language->get('direction') == 'rtl' ?  'true' : 'false';
		$data['display_price'] 		= (int)$setting['display_price'] ;
		$data['display_add_to_cart'] = (int)$setting['display_add_to_cart'] ;
		$data['display_wishlist'] 	= (int)$setting['display_wishlist'] ;
		$data['display_compare'] 	= (int)$setting['display_compare'] ;
		$data['display_banner_image'] = (isset($setting['display_banner_image']) ? $setting['display_banner_image'] : 0);
		$data['NoItem'] = $this->language->get('text_noitem');
		if($data['display_banner_image'] != 0)
		{
			$data['banner_image'] 		= $this->model_tool_image->resize($setting['banner_image'], $setting['banner_width'], $setting['banner_height']);
			$data['banner_image_url'] 	= $setting['banner_image_url'];
		}
		$is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
		if($is_ajax && isset($_POST['is_ajax_listing_tabs']) && $_POST['is_ajax_listing_tabs']){
			
			$setting 					= unserialize($_POST['setting']);
			$setting['start'] 			= $_POST['ajax_reslisting_start'];
			$start						= $setting['start'];
			$product_image 				= $setting['product_image'];
			$display_banner_image 		= (isset($setting['display_banner_image']) ? $setting['display_banner_image'] : 0);
			if($display_banner_image != 0)
			{
				$banner_image 				= $this->model_tool_image->resize($setting['banner_image'], $setting['banner_width'], $setting['banner_height']);
				$banner_image_url 			= $setting['banner_image_url'];
			}
			$display_title				= $setting['display_title'];
			$display_description		= $setting['display_description'];
			$display_price 				= (int)$setting['display_price'] ;
			$display_add_to_cart 		= (int)$setting['display_add_to_cart'] ;
			$display_wishlist 			= (int)$setting['display_wishlist'] ;
			$display_compare 			= (int)$setting['display_compare'] ;
			$item_link_target 			= $setting['item_link_target'];
			$button_cart 				= $this->language->get('button_cart');
			$button_wishlist 			= $this->language->get('button_wishlist');
			$button_compare 			= $this->language->get('button_compare');
			$text_tax 					= $this->language->get('text_tax');
			$tag_id						= 'so_listing_tabs_'.$_POST['lbmoduleid'];
			$type_show					= $setting['type_show'];
			
			$nb_column0 				= $setting['nb_column0'];
			$nb_column1 				= $setting['nb_column1'];
			$nb_column2 				= $setting['nb_column2'];
			$nb_column3 				= $setting['nb_column3'];
			$nb_column4 				=  $setting['nb_column4'];
			$effect						= $setting['effect'];
			$margin 					= $setting['margin'];
			$nb_rows 					= (int)$setting['nb_row'];
			$autoplay 					= (int)$setting['nb_row'] > 0 ? 'true' : 'false' ;
			$display_nav 				= (int)$setting['display_nav'] > 0 ? 'true' : 'false' ;
			$display_loop 				= (int)$setting['display_loop'] > 0 ? 'true' : 'false' ;
			$touchdrag 					= (int)$setting['touchdrag'] > 0 ? 'true' : 'false' ;
			$mousedrag 					= (int)$setting['mousedrag'] > 0 ? 'true' : 'false' ;
			$pausehover 				= (int)$setting['pausehover'] > 0 ? 'true' : 'false' ;
			$autoplayTimeout 			= (int)$setting['autoplayTimeout'] ;
			$autoplaySpeed 				= (int)$setting['autoplaySpeed'] ;
			$class_ltabs 				= 'ltabs00-' . $setting['nb_column0'] . ' ltabs01-' . $setting['nb_column0'] . ' ltabs02-' . $setting['nb_column1'] . ' ltabs03-' . $setting['nb_column2'] .' ltabs04-' . $setting['nb_column4'] ;
			$direction 					=  $this->language->get('direction') == 'rtl' ?  'true' : 'false';
			if($setting['type_source'] == "0")
			{
				$categoryid 	= $_POST['categoryid']; 
				$category_id 	= self::getCategoryson($categoryid ,$setting);
				$child_items 	= self::getProducts( $category_id,$setting);
			}else
			{
				
				$catids 					= $setting['category'];
				$_catids 					= (array)self::processCategory($catids);
				
				$category_id_list 			= self::getCategoryson($_catids,$setting);
				$setting['product_sort'] 	= $_POST['categoryid'];
				$child_items 				= self::getProducts($category_id_list,$setting);
			}
			$rl_loaded = $start;
			$tab_id = $_POST['categoryid'];
			$tab_id = $tab_id == '*' ? 'all' : $tab_id;
			$text_sale				= $this->language->get('text_sale');
			$text_new				= $this->language->get('text_new');
			
			$display_rating			= (int)$setting['display_rating'] ;
			$display_sale			= $setting['display_sale'];
			$display_new 			= $setting['display_new'];
			$product_image_num 		= (int)$setting['product_image_num'];
			$result = new stdClass();
			ob_start();
			if(version_compare(VERSION, '2.1.0.2', '>')) {
				if (file_exists(DIR_TEMPLATE . $this->config->get('theme_default_directory') . '/template/module/so_listing_tabs/default.tpl')) {
					include(DIR_TEMPLATE .$this->config->get('theme_default_directory') . '/template/module/so_listing_tabs/default_items.tpl');
				} else {
					include(DIR_TEMPLATE .'default/template/module/so_listing_tabs/default_items.tpl');
				}
			}else{
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/so_listing_tabs/default.tpl')) {
					include(DIR_TEMPLATE .$this->config->get('config_template') . '/template/module/so_listing_tabs/default_items.tpl');
				} else {
					include(DIR_TEMPLATE .'default/template/module/so_listing_tabs/default_items.tpl');
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
		}else
		{
			if($setting['type_source'] == '0')
				{
					$data['list'] = self::getListCategoriesFilter($setting);
				}
				else
				{
					$data['list'] = self::getListArticlesFilter($setting);
				}
		}
		
		// Check Version
		if(version_compare(VERSION, '2.1.0.2', '>')) {
			return $this->load->view('module/so_listing_tabs/default.tpl', $data);
		} else {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/so_listing_tabs/default.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/so_listing_tabs/default.tpl', $data);
			} else {
				return $this->load->view('default/template/module/so_listing_tabs/default.tpl', $data);
			}
		}
		
		
	}
	public function getListCategoriesFilter($setting)
	{
		$catids = $setting['category'];
		settype($catids, 'array');
		$cat_order_by = $setting['cat_order_by'];
		
		$list = array();
		$cats = array();
		
		if (empty($catids)) return;
		$_catids = (array)self::processCategory($catids);
		if (empty($_catids)) return;
		foreach ($_catids as $cid) {
			$category = $this->model_catalog_category->getCategory($cid);
			$cats[] = $category;
			switch ($cat_order_by) {
				default:
				case 'name':
					usort($cats, create_function('$a, $b', 'return strnatcasecmp( $a["name"], $b["name"]);'));
					break;
				case 'lft':
					usort($cats, create_function('$a, $b', 'return $a->lft < $b->lft;'));
					break;
				case 'random':
					shuffle($cats);
					break;
			}
		}

		if ($setting['tab_all_display'] ==1) {
			$all['category_id'] = '*';
			$all['name'] = 'All Product';
			$all['image'] = '';
			array_unshift($cats, $all);
		}
		$catidpreload = $setting['catid_preload'];
		$selected = false;

		$_cats = array();
		foreach ($cats as $cat) {

			$category_id_list = self::getCategoryson($cat['category_id'],$setting);
			$filter_data = array(
				'filter_category_id'  	=> implode(',',$category_id_list),
				'sort'         			=> $setting['product_sort'],
				'order'        			=> $setting['product_ordering'],
				'limit'        			=> $setting['source_limit'],
				'start' 	   			=> $setting['start']
			);
			$cat['category_id_list'] = $category_id_list;
			$cat['count'] = $this->model_module_so_listing_tabs->getTotalProducts_listing_tabs($filter_data);
			if($cat['count'] > 0){
				$_cats[] = $cat;
			}
			
		}
		
		if (empty($_cats))
			return;
		foreach($_cats as $cat) {	
			if(isset($cat['sel'])){
				unset($cat['sel']);
			}
			if ($cat['count'] > 0) {
				if ($cat['category_id'] == $catidpreload) {
					$cat['sel'] = 'sel';
					$cat['child'] = self::getProducts($cat['category_id_list'], $setting);
					$selected = true;
				}
				if($cat['image'] != null)
				{
					$cat['icon_image'] =$this->model_tool_image->resize($cat['image'], $setting['imgcfgcat_width'], $setting['imgcfgcat_height']);
				}else{
					$cat['icon_image'] =$this->model_tool_image->resize('placeholder.png', $setting['imgcfgcat_width'], $setting['imgcfgcat_height']);
				}
				$list[$cat['category_id']] = $cat;
			}
		}
		
		if (!$selected) {
			foreach ($_cats as $cat) {
				if ($cat['count'] > 0) {
					$cat['sel'] = 'sel';
					$cat['child'] = self::getProducts($cat['category_id_list'], $setting);
					if($cat['image'] != null)
					{
						$cat['icon_image'] =$this->model_tool_image->resize($cat['image'], $setting['imgcfgcat_width'], $setting['imgcfgcat_height']);
					}else{
						$cat['icon_image'] =$this->model_tool_image->resize('placeholder.png', $setting['imgcfgcat_width'], $setting['imgcfgcat_height']);
					}
					$list[$cat['category_id']] = $cat;
					break;
				}
			}
		}
		
		return $list;
	}
	public function getListArticlesFilter($setting)
	{
		$catids = $setting['category'];
		$list = array();
		$cats = array();
		$_catids = (array)self::processCategory($catids);
		if(empty($_catids))
		{
			return;
		}
		
		$filters = $setting['field_product_tab'];
		$articles_filter = array();
		$filter_preload = $setting['field_preload'];
		if(empty($filters)) return;
		if(!in_array($filter_preload,$filters)) {
			foreach ($filters as $filter) {
				$filter_preload = $filter;
				break;
			}
		}
		
		$category_id_list = self::getCategoryson($_catids,$setting);
		
		foreach ($filters as $filter) {
			$filter_data = array(
				'filter_category_id'  	=> implode(',',$category_id_list),
				'sort'         			=> $setting['product_sort'],
				'order'        			=> $setting['product_ordering'],
				'limit'        			=> $setting['source_limit'],
				'start' 	   			=> $setting['start']
			);
			$aritles['count'] = $this->model_module_so_listing_tabs->getTotalProducts_listing_tabs($filter_data);
			$aritles['category_id'] = $filter;
			$aritles['title'] = $this->getLabel($filter);
			array_unshift($articles_filter, $aritles);
		}
		
		foreach ($articles_filter as $filter) {
			if ($filter['count'] > 0) {
				if ($filter['category_id'] == $filter_preload) {
					$filter['sel'] = 'sel';
					$setting['product_sort'] = $filter_preload;
					$filter['child'] = self::getProducts($category_id_list, $setting);
				}
				$list[$filter['category_id']] = $filter;
			}
		}
		
		return $list;
	}
	public function getCategoryson($category_id, $setting)
	{
		$category_arr = array();
		if(!is_array($category_id))
		{
			if($category_id=="*")
			{
				$category_id = $setting['category'];
			}else{
				$category_id = array($category_id);
			}
		}
		$category_arr = $category_id;
		if($setting['child_category'] ==1)
		{
			$category_arr =$category_id;
			for($i=1; $i<= (int)$setting['category_depth'];$i++)
			{
				$filter_data = array(
					'category_id'  => implode(',',$category_arr),
					'category_depth' => $setting['category_depth']
				);
				$categoryss = $this->model_module_so_listing_tabs->getCategories_son_listing_tabs($filter_data);
				foreach ($categoryss as $category)
				{
					if(!in_array($category['category_id'],$category_arr))
					{
						$category_arr[] = $category['category_id'];
					}
				}
			}
		}
		
		return $category_arr;
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
				'limit'        => (int)$setting['source_limit'],
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

		$cat['count'] = $this->model_module_so_listing_tabs->getTotalProducts_listing_tabs($filter_data);
		if ($cat['count'] > 0) 
		{
			$products_arr = $this->model_module_so_listing_tabs->getProducts_listing_tabs($filter_data);
			foreach($products_arr as $product_info)
			{
				$product_image = $this->model_catalog_product->getProductImages($product_info['product_id']);
				$setting['width'] = ($setting['width'] == 0 ? "30px" : $setting['width']);
				$setting['height'] = ($setting['height'] == 0 ? "30px" : $setting['height']);
				$product_image_first = array_shift($product_image);
				$image2 = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
				if($product_image_first != null)
				{
					$image2 = $this->model_tool_image->resize($product_image_first['image'], $setting['width'], $setting['height']);
				}
				if ($product_info['image'] && $setting['product_get_image_data']) {
					$image = $this->model_tool_image->resize($product_info['image'], $setting['width'], $setting['height']);
				}elseif(isset($product_image_first['image']) && $setting['product_get_image_image']){
					$image = $this->model_tool_image->resize($product_image_first['image'], $setting['width'], $setting['height']);
				} else {
					$url = file_exists("image/so_listing_tabs/images/".$setting['product_placeholder_path']);
				if ($url) {
					$image_name = "so_listing_tabs/images/".$setting['product_placeholder_path'];
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
				$name = (($setting['title_maxlength'] != 0 && strlen($product_info['name']) > $setting['title_maxlength']) ? utf8_substr(strip_tags(html_entity_decode($product_info['name'], ENT_QUOTES, 'UTF-8')), 0, $setting['title_maxlength']) . '..' : $product_info['name']);
				$description = (($setting['description_maxlength'] != 0 && strlen($product_info['description']) > $setting['description_maxlength']) ? utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $setting['description_maxlength']) . '..' : $product_info['description']);
				
				$datetimeNow = new DateTime();
				$datetimeCreate = new DateTime($product_info['date_available']);
				$interval = $datetimeNow->diff($datetimeCreate);
				$dateDay = $interval->format('%a');
				$productNew = ($dateDay <= $setting['date_day'] ? 1 : 0);
				$cat['child'][] = array(
					'product_id'  => $product_info['product_id'],
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
			case 'sell' 			: return $this->language->get('value_sell');
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