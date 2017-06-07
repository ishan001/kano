<?php
class ControllerExtensionModuleOcsearchcategory extends Controller {

    public function index() {

        $this->load->language('extension/module/ocsearchcategory');

        $this->load->model('catalog/category');
        $this->load->model('tool/image');

        $data['text_search'] = $this->language->get('text_search');
        $data['text_category'] = $this->language->get('text_category');

        if (isset($this->request->get['search'])) {
            $data['search'] = $this->request->get['search'];
        } else {
            $data['search'] = '';
        }

        if (isset($this->request->get['category_id'])) {
            $category_id = $this->request->get['category_id'];
        } else {
            $category_id = 0;
        }

        // 3 Level Category Search
        $data['categories'] = array();

        $categories_1 = $this->model_catalog_category->getCategories(0);

        foreach ($categories_1 as $category_1) {
            $level_2_data = array();

            $categories_2 = $this->model_catalog_category->getCategories($category_1['category_id']);

            foreach ($categories_2 as $category_2) {
                $level_3_data = array();

                $categories_3 = $this->model_catalog_category->getCategories($category_2['category_id']);

                foreach ($categories_3 as $category_3) {
                    $level_3_data[] = array(
                        'category_id' => $category_3['category_id'],
                        'name'        => $category_3['name'],
                    );
                }

                $level_2_data[] = array(
                    'category_id' => $category_2['category_id'],
                    'name'        => $category_2['name'],
                    'children'    => $level_3_data
                );
            }

            $data['categories'][] = array(
                'category_id' => $category_1['category_id'],
                'name'        => $category_1['name'],
                'children'    => $level_2_data
            );
        }

        $data['category_id'] = $category_id;
        $data['search_action'] = $this->url->link('product/search', '', true);
        $data['search_ajax_action'] = $this->url->link('extension/module/ocsearchcategory/ajaxSearch', '', true);
        $data['ocsearchcategory_ajax_enabled'] = $this->config->get('ocsearchcategory_ajax_enabled');
        $data['ocsearchcategory_loader_img'] = $this->config->get('config_url') . 'image/' . $this->config->get('ocsearchcategory_loader_img');

        return $this->load->view('extension/module/ocsearchcategory/ocsearchcategory.tpl', $data);
    }

    public function ajaxSearch() {

        $this->load->language('extension/module/ocsearchcategory');

        $json = array();

        if(($this->request->server['REQUEST_METHOD'] == 'POST')) {

            $postData = $this->request->post;

            $this->setAjaxSearchResult($postData);

            if(!$json) {
                $json['success'] = true;
            }

            $productCollection = $this->getAjaxSearchResult();
            if(!$productCollection || count($productCollection) == 0) {
                $data['products'] = array();
            } else {
                $data['products'] = $productCollection;
            }

            $data['text_empty'] = $this->language->get('text_empty');
            $data['text_tax'] = $this->language->get('text_tax');

            $data['product_img_enabled'] = $this->config->get('ocsearchcategory_product_img');
            $data['product_price_enabled'] = $this->config->get('ocsearchcategory_product_price');

            $json['result_html'] = $this->load->view('extension/module/ocsearchcategory/searchajaxresult.tpl', $data);

        } else {
            if(!$json) {
                $json['success'] = false;
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));

    }

    private function setAjaxSearchResult($data) {

        $text_search = $data['text_search'];
        $cate_search = $data['cate_search'];

        $this->load->model('catalog/category');
        $this->load->model('catalog/product');
        $this->load->model('tool/image');

        $url = '';

        if (isset($text_search)) {
            $search = $text_search;
            $url .= '&search=' . urlencode(html_entity_decode($text_search, ENT_QUOTES, 'UTF-8'));
        } else {
            $search = '';
        }

        if (isset($cate_search)) {
            $category_id = $cate_search;
            $url .= '&category_id=' . $cate_search;
        } else {
            $category_id = 0;
        }

        $data['products'] = array();

        $filter_data = array(
            'filter_name'         => $search,
            'filter_category_id'  => $category_id
        );

        $results = $this->model_catalog_product->getProducts($filter_data);

        foreach ($results as $result) {
            if ($result['image']) {
                $image = $this->model_tool_image->resize($result['image'], $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
            } else {
                $image = $this->model_tool_image->resize('placeholder.png', $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
            }

            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
            } else {
                $price = false;
            }

            if ((float)$result['special']) {
                $special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
            } else {
                $special = false;
            }

            if ($this->config->get('config_tax')) {
                $tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price'], $this->session->data['currency']);
            } else {
                $tax = false;
            }

            if ($this->config->get('config_review_status')) {
                $rating = (int)$result['rating'];
            } else {
                $rating = false;
            }
			
			$result['name'] = strlen($result['name']) > 30 ? substr($result['name'],0,30)."..." : $result['name'];
			
            $data['products'][] = array(
                'product_id'  => $result['product_id'],
                'thumb'       => $image,
                'name'        => $result['name'],
                'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
                'price'       => $price,
                'special'     => $special,
                'tax'         => $tax,
                'rating'      => $result['rating'],
                'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'] . $url)
            );
        }

        $this->__set('ajax_search_result', $data['products']);

    }

    public function getAjaxSearchResult() {
        return $this->__get('ajax_search_result');
    }

}