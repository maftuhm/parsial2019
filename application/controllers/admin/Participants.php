<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Participants extends Admin_Controller {

    public $content_name;

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->lang->load('public/participants');
        $this->content_name = $this->uri->segment(3);
        /* Title Page :: Common */
        $this->title = $this->data['content_title'][$this->content_name];
        $this->page_title->push($this->title);
        $this->data['pagetitle'] = $this->page_title->show();
        $this->data['title'] = $this->title . ' | ' . $this->data['title'];

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, $this->title, 'admin/p/'.$this->content_name);
    }


	public function index()
	{
        if ( ! $this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            /* Get all users */
            $this->data = $this->get_data();
            /* Load Template */
            $this->template->admin_render('admin/' . $this->content_name . '/index', $this->data);
        }
	}

    public function profile($id)
    {
        if ( ! $this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Breadcrumbs */
            $this->breadcrumbs->unshift(2, lang('menu_users_profile'), 'admin/p/mathcomp/profile');
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
            $this->data['title'] = lang('menu_users_profile') . " - " . $this->data['title'];

            /* Data */
            $id = (int) $id;
            $this->data = $this->get_data($id);

            $this->data['image'] = 'default-thumbnail.jpg';
            /* Load Template */
            $this->template->admin_render('admin/'.$this->content_name.'/profile', $this->data);
        }
    }

    public function edit($id)
    {
        if ( ! $this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->data['id'] = $id;
            $this->data = $this->get_data($id);
            $show_tryout    = FALSE;
            $show_mathcomp  = FALSE;
            $show_futsal    = FALSE;
            $show_singcomp  = FALSE;
            /* Breadcrumbs */
            $this->breadcrumbs->unshift(2, lang('menu_users_edit'), 'admin/p/mathcomp/edit');
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
            $this->data['title'] = lang('menu_users_edit') . " - " . $this->data['title'];
                /* Variables */
            // $name = array('field' => 'name', 'label' => 'fullname', 'rules' => 'required');
            // $email = array('field' => 'email', 'label' => 'lang:email', 'rules' => 'required|valid_email');
            // $address = array('field' => 'address', 'label' => 'lang:address', 'rules' => 'required');
            // $phone = array('field' => 'phone', 'label' => 'lang:phone', 'rules' => 'required');
            // $birthplace = array('field' => 'birthplace', 'label' => 'lang:birthplace', 'rules' => 'required');
            // $birthday = array('field' => 'birthday', 'label' => 'lang:birthday', 'rules' => 'required');
            // $phone = array('field' => 'phone', 'label' => 'lang:phone', 'rules' => 'required');
            // $school = array('field' => 'school', 'label' => 'lang:school', 'rules' => 'required');
            // $tutor_name = array('field' => 'tutor_name', 'label' => 'lang:tutor_name', 'rules' => 'required');
            // $tutor_phone = array('field' => 'tutor_phone', 'label' => 'lang:tutor_phone', 'rules' => 'required');
            // $tryout = array(
            //     array('name', 'lang:fullname', 'required'),
            //     array('email', 'lang:email', 'required'),
            //     array('passconf', 'Password Confirmation', 'required'),
            //     array('email', 'Email',  'required')
            // );
            // $tes2 = array(
            //     array('emailaddress', 'EmailAddress', 'required|valid_email'),
            //     array('name', 'Name', 'required|alpha'),
            //     array('title', 'Title', 'required'),
            //     array('message', 'MessageBody', 'required')
            // );
            // $key1 = array('field', 'label', 'rules');
            // $value  = array('name', 'lang:fullname', 'required');
            // foreach ($tes as $key => $value) {
            //     $this->data['tes'] = array_combine($key1, $value);
            // }
            
            /* Validate form input */
            $this->form_validation->set_rules('name', 'lang:fullname', 'required');
            $this->form_validation->set_rules('birthplace', 'lang:birthplace', 'required');
            $this->form_validation->set_rules('email', 'lang:email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'lang:phone', 'required');
            $this->form_validation->set_rules('birthday', 'lang:birthday', 'required');
            $this->form_validation->set_rules('address', 'lang:address', 'required');   
            $this->form_validation->set_rules('school', 'lang:school', 'required');
            switch ($this->content_name) {
                case 'tryout':
                    $show_tryout = TRUE;
                    $this->form_validation->set_rules('major', 'lang:major', 'required');
                    $this->form_validation->set_rules('choice', 'lang:choice', 'required');
                    $this->form_validation->set_rules('interest', 'lang:interest', 'required');
                    break;
                case 'mathcomp':
                    $show_mathcomp = TRUE;
                    $this->form_validation->set_rules('tutor_name', 'lang:tutor_name', 'required');
                    $this->form_validation->set_rules('tutor_phone', 'lang:tutor_phone', 'required');
                    break;
                case 'futsal':
                    break;
                case 'singcomp':
                    break;
                default:
                    break;
            }
        
            if (isset($_POST) && ! empty($_POST))
            {

                if ($this->form_validation->run() == TRUE)
                {
                    $data = array(
                        'number'        => $this->input->post('number_participant'),
                        'name'          => $this->input->post('name'),
                        'birthplace'    => $this->input->post('birthplace'),
                        'birthday'      => $this->input->post('birthday'),
                        'phone'         => $this->input->post('phone'),
                        'address'       => $this->input->post('address'),
                        'school'        => $this->input->post('school'),
                        'email'         => strtolower($this->input->post('email')),
                        'tutor_name'    => $this->input->post('tutor_name'),
                        'tutor_phone'   => $this->input->post('tutor_phone')

                    );

                    if($this->admin_model->update($this->table[$this->content_name], $id, $data))
                    {
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        redirect('admin/mathcomp/profile/'.$id, 'refresh');
                    }
                    else
                    {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                    }
                }
            }

            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            foreach ($this->data[$this->content_name] as $u)
            {
                // foreach ($u->format as $n) {
                //     $this->data['num'] = $n->number;
                // }
                // $this->data['number'] = array(
                //     'name'  => 'number_participant',
                //     'type'  => 'text',
                //     'class' => 'form-control',
                //     'style' => 'max-width:20%; margin-right:3px; text-align:right; display:inline;',
                //     'placeholder' => 'XXX',
                //     'value' => $this->form_validation->set_value('number_participant', $u->number)
                // );
                $this->data['name'] = array(
                    'name'  => 'name',
                    'class' => 'form-control',
                    'placeholder' => lang('fullname'),
                    'value' => $this->form_validation->set_value('name', $u->name)
                );
                $this->data['birthplace'] = array(
                    'name'  => 'birthplace',
                    'class' => 'form-control',
                    'placeholder' => lang('birthplace'),
                    'value' => $this->form_validation->set_value('birthplace', $u->birthplace)
                );
                $this->data['birthday'] = array(
                    'name'  => 'birthday',
                    'class' => 'form-control',
                    'placeholder' => lang('birthday'),
                    'value' => $this->form_validation->set_value('birthday', $u->birthday)
                );
                $this->data['address'] = array(
                    'name'  => 'address',
                    'class' => 'form-control',
                    'placeholder' => lang('address'),
                    'value' => $this->form_validation->set_value('address', $u->address)
                );
                $this->data['email'] = array(
                    'name'  => 'email',
                    'type'  => 'email',
                    'class' => 'form-control',
                    'placeholder' => lang('email'),
                    'value' => $this->form_validation->set_value('email', $u->email)
                );
                $this->data['school'] = array(
                    'name'  => 'school',
                    'class' => 'form-control',
                    'placeholder' => lang('school'),
                    'value' => $this->form_validation->set_value('school', $u->school)
                );
                $this->data['phone'] = array(
                    'name'  => 'phone',
                    'type'  => 'tel',
                    'pattern' => '^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$',
                    'class' => 'form-control',
                    'placeholder' => '085777455031',
                    'value' => $this->form_validation->set_value('phone', $u->phone)
                );
                if ($show_mathcomp) {
                    $this->data['tutor_name'] = array(
                        'name'  => 'tutor_name',
                        'class' => 'form-control',
                        'placeholder' => lang('tutor_name'),
                        'value' => $this->form_validation->set_value('tutor_name', $u->tutor_name)
                    );

                    $this->data['tutor_phone'] = array(
                        'name'  => 'tutor_phone',
                        'type'  => 'tel',
                        'pattern' => '^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$',
                        'class' => 'form-control',
                        'placeholder' => '085777455031',
                        'value' => $this->form_validation->set_value('tutor_phone', $u->tutor_phone)
                    );
                    
                }elseif ($show_tryout) {
                    $this->data['interest'] = array(
                        'name'  => 'interest',
                        'class' => 'form-control',
                        'placeholder' => lang('interest'),
                        'value' => $this->form_validation->set_value('interest', $u->interest)
                    );

                    $opt_choice = $this->set_option('choice');
                    $opt_major = $this->set_option('major');
                    foreach ($u->choices as $choice) {
                        $this->data['choice'] = array(
                            'name'      => 'choice',
                            'options'   => $opt_choice,
                            'selected'  => $choice->name,
                            'class' => 'form-control'
                        );
                    }
                    foreach ($u->majors as $major) {
                        $this->data['major'] = array(
                            'name'      => 'major',
                            'options'   => $opt_major,
                            'selected'  => $major->name,
                            'class' => 'form-control'
                        );
                    }
                    foreach ($u->format as $n) {
                        $this->data['num'] = $n->number;
                    }
                    $this->data['number'] = array(
                        'name'  => 'number_participant',
                        'class' => 'form-control',
                        'style' => 'max-width:20%; margin-right:3px; text-align:right; display:inline;',
                        'placeholder' => 'XXX',
                        'value' => $this->form_validation->set_value('number_participant', $u->number)
                    );
                }

            }
            /* Load Template */
            $this->template->admin_render('admin/' . $this->content_name . '/edit', $this->data);
        }
    }
    public function set_option($name)
    {
        $groups = $this->common_model->get_groups($name);
        foreach ($groups as $k){
            $data[$k->name] = strtoupper($k->name);
        }
        $opt = array_merge(
            array(
                '' => '--'),
            $data
        );
        return $opt;
    }

    public function get_data($id = NULL, $edit = FALSE)
    {
        $table = $this->table[$this->content_name];
        if ($id == NULL) {
            $this->data[$this->content_name] = $this->common_model->get_data($table);
        }
        else
        {
            $this->data[$this->content_name] = $this->common_model->get_data($table, $id);            
        }
        foreach ($this->data[$this->content_name] as $k => $user)
        {
            if ($edit === TRUE) {
                $this->data[$this->content_name][$k] = $user;
            }
            $this->data[$this->content_name][$k]->payment  = $this->common_model->get_payment($user->id, $this->table[$this->content_name]);

            if ($this->content_name == 'tryout') {
                $this->data[$this->content_name][$k]->choices  = $this->common_model->get_users_group($user->id, 'choice');
                $this->data[$this->content_name][$k]->majors   = $this->common_model->get_users_group($user->id, 'major');
                foreach ($this->data[$this->content_name][$k]->choices as $key => $value) {
                    $this->data[$this->content_name][$k]->format = $this->admin_model->get_format_number($value->id);
                }
            }
        }
        return $this->data;
    }

    public function generate($id)
    {
        $get_group = $this->common_model->get_users_group($id, 'choice');
        foreach ($get_group as $g) {
            $group_id = $g->id;
        }
        $get_format = $this->admin_model->get_format_number($group_id);
        foreach ($get_format as $f) {
            $digit = $f->digit;
            $start = $f->start_from;
        }

        $set = $this->admin_model->set_number($this->table['tryout'], $id, NULL, $digit, $start);
        if ($set) {
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            
            if(isset($_SERVER['HTTP_REFERER']))
            {
                $redirect_to = str_replace(base_url(),'',$_SERVER['HTTP_REFERER']);
            }
            else
            {
                $redirect_to = $this->uri->uri_string();
            }
            redirect('admin/p/tryout/profile/'.$id, 'refresh');
        }
    }

    public function delete($id = FALSE)
    {
        if (isset($id)){
            if ($this->admin_model->delete($this->table[$this->content_name], $id)) {
                redirect('admin/'.$this->content_name, 'refresh');
            }
        }
        else
        {
            redirect('admin/'.$this->content_name, 'refresh');
        }
    }
}
