<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Futsal extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->lang->load('public/participants');

        /* Title Page :: Common */
        $this->title = $this->data['content_title']['futsal'];
        $this->page_title->push($this->title);
        $this->data['pagetitle'] = $this->page_title->show();
        $this->data['title'] = $this->title . ' | ' . $this->data['title'];

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, $this->title, 'admin/futsal');
        $this->data['image_dir'] = 'upload/futsal/';
    }


	public function index($group = '')
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
            $this->data['group'] = $group;
            $this->data = $this->get_data();
            
            /* Load Template */
            $this->template->admin_render('admin/futsal/index', $this->data);
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
            $this->breadcrumbs->unshift(2, lang('menu_users_profile'), 'admin/futsal/profile');
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
            $this->data['title'] = lang('menu_users_profile') . " - " . $this->data['title'];

            /* Data */
            $id = (int) $id;
            $this->data = $this->get_data($id);

            $this->data['image'] = 'default-thumbnail.jpg';
            /* Load Template */
            $this->template->admin_render('admin/futsal/profile', $this->data);
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
            $this->breadcrumbs->unshift(2, lang('menu_users_edit'), 'admin/futsal/edit');
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
            $this->data['title'] = lang('menu_users_edit') . " - " . $this->data['title'];
                /* Variables */

            /* Validate form input */
            $this->form_validation->set_rules('name', 'lang:team_name', 'required');
            $this->form_validation->set_rules('email', 'lang:email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'lang:phone', 'required');
        
            if (isset($_POST) && ! empty($_POST))
            {

                if ($this->form_validation->run() == TRUE)
                {
                    $data = array(
                        'name'          => $this->input->post('name'),
                        'university'    => $this->input->post('university'),
                        'faculty'       => $this->input->post('faculty'),
                        'departement'   => $this->input->post('departement'),
                        'official'      => $this->input->post('official'),
                        'email'         => strtolower($this->input->post('email')),
                        'phone'         => $this->input->post('phone'),
                    );

                    $data_group = array(
                        'group_id'      => $this->common_model->get_id_group($this->input->post('group'))
                    );

                    if($this->admin_model->update($this->table['futsal'], $id, $data, $data_group, 3))
                    {
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        redirect('admin/futsal/profile/'.$id, 'refresh');
                    }
                    else
                    {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                    }
                }
            }

            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            foreach ($this->data['futsal'] as $u)
            {
                $this->data['name'] = array(
                    'name'  => 'name',
                    'class' => 'form-control',
                    'placeholder' => lang('team_name'),
                    'value' => $this->form_validation->set_value('name', $u->name)
                );
                $this->data['university'] = array(
                    'name'  => 'university',
                    'class' => 'form-control',
                    'placeholder' => lang('university'),
                    'value' => $this->form_validation->set_value('university', $u->university)
                );
                $this->data['faculty'] = array(
                    'name'  => 'faculty',
                    'class' => 'form-control',
                    'placeholder' => lang('faculty'),
                    'value' => $this->form_validation->set_value('faculty', $u->faculty)
                );
                $this->data['departement'] = array(
                    'name'  => 'departement',
                    'class' => 'form-control',
                    'placeholder' => lang('departement'),
                    'value' => $this->form_validation->set_value('departement')
                );
                $this->data['official'] = array(
                    'name'  => 'official',
                    'class' => 'form-control',
                    'placeholder' => lang('official'),
                    'value' => $this->form_validation->set_value('official', $u->official)
                );
                $this->data['email'] = array(
                    'name'  => 'email',
                    'type'  => 'email',
                    'class' => 'form-control',
                    'placeholder' => lang('email'),
                    'value' => $this->form_validation->set_value('email', $u->email)
                );
                $this->data['phone'] = array(
                    'name'  => 'phone',
                    'type'  => 'tel',
                    'pattern' => '^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$',
                    'class' => 'form-control',
                    'placeholder' => '085777455031',
                    'value' => $this->form_validation->set_value('phone', $u->phone)
                );
                $opt_group = $this->set_option('futsal');
                //foreach ($u->group as $g) {
                $this->data['group'] = array(
                    'name'      => 'group',
                    'options'   => $opt_group,
                    'selected'  => $u->group,
                    'class' => 'form-control'
                );
                //}
            }
            /* Load Template */
            $this->template->admin_render('admin/futsal/edit', $this->data);
        }
    }

    public function get_data($id = NULL, $edit = FALSE)
    {
        $table = $this->table['futsal'];
        if ($id == NULL) {
            $this->data['futsal'] = $this->common_model->get_data($table);
        }
        else
        {
            $this->data['futsal'] = $this->common_model->get_data($table, $id);            
            $this->data['player'] = $this->common_model->get_data('participants', $id, array('id_team' => $id, 'id_content' => 3));
            foreach ($this->data['player'] as $key => $value) {
                $this->data['player'][$key]->photo =  $this->common_model->get_data('file', $value->id_photo);
                $this->data['player'][$key]->card =  $this->common_model->get_data('file', $value->id_card);
            }
        }
        foreach ($this->data['futsal'] as $k => $user)
        {
            if ($edit === TRUE) {
                $this->data['futsal'][$k] = $user;
            }
            $this->data['futsal'][$k]->groups    = $this->common_model->get_users_group($user->id, 'futsal', 3);
            $this->data['futsal'][$k]->payment  = $this->common_model->get_payment($user->id, $this->table['futsal']);
            if (!empty($this->data['futsal'][$k]->groups)) {
                foreach ($this->data['futsal'][$k]->groups as $g => $value) {
                    $this->data['futsal'][$k]->group = $value->name;
                }
            }
            else
            {
                $this->data['futsal'][$k]->group = '';
            }
        }
        return $this->data;
    }

    public function delete($id = FALSE)
    {
        if (isset($id)){
            if ($this->admin_model->delete($this->table['futsal'], $id, 3)) {
                redirect('admin/futsal', 'refresh');
            }
        }
        else
        {
            redirect('admin/futsal', 'refresh');
        }
    }

    function set_option($name)
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
}
