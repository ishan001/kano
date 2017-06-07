<?php
/**
 * @package     OpenCart Shortcodes
 * @author      EchoThemes, http://www.echothemes.com
 * @copyright   Copyright (c) 2016 EchoThemes
 * @license     GPLv3 or later, http://www.gnu.org/licenses/gpl-3.0.html
 */

if (!defined('DIR_APPLICATION')) exit('No direct script access allowed');

class ShortcodesTheme extends Controller
{
    /**
     * Get theme info
     *
     * [themeinfo /]
     */
    function themeinfo()
    {
        return 'This store use <b>' . $this->config->get('config_theme') . '</b> theme.';
    }
}