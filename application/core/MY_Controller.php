<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014-2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	CodeIgniter Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014-2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * core/MY_Controller.php
 *
 * Default application controller
 *
 */
class Application extends CI_Controller {
    protected $data = array();      // parameters for view components
    protected $id;                  // identifier for our content
    /**
     * Constructor.
     * Establish view parameters & set a couple up
     */
    function __construct()
    {
        parent::__construct();
        $this->data = array();
        $this->data['page_title'] = 'CodeIgniter Web Framework';
        $this->data['page_description'] = 'CodeIgniter Web Framework';
        $this->data['page_keywords'] = 'codeIgniter,web,framework';
        $this->data['page_author'] = 'Komsan Nurak';
        $this->data['theme_name'] = 'default';
        $this->errors = array();
    }
    /**
     * Render this page
     */
    function render($route = 'common/welcome_message')
    {
        if (!isset($this->data['meta']['title']))
            $this->data['meta']['title'] = $this->data['page_title'];

        if (!isset($this->data['meta']['description']))
            $this->data['meta']['description'] = $this->data['page_description'];

        if (!isset($this->data['meta']['keywords']))
            $this->data['meta']['keywords'] = $this->data['page_keywords'];

        if (!isset($this->data['meta']['author']))
            $this->data['meta']['author'] = $this->data['page_author'];

        if (!isset($this->data['theme']['name']))
            $this->data['theme']['name'] = $this->data['theme_name'];

        $config_theme = array(
            'theme' => $this->data['theme']['name'],
            'directory' => 'view/'.$this->config->item('theme').'/',
            'filename' => $route,
            'layout' => false
        );

        $views = array(
            'data' => $this->data,
            'theme_info' => $config_theme
        );

        // load view
        $this->load->view($config_theme['theme'].'/common/header', $views);
        $this->load->view($config_theme['theme'].'/'.$route, $views);
        $this->load->view($config_theme['theme'].'/common/footer', $views);

        /*
        // Massage the menubar
        $choices = $this->config->item('menu_choices');
        foreach ($choices['menudata'] as &$menuitem)
        {
            $menuitem['active'] = (ltrim($menuitem['link'], '/ ') == uri_string()) ? 'active' : '';
        }
        $this->data['menubar'] = $this->parser->parse('theme/menubar', $choices, true);
        $this->data['footerbar'] = $this->parser->parse('theme/menubar', $this->config->item('footer_choices'), true);
        $this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);
        // title for all but the homepage
        $layout = empty($this->data['title']) ? 'jumbotitle' : 'title';
        $this->data['titleblock'] = $this->parser->parse('theme/' . $layout, $this->data, true);
        // finally, build the browser page!
        $this->data['data'] = &$this->data;
        $this->parser->parse('theme/template', $this->data);*/
    }
}