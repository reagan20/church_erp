<?php
class Super_model extends CI_Model{
    public function create_account($data){
        $qry=$this->db->insert('church_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function countMembers()//counting members
    {   $this->db->select('*');
        $this->db->where('status=','Active');
        $qry=$this->db->get('members_tbl');
        return $qry->num_rows();
        //return $this->db->count_all("");
    }
    public function countActiveSubscription()
    {
        $today=date('Y-m-d');
        $this->db->select('*');
        $this->db->where('expiry >=',$today);
        //$this->db->where('status=','Active');
        $qry=$this->db->get('church_tbl');
        return $qry->num_rows();
        //return $this->db->count_all("");
    }
    public function countInactiveSubscription()
    {
        $today=date('Y-m-d');
        $this->db->select('*');
        $this->db->where('expiry <',$today);
        //$this->db->where('status=','Inactive');
        $qry=$this->db->get('church_tbl');
        return $qry->num_rows();
        //return $this->db->count_all("");
    }
    public function get_super_account(){
        $qry=$this->db->get('superadmin_tbl');
        return $qry->result_array();
    }
    public function super_account($data){
        $qry=$this->db->insert('superadmin_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function getChurch(){
        $this->db->select('*');
        $this->db->from('church_tbl');
        $this->db->join('county_tbl','church_tbl.county=county_tbl.county_id');
        $this->db->order_by('created_date','desc');
        $qry=$this->db->get();
        return $qry->result_array();
    }
    public function getLoggedinSuperDetails($user){
        $this->db->where('national_id',$user);
        $qry=$this->db->get('superadmin_tbl');
        return $qry->result_array();
    }
    public function updateStatus($id,$data){//update church status
        $this->db->where('church_id',$id);
        $qry=$this->db->update('church_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function updateSuperDetails($id,$data){//update super details
        $this->db->where('super_id',$id);
        $qry=$this->db->update('superadmin_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function count_church_accounts(){
       return $this->db->count_all('church_tbl');
    }
    public function updatePassword($id,$data){//Updating super admin password
        $this->db->where('super_id',$id);
        $qry=$this->db->update('superadmin_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function update_user_pass($id,$data){//Updating church admin password
        $this->db->where('admin_id',$id);
        $qry=$this->db->update('churchadmin_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
}
?>