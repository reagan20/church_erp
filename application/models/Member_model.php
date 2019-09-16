<?php
class Member_model extends CI_Model{
    public function add_offering($data){
        $qry=$this->db->insert('offering_tbl',$data);//adding category
        if($qry){return true;}
        else{return false;}
    }

    public function getLoggedinMemberDetails($det){
        $this->db->select('*');
        $this->db->from('members_tbl');
        $this->db->join('church_tbl','members_tbl.church=church_tbl.church_id');
        $this->db->join('gender_tbl','members_tbl.m_gender=gender_tbl.gender_id');
        $this->db->join('county_tbl','members_tbl.m_placeofbirth=county_tbl.county_id');
        $this->db->where('id',$det);
        $qry=$this->db->get();
        return $qry->result_array();
    }
    public function getSermons($ch){
        $this->db->where('church',$ch);
        $this->db->order_by('recorded','DESC');
        $qry=$this->db->get('sermons_tbl');
        return $qry->result_array();
    }
    public function getEvents($ch){
        $this->db->where('church',$ch);
        $this->db->order_by('created_date','DESC');
        $qry=$this->db->get('events_tbl');
        return $qry->result_array();
    }
    public function getProjects($ch){
        $this->db->where('church',$ch);
        $this->db->order_by('created','DESC');
        $qry=$this->db->get('project_tbl');
        return $qry->result_array();
    }
    public function getActiveProjects($ch){
        $this->db->where('church',$ch);
        $this->db->where('status','Ongoing');
        $this->db->order_by('created','DESC');
        $qry=$this->db->get('project_tbl');
        return $qry->result_array();
    }
    public function getCategory($ch){
        $this->db->where('church',$ch);
        $qry=$this->db->get('offeringcategory_tbl');
        return $qry->result_array();
    }
    public function getOfferings($ch,$mem){
        $this->db->select('*');
        $this->db->from('offering_tbl');
        //$this->db->join('members_tbl','offering_tbl.member=members_tbl.id');
        $this->db->join('offeringcategory_tbl','offering_tbl.category=offeringcategory_tbl.category_id');
        $this->db->where('offering_tbl.church',$ch);
        $this->db->where('offering_tbl.member',$mem);
        $this->db->order_by('offering_tbl.created_date','DESC');
        $qry=$this->db->get();
        if($qry){
            return $qry->result_array();
        }
        else{
            return false;
        }
    }
    public function getTotalOffering($ch,$mem){
        $this->db->select_sum('amount');
        $this->db->from('offering_tbl');
        $this->db->where('church',$ch);
        $this->db->where('member',$mem);
        $this->db->where('p_status','Approved');
        $this->db->order_by('payment_date','DESC');
        $qry=$this->db->get();
        return $qry->result_array();
    }
    public function countProjects($ch)//counting projects
    {   $this->db->select('*');
        $this->db->where('church',$ch);
        $qry=$this->db->get('project_tbl');
        return $qry->num_rows();
    }
    public function countEvents($ch)//counting events
    {   $this->db->select('*');
        $this->db->where('church',$ch);
        $qry=$this->db->get('events_tbl');
        return $qry->num_rows();
    }
    public function countSermons($ch)//counting sermons
    {   $this->db->select('*');
        $this->db->where('church',$ch);
        $qry=$this->db->get('events_tbl');
        return $qry->num_rows();
    }
    public function updatePassword($id,$data){//Updating member password
        $this->db->where('id',$id);
        $qry=$this->db->update('members_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
}
?>