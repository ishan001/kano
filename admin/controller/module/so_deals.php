<?php
class ControllerModuleSodeals extends Controller {
	private $error = array();
	private $data = array();
	public function index() {
	// Load language
	$this->load->language('module/so_deals');
	$data['objlang'] = $this->language;
	
	// Load breadcrumbs
	$data['breadcrumbs'] = $this->_breadcrumbs();
	
	// Load model	
	$this->load->model('catalog/category');
	$this->load->model('extension/module');
	$this->load->model('module/so_deals');
	
	$this->document->setTitle($this->language->get('heading_title'));
		
	// Delete Module
	if( isset($this->request->get['module_id']) && isset($this->request->get['delete']) ){
		$this->model_extension_module->deleteModule( $this->request->get['module_id'] );
		$this->response->redirect($this->url->link('module/so_deals', 'token=' . $this->session->data['token'], 'SSL'));
	}
	// Get Module Id new 
	$moduleid_new= $this->model_module_so_deals->getModuleId();
	$module_id = '';	
	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
		if (!isset($this->request->get['module_id'])) {
			$this->request->post['moduleid'] = $moduleid_new[0]['Auto_increment'];
			$module_id = $moduleid_new[0]['Auto_increment'];
			$this->model_extension_module->addModule('so_deals', $this->request->post);
			
		} else {
			$module_id = $this->request->get['module_id'];
			$this->request->post['moduleid'] = $this->request->get['module_id'];
			$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
		}

		$action = isset($this->request->post["action"]) ? $this->request->post["action"] : "";
		unset($this->request->post['action']);
		$data = $this->request->post;
		
		$this->session->data['success'] = $this->language->get('text_success');
		if($action == "save_edit") {
			$this->response->redirect($this->url->link('module/so_deals', 'module_id='.$module_id.'&token=' . $this->session->data['token'], 'SSL'));
		}elseif($action == "save_new"){
			$this->response->redirect($this->url->link('module/so_deals', 'token=' . $this->session->data['token'], 'SSL'));
		}else{
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
	}
	if (!isset($this->request->get['module_id'])) {
		$data['action'] = $this->url->link('module/so_deals', 'token=' . $this->session->data['token'], 'SSL');
	} else {
		$data['action'] = $this->url->link('module/so_deals', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
	}

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$default = array(
			'name' 					=> '',
			'module_description'	=> array(),
			'disp_title_module'		=> '1',
			'status'				=> '1',
			'class_suffix'			=> '',
			'item_link_target'		=> '_blank',
			'nb_column0'			=> '4',
			'nb_column1'			=> '4',
			'nb_column2'			=> '3',
			'nb_column3'			=> '2',
			'nb_column4'			=> '1',
			'nb_row'				=> '1',
			'categorys'				=> array(),
			'child_category'		=> '1',	
			'category_depth'		=> '1',
			'product_sort'			=> 'p.price',
			'product_ordering'		=> 'ASC',
			'source_limit'			=> '6',
			'display_title'			=> '1',
			'title_maxlength'		=> '50',
			'display_description'	=> '1',
			'description_maxlength' => '100',
			'display_price'			=> '1',
			'display_add_to_cart'	=> '1',
			'display_wishlist' 		=> '1',
			'display_compare'		=> '1',
			'display_rating'		=> '1',
			'display_sale'			=> '1',
			'display_new'			=> '1',
			'date_day'				=> '7',
			'product_image_num' 	=> '1',
			
			'product_image'			=> '1',
			'product_get_image_data'=> '1',
			'product_get_image_image'=> '1',
			'width'					=> '200',
			'height'				=> '200',
			'placeholder_path'		=> 'nophoto.png',
			'margin'				=> '5',
			'slideBy'				=> '1',
			'autoplay'				=> '0',
			'autoplayTimeout'		=> '5000',
			'autoplayHoverPause'	=> '0',
			'autoplaySpeed'			=> '1000',
			'startPosition'			=> '0',
			'mouseDrag'				=> '1',
			'touchDrag'				=> '1',
			'loop'					=> '1',
			'button_page' 			=> 'top',
			'dots'					=> '1',
			'dotsSpeed'				=> '500',
			'navs'					=> '1',
			'navSpeed'				=> '500',
			'effect'				=> 'starwars',
			'duration'				=> '800',
			'delay'					=> '500',
			
			'post_text'				=> '',
			'pre_text'				=> ''
		);
		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST') || $this->request->server['REQUEST_METHOD'] == 'POST' && !$this->validate() && isset($this->request->get['module_id'])) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
			$module_info =  array_merge($default,$module_info);//check data empty database
			$categorys = $module_info['category'];
			foreach ($categorys as $category_id) {
				$category_info = $this->model_catalog_category->getCategory($category_id);

				if ($category_info) {
					$module_info['categorys'][] = array(
						'category_id' => $category_info['category_id'],
						'name'       => $category_info['name']
					);
				}
			}
			$data['action'] = $this->url->link('module/so_deals', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
			$data['subheading'] = $this->language->get('text_edit_module') . $module_info['name'];
			$data['selectedid'] = $this->request->get['module_id'];
		} else {
			$module_info = $default;
			if($this->request->post != null)
			{
				$module_info = array_merge($module_info,$this->request->post);
				$categorys = $module_info['category'];
				if($categorys != null){
					foreach ($categorys as $category_id) {
						$category_info = $this->model_catalog_category->getCategory($category_id);

						if ($category_info) {
							$module_info['categorys'][] = array(
								'category_id' => $category_info['category_id'],
								'name'       => $category_info['name']
							);
						}
					}
				}
			}
			$data['selectedid'] = 0;
			$data['action'] = $this->url->link('module/so_deals', 'token=' . $this->session->data['token'], 'SSL');
			$data['subheading'] = $this->language->get('text_create_new_module');
		}

		$data['token'] = $this->session->data['token'];
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
		$data['error']= $this->error;

		// Save and Stay --------------------------------------------------------------
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		$data['text_layout'] = sprintf($this->language->get('text_layout'), $this->url->link('design/layout', 'token=' . $this->session->data['token'], 'SSL'));	
		
		// ---------------------------Load module --------------------------------------------
		$data['modules'] = array( 0=> $module_info );
		$data['moduletabs'] = $this->model_extension_module->getModulesByCode( 'so_deals' );
		$data['link'] = $this->url->link('module/so_deals', 'token=' . $this->session->data['token'] . '', 'SSL');
		//--------------------------------Load Data -------------------------------------------
		$data['item_link_targets'] = array(
					'_blank' => $this->language->get('value_blank'),
					'_self'  => $this->language->get('value_self'),
				);
		
		//Column
		$data['nb_columns'] = array(
			'1'   => '1',
			'2'   => '2',
			'3'   => '3',
			'4'   => '4',
			'5'   => '5',
			'6'   => '6',
		);
		//rows
		$data['nb_rows'] = array(
			'1'   => '1',
			'2'   => '2',
			'3'   => '3',
			'4'   => '4',
			'5'   => '5',
			'6'   => '6',
		);
		//Product order by
		$data['product_sorts'] = array(
			'pd.name'  		=> $this->language->get('value_name'),
			'p.model'  		=> $this->language->get('value_model'),
			'p.price'  		=> $this->language->get('value_price'),
			'p.quantity' 	=> $this->language->get('value_quantity'),
			'rating' 		=> $this->language->get('value_rating'),
			'p.sort_order' 	=> $this->language->get('value_sort_order'),
			'p.date_added' 	=> $this->language->get('value_date_added'),
			'sales' 		=> $this->language->get('value_sales')
		);
		//Product order direction
		$data['product_orderings'] = array(
			'ASC'   => $this->language->get('value_asc'),
			'DESC'  => $this->language->get('value_desc'),
		);
		//button page
		$data['button_pages'] = array(
			'top' => $this->language->get('value_top'),
			'under' => $this->language->get('value_under'),
		);
		
		//Number Product Image
		$data['product_image_nums'] = array(
			'1'   => '1',
			'2'   => '2'
		);
		
		//Effect 
		$data['effects'] = array(
			'none' 			=> $this->language->get('effect_none'),
			'fadeIn' 		=> $this->language->get('effect_fadeIn'),
			'zoomIn' 		=> $this->language->get('effect_zoomIn'),
			'zoomOut' 		=> $this->language->get('effect_zoomOut'),
			'slideLeft'  	=> $this->language->get('effect_slideLeft'),
			'slideRight' 	=> $this->language->get('effect_slideRight'),
			'slideTop' 		=> $this->language->get('effect_slideTop'),
			'slideBottom' 	=> $this->language->get('effect_slideBottom'),
			'flip'			=> $this->language->get('effect_flip'),
			'flipInX' 		=> $this->language->get('effect_flipInX'),
			'flipInY' 		=> $this->language->get('effect_flipInY'),
			'starwars'		=> $this->language->get('effect_starwars'),
			'bounceIn' 		=> $this->language->get('effect_bounceIn'),
			'bounceInUp' 	=> $this->language->get('effect_bounceInUp'),
			'bounceInDown' 	=> $this->language->get('effect_bounceInDown'),
			'pageTop'		=> $this->language->get('effect_pageTop'),
			'pageBottom' 	=> $this->language->get('effect_pageBottom'),
		);
		// Module description
		$data['module_description'] = $module_info['module_description'];
		//Get Data Default
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('module/so_deals.tpl', $data));
	}
	public function _breadcrumbs(){
		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		if (!isset($this->request->get['module_id'])) {
			$this->data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/so_deals', 'token=' . $this->session->data['token'], 'SSL')
			);
		} else {
			$this->data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/so_deals', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
			);
		}
		return $this->data['breadcrumbs'];
	}
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/so_deals')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		$this->load->model('localisation/language');
		$languages = $this->model_localisation_language->getLanguages();

		foreach($languages as $language){
			$module_description = $this->request->post['module_description'];
			if ((utf8_strlen($module_description[$language['language_id']]['head_name']) < 3) || (utf8_strlen($module_description[$language['language_id']]['head_name']) > 64)) {
				$this->error['head_name'] = $this->language->get('error_head_name');
			}
		}

		if ($this->request->post['category'] == null) {
			$this->error['category'] = $this->language->get('error_category');
		}
		
		if (!filter_var($this->request->post['category_depth'],FILTER_VALIDATE_INT) || $this->request->post['category_depth'] < 0) {
			$this->error['category_depth'] = $this->language->get('error_category_depth');
		}
		if ($this->request->post['source_limit'] != '0' && !filter_var($this->request->post['source_limit'],FILTER_VALIDATE_INT) || $this->request->post['source_limit'] < 0) {
			$this->error['source_limit'] = $this->language->get('error_source_limit');
		}
		
		if ($this->request->post['title_maxlength'] != '0' && !filter_var($this->request->post['title_maxlength'],FILTER_VALIDATE_INT) || $this->request->post['title_maxlength'] < 0) {
			
			$this->error['title_maxlength'] = $this->language->get('error_title_maxlength');
		}
		
		if ($this->request->post['description_maxlength'] != '0' && !filter_var($this->request->post['description_maxlength'],FILTER_VALIDATE_INT) || $this->request->post['description_maxlength'] < 0) {
			$this->error['description_maxlength'] = $this->language->get('error_description_maxlength');
		}
		
		if (!filter_var($this->request->post['margin'],FILTER_VALIDATE_INT) && $this->request->post['title_maxlength'] != '0'  || $this->request->post['margin'] < 0) {
			$this->error['margin'] = $this->language->get('error_margin');
		}
		
		if (!filter_var($this->request->post['slideBy'],FILTER_VALIDATE_INT) || $this->request->post['slideBy'] < 0) {
			$this->error['slideBy'] = $this->language->get('error_slideBy');
		}
		
		if (!filter_var($this->request->post['autoplayTimeout'],FILTER_VALIDATE_INT) || $this->request->post['autoplayTimeout'] < 0) {
			$this->error['autoplayTimeout'] = $this->language->get('error_autoplayTimeout');
		}
		
		if (!filter_var($this->request->post['autoplaySpeed'],FILTER_VALIDATE_INT) || $this->request->post['autoplaySpeed'] < 0) {
			$this->error['autoplaySpeed'] = $this->language->get('error_autoplaySpeed');
		}

		if ($this->request->post['startPosition'] != '0' && !filter_var($this->request->post['startPosition'],FILTER_VALIDATE_INT) || $this->request->post['startPosition'] < 0) {
			$this->error['startPosition'] = $this->language->get('error_startPosition');
		}
		
		if (!filter_var($this->request->post['dotsSpeed'],FILTER_VALIDATE_INT) || $this->request->post['dotsSpeed'] < 0) {
			$this->error['dotsSpeed'] = $this->language->get('error_dotsSpeed');
		}
		
		if (!filter_var($this->request->post['navSpeed'],FILTER_VALIDATE_INT) || $this->request->post['navSpeed'] < 0) {
			$this->error['navSpeed'] = $this->language->get('error_navSpeed');
		}
		
		if (!filter_var($this->request->post['duration'],FILTER_VALIDATE_INT) || $this->request->post['duration'] < 0) {
			$this->error['duration'] = $this->language->get('error_duration');
		}
		
		if (!filter_var($this->request->post['delay'],FILTER_VALIDATE_INT) || $this->request->post['delay'] < 0) {
			$this->error['delay'] = $this->language->get('error_delay');
		}
		if (!filter_var($this->request->post['width'],FILTER_VALIDATE_FLOAT) || $this->request->post['width'] < 0 || $this->request->post['width'] > 5000) {
			$this->error['width'] = $this->language->get('error_width');
		}
		if (!filter_var($this->request->post['height'],FILTER_VALIDATE_FLOAT) || $this->request->post['height'] < 0 || $this->request->post['height'] > 5000) {
			$this->error['height'] = $this->language->get('error_height');
		}
		if ((utf8_strlen($this->request->post['placeholder_path']) < 5) || (utf8_strlen($this->request->post['placeholder_path']) > 64)) {
			$this->error['placeholder_path'] = $this->language->get('error_placeholder_path');
		}
		
		if (!filter_var($this->request->post['date_day'],FILTER_VALIDATE_INT) || $this->request->post['date_day'] <= 0) {
			$this->error['date_day'] = $this->language->get('error_date_day');
		}
		
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		return !$this->error;
	}
	
	public function autocomplete_category() {
		$json = array();
		
		$this->load->model('module/so_deals');
		if (isset($this->request->get['filter_name'])) {
			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'sort'        => 'name',
				'order'       => 'ASC',
				'start'       => 0,
				'limit'       => 5
			);

			$results = $this->model_module_so_deals->getCategories($filter_data);
			foreach ($results as $result) {
				$json[] = array(
					'category_id' => $result['category_id'],
					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
