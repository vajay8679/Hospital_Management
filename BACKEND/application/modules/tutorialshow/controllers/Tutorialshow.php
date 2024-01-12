<?php
defined('BASEPATH') or exit('No direct script access allowed');

class tutorialshow extends Common_Controller
{
    public $data = array();
    public $file_data = "";
    // public $_table = CMS;
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @method index
     * @description listing display
     * @return array
     */
    public function index()
    {

        $option = array(
            'table' => 'tutorial',
            'select' => 'tutorial.id,tutorial.tutorial,tutorial.description,tutorial.created_date,cat.category_name',
            'join' => array('tutorial_category as cat' => 'cat.id=tutorial.category_id'),
            'where' => array('delete_status' => 0)
        );
        $this->data['list'] = $this->common_model->customGet($option);
        $this->load->admin_render('tutorialshow', $this->data);
    }
    public function show()
    {
        $this->data['parent'] = $this->title;
        $this->data['title'] = "File " . $this->title;
        $id = ($_GET['tutorial_id']);

        if (!empty($id)) {

            $option = "SELECT *
            FROM `vendor_sale_tutorial_file` 
            WHERE  `vendor_sale_tutorial_file`.`tutorial_id` = $id
            ORDER BY `vendor_sale_tutorial_file`.`created_date` DESC";

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
