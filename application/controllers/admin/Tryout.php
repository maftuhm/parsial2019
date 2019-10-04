<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tryout extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->lang->load('public/participants');

        /* Title Page :: Common */
        $this->title = $this->data['content_title']['tryout'];
        $this->page_title->push($this->title);
        $this->data['pagetitle'] = $this->page_title->show();
        $this->data['title'] = $this->title . ' | ' . $this->data['title'];

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, $this->title, 'admin/tryout');
        $this->data['image_dir'] = 'upload/tryout/';
    }


	public function index($choice = '')
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
            $this->data['choice'] = $choice;
            $this->data['groups'] = $this->common_model->get_groups('choice');
            /* Load Template */
            $this->template->admin_render('admin/tryout/index', $this->data);
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
            $this->breadcrumbs->unshift(2, lang('menu_users_profile'), 'admin/tryout/profile');
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
            $this->data['title'] = lang('menu_users_profile') . " - " . $this->data['title'];

            /* Data */
            $id = (int) $id;
            $this->data = $this->get_data($id);
            $this->data['image'] = 'default-thumbnail.jpg';
            //$this->data['tes'] = $tes;
            /* Load Template */
            $this->template->admin_render('admin/tryout/profile', $this->data);
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
            /* Breadcrumbs */
            $this->breadcrumbs->unshift(2, lang('menu_users_edit'), 'admin/tryout/edit');
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
            $this->data['title'] = lang('menu_users_edit') . " - " . $this->data['title'];
                /* Variables */

            /* Validate form input */
            $this->form_validation->set_rules('name', 'lang:fullname', 'required');
            $this->form_validation->set_rules('birthplace', 'lang:birthplace', 'required');
            $this->form_validation->set_rules('email', 'lang:email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'lang:phone', 'required');
            $this->form_validation->set_rules('birthday', 'lang:birthday', 'required');
            $this->form_validation->set_rules('address', 'lang:address', 'required');   
            $this->form_validation->set_rules('school', 'lang:school', 'required');
            $this->form_validation->set_rules('departement', 'lang:departement', 'required');
            $this->form_validation->set_rules('choice', 'lang:choice', 'required');
            $this->form_validation->set_rules('interest', 'lang:interest', 'required');
        
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
                        'interest'      => $this->input->post('interest')

                    );
                    $data_group = array(
                        'major_id'  => $this->common_model->get_id_group($this->input->post('departement')),
                        'choice_id' => $this->common_model->get_id_group($this->input->post('choice'))
                    );

                    if($this->admin_model->update($this->table['tryout'], $id, $data, $data_group))
                    {
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        redirect('admin/tryout/profile/'.$id, 'refresh');
                    }
                    else
                    {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                    }
                }
            }

            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            foreach ($this->data['tryout'] as $u)
            {
                /*foreach ($u->format as $n) {
                    $this->data['num'] = $n->number;
                }*/
                $this->data['number'] = array(
                    'name'  => 'number_participant',
                    'class' => 'form-control',
                    'style' => 'max-width:20%; margin-right:3px; text-align:right; display:inline;',
                    'placeholder' => 'XXX',
                    'value' => $this->form_validation->set_value('number_participant', $u->old_number)
                );
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
                    $this->data['departement'] = array(
                        'name'      => 'departement',
                        'options'   => $opt_major,
                        'selected'  => $major->name,
                        'class' => 'form-control'
                    );
                }
            }
            /* Load Template */
            $this->template->admin_render('admin/tryout/edit', $this->data);
        }
    }

    function generate($id)
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

        $set = $this->admin_model->set_number($this->table['tryout'], $id, $group_id, NULL, $digit, $start);
        if ($set) {
            redirect('admin/tryout/profile/'.$id);
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
        $table = $this->table['tryout'];
        if ($id == NULL) {
            $this->data['tryout'] = $this->common_model->get_data($table);
        }
        else
        {
            $this->data['tryout'] = $this->common_model->get_data($table, $id);            
        }
        foreach ($this->data['tryout'] as $k => $user)
        {
            if ($edit === TRUE) {
                $this->data['tryout'][$k] = $user;
            }
            $this->data['tryout'][$k]->choices  = $this->common_model->get_users_group($user->id, 'choice');
            $this->data['tryout'][$k]->majors   = $this->common_model->get_users_group($user->id, 'major');
            $this->data['tryout'][$k]->payment  = $this->common_model->get_payment($user->id, $this->table['tryout']);
            foreach ($this->data['tryout'][$k]->choices as $key => $value) {
                $this->data['tryout'][$k]->choice = $value->name;
                $format = $this->common_model->get_format_number($value->id);
                $digit = $this->common_model->get_format_number($value->id, 'digit');
                $position = $this->common_model->get_format_number($value->id, 'position');
                $number = $this->data['tryout'][$k]->number;
                $this->data['tryout'][$k]->old_number = $number;
                if ($number != 0) {
                    $this->data['tryout'][$k]->number = insert_at_position($format, set_digit($digit, $number), $position);
                }else{
                    $this->data['tryout'][$k]->number = '';
                }
            }
            foreach ($this->data['tryout'][$k]->majors as $key => $value) {
                $this->data['tryout'][$k]->departement = $value->name;
            }
        }
        return $this->data;
    }

    function delete($id = FALSE)
    {
        if (isset($id)){
            $this->admin_model->delete($this->table['tryout'], $id);
        }
        redirect('admin/tryout');
    }

    public function send_email($value)
    {
        $this->load->library('email');

        $this->email->from('maftuhsafii@gmail.com', 'Maftuh Mashuri');
        $this->email->to($value);
        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        $this->email->send();
    }
    // public function go_to_prev()
    // {
    //     if(isset($_SERVER['HTTP_REFERER']))
    //     {
    //         $redirect_to = str_replace(base_url(),'',$_SERVER['HTTP_REFERER']);
    //     }
    //     else
    //     {
    //         $redirect_to = $this->uri->uri_string();
    //     }
    //     redirect($redirect_to, 'refresh');
    // }
}
