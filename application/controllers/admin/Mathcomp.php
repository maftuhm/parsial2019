<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mathcomp extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->lang->load('public/participants');

        /* Title Page :: Common */
        $this->title = $this->data['content_title']['mathcomp'];
        $this->page_title->push($this->title);
        $this->data['pagetitle'] = $this->page_title->show();
        $this->data['title'] = $this->title . ' | ' . $this->data['title'];

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, $this->title, 'admin/mathcomp');
        $this->data['image_dir'] = 'upload/mathcomp/';
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
            $this->template->admin_render('admin/mathcomp/index', $this->data);
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
            $this->breadcrumbs->unshift(2, lang('menu_users_profile'), 'admin/mathcomp/profile');
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
            $this->data['title'] = lang('menu_users_profile') . " - " . $this->data['title'];

            /* Data */
            $id = (int) $id;
            $this->data = $this->get_data($id);

            $this->data['image'] = 'default-thumbnail.jpg';
            /* Load Template */
            $this->template->admin_render('admin/mathcomp/profile', $this->data);
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
            $this->breadcrumbs->unshift(2, lang('menu_users_edit'), 'admin/mathcomp/edit');
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
            $this->form_validation->set_rules('tutor_name', 'lang:tutor_name', 'required');
            $this->form_validation->set_rules('tutor_phone', 'lang:tutor_phone', 'required');
        
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

                    if($this->admin_model->update($this->table['mathcomp'], $id, $data))
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

            foreach ($this->data['mathcomp'] as $u)
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
            }
            /* Load Template */
            $this->template->admin_render('admin/mathcomp/edit', $this->data);
        }
    }

    public function get_data($id = NULL, $edit = FALSE)
    {
        $table = $this->table['mathcomp'];
        if ($id == NULL) {
            $this->data['mathcomp'] = $this->common_model->get_data($table);
        }
        else
        {
            $this->data['mathcomp'] = $this->common_model->get_data($table, $id);            
        }
        foreach ($this->data['mathcomp'] as $k => $user)
        {
            if ($edit === TRUE) {
                $this->data['mathcomp'][$k] = $user;
            }
            $this->data['mathcomp'][$k]->payment  = $this->common_model->get_payment($user->id, $this->table['mathcomp']);
        }
        return $this->data;
    }

    public function delete($id = FALSE)
    {
        if (isset($id)){
            if ($this->admin_model->delete($this->table['mathcomp'], $id)) {
                redirect('admin/mathcomp', 'refresh');
            }
        }
        else
        {
            redirect('admin/mathcomp', 'refresh');
        }
    }
}
