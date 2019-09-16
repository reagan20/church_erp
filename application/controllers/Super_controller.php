<?php
class Super_controller extends CI_Controller{
    public function index(){
        $data['details']=$this->Super_model->getLoggedinSuperDetails($this->session->userdata('national_id'));
        $data['church']=$this->Super_model->count_church_accounts();
        $data['members']=$this->Super_model->countMembers();
        $data['active']=$this->Super_model->countActiveSubscription();
        $data['inactive']=$this->Super_model->countInactiveSubscription();
        $this->load->view('supper_user/supper_inc/supper_header',$data);
        $this->load->view('supper_user/supper_inc/supper_sidesection');
        $this->load->view('supper_user/index');
        $this->load->view('supper_user/supper_inc/supper_footer');
    }
    public function super_admin_signup(){
        $data['details']=$this->Super_model->getLoggedinSuperDetails($this->session->userdata('national_id'));
        $this->load->view('supper_user/supper_inc/supper_header',$data);
        $this->load->view('supper_user/supper_inc/supper_sidesection');
        $this->load->view('supper_user/super_account_signup');
        $this->load->view('supper_user/supper_inc/supper_footer');
    }
    public function update_password(){
        $data['details']=$this->Super_model->getLoggedinSuperDetails($this->session->userdata('national_id'));
        $this->load->view('supper_user/supper_inc/supper_header',$data);
        $this->load->view('supper_user/supper_inc/supper_sidesection');
        $this->load->view('supper_user/update_password');
        $this->load->view('supper_user/supper_inc/supper_footer');
    }
    public function personal_details(){
        $data['details']=$this->Super_model->getLoggedinSuperDetails($this->session->userdata('national_id'));
        $this->load->view('supper_user/supper_inc/supper_header',$data);
        $this->load->view('supper_user/supper_inc/supper_sidesection');
        $this->load->view('supper_user/update_personal_details');
        $this->load->view('supper_user/supper_inc/supper_footer');
    }
    public function admin_accounts(){
        $data['details']=$this->Super_model->getLoggedinSuperDetails($this->session->userdata('national_id'));
        $data['admin']=$this->Super_model->get_super_account();
        $data['count_church']=$this->Super_model->count_church_accounts();
        $this->load->view('supper_user/supper_inc/supper_header',$data);
        $this->load->view('supper_user/supper_inc/supper_sidesection');
        $this->load->view('supper_user/admin_accounts');
        $this->load->view('supper_user/supper_inc/supper_footer');
    }
    public function church_accounts(){
        $data['details']=$this->Super_model->getLoggedinSuperDetails($this->session->userdata('national_id'));
        $data['church']=$this->Super_model->getChurch();
        $data['count_church']=$this->Super_model->count_church_accounts();
        $this->load->view('supper_user/supper_inc/supper_header',$data);
        $this->load->view('supper_user/supper_inc/supper_sidesection');
        $this->load->view('supper_user/created_accounts');
        $this->load->view('supper_user/supper_inc/supper_footer');
    }
    public function create_account(){
        if(isset($_POST['submit_btn'])){
            $pass=1234;
            $data=array(
                'church_name'=>$this->input->post('church_name'),
                'phone'=>$this->input->post('phone'),
                'email'=>$this->input->post('email'),
                'logo'=>$this->input->post('logo'),
                'location'=>$this->input->post('location'),
                'signup_date'=>date('Y-m-d'),
                'password'=>password_hash($pass,PASSWORD_DEFAULT),
                'status'=>'Active'
            );
            $qry=$this->Site_model->create_account($data);
            if($qry){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Church account successfully created.</div>');
                redirect('Super_controller/church_accounts');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Account not created. Please try again later. </div>');
                redirect('Super_controller/church_accounts');
            }
        }
    }
    public function super_account(){
        if(isset($_POST['super_btn'])){
            $data=array(
                'fname'=>$this->input->post('fname'),
                'lname'=>$this->input->post('lname'),
                'email'=>$this->input->post('email'),
                'phone'=>$this->input->post('phone'),
                'national_id'=>$this->input->post('nationalid'),
                //'signup_date'=>date('Y-m-d'),
                'password'=>password_hash($this->input->post('password'),PASSWORD_DEFAULT),
                'role'=>'Super',
                'status'=>$this->input->post('status')
            );
            $qry=$this->Super_model->super_account($data);
            if($qry){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Account successfully created.</div>');
                redirect('Super_controller/super_admin_signup');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Account not created. Please try again later. </div>');
                redirect('Super_controller/super_admin_signup');
            }
        }
    }

    public function updateStatus(){//updating church status
        if(isset($_POST['updatechurch_btn'])){
            $id=$this->uri->segment(3);
            $expiry=$this->input->post('expiry');
            $today=date('Y-m-d');
            $adjust=$this->input->post('days_number');
            $new_date=date('Y-m-d',strtotime($today.'+'.$adjust.'days'));
            $data=array(
                //'status'=>$this->input->post('status')
                'expiry'=>$new_date
            );
            $qry=$this->Super_model->updateStatus($id,$data);
            if($qry){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Status successfully updated.</div>');
                redirect('Super_controller/church_accounts');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Status not updated. Please try again later. </div>');
                redirect('Super_controller/church_accounts');
            }
        }
    }
    public function updateSuperDetails(){
        if(isset($_POST['updateSuperDetails'])){
            $id=$this->uri->segment(3);
            $data=array(
                'fname'=>$this->input->post('fname'),
                'lname'=>$this->input->post('lname'),
                'email'=>$this->input->post('email'),
                'phone'=>$this->input->post('phone')
            );
            $qry=$this->Super_model->updateSuperDetails($id,$data);
            if($qry){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Account details successfully updated.</div>');
                redirect('Super_controller/personal_details');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Account details not updated. Please try again later. </div>');
                redirect('Super_controller/personal_details');
            }
        }
    }
    public function updateSuperDetails1(){
        if(isset($_POST['updateSuperDetails'])){
            $id=$this->uri->segment(3);
            $data=array(
                'fname'=>$this->input->post('fname'),
                'lname'=>$this->input->post('lname'),
                'email'=>$this->input->post('email'),
                'phone'=>$this->input->post('phone'),
                'national_id'=>$this->input->post('nationalid2'),
                'status'=>$this->input->post('status')
            );
            $qry=$this->Super_model->updateSuperDetails($id,$data);
            if($qry){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Account details successfully updated.</div>');
                redirect('Super_controller/admin_accounts');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Account details not updated. Please try again later. </div>');
                redirect('Super_controller/admin_accounts');
            }
        }
    }
    public function updatePassword(){//UPDATING ADMIN PASSWORD
        if(isset($_POST['updatepass_btn'])){
            $pass=$this->input->post('password');
            $pass1=$this->input->post('password2');
            if($pass!=$pass1){
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>SORRY! </strong>Your password is not matching.</div>');
                redirect('Super_controller/update_password');
            }
            else{
                $id=$this->uri->segment(3);
                $details=array(
                    'password'=>password_hash($this->input->post('password'),PASSWORD_DEFAULT)
                );
                $qry=$this->Super_model->updatePassword($id,$details);
                if($qry){
                    $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Password successfully updated.</div>');
                    redirect('Super_controller/update_password');
                }
                else{
                    $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Password not updated. Please try again.</div>');
                    redirect('Super_controller/update_password');
                }
            }
        }
    }
    public function update_user_pass(){//UPDATING ADMIN PASSWORD
        if(isset($_POST['updatepass_btn'])){
            $pass=$this->input->post('password');
            $pass1=$this->input->post('password2');
            if($pass!=$pass1){
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>SORRY! </strong>The password is not matching.</div>');
                redirect('Super_controller/church_accounts');
            }
            else{
                $id=$this->uri->segment(3);
                $details=array(
                    'admin_password'=>password_hash($this->input->post('password'),PASSWORD_DEFAULT)
                );
                $qry=$this->Super_model->update_user_pass($id,$details);
                if($qry){
                    $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Password successfully updated.</div>');
                    redirect('Super_controller/church_accounts');
                }
                else{
                    $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Password not updated. Please try again.</div>');
                    redirect('Super_controller/church_accounts');
                }
            }
        }
    }
}
?>