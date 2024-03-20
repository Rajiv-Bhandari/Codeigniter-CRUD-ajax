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
}
?>