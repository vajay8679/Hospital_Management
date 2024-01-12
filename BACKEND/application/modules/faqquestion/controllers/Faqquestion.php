<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class faqquestion extends Common_Controller { 
    public $data = array();
    public $file_data = "";
   // public $_table = CMS;
    public function __construct() {
        parent::__construct();
    }
    
     /**
     * @method index
     * @description listing display
     * @return array
     */
    public function index() {

        $option = array(
            'table' => 'faq',
            'select' => 'faq.id,faq.question,faq.answer,faq.created_date,cat.category_name',
            'join' => array('faq_category as cat' => 'cat.id=faq.category_id'),
            'where' => array('delete_status' => 0)
        );

        $this->data['list'] = $this->common_model->customGet($option);

        // echo"<pre>"; print_r($this->data); die('');
        // $this->load->admin_render('list', $this->data);
        $this->load->admin_render('faqquestions',$this->data);
    }

    public function show()
    {
        $this->data['parent'] = $this->title;
        $this->data['title'] = "File " . $this->title;
        $id = ($_GET['faq_id']);

        if (!empty($id)) {

            $option = "SELECT *
            FROM `vendor_sale_faq_file` 
            WHERE  `vendor_sale_faq_file`.`faq_id` = $id
            ORDER BY `vendor_sale_faq_file`.`created_date` DESC";
            
            $results_row = $this->common_model->customQuery($option);

            // echo"<pre>"; print_r($results_row); die;
            if (!empty($results_row)) {
                $this->data['results'] = $results_row;
                $this->load->admin_render('view_files', $this->data);
            } else {
                $this->session->set_flashdata('error', 'File does not exist');
                redirect($this->router->fetch_class());
            }
        } else {
            $this->session->set_flashdata('error',  'File does not exist');
            redirect($this->router->fetch_class());
        }
    }
    
}
