<?php
/******************************************************
 * @package	SO Theme Framework for Opencart 2.0.x
 * @author	http://www.magentech.com
 * @license	GNU General Public License
 * @copyright(C) 2008-2015 Magentech.com. All rights reserved.
*******************************************************/
 

class ControllerModuleSoconfig extends Controller {

    private $error = array();
    public function index() {
		$this->load->language('module/soconfig');
		$this->document->setTitle($this->language->get('heading_title_normal'));
		$this->document->addScript('view/javascript/bs-colorpicker/js/colorpicker.js');
		$this->document->addScript('view/javascript/theme/jquery.cookie.js');
		$this->document->addScript('view/javascript/theme/theme.js');
		
        $this->document->addStyle('view/javascript/bs-colorpicker/css/colorpicker.css');
        $this->document->addStyle('view/stylesheet/theme.css');
		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('soconfig', $this->request->post);
			
			/* loo functions begin */
			function loo_parse_queries($file) {
				
				$sql_file = $file;
				//var_dump($sql_file);die();
				$contents = file_get_contents($sql_file);
				
				$contents = preg_replace('/(?<=t);(?=\n)/', "{{semicolon_in_text}}", $contents);
				$statements = explode(";\n", $contents);
				// $statements = preg_replace("/\s/", ' ', $statements);
				
				$queries = array();
				foreach ($statements as $query) {
					if (trim($query) != '') {
						$query = str_replace("{{semicolon_in_text}}", ";", $query);
						//apply db prefix parametr
						preg_match("/\?:\w*/i", $query, $matches);
						$table_name = str_replace('?:', DB_PREFIX, $matches[0]);
						if ( !empty($table_name) ) {
							$query = str_replace(array($matches[0], 'key = '), array($table_name, '`key` = '), $query);
						}
						$queries[] = $query;
					}
				}
				return $queries;
			}
			/* loo functions end */
			
            // Sample Data
			if ($this->request->post['buttonForm'] == 'apply') {
				$this->session->data['success'] = $this->language->get('text_success');
                $this->response->redirect($this->url->link('module/soconfig', 'token=' . $this->session->data['token'], 'SSL'));
            }else if ($this->request->post['buttonForm'] == 'mega') {
				$this->load->model('setting/store');
				$tmpl_dir = DIR_CATALOG . 'view/theme/' . $this->config->get('theme_default_directory') . '/install.sql';
				
				// Parse and Run sql
				if( file_exists($tmpl_dir) ){
					$sql = loo_parse_queries(DIR_CATALOG . 'view/theme/' . $this->config->get('theme_default_directory') . '/install.sql');
					foreach ($sql as $query) {
						$this->db->query($query);
					}
				}
				$this->session->data['success'] = $this->language->get('text_success');
     		    $this->response->redirect($this->url->link('module/soconfig', 'token=' . $this->session->data['token'], 'SSL'));
			} 
			else {
                $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
            }
			
			
			
			
		}
		
		$data['heading_title'] = $this->language->get('heading_title');
		$data['theme_version'] = $this->language->get('theme_version');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
        $data['success'] = $this->language->get('text_success');
        $data['entry_name'] = $this->language->get('entry_name');
        $data['entry_title'] = $this->language->get('entry_title');
        $data['entry_description'] = $this->language->get('entry_description');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');

        $data['entry_status'] = $this->language->get('entry_status');

		$data['help_code'] = $this->language->get('help_code');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
		
		 $text_strings = array(
			'maintabs_general',
			'maintabs_layout',
			'maintabs_products',
			'maintabs_fonts',
			'maintabs_custom',
			'maintabs_social',
			'maintabs_sampledata',
			
			'general_tab_general',
			'general_tab_header',
			'general_tab_footer',
			'general_tab_mainmenu',
			'general_tab_language',
			'general_res_layout',
			'general_cpanel',
			'general_back_top',
			'general_copyright',
			
			'fonts_body',
			'fonts_menu',
			'fonts_heading',
			'fonts_custome',
			
			'pages_pro_listings',
			'pages_pro_label',
			'pages_pro_detail',
			'product_catalog_title',
			'product_catalog_image',
			'product_list_compare',
			'product_catalog_mode',
			'product_catalog_column',
			'product_catalog_refine',
			'product_catalog_refine_col',
			'show_product_item_desc',
			
			'custom_tab_css_input',
			'custom_tab_css_file',
			'custom_tab_js_input',
			'custom_tab_js_file',
			
			'slide_tab_facebook',
			'slide_tab_twitter',
			'slide_tab_video',
			'slide_tab_custom',
			
			'entry_position',
			'entry_standard',
			'entry_google_font',
			'entry_google_url',
			'entry_google_url_help',
			'entry_google_family',
			'entry_google_family_help',
			'entry_custom_block',
			'entry_title_label',
			'entry_custom_column',
			'entry_my_account',
			'entry_contact_us',
			'entry_catalog_column_help',
			'mobile_menu_title',
			'entry_sort_order',
                
        );
        foreach ($text_strings as $text) {
            $data[$text] = $this->language->get($text);
        }
		
		// store config data
        $config_data = array(
			'soconfig_general',
			'soconfig_fonts',
			'soconfig_pages',
			'soconfig_lang',
			'soconfig_cssfile',
			'soconfig_jsfile',
			'soconfig_custom',
			'soconfig_social',
			'soconfig_layout',
			'soconfig_general_store',
			'soconfig_fonts_store',
			'soconfig_pages_store',
			'soconfig_lang_store',
			'soconfig_cssfile_store',
			'soconfig_jsfile_store',
			'soconfig_custom_store',
			'soconfig_social_store',
			'soconfig_layout_store',
        );
        foreach ($config_data as $conf) {
            if (isset($this->request->post[$conf])) {
                $data[$conf] = $this->request->post[$conf];
            } else {
                $data[$conf] = $this->config->get($conf);
            }
        }
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title_normal'),
			'href' => $this->url->link('module/soconfig', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('module/soconfig', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

        /*variables for theme */
        $data['mproduct'] = $this->url->link('catalog/mproduct', 'token=' . $this->session->data['token'], 'SSL');
        $data['mcategory'] = $this->url->link('catalog/mcategory', 'token=' . $this->session->data['token'], 'SSL');
		
		
	
        /* Edit so config images */
        $this->load->model('tool/image');
        $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		if (isset($this->request->post['soconfig_toppanel'])) {
            $data['soconfig_toppanel'] = $this->request->post['soconfig_toppanel'];
        } else {
            $data['soconfig_toppanel'] = $this->config->get('soconfig_toppanel');
        }
        if (isset($this->request->post['soconfig_toppanel']) && is_file(DIR_IMAGE . $this->request->post['soconfig_toppanel'])) {
            $data['rightimg'] = $this->model_tool_image->resize($this->request->post['soconfig_toppanel'], 100, 100);
        } elseif ($this->config->get('soconfig_toppanel') && is_file(DIR_IMAGE . $this->config->get('soconfig_toppanel'))) {
            $data['rightimg'] = $this->model_tool_image->resize($this->config->get('soconfig_toppanel'), 100, 100);
        } else {
            $data['rightimg'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }
		
		if (isset($this->request->post['soconfig_imgpayment'])) {
            $data['soconfig_imgpayment'] = $this->request->post['soconfig_imgpayment'];
        } else {
            $data['soconfig_imgpayment'] = $this->config->get('soconfig_imgpayment');
        }
		
        if (isset($this->request->post['soconfig_imgpayment']) && is_file(DIR_IMAGE . $this->request->post['soconfig_imgpayment'])) {
            $data['imgpayment'] = $this->model_tool_image->resize($this->request->post['soconfig_imgpayment'], 100, 100);
        } elseif ($this->config->get('soconfig_imgpayment') && is_file(DIR_IMAGE . $this->config->get('soconfig_imgpayment'))) {
            $data['imgpayment'] = $this->model_tool_image->resize($this->config->get('soconfig_imgpayment'), 100, 100);
        } else {
            $data['imgpayment'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }
		
        if (isset($this->request->post['soconfig_contentbg'])) {
            $data['soconfig_contentbg'] = $this->request->post['soconfig_contentbg'];
        } else {
            $data['soconfig_contentbg'] = $this->config->get('soconfig_contentbg');
        }
        if (isset($this->request->post['soconfig_contentbg']) && is_file(DIR_IMAGE . $this->request->post['soconfig_contentbg'])) {
            $data['contentbg'] = $this->model_tool_image->resize($this->request->post['soconfig_contentbg'], 100, 100);
        } elseif ($this->config->get('soconfig_contentbg') && is_file(DIR_IMAGE . $this->config->get('soconfig_contentbg'))) {
            $data['contentbg'] = $this->model_tool_image->resize($this->config->get('soconfig_contentbg'), 100, 100);
        } else {
            $data['contentbg'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }

        /* information pages */
        $this->load->model('catalog/information');

        foreach ($this->model_catalog_information->getInformations() as $result) {
            $data['information_pages'][] = array(
                'title' => $result['title'],
                'information_id' => $result['information_id'],
                'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
            );
        }
        /* end information pages */

        $data['token'] = $this->session->data['token'];
        $this->load->model('localisation/language');
        $data['languages'] = $this->model_localisation_language->getLanguages();

        /*end variables for theme */


        /* stores adding */
        $this->load->model('setting/store');
        $data['stores'] = $this->model_setting_store->getStores();
        /* end stores adding */

      
        //$data['config_url'] = $this->config->get('config_url');

        $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('module/soconfig.tpl', $data));
	}

    public function install(){
        $this->load->model('catalog/mproduct');
        $this->model_catalog_mproduct->createColumnsInProducts();

        $this->load->model('catalog/mcategory');
        $this->model_catalog_mcategory->createColumnsInCategories();


        $this->load->model('setting/setting');
        $this->session->data['success'] = $this->language->get('text_success');

    }

    protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/soconfig')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		return !$this->error;
	}
}