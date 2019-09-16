<?php
class Admin_model extends CI_Model{

    function __construct() {
        $this->tblName = 'members_tbl';
        $this->table = 'chart';
    }

    /*------------------------------------INSERT QUERIES STARTS HERE------------------------------------*/
    public function insert_chart($data){
        $qry=$this->db->insert('chart',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function fetch_comment($slug=FALSE, $limit=FALSE, $offset=FALSE, $params = array()){
        if($limit){
            $this->db->limit($limit,$offset);
        }
        if($slug===FALSE){
            $this->db->order_by('id','DESC');
            $qry=$this->db->get('chart');
            return $qry->result_array();
        }
        $qry=$this->db->get_where(array('slug'=>$slug));
        return $qry->row_array();
    }
    function getRow($slug=FALSE, $limit=FALSE, $offset=FALSE, $params = array()){
        if($limit){
            $this->db->limit($limit,$offset);
        }
        if($slug===FALSE){
            $this->db->select('*');
            $this->db->from($this->table);

            if(array_key_exists("conditions", $params)){
                foreach($params['conditions'] as $key => $val){
                    $this->db->where($key, $val);
                }
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                if(array_key_exists("id", $params)){
                    $this->db->where('id', $params['id']);
                    $query = $this->db->get();
                    $result = $query->row_array();
                }else{
                    $this->db->order_by('id', 'desc');
                    if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                    }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                    }
                    $query = $this->db->get();
                    $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
                }
            }
            // Return fetched data
            return $result;
        }
        $result=$this->db->get_where(array('slug'=>$slug));
        return $result->row_array();

    }

    public function add_member($data){
        $qry=$this->db->insert('members_tbl',$data);//adding new member/church admin
        if($qry){return true;}
        else{return false;}
    }
    //Bulk member upload
    public function members_bulk_upload($data){
        $this->db->insert_batch('members_tbl',$data);
    }
    public function add_visitor($data){
        $qry=$this->db->insert('visitors_tbl',$data);//adding new visitor
        if($qry){return true;}
        else{return false;}
    }
    public function add_department($data){
        $qry=$this->db->insert('department_tbl',$data);//adding new department
        if($qry){return true;}
        else{return false;}
    }
    public function add_department_head($data){
        $qry=$this->db->insert('department_heads_tbl',$data);//assigning department head
        if($qry){return true;}
        else{return false;}
    }
    public function add_ministry($data){
        $qry=$this->db->insert('ministry_tbl',$data);//adding new ministry
        if($qry){return true;}
        else{return false;}
    }
    public function add_ministry_head($data){
        $qry=$this->db->insert('ministry_heads_tbl',$data);//assigning ministry head
        if($qry){return true;}
        else{return false;}
    }
    public function add_ministry_member($data){
        $qry=$this->db->insert('ministrymember_tbl',$data);//adding member to a ministry
        if($qry){return true;}
        else{return false;}
    }
    public function add_category($data){
        $qry=$this->db->insert('offeringcategory_tbl',$data);//adding category
        if($qry){return true;}
        else{return false;}
    }
    public function add_offering($data){
        $qry=$this->db->insert('offering_tbl',$data);//adding category
        if($qry){return true;}
        else{return false;}
    }
    public function add_event($data){
        $qry=$this->db->insert('events_tbl',$data);//adding events
        if($qry){return true;}
        else{return false;}
    }
    public function add_sermon($data){
        $qry=$this->db->insert('sermons_tbl',$data);//adding sermons
        if($qry){return true;}
        else{return false;}
    }
    public function add_project($data){
        $qry=$this->db->insert('project_tbl',$data);//adding project
        if($qry){return true;}
        else{return false;}
    }
    public function add_baptism($data){
        $qry=$this->db->insert('baptism_tbl',$data);//adding baptism
        if($qry){return true;}
        else{return false;}
    }
    public function add_income_head($data){
        $qry=$this->db->insert('incomehead_tbl',$data);//creating income head
        if($qry){return true;}
        else{return false;}
    }
    public function add_income($data){
        $qry=$this->db->insert('income_tbl',$data);//adding income
        if($qry){return true;}
        else{return false;}
    }
    public function add_expense_head($data){
        $qry=$this->db->insert('expensehead_tbl',$data);//creating expense head
        if($qry){return true;}
        else{return false;}
    }
    public function add_expense($data){
        $qry=$this->db->insert('expense_tbl',$data);//adding expense
        if($qry){return true;}
        else{return false;}
    }
    public function add_votehead($data){
        $qry=$this->db->insert('vote_heads',$data);
        if($qry){return true;}
        else{return false;}
    }
    /*------------------------------------INSERT QUERIES ENDS HERE------------------------------------*/

    /*------------------------------------SELECT QUERIES STARTS HERE------------------------------------*/
    public function getVoteHead($ch){
        $this->db->where('church',$ch);
        $this->db->order_by('created_date','DESC');
        $qry=$this->db->get('vote_heads');
        return $qry->result_array();
    }
    //getting income vote heads
    public function getIncomeVoteHead($ch){
        $this->db->where('church',$ch);
        $this->db->where('category','1');
        $qry=$this->db->get('vote_heads');
        return $qry->result_array();
    }
    //getting expense vote heads
    public function getExpenseVoteHead($ch){
        $this->db->where('church',$ch);
        $this->db->where('category','2');
        $qry=$this->db->get('vote_heads');
        return $qry->result_array();
    }
    //confirm membership number
    public function confirm_membership($member_no, $ch){
        $this->db->where('church',$ch);
        $this->db->where('member_no',$member_no);
        $qry=$this->db->get('members_tbl');
        if($qry->num_rows()>0){return true;}
        else{return false;}
    }
    public function check_baptism($member){//checking baptism report
        $this->db->where('member',$member);
        $qry=$this->db->get('baptism_tbl');
        if($qry->num_rows()>0){return true;}
        else{return false;}
    }

    public function getGender(){
        $qry=$this->db->get('gender_tbl');
        return $qry->result_array();
    }
    public function getMembers($ch){
        $this->db->select('*');
        $this->db->from('members_tbl');
        $this->db->join('county_tbl','members_tbl.m_placeofbirth=county_tbl.county_id');
        $this->db->where('church',$ch);
        $this->db->order_by('recorded_date','DESC');
        $qry=$this->db->get();
        return $qry->result_array();
    }

    public function getMaxId2(){//
        return $this->db->select_max('member_no')->from('members_tbl')->get()->row();//
    }

    public function getMaxId($ch){//
        //return $this->db->select_max('member_no')->where('church',$ch)->get('members_tbl')->row('member_no');//
        $this->db->select_max('member_no');
        $this->db->where('church',$ch);
        $qry=$this->db->get('members_tbl');
        return $qry->row('member_no');

    }
    public function getChurchDetails($church){
        $this->db->where('church_id',$church);
        $qry=$this->db->get('church_tbl');
        return $qry->result_array();
    }

    public function getLoggedinUserDetails($user){
        $this->db->where('admin_id',$user);
        $qry=$this->db->get('churchadmin_tbl');
        return $qry->result_array();
    }
    public function getCounty(){
        $qry=$this->db->get('county_tbl');
        return $qry->result_array();
    }
    public function getVisitors($vis){
        $this->db->where('church',$vis);
        $this->db->order_by('v_createddate','DESC');
        $qry=$this->db->get('visitors_tbl');
        return $qry->result_array();
    }
    public function getDepartments($dep){
        $this->db->where('church',$dep);
        $this->db->order_by('d_created','DESC');
        $qry=$this->db->get('department_tbl');
        return $qry->result_array();
    }
    public function getCategory($ch){
        //$this->db->where('church',$ch);
        $qry=$this->db->get('offeringcategory_tbl');
        return $qry->result_array();
    }
    public function getEvents($ch){
        $this->db->where('church',$ch);
        $this->db->order_by('created_date','DESC');
        $qry=$this->db->get('events_tbl');
        return $qry->result_array();
    }
    public function getSermons($ch){
        $this->db->where('church',$ch);
        $this->db->order_by('recorded','DESC');
        $qry=$this->db->get('sermons_tbl');
        return $qry->result_array();
    }
    public function getIncomeHead($ch){
        $this->db->where('church',$ch);
        $this->db->order_by('dated','DESC');
        $qry=$this->db->get('incomehead_tbl');
        return $qry->result_array();
    }
    public function getIncome($ch){
        $this->db->select('*');
        $this->db->from('income_tbl');
        $this->db->join('vote_heads','income_tbl.income_head=vote_heads.vote_head_id');
        $this->db->where('income_tbl.church',$ch);
        $this->db->where('vote_heads.category','1');
        $this->db->order_by('income_tbl.dated','DESC');
        $qry=$this->db->get();
        return $qry->result_array();
    }
    public function getExpense($ch){
        $this->db->select('*');
        $this->db->from('expense_tbl');
        $this->db->join('vote_heads','expense_tbl.expense_head=vote_heads.vote_head_id');
        $this->db->where('expense_tbl.church',$ch);
        $this->db->where('vote_heads.category','2');
        $this->db->order_by('expense_tbl.dated','DESC');
        $qry=$this->db->get();
        return $qry->result_array();
    }
    public function getExpenseHead($ch){
        $this->db->where('church',$ch);
        $this->db->order_by('dated','DESC');
        $qry=$this->db->get('expensehead_tbl');
        return $qry->result_array();
    }
    public function getProjects($ch){
        $this->db->where('church',$ch);
        $this->db->order_by('created','DESC');
        $qry=$this->db->get('project_tbl');
        return $qry->result_array();
    }
    public function getOngoingProjects($ch){
        $this->db->where('church',$ch);
        $this->db->where('status','Ongoing');
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
    public function getDepartmentHeads($hd){
        $this->db->select('*');
        $this->db->from('department_heads_tbl');
        $this->db->join('members_tbl','department_heads_tbl.head_id=members_tbl.id');
        $this->db->join('department_tbl','department_heads_tbl.dept_id=department_tbl.department_id');
        $this->db->where('department_heads_tbl.church',$hd);
        $this->db->order_by('h_created','DESC');
        $qry=$this->db->get();
        if($qry){
            return $qry->result_array();
        }
        else{
            return false;
        }
    }
    public function getMinistries($ch){
        $this->db->where('church',$ch);
        $this->db->order_by('m_created','DESC');
        $qry=$this->db->get('ministry_tbl');
        return $qry->result_array();
    }
    public function getMinistry_members($min,$x){
        $this->db->select('*');
        $this->db->from('ministrymember_tbl');
        $this->db->join('members_tbl','ministrymember_tbl.member_id=members_tbl.id');
        $this->db->join('ministry_tbl','ministrymember_tbl.ministry_id=ministry_tbl.ministry_id');
        $this->db->where('ministrymember_tbl.ministry_id',$min);
        $this->db->where('ministrymember_tbl.church',$x);
        $qry=$this->db->get();
        return $qry->result_array();
    }
    public function getMinistryConditionally($id){
        $this->db->where('ministry_id',$id);
        $qry=$this->db->get('ministry_tbl');
        return $qry->result_array();
    }
    public function getMinistryHeads($ch){
        $this->db->select('*');
        $this->db->from('ministry_heads_tbl');
        $this->db->join('members_tbl','ministry_heads_tbl.head_id=members_tbl.id');
        $this->db->join('ministry_tbl','ministry_heads_tbl.ministry_id=ministry_tbl.ministry_id');
        $this->db->where('ministry_heads_tbl.church',$ch);
        $qry=$this->db->get();
        if($qry){
            return $qry->result_array();
        }
        else{
            return false;
        }
    }
    public function getOfferings($ch){
        $this->db->select('*');
        $this->db->from('offering_tbl');
        $this->db->join('members_tbl','offering_tbl.member=members_tbl.id');
        $this->db->join('offeringcategory_tbl','offering_tbl.category=offeringcategory_tbl.category_id');
        $this->db->where('offering_tbl.church',$ch);
        $this->db->order_by('offering_tbl.created_date','DESC');
        $qry=$this->db->get();
        if($qry){
            return $qry->result_array();
        }
        else{
            return false;
        }
    }
    public function getGeneralOffering($ch){
        $this->db->where('church',$ch);
        $this->db->where('member',0);
        $this->db->order_by('created_date','DESC');
        $qry=$this->db->get('offering_tbl');
        return $qry->result_array();
    }
    public function getBaptisedMembers($ch){
        $this->db->select('*');
        $this->db->from('baptism_tbl');
        $this->db->join('members_tbl','members_tbl.id=baptism_tbl.member');
        $this->db->join('churchadmin_tbl','churchadmin_tbl.admin_id=baptism_tbl.pastor');
        $this->db->join('church_tbl','church_tbl.church_id=baptism_tbl.church');
        $this->db->where('baptism_tbl.church',$ch);
        $this->db->order_by('baptism_tbl.recorded_date','DESC');
        $qry=$this->db->get();
        return $qry->result_array();
    }
    public function countMembers($ch)//counting members
    {   $this->db->select('*');
        $this->db->where('church',$ch);
        $qry=$this->db->get('members_tbl');
        return $qry->num_rows();
        //return $this->db->count_all("");
    }
    public function countVisitors($ch)//counting visitors
    {   $this->db->select('*');
        $this->db->where('church',$ch);
        $qry=$this->db->get('visitors_tbl');
        return $qry->num_rows();
    }
    public function countDepartments($ch)//counting departments
    {   $this->db->select('*');
        $this->db->where('church',$ch);
        $qry=$this->db->get('department_tbl');
        return $qry->num_rows();
        //return $this->db->count_all("");
    }
    public function countMinistries($ch)//counting ministries
    {   $this->db->select('*');
        $this->db->where('church',$ch);
        $qry=$this->db->get('ministry_tbl');
        return $qry->num_rows();
    }
    public function countProjects($ch)//counting projects
    {   $this->db->select('*');
        $this->db->where('church',$ch);
        $qry=$this->db->get('project_tbl');
        return $qry->num_rows();
    }
    public function countBaptisedMembers($ch)//counting baptised members
    {   $this->db->select('*');
        $this->db->where('church',$ch);
        $qry=$this->db->get('baptism_tbl');
        return $qry->num_rows();
    }
    public function getTotalContribution($ch){//Approved payments
        $this->db->select_sum('amount');
        $this->db->from('offering_tbl');
        $this->db->join('members_tbl','members_tbl.id=offering_tbl.member');
        $this->db->where('offering_tbl.church',$ch);
        $this->db->where('p_status','Approved');
        $qry=$this->db->get();
        return $qry->result_array();
    }
    public function getTotalContributionPending($ch){//Pending payments
        $this->db->select_sum('amount');
        $this->db->from('offering_tbl');
        $this->db->join('members_tbl','members_tbl.id=offering_tbl.member');
        $this->db->where('offering_tbl.church',$ch);
        $this->db->where('p_status','Pending');
        $qry=$this->db->get();
        return $qry->result_array();
    }
    public function getTotalIncome($ch){
        $this->db->select_sum('amount');
        $this->db->where('church',$ch);
        //$this->db->where('category','1');
        $qry=$this->db->get('income_tbl');
        return $qry->result_array();
    }
    public function getTotalExpense($ch){
        $this->db->select_sum('amount');
        $this->db->where('church',$ch);
        $qry=$this->db->get('expense_tbl');
        return $qry->result_array();
    }
    public function getTotalGeneralOffering($ch){
        $this->db->select_sum('amount');
        $this->db->where('church',$ch);
        $this->db->where('member',0);
        $qry=$this->db->get('offering_tbl');
        return $qry->result_array();
    }
    //Search data
    public function searchData($criteria=array(),$ch){
        $sh=$criteria['search_input'];
        $this->db->select('*');
        $this->db->from('members_tbl');
        $this->db->join('gender_tbl','members_tbl.m_gender=gender_tbl.gender_id');
        $this->db->join('county_tbl','members_tbl.m_placeofbirth=county_tbl.county_id');
        $this->db->where("members_tbl.member_no LIKE '%".$sh."%' AND members_tbl.church=$ch OR members_tbl.m_firstname LIKE '%".$sh."%' AND members_tbl.church=$ch OR members_tbl.m_middlename LIKE '%".$sh."%' AND members_tbl.church=$ch OR members_tbl.m_lastname LIKE '%".$sh."%' AND members_tbl.church=$ch OR members_tbl.m_phone LIKE '%".$sh."%' AND members_tbl.church=$ch OR members_tbl.m_email LIKE '%".$sh."%' AND members_tbl.church=$ch OR gender_tbl.gender_name LIKE '%".$sh."%' AND members_tbl.church=$ch OR county_tbl.county_name LIKE '%".$sh."%' AND members_tbl.church=$ch OR members_tbl.m_residenceplace LIKE '%".$sh."%' AND members_tbl.church=$ch OR members_tbl.m_dob LIKE '%".$sh."%' AND members_tbl.church=$ch OR members_tbl.m_nationalid LIKE '%".$sh."%' AND members_tbl.church=$ch OR members_tbl.role LIKE '%".$sh."%' AND members_tbl.church=$ch OR members_tbl.status LIKE '%".$sh."%' AND members_tbl.church=$ch");
        $this->db->where('members_tbl.church=',$ch);//AND members_tbl.church='%".$ch."%'
        $query=$this->db->get();
        return $query->result_array();
    }
    public function countSearchMembers($criteria=array(),$ch)//counting searched members data by random input
    {
        $sh=$criteria['search_input'];
        $this->db->select('*');
        $this->db->from('members_tbl');
        $this->db->join('gender_tbl','members_tbl.m_gender=gender_tbl.gender_id');
        $this->db->join('county_tbl','members_tbl.m_placeofbirth=county_tbl.county_id');
        $this->db->where("members_tbl.member_no LIKE '%".$sh."%' AND members_tbl.church=$ch OR members_tbl.m_firstname LIKE '%".$sh."%' AND members_tbl.church=$ch OR members_tbl.m_middlename LIKE '%".$sh."%' AND members_tbl.church=$ch OR members_tbl.m_lastname LIKE '%".$sh."%' AND members_tbl.church=$ch OR members_tbl.m_phone LIKE '%".$sh."%' AND members_tbl.church=$ch OR members_tbl.m_email LIKE '%".$sh."%' AND members_tbl.church=$ch OR gender_tbl.gender_name LIKE '%".$sh."%' AND members_tbl.church=$ch OR county_tbl.county_name LIKE '%".$sh."%' AND members_tbl.church=$ch OR members_tbl.m_residenceplace LIKE '%".$sh."%' AND members_tbl.church=$ch OR members_tbl.m_dob LIKE '%".$sh."%' AND members_tbl.church=$ch OR members_tbl.m_nationalid LIKE '%".$sh."%' AND members_tbl.church=$ch OR members_tbl.role LIKE '%".$sh."%' AND members_tbl.church=$ch OR members_tbl.status LIKE '%".$sh."%' AND members_tbl.church=$ch");
        $this->db->where('members_tbl.church',$ch);
        //$this->db->where('church',$ch);
        $qry=$this->db->get();
        return $qry->num_rows();
    }
    public function searchByDate($ser=array(),$ch){//search members by date range
        $start=$ser['start_date'];
        $end=$ser['end_date'];
        $this->db->select('*');
        $this->db->from('members_tbl');
        $this->db->join('gender_tbl','members_tbl.m_gender=gender_tbl.gender_id');
        $this->db->join('county_tbl','members_tbl.m_placeofbirth=county_tbl.county_id');
        $this->db->where('m_joiningdate >=', $start);
        $this->db->where('m_joiningdate <=', $end);
        $this->db->where('members_tbl.church',$ch);
        $this->db->order_by('m_joiningdate','DESC');
        $qry=$this->db->get();
        return $qry->result_array();
    }
    public function countSearch1Members($ser=array(),$ch)//counting searched members data by date
    {
        $start=$ser['start_date'];
        $end=$ser['end_date'];
        $this->db->select('*');
        $this->db->from('members_tbl');
        $this->db->join('gender_tbl','members_tbl.m_gender=gender_tbl.gender_id');
        $this->db->join('county_tbl','members_tbl.m_placeofbirth=county_tbl.county_id');
        $this->db->where('m_joiningdate >=', $start);
        $this->db->where('m_joiningdate <=', $end);
        $this->db->where('members_tbl.church',$ch);
        $this->db->order_by('m_joiningdate','DESC');
        $qry=$this->db->get();
        return $qry->num_rows();
    }
    public function countSearch1Visitors($ser=array(),$ch)//counting searched visitors data by date
    {
        $start=$ser['start_date'];
        $end=$ser['end_date'];
        $this->db->select('*');
        $this->db->from('visitors_tbl');
        //$this->db->join('gender_tbl','members_tbl.m_gender=gender_tbl.gender_id');
        //$this->db->join('county_tbl','members_tbl.m_placeofbirth=county_tbl.county_id');
        $this->db->where('v_visitingdate >=', $start);
        $this->db->where('v_visitingdate <=', $end);
        $this->db->where('visitors_tbl.church',$ch);
        $this->db->order_by('v_createddate','DESC');
        $qry=$this->db->get();
        return $qry->num_rows();
    }
    public function searchByDateRange($ser=array(),$ch){//search visitors by date range
        $start=$ser['start_date'];
        $end=$ser['end_date'];
        $this->db->select('*');
        $this->db->from('visitors_tbl');
        $this->db->join('gender_tbl','visitors_tbl.v_gender=gender_tbl.gender_id');
        //$this->db->join('county_tbl','visitors_tbl.m_placeofbirth=county_tbl.county_id');
        $this->db->where('v_visitingdate >=', $start);
        $this->db->where('v_visitingdate <=', $end);
        $this->db->where('visitors_tbl.church',$ch);
        $this->db->order_by('v_createddate','DESC');
        $qry=$this->db->get();
        return $qry->result_array();
    }
    public function searchBaptismRecords1($bap=array(),$ch){//search baptism by date range
        $start=$bap['start_date'];
        $end=$bap['end_date'];
        $this->db->select('*');
        $this->db->from('baptism_tbl');
        $this->db->join('members_tbl','members_tbl.id=baptism_tbl.member');
        $this->db->join('churchadmin_tbl','churchadmin_tbl.admin_id=baptism_tbl.pastor');
        $this->db->join('church_tbl','church_tbl.church_id=baptism_tbl.church');
        $this->db->where('date_of_baptism >=', $start);
        $this->db->where('date_of_baptism <=', $end);
        $this->db->where('baptism_tbl.church',$ch);
        $this->db->order_by('baptism_tbl.recorded_date','DESC');
        $qry=$this->db->get();
        return $qry->result_array();
    }
    public function searchBaptismRecords1Count($bap=array(),$ch){//counting searched baptism data by date range
        $start=$bap['start_date'];
        $end=$bap['end_date'];
        $this->db->select('*');
        $this->db->from('baptism_tbl');
        $this->db->join('members_tbl','members_tbl.id=baptism_tbl.member');
        $this->db->join('churchadmin_tbl','churchadmin_tbl.admin_id=baptism_tbl.pastor');
        $this->db->join('church_tbl','church_tbl.church_id=baptism_tbl.church');
        $this->db->where('date_of_baptism >=', $start);
        $this->db->where('date_of_baptism <=', $end);
        $this->db->where('baptism_tbl.church',$ch);
        $this->db->order_by('baptism_tbl.recorded_date','DESC');
        $qry=$this->db->get();
        return $qry->num_rows();
    }
    public function searchBaptismRecordsRandomly($bap=array(),$ch){//search baptism by random input data
        $search_input=$bap['search_input'];
        $this->db->select('*');
        $this->db->from('baptism_tbl');
        $this->db->join('members_tbl','members_tbl.id=baptism_tbl.member');
        $this->db->join('churchadmin_tbl','churchadmin_tbl.admin_id=baptism_tbl.pastor');
        $this->db->join('church_tbl','church_tbl.church_id=baptism_tbl.church');
        $this->db->where("baptism_tbl.member LIKE '%".$search_input."%' AND baptism_tbl.church=$ch OR baptism_tbl.date_of_baptism LIKE '%".$search_input."%' AND baptism_tbl.church=$ch OR members_tbl.m_firstname LIKE '%".$search_input."%' AND baptism_tbl.church=$ch OR members_tbl.m_middlename LIKE '%".$search_input."%' AND baptism_tbl.church=$ch OR members_tbl.m_lastname LIKE '%".$search_input."%' AND baptism_tbl.church=$ch OR members_tbl.m_email LIKE '%".$search_input."%' AND baptism_tbl.church=$ch");
        $this->db->where('baptism_tbl.church',$ch);
        $this->db->order_by('baptism_tbl.recorded_date','DESC');
        $qry=$this->db->get();
        return $qry->result_array();
    }
    public function searchBaptismRecordsRandomly1($bap=array(),$ch){//counting randomly searched baptism by random input data
        $search_input=$bap['search_input'];
        $this->db->select('*');
        $this->db->from('baptism_tbl');
        $this->db->join('members_tbl','members_tbl.id=baptism_tbl.member');
        $this->db->join('churchadmin_tbl','churchadmin_tbl.admin_id=baptism_tbl.pastor');
        $this->db->join('church_tbl','church_tbl.church_id=baptism_tbl.church');
        $this->db->where("baptism_tbl.member LIKE '%".$search_input."%' AND baptism_tbl.church=$ch OR baptism_tbl.date_of_baptism LIKE '%".$search_input."%' AND baptism_tbl.church=$ch OR members_tbl.m_firstname LIKE '%".$search_input."%' AND baptism_tbl.church=$ch OR members_tbl.m_middlename LIKE '%".$search_input."%' AND baptism_tbl.church=$ch OR members_tbl.m_lastname LIKE '%".$search_input."%' AND baptism_tbl.church=$ch OR members_tbl.m_email LIKE '%".$search_input."%' AND baptism_tbl.church=$ch");
        $this->db->where('baptism_tbl.church',$ch);
        $this->db->order_by('baptism_tbl.recorded_date','DESC');
        $qry=$this->db->get();
        return $qry->num_rows();
    }
    public function searchRandomly($criteria=array(),$ch){//search offering by random inputs
        $sh=$criteria['search_input'];
        $this->db->select('*');
        $this->db->from('offering_tbl');
        $this->db->join('members_tbl','members_tbl.id=offering_tbl.member');
        $this->db->join('offeringcategory_tbl','offeringcategory_tbl.category_id=offering_tbl.category');
        $this->db->where("offering_tbl.member LIKE '%".$sh."%' OR members_tbl.m_firstname LIKE '%".$sh."%' OR members_tbl.m_middlename LIKE '%".$sh."%' OR members_tbl.m_lastname LIKE '%".$sh."%' OR offering_tbl.pay_mode LIKE '%".$sh."%' OR offeringcategory_tbl.category_name LIKE '%".$sh."%' OR offering_tbl.payment_date LIKE '%".$sh."%' OR offering_tbl.p_status LIKE '%".$sh."%'");
        $this->db->where('offering_tbl.church',$ch);//AND members_tbl.church='%".$ch."%'
        //$this->db->where('offeringcategory_tbl.church',$ch);
        $query=$this->db->get();
        return $query->result_array();
    }
    public function searchTotalRandomly($criteria=array(),$ch){//search offering by random inputs
        $sh=$criteria['search_input'];
        $this->db->select_sum('amount');
        $this->db->from('offering_tbl');
        $this->db->join('members_tbl','members_tbl.id=offering_tbl.member');
        $this->db->join('offeringcategory_tbl','offeringcategory_tbl.category_id=offering_tbl.category');
        $this->db->where("offering_tbl.member LIKE '%".$sh."%' OR members_tbl.m_firstname LIKE '%".$sh."%' OR members_tbl.m_middlename LIKE '%".$sh."%' OR members_tbl.m_lastname LIKE '%".$sh."%' OR offering_tbl.pay_mode LIKE '%".$sh."%' OR offeringcategory_tbl.category_name LIKE '%".$sh."%' OR offering_tbl.payment_date LIKE '%".$sh."%' OR offering_tbl.p_status LIKE '%".$sh."%'");
        $this->db->where('offering_tbl.church',$ch);//AND members_tbl.church='%".$ch."%'
        //$this->db->where('offeringcategory_tbl.church',$ch);
        $query=$this->db->get();
        return $query->result_array();
    }
    public function searchTotalRandomlyPending($criteria=array(),$ch){//search offering by random inputs
        $sh=$criteria['search_input'];
        $this->db->select_sum('amount');
        $this->db->from('offering_tbl');
        $this->db->join('members_tbl','members_tbl.id=offering_tbl.member');
        $this->db->join('offeringcategory_tbl','offeringcategory_tbl.category_id=offering_tbl.category');
        $this->db->where("offering_tbl.member LIKE '%".$sh."%' OR members_tbl.m_firstname LIKE '%".$sh."%' OR members_tbl.m_middlename LIKE '%".$sh."%' OR members_tbl.m_lastname LIKE '%".$sh."%' OR offering_tbl.pay_mode LIKE '%".$sh."%' OR offeringcategory_tbl.category_name LIKE '%".$sh."%' OR offering_tbl.payment_date LIKE '%".$sh."%' OR offering_tbl.p_status LIKE '%".$sh."%'");
        $this->db->where('offering_tbl.church',$ch);//AND members_tbl.church='%".$ch."%'
        $this->db->where('p_status','Pending');
        $query=$this->db->get();
        return $query->result_array();
    }
    public function searchOfferingByDate($ser=array(),$ch){//search offering by date range
        $start=$ser['start_date'];
        $end=$ser['end_date'];
        $this->db->select('*');
        $this->db->from('offering_tbl');
        $this->db->join('offeringcategory_tbl','offering_tbl.category=offeringcategory_tbl.category_id');
        $this->db->join('members_tbl','offering_tbl.member=members_tbl.id');
        $this->db->where('payment_date >=', $start);
        $this->db->where('payment_date <=', $end);
        $this->db->where('offering_tbl.church',$ch);
        $this->db->order_by('created_date','DESC');
        $qry=$this->db->get();
        return $qry->result_array();
    }
    public function searchTotalContribution($ser=array(),$ch){//searching total contributions using date range
        $start=$ser['start_date'];
        $end=$ser['end_date'];
        $this->db->select_sum('amount');
        $this->db->from('offering_tbl');
        $this->db->join('offeringcategory_tbl','offering_tbl.category=offeringcategory_tbl.category_id');
        $this->db->join('members_tbl','members_tbl.id=offering_tbl.member');
        $this->db->where('payment_date >=', $start);
        $this->db->where('payment_date <=', $end);
        $this->db->where('offering_tbl.church',$ch);
        $qry=$this->db->get();
        return $qry->result_array();
    }
    public function searchGeneralOffering($general=array(),$ch){//searching general offering by date range
        $start = $general['start_date'];
        $end = $general['end_date'];
        $this->db->where('payment_date >=', $start);
        $this->db->where('payment_date <=', $end);
        $this->db->where('church', $ch);
        $this->db->where('member', 0);
        $this->db->order_by('created_date','DESC');
        $qry = $this->db->get('offering_tbl');
        return $qry->result_array();
    }
    public function searchTotalGeneralOffering($general=array(),$ch){//searching total general offering by date range
        $start = $general['start_date'];
        $end = $general['end_date'];
        $this->db->select_sum('amount');
        $this->db->where('payment_date >=', $start);
        $this->db->where('payment_date <=', $end);
        $this->db->where('church', $ch);
        $this->db->where('member', 0);
        $qry = $this->db->get('offering_tbl');
        return $qry->result_array();
    }
    /*------------------------------------SELECT QUERIES ENDS HERE------------------------------------*/

    /*------------------------------------UPDATE QUERIES STARTS HERE------------------------------------*/
    public function updateVoteHead($id,$data){//vote head details
        $this->db->where('vote_head_id',$id);
        $qry=$this->db->update('vote_heads',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function updateMember($id,$data){//Updating member details
        $this->db->where('id',$id);
        $qry=$this->db->update('members_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function updateVisitor($id,$data){//Updating visitor details
        $this->db->where('visitor_no',$id);
        $qry=$this->db->update('visitors_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function updateDepartment($id,$data){//Updating department details
        $this->db->where('department_id',$id);
        $qry=$this->db->update('department_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function updateDepartmentHead($id,$data){//Updating Department head details
        $this->db->where('department_head_id',$id);
        $qry=$this->db->update('department_heads_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function updateMinistry($id,$data){//Updating ministry details
        $this->db->where('ministry_id',$id);
        $qry=$this->db->update('ministry_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function updateMinistryMemberStatus($id,$data){//Updating ministry member status
        $this->db->where('ministrymember_id',$id);
        $qry=$this->db->update('ministrymember_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function updateMinistryHead($id,$data){//Updating Ministry head details
        $this->db->where('ministry_head_id',$id);
        $qry=$this->db->update('ministry_heads_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function updateCategory($id,$data){//Updating category details
        $this->db->where('category_id',$id);
        $qry=$this->db->update('offeringcategory_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function updateEvent($id,$data){//Updating event details
        $this->db->where('event_id',$id);
        $qry=$this->db->update('events_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function updateSermon($id,$data){//Updating sermon details
        $this->db->where('sermon_id',$id);
        $qry=$this->db->update('sermons_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function updateProject($id,$data){//Updating project details
        $this->db->where('project_id',$id);
        $qry=$this->db->update('project_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function updateChurchDetails($id,$data){//Updating church details
        $this->db->where('church_id',$id);
        $qry=$this->db->update('church_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function updateOffering($id,$data){//Updating offering/general offering
        $this->db->where('offering_id',$id);
        $qry=$this->db->update('offering_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function updateIncomeHead($id,$data){//Updating income head
        $this->db->where('head_id',$id);
        $qry=$this->db->update('incomehead_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function updateIncome($id,$data){//Updating income
        $this->db->where('income_id',$id);
        $qry=$this->db->update('income_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function updateExpenseHead($id,$data){//Updating expense head
        $this->db->where('head_id',$id);
        $qry=$this->db->update('expensehead_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function updateExpense($id,$data){//Updating expense
        $this->db->where('expense_id',$id);
        $qry=$this->db->update('expense_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function updateBaptism($id,$data){//Updating baptism
        $this->db->where('baptism_id',$id);
        $qry=$this->db->update('baptism_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function updatePassword($id,$data){//Updating church admin password
        $this->db->where('admin_id',$id);
        $qry=$this->db->update('churchadmin_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function updateChurchAdminDetails($id,$data){//Updating admin personal details
        $this->db->where('admin_id',$id);
        $qry=$this->db->update('churchadmin_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    public function updateChurchLogo($id,$data){//Updating church
        $this->db->where('created_by',$id);
        $qry=$this->db->update('church_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    /*------------------------------------UPDATE QUERIES ENDS HERE------------------------------------*/

    /*------------------------------------DELETE QUERIES STARTS HERE------------------------------------*/
    public function deletevotehead($id){//deleting vote heads
        $this->db->where('vote_head_id',$id);
        $qry=$this->db->delete('vote_heads');
        if($qry){return true;}
        else{return false;}
    }
    public function deletemember($id){//deleting member details
        $this->db->where('id',$id);
        $qry=$this->db->delete('members_tbl');
        if($qry){return true;}
        else{return false;}
    }
    public function deletevisitor($id){//deleting visitor details
        $this->db->where('visitor_no',$id);
        $qry=$this->db->delete('visitors_tbl');
        if($qry){return true;}
        else{return false;}
    }
    public function deletedepartment($id){//deleting department details
        $this->db->where('department_id',$id);
        $qry=$this->db->delete('department_tbl');
        if($qry){return true;}
        else{return false;}
    }
    public function deleteministry($id){//deleting ministry details
        $this->db->where('ministry_id',$id);
        $qry=$this->db->delete('ministry_tbl');
        if($qry){return true;}
        else{return false;}
    }
    public function deletecategory($id){//deleting category details
        $this->db->where('category_id',$id);
        $qry=$this->db->delete('offeringcategory_tbl');
        if($qry){return true;}
        else{return false;}
    }
    public function deleteevent($id){//deleting event details
        $this->db->where('event_id',$id);
        $qry=$this->db->delete('events_tbl');
        if($qry){return true;}
        else{return false;}
    }
    public function deletesermon($id){//deleting sermons details
        $this->db->where('sermon_id',$id);
        $qry=$this->db->delete('sermons_tbl');
        if($qry){return true;}
        else{return false;}
    }
    public function deleteoffering($id){//deleting offering/general offering
        $this->db->where('offering_id',$id);
        $qry=$this->db->delete('offering_tbl');
        if($qry){return true;}
        else{return false;}
    }
    public function deleteproject($id){//deleting project
        $this->db->where('project_id',$id);
        $qry=$this->db->delete('project_tbl');
        if($qry){return true;}
        else{return false;}
    }
    public function deleteincomehead($id){//deleting income head
        $this->db->where('head_id',$id);
        $qry=$this->db->delete('incomehead_tbl');
        if($qry){return true;}
        else{return false;}
    }
    public function deleteincome($id){//deleting income
        $this->db->where('income_id',$id);
        $qry=$this->db->delete('income_tbl');
        if($qry){return true;}
        else{return false;}
    }
    public function deleteexpensehead($id){//deleting expense head
        $this->db->where('head_id',$id);
        $qry=$this->db->delete('expensehead_tbl');
        if($qry){return true;}
        else{return false;}
    }
    public function deleteexpense($id){//deleting expense
        $this->db->where('expense_id',$id);
        $qry=$this->db->delete('expense_tbl');
        if($qry){return true;}
        else{return false;}
    }
    public function deleteBaptismRecord($id){//deleting baptism record
        $this->db->where('baptism_id',$id);
        $qry=$this->db->delete('baptism_tbl');
        if($qry){return true;}
        else{return false;}
    }
    /*-----------Bulk delete process---------------*/
    function getRows($params=array()){
        $this->db->select('*');
        $this->db->from($this->tblName);
        //fetch data by condition
        if(array_key_exists("where",$params)){
            foreach($params['where'] as $key=>$value){
                $this->db->where($key,$value);
            }
        }
        if(array_key_exists("order_by",$params)){
            $this->db->order_by($params['order_by']);
        }
        if(array_key_exists("id",$params)){
            $this->db->where('id',$params['id']);
            $query=$this->db->get();
            $result=$query->row_array();
        }
        else{
            //set start and limit
            if(array_key_exists("start",$params)&& array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }
            elseif(!array_key_exists("start",$params)&& array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params)&& $params['returnType']=='count'){
                $result=$this->db->count_all_results();
            }
            else{
                $query=$this->db->get();
                $result=($query->num_rows()>0)?$query->result_array():FALSE;
            }
        }
        //return fetched data
        return $result;
    }
    /*
     * Delete data from the database
     * @param id array/int
     */
    public function delete_bulk_members($id){
        if(is_array($id)){
            $this->db->where_in('id',$id);
        }
        else{
            $this->db->where('id',$id);
        }
        $delete=$this->db->delete($this->tblName);
        return $delete?true:false;
    }
    /*------------------------------------DELETE QUERIES ENDS HERE------------------------------------*/

    //Baptism card details
    public function generateBaptism($ch,$baptism_id){
        $this->db->select('*');
        $this->db->from('baptism_tbl');
        $this->db->join('members_tbl','members_tbl.id=baptism_tbl.member');
        $this->db->join('churchadmin_tbl','churchadmin_tbl.admin_id=baptism_tbl.pastor');
        $this->db->join('church_tbl','church_tbl.church_id=baptism_tbl.church');
        $this->db->where('baptism_tbl.church',$ch);
        $this->db->where('baptism_id',$baptism_id);
        $this->db->order_by('baptism_tbl.recorded_date','DESC');
        $qry=$this->db->get();
        return $qry->result_array();
    }
}
?>