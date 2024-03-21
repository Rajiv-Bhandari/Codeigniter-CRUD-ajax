<?php

class Car extends MX_Controller {
    function index()
    {
        $this->load->view('list');
    }

    function showCreateForm()
    {
        $html = $this->load->view('createform','',true);
        $response['html'] = $html;
        echo json_encode($response);
    }

    function saveModel()
    {
        $this->load->model('Car_model');
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('color', 'Color', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');

        if($this->form_validation->run() == true)
        {
            $formArray = array();
            $formArray['name'] = $this->input->post('name');
            $formArray['color'] = $this->input->post('color');
            $formArray['transmission'] = $this->input->post('transmission');
            $formArray['price'] = $this->input->post('price');
            $formArray['created_at'] = date('Y-m-d H:i:s');

            $this->Car_model->create($formArray);
            $response['status'] = 1;
        }
        else
        {
            $response['status'] = 0;
            $response['name'] = strip_tags(form_error('name'));
            $response['color'] = strip_tags(form_error('color'));
            $response['price'] = strip_tags(form_error('price'));
        }
        echo json_encode($response);
    }
}
?>