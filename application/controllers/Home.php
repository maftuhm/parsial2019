<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('public/participants_model');
        $this->data['title'] = $this->config->item('title');
		$this->table = $this->config->item('tables', 'ion_auth');
    }

	public function index()
	{
		/* Validate form input */
		/*$this->form_validation->set_rules('firstname', 'First Name', 'required');
		$this->form_validation->set_rules('lastname', 'Last Name', 'required');

		if ($this->form_validation->run() == TRUE)
		{

			$data = array(
				'first_name'	=> $this->input->post('firstname'),
				'last_name'		=> $this->input->post('lastname')
			);
			$this->participants_model->input_participant('tes', $data);

		}
		else
		{
            $this->data['message'] = validation_errors();

			$this->data['first_name'] = array(
				'name'  => 'firstname',
				'id'    => 'firstname',
				'type'  => 'text',
                'class' => 'form-control',
                'placeholder' => 'Enter First Name',
                'required' => 'required'

			);
			$this->data['lastname'] = array(
				'name'  => 'lastname',
				'id'    => 'lastname',
				'type'  => 'text',
                'class' => 'form-control',
                'placeholder' => 'Enter Last Name',
                'required' => 'required'
			);*/
            /* Load Template */
            // $this->data['string'] = $this->encrypt->encode(1);
			/*$this->load->library('encryption');
            $this->encryption->initialize(
				array(
					'cipher' => 'blowfish',
					'mode' => 'ecb',
				)
			);
			$this->data['enc_username']=$this->encryption->encrypt(1);
			$this->data['enc_username']=str_replace(array('+', '/', '='), array('-', '_', '~'), $this->data['enc_username']);
			$this->data['dec_username']=str_replace(array('-', '_', '~'), array('+', '/', '='), $this->data['enc_username']);
			$this->data['dec_username']=$this->encryption->decrypt($this->data['dec_username']);
            $this->load->view('public/home', $this->data);*/
        //}
        redirect('http://himatika.fst.uinjkt.ac.id/parsial2019');
	}
}
