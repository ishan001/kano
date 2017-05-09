<?php
class ControllerExtensionModuleOccategorythumbnail extends Controller 
{
    public function install() {
        $this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'catalog/occategorythumbnail');
        $this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'catalog/occategorythumbnail');

        $this->load->model('catalog/occategorythumbnail');

        $this->model_catalog_occategorythumbnail->installCategoryThumbnail();
    }
    
    public function index() {
        $this->load->language('extension/module/occategorythumbnail');

        $this->document->setTitle($this->language->get('page_title'));
        
        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_message'] = $this->language->get('text_message');

        $data['button_cancel'] = $this->language->get('button_cancel');
        
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
            'href'      => $this->url->link('extension/module/occategorythumbnail', 'token=' . $this->session->data['token'], true),
        );
        
        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/occategorythumbnail', $data));
    }
}