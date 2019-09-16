<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System extends CI_Controller {

	public function index()
	{
		$this->load->view('login');
	}
	public function admin_first_time_login()
	{
	    //$data['admin_id'] = $this->Site_model->getChurchAdminauto_id($this->session->userdata['id']);
		$data['county']=$this->Site_model->getCounty();
		$this->load->view('admin_first_time_login',$data);
	}
	public function register()
	{
		$this->load->view('register');
	}
	public function forgot_password()
	{
		$this->load->view('forgot_password');
	}
	public function admin_account(){
		if(isset($_POST['churchadmin_btn'])){
			$admin_data=array(
				'admin_fname'=>$this->input->post('first_name'),
				'admin_lname'=>$this->input->post('last_name'),
				'admin_nationalid'=>$this->input->post('national_id'),
				'admin_phone'=>$this->input->post('phone_number'),
				'admin_email'=>$this->input->post('email_address'),
				'admin_password'=>password_hash($this->input->post('password'),PASSWORD_DEFAULT),
				//'role'=>'Admin',
				'admin_status'=>'Active',
				'admin_createddate'=>date('Y-m-d')

			);
			$admin=$this->Site_model->add_admin($admin_data);
			if($admin){
			    $id=$this->Site_model->getChurchAdminauto_id($this->input->post('national_id'));
                $super=array(
                    'national'=>$this->input->post('national_id'),
                    'id'=>$id,
                    'islogged'=>1
                );
                $this->session->set_userdata($super);
				$this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Administrator account successfully created. Kindly complete the church account creation.</div>');
				redirect('System/admin_first_time_login');
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Administrator account not created. Please check network connectivity and try again.</div>');
				redirect('System/register');
			}
		}
	}
	public function church_account(){
		if(isset($_POST['church_btn'])){
		    //$id=$this->Site_model->getChurchAdminauto_id($this->session->userdata['national_id']);
		    $start_date=date('Y-m-d');
		    $trial_days=30;
		    $expiry=date('Y-m-d', strtotime($start_date.'+'.$trial_days.'days'));
            $file_name='logo';
            $photo=$this->upload_photo($file_name);
			$data=array(
				'church_name'=>$this->input->post('church_name'),
				'created_by'=>$this->input->post('admin_id'),
				'county'=>$this->input->post('county'),
                'box'=>$this->input->post('box'),
				'location'=>$this->input->post('location'),
				'phone'=>$this->input->post('church_phone'),
				'email'=>$this->input->post('church_email'),
				'logo'=>$photo,//$this->input->post('logo'),
				'motto'=>$this->input->post('motto'),
				'signup_date'=>date('Y-m-d'),
				'expiry'=>$expiry,
				'status'=>'Active'
			);
			$qry=$this->Site_model->church_account($data);
			if($qry){
                $churchadmin_firstlogin=$this->Site_model->confirm_first_login($this->input->post('admin_id'));
                $church=$this->Site_model->confirm_church($churchadmin_firstlogin);
                $user=array(
                    'admin_nationalid'=>$this->session->userdata['national'],
                    'church'=>$church,
                    'id'=>$this->input->post('admin_id'),
                    //'role'=>$role,
                    'isloggedin'=>1,
                    //'status'=>$church_status
                );
                $this->session->set_userdata($user);
            //$this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Church account successfully created. You can now login as a Church Administrator.</div>');
            redirect('Admin_cont/index');
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Account not created. Please try again later. </div>');
				redirect('System/admin_first_time_login');
			}
		}
	}
    //function for uploading image
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
	public function login_process(){
		if(isset($_POST['login_btn'])){
			$id=$this->input->post('id_no');
			$password=$this->input->post('password');

			$national=$this->Site_model->confirm_id($id);//confirms church member during login
			$pass=$this->Site_model->confirm_password($id);//confirm member password

			$churchadmin_national=$this->Site_model->getChurchAdmin_id($id);//confirms church admin during login
			$churchadmin_pass=$this->Site_model->confirm_churchadminpassword($id);//confirm super admin password
			$churchadminauto_id=$this->Site_model->getChurchAdminauto_id($id);
			$churchadmin_firstlogin=$this->Site_model->confirm_first_login($churchadminauto_id);

			$church_status=$this->Site_model->getChurchStatus($churchadminauto_id);

			$super_national=$this->Site_model->getSuperAdmin_id($id);//confirms super admin during login
			$super_pass=$this->Site_model->confirm_superadminpassword($id);//confirm super admin password
			$super_details=$this->Super_model->getLoggedinSuperDetails($id);


			$church=$this->Site_model->confirm_church($churchadmin_firstlogin);

			$memberchurch=$this->Site_model->confirmmember_church($id);//member church

			$member_auto_id=$this->Site_model->getMember_id($id);

			$role=$this->Site_model->getMember_role($id);

			$today=date('Y-m-d');
			$expiry=$this->Site_model->expiry($id);
            $expiryadmin=$this->Site_model->expiryadmin($id);

			if($national){
				if($this->verifyPassword($password, $pass)){
				    if($expiry < $today){
                        $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong>The church account expired. Kindly contact the system administrator for activation. Phone: +254716413386 or Email: robisearch@gmail.com/ info@robisearch.com  </div>');
                        redirect('System/index');
                    }
				    else{
                        /*if($role=="Admin"){
                        if($church>0){
                            $user=array(
                                'm_nationalid'=>$id,
                                'church'=>$church,
                                'id'=>$member_auto_id,
                                'role'=>$role,
                                'isloggedin'=>1
                            );
                            $this->session->set_userdata($user);
                            redirect('Admin_cont/index');
                        }
                        else{
                            $first_time=array(
                                'm_nationalid'=>$id,
                                'id'=>$member_auto_id,
                                'islogged'=>1
                            );
                            $this->session->set_userdata($first_time);
                            redirect('System/admin_first_time_login');
                        }
                    }*/
                        //elseif($role=="Member"){
                        $user=array(
                            'm_nationalid'=>$id,
                            'church'=>$memberchurch,
                            'id'=>$member_auto_id,
                            'isloggedmember'=>1
                        );
                        $this->session->set_userdata($user);
                        redirect('Member_cont/index');
                        //}
                        //else{
                        //coming soon
                        //}
                    }


				}
				else{
					$this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong>Your password is incorrect. Please check and try again. </div>');
					redirect('System/index');
				}
			}
			//else{
				elseif($super_national){
					if($this->verifyPassword($password,$super_pass)){
						$super=array(
							'national_id'=>$id,
							//'details'=>$super_details,
							'isloggedin'=>1
						);
						$this->session->set_userdata($super);
						redirect('Super_controller/index');
					}
					else{
						$this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong>Your password is incorrect. Please check and try again. </div>');
						redirect('System/index');
					}
				}
				elseif($churchadmin_national){
					if($this->verifyPassword($password,$churchadmin_pass)){
						if($churchadmin_firstlogin){
						    if($expiryadmin < $today){
                                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong>The church account expired. Kindly contact the system administrator for activation. Phone: +254716413386 or Email: robisearch@gmail.com/ info@robisearch.com  </div>');
                                redirect('System/index');
                            }
						    else{
                                $user=array(
                                    'admin_nationalid'=>$id,
                                    'church'=>$church,
                                    'id'=>$churchadminauto_id,
                                    //'role'=>$role,
                                    'isloggedin'=>1,
                                    'status'=>$church_status
                                );
                                $this->session->set_userdata($user);
                                redirect('Admin_cont/index');
                            }

						}
						else{
							$first_time=array(
								'admin_nationalid'=>$id,
								'id'=>$churchadminauto_id,
								'islogged'=>1
							);
							$this->session->set_userdata($first_time);
							redirect('System/admin_first_time_login');
						}
					}
					else{
						$this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong>Your password is incorrect. Please check and try again. </div>');
						redirect('System/index');
					}
				}
			else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong>No user exist with the provided ID. Please check and try again. </div>');
                redirect('System/index');
            }
			//}
		}
	}

	//Session logout
	public function logout(){
		$this->session->unset_userdata('m_nationalid');
		//$this->session->unset_userdata('isloggedin');
		$this->session->sess_destroy();
		redirect('System/index');
	}
}
