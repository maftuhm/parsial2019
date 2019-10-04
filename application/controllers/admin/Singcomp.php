<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Singcomp extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->lang->load('public/participants');

        /* Title Page :: Common */
        $this->title = $this->data['content_title']['singcomp'];
        $this->page_title->push($this->title);
        $this->data['pagetitle'] = $this->page_title->show();
        $this->data['title'] = $this->title . ' | ' . $this->data['title'];

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, $this->title, 'admin/singcomp');
        $this->data['image_dir'] = 'upload/singcomp/';
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
            $this->template->admin_render('admin/singcomp/index', $this->data);
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
            $this->breadcrumbs->unshift(2, lang('menu_users_profile'), 'admin/singcomp/profile');
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
            $this->data['title'] = lang('menu_users_profile') . " - " . $this->data['title'];

            /* Data */
            $id = (int) $id;
            $this->data = $this->get_data($id);

            $this->data['image'] = 'default-thumbnail.jpg';
            /* Load Template */
            $this->template->admin_render('admin/singcomp/profile', $this->data);
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
            $this->breadcrumbs->unshift(2, lang('menu_users_edit'), 'admin/singcomp/edit');
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
                        'official'      => $this->input->post('official'),
                        'song'          => $this->input->post('song'),
                        'required_song' => $this->input->post('required_song'),
                        'address'       => $this->input->post('address'),
                        'email'         => strtolower($this->input->post('email')),
                        'phone'         => $this->input->post('phone')
                    );

                    $data_group = array(
                        'group_id'      => $this->common_model->get_id_group($this->input->post('group'))
                    );

                    if($this->admin_model->update($this->table['singcomp'], $id, $data, $data_group, 4))
                    {
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        redirect('admin/singcomp/profile/'.$id, 'refresh');
                    }
                    else
                    {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                    }
                }
            }

            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            foreach ($this->data['singcomp'] as $u)
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
                    'placeholder' => lang('placeholder_collage_or_school'),
                    'value' => $this->form_validation->set_value('university', $u->university)
                );
                $this->data['official'] = array(
                    'name'  => 'official',
                    'class' => 'form-control',
                    'placeholder' => lang('official'),
                    'value' => $this->form_validation->set_value('official', $u->official)
                );
                $this->data['address'] = array(
                    'name'  => 'address',
                    'class' => 'form-control',
                    'placeholder' => lang('address'),
                    'value' => $this->form_validation->set_value('official', $u->address)
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
                $opt_group = $this->set_option('singcomp');
                $this->data['group'] = array(
                    'name'      => 'group',
                    'options'   => $opt_group,
                    'selected'  => $u->group,
                    'class' => 'form-control'
                );
                $this->data['song'] = array(
                    'name'      => 'song',
                    'placeholder' => lang('placeholder_song'),
                    'value' => $this->form_validation->set_value('song', $u->song),
                    'class' => 'form-control'
                );
                $yamko  = 'Yamko Rambe Yamko';
                $sajojo = 'Sajojo';
                $song = array(
                        '' => '--',
                        strtolower($yamko) => $yamko,
                        strtolower($sajojo) => $sajojo
                );
                $this->data['required_song'] = array(
                    'name'      => 'required_song',
                    'options'   => $song,
                    'selected'  => $this->form_validation->set_value('required_song', $u->required_song),
                    'class' => 'form-control'
                );
            }
            /* Load Template */
            $this->template->admin_render('admin/singcomp/edit', $this->data);
        }
    }

    public function get_data($id = NULL, $edit = FALSE)
    {
        $table = $this->table['singcomp'];
        if ($id == NULL) {
            $this->data['singcomp'] = $this->common_model->get_data($table);
        }
        else
        {
            $this->data['singcomp'] = $this->common_model->get_data($table, $id);            
            $this->data['player'] = $this->common_model->get_data('participants', $id, array('id_team' => $id, 'id_content' => 4));
            foreach ($this->data['player'] as $key => $value) {
                $this->data['player'][$key]->photo =  $this->common_model->get_data('file', $value->id_photo);
                $this->data['player'][$key]->card =  $this->common_model->get_data('file', $value->id_card);
            }
        }
        foreach ($this->data['singcomp'] as $k => $user)
        {
            if ($edit === TRUE) {
                $this->data['singcomp'][$k] = $user;
            }
            $this->data['singcomp'][$k]->groups    = $this->common_model->get_users_group($user->id, 'singcomp', 4);
            $this->data['singcomp'][$k]->payment  = $this->common_model->get_payment($user->id, $this->table['singcomp']);
            if (!empty($this->data['singcomp'][$k]->groups)) {
                foreach ($this->data['singcomp'][$k]->groups as $g => $value) {
                    $this->data['singcomp'][$k]->group = $value->name;
                }
            }
            else
            {
                $this->data['singcomp'][$k]->group = '';
            }
        }
        return $this->data;
    }

    public function delete($id = FALSE)
    {
        if (isset($id)){
            if ($this->admin_model->delete($this->table['singcomp'], $id, 4)) {
                redirect('admin/singcomp', 'refresh');
            }
        }
        else
        {
            redirect('admin/singcomp', 'refresh');
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
