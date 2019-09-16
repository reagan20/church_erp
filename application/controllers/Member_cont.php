<?php
class Member_cont extends CI_Controller{
    public function index(){
        $data['member_details']=$this->Member_model->getLoggedinMemberDetails($this->session->userdata['id']);
        $data['project_counts']=$this->Member_model->countProjects($this->session->userdata['church']);
        $data['event_counts']=$this->Member_model->countEvents($this->session->userdata['church']);
        $data['sermon_counts']=$this->Member_model->countSermons($this->session->userdata['church']);
        $this->load->view('member/member_inc/member_header',$data);
        $this->load->view('member/member_inc/member_sidesection');
        $this->load->view('member/index');
        $this->load->view('member/member_inc/member_footer');
    }
    public function sermons(){
        $data['member_details']=$this->Member_model->getLoggedinMemberDetails($this->session->userdata['id']);
        $data['sermons']=$this->Member_model->getSermons($this->session->userdata['church']);//
        $data['sermon_counts']=$this->Member_model->countSermons($this->session->userdata['church']);
        $this->load->view('member/member_inc/member_header',$data);
        $this->load->view('member/member_inc/member_sidesection');
        $this->load->view('member/sermons');
        $this->load->view('member/member_inc/member_footer');
    }
    public function events(){
        $data['member_details']=$this->Member_model->getLoggedinMemberDetails($this->session->userdata['id']);
        $data['events']=$this->Member_model->getEvents($this->session->userdata['church']);//
        $data['event_counts']=$this->Member_model->countEvents($this->session->userdata['church']);
        $this->load->view('member/member_inc/member_header',$data);
        $this->load->view('member/member_inc/member_sidesection');
        $this->load->view('member/events');
        $this->load->view('member/member_inc/member_footer');
    }
    public function projects(){
        $data['member_details']=$this->Member_model->getLoggedinMemberDetails($this->session->userdata['id']);
        $data['project']=$this->Member_model->getProjects($this->session->userdata['church']);//
        $data['project_counts']=$this->Member_model->countProjects($this->session->userdata['church']);
        $this->load->view('member/member_inc/member_header',$data);
        $this->load->view('member/member_inc/member_sidesection');
        $this->load->view('member/projects');
        $this->load->view('member/member_inc/member_footer');
    }
    public function offerings(){
        $data['member_details']=$this->Member_model->getLoggedinMemberDetails($this->session->userdata['id']);
        $data['category']=$this->Member_model->getCategory($this->session->userdata['church']);
        $data['offering']=$this->Member_model->getOfferings($this->session->userdata['church'],$this->session->userdata['id']);
        $data['total_offering']=$this->Member_model->getTotalOffering($this->session->userdata['church'],$this->session->userdata['id']);
        $data['projects']=$this->Member_model->getActiveProjects($this->session->userdata['church']);
        $this->load->view('member/member_inc/member_header',$data);
        $this->load->view('member/member_inc/member_sidesection');
        $this->load->view('member/tithes_givings');
        $this->load->view('member/member_inc/member_footer');
    }
    public function update_password(){
        $data['member_details']=$this->Member_model->getLoggedinMemberDetails($this->session->userdata['id']);
        //$data['category']=$this->Member_model->getCategory($this->session->userdata['church']);
        //$data['offering']=$this->Member_model->getOfferings($this->session->userdata['church'],$this->session->userdata['id']);
        //$data['total_offering']=$this->Member_model->getTotalOffering($this->session->userdata['church'],$this->session->userdata['id']);
        $this->load->view('member/member_inc/member_header',$data);
        $this->load->view('member/member_inc/member_sidesection');
        $this->load->view('member/update_password');
        $this->load->view('member/member_inc/member_footer');
    }
    public function personal_profile(){
        $data['member_details']=$this->Member_model->getLoggedinMemberDetails($this->session->userdata['id']);
        //$data['category']=$this->Member_model->getCategory($this->session->userdata['church']);
        //$data['offering']=$this->Member_model->getOfferings($this->session->userdata['church'],$this->session->userdata['id']);
        //$data['total_offering']=$this->Member_model->getTotalOffering($this->session->userdata['church'],$this->session->userdata['id']);
        $this->load->view('member/member_inc/member_header',$data);
        $this->load->view('member/member_inc/member_sidesection');
        $this->load->view('member/personal_profile');
        $this->load->view('member/member_inc/member_footer');
    }

    public function add_offering(){
        if(isset($_POST['offering_btn'])){
            $head_details=array(
                'member'=>$this->session->userdata['id'],
                'category'=>$this->input->post('category'),
                'amount'=>$this->input->post('amount'),
                'pay_mode'=>$this->input->post('pay_mode'),
                'transaction_code'=>$this->input->post('transaction_code'),
                'payment_date'=>$this->input->post('pay_date'),
                'proj'=>$this->input->post('project'),
                'church'=>$this->session->userdata['church'],
                'created_by'=>$this->session->userdata['id'],
                'description'=>$this->input->post('description'),
                'p_status'=>'Pending'
            );
            $qry=$this->Member_model->add_offering($head_details);
            if($qry){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Offering successfully added.</div>');
                redirect('Member_cont/offerings');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Offering not added. Please try again.</div>');
                redirect('Member_cont/offerings');
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
    public function updatePassword(){
        if(isset($_POST['updatepass_btn'])){
            $pass=$this->input->post('password');
            $pass1=$this->input->post('password2');
            $oldpass=$this->input->post('old_password');
            $old=$this->Site_model->confirm_password($this->session->userdata['m_nationalid']);
            if($this->verifyPassword($oldpass,$old)){
                if($pass!=$pass1){
                    $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>SORRY! </strong>Your new password is not matching.</div>');
                    redirect('Member_cont/update_password');
                }
                else{
                    $id=$this->uri->segment(3);
                    $details=array(
                        'password'=>password_hash($this->input->post('password'),PASSWORD_DEFAULT)
                    );
                    $qry=$this->Member_model->updatePassword($id,$details);
                    if($qry){
                        $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Password successfully updated.</div>');
                        redirect('Member_cont/update_password');
                    }
                    else{
                        $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Password not updated. Please try again.</div>');
                        redirect('Member_cont/update_password');
                    }
                }
            }
           else{
               $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Old password is not matching.</div>');
               redirect('Member_cont/update_password');
           }
        }
    }
}
?>