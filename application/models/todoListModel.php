<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class todoListModel extends CI_Model
{
    public function getList()
    {
        $query = $this->db->query('SELECT * FROM lists');
        return $query->result();
    }
    public function getOne($where)
    {
        $query = $this->db->get_where("lists", $where);
        return $query->result();
    }
    public function searchTitle($title)
    {
        $query = $this->db->get_where("lists", array("listName" => $title));
        return $query->result();
    }
    public function search($search)
    {
        $this->db->select('*');
        $this->db->from('lists');
		$this->db->like('listName', $search);
		$this->db->or_like('listDate', $search);
		$this->db->or_like('listContent', $search);

        $query = $this->db->get();
        return $query->result();
    }
    public function insert($data = array())
    {
        $query = $this->db->insert("lists",$data);
        return $query; 
    }
    public function update($listName,$listDate,$listContent,$listStress,$listKeywords,$where = array())
    {
        $this->db->set('listName', $listName);
        $this->db->set('listDate', $listDate);
        $this->db->set('listContent', $listContent);
        $this->db->set('listStress', $listStress);
        $this->db->set('listKeywords', $listKeywords);
        $this->db->where($where);
        $query = $this->db->update("lists");
        return $query; 
    }
    public function delete($where)
    {
        $this->db->where($where);
        $query = $this->db->delete('lists');
        return $query;
    }

}