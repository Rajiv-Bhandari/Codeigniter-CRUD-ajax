<?php

class Admin extends MX_Controller {
    public function index()
    {
       
        $this->load->model('Admin_model');
        $employee = $this->Admin_model->all();
        $data = array();
        $data['employee'] = $employee;
        $this->load->view('adminhom',$data);   
    }

    public function create()
    {
        $this->load->model('Admin_model');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('dob', 'Date', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');

        if($this->form_validation->run() == false)
        {
            $response = array(
                'status' => 'error',
                'message' => validation_errors()
            );
        }
        else
        {
            $formArray = array();
            $formArray['name'] = $this->input->post('name');
            $formArray['email'] = $this->input->post('email');
            $formArray['dob'] =  $this->input->post('dob');
            $formArray['address'] = $this->input->post('address');

            $this->Admin_model->create($formArray);
            $this->session->set_flashdata('success','Employee Record Added Successfully');
        }
    }

    public function edit($userId)
    {   
        $this->load->model('Admin_model');
        $employee = $this->Admin_model->getUser($userId);
        $data = array();
        $data['employee'] = $employee;

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('dob', 'Date', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        
        if($this->form_validation->run() == false)
        {
            echo json_encode($data);
        }
        else{
            $formArray = array();

            $this->Admin_model->updateUser($userId,$formArray);
            $this->session->set_flashdata('success','Record Updated Successfully');
        
        }
    }

    public function get_user_data($userId)
    {
        $this->load->model('Admin_model');
        $userData = $this->Admin_model->getUser($userId);
        if ($userData) {
            echo json_encode($userData);
        } else {
            http_response_code(404);
        }
    }
    
    public function delete($userId)
    {
        try{
            throw new Exception("User Not found!");
            if (empty($userId))
            {  
                var_dump($userId);
                 
                
            }
            else{
                var_dump($userId);
                $this->load->model('Admin_model');
                $user = $this->Admin_model->getUser($userId);
                echo json_encode(array('status' => 'success'));
            }
            
        }
       catch (Exception $e){
            var_dump($e->getMessage());
            $response['msg'] = 'Either record deleted or not found in database';
            $response['status'] = 0;
       }
   




    }
}
