<?php

class Car extends MX_Controller {
    function index()
    {
        $this->load->model('Car_model');
        // $assignments_by_empid = $this->Car_model->getAssignmentArray();
        // print_r($assignments_by_empid);
        // exit();
        $rows = $this->Car_model->all();
        $data['rows'] = $rows;

        $this->load->view('list', $data);
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
            $id = $this->Car_model->create($formArray);

            $row = $this->Car_model->getRow($id);
            $vData['row'] = $row;
            $rowHtml = $this->load->view('car/car_row',$vData,true);
            $response['row'] = $rowHtml;

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

    function getCarModel($id)
    {
        $this->load->model('Car_model');
        $row = $this->Car_model->getRow($id);
        $data['row'] = $row;
        
        $html = $this->load->view('editform',$data,true);
        $response['html'] = $html;
        echo json_encode($response);
    }

    function updateModel()
    {
        $this->load->model('Car_model');
        $id = $this->input->post('id');
        $row = $this->Car_model->getRow($id);
        if (empty($row))
        {
            $response['msg'] = 'Either record deleted or not found in database';
            $response['status'] = 100;
            echo json_encode($response);
            exit;
        }

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
            $formArray['updated_at'] = date('Y-m-d H:i:s');
            $id = $this->Car_model->update($id, $formArray);

            $row = $this->Car_model->getRow($id);

            $response['row'] = $row;
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

    function deleteModel($id)
    {
        try{
            $this->load->model('Car_model');
            $row = $this->Car_model->getRow($id);
            if (empty($row))
            {
                throw new Exception('Either record deleted or not found in database');
            }
            else
            {
                $this->Car_model->delete($id);
                $response['msg'] = 'Record has been deleted successfully';
                $response['status'] = 1;
                
            }
        }catch(Exception $e){
            $response['msg'] = $e->getMessage();
            $response['status'] = 0;
        }
        
        echo json_encode($response);
    }
}
?>