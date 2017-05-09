<?php
class ControllerModuleSobasicproducts extends Controller {
	public function index($setting) {
		$this->load->language('module/so_basic_products');
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_tax'] = $this->language->get('text_tax');
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

		$data['button_cart'] 	= $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');
		$data['text_noproduct'] 	= $this->language->get('text_noproduct');
		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$this->load->model('module/so_basic_products');
		$this->load->model('tool/image');
		$this->document->addStyle('catalog/view/javascript/so_basic_products/css/style.css');
	
	// Get data
		$data['nb_column0'] 			= $setting['nb_column0'];
		$data['nb_column1'] 			= $setting['nb_column1'];
		$data['nb_column2'] 			= $setting['nb_column2'];
		$data['nb_column3'] 			= $setting['nb_column3'];
		$data['nb_column4'] 			= $setting['nb_column4'];
		$data['class_suffix'] 			= $setting['class_suffix'];
		$data['item_link_target'] 		= $setting['item_link_target'];
		$data['display_title'] 			= $setting['display_title'];
		$data['display_description'] 	= $setting['display_description'];
		$data['display_price'] 			= $setting['display_price'];
		$data['display_add_to_cart'] 	= $setting['display_add_to_cart'];
		$data['display_wishlist'] 		= $setting['display_wishlist'];
		$data['display_compare'] 		= $setting['display_compare'];
		$data['product_image'] 			= $setting['product_image'];
		$data['moduleid']  				= $setting['moduleid'];
		$data['disp_title_module'] 		= (int)$setting['disp_title_module'];
		$data['direction']					=  $this->language->get('direction') == 'rtl' ?  'true' : 'false';
		$data['display_rating'] 		= (int)$setting['display_rating'] ;
		$data['display_sale'] 			= $setting['display_sale'];
		$data['display_new'] 			= $setting['display_new'];
		$data['product_image_num'] 		= (int)$setting['product_image_num'];
		//Tab Advanced
		$data['pre_text'] 				= $setting['pre_text'];
		$data['post_text'] 				= $setting['post_text'];
		
		if (isset($setting['module_description'][$this->config->get('config_language_id')])) {
			$data['head_name'] 			= html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['head_name'], ENT_QUOTES, 'UTF-8');
		}else{
			$data['head_name']  		= $setting['head_name'];
		}
			
		// Get Category list
		$str_categorys = self::getCategoryChild($setting);
		
		if($str_categorys != '')
		{
			// Get Product
			$data['products']= self::getProducts($setting, $str_categorys);
		}else{
			$data['products'] = '';
		}
		
		// Check Version
		if(version_compare(VERSION, '2.1.0.2', '>')) {
			return $this->load->view('module/so_basic_products/default.tpl', $data);
		} else {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/so_basic_products/default.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/so_basic_products/default.tpl', $data);
			} else {
				return $this->load->view('default/template/module/so_basic_products/default.tpl', $data);
			}
		}
		
		
		
	
	}
	public function getCategoryChild($setting){
		// check lại category nếu người dùng unpublic category sau khi cấu hình
		$category_list = array();
		
		foreach($setting['category'] as $category_item)
		{
			$checkCategory = $this->model_module_so_basic_products->checkCategory($category_item);
			if(isset($checkCategory) && $checkCategory[0]['status'] == 1 && $checkCategory != null)
			{
				$category_list[] =  $category_item;
			}
		}
		if($category_list != null)
		{
			if($setting['child_category'])
			{
				for($i=1; $i<=$setting['category_depth'];$i++)
				{
					foreach ($category_list as $categorys)
					{
						$filter_data = array(
							'category_id'  => $categorys,
						);
						
						$categoryss = $this->model_module_so_basic_products->getCategories_son($filter_data);
						foreach ($categoryss as $category)
						{
							$category_list[]  = $category['category_id'];
						}
					}
					
				}
			}
			$category_list = array_unique($category_list);
		}
		
		$str_categorys = implode(",",$category_list);
		return $str_categorys;
	}
	public function getProducts($setting, $str_categorys)
	{
		$filter_data = array(
			'filter_category_id'  => $str_categorys,
			'sort'         => $setting['product_sort'],
			'order'        => $setting['product_ordering'],
			'limit'        => $setting['limitation'] ,
			'start'        => '0' 
		);
		$data['products'] = '';
		$products_arr = $this->model_module_so_basic_products->getProducts_basic_products($filter_data);
		
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
			// get image
			$product_image = $this->model_module_so_basic_products->getImageProduct_basic_products($product_info['product_id']);
			$product_image_first = array_shift($product_image);
			$image2 = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
			if($product_image_first != null)
			{
				$image2 = $this->model_tool_image->resize($product_image_first['image'], $setting['width'], $setting['height']);
			}
			if ($product_info['image'] && $setting['product_get_image_data'] == 1) {
				$image = $this->model_tool_image->resize($product_info['image'], $setting['width'], $setting['height']);
			}elseif($product_image_first['image'] && $setting['product_get_image_image'] == 1){
				$image = $this->model_tool_image->resize($product_image_first['image'], $setting['width'], $setting['height']);
			} else {
				$url = file_exists("image/so_basic_products/images/".$setting['product_placeholder_path']);
				if ($url) {
					$image_name = "so_basic_products/images/".$setting['product_placeholder_path'];
				} else {
					$image_name = "no_image.png";
				}
				$image = $this->model_tool_image->resize($image_name, $setting['width'], $setting['height']);
			}
			// Name
			$name = $product_info['name'];
			$name_maxlength = ((strlen($product_info['name']) > $setting['title_maxlength'] && $setting['title_maxlength'] !=0)  ? utf8_substr(strip_tags(html_entity_decode($product_info['name'], ENT_QUOTES, 'UTF-8')), 0, $setting['title_maxlength']) . '..' : $product_info['name']);
			// Description
			$description = ((strlen($product_info['description']) > $setting['description_maxlength'] && $setting['description_maxlength'] != 0) ? utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $setting['description_maxlength']) . '..' : $product_info['description']);
			
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
			
			
			
			
			$datetimeNow = new DateTime();
			$datetimeCreate = new DateTime($product_info['date_available']);
			$interval = $datetimeNow->diff($datetimeCreate);
			$dateDay = $interval->format('%a');
			$productNew = ($dateDay <= $setting['date_day'] ? 1 : 0);
				
			$data['products'][] = array(
				'product_id'  		=> $product_info['product_id'],
				'thumb'       		=> $image,
				'thumb2'       		=> $image2,
				'name'        		=> $name,
				'nameFull'			=> $product_info['name'],
				'name_maxlength'	=> $name_maxlength,
				'description' 		=> $description,
				'price'       		=> $price,
				'special'     		=> $special,
				'productNew'		=> $productNew,
				'tax'         		=> $tax,
				'rating'      		=> $rating,
				'href'        		=> $this->url->link('product/product', 'product_id=' . $product_info['product_id'])
			);
		}
		return $data['products'];
	}
}