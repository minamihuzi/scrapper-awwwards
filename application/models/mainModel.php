<?php 
class mainModel extends CI_Model {

	private $tb = '';

    function __construct(){
		parent::__construct();		
    }
    
    public function setTb($tb) {
        $this->tb = $tb;
    }

    public function update($data, $id) {
        try{
            if($id == 0) {
                $this->db->insert($this->tb, $data);
            } else {
                $this->db->where('id', $id);
                $this->db->update($this->tb, $data);
            }
            return 1;
        } catch(Exception $e) {
            return 0;
        }
    }

    public function get_list() {
        $this->db->select('*');
        $this->db->from($this->tb);
        $this->db->order_by('s_date', 'desc');
        $query = $this->db->get();
        $result = $query->result();
        if($result){
            $this->addCountOfDomains($result);
            return $result;
        }
        return null;
    }

    public function get($id) {
        $this->db->select('*');
        $this->db->from($this->tb);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result = $query->result();
        if($result){
            $this->addCountOfDomains($result);
            return $result[0];
        }            
        return null;
    }

    public function delete($ids) {
        if($ids) {
            $id = explode(',', $ids);
            $this->db->where_in('id', $id);
            $this->db->delete($this->tb);
        }
        return 1;
    }

    private function addCountOfDomains(&$result) {
        foreach($result as &$row) {
            $domains = $row->domains;
            $tmps = explode(PHP_EOL, $domains);
            $row->count_of_domains = sizeof($tmps);
        }
    }

    public function update_status($id) {
        try{
            $data = array('status'=>1);                
            $this->db->where('id', $id);
            $this->db->update($this->tb, $data);
            return 1;
        } catch(Exception $e) {
            return 0;
        }        
    }

}