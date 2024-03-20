<?php 

class Admin_model extends CI_model {
    
    public function all()
    {
       return $employee = $this->db->get('employee')->result_array();
    }

    public function create($formArray)
    {
        $this->db->insert('employee',$formArray);
    }

    public function getUser($userId)
    {
        $this->db->where('id', $userId);
        return $user = $this->db->get('employee')->row_array();
    }

    public function deleteUser($userId)
    {
        $this->db->where('id',$userId);
        $this->db->delete('employee');
    }
}
?>
