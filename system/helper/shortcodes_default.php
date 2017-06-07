<?php
class ShortcodesDefault extends Controller {

   /**
    * Generate product link with it variant of category and manufacture link.
    *
    * @since 1.0
    * 
    * @param array $atts Shortcode attributes
    * @param string $content Shortcode content
    * @return string Link to product page
    * 
    * @example [link_product id="x" path="x_x" brand="x" ssl="0" title="xyz" /]
    * @example [link_product id="x" path="x_x" brand="x" ssl="0" title="xyz"]custom text[/link_product]
    */
	
   function link_product($atts, $content = '') {
      extract($this->shortcodes->shortcode_atts(array(
         'id'     => 0,
         'path'   => 0,
         'brand'  => 0,
         'ssl'    => 0,
         'title'  => ''
      ), $atts));
      
      if ($id) {
         $ssl     = ($ssl) ? "'SSL'" : "";

         $this->load->model('catalog/product');
         $product = $this->model_catalog_product->getProduct($id);
         
         if ($product) {
            $title = ($title) ? 'title="' . $title . '"' : 'title="' . $product['name'] . '"';

            if (!$content) {
               if(!$path && !$brand) {
                  return '<a href="' . $this->url->link('product/product', 'product_id=' . $id, $ssl) . '" ' . $title . '>' . $product['name'] . '</a>';
               } elseif ($path && (!$brand || $brand)) {
                  return '<a href="' . $this->url->link('product/product', 'path=' . $path . '&product_id=' . $id, $ssl) . '" ' . $title . '>' . $product['name'] . '</a>';
               } elseif (!$path && $brand) {
                  return '<a href="' . $this->url->link('product/product', 'manufacturer_id=' . $brand . '&product_id=' . $id, $ssl) . '" ' . $title . '>' . $product['name'] . '</a>';
               }
            } elseif ($content) {
               if(!$path && !$brand) {
                  return '<a href="' . $this->url->link('product/product', 'product_id=' . $id, $ssl) . '" ' . $title . '>' . $content . '</a>';
               } elseif ($path && (!$brand || $brand)) {
                  return '<a href="' . $this->url->link('product/product', 'path=' . $path . '&product_id=' . $id, $ssl) . '" ' . $title . '>' . $content . '</a>';
               } elseif (!$path && $brand) {
                  return '<a href="' . $this->url->link('product/product', 'manufacturer_id=' . $brand . '&product_id=' . $id, $ssl) . '" ' . $title . '>' . $content . '</a>';
               }
            }
         } elseif (!$product && $content) {
            return $content;
         }
      }
   }
   
   /**
    * Generate category link.
    *
    * @since 1.0
    * 
    * @param array $atts Shortcode attributes
    * @param string $content Shortcode content
    * @return string Link to category page
    * 
    * @example [link_category path="x_y" ssl="0" title="xyz" /]
    * @example [link_category path="x_y" ssl="1" title="xyz"]custom text[/link_category]
    */
   function link_category($atts, $content = '') {
      extract($this->shortcodes->shortcode_atts(array(
         'path'   => 0,
         'ssl'    => 0,
         'title'  => ''
      ), $atts));
      
      if ($path) {
         $ssl     = ($ssl) ? "'SSL'" : "";
         
         $this->load->model('catalog/category');
         $category = $this->model_catalog_category->getCategory($path);
         
         if ($category) {
            if (!$content) {
               return '<a href="' . $this->url->link('product/category', 'path=' . $path, $ssl) . '"' . ' title="' . ($title ? $title : $category['name']) . '">' . $category['name'] . '</a>';
            } elseif ($content) {
               return '<a href="' . $this->url->link('product/category', 'path=' . $path, $ssl) . '"' . ' title="' . ($title ? $title : $content) . '">' . $content . '</a>';
            }
         } elseif (!$category && $content) {
            return $content;
         }
      }
   }
   
   /**
    * Generate brand/ manufacturer link.
    * 
    * @since 1.0
    * 
    * @param array $atts Shortcode attributes
    * @param string $content Shortcode content
    * @return string Link to manufacturer list or manufacture page
    * 
    * @example [link_brand ssl="0" title="xyz" /]
    * @example [link_brand ssl="1" title="xyz"]custom text[/link_brand]
    * @example [link_brand brand="x" ssl="0" title="xyz" /]
    * @example [link_brand brand="x" ssl="1" title="xyz"]custom text[/link_brand]
    */
   function link_brand($atts, $content = '') {
      extract($this->shortcodes->shortcode_atts(array(
         'brand'  => 0,
         'ssl'    => 0,
         'title'  => ''
      ), $atts));
      
      $ssl     = ($ssl) ? "'SSL'" : "";
      $title   = ($title) ? 'title="' . $title . '"' : "";

      if ($brand) {
         $this->load->model('catalog/manufacturer');
         $manufacturer = $this->model_catalog_manufacturer->getManufacturer($brand);

         if ($manufacturer) {
            if (!$content) {
               return '<a href="' . $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $brand, $ssl) . '" ' . $title . '>' . $manufacturer['name'] . '</a>';
            } else {
               return '<a href="' . $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $brand, $ssl) . '" ' . $title . '>' . $content . '</a>';
            }
         } elseif (!$manufacturer && $content) {
            return $content;
         }
      } else {
         if (!$content) {
            $this->load->language('product/manufacturer');

            return '<a href="' . $this->url->link('product/manufacturer', '', $ssl) . '" ' . $title . '>' . $this->language->get('text_brand') . '</a>';
         } else {
            return '<a href="' . $this->url->link('product/manufacturer', '', $ssl) . '" ' . $title . '>' . $content . '</a>';
         }
      }
   }
   
   /**
    * Generate information link.
    * 
    * @since 1.0
    * 
    * @param array $atts Shortcode attributes
    * @param string $content Shortcode content
    * @return string Link to information page
    * 
    * @example [link_info id="x" ssl="0" title="xyz" /]
    * @example [link_info id="x" ssl="0" title="xyz"]custom text[/link_info]
    */
   function link_info($atts, $content = '') {
      extract($this->shortcodes->shortcode_atts(array(
         'id'     => 0,
         'ssl'    => 0,
         'title'  => ''
      ), $atts));
      
      if ($id) {
         $ssl     = ($ssl) ? "'SSL'" : "";
         $title   = ($title) ? 'title="' . $title . '"' : "";
         
         $this->load->model('catalog/information');
         $information = $this->model_catalog_information->getInformation($id);
         
         if ($information) {
            if (!$content) {
               return '<a href="' . $this->url->link('information/information', 'information_id=' . $id, $ssl) . '" ' . $title . '>' . $information['title'] . '</a>';
            } elseif ($content) {
               return '<a href="' . $this->url->link('information/information', 'information_id=' . $id, $ssl) . '" ' . $title . '>' . $content . '</a>';
            }
         } elseif (!$information && $content) {
            return $content;
         }
      }
   }
   
   /**
    * Generate custom link based on OpenCart API Url format
    * 
    * @since 1.0
    * 
    * @param array $atts Shortcode attributes
    * @param string $content Shortcode content
    * @return string Return link based on user input
    * 
    * @example [link_custom route="foo" args="bar" ssl="0" title="xyz"]custom text[/link_custom]
    */
   function link_custom($atts, $content = '') {
      extract($this->shortcodes->shortcode_atts(array(
         'route'  => '',
         'args'   => '',
         'ssl'    => 0,
         'title'  => ''
      ), $atts));
      
      if($route && $content) {
         return '<a href="' . $this->url->link($route, $args, $ssl) . '" ' . 'title="' . $title . '">' . $content . '</a>';
      }
   }
   
   /**
    * Generate custom link for multi-store site
    * 
    * @since 1.0
    * 
    * @param array $atts Shortcode attributes
    * @param string $content Shortcode content
    * @return string Link to manufacturer list or manufacture page
    * 
    * @example [link_store store="x" route="foo" args="bar=3" ssl="0" title="xyz"]custom text[/link_custom]
    */
   function link_store($atts, $content = '') {
      extract($this->shortcodes->shortcode_atts(array(
         'store'  => 0,
         'route'  => '',
         'args'   => '',
         'ssl'    => 0,
         'title'  => ''
      ), $atts));
      
      if ($route && $content) {
         $current_store    = $this->config->get('config_url');
         
         if ($store) {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE store_id = '" . (int)$store . "'" );
            
            if ($query->num_rows) {
               foreach ($query->rows as $setting) {
                  if ($setting['key'] == 'config_url') {
                     $store_url  = $setting['value'];
                  }
               }

               $url = str_replace($current_store, $store_url, $this->url->link($route, $args, $ssl));

               return '<a href="' . $url . '" ' . 'title="' . $title . '">' . $content . '</a>';
            } else {
               return $content;
            }
         } else {
            // from multi-store to default store
            $store_url  = HTTP_SERVER;

            $url = str_replace($current_store, $store_url, $this->url->link($route, $args, $ssl));

            return '<a href="' . $url . '" ' . 'title="' . $title . '">' . $content . '</a>';
         }
      }
   }
   
   /**
    * Load module type product (featured, latest, bestseller, special) anywhere!
    * 
    * @since 1.0
    * 
    * @param array $atts Shortcode attributes
    * @return string Module based on user choose
    * 
    * @example [module_product type="latest" limit="4" img_w="100" img_h="100" /]
    */
   function module_product($atts) {
	  
      extract($this->shortcodes->shortcode_atts(array(
         'type'    => '',
         'limit'   => 4,
         'img_w'   => 200,
         'img_h'   => 200,
         'product' => ''
      ), $atts));

      if ($type) {
         $module = $this->load->controller('module/' . $type, array(
                     'limit'   => $limit,
                     'width'   => $img_w,
                     'height'  => $img_h,
                     'product' => explode(',', $product)
                  ));

         $html = '<div class="shortcode-module sc-' . $type . '">' . $module . '</div>';

         return $html;
      }
   }

   /**
    * Load module slideshow
    * 
    * @since 1.0
    * 
    * @param array $atts Shortcode attributes
    * @return string Show module slideshow
    * 
    * @example [module_slideshow id="7" img_w="1200" img_h="300" /]
    */
   function module_slideshow($atts) {
      extract($this->shortcodes->shortcode_atts(array(
         'id'     => 0,
         'img_w'  => 400,
         'img_h'  => 300
      ), $atts));

      if ($id) {
         $script  = '<script type="text/javascript" src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js"></script>';
         $style   = '<link href="catalog/view/javascript/jquery/owl-carousel/owl.carousel.css" type="text/css" rel="stylesheet" />';

         $module = $this->load->controller('module/slideshow', array(
                     'banner_id' => $id,
                     'width'     => $img_w,
                     'height'    => $img_h
                  ));
         
         $html = '<div class="shortcode-module sc-slideshow">'  . $module . '</div>';
         
         return $html;
      }
   }
   
   /**
    * User required to login to read the rest of the content.
    * Able to restrict user to read based on their group.
    * 
    * @since 1.0
    * 
    * @param array $atts Shortcode attributes
    * @param string $content Shortcode content
    * @return string Message if not permitted to read, show rest of article if permitted.
    * 
    * @example [login msg_login='Silahkan <a href="%s">login</a> untuk melihat halaman ini.']content[/login]
    */
   function login($atts, $content = '') {
      $this->language->load('common/shortcodes_default');
      
      extract($this->shortcodes->shortcode_atts(array(
         'msg_login'    => $this->language->get('login_message'),
         'msg_group'    => $this->language->get('login_group'),
         'suffix'       => '',
         'group'        => ''
      ), $atts));
      
      
      
      if ($content && $this->customer->isLogged()) {
         if($group) {
            if ($group == $this->customer->getGroupId()) {
               return $this->shortcodes->do_shortcode($content);
            } else {
               return '<div class="' . $suffix . '">' . sprintf($msg_group, $this->url->link('information/contact')) . '</div>';
            }
         } else {
            return $this->shortcodes->do_shortcode($content);
         }
      } else {
         return '<div class="' . $suffix . '">' . sprintf($msg_login, $this->url->link('account/login')) . '</div>';
      }
   }
   
   /**
    * Embed video: youtube and vimeo
    * 
    * @since 1.0
    * 
    * @param array $atts Shortcode attributes
    * @return string Video embed code
    * 
    * @example [video type="vimeo" id="xxx" ratio="16by9" /]
    */
   function video($atts) {
      extract($this->shortcodes->shortcode_atts(array(
         'type'      => 'youtube',
         'id'        => 0,
         'ratio'     => '16by9', // 4by3
         'autoplay'  => 0
      ), $atts));

      if ($id) {
         if ($type == 'youtube') {
            $video   = '<div class="embed-responsive embed-responsive-' . $ratio . '">';
            $video  .= '<iframe class="embed-responsive-item" src="http://youtube.com/embed/' . $id . '?rel=0&autoplay=' . $autoplay . '" allowfullscreen></iframe>';
            $video  .= '</div>';
            
            $html    = '<div class="shortcode-video sc-' . $type . '">' . $video . '</div>';
            
            return $html;
            
         } elseif ($type == 'vimeo') {
            $video   = '<div class="embed-responsive embed-responsive-' . $ratio . '">';
            $video  .= '<iframe class="embed-responsive-item" src="//player.vimeo.com/video/' . $id . '?autoplay=' . $autoplay . '" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
            $video  .= '</div>';
            
            $html    = '<div class="shortcode-video sc-' . $type . '">' . $video . '</div>';
            
            return $html;
         }
      }
   }
   
   /**
    * Embed image directly or with cache
    * 
    * @since 1.0
    * 
    * @param array $atts Shortcode attributes
    * @param string $content Shortcode content
    * @return string Image html code
    * 
    * @example [image src="" img_w="450" img_h="280" title="" alt="" align="" /]
    */
   function image($atts, $content = '') {
      extract($this->shortcodes->shortcode_atts(array(
         'src'       => '',
         'img_w'     => 200,
         'img_h'     => 200,
         'title'     => '',
         'alt'       => '',
         'align'     => '',    // left, right, center
         'cache'     => 1
      ), $atts));

      if (!$src && $content) { $src = $content; }
      if (!$alt & $title) { $alt = $title; }
      if ($align == 'right') {
         $align_style = 'float:right;margin:0 0 10px 10px;';
      } elseif ($align == 'center') {
         $align_style = 'display:block;margin:0 auto 15px;';
      } else {
         $align_style = 'float:left;margin:0 10px 0 10px;';
      }

      if (is_file(DIR_IMAGE . $src)) {
         if ($cache) {
            $this->load->model('tool/image');
            $src = $this->model_tool_image->resize($src, $img_w, $img_h);
         }

         return '<img class="shortcode-image" src="' . $src . '" width="' . $img_w.'px' . '" height="' . $img_h.'px' . '" alt="' . $alt . '" title="' . $title . '" style="' . $align_style . '">';
      }
   }
   
   /**
    * Embed image with modalbox feature
    * 
    * @since 1.1
    * 
    * @param array $atts Shortcode attributes
    * @return string Thumbnail with link to open modal box
    * 
    * @example [image_modal src="image/data/your_image.jpg" /]
    * @example [image_modal src="image/data/your_image.jpg" img_w="450" img_h="280" title="" alt="" align="" caption="" load_script="1" /]
    */
   function image_modal($atts, $content = '') {
      $this->language->load('common/shortcodes_default');
      
      extract($this->shortcodes->shortcode_atts(array(
         'src'       => '',
         'img_w'     => 200,
         'img_h'     => 200,
         'title'     => '',
         'alt'       => '',
         'align'     => 'left', // left, right, center
         'caption'   => $this->language->get('imgModal_caption'),
         'load_script'  => 0,
         'cache'     => 1
      ), $atts));
      
      if (!$src && $content) { $src = $content; }
      if (!$alt & $title) { $alt = $title; }
      if ($align == 'right') {
         $align_style = 'float:right;margin:0 0 10px 10px;';
      } elseif ($align == 'center') {
         $align_style = 'display:block;margin:0 auto 15px;';
      } else {
         $align_style = 'float:left;margin:0 10px 10px 0;';
      }
      
      $src_resize    = 'image/' . $src;
      $script_load   = '';
      
      if ($load_script) {
        $this->document->addStyle('catalog/view/javascript/jquery/magnific/magnific-popup.css');
        $this->document->addScript('catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js');

         $script_load .= '<script type="text/javascript">
               $(document).ready(function() {
                  $(".modalbox").magnificPopup({
                     type:"image"
                  });
               });
               </script> ';
      }

      if (is_file(DIR_IMAGE . $src)) {
         if ($cache) {
            $this->load->model('tool/image');
            $src_thumb  = $this->model_tool_image->resize($src, $img_w, $img_h);
         } else {
            $src_thumb  = $src;
         }

         $html  = '<div style="' . $align_style . '">';
         $html .= '<a href="' . $src_resize . '" title="' . $title . '" class="modalbox" style="text-decoration:none; outline:0;">';
         $html .= '<img class="shortcode-image-modal" src="' . $src_thumb . '" width="' . $img_w.'px' . '" height="' . $img_h.'px' . '" alt="' . $alt . '" title="' . $title . '">';
         $html .= '<div class="help" style="font-style:italic;">' . $caption . '</div>';
         $html .= '</a>';
         $html .= $script_load;
         $html .= '</div>';
         
         return $html;
      }
   }
   
   /**
    * Show lite System Information 
    * (full: http://www.echothemes.com/extensions/system-information.html)
    * 
    * @since 2.0
    * 
    * @return string List of system information
    * 
    * @example [sysinfo /]
    */
   function sysinfo() {
      // Show sysinfo only for admin user
      $this->load->library('user');
      $user = new User($this->registry);

      if ($user->isLogged()) {
         $this->language->load('common/shortcodes_default');
         
         $data    = '<h3>' . $this->language->get('sysinfo_title') . ' - ' . date('d M, Y') . '</h3>';
         $data   .= '<table class="sc-sysinfo">';
         $data   .= '<tr><td>' . $this->language->get('sysinfo_opencart') . '</td><td>: v' . VERSION . '</td></tr>';
         if (isset(VQMod::$_vqversion)) {
            $data   .=  '<tr><td>' . $this->language->get('sysinfo_vqmod') . '</td><td>: v' . VQMod::$_vqversion . '</td></tr>';
         }
         $data   .= '<tr><td>' . $this->language->get('sysinfo_shortcodes') . '</td><td>: v' . SHORTCODES_VERSION . '</td></tr>';
         $data   .= '</table>';
         $data   .= '<table class="sc-sysinfo">';
         $data   .= '<tr><td>' . $this->language->get('sysinfo_php') . '</td><td>: v.' . phpversion() . '</td></tr>';
         $data   .= '<tr><td>' . $this->language->get('sysinfo_safemode') . '</td><td>: ' . ((ini_get('safe_mode')) ? $this->language->get('text_on') . ' <span class="sc-alert">- ' . $this->language->get('text_req_off') . '</span>' :  $this->language->get('text_off') . ' <span class="sc-good">- ' . $this->language->get('text_good') . '</span>') . '</td></tr>';
         $data   .= '<tr><td>' . $this->language->get('sysinfo_reg_global') . '</td><td>: ' . ((ini_get('register_globals')) ? $this->language->get('text_on') . ' <span class="sc-alert">- ' . $this->language->get('text_req_off') . '</span>' :  $this->language->get('text_off') . ' <span class="sc-good">- ' . $this->language->get('text_good') . '</span>') . '</td></tr>';
         $data   .= '<tr><td>' . $this->language->get('sysinfo_gpc') . '</td><td>: ' . ((ini_get('magic_quotes_gpc') || get_magic_quotes_gpc()) ? $this->language->get('text_on') . ' <span class="sc-alert">- ' . $this->language->get('text_req_off') . '</span>' :  $this->language->get('text_off') . ' <span class="sc-good">- ' . $this->language->get('text_good') . '</span>') . '</td></tr>';
         $data   .= '<tr><td>' . $this->language->get('sysinfo_session') . '</td><td>: ' . ((ini_get('session_auto_start')) ? $this->language->get('text_on') . ' <span class="sc-alert">- ' . $this->language->get('text_req_off') . '</span>' :  $this->language->get('text_off') . ' <span class="sc-good">- ' . $this->language->get('text_good') . '</span>') . '</td></tr>';
         $data   .= '<tr><td>' . $this->language->get('sysinfo_fopen') . '</td><td>: ' . ((ini_get('allow_url_fopen')) ? $this->language->get('text_on') . ' <span class="sc-good">- ' . $this->language->get('text_good') . '</span>' :  $this->language->get('text_off') . ' <span class="sc-alert">- ' . $this->language->get('text_req_on') . '</span>') . '</td></tr>';
         if(VERSION >= '1.5.4') {
            $data   .= '<tr><td>' . $this->language->get('sysinfo_mcrypt') . '</td><td>: ' . ((extension_loaded('mcrypt')) ? $this->language->get('text_on') . ' <span class="sc-good">- ' . $this->language->get('text_good') . '</span>' :  $this->language->get('text_off') . ' <span class="sc-alert">- ' . $this->language->get('text_req_on') . '</span>') . '</td></tr>';
         }
         $data   .= '<tr><td>' . $this->language->get('sysinfo_upload') . '</td><td>: ' . ((ini_get('file_uploads')) ? $this->language->get('text_on') . ' <span class="sc-good">- ' . $this->language->get('text_good') . '</span>' :  $this->language->get('text_off') . ' <span class="sc-alert">- ' . $this->language->get('text_req_on') . '</span>') . '</td></tr>';
         $data   .= '<tr><td>' . $this->language->get('sysinfo_cookies') . '</td><td>: ' . ((ini_get('session.use_cookies')) ? $this->language->get('text_on') . ' <span class="sc-good">- ' . $this->language->get('text_good') . '</span>' :  $this->language->get('text_off') . ' <span class="sc-alert">- ' . $this->language->get('text_req_on') . '</span>') . '</td></tr>';
         $data   .= '<tr><td>' . $this->language->get('sysinfo_gd') . '</td><td>: ' . ((extension_loaded('gd')) ? $this->language->get('text_on') . ' <span class="sc-good">- ' . $this->language->get('text_good') . '</span>' :  $this->language->get('text_off') . ' <span class="sc-alert">- ' . $this->language->get('text_req_on') . '</span>') . '</td></tr>';
         $data   .= '<tr><td>' . $this->language->get('sysinfo_curl') . '</td><td>: ' . ((extension_loaded('curl')) ? $this->language->get('text_on') . ' <span class="sc-good">- ' . $this->language->get('text_good') . '</span>' :  $this->language->get('text_off') . ' <span class="sc-alert">- ' . $this->language->get('text_req_on') . '</span>') . '</td></tr>';
         $data   .= '<tr><td>' . $this->language->get('sysinfo_fsock') . '</td><td>: ' . ((extension_loaded('sockets') || function_exists('fsockopen')) ? $this->language->get('text_on') . ' <span class="sc-good">- ' . $this->language->get('text_good') . '</span>' :  $this->language->get('text_off') . ' <span class="sc-alert">- ' . $this->language->get('text_req_on') . '</span>') . '</td></tr>';
         $data   .= '<tr><td>' . $this->language->get('sysinfo_zip') . '</td><td>: ' . ((extension_loaded('zlib')) ? $this->language->get('text_on') . ' <span class="sc-good">- ' . $this->language->get('text_good') . '</span>' :  $this->language->get('text_off') . ' <span class="sc-alert">- ' . $this->language->get('text_req_on') . '</span>') . '</td></tr>';
         $data   .= '<tr><td>' . $this->language->get('sysinfo_xml') . '</td><td>: ' . ((extension_loaded('xml')) ? $this->language->get('text_on') . ' <span class="sc-good">- ' . $this->language->get('text_good') . '</span>' :  $this->language->get('text_off') . ' <span class="sc-alert">- ' . $this->language->get('text_req_on') . '</span>') . '</td></tr>';
         $data   .= '</table>';

         $style   = '<style>';
         $style  .= '.sc-sysinfo { width:400px; border-collapse:separate; border-spacing:0; margin-bottom:20px; line-height:16px; }';
         $style  .= '.sc-sysinfo > tbody > tr:nth-child(odd) > td { background-color:#f2f2f2; }';
         $style  .= '.sc-sysinfo td { padding:6px 10px; vertical-align:top; }';
         $style  .= '.sc-sysinfo td:first-child { width:175px; }';
         $style  .= '.sc-alert { color:#d00; }';
         $style  .= '.sc-good { color:#1da00c; font-weight:bold; }';
         $style  .= '</style>';
      
         $html = '<div class="shortcode-sysinfo">' . $style . $data . '</div>';
         
         return $html;
      }
   }
   
    /**
    * Accordion Block
    * 
    * @since 1.0
    * 
    * @param array $atts Shortcode attributes
    * @param string $content Shortcode content
    * @return string Image html code
    * 
    * @example 
    */
    function accordion($atts, $content = '') {
		$html = "<ul class='yt-accordion'>";
		$html .= $this->shortcodes->do_shortcode(str_replace(array("<br/>","<br />","<p></p>"), " ", $content));
		$html .= "</ul>";

		return $html;
    }
	
	function acc_item($atts, $content = '') {
		extract($this->shortcodes->shortcode_atts(array(
			"title" => ''
		), $atts));

		$acc_item = "<li class='accordion-group'>";
		$acc_item .=  "<h3 class='accordion-heading'>";
		$acc_item .=  "<i class='fa fa-plus-square'></i><span>";
		$acc_item .=  $title . "</span></h3>";
		$acc_item .=  "<div class='accordion-inner'>" . $this->shortcodes->do_shortcode( $content) . "</div>";
		$acc_item .=  "</li>";

		return $acc_item;
    }
	
	/**
    * Tables Block
    */
	
	
	function pricing_tables($atts, $content = null ){
		global $pcolumns,$type;
		$pcolumns = 3;
		extract($this->shortcodes->shortcode_atts(array(
			"columns" 			=> '3',
			"style" 		=> '',
			"type"			=>''
		), $atts));
		$pcolumns	= $columns;
		$class 		= 'yt-pricing block col-' . $columns.' pricing-'.$style;
		return '<div class="'.$class.' row"   >' . $this->shortcodes->do_shortcode(str_replace(array("<br/>", "<br>", "<br />"), " ", $content)) . '</div>';
	}
	
	function pricing_tables_item($atts, $content = null ){
		global $pcolumns, $per,$type;

		extract($this->shortcodes->shortcode_atts(array(
			"title" 		=> '',
			"button_link" 	=> '',
			"button_label" 	=> '',
			"price" 		=> '',
			"featured" 		=> '',
			"text"			=>'Popular',
			"background"	=>'none',
			"color"			=>'inherit',
			"icon_name"		=>''
		), $atts));
		$return='';
		if($icon_name != '')
		{
			if (strpos($icon_name, 'icon:') !== false) 
			{ 
			  $icon_name = '<i class="fa fa-' . trim(str_replace('icon:', '', $icon_name)) . '"></i>';
			}
			
		}
		switch ($type) {
			case 'style1':
				$text= (strtolower($featured)=="yes" ? $text : '');
				$return = '<div class="'.$type.' column col-xs-12 col-sm-6 col-md-'.round(12/$pcolumns).' col-lg-'.round(12/$pcolumns).''.(('yes' == strtolower($featured)) ? ' featured' : '') .'">
					<div class="price-table" style="background:'.$background.'; color:'.$color.'"><span class="pricing-featured">'.$text.'</span>
					<div class="pricing-basic " style=""><h2>' .$icon_name.' '. $title . '</h2></div>' .
					'<div class="pricing-money block " style="" >' . $price . '</div>' .
					$this->shortcodes->do_shortcode(str_replace(array("<br/>", "<br>", "<br />"), " ", $content)) .
					'<div class="pricing-bottom">
					<a class="btn btn-default" href="'.$button_link.'">'.$button_label.'</a>
					</div> </div> ' .
				 '</div>';
				break;

			default:
			case 'style2':
			
				$text= (strtolower($featured)=="yes" ? $text : '');
				$return = '<div class="'.$type.' column col-xs-12 col-sm-6 col-md-'.round(12/$pcolumns).' col-lg-'.round(12/$pcolumns).''.(('true' == strtolower($featured)) ? ' featured' : '') .'">
					<div class="price-table" ><div class="pricing-basic " style="background:'.$background.'; color:'.$color.'"><h2>' .$icon_name.' '. $title . '</h2><span class="pricing-featured">'.$text.'</span></div>' .
					$this->shortcodes->do_shortcode(str_replace(array("<br/>", "<br>", "<br />"), " ", $content)) .
					'<div class="pricing-money block ">' . $price . '</div>' .
					'<div class="pricing-bottom" >
					<a class="signup" style="background:'.$background.';color:'.$color.'" href="'.$button_link.'">'.$button_label.'</a>
					</div></div> ' .
				 '</div>';
				break;
			case 'style3':
				$text= (strtolower($featured)=="yes" ? $text : '');
				$return = '<div class="'.$type.' column col-xs-12 col-sm-6 col-md-'.round(12/$pcolumns).' col-lg-'.round(12/$pcolumns).''.(('true' == strtolower($featured)) ? ' featured' : '') .'">
					<div class="price-table" ><div class="pricing-basic " style="background:'.$background.'; color:'.$color.'"><h2>' .$icon_name.' '. $title . '</h2><span class="pricing-featured">'.$text.'</span></div>' .
					'<div class="pricing-money block " style="background:'.$background.'; color:'.$color.'"><h1>' . $price . '</h1></div>'.
					$this->shortcodes->do_shortcode(str_replace(array("<br/>", "<br>", "<br />"), " ", $content))  .
					'<div class="pricing-bottom" >
					<a class="signup" style="background:'.$background.'; color:'.$color.'" href="'.$button_link.'">'.$button_label.'</a>
				</div></div> ' .
				'</div>';

		}
		
		return $return;
	}
	
	/**
	*	Content Slider
	*/
	function content_slider($atts,$content = null)
	{
		global $index_carousel,$carousel_count;
		extract($this->shortcodes->shortcode_atts(array(
		'item_lg'            => 1,
		'item_sm'            => 1,
		'item_xs'            => 1,
		'style'          => 'default',
		'arrows'         => 'yes',
		'arrow_position' => 'arrow-default',
		'pagination'     => 'yes',
		'autoplay'       => 'no',
		'autoheight'     => 'no',
		'delay'          => 4,
		'speed'          => 0.6,
		'hoverpause'     => 'no',
		'lazyload'       => 'no',
		'loop'           => 'no',
		'margin'         => 0,
		'class'          => ''
		), $atts));
		$id = uniqid('ytcs').rand().time();
		
		$script_load = "
		<script type='text/javascript'>
            $(document).ready(function() {
                 $('#".$id."').each(function () {
					var slider = $(this),
						panels = slider.children('div'),
						data = slider.data();
					
						// Remove unwanted br's
						slider.children(':not(.yt-content-slide)').remove();
						// Apply Owl Carousel
						slider.owlCarousel2({
						mouseDrag: true,
						video:true,
						lazyLoad: (data.lazyload == 'yes') ? true : false,
						autoplay: (data.autoplay == 'yes') ? true : false,
						autoHeight: (data.autoheight == 'yes') ? true : false,
						autoplayTimeout: data.delay * 1000,
						smartSpeed: data.speed * 1000,
						autoplayHoverPause: (data.hoverpause == 'yes') ? true : false,
						center: (data.center == 'yes') ? true : false,
						loop: (data.loop == 'yes') ? true : false,
						dots: (data.pagination == 'yes') ? true : false,
						nav: (data.arrows == 'yes') ? true : false,
						margin: data.margin,	
						navText: ['',''],
						responsive:{
							0:{items:data.item_xs},
							768:{items:data.item_sm},
							992:{items: data.item_lg}
						},
					});
					
				});
            });
        </script> ";
		
		return '<div id="'. $id .'" class="yt-content-slider owl-theme yt-content-slider-style-1 '. $arrow_position.'" data-autoplay="' . $autoplay .'" data-autoheight="' . $autoheight .'" data-delay="' . $delay . '" data-speed="' . $speed . '" data-margin="' . $margin . '" data-item_lg="' . $item_lg . '" data-item_sm="' . $item_sm . '" data-item_xs="' . $item_xs . '" data-arrows="' . $arrows .'" data-pagination="' . $pagination . '" data-lazyload="' . $lazyload . '" data-loop="' . $loop . '" data-hoverpause="' . $hoverpause . '">' . $this->shortcodes->do_shortcode(str_replace(array("<br/>", "<br>", "<br />"), " ", $content)) . '</div>' .$script_load ;
	}
	
	function content_slider_item($atts, $content = null){
		global $carousel_count ;
		extract($this->shortcodes->shortcode_atts(array(
		'class' => '',
		'src' =>'',
		'caption' => 'no'
		), $atts));
		
		$image = ($src !='') ? '<img src='.JURI::base().$src.' alt='.uniqid("title_").rand().time().'>' : '';
		if($caption == "yes")
		{
			return '<div class="yt-content-slide yt-clearfix yt-content-wrap' . $class . '"> '.$image.' <p class="caption">'.$this->shortcodes->do_shortcode(str_replace(array("<br/>", "<br>", "<br />"), " ", $content)).'</p></div>';
		}
		else{
			return '<div class="yt-content-slide yt-clearfix yt-content-wrap' . $class . '"> '.$image.' '.$this->shortcodes->do_shortcode(str_replace(array("<br/>", "<br>", "<br />"), " ", $content)).'</div>';
		}
	}
	
	/**
	*	Shortcode Gallery
	*/
	function gallery($atts,$content = null)
	{
		global $gwidth, $gheight, $gcolumns, $galleryArray, $padding_item,$id_uniq,$hover_gallery;
		$gwidth  = 100;
		$gheight = 100;
		
		extract($this->shortcodes->shortcode_atts(array(
		"title"        => '',
		"width"        => 100,
		"height"       => 100,
		"columns"      => 3,
		"align"        => 'center',
		), $atts));
		
		
		
		$id_uniq = uniqid("yt").rand().time();
		$gwidth  = $width;
		$gheight = $height;
		$gcolumns = $columns;

		$gallery = '';
		$galleryArray = array();
		$this->shortcodes->do_shortcode($content);
		$tags = array();
		$tags = '';
		foreach ($galleryArray as $key=>$item) $tags .= ',' . strtolower($item['tag']);
			$tags = ltrim($tags, ',');
			$tags = explode(',', $tags);
			$newtags = array();
			foreach($tags as $tag) $newtags[] = trim($tag);
			$tags = array_values(array_unique($newtags));
			if($align !='')
			$align = 'pull-'.$align;
			else
			$align ='';
			$gallery .= '<div class="yt-gallery clearfix '.$align.'" style="margin:0 auto">';
				$gallery.='<div class = "yt-gallery-tabbed" style="display:table; margin-bottom:10px;">';
				$gallery.='<ul class="tabnav">';

					$gallery.='<li class="showall active '.$id_uniq.'"><span >Show all</span></li>';
					foreach($tags as $tag )
					{
						$gallery.='<li id='.trim($tag).$id_uniq.' class="'.$id_uniq.'"><span>'.ucfirst(trim($tag)).'</span></li>';
					}
				$gallery.='</ul>';
				$gallery.='</div>';
				$gallery .= '<ul class="gallery-list clearfix">' . $this->shortcodes->do_shortcode(str_replace(array("<br/>", "<br>", "<br />","<p>", "</p>"), " ", $content)) . '</ul>';
				$gallery .= '</div>';
				$gallery .= '<script>
					var width = jQuery(window).width();
					if(width > 992)
					{
						jQuery(".masonry-brick").css("width","'.floor(100/$gcolumns).'%");
					}else if(width >=768 && width <=992)
					{
						jQuery(".masonry-brick").css("width","33%");
					}else
					{
						jQuery(".masonry-brick").css("width","100%");
					}
					
					window.onresize = function(event) {
						var width = jQuery(window).width();
						if(width > 992)
						{
							jQuery(".masonry-brick").css("width","'.floor(100/$gcolumns).'%");
						}else if(width >=768 && width <=992)
						{
							jQuery(".masonry-brick").css("width","33%");
						}else
						{
							jQuery(".masonry-brick").css("width","100%");
						}

					};

				</script>';
		return $gallery;
	}
	
	function gallery_item($atts, $content = null){
		global $gwidth, $gheight, $gcolumns,$galleryArray,$padding_item,$id_uniq,$hover_gallery ;
		$galleryArray[] = array(
			'src'     =>(isset($atts['src'])?$atts['src']:''),
			'tag'     =>(isset($atts['tag']) && $atts['tag'] !='')?$atts['tag']:'',
			'content' =>$content
		);
		extract($this->shortcodes->shortcode_atts(array(
			"title"      => '',
			"src"        => '',
			"video_addr" => '',
			"tag"        =>'',
			'cache'     => 1
		), $atts));
		
		
	
		$src_resize    = 'image/' . $src;
		if (is_file(DIR_IMAGE . $src)) {
			 if ($cache) {
				$this->load->model('tool/image');
				$simage  = $this->model_tool_image->resize($src, $gwidth, $gheight);
			 } else {
				$simage  = $src;
			 }
		}
		
		$gallery_item='';
			
		$gallery_item .= "<li class='".$id_uniq." masonry-brick ".strtolower(str_replace(","," ",$tag)).$id_uniq."' ";
		
		$gallery_item .=">";
		$gallery_item .="<div class='item-gallery' >";
		$gallery_item .= "<a title='" . $title . "' href='" . $src_resize . "' data-rel='prettyPhoto[bkpGallery]'>";

		$gallery_item .= "<h3 class='item-gallery-title  '>". $this->shortcodes->do_shortcode(str_replace(array("<br/>", "<br>", "<br />"), " ", $content)) ."</h3>";
		$gallery_item .= "<img src='" .$simage."' title='" . $title . "' alt='" . $title . "' />";
		$gallery_item .= "</a>";
		$gallery_item .= "</div>";
		$gallery_item .= "</li>";
		return str_replace("<br/>", " ", $gallery_item);
	}
}