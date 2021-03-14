<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Template
{
    protected $_ci;

    function __construct()
    {
        $this->_ci = &get_instance();
    }

    function render_page($content, $data = NULL)
    {
       
        
        $this->_ci->load->view('templates/header', $data);
        $this->_ci->load->view('templates/sidebar', $data);
        $this->_ci->load->view('templates/topbar', $data);
        $this->_ci->load->view($content, $data);
        $this->_ci->load->view('templates/footer', $data);
    }

    function front_page($content, $data = NULL)
    {
       
        
        $this->_ci->load->view('frontend/template/header', $data);
        $this->_ci->load->view('frontend/template/topbar', $data);
        $this->_ci->load->view('frontend/template/navbar', $data);
        $this->_ci->load->view($content, $data);
        $this->_ci->load->view('frontend/template/footer', $data);
    }
}
