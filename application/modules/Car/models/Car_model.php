<?php

Class Car_model extends CI_model{

    public function create($formArray)
    {
        $this->db->insert('car_models', $formArray);
    }
}


?>