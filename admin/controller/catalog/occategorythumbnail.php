<?php
class ControllerCatalogOccategorythumbnail extends Controller
{
    private $error = array();

    public function index() {
        $this->load->language('catalog/occategorythumbnail');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/category');

        $this->load->model('catalog/occategorythumbnail');

        $this->model_catalog_occategorythumbnail->installCategoryThumbnail();

        $this->getList();
    }

    protected function getList() {
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'name';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'ASC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        /* Begin breadcrumb */
        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('catalog/occategorythumbnail', 'token=' . $this->session->data['token'] . $url, true)
        );
        /* End */

        /* Get Categories */
        $this->load->model('tool/image');

        $data['categories'] = array();

        $filter_data = array(
            'sort'  => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
        );

        $category_total = $this->model_catalog_category->getTotalCategories();

        $results = $this->model_catalog_occategorythumbnail->getCategories($filter_data);

        foreach ($results as $result) {
            if (is_file(DIR_IMAGE . $result['thumbnail_image'])) {
                $thumbnail_image = $this->model_tool_image->resize($result['thumbnail_image'], 40, 40);
            } else {
                $thumbnail_image = $this->model_tool_image->resize('no_image.png', 40, 40);
            }

            if (is_file(DIR_IMAGE . $result['homethumb_image'])) {
                $homethumb_image = $this->model_tool_image->resize($result['homethumb_image'], 40, 40);
            } else {
                $homethumb_image = $this->model_tool_image->resize('no_image.png', 40, 40);
            }

            $data['categories'][] = array(
                'category_id'           => $result['category_id'],
                'homethumb_image'       => $homethumb_image,
                'thumbnail_image'       => $thumbnail_image,
                'name'                  => $result['name'],
                'sort_order'            => $result['sort_order'],
                'featured'              => $result['featured'],
                'edit'                  => $this->url->link('catalog/occategorythumbnail/edit', 'token=' . $this->session->data['token'] . '&category_id=' . $result['category_id'] . $url, true),
            );
        }
        /* End */

        /* Language Data */
        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');

        $data['column_name'] = $this->language->get('column_name');
        $data['column_sort_order'] = $this->language->get('column_sort_order');
        $data['column_action'] = $this->language->get('column_action');
        $data['column_thumbnail'] = $this->language->get('column_thumbnail');
        $data['column_homethumb'] = $this->language->get('column_homethumb');
        $data['column_featured'] = $this->language->get('column_featured');

        $data['button_add'] = $this->language->get('button_add');
        $data['button_edit'] = $this->language->get('button_edit');
        $data['button_delete'] = $this->language->get('button_delete');
        $data['button_rebuild'] = $this->language->get('button_rebuild');
        /* End */

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        if (isset($this->session->data['information'])) {
            $data['information'] = $this->session->data['information'];

            unset($this->session->data['information']);
        } else {
            $data['information'] = '';
        }

        $url = '';

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['sort_name'] = $this->url->link('catalog/occategorythumbnail', 'token=' . $this->session->data['token'] . '&sort=name' . $url, true);
        $data['sort_sort_order'] = $this->url->link('catalog/occategorythumbnail', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, true);

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $category_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('catalog/occategorythumbnail', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($category_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($category_total - $this->config->get('config_limit_admin'))) ? $category_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $category_total, ceil($category_total / $this->config->get('config_limit_admin')));

        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/occategorythumbnail_list.tpl', $data));
    }

    public function edit() {
        $this->load->language('catalog/occategorythumbnail');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/occategorythumbnail');

        $category_id = $this->request->get['category_id'];

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_catalog_occategorythumbnail->editCategoryThumbnail($category_id, $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('catalog/occategorythumbnail', 'token=' . $this->session->data['token'] . $url, true));
        }

        $this->getForm();
    }

    protected function getForm() {
        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_form'] = $this->language->get('text_edit');
        $data['text_default'] = $this->language->get('text_default');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');

        $data['entry_name'] = $this->language->get('entry_name');
        $data['entry_thumbnail_image'] = $this->language->get('entry_thumbnail_image');
        $data['entry_homethumb_image'] = $this->language->get('entry_homethumb_image');
        $data['entry_featured'] = $this->language->get('entry_featured');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('catalog/occategorythumbnail', 'token=' . $this->session->data['token'] . $url, true)
        );

        $data['action'] = $this->url->link('catalog/occategorythumbnail/edit', 'token=' . $this->session->data['token'] . '&category_id=' . $this->request->get['category_id'] . $url, true);

        $data['cancel'] = $this->url->link('catalog/occategorythumbnail', 'token=' . $this->session->data['token'] . $url, true);

        $category_info = $this->model_catalog_occategorythumbnail->getCategory($this->request->get['category_id']);

        $data['token'] = $this->session->data['token'];

        $data['category_name'] = $category_info['name'];

        if (isset($this->request->post['featured'])) {
            $data['featured'] = $this->request->post['featured'];
        } elseif (!empty($category_info)) {
            $data['featured'] = $category_info['featured'];
        } else {
            $data['featured'] = 0;
        }

        if (isset($this->request->post['thumbnail_image'])) {
            $data['thumbnail_image'] = $this->request->post['thumbnail_image'];
        } elseif (!empty($category_info)) {
            $data['thumbnail_image'] = $category_info['thumbnail_image'];
        } else {
            $data['thumbnail_image'] = '';
        }

        if (isset($this->request->post['homethumb_image'])) {
            $data['homethumb_image'] = $this->request->post['homethumb_image'];
        } elseif (!empty($category_info)) {
            $data['homethumb_image'] = $category_info['homethumb_image'];
        } else {
            $data['homethumb_image'] = '';
        }

        $this->load->model('tool/image');

        if (isset($this->request->post['thumbnail_image']) && is_file(DIR_IMAGE . $this->request->post['thumbnail_image'])) {
            $data['thumb'] = $this->model_tool_image->resize($this->request->post['thumbnail_image'], 100, 100);
        } elseif (!empty($category_info) && is_file(DIR_IMAGE . $category_info['thumbnail_image'])) {
            $data['thumb'] = $this->model_tool_image->resize($category_info['thumbnail_image'], 100, 100);
        } else {
            $data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }

        if (isset($this->request->post['homethumb_image']) && is_file(DIR_IMAGE . $this->request->post['homethumb_image'])) {
            $data['home_thumb'] = $this->model_tool_image->resize($this->request->post['homethumb_image'], 100, 100);
        } elseif (!empty($category_info) && is_file(DIR_IMAGE . $category_info['homethumb_image'])) {
            $data['home_thumb'] = $this->model_tool_image->resize($category_info['homethumb_image'], 100, 100);
        } else {
            $data['home_thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }

        $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/occategorythumbnail_form.tpl', $data));

    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'catalog/occategorythumbnail')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }
}