<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tutorials extends Common_Controller
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
        $this->data['parent'] = "Tutorials";
        $this->data['title'] = "Tutorials";
        $this->data['model'] = "tutorials";


        $option = array(
            'table' => 'tutorial',
            'select' => 'tutorial.id,tutorial.tutorial,tutorial.description,tutorial.created_date,cat.category_name',
            'join' => array('tutorial_category as cat' => 'cat.id=tutorial.category_id'),
            'where' => array('delete_status' => 0)
        );

        $this->data['list'] = $this->common_model->customGet($option);
        usort($this->data['list'], function($a, $b) {
            return strtotime($b->created_date) - strtotime($a->created_date);
        });
        $this->load->admin_render('list', $this->data, 'inner_script');
    }

    /**
     * @method open_model
     * @description load model box
     * @return array
     */

    function open_model()
    {
        $this->data['title'] = 'Add Tutorials';

        $option = array(
            'table' => 'tutorial_category',
            'select' => '*',
        );

        $this->data['category'] = $this->common_model->customGet($option);

        $this->load->view('add', $this->data);
    }

    function open_category_model()
    {
        $this->data['title'] = 'Add Category';

        $option = array(
            'table' => 'tutorial_category',
            'select' => '*',
        );

        $this->data['category'] = $this->common_model->customGet($option);


        $this->load->view('add_category', $this->data);
    }

    /**
     * @method cms_add
     * @description add dynamic rows
     * @return array
     */
  public function tutorial_add()
    {
        // echo"<pre>"; print_r($this->input->post()); die;
        // die('hh');
        $maxFileSize = 100 * 1024 * 1024;

        $this->form_validation->set_rules('category_id', 'Category Id', 'required|trim');
        $this->form_validation->set_rules('tutorial', 'Tutorial', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');

        if (empty($_FILES['image_name']['name'][0]) && empty($_FILES['image_name']['tmp_name'][0])) {
            $this->form_validation->set_rules('image_name', 'File attachment', 'required', array('required' => 'The file field is required'));
        }

        if ($this->form_validation->run() == true) {

            $options_data = array(
                'category_id'    => $this->input->post('category_id'),
                'tutorial'       => $this->input->post('tutorial'),
                'description'         => $this->input->post('description'),
                'created_date'   => datetime()
            );

            $this->db->trans_start(); // Start a transaction
            $this->db->insert('tutorial', $options_data);

            $inserted_id = $this->db->insert_id();
            $uploaded_images = [];
            if ($inserted_id) {
                $total_count = count($_FILES['image_name']['name']);
                
                for ($i = 0; $i < $total_count; $i++) {
                    $tmpFilePath = $_FILES['image_name']['tmp_name'][$i];
                    $fileSize = $_FILES['image_name']['size'][$i];

                    if ($tmpFilePath != "" && $fileSize <= $maxFileSize) {
                        $originalFileName = $_FILES['image_name']['name'][$i];
                        $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);

                        // Generate a unique file name using a timestamp and random number
                        $uniqueFileName = time() . '_' . mt_rand(1000, 9999) . '.' . $fileExtension;

                        $newFilePath = "uploads/file/" . $uniqueFileName;
                        if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                            $uploaded_images[] = $newFilePath;
                            $options_data1 = array(
                                'file'           => $newFilePath,
                                'tutorial_id'         => $inserted_id,
                                'created_date'   => date('Y-m-d H:i:s'),
                                'delete_status'  =>  0
                            );
                            $this->db->insert('tutorial_file', $options_data1);
                        }
                    } else {
                        $response = array('status' => 0, 'message' => 'One or more files exceed the maximum size limit (100MB).');
                        echo json_encode($response);
                        return;
                    }
                }
                $this->db->trans_complete(); // Complete the transaction
                if ($this->db->trans_status() === FALSE) {
                    // If any query within the transaction failed, return error
                    $response = array('status' => 0, 'message' => 'Error occurred during insertion.');
                } else {
                    // Check if all inserts were successful
                    if ($inserted_id && count($uploaded_images) === $total_count) {
                        $response = array('status' => 1, 'message' => 'Tutorial successfully added', 'url' => base_url('tutorial'));
                    } else {
                        $response = array('status' => 0, 'message' => 'Tutorial failed to be added');
                    }
                }
            } else {
                $response = array('status' => 0, 'message' => 'Something went wrong!.');
            }
        } else {
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
        }
        echo json_encode($response);


        // if ($this->form_validation->run() == true) {


        //     $options_data = array(

        //         'category_id'    => $this->input->post('category_id'),
        //         'tutorial'       => $this->input->post('tutorial'),
        //         'description'         => $this->input->post('description'),
        //         'created_date'   => datetime()
        //     );

        //     $option = array('table' => 'tutorial', 'data' => $options_data);
        //     if ($this->common_model->customInsert($option)) {
        //         $response = array('status' => 1, 'message' => 'Tutorial successfully added', 'url' => base_url('tutorial'));
        //     } else {
        //         $response = array('status' => 0, 'message' => 'Tutorial failed to added');
        //     }
        // } else {
        //     $messages = (validation_errors()) ? validation_errors() : '';
        //     $response = array('status' => 0, 'message' => $messages);
        // }
        // echo json_encode($response);
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

            if (!empty($results_row)) {
                $this->data['results'] = $results_row;
                $this->load->admin_render('view_files', $this->data, 'inner_script');
            } else {
                $this->session->set_flashdata('error', lang('not_found'));
                redirect($this->router->fetch_class());
            }
        } else {
            $this->session->set_flashdata('error', lang('not_found'));
            redirect($this->router->fetch_class());
        }
    }
    /**
     * @method category_add
     * @description add dynamic rows
     * @return array
     */
    public function category_add()
    {
        // die('jjj');
        $this->form_validation->set_rules('category_name', 'Category Name', 'required|trim');


        if ($this->form_validation->run() == true) {


            $options_data = array(

                'category_name'    => $this->input->post('category_name'),
                'created_date'    => datetime()
            );

            $option = array('table' => 'tutorial_category', 'data' => $options_data);
            if ($this->common_model->customInsert($option)) {


                $response = array('status' => 1, 'message' => 'Category successfully added', 'url' => base_url('tutorials'));
            } else {
                $response = array('status' => 0, 'message' => 'Category failed to added');
            }
        } else {
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
        }
        echo json_encode($response);
    }

    /**
     * @method cms_edit
     * @description edit dynamic rows
     * @return array
     */
    public function tutorial_edit()
    {
        $this->data['title'] = 'Edit Tutorial';
        $id = decoding($this->input->post('id'));
        if (!empty($id)) {

            $option = array(
                'table' => 'tutorial',
                'where' => array('id' => $id),
                'single' => true
            );
            $results_row = $this->common_model->customGet($option);

            $option = array(
                'table' => 'tutorial_category',
                'select' => '*',
            );

            $this->data['category'] = $this->common_model->customGet($option);

            if (!empty($results_row)) {
                $this->data['results'] = $results_row;
                $this->load->view('edit', $this->data);
            } else {
                $this->session->set_flashdata('error', lang('not_found'));
                redirect('tutorials');
            }
        } else {
            $this->session->set_flashdata('error', lang('not_found'));
            redirect('tutorials');
        }
    }

    /**
     * @method cms_update
     * @description update dynamic rows
     * @return array
     */
    public function tutorial_update()
    {
        $this->form_validation->set_rules('tutorial', 'Tutorial', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');

        $where_id = $this->input->post('id');
        if ($this->form_validation->run() == FALSE) :
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
        else :

            $options_data = array(
                'category_id' => $this->input->post('category_id'),
                'tutorial' => $this->input->post('tutorial'),
                'description' => $this->input->post('description'),
            );
            $option = array(
                'table' => 'tutorial',
                'data' => $options_data,
                'where' => array('id' => $where_id)
            );
            $update = $this->common_model->customUpdate($option);
            $response = array('status' => 1, 'message' => 'Tutorial updated successfully', 'url' => base_url('index.php/tutorials'));

        endif;

        echo json_encode($response);
    }
}
