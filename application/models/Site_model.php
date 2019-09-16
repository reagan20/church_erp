<?php
class Site_model extends CI_Model{
    /*------------Church admin account creation-------------*/
    public function add_admin($data){
        $qry=$this->db->insert('churchadmin_tbl',$data);//adding church admin
        if($qry){return true;}
        else{return false;}
    }

    public function church_account($data){
        $qry=$this->db->insert('church_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function confirm_id($national){//national id no
        $this->db->where('m_nationalid',$national);
        $data=$this->db->get('members_tbl');
        if($data->num_rows()>0){
            return $data->row('m_nationalid');
        }
    }
    public function getMember_id($national){//member auto incremented id
        $this->db->where('m_nationalid',$national);
        $data=$this->db->get('members_tbl');
        if($data->num_rows()>0){
            return $data->row('id');
        }
    }
    public function getMember_role($national){//member role
        $this->db->where('m_nationalid',$national);
        $data=$this->db->get('members_tbl');
        if($data->num_rows()>0){
            return $data->row('role');
        }
    }
    public function getChurch_id($ch_id){//church id
        $this->db->where('created_by',$ch_id);
        $data=$this->db->get('church_tbl');
        if($data->num_rows()>0){
            return $data->row('church_id');
        }
    }
    public function getChurchStatus($x){
        $this->db->where('created_by',$x);
        $data=$this->db->get('church_tbl');
        if($data){
            return $data->row('status');
        }
    }
    public function confirm_password($national){
        $this->db->where('m_nationalid',$national);
        $data=$this->db->get('members_tbl');
        if($data->num_rows()>0){
            return $data->row('password');
        }
    }
    public function confirmmember_church($national){
        $this->db->where('m_nationalid',$national);
        $data=$this->db->get('members_tbl');
        if($data->num_rows()>0){
            return $data->row('church');
        }
    }
    public function confirm_church($national){//confirm admin church
        $this->db->where('created_by',$national);
        $data=$this->db->get('church_tbl');
        if($data->num_rows()>0){
            return $data->row('church_id');
        }
    }
    public function getChurchAdminauto_id($admin){//auto incrementing id
        $this->db->where('admin_nationalid',$admin);
        $data=$this->db->get('churchadmin_tbl');
        if($data->num_rows()>0){
            return $data->row('admin_id');
        }
    }
    public function confirm_first_login($admin){ //church admin
        $this->db->where('created_by',$admin);
        $data=$this->db->get('church_tbl');
        if($data->num_rows()>0){
            return $data->row('created_by');
        }
    }
    public function getCounty(){
        $qry=$this->db->get('county_tbl');
        return $qry->result_array();
    }

    public function updateMemberChurch($id,$data){
        $this->db->where('id',$id);
        $qry=$this->db->update('members_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    /*----------Church admin login process-----------*/
    public function getChurchAdmin_id($national){//confirm church admin during login
        $this->db->where('admin_nationalid',$national);
        $data=$this->db->get('churchadmin_tbl');
        if($data->num_rows()>0){
            return $data->row('admin_nationalid');
        }
    }
    public function confirm_churchadminpassword($national){//confirm church admin password
        $this->db->where('admin_nationalid',$national);
        $data=$this->db->get('churchadmin_tbl');
        if($data->num_rows()>0){
            return $data->row('admin_password');
        }
    }
    /*----------Church admin login process-----------*/

    /*----------Super admin login process-----------*/
    public function getSuperAdmin_id($national){//confirm super admin national id during login
        $this->db->where('national_id',$national);
        $data=$this->db->get('superadmin_tbl');
        if($data->num_rows()>0){
            return $data->row('national_id');
        }
    }
    public function confirm_superadminpassword($national){//confirm super admin password during login
        $this->db->where('national_id',$national);
        $data=$this->db->get('superadmin_tbl');
        if($data->num_rows()>0){
            return $data->row('password');
        }
    }
    /*----------Super admin login process-----------*/

    //Getting expiry date for the church account
    public function expiry($id){
       $this->db->select('*');
       $this->db->from('members_tbl');
       $this->db->join('church_tbl','church_tbl.church_id=members_tbl.church');
       $this->db->where('m_nationalid',$id);
       $qry=$this->db->get();
       if($qry->num_rows()>0){
           return $qry->row('expiry');
       }
    }
    //Getting expiry date for the church account
    public function expiryadmin($id){
        $this->db->select('*');
        $this->db->from('church_tbl');
        $this->db->join('churchadmin_tbl','church_tbl.created_by=churchadmin_tbl.admin_id');
        $this->db->where('churchadmin_tbl.admin_nationalid',$id);
        $qry=$this->db->get();
        if($qry->num_rows()>0){
            return $qry->row('expiry');
        }
    }

}
?>