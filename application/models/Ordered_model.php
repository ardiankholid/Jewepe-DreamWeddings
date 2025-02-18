<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordered_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_ordered()
    {
        $this->db->select('*');
        $this->db->from('tb_order tbo');
        $this->db->join('tb_catalogues tbc', 'tbc.catalogue_id = tbo.catalogue_id');
        $this->db->order_by("tbc.updated_at", "DESC");
        $query = $this->db->get();
        return $query;
    }

    public function get_all_report()
    {
        $this->db->select('order_id, tbo.catalogue_id,image,package_name,price,status_publish,Count(*) As jumlah_pesanan');
        $this->db->from('tb_order tbo');
        $this->db->join('tb_catalogues tbc', 'tbc.catalogue_id = tbo.catalogue_id');
        $this->db->group_by('tbo.catalogue_id');
        $this->db->order_by("tbo.updated_at", "DESC");
        $query = $this->db->get();
        return $query;
    }

    public function get_count_ordered($status)
    {
        $this->db->select('*');
        $this->db->from('tb_order tbo');
        $this->db->join('tb_catalogues tbc', 'tbc.catalogue_id = tbo.catalogue_id');
        if($status!='all'){
            $this->db->where('tbo.status', $status);
        }
        $query = $this->db->get();
        return $query;
    }

    public function cek_data_ordered($id, $email, $wedding_date)
    {
        $this->db->select('*');
        $this->db->from('tb_order tbo');
        $this->db->join('tb_catalogues tbc', 'tbc.catalogue_id = tbo.catalogue_id');
        $this->db->where('tbo.catalogue_id', $id);
        $this->db->where('tbo.email', $email);
        $this->db->where('tbo.wedding_date', $wedding_date);
        $this->db->order_by("tbo.updated_at", "DESC");
        $query = $this->db->get();
        return $query;
    }

    public function get_ordered_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('tb_order tbo');
        $this->db->join('tb_catalogues tbc', 'tbc.catalogue_id = tbo.catalogue_id');
        $this->db->where('tbo.order_id', $id);
        $query = $this->db->get();
        return $query;
    }

    public function insert($data)
    {
        return $this->db->insert('tb_order', $data);
    }

    public function update ($id, $data) 
    {
        $this->db->where('order_id', $id);
        $query = $this->db->update('tb_order', $data);
        return $query;
    }

    public function delete_by_id($id)
    {
        $this->db->where('order_id', $id);
        return $this->db->delete('tb_order');
    }
    public function cek_data_ordered_by_name_and_email($name, $email)
    {
    $this->db->select('tbo.order_id, tbc.package_name, tbo.status');
    $this->db->from('tb_order tbo');
    $this->db->join('tb_catalogues tbc', 'tbc.catalogue_id = tbo.catalogue_id');
    $this->db->where('tbo.name', $name);
    $this->db->where('tbo.email', $email);
    $query = $this->db->get();
    return $query;
    }
}