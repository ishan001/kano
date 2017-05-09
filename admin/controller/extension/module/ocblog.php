<?php

class ControllerExtensionModuleOcblog extends Controller
{
    private $error = array();

    public function index() {
        $this->load->language('extension/module/ocblog');

        $this->document->setTitle($this->language->get('page_title'));

        $this->load->model('blog/articlelist');
        $this->load->model('setting/setting');
		$this->load->model('extension/module');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('ocblog', $this->request->post);
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}

			$blog_arr_setting = array(
				'ocblog_article_limit' => $this->request->post['ocblog_article_limit'],
				'ocblog_meta_title' => $this->request->post['ocblog_meta_title'],
				'ocblog_meta_description' => $this->request->post['ocblog_meta_description'],
				'ocblog_meta_keyword' => $this->request->post['ocblog_meta_keyword']
			);
            $this->model_setting_setting->editSetting('ocblog', $blog_arr_setting);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_select'] = $this->language->get('text_select');
        $data['text_none'] = $this->language->get('text_none');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

        $data['entry_article_limit'] = $this->language->get('entry_article_limit');
        $data['entry_rows'] = $this->language->get('entry_rows');
        $data['entry_title'] = $this->language->get('entry_title');
        $data['entry_items'] = $this->language->get('entry_items');
        $data['entry_auto'] = $this->language->get('entry_auto');
        $data['entry_speed'] = $this->language->get('entry_speed');
        $data['entry_navigation'] = $this->language->get('entry_navigation');
        $data['entry_pagination'] = $this->language->get('entry_pagination');
        $data['entry_article_list'] = $this->language->get('entry_article_list');
        $data['entry_meta_title'] = $this->language->get('entry_meta_title');
        $data['entry_meta_description'] = $this->language->get('entry_meta_description');
        $data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
        $data['entry_name'] = $this->language->get('entry_name');
        $data['entry_width'] = $this->language->get('entry_width');
        $data['entry_height'] = $this->language->get('entry_height');
        $data['entry_status'] = $this->language->get('entry_status');
        
        $data['help_article_limit'] = $this->language->get('help_article_limit');
        $data['help_meta_title'] = $this->language->get('help_meta_title');
        $data['help_meta_description'] = $this->language->get('help_meta_description');
        $data['help_meta_keyword'] = $this->language->get('help_meta_keyword');
        
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_article_list'] = $this->language->get('button_article_list');

        $this->load->model('localisation/language');

        $data['languages'] = array();

        $languages = $this->model_localisation_language->getLanguages();

        foreach ($languages as $language){
            if ($language['status']) {
                $data['languages'][] = array(
                    'name'  => $language['name'],
                    'language_id' => $language['language_id'],
                    'code' => $language['code']
                );
            }
        }
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['article_limit'])) {
            $data['error_article_limit'] = $this->error['article_limit'];
        } else {
            $data['error_article_limit'] = '';
        }

        $data['article_lists'] = array();

        $article_lists = $this->model_blog_articlelist->getAllArticlesList();
        foreach($article_lists as $list) {
            $data['article_lists'][] = array(
                'article_list_id' => $list['article_list_id'],
                'name'  => $list['name']
            );
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('extension/module/ocblog', 'token=' . $this->session->data['token'], true),
        );

        if (isset($this->request->get['module_id'])) {
            $data['list_action'] = $this->url->link('blog/articlelist', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], true);
        } else {
            $data['list_action'] = $this->url->link('blog/articlelist', 'token=' . $this->session->data['token'], true);
        }

		$data['action'] = $this->url->link('extension/module/ocblog', 'token=' . $this->session->data['token'], true);
        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);
		
		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
            $data['action'] = $this->url->link('extension/module/ocblog', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], true);
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}

        if (isset($this->request->post['title'])) {
            $data['title'] = $this->request->post['title'];
        } elseif (!empty($module_info) && isset($module_info['title'])) {
            $data['title'] = $module_info['title'];
        } else {
            $data['title'] = array();
        }
        
        if (isset($this->request->post['list'])) {
            $data['list'] = $this->request->post['list'];
        } elseif (!empty($module_info)) {
            $data['list'] = $module_info['list'];
        } else {
            $data['list'] = '';
        }

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}

        if (isset($this->request->post['width'])) {
            $data['width'] = $this->request->post['width'];
        } elseif (!empty($module_info)) {
            $data['width'] = $module_info['width'];
        } else {
            $data['width'] = '';
        }

        if (isset($this->request->post['height'])) {
            $data['height'] = $this->request->post['height'];
        } elseif (!empty($module_info)) {
            $data['height'] = $module_info['height'];
        } else {
            $data['height'] = '';
        }

        if (isset($this->request->post['rows'])) {
            $data['rows'] = $this->request->post['rows'];
        } elseif (!empty($module_info)) {
            $data['rows'] = $module_info['rows'];
        } else {
            $data['rows'] = 1;
        }

        if (isset($this->request->post['items'])) {
            $data['items'] = $this->request->post['items'];
        } elseif (!empty($module_info)) {
            $data['items'] = $module_info['items'];
        } else {
            $data['items'] = 4;
        }

        if (isset($this->request->post['auto'])) {
            $data['auto'] = $this->request->post['auto'];
        } elseif (!empty($module_info)) {
            $data['auto'] = $module_info['auto'];
        } else {
            $data['auto'] = 1;
        }

        if (isset($this->request->post['speed'])) {
            $data['speed'] = $this->request->post['speed'];
        } elseif (!empty($module_info)) {
            $data['speed'] = $module_info['speed'];
        } else {
            $data['speed'] = 3000;
        }

        if (isset($this->request->post['navigation'])) {
            $data['navigation'] = $this->request->post['navigation'];
        } elseif (!empty($module_info)) {
            $data['navigation'] = $module_info['navigation'];
        } else {
            $data['navigation'] = 1;
        }

        if (isset($this->request->post['pagination'])) {
            $data['pagination'] = $this->request->post['pagination'];
        } elseif (!empty($module_info)) {
            $data['pagination'] = $module_info['pagination'];
        } else {
            $data['pagination'] = 0;
        }
		
		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

        if (isset($this->error['meta_title'])) {
            $data['error_meta_title'] = $this->error['meta_title'];
        } else {
            $data['error_meta_title'] = '';
        }

        if (isset($this->error['meta_description'])) {
            $data['error_meta_description'] = $this->error['meta_description'];
        } else {
            $data['error_meta_description'] = '';
        }
        
        if (isset($this->error['meta_keyword'])) {
            $data['error_meta_keyword'] = $this->error['meta_keyword'];
        } else {
            $data['error_meta_keyword'] = '';
        }

        if (isset($this->error['width'])) {
            $data['error_width'] = $this->error['width'];
        } else {
            $data['error_width'] = '';
        }

        if (isset($this->error['height'])) {
            $data['error_height'] = $this->error['height'];
        } else {
            $data['error_height'] = '';
        }
		
        if (isset($this->request->post['ocblog_article_limit'])) {
            $data['ocblog_article_limit'] = $this->request->post['ocblog_article_limit'];
        } else {
            $data['ocblog_article_limit'] = $this->config->get('ocblog_article_limit');
        }

        if (isset($this->request->post['ocblog_meta_title'])) {
         $data['ocblog_meta_title'] = $this->request->post['ocblog_meta_title'];
        } else {
         $data['ocblog_meta_title'] = $this->config->get('ocblog_meta_title');
        }

        if (isset($this->request->post['ocblog_meta_description'])) {
            $data['ocblog_meta_description'] = $this->request->post['ocblog_meta_description'];
        } else {
            $data['ocblog_meta_description'] = $this->config->get('ocblog_meta_description');
        }

        if (isset($this->request->post['ocblog_meta_keyword'])) {
            $data['ocblog_meta_keyword'] = $this->request->post['ocblog_meta_keyword'];
        } else {
            $data['ocblog_meta_keyword'] = $this->config->get('ocblog_meta_keyword');
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/ocblog', $data));
    }
    
    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/ocblog')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->request->post['ocblog_article_limit']) {
            $this->error['article_limit'] = $this->language->get('error_article_limit');
        }

        if (!$this->request->post['ocblog_meta_title']) {
            $this->error['meta_title'] = $this->language->get('error_meta_title');
        }

        if (!$this->request->post['ocblog_meta_description']) {
            $this->error['meta_description'] = $this->language->get('error_meta_description');
        }

        if (!$this->request->post['ocblog_meta_keyword']) {
            $this->error['meta_keyword'] = $this->language->get('error_meta_keyword');
        }

        if (!$this->request->post['width']) {
            $this->error['width'] = $this->language->get('error_width');
        }

        if (!$this->request->post['height']) {
            $this->error['height'] = $this->language->get('error_height');
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
            $this->error['name'] = $this->language->get('error_name');
        }

        return !$this->error;
    }

    public function install() {
        $this->load->model('blog/ocblog');
        $this->load->model('setting/setting');
        $this->load->model('extension/extension');

        $this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'blog/article');
        $this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'blog/article');

        $this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'blog/articlelist');
        $this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'blog/articlelist');

        $this->model_blog_ocblog->install();

        $data = array(
            'ocblog_article_limit' => '10',
            'ocblog_meta_title'    => 'Blog',
            'ocblog_meta_description' => 'Blog Description',
            'ocblog_meta_keyword'    => 'Blog Keyword'
        );

        $this->model_setting_setting->editSetting('ocblog', $data, 0);
    }

    public function uninstall() {
        $this->load->model('blog/ocblog');
        $this->load->model('setting/setting');
        $this->load->model('extension/extension');
        $this->load->model('extension/event');

        $this->model_blog_ocblog->uninstall();
        $this->model_extension_extension->uninstall('ocblog', $this->request->get['extension']);
        $this->model_setting_setting->deleteSetting($this->request->get['extension']);
    }
}
