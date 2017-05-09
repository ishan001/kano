<?php
class ControllerModuleSolatestblog extends Controller {
	public function index($setting) {
	$this->load->language('module/so_latest_blog');
	$data['heading_title'] = $this->language->get('text_latest');
	
	/*Config default*/
	if(!isset($setting['pre_text']))
	{
		$setting['pre_text'] = '';
	}
	if(!isset($setting['post_text']))
	{
		 $setting['post_text'] = '';
	}	
	$this->document->addStyle('catalog/view/javascript/so_latest_blog/css/style.css');
	$data['disp_title_module'] 		= (int)$setting['disp_title_module'];
	if (isset($setting['module_description'][$this->config->get('config_language_id')])) {
		$data['head_name'] 			= html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['head_name'], ENT_QUOTES, 'UTF-8');
	}else{
		$data['head_name']  		= $setting['head_name'];
	}
	$data['error_no_database'] = '';
	if(!$this->checkDatabase()) {	
		$this->load->model('catalog/category');
		$this->load->model('module/so_latest_blog');
		$this->load->model('tool/image');
		if (!defined ('OWL_CAROUSEL'))
		{
			$this->document->addStyle('catalog/view/javascript/so_latest_blog/css/animate.css');
			$this->document->addStyle('catalog/view/javascript/so_latest_blog/css/owl.carousel.css');
			$this->document->addScript('catalog/view/javascript/so_latest_blog/js/owl.carousel.js');
			define( 'OWL_CAROUSEL', 1 );
		}
	
		// General options
		$data['class_suffix'] 			= $setting['class_suffix'];
		$data['item_link_target'] 		= $setting['item_link_target'];
		$data['button_page'] 			= $setting['button_page'];
		$data['type_show']				= $setting['type_show'];
		$data['nb_column0'] 			= $setting['nb_column0'];
		$data['nb_column1'] 			= $setting['nb_column1'];
		$data['nb_column2'] 			= $setting['nb_column2'];
		$data['nb_column3'] 			= $setting['nb_column3'];
		$data['nb_column4'] 			= $setting['nb_column4'];
		$data['nb_rows'] 				= $setting['nb_row'];
		// Blogs options
		$data['display_title'] 			= $setting['display_title'];
		$data['display_description'] 	= $setting['display_description'];
		$data['display_author'] 		= $setting['display_author'];
		$data['display_comment'] 		= $setting['display_comment'];
		$data['display_view'] 			= $setting['display_view'];
		$data['display_date_added'] 	= $setting['display_date_added'];
		$data['blog_image'] 			= $setting['blog_image'];
		$data['moduleid']  				= $setting['moduleid'];
		$data['direction']					=  $this->language->get('direction') == 'rtl' ?  'true' : 'false';
		$data['width'] 					= $setting['width'];
		$data['height']	 				= $setting['height'];
		$data['class_suffix']  	 		= isset($setting['class_suffix'])?$setting['class_suffix']:'';
		$data['display_readmore'] 		= $setting['display_readmore'];
		$data['readmore_text']  	 	= isset($setting['readmore_text'])?$setting['readmore_text']:'Readmore';
		$data['NoItem'] 				= $this->language->get('text_noitem');
		// effect
		$data['autoplay'] = $setting['autoplay'] == 1 ? "true" : "false";
		if ($setting['autoplay'] == 1) {
			$data['autoplay_timeout'] = $setting['autoplay_timeout'];
		}else{
			$data['autoplay_timeout'] = 0;
		}
		$data['margin'] 		= (int)$setting['margin'];
		$data['slideBy'] 		= (int)$setting['slideBy'];
		$data['effect'] 		= $setting['effect'];
		$data['duration'] 		= (int)$setting['duration'];
		$data['delay'] 			= (int)$setting['delay'];
		$data['pausehover'] 	= (int)$setting['pausehover'] == 1 ? "true" : "false";
		$data['autoplaySpeed'] 	= (int)$setting['autoplaySpeed'];
		$data['loop'] 			= (int)$setting['loop'] == 1 ? "true" : "false";
		$data['startPosition'] 	= $setting['startPosition'];
		$data['mouseDrag'] 		= $setting['mouseDrag'] == 1 ? "true" : "false";
		$data['touchDrag'] 		= $setting['touchDrag'] == 1 ? "true" : "false";
		$data['dots'] 			= ($setting['dots'] == 1) ? "true" : "false";
		$data['dotsSpeed'] 		= $setting['dotsSpeed'];
		$data['nav'] 			= ($setting['navs'] == 1 ? "true" : "false");
		$data['navSpeed'] 		= $setting['navSpeed'];
		
		//Tab Advanced
		$data['pre_text'] 				= $setting['pre_text'];
		$data['post_text'] 				= $setting['post_text'];
		
		// Get blogs
		$data['blogs']= self::getListBlogs($setting);
	}else{
		$data['error_no_database'] = $this->language->get('text_no_database');
	}	
		
		if(version_compare(VERSION, '2.1.0.2', '>')) {
			return $this->load->view('module/so_latest_blog/default.tpl', $data);
		} else {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/so_latest_blog/default.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/so_latest_blog/default.tpl', $data);
			} else {
				return $this->load->view('default/template/module/so_latest_blog/default.tpl', $data);
			}
		
		}
		
		
		
		
	}
	public function checkDatabase() {
		$database_not_found = $this->validateTable();

		if(!$database_not_found) {
			return true;
		}

		return false;
	}
	
	public function validateTable() {
		$table_name = $this->db->escape('simple_blog_article');

		$table = DB_PREFIX . $table_name;

		$query = $this->db->query("SHOW TABLES LIKE '{$table}'");

		return $query->num_rows;
	}
	
	public function getListBlogs($setting){
		if (!isset($setting['limit'])) {
			$setting['limit'] = 9;
		}
		if (!isset($setting['width'])) {
			$setting['width'] = 100;
		}
		if (!isset($setting['height'])) {
			$setting['height'] = 200;
		}
		
		// Get Category list
		$str_categorys = self::getCategoryChild($setting);
		
		$blogs =  array();
		if(count($str_categorys) && $str_categorys != "")
		{
			$filter_data = array(
				'category_id'	=> $str_categorys,
				'sort'  		=> $setting['sort'],
				'order' 		=> $setting['order'],
				'start' 		=> 0,
				'limit' 		=> $setting['limit']
			);
			$blogs = $this->model_module_so_latest_blog->getListBlogs($filter_data);
			
			$users = $this->model_module_so_latest_blog->getUsers();
			
			foreach( $blogs as $key => $blog ){
				if ($blogs[$key]['featured_image'] && $setting['blog_get_featured_image']){
					$blogs[$key]['thumb'] = $this->model_tool_image->resize($blog['featured_image'], (int)$setting['width'], (int)$setting['height'] );
				}else {
					$url = file_exists("image/so_latest_blog/images/".$setting['blog_placeholder_path']);
					
					if ($url) {
						$image_name = "so_latest_blog/images/".$setting['blog_placeholder_path'];
					} else {
						$image_name = "no_image.png";
					}
					$blogs[$key]['thumb'] = $this->model_tool_image->resize($image_name, (int)$setting['width'], (int)$setting['height']);
					
				}					
				// Title
				$title = $blog['article_title'];
				$title_maxlength = ((strlen($blog['article_title']) > $setting['title_maxlength'] && $setting['title_maxlength'] !=0)  ? utf8_substr(strip_tags(html_entity_decode($blog['article_title'], ENT_QUOTES, 'UTF-8')), 0, $setting['title_maxlength']) . '..' : $blog['article_title']);
				
				// Description
				$description 	= ((strlen($blog['description']) > $setting['description_maxlength'] && $setting['description_maxlength'] != 0) ? utf8_substr(strip_tags(html_entity_decode($blog['description'], ENT_QUOTES, 'UTF-8')), 0, $setting['description_maxlength']) . '..' : $blog['description']);
				
				$blogs[$key]['title'] 			= $title;
				$blogs[$key]['title_maxlength'] = $title_maxlength;
				$blogs[$key]['description'] 	= $description;
				$blogs[$key]['author'] 			= isset($users[$blog['simple_blog_author_id']])? $users[$blog['simple_blog_author_id']]:$this->language->get('text_none_author');
				//$blogs[$key]['category_link'] 	=  $this->url->link( 'pavblog/category', "path=".$blog['category_id'] );
				$blogs[$key]['date_added']      = $blog['date_added']; 
				$blogs[$key]['date_modified']   = $blog['date_modified'];
				$blogs[$key]['comment_count'] 	=  $blog['comment'];
				$blogs[$key]['view_count'] 		=  $blog['view'];
				$blogs[$key]['link'] 			=  $this->url->link( 'simple_blog/article/view','simple_blog_article_id='.$blog['simple_blog_article_id'] );
				// text comment
				if($blog['comment'] > 1)
				{
					$blogs[$key]['text_comment']   = $this->language->get('text_comments');
				}else{
					$blogs[$key]['text_comment']   = $this->language->get('text_comment');
				}
				
				// text view
				if($blog['view'] > 1)
				{
					$blogs[$key]['text_view']   = $this->language->get('text_views');
				}else{
					$blogs[$key]['text_view']   = $this->language->get('text_view');
				}
			}
		}
		
		$data['blogs'] = $blogs;
		
		return $data['blogs'];
	}

	public function getCategoryChild($setting){
		// check lại category nếu người dùng unpublic category sau khi cấu hình
		$category_list = array();
		
		foreach($setting['category'] as $category_item)
		{
			$checkCategory = $this->model_module_so_latest_blog->checkCategory($category_item);
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
						$categoryss = $this->model_module_so_latest_blog->getCategories_son($categorys);
						foreach ($categoryss as $category)
						{
							$category_list[]  = $category['simple_blog_category_id'];
						}
					}
					
				}
			}
			$category_list = array_unique($category_list);
		}
		
		$str_categorys = implode(",",$category_list);
		return $str_categorys;
	}
}