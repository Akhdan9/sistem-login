 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot extends CI_Controller {


        public function index()
        {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

            if($this->form_validation->run() == false){
                $data['title'] = 'Forgot Password';
                $this->load->view('template/auth_header', $data);
                $this->load->view('auth/forgot-password', $data);
                $this->load->view('template/auth_footer', $data);
                
            } else {
                $email = $this->input->post('email');
                $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

                if($user){
                    $token = base64_encode(random_bytes(32));
                    $user_token = [
                        'email' => $email,
                        'token' => $token,
                        'date_created' => time()
                    ];
                    $this->db->insert('user_token', $user_token);
                    

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Please check your email to reset password</div>');
                    redirect('forgot');

                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Email is not registered</div>');
                    redirect('forgot');
                }
            }
        }
}
