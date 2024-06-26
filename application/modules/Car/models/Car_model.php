<?php

Class Car_model extends CI_model{

    public function create($formArray)
    {
        $this->db->insert('car_models', $formArray);
        return $id = $this->db->insert_id();
    }

    public function all()
    {
        $result = $this->db
                    ->order_by('id','ASC')
                    ->get('car_models')
                    ->result_array();
        return $result;
    }

    function getRow($id)
    {
        $this->db->where('id',$id);
        $row = $this->db->get('car_models')->row_array();
        return $row;
    }

    function update($id, $formArray)
    {
        $this->db->where('id', $id);
        $this->db->update('car_models', $formArray);
        return $id;
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('car_models');
    }

    public function getAssignmentArray()
    {
        $assignments = $this->db->get('assignment')->result_array();
        $assignment_array = array();
    
        foreach ($assignments as $assignment) {
            $empid = $assignment['empid'];
            if (!isset($assignment_array[$empid])) {
                $assignment_array[$empid] = array();
            }
            $assignment_array[$empid][] = $assignment;
        }
    
        return $assignment_array;
    }    
}
?>