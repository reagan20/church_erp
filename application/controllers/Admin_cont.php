<?php
class Admin_cont extends CI_Controller{
    //Supports bulk upload of data
    public function __construct()
    {
        parent::__construct();
        $this->load->library('csvimport');
    }
    public function chart($offset=0){
        $config['base_url']=base_url().'index.php/Admin_cont/chart/';
        $config['total_rows']=$this->db->count_all('chart');
        $config['per_page']=10;
        $config['url_segment']=3;
        $config['attributes']=array('class'=>'pagination-link');
        $this->pagination->initialize($config);
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        $data['chart']=$this->Admin_model->fetch_comment(FALSE,$config['per_page'],$offset);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/chart');
        $this->load->view('admin/admin_inc/footer1');
    }
    public function listView(){
        $data = array();
        // Fetch all records
        $data['chart'] = $this->Admin_model->getRow();
        // Load the list view
        $this->load->view('admin/chart_view', $data);
    }
    public function chartAction(){
        $error='';
        $comment_name='';
        $comment_content='';
        if(empty($_POST["comment_name"])){
            $error .='<div class="alert alert-danger">Name is required</div>';
        }
        else{
            $comment_name=$_POST['comment_name'];
        }
        if(empty($_POST["comment_content"])){
            $error .='<div class="alert alert-danger">Content is required</div>';
        }
        else{
            $comment_content=$_POST['comment_content'];
        }
        if($error == ''){
            $qry=array(
                'parent_comment_id'=>$_POST['comment_id'],
                'comment_name'=>$comment_name,
                'comment_content'=>$comment_content
            );
            $res=$this->Admin_model->insert_chart($qry);
            if($res){
                $error='<div class="alert alert-success">Comment added</div>';
            }
            else{
                $error='<div class="alert alert-danger">Sorry!! an error occurred while posting. Please try again.</div>';
            }
        }
        $data=array(
            'error'=>$error
        );
        echo json_encode($data);
    }
    public function retrieveComment(){

    }


    public function getComment(){
        $output='';
        $data=$this->Admin_model->fetch_comment();
        $output .='
        <div class="table-responsive">
        <table class="table table-bordered table-hover">
        <tr>
            <th>S/N</th>
            <th>Name</th>
            <th>Comment</th>
        </tr>
        ';
        if($data->num_rows()>0){
            $count=1;
            foreach ($data->result() as $row){
                $output.='
                <tr>
                    <td>'.$count.'</td>
                    <td>'.$row->comment_name.'</td>
                    <td>'.$row->comment_content.'</td>
                </tr>
                ';
                $count++;
            }
        }
        else{
            $output.='
	        <tr class="col-md-12">
	        <td><div class="alert alert-danger">No Data Found</div></td>
            </tr>
	        ';
        }
        $output.='</table>';
        $output.='</div>';
        echo $output;
    }
public function index(){//countMembers
    $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);//captures church details
    $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);//captures logged in user details
    $data['member_counts']=$this->Admin_model->countMembers($this->session->userdata['church']);
    $data['department_counts']=$this->Admin_model->countDepartments($this->session->userdata['church']);
    $data['ministry_counts']=$this->Admin_model->countMinistries($this->session->userdata['church']);
    $data['project_counts']=$this->Admin_model->countProjects($this->session->userdata['church']);
    $this->load->view('admin/admin_inc/top_section1',$data);
    $this->load->view('admin/admin_inc/side_section1');
    $this->load->view('admin/index');
    $this->load->view('admin/admin_inc/footer1');
}
    public function members(){ //use this one
        //print_r($this->Admin_model->getMaxId2());// net inakaa ikidisconnect but let proceed
        /*$max=$this->Admin_model->getMaxId2();
         print_r($max);

        exit();*/
        if(isset($_POST['search_input'])){
            $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
            $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
            $data['members']=$this->Admin_model->searchData($_POST,$this->session->userdata['church']);
            $data['max']=$this->Admin_model->getMaxId($this->session->userdata['church']);//
            $data['gender']=$this->Admin_model->getGender();
            $data['county']=$this->Admin_model->getCounty();
            $data['member_counts']=$this->Admin_model->countSearchMembers($_POST,$this->session->userdata['church']);
            $this->load->view('admin/admin_inc/top_section1',$data);
            $this->load->view('admin/admin_inc/side_section1');
            $this->load->view('admin/members');
            $this->load->view('admin/admin_inc/footer1');
        }
        elseif (isset($_POST['daterange_btn'])){
            $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
            $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
            $data['members']=$this->Admin_model->searchByDate($_POST,$this->session->userdata['church']);
            $data['max']=$this->Admin_model->getMaxId($this->session->userdata['church']);//
            $data['gender']=$this->Admin_model->getGender();
            $data['county']=$this->Admin_model->getCounty();
            $data['member_counts']=$this->Admin_model->countSearch1Members($_POST,$this->session->userdata['church']);
            $this->load->view('admin/admin_inc/top_section1',$data);
            $this->load->view('admin/admin_inc/side_section1');
            $this->load->view('admin/members');
            $this->load->view('admin/admin_inc/footer1');
        }
        else{
            $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
            $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
            $data['members']=$this->Admin_model->getMembers($this->session->userdata['church']);
            $data['max']=$this->Admin_model->getMaxId($this->session->userdata['church']);//
            $data['gender']=$this->Admin_model->getGender();
            $data['county']=$this->Admin_model->getCounty();
            $data['member_counts']=$this->Admin_model->countMembers($this->session->userdata['church']);
            $this->load->view('admin/admin_inc/top_section1',$data);
            $this->load->view('admin/admin_inc/side_section1');
            $this->load->view('admin/members');
            $this->load->view('admin/admin_inc/footer1');
        }
    }
    public function visitors(){
    if(isset($_POST['daterange_btn'])){
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        $data['visitors']=$this->Admin_model->searchByDateRange($_POST,$this->session->userdata['church']);
        $data['visitors_count']=$this->Admin_model->countSearch1Visitors($_POST,$this->session->userdata['church']);
        $data['gender']=$this->Admin_model->getGender();
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/visitors');
        $this->load->view('admin/admin_inc/footer1');
    }
    else{
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        $data['visitors']=$this->Admin_model->getVisitors($this->session->userdata['church']);
        $data['visitors_count']=$this->Admin_model->countVisitors($this->session->userdata['church']);
        $data['gender']=$this->Admin_model->getGender();
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/visitors');
        $this->load->view('admin/admin_inc/footer1');
    }
    }
    public function departments(){
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        $data['dept']=$this->Admin_model->getDepartments($this->session->userdata['church']);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/department');
        $this->load->view('admin/admin_inc/footer1');
    }
    public function department_heads(){
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        $data['members']=$this->Admin_model->getMembers($this->session->userdata['church']);
        $data['dept']=$this->Admin_model->getDepartments($this->session->userdata['church']);
        $data['heads']=$this->Admin_model->getDepartmentHeads($this->session->userdata['church']);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/department_heads');
        $this->load->view('admin/admin_inc/footer1');
    }
    public function ministries(){
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        $data['ministries']=$this->Admin_model->getMinistries($this->session->userdata['church']);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/ministries');
        $this->load->view('admin/admin_inc/footer1');
    }
    public function ministry_members($mi){
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        //$data['ministry']=$this->Admin_model->getMinistryConditionally($mi);
        $data['members']=$this->Admin_model->getMembers($this->session->userdata['church']);
        $data['ministry_members']=$this->Admin_model->getMinistry_members($mi,$this->session->userdata['church']);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/ministry_members');
        $this->load->view('admin/admin_inc/footer1');
    }
    public function ministry_heads(){
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        $data['ministries']=$this->Admin_model->getMinistries($this->session->userdata['church']);
        $data['members']=$this->Admin_model->getMembers($this->session->userdata['church']);
        $data['heads']=$this->Admin_model->getMinistryHeads($this->session->userdata['church']);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/ministry_heads');
        $this->load->view('admin/admin_inc/footer1');
    }
    public function vote_heads(){
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        $data['v_heads']=$this->Admin_model->getVoteHead($this->session->userdata['church']);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/vote_heads');
        $this->load->view('admin/admin_inc/footer1');
    }
    public function income_vote_heads(){
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        $data['income_head']=$this->Admin_model->getIncomeHead($this->session->userdata['church']);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/income_vote_head');
        $this->load->view('admin/admin_inc/footer1');
    }
    public function income(){
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        //$data['income_head']=$this->Admin_model->getIncomeHead($this->session->userdata['church']);
        $data['income_head']=$this->Admin_model->getIncomeVoteHead($this->session->userdata['church']);
        $data['income']=$this->Admin_model->getIncome($this->session->userdata['church']);
        $data['totalIncome']=$this->Admin_model->getTotalIncome($this->session->userdata['church']);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/income');
        $this->load->view('admin/admin_inc/footer1');
    }
    public function expense_vote_heads(){
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        $data['expense_head']=$this->Admin_model->getExpenseHead($this->session->userdata['church']);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/expense_vote_head');
        $this->load->view('admin/admin_inc/footer1');
    }
    public function expense(){
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        $data['expense_head']=$this->Admin_model->getExpenseVoteHead($this->session->userdata['church']);
        $data['expense']=$this->Admin_model->getExpense($this->session->userdata['church']);
        $data['totalExpense']=$this->Admin_model->getTotalExpense($this->session->userdata['church']);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/expense');
        $this->load->view('admin/admin_inc/footer1');
    }
    public function setting(){
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        $data['county']=$this->Admin_model->getCounty();
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/setting');
        $this->load->view('admin/admin_inc/footer1');
    }
    public function events(){
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        $data['events']=$this->Admin_model->getEvents($this->session->userdata['church']);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/events');
        $this->load->view('admin/admin_inc/footer1');
    }
    public function sermons(){
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        $data['sermons']=$this->Admin_model->getSermons($this->session->userdata['church']);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/sermons');
        $this->load->view('admin/admin_inc/footer1');
    }
    public function tithes_givings(){
    if(isset($_POST['daterange_btn'])){
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        $data['members']=$this->Admin_model->getMembers($this->session->userdata['church']);
        $data['category']=$this->Admin_model->getCategory($this->session->userdata['church']);
        $data['offering']=$this->Admin_model->searchOfferingByDate($_POST,$this->session->userdata['church']);
        $data['active_project']=$this->Admin_model->getActiveProjects($this->session->userdata['church']);
        $data['total_offering']=$this->Admin_model->searchTotalContribution($_POST,$this->session->userdata['church']);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/tithes_givings');
        $this->load->view('admin/admin_inc/footer1');
    }
    elseif (isset($_POST['randomsearch_btn'])){
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        $data['members']=$this->Admin_model->getMembers($this->session->userdata['church']);
        $data['category']=$this->Admin_model->getCategory($this->session->userdata['church']);
        $data['offering']=$this->Admin_model->searchRandomly($_POST,$this->session->userdata['church']);
        $data['active_project']=$this->Admin_model->getActiveProjects($this->session->userdata['church']);
        $data['total_offering']=$this->Admin_model->searchTotalRandomly($_POST,$this->session->userdata['church']);
        //$data['total_pendingoffering']=$this->Admin_model->searchTotalRandomlyPending($this->session->userdata['church']);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/tithes_givings');
        $this->load->view('admin/admin_inc/footer1');
    }
    else{
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        $data['members']=$this->Admin_model->getMembers($this->session->userdata['church']);
        $data['category']=$this->Admin_model->getCategory($this->session->userdata['church']);
        $data['offering']=$this->Admin_model->getOfferings($this->session->userdata['church']);
        $data['active_project']=$this->Admin_model->getActiveProjects($this->session->userdata['church']);
        $data['total_offering']=$this->Admin_model->getTotalContribution($this->session->userdata['church']);
        $data['total_pendingoffering']=$this->Admin_model->getTotalContributionPending($this->session->userdata['church']);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/tithes_givings');
        $this->load->view('admin/admin_inc/footer1');
    }
    }
    public function baptism(){
    if(isset($_POST['seachbap_btn'])){
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        $data['members']=$this->Admin_model->getMembers($this->session->userdata['church']);
        $data['baptism']=$this->Admin_model->searchBaptismRecords1($_POST,$this->session->userdata['church']);
        $data['baptised_members']=$this->Admin_model->searchBaptismRecords1Count($_POST,$this->session->userdata['church']);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/baptism');
        $this->load->view('admin/admin_inc/footer1');
    }
    elseif (isset($_POST['searchbap1_btn'])){
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        $data['members']=$this->Admin_model->getMembers($this->session->userdata['church']);
        $data['baptism']=$this->Admin_model->searchBaptismRecordsRandomly($_POST,$this->session->userdata['church']);
        $data['baptised_members']=$this->Admin_model->searchBaptismRecordsRandomly1($_POST,$this->session->userdata['church']);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/baptism');
        $this->load->view('admin/admin_inc/footer1');
    }
    else{
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        $data['members']=$this->Admin_model->getMembers($this->session->userdata['church']);
        $data['baptism']=$this->Admin_model->getBaptisedMembers($this->session->userdata['church']);
        $data['baptised_members']=$this->Admin_model->countBaptisedMembers($this->session->userdata['church']);
        //$data['active_project']=$this->Admin_model->getActiveProjects($this->session->userdata['church']);
        //$data['total_offering']=$this->Admin_model->getTotalContribution($this->session->userdata['church']);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/baptism');
        $this->load->view('admin/admin_inc/footer1');
    }

    }
    public function category(){
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        $data['category']=$this->Admin_model->getCategory($this->session->userdata['church']);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/category');
        $this->load->view('admin/admin_inc/footer1');
    }
    public function general_offering(){
    if(isset($_POST['daterange_btn'])){
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        $data['category']=$this->Admin_model->getCategory($this->session->userdata['church']);
        $data['general']=$this->Admin_model->searchGeneralOffering($_POST, $this->session->userdata['church']);
        $data['totalgeneral']=$this->Admin_model->searchTotalGeneralOffering($_POST,$this->session->userdata['church']);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/general_offerings');
        $this->load->view('admin/admin_inc/footer1');
    }
    else{
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        $data['category']=$this->Admin_model->getCategory($this->session->userdata['church']);
        $data['general']=$this->Admin_model->getGeneralOffering($this->session->userdata['church']);
        $data['totalgeneral']=$this->Admin_model->getTotalGeneralOffering($this->session->userdata['church']);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/general_offerings');
        $this->load->view('admin/admin_inc/footer1');
    }

    }
    public function projects(){
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        $data['project']=$this->Admin_model->getProjects($this->session->userdata['church']);
        $data['active_project']=$this->Admin_model->getOngoingProjects($this->session->userdata['church']);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/projects');
        $this->load->view('admin/admin_inc/footer1');
    }
    public function update_password(){
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        //$data['project']=$this->Admin_model->getProjects($this->session->userdata['church']);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/update_password');
        $this->load->view('admin/admin_inc/footer1');
    }
    public function personal_details(){
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        //$data['project']=$this->Admin_model->getProjects($this->session->userdata['church']);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/update_personal_details');
        $this->load->view('admin/admin_inc/footer1');
    }
    public function billing(){
        $data['church']=$this->Admin_model->getChurchDetails($this->session->userdata['church']);
        $data['member']=$this->Admin_model->getLoggedinUserDetails($this->session->userdata['id']);
        $this->load->view('admin/admin_inc/top_section1',$data);
        $this->load->view('admin/admin_inc/side_section1');
        $this->load->view('admin/billing');
        $this->load->view('admin/admin_inc/footer1');
    }
    /*-----------------------INSERT QUERIES STARTS HERE--------------------------*/
    public function add_member(){
        if(isset($_POST['addmember_btn'])){
        $confirm=$this->Admin_model->confirm_membership($this->input->post('membership_no'),$this->session->userdata('church'));
        if($confirm){
            $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>A Member already exist with the provided membership number.</div>');
            redirect('Admin_cont/members');
        }
        else{
            $member_data=array(
                'member_no'=>$this->input->post('membership_no'),
                'm_firstname'=>$this->input->post('first_name'),
                'm_middlename'=>$this->input->post('middle_name'),
                'm_lastname'=>$this->input->post('last_name'),
                'm_nationalid'=>$this->input->post('national_id'),
                'm_phone'=>$this->input->post('phone_number'),
                'm_email'=>$this->input->post('email_address'),
                'm_gender'=>$this->input->post('gender'),
                'm_placeofbirth'=>$this->input->post('place_of_birth'),
                'm_residenceplace'=>$this->input->post('residence_place'),
                'm_dob'=>$this->input->post('dob'),
                'm_joiningdate'=>$this->input->post('joining_date'),
                'church'=>$this->session->userdata['church'],
                'created_by'=>$this->session->userdata['id'],
                'status'=>'Active',
                'role'=>'Member',
                'password'=>password_hash('1234',PASSWORD_DEFAULT)
            );
            $addmember=$this->Admin_model->add_member($member_data);
            if($addmember){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Member details successfully saved.</div>');
                redirect('Admin_cont/members');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Member details not saved. Please try again.</div>');
                redirect('Admin_cont/members');
            }
        }

        }
    }
    public function members_bulk_upload()
    {
        $file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
        foreach($file_data as $row)
        {
            $church=$this->session->userdata['church'];
            $created_by=$this->session->userdata['id'];
            $role='Member';
            $status='Active';
            $m_joiningdate=date('Y-m-d');
            $pass=1234;
            $data[]= array(
                'member_no'=>$row['Member No'],
                'm_firstname' => $row['First Name'],
                'm_middlename' =>$row['Middle Name'],
                'm_lastname' =>$row['Last Name'],
                'm_gender' =>$row['Gender'],
                'm_nationalid' =>$row['National Id'],
                'm_phone' =>$row['Phone'],
                'm_placeofbirth' =>$row['Place of Birth'],
                'm_residenceplace' =>$row['Residence'],
                'm_dob' =>$row['Dob'],
                'm_email' =>$row['Email'],
                'role'=>$role,
                'status'=>$status,
                'church'=>$church,
                'created_by'=>$created_by,
                'm_joiningdate'=>$m_joiningdate,
                'password'=>password_hash($pass,PASSWORD_DEFAULT)
            );
        }
        $import=$this->Admin_model->members_bulk_upload($data);
        if($import){
            $this->session->set_flashdata('message', ' <div class="alert alert-danger">Sorry! an error Occurred while trying to upload the data. Please try again.<button class="close" data-dismiss="alert" >&times;</button></div>');
            redirect('Admin_cont/members');
        }
        else{

            $this->session->set_flashdata('message', ' <div class="alert alert-success">Members data Successfully Uploaded.<button class="close" data-dismiss="alert" >&times;</button></div>');
            redirect('Admin_cont/members');
        }

    }
    public function add_visitor(){
        if(isset($_POST['addvisitor_btn'])){
            $visitor_data=array(
                'v_firstname'=>$this->input->post('first_name'),
                'v_middlename'=>$this->input->post('middle_name'),
                'v_lastname'=>$this->input->post('last_name'),
                'v_phone'=>$this->input->post('phone_number'),
                'v_email'=>$this->input->post('email_address'),
                'v_gender'=>$this->input->post('gender'),
                'v_residenceplace'=>$this->input->post('residence_place'),
                'about_us'=>$this->input->post('about_us'),
                'v_visitingdate'=>$this->input->post('visiting_date'),
                'church'=>$this->session->userdata['church'],
                'created_by'=>$this->session->userdata['id'],
            );
            $addvisitor=$this->Admin_model->add_visitor($visitor_data);
            if($addvisitor){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Visitor details successfully saved.</div>');
                redirect('Admin_cont/visitors');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Visitor details not saved. Please try again.</div>');
                redirect('Admin_cont/visitors');
            }
        }
    }
    public function add_department(){
        if(isset($_POST['department_btn'])){
            $dept_data=array(
                'department_name'=>$this->input->post('department_name'),
                'church'=>$this->session->userdata['church'],
                'created_by'=>$this->session->userdata['id']
            );
            $qry=$this->Admin_model->add_department($dept_data);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Department successfully added.</div>');
                redirect('Admin_cont/departments');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Department not added. Please try again.</div>');
                redirect('Admin_cont/departments');
            }
        }
    }
    public function add_departmenthead(){
        if(isset($_POST['depthead_btn'])){
            $head_details=array(
                'dept_id'=>$this->input->post('department'),
                'head_id'=>$this->input->post('member'),
                'start_date'=>$this->input->post('start_date'),
                'h_status'=>'Active',
                'church'=>$this->session->userdata['church'],
                'created_by'=>$this->session->userdata['id'],
            );
            $qry=$this->Admin_model->add_department_head($head_details);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Department head successfully assigned.</div>');
                redirect('Admin_cont/department_heads');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Department head not assigned. Please try again.</div>');
                redirect('Admin_cont/department_heads');
            }
        }
    }
    public function add_ministry(){
        if(isset($_POST['ministry_btn'])){
            $dept_data=array(
                'ministry_name'=>$this->input->post('ministry'),
                'church'=>$this->session->userdata['church'],
                'created_by'=>$this->session->userdata['id'],
            );
            $qry=$this->Admin_model->add_ministry($dept_data);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Ministry successfully added.</div>');
                redirect('Admin_cont/ministries');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Ministry not added. Please try again.</div>');
                redirect('Admin_cont/ministries');
            }
        }
    }
    public function add_ministryhead(){
        if(isset($_POST['ministryhead_btn'])){
            $head_details=array(
                'ministry_id'=>$this->input->post('ministry'),
                'head_id'=>$this->input->post('member'),
                'start_date'=>$this->input->post('start_date'),
                'm_status'=>'Active',
                'church'=>$this->session->userdata['church'],
                'created_by'=>$this->session->userdata['id'],
            );
            $qry=$this->Admin_model->add_ministry_head($head_details);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Ministry head successfully assigned.</div>');
                redirect('Admin_cont/ministry_heads');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Ministry head not assigned. Please try again.</div>');
                redirect('Admin_cont/ministry_heads');
            }
        }
    }
    public function add_category(){
        if(isset($_POST['category_btn'])){
            $head_details=array(
                'category_name'=>$this->input->post('category'),
                'church'=>$this->session->userdata['church'],
                'created_by'=>$this->session->userdata['id'],
            );
            $qry=$this->Admin_model->add_category($head_details);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Category successfully added.</div>');
                redirect('Admin_cont/category');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Category not added. Please try again.</div>');
                redirect('Admin_cont/category');
            }
        }
    }
    public function add_offering(){
        if(isset($_POST['offering_btn'])){
            $head_details=array(
                'member'=>$this->input->post('member'),
                'category'=>$this->input->post('category'),
                'amount'=>$this->input->post('amount'),
                'pay_mode'=>$this->input->post('pay_mode'),
                'p_status'=>$this->input->post('status'),
                'payment_date'=>$this->input->post('pay_date'),
                'proj'=>$this->input->post('project'),
                'church'=>$this->session->userdata['church'],
                'created_by'=>$this->session->userdata['id'],
                'transaction_code'=>$this->input->post('t_code'),
                'description'=>$this->input->post('description')
            );
            $qry=$this->Admin_model->add_offering($head_details);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Offering successfully added.</div>');
                redirect('Admin_cont/tithes_givings');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Offering not added. Please try again.</div>');
                redirect('Admin_cont/tithes_givings');
            }
        }
    }
    public function add_generaloffering(){
        if(isset($_POST['generaloffering_btn'])){
            $details=array(
                'payment_date'=>$this->input->post('date'),
                'amount'=>$this->input->post('amount'),
                'church'=>$this->session->userdata['church'],
                'created_by'=>$this->session->userdata['id'],
                'description'=>$this->input->post('comment')
            );
            $qry=$this->Admin_model->add_offering($details);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Offering successfully added.</div>');
                redirect('Admin_cont/general_offering');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Offering not added. Please try again.</div>');
                redirect('Admin_cont/general_offering');
            }
        }
    }
    public function add_event(){
        if(isset($_POST['event_btn'])){
            $head_details=array(
                'event_name'=>$this->input->post('event_name'),
                'start_date'=>$this->input->post('start_date'),
                'end_date'=>$this->input->post('end_date'),
                'description'=>$this->input->post('description'),
                'church'=>$this->session->userdata['church'],
                'created_by'=>$this->session->userdata['id'],
            );
            $qry=$this->Admin_model->add_event($head_details);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Event successfully added.</div>');
                redirect('Admin_cont/events');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Event not added. Please try again.</div>');
                redirect('Admin_cont/events');
            }
        }
    }
    public function add_sermon(){
        if(isset($_POST['sermon_btn'])){
            //$id=$this->uri->segment(3);
            $dept_data=array(
                'sermon_title'=>$this->input->post('sermon_title'),
                'description'=>$this->input->post('sermon_description'),
                'added_date'=>$this->input->post('sermon_date'),
                'church'=>$this->session->userdata['church'],
                'created_by'=>$this->session->userdata['id'],
            );
            $update_dept=$this->Admin_model->add_sermon($dept_data);
            if($update_dept){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Sermon successfully created.</div>');
                redirect('Admin_cont/sermons');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Sermon not created. Please try again.</div>');
                redirect('Admin_cont/sermons');
            }

        }
    }
    public function add_project(){
        if(isset($_POST['project_btn'])){
            $head_details=array(
                'project_name'=>$this->input->post('project_name'),
                'project_description'=>$this->input->post('description'),
                'start_date'=>$this->input->post('start_date'),
                //'end_date'=>$this->input->post('end_date'),
                'status'=>$this->input->post('status'),
                'church'=>$this->session->userdata['church'],
                'created_by'=>$this->session->userdata['id']
            );
            $qry=$this->Admin_model->add_project($head_details);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Project successfully added.</div>');
                redirect('Admin_cont/projects');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Project not added. Please try again.</div>');
                redirect('Admin_cont/projects');
            }
        }
    }
    public function add_ministry_member(){
        if(isset($_POST['addministrymember_btn'])){
            $details=array(
                'ministry_id'=>$this->input->post('ministry_id'),
                'member_id'=>$this->input->post('member_name'),
                'start_date'=>$this->input->post('start_date'),
                'member_status'=>'Active',
                'church'=>$this->session->userdata['church'],
                'created_by'=>$this->session->userdata['id'],
            );
            $qry=$this->Admin_model->add_ministry_member($details);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Member successfully added.</div>');
                redirect('Admin_cont/ministry_members/'.$this->input->post('ministry_id'));
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Member not added. Please try again.</div>');
                redirect('Admin_cont/ministry_members/'.$this->input->post('ministry_id'));
            }
        }
    }
    public function add_baptism(){
        if(isset($_POST['baptism_btn'])){
           /* //load mpdf library
            $this->load->library('pdf');
            $pdf=$this->pdf->load();

            ini_set('memory_limit','256M');
            //setting the view to HTML
            $html=$this->load->view('admin/test',true);
            $pdf->WriteHTML($html);//writing html into the pdf
            $d=new DateTime();
            $date=$d->format('d/m/y h:i:s a');
            $pdf->SetHTMLFooter('<div class="pdf-footer">
            <strong>Test: </strong> <i>If found Kindly Surrender the card to the church.</i>
            <hr>
            <i>Generated on '.$date.'</i>
            </div>
            ');
            $output=$this->input->post('member').'_'.date('Y_m_d_H_i').'.pdf';
            $pdf->Output($this->config->item('file_path').$output,'F');*/

           $confirm=$this->Admin_model->check_baptism($this->input->post('member'));
           if($confirm){
               $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>The member baptism records already exist.</div>');
               redirect('Admin_cont/baptism');
           }
           else{
               $details=array(
                   'member'=>$this->input->post('member'),
                   'date_of_baptism'=>$this->input->post('date_of_baptism'),
                   'comment'=>$this->input->post('comment'),
                   'church'=>$this->session->userdata['church'],
                   'pastor'=>$this->session->userdata['id'],
                   //'baptism_cert'=>$output
               );
               $qry=$this->Admin_model->add_baptism($details);

               if($qry){
                   $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Details successfully saved.</div>');
                   redirect('Admin_cont/baptism');
               }
               else{
                   $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Details not saved. Please try again.</div>');
                   redirect('Admin_cont/baptism');
               }
           }

        }
    }
    public function add_incomehead(){
        if(isset($_POST['incomehead_btn'])){
            $details=array(
                'head_name'=>$this->input->post('income_name'),
                'church'=>$this->session->userdata['church'],
                'created_by'=>$this->session->userdata['id']
            );
            $qry=$this->Admin_model->add_income_head($details);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Income head successfully added.</div>');
                redirect('Admin_cont/income_vote_heads');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Income head not added. Please try again.</div>');
                redirect('Admin_cont/income_vote_heads');
            }
        }
    }
    public function add_income(){
        if(isset($_POST['income_btn'])){
            $details=array(
                'income_head'=>$this->input->post('income_head'),
                'amount'=>$this->input->post('income_amount'),
                'date'=>$this->input->post('date'),
                'church'=>$this->session->userdata['church'],
                'created_by'=>$this->session->userdata['id']
            );
            $qry=$this->Admin_model->add_income($details);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Income successfully recorded.</div>');
                redirect('Admin_cont/income');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Income not recorded. Please try again.</div>');
                redirect('Admin_cont/income');
            }
        }
    }
    public function add_expensehead(){
        if(isset($_POST['expensehead_btn'])){
            $details=array(
                'head_name'=>$this->input->post('expense_name'),
                'church'=>$this->session->userdata['church'],
                'created_by'=>$this->session->userdata['id']
            );
            $qry=$this->Admin_model->add_expense_head($details);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Expense head successfully added.</div>');
                redirect('Admin_cont/expense_vote_heads');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Expense head not added. Please try again.</div>');
                redirect('Admin_cont/expense_vote_heads');
            }
        }
    }
    public function add_expense(){
        if(isset($_POST['expense_btn'])){
            $details=array(
                'expense_head'=>$this->input->post('expense_head'),
                'amount'=>$this->input->post('expense_amount'),
                'date'=>$this->input->post('date'),
                'description'=>$this->input->post('description'),
                'church'=>$this->session->userdata['church'],
                'created_by'=>$this->session->userdata['id']
            );
            $qry=$this->Admin_model->add_expense($details);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Expense successfully recorded.</div>');
                redirect('Admin_cont/expense');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Expense not recorded. Please try again.</div>');
                redirect('Admin_cont/expense');
            }
        }
    }
    public function add_votehead(){
        if(isset($_POST['votehead_btn'])){
            $data=array(
                'vote_head_name'=>$this->input->post('vote_head'),
                'category'=>$this->input->post('category'),
                'church'=>$this->session->userdata['church'],
                'created_by'=>$this->session->userdata['id']
            );
            $qry=$this->Admin_model->add_votehead($data);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Vote head successfully added.</div>');
                redirect('Admin_cont/vote_heads');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Vote head not added. Please try again.</div>');
                redirect('Admin_cont/vote_heads');
            }
        }
    }
    public function upload_logo(){//settings page
        if(isset($_POST['church_logo'])){
            $id=$this->uri->segment(3);
            $file_name='logo';
            $photo=$this->upload_photo($file_name);
            $log=array(
            'logo'=>$photo,
            );
            $qry=$this->Admin_model->updateChurchLogo($id,$log);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Church logo successfully updated.</div>');
                redirect('Admin_cont/setting');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Church logo not recorded. Please try again.</div>');
                redirect('Admin_cont/setting');
            }
        }
    }
    public function upload_indexlogo(){//index page
        if(isset($_POST['church_logo'])){
            $id=$this->uri->segment(3);
            $file_name='logo';
            $photo=$this->upload_photo($file_name);
            $log=array(
                'logo'=>$photo,
            );
            $qry=$this->Admin_model->updateChurchLogo($id,$log);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Church logo successfully updated.</div>');
                redirect('Admin_cont/index');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Church logo not recorded. Please try again.</div>');
                redirect('Admin_cont/index');
            }
        }
    }
    //function for uploading photo
    public function upload_photo($passport)
    {
        $field_name = $passport;
        $config['upload_path'] = 'assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2048';
        $config['max_width'] = '3000';
        $config['max_height'] = '2900';
        $config['encrypt_name'] = true;

        // $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($field_name))
        {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error occurred while processing the request.<button class="close" data-dismiss="alert" >&times;</button></div>');
        }
        else {
            $file_data = $this->upload->data();
            $filename = $file_data['file_name'];
            return $filename;
        }

    }
    /*-----------------------INSERT QUERIES ENDS HERE--------------------------*/

    /*----------------UPDATE QUERIES STARTS HERE-------------------*/
    public function updateVoteHead(){
        if(isset($_POST['updatevotehead_btn'])){
            $id=$this->uri->segment(3);
            $head_data=array(
                'vote_head_name'=>$this->input->post('vote_head'),
                'category'=>$this->input->post('category')
            );
            $update_votehead=$this->Admin_model->updateVoteHead($id,$head_data);
            if($update_votehead){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Vote head successfully updated.</div>');
                redirect('Admin_cont/vote_heads');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Vote head not updated. Please try again.</div>');
                redirect('Admin_cont/vote_heads');
            }

        }
    }
    public function update_member(){
        if(isset($_POST['updatemember_btn'])){
            $id=$this->uri->segment(3);
            $member_data=array(
                'm_firstname'=>$this->input->post('first_name'),
                'm_middlename'=>$this->input->post('middle_name'),
                'm_lastname'=>$this->input->post('last_name'),
                'm_nationalid'=>$this->input->post('national_id'),
                'm_phone'=>$this->input->post('phone_number'),
                'm_email'=>$this->input->post('email_address'),
                'm_gender'=>$this->input->post('gender'),
                'm_placeofbirth'=>$this->input->post('place_of_birth'),
                'm_residenceplace'=>$this->input->post('residence_place'),
                'm_dob'=>$this->input->post('dob'),
                'm_joiningdate'=>$this->input->post('joining_date'),
            );
            $update_member=$this->Admin_model->updateMember($id,$member_data);
            if($update_member){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Member details successfully updated.</div>');
                redirect('Admin_cont/members');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Member details not updated. Please try again.</div>');
                redirect('Admin_cont/members');
            }

        }
    }
    public function update_visitor(){
    if(isset($_POST['updatevisitor_btn'])){
        $id=$this->uri->segment(3);
        $visitor_data=array(
            'v_firstname'=>$this->input->post('first_name'),
            'v_middlename'=>$this->input->post('middle_name'),
            'v_lastname'=>$this->input->post('last_name'),
            'v_phone'=>$this->input->post('phone_number'),
            'v_email'=>$this->input->post('email_address'),
            'v_gender'=>$this->input->post('gender'),
            'v_residenceplace'=>$this->input->post('residence_place'),
            'v_visitingdate'=>$this->input->post('visiting_date'),
        );
        $update_visitor=$this->Admin_model->updateVisitor($id,$visitor_data);
        if($update_visitor){
            $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Visitor details successfully updated.</div>');
            redirect('Admin_cont/visitors');
        }
        else{
            $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Visitor details not updated. Please try again.</div>');
            redirect('Admin_cont/visitors');
        }

    }
}
    public function update_department(){
        if(isset($_POST['updatedepartment_btn'])){
            $id=$this->uri->segment(3);
            $dept_data=array(
                'department_name'=>$this->input->post('department')
            );
            $update_dept=$this->Admin_model->updateDepartment($id,$dept_data);
            if($update_dept){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Department successfully updated.</div>');
                redirect('Admin_cont/departments');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Department not updated. Please try again.</div>');
                redirect('Admin_cont/departments');
            }

        }
    }
    public function update_department_head_status(){
        if(isset($_POST['updatestatus_btn'])){
            $id=$this->uri->segment(3);
            $dept_data=array(
                'h_status'=>$this->input->post('status')
            );
            $update_status=$this->Admin_model->updateDepartmentHead($id,$dept_data);
            if($update_status){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Status successfully updated.</div>');
                redirect('Admin_cont/department_heads');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Status not updated. Please try again.</div>');
                redirect('Admin_cont/department_heads');
            }

        }
    }
    public function update_ministry(){
        if(isset($_POST['updateministry_btn'])){
            $id=$this->uri->segment(3);
            $dept_data=array(
                'ministry_name'=>$this->input->post('ministry')
            );
            $update_dept=$this->Admin_model->updateMinistry($id,$dept_data);
            if($update_dept){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Ministry details successfully updated.</div>');
                redirect('Admin_cont/ministries');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Ministry details not updated. Please try again.</div>');
                redirect('Admin_cont/ministries');
            }

        }
    }
    public function update_ministry_head_status(){
        if(isset($_POST['updatestatus_btn'])){
            $id=$this->uri->segment(3);
            $dept_data=array(
                'm_status'=>$this->input->post('status')
            );
            $update_status=$this->Admin_model->updateMinistryHead($id,$dept_data);
            if($update_status){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Status successfully updated.</div>');
                redirect('Admin_cont/ministry_heads');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Status not updated. Please try again.</div>');
                redirect('Admin_cont/ministry_heads');
            }

        }
    }
    public function update_ministry_member_status(){
        if(isset($_POST['updateministrymemberstatus_btn'])){
            $id=$this->uri->segment(3);
            $ministry=$this->input->post('ministry_id');
            $data=array(
                'member_status'=>$this->input->post('status')
            );
            $update_status=$this->Admin_model->updateMinistryMemberStatus($id,$data);
            if($update_status){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Status successfully updated.</div>');
                redirect('Admin_cont/ministry_members/'.$ministry);
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Status not updated. Please try again.</div>');
                redirect('Admin_cont/ministry_members/'.$ministry);
            }

        }
    }
    public function update_category(){
        if(isset($_POST['updatecategory_btn'])){
            $id=$this->uri->segment(3);
            $dept_data=array(
                'category_name'=>$this->input->post('category')
            );
            $update_dept=$this->Admin_model->updateCategory($id,$dept_data);
            if($update_dept){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Category details successfully updated.</div>');
                redirect('Admin_cont/category');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Category details not updated. Please try again.</div>');
                redirect('Admin_cont/category');
            }

        }
    }
    public function update_event(){
        if(isset($_POST['updateevent_btn'])){
            $id=$this->uri->segment(3);
            $dept_data=array(
                'event_name'=>$this->input->post('event_title'),
                'start_date'=>$this->input->post('start_date'),
                'end_date'=>$this->input->post('end_date'),
                'description'=>$this->input->post('description')
            );
            $update_dept=$this->Admin_model->updateEvent($id,$dept_data);
            if($update_dept){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Event details successfully updated.</div>');
                redirect('Admin_cont/events');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Event details not updated. Please try again.</div>');
                redirect('Admin_cont/events');
            }

        }
    }
    public function update_sermon(){
        if(isset($_POST['updatesermon_btn'])){
            $id=$this->uri->segment(3);
            $dept_data=array(
                'sermon_title'=>$this->input->post('sermon_title'),
                'description'=>$this->input->post('description'),
                'added_date'=>$this->input->post('added_date')
            );
            $update_dept=$this->Admin_model->updateSermon($id,$dept_data);
            if($update_dept){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Sermon details successfully updated.</div>');
                redirect('Admin_cont/sermons');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Sermon details not updated. Please try again.</div>');
                redirect('Admin_cont/sermons');
            }

        }
    }
    public function update_project(){
        if(isset($_POST['updateproject_btn'])){
            $id=$this->uri->segment(3);
            $dept_data=array(
                'project_name'=>$this->input->post('project_name'),
                'start_date'=>$this->input->post('start_date'),
                'end_date'=>$this->input->post('end_date'),
                'project_description'=>$this->input->post('description'),
                'status'=>$this->input->post('status')
            );
            $update_dept=$this->Admin_model->updateProject($id,$dept_data);
            if($update_dept){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Project details successfully updated.</div>');
                redirect('Admin_cont/projects');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Project details not updated. Please try again.</div>');
                redirect('Admin_cont/projects');
            }

        }
    }
    public function updateChurchDetails(){
        if(isset($_POST['updateChurch_btn'])){
            $id=$this->uri->segment(3);
            $data=array(
                'church_name'=>$this->input->post('church_name'),
                'phone'=>$this->input->post('phone'),
                'email'=>$this->input->post('email'),
                'county'=>$this->input->post('county'),
                'location'=>$this->input->post('location'),
                'motto'=>$this->input->post('motto'),
            );
            $qry=$this->Admin_model->updateChurchDetails($id,$data);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Church details successfully updated.</div>');
                redirect('Admin_cont/setting');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Church details not updated. Please try again.</div>');
                redirect('Admin_cont/setting');
            }
        }
    }
    public function update_offering(){
        if(isset($_POST['updateoffering_btn'])){
            $id=$this->uri->segment(3);
            $details=array(
                'member'=>$this->input->post('member'),
                'category'=>$this->input->post('category'),
                'amount'=>$this->input->post('amount'),
                //'pay_mode'=>$this->input->post('pay_mode'),
                'p_status'=>$this->input->post('status'),
                'description'=>$this->input->post('description')
            );
            $qry=$this->Admin_model->updateOffering($id,$details);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Offering successfully updated.</div>');
                redirect('Admin_cont/tithes_givings');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Offering not updated. Please try again.</div>');
                redirect('Admin_cont/tithes_givings');
            }
        }
    }
    public function update_generaloffering(){
        if(isset($_POST['updategeneraloffering_btn'])){
            $id=$this->uri->segment(3);
            $details=array(
                'payment_date'=>$this->input->post('date'),
                'amount'=>$this->input->post('amount'),
                'description'=>$this->input->post('comment')
            );
            $qry=$this->Admin_model->updateOffering($id,$details);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Offering successfully updated.</div>');
                redirect('Admin_cont/general_offering');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Offering not updated. Please try again.</div>');
                redirect('Admin_cont/general_offering');
            }
        }
    }
    public function update_incomehead(){
        if(isset($_POST['updateincomehead_btn'])){
            $id=$this->uri->segment(3);
            $details=array(
                'head_name'=>$this->input->post('income_name'),
                //'church'=>$this->session->userdata['church'],
                //'created_by'=>$this->session->userdata['id']
            );
            $qry=$this->Admin_model->updateIncomeHead($id,$details);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Income head successfully updated.</div>');
                redirect('Admin_cont/income_vote_heads');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Income head not updated. Please try again.</div>');
                redirect('Admin_cont/income_vote_heads');
            }
        }
    }
    public function update_income(){
        if(isset($_POST['updateincome_btn'])){
            $id=$this->uri->segment(3);
            $details=array(
                'income_head'=>$this->input->post('income_head'),
                'amount'=>$this->input->post('income_amount'),
                'date'=>$this->input->post('date')
            );
            $qry=$this->Admin_model->updateIncome($id,$details);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Income successfully updated.</div>');
                redirect('Admin_cont/income');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Income not updated. Please try again.</div>');
                redirect('Admin_cont/income');
            }
        }
    }
    public function update_expensehead(){
        if(isset($_POST['updateexpensehead_btn'])){
            $id=$this->uri->segment(3);
            $details=array(
                'head_name'=>$this->input->post('expense_name'),
                //'church'=>$this->session->userdata['church'],
                //'created_by'=>$this->session->userdata['id']
            );
            $qry=$this->Admin_model->updateExpenseHead($id,$details);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Expense head successfully updated.</div>');
                redirect('Admin_cont/expense_vote_heads');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Expense head not updated. Please try again.</div>');
                redirect('Admin_cont/expense_vote_heads');
            }
        }
    }
    public function update_expense(){
        if(isset($_POST['updateexpense_btn'])){
            $id=$this->uri->segment(3);
            $details=array(
                'expense_head'=>$this->input->post('expense_head'),
                'amount'=>$this->input->post('expense_amount'),
                'date'=>$this->input->post('date'),
                'description'=>$this->input->post('comment')
            );
            $qry=$this->Admin_model->updateExpense($id,$details);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Expense successfully updated.</div>');
                redirect('Admin_cont/expense');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Expense not updated. Please try again.</div>');
                redirect('Admin_cont/expense');
            }
        }
    }
    public function update_baptism(){
        if(isset($_POST['updatebaptism_btn'])){
            $id=$this->uri->segment(3);
            $details=array(
                'member'=>$this->input->post('member'),
                'date_of_baptism'=>$this->input->post('date'),
                'comment'=>$this->input->post('comment'),
            );
            $qry=$this->Admin_model->updateBaptism($id,$details);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Details successfully Updated.</div>');
                redirect('Admin_cont/baptism');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Details not updated. Please try again.</div>');
                redirect('Admin_cont/baptism');
            }
        }
    }


    /* PASSWORD ENCRIPTOR FUNCTIONS */
    function getHashedPassword($pass){
        $newhashed= password_hash($pass,PASSWORD_DEFAULT);
        return $newhashed;
    }

    function verifyPassword($inputPassword,$hashedPassword){
        if(password_verify($inputPassword,$hashedPassword)){
            return true;
        }
        else{
            return false;
        }
    }
    public function updatePassword(){//UPDATING ADMIN PASSWORD
        if(isset($_POST['updatepass_btn'])){
            $pass=$this->input->post('password');
            $pass1=$this->input->post('password2');
            $oldpass=$this->input->post('old_password');
            $old=$this->Site_model->confirm_churchadminpassword($this->session->userdata['admin_nationalid']);
            if($this->verifyPassword($oldpass, $old)){
                if($pass!=$pass1){
                    $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>SORRY! </strong>Your new password is not matching.</div>');
                    redirect('Admin_cont/update_password');
                }
                else{
                    $id=$this->uri->segment(3);
                    $details=array(
                        'admin_password'=>password_hash($this->input->post('password'),PASSWORD_DEFAULT)
                    );
                    $qry=$this->Admin_model->updatePassword($id,$details);
                    if($qry){
                        $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Password successfully updated.</div>');
                        redirect('Admin_cont/update_password');
                    }
                    else{
                        $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Password not updated. Please try again.</div>');
                        redirect('Admin_cont/update_password');
                    }
                }
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Old password is not matching.</div>');
                redirect('Admin_cont/update_password');
            }

        }
    }
    public function updateChurchAdminDetails(){//UPDATING CHURCH ADMIN DETAILS
        if(isset($_POST['updateadminDetails'])){
            $id=$this->uri->segment(3);
            $details=array(
                'title'=>$this->input->post('title'),
                'admin_fname'=>$this->input->post('fname'),
                'admin_lname'=>$this->input->post('lname'),
                'admin_phone'=>$this->input->post('phone'),
                'admin_email'=>$this->input->post('email'),
            );
            $qry=$this->Admin_model->updateChurchAdminDetails($id,$details);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Personal details successfully updated.</div>');
                redirect('Admin_cont/personal_details');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Personal details not updated. Please try again.</div>');
                redirect('Admin_cont/personal_details');
            }
        }
    }
    /*----------------UPDATE QUERIES ENDS HERE-------------------*/

    /*----------------------DELETE QUERY STARTS HERE-------------------------*/
    public function deletevotehead(){
        if(isset($_POST['deletevotehead_btn'])){
            $id=$this->uri->segment(3);
            $qry=$this->Admin_model->deletevotehead($id);
            if($qry){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Vote head successfully deleted.</div>');
                redirect('Admin_cont/vote_heads');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Vote head not deleted. Please try again later. </div>');
                redirect('Admin_cont/vote_heads');
            }
        }
    }
    public function deletemember(){
        if(isset($_POST['deletemember_btn'])){
            $id=$this->uri->segment(3);
            $qry=$this->Admin_model->deletemember($id);
            if($qry){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Member data successfully deleted.</div>');
                redirect('Admin_cont/members');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Member data not deleted. Please try again later. </div>');
                redirect('Admin_cont/members');
            }
        }
    }
    public function deletevisitor(){
    if(isset($_POST['deletevisitor_btn'])){
        $id=$this->uri->segment(3);
        $qry=$this->Admin_model->deletevisitor($id);
        if($qry){
            $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Visitor data successfully deleted.</div>');
            redirect('Admin_cont/visitors');
        }
        else{
            $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Visitor data not deleted. Please try again later. </div>');
            redirect('Admin_cont/visitors');
        }
    }
    }
    public function deletedepartment(){
        if(isset($_POST['deletedepartment_btn'])){
            $id=$this->uri->segment(3);
            $qry=$this->Admin_model->deletedepartment($id);
            if($qry){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Department data successfully deleted.</div>');
                redirect('Admin_cont/departments');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Department data not deleted. Please try again later. </div>');
                redirect('Admin_cont/departments');
            }
        }
    }
    public function deleteministry(){
        if(isset($_POST['deleteministry_btn'])){
            $id=$this->uri->segment(3);
            $qry=$this->Admin_model->deleteministry($id);
            if($qry){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Ministry data successfully deleted.</div>');
                redirect('Admin_cont/ministries');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Ministry data not deleted. Please try again later. </div>');
                redirect('Admin_cont/ministries');
            }
        }
    }
    public function deletecategory(){
        if(isset($_POST['deletecategory_btn'])){
            $id=$this->uri->segment(3);
            $qry=$this->Admin_model->deletecategory($id);
            if($qry){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Category data successfully deleted.</div>');
                redirect('Admin_cont/category');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Category data not deleted. Please try again later. </div>');
                redirect('Admin_cont/category');
            }
        }
    }
    public function deleteevent(){
        if(isset($_POST['deleteevent_btn'])){
            $id=$this->uri->segment(3);
            $qry=$this->Admin_model->deleteevent($id);
            if($qry){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Event data successfully deleted.</div>');
                redirect('Admin_cont/events');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Event data not deleted. Please try again later. </div>');
                redirect('Admin_cont/events');
            }
        }
    }
    public function deletesermon(){
        if(isset($_POST['deletesermon_btn'])){
            $id=$this->uri->segment(3);
            $qry=$this->Admin_model->deletesermon($id);
            if($qry){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Sermon successfully deleted.</div>');
                redirect('Admin_cont/sermons');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Sermon not deleted. Please try again later. </div>');
                redirect('Admin_cont/sermons');
            }
        }
    }
    public function deleteproject(){
        if(isset($_POST['deleteproject_btn'])){
            $id=$this->uri->segment(3);
            $qry=$this->Admin_model->deleteproject($id);
            if($qry){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Project successfully deleted.</div>');
                redirect('Admin_cont/projects');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Project not deleted. Please try again later. </div>');
                redirect('Admin_cont/projects');
            }
        }
    }
    public function deleteoffering(){
        if(isset($_POST['deleteoffering_btn'])){
            $id=$this->uri->segment(3);
            $qry=$this->Admin_model->deleteoffering($id);
            if($qry){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Offering record successfully deleted.</div>');
                redirect('Admin_cont/tithes_givings');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Offering record not deleted. Please try again later. </div>');
                redirect('Admin_cont/tithes_givings');
            }
        }
    }
    public function deletegeneraloffering(){
        if(isset($_POST['deleteoffering_btn'])){
            $id=$this->uri->segment(3);
            $qry=$this->Admin_model->deleteoffering($id);
            if($qry){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Offering record successfully deleted.</div>');
                redirect('Admin_cont/general_offering');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Offering record not deleted. Please try again later. </div>');
                redirect('Admin_cont/general_offering');
            }
        }
    }
    public function deleteincomehead(){
        if(isset($_POST['deleteincomehead_btn'])){
            $id=$this->uri->segment(3);
            $qry=$this->Admin_model->deleteincomehead($id);
            if($qry){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Data successfully deleted.</div>');
                redirect('Admin_cont/income_vote_heads');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Data not deleted. Please try again later. </div>');
                redirect('Admin_cont/income_vote_heads');
            }
        }
    }
    public function deleteincome(){
        if(isset($_POST['deleteincome_btn'])){
            $id=$this->uri->segment(3);
            $qry=$this->Admin_model->deleteincome($id);
            if($qry){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Data successfully deleted.</div>');
                redirect('Admin_cont/income');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Data not deleted. Please try again later. </div>');
                redirect('Admin_cont/income');
            }
        }
    }
    public function deleteexpensehead(){
        if(isset($_POST['deleteexpensehead_btn'])){
            $id=$this->uri->segment(3);
            $qry=$this->Admin_model->deleteexpensehead($id);
            if($qry){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Data successfully deleted.</div>');
                redirect('Admin_cont/expense_vote_heads');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Data not deleted. Please try again later. </div>');
                redirect('Admin_cont/expense_vote_heads');
            }
        }
    }
    public function deleteexpense(){
        if(isset($_POST['deleteexpense_btn'])){
            $id=$this->uri->segment(3);
            $qry=$this->Admin_model->deleteexpense($id);
            if($qry){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Data successfully deleted.</div>');
                redirect('Admin_cont/expense');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Data not deleted. Please try again later. </div>');
                redirect('Admin_cont/expense');
            }
        }
    }
    public function deleteBaptismRecord(){
        if(isset($_POST['deleteBaptism_btn'])){
            $id=$this->uri->segment(3);
            $qry=$this->Admin_model->deleteBaptismRecord($id);
            if($qry){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Data successfully deleted.</div>');
                redirect('Admin_cont/baptism');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Data not deleted. Please try again later. </div>');
                redirect('Admin_cont/baptism');
            }
        }
    }

    public function delete_bulk_members(){
        $data=array();
        // If record delete request is submitted
        if($this->input->post('bulk_delete_submit')){
            //Get all selected IDs
            $ids=$this->input->post('checked_id');
            // If id array is not empty
            if(!empty($ids)){
                //Delete records from db
                $delete=$this->Admin_model->delete_bulk_members($ids);
                //if delete is successful
                if($delete){
                    $data['statusMsg'] = 'Selected users have been deleted successfully.';
                }
                else{
                    $data['statusMsg'] = 'Some problem occurred, please try again.';
                }
            }
            else{
                $data['statusMsg'] = 'Select at least 1 record to delete.';
            }
        }
        //Get user data from database
        $data['members_tbl']=$this->Admin_model->getRows();

    }
    /*----------------------DELETE QUERY ENDS HERE-------------------------*/

    //search functionality
   /* public function searchFunction(){
        if(isset($_POST['search_btn'])){
            $data=array(
                'search'=>$this->input->post('search_input'),
            );
            $result=$this->Admin_model->searchData($data);
        }
    }*/

   /*public function test(){
       $this->load->view('admin/test');
   }*/

   //Generating baptism card
    public function generateBaptism(){
        if(isset($_POST['generatecert_btn'])){
            //Retrieving the member data
            $data['details']=$this->Admin_model->generateBaptism($this->session->userdata['church'],$this->input->post('bap_id'));
            //load mpdf library
            $this->load->library('m_pdf');
            $html=$this->load->view('admin/birth_cert',$data,true);
            $this->m_pdf->pdf->WriteHTML($html);//writing html into the pdf
            $d=new DateTime();
            $date=$d->format('d/m/y h:i:s a');
            $this->m_pdf->pdf->SetHTMLFooter('<div class="pdf-footer">
            <strong>Disclaimer: </strong> <i>If found Kindly Surrender the card to the church.</i>
            <hr>
            <i>Generated on '.$date.'</i>
            </div>
            ');
            $output=$this->input->post('member').'_'.date('Y_m_d_H_i').'.pdf';
            $this->m_pdf->pdf->Output($output,"D");
            exit();
        }

    }
    public function passwordRecovery(){

    }

}
?>