<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends Public_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->title = $this->data['content_title'];
        $this->data['required'] = lang('form_required');
		$this->form_validation->set_message('is_unique', '{field} ' . set_value('email') . ' sudah terdaftar.');
		$this->data['name'] = array(
			'name'  => 'name',
			'type'  => 'text',
			'class'	=> 'input100',
            'placeholder' => lang('placeholder_name')
		);
		$this->data['address'] = array(
			'name'  => 'address',
			'cols'	=> '40',
			'rows' 	=> '3',
			'class'	=> 'input100',
            'placeholder' => lang('placeholder_address'),
            'value'	=> $this->form_validation->set_value('address')
		);
		$this->data['email'] = array(
			'name'  => 'email',
			'type'  => 'email',
			'class'	=> 'input100',
            'placeholder' => lang('placeholder_email'),
            'value'	=> $this->form_validation->set_value('email')
		);
		$this->data['phone'] = array(
			'name'  => 'phone',
			'type'  => 'tel',
            'pattern' => '^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$',
			'class'	=> 'input100',
            'placeholder' => lang('placeholder_phone'),
            'value'	=> $this->form_validation->set_value('phone')
		);
		$this->data['accept'] = array(
			'name'  => 'accept',
			'class'    => 'checkbox',
			'type'  => 'checkbox',
            'checked'	=> set_checkbox('accept')
		);
		$this->data['school'] = array(
			'name'  => 'school',
			'type'  => 'text',
			'class'	=> 'input100',
            'placeholder' => lang('placeholder_school'),
            'value'	=> $this->form_validation->set_value('school')
		);
		$this->data['birthplace'] = array(
			'name'  => 'birthplace',
			'type'  => 'text',
            'placeholder' => lang('placeholder_city'),
			'class'	=> 'input100',
            'value'	=> $this->form_validation->set_value('birthplace')
		);
		$this->data['date'] = array(
			'name'  => 'date',
			'options' 	=> set_option_date('d'),
			'selected'	=> $this->form_validation->set_value('date'),
			'class'	=> 'first input100',
		);
		$this->data['month'] = array(
			'name'  => 'month',
			'options' 	=> set_option_date('m'),
			'selected'	=> $this->form_validation->set_value('month'),
			'class'	=> 'second input100',
		);
		$this->data['year'] = array(
			'name'  => 'year',
			'options' 	=> set_option_date('y'),
			'selected'	=> $this->form_validation->set_value('year'),
			'class'	=> 'third input100',
		);
    }

	public function tryout()
	{
        $this->data['header'] = $this->title['tryout'];
        $this->data['title'] = $this->data['header'] . ' - ' . $this->data['title'];
		$table 	= $this->table['tryout'];
		$this->data['sk_url'] = $this->sk_url['tryout'];
		// $this->data['class_alert'] = 'alert-validate';
		/* Validate form input */
		$this->form_validation->set_rules('name', 'lang:fullname', 'required');
		$this->form_validation->set_rules('birthplace', 'lang:birthplace', 'required');
		$this->form_validation->set_rules('date', 'lang:date', 'required');
		$this->form_validation->set_rules('month', 'lang:month', 'required');
		$this->form_validation->set_rules('year', 'lang:year', 'required');
		$this->form_validation->set_rules('email', 'lang:email', 'required|valid_email|is_unique['.$table.'.email]');
		$this->form_validation->set_rules('phone', 'lang:phone', 'required');
		$this->form_validation->set_rules('address', 'lang:address', 'required');
		$this->form_validation->set_rules('school', 'lang:school', 'required');
		$this->form_validation->set_rules('departement', 'lang:departement', 'required');
		$this->form_validation->set_rules('choice', 'lang:choice', 'required');
		$this->form_validation->set_rules('interest', 'lang:interest', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			$name 	= $this->input->post('name');
			$email 	= strtolower($this->input->post('email'));
			$additional_data = array(
				'birthplace'	=> $this->input->post('birthplace'),
				'birthday'		=> set_digit(2, $this->input->post('date')) .'-'. set_digit(2, $this->input->post('month')) .'-'. $this->input->post('year'),
				'phone'			=> $this->input->post('phone'),
				'address'		=> $this->input->post('address'),
				'school'		=> $this->input->post('school'),
				'interest'		=> $this->input->post('interest')
			);

			$register = $this->common_model->register($table, $name, $email, $additional_data, TRUE);
            $this->session->set_flashdata('message', $this->ion_auth->messages());
			$this->form_validation->reset_validation();
            $this->data['modal_success'] = modal_success('Pendaftaran', $this->title['tryout'], base_url('tryout/payment')/*$this->content_url['payment_tryout']*/, base_url('tryout/payment'));
		}
		$opt_choice = $this->set_option('choice');
		$opt_majors = $this->set_option('major');

        $this->data['message'] = validation_errors('<p>', '</p>');
        $this->data['name']['value'] = $this->form_validation->set_value('name');
		$this->data['departement'] = array(
			'name' 		=> 'departement',
			'id' 		=> 'departement',
			'options' 	=> $opt_majors,
			'selected'	=> $this->form_validation->set_value('departement'),
			'class'	=> 'input100',
		);
		$this->data['interest'] = array(
			'name'  => 'interest',
			'id'    => 'interest',
			'type'  => 'text',
            'placeholder' => lang('placeholder_interest'),
			'class'	=> 'input100',
            'value'	=> $this->form_validation->set_value('interest')
		);
		$this->data['choice'] = array(
			'name' 		=> 'choice',
			'id' 		=> 'choice',
			'options' 	=> $opt_choice,
			'selected'	=> $this->form_validation->set_value('choice'),
			'class'	=> 'input100',
		);
        /* Load Template */
        $this->template->public_render('public/tryout_sbmptn_fix', $this->data);
	}

	public function mathcomp()
	{
        $this->data['header'] = $this->title['mathcomp'];
        $this->data['title'] = $this->data['header'] . ' - ' . $this->data['title'];
        $this->data['sk_url'] = $this->sk_url['mathcomp'];
        /* Variables */
		$table 	= $this->table['mathcomp'];
		/* Validate form input */
		$this->form_validation->set_rules('name', 'lang:fullname', 'required');
		$this->form_validation->set_rules('birthplace', 'lang:birthplace', 'required');
		$this->form_validation->set_rules('date', 'lang:date', 'required');
		$this->form_validation->set_rules('month', 'lang:month', 'required');
		$this->form_validation->set_rules('year', 'lang:year', 'required');
		$this->form_validation->set_rules('email', 'lang:email', 'required|valid_email|is_unique['.$table.'.email]');
		$this->form_validation->set_rules('phone', 'lang:phone', 'required');
		$this->form_validation->set_rules('address', 'lang:address', 'required');
		$this->form_validation->set_rules('school', 'lang:school', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			$name 	= $this->input->post('name');
			$email 	= strtolower($this->input->post('email'));
			$additional_data = array(
				'birthplace'	=> $this->input->post('birthplace'),
				'birthday'		=> set_digit(2, $this->input->post('date')) .'-'. set_digit(2, $this->input->post('month')) .'-'. $this->input->post('year'),
				'phone'			=> $this->input->post('phone'),
				'address'		=> $this->input->post('address'),
				'school'		=> $this->input->post('school'),
				'tutor_name'	=> $this->input->post('tutor_name'),
				'tutor_phone'	=> $this->input->post('tutor_phone'),
			);

			$register = $this->common_model->register($table, $name, $email, $additional_data, FALSE);
            $this->session->set_flashdata('message', $this->ion_auth->messages());
			$this->form_validation->reset_validation();
            $this->data['modal_success'] = modal_success('Pendaftaran', $this->data['header'], base_url('mathcomp/payment')/*$this->content_url['payment_mathcomp']*/, base_url('mathcomp/payment'));
		}

        $this->data['message'] = validation_errors('<p>', '</p>');
		$this->data['tutor_name'] = array(
			'name'  => 'tutor_name',
			'type'  => 'text',
			'class'	=> 'input100',
            'placeholder' => lang('placeholder_tutor_name'),
            'value'	=> $this->form_validation->set_value('tutor_name')
		);
		$this->data['tutor_phone'] = $this->data['phone'];
		$this->data['tutor_phone']['name'] = 'tutor_phone';
		$this->data['tutor_phone']['value'] = $this->form_validation->set_value('tutor_phone');
        /* Load Template */
        $this->template->public_render('public/mathcomp', $this->data);
	}
	public function futsal()
	{
        $this->data['header'] = $this->title['futsal'];
        $this->data['title'] = $this->data['header'] . ' - ' . $this->data['title'];
        $this->data['sk_url'] = $this->sk_url['futsal'];
        $this->data['futsal_js'] = TRUE;
        /* Variables */
		$table 	= $this->table['futsal'];
		$this->form_validation->set_message('is_unique', '{field} ' . set_value('email') . ' sudah terdaftar.');
		/* Validate form input */
		$this->form_validation->set_rules('name', 'lang:team_name', 'required');
		$this->form_validation->set_rules('email', 'lang:email', 'required|valid_email|is_unique['.$table.'.email]');
		$this->form_validation->set_rules('phone', 'lang:phone', 'required');
		$this->form_validation->set_rules('university', 'lang:university', 'required');
		//$this->form_validation->set_rules('faculty', 'lang:faculty', 'required');
		//$this->form_validation->set_rules('departement', 'lang:departement', 'required');
		$this->form_validation->set_rules('official', 'lang:official', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			$name 	= $this->input->post('name');
			$email 	= strtolower($this->input->post('email'));
			$departement	= $this->input->post('departement');
			$faculty		= $this->input->post('faculty');

			if ($faculty == NULL || $departement == NULL) {
				$faculty = '';
				$departement = '';
			}

			$additional_data = array(
				'phone'			=> $this->input->post('phone'),
				'university'	=> $this->input->post('university'),
				'official'		=> $this->input->post('official'),
		 		'departement'	=> $departement,
		 		'faculty'		=> $faculty
			);

			$id = $this->common_model->register($table, $name, $email, $additional_data, TRUE, 3);
			$this->data['id'] = $this->encrypt($id);
            $this->session->set_flashdata('message', $this->ion_auth->messages());
			$this->form_validation->reset_validation();
            $this->data['modal_success'] = modal_success('Pendaftaran', $this->data['header'], base_url('futsal/upload')/*$this->content_url['upload_futsal']*/, base_url('futsal/upload'), 'Upload Data Pemain');
		}

            $this->data['message'] = validation_errors('<p>', '</p>');
			$this->data['name']['placeholder'] = lang('placeholder_team_name');
			$this->data['name']['value'] = $this->form_validation->set_value('name');
			$this->data['university'] = array(
				'name'  => 'university',
				'class'	=> 'input100',
                'placeholder' => lang('placeholder_university'),
                'value'	=> $this->form_validation->set_value('university')

			);
			$this->data['faculty'] = array(
				'name'  => 'faculty',
				'class'	=> 'input100',
                'placeholder' => lang('placeholder_faculty'),
                'value'	=> $this->form_validation->set_value('faculty')

			);
			$this->data['departement'] = array(
				'name'  => 'departement',
				'class'	=> 'input100',
                'placeholder' => lang('placeholder_departement'),
                'value'	=> $this->form_validation->set_value('departement')
			);
			$this->data['official'] = array(
				'name'  => 'official',
				'class'	=> 'input100',
                'placeholder' => lang('placeholder_name'),
                'value'	=> $this->form_validation->set_value('official')
			);
			$opt_group = $this->set_option('futsal');
			$this->data['group'] = array(
				'name' 		=> 'group',
				'options' 	=> $opt_group,
				'selected'	=> $this->form_validation->set_value('group'),
				'class'	=> 'input100',
			);
            /* Load Template */
            $this->template->public_render('public/futsal', $this->data);
	}

	public function upload_futsal($id = NULL)
	{
		$page_title = 'Upload Data Pemain';
		$this->data['header'] = $page_title . ' ' . $this->title['futsal'];
        $this->data['title'] = $this->data['header'] .' - ' . $this->data['title'];
        $this->data['sk_url'] = $this->sk_url['futsal'];
        $this->data['all_file'] = '';
        $error = TRUE;
        $this->data['futsal_js'] = TRUE;

        $this->form_validation->set_rules(
	        'email', 'lang:email',
	        array(
	        	'required',
				array(
					'is_exist',
					function($value)
					{
						if ($this->common_model->check($this->table['futsal'], $value) == FALSE) {
							return FALSE;
						}
						else
						{
							return TRUE;
						}
					}
				)
	        ),
	        array(
	        	'is_exist' => '{field} ' . set_value('email') . ' belum terdaftar.'
	        )
		);

        if($this->input->post('submit') && !empty($_FILES)){

			if ($this->form_validation->run() == TRUE) {

				$email = $this->input->post('email');

				$data_team = $this->common_model->get_data($this->table['futsal'], $email, 'email');
				foreach ($data_team as $key) {
					$id_team = $key->id;
				}
				if ($this->common_model->check_any($this->table['par'], array('id_team'=>$id_team, 'id_content'=> 3))) {
					$this->data['error'] = 'Anda sudah upload data pemain';
				}
				else
				{
					$id_file = $this->multiple_upload('./upload/futsal/data/');
					if ($id_file != FALSE) {
						$count = count($id_file)/2;
						foreach ($this->input->post('name') as $key => $value) {
							$data = array(
										'name' 	  => $value,
										'id_team' => $id_team,
										'id_content'=> 3,
										'id_photo'=> $id_file[$key],
										'id_card' => $id_file[$key+$count]
									);

							if (!$this->common_model->register_one($data)) {
								
								$this->data['error'] = '<p>Terjadi kesalahan dalam input data pemain</p>';
								break;
							}else{
								$this->data['modal_success'] = modal_success('', $this->data['header'], base_url('futsal/payment')/*$this->content_url['payment_futsal']*/, base_url('futsal/payment'));
							}
						}
					}
				}
			}

			//$this->data['all_file'] = $id;
        }
            /* Data */
		$this->data['name']['name'] = 'name[]';
		$this->data['name']['placeholder'] = '';
		$this->data['photo'] = array(
			'name'  => 'photo[]',
			'type'  => 'file'
		);
		$this->data['ktm'] = array(
			'name'  => 'ktm[]',
			'type'  => 'file'
		);

		$this->template->public_render('public/futsal_upload', $this->data);

	}

	public function singcomp()
	{
        $this->data['header'] = $this->title['singcomp'];
        $this->data['title'] = $this->data['header'] . ' - ' . $this->data['title'];
        $this->data['sk_url'] = $this->sk_url['singcomp'];
        /* Variables */
		$table 	= $this->table['singcomp'];
		/* Validate form input */
		$this->form_validation->set_rules('name', 'lang:team_name', 'required');
		$this->form_validation->set_rules('email', 'lang:email', 'required|valid_email|is_unique['.$table.'.email]');
		$this->form_validation->set_rules('phone', 'lang:phone', 'required');
		$this->form_validation->set_rules('university', 'lang:university', 'required');
		$this->form_validation->set_rules('song', 'lang:song', 'required');
		$this->form_validation->set_rules('group', 'lang:genre', 'required');
		$this->form_validation->set_rules('address', 'lang:address', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			$name 	= $this->input->post('name');
			$email 	= strtolower($this->input->post('email'));
			$additional_data = array(
                'phone'			=> $this->input->post('phone'),
				'university'	=> $this->input->post('university'),
				'official'		=> $this->input->post('official'),
				'song'			=> $this->input->post('song'),
				'required_song'	=> $this->input->post('required_song'),
				'address'		=> $this->input->post('address')
			);

			$id = $this->common_model->register($table, $name, $email, $additional_data, TRUE, 4);
            $this->session->set_flashdata('message', $this->ion_auth->messages());
			$this->form_validation->reset_validation();
            $this->data['modal_success'] = modal_success('Pendaftaran', $this->data['header'], base_url('singcomp/upload')/*$this->content_url['upload_singcomp']*/, base_url('singcomp/upload'), 'Upload Data Peserta');
		}

        $this->data['message'] = validation_errors('<p>', '</p>');
		$this->data['name']['placeholder'] = lang('placeholder_team_name');
		$this->data['university'] = array(
			'name'  => 'university',
			'class'	=> 'input100',
            'placeholder' => lang('placeholder_collage_or_school'),
            'value'	=> $this->form_validation->set_value('university')

		);

		$this->data['official'] = array(
			'name'  => 'official',
			'class'	=> 'input100',
            'placeholder' => lang('placeholder_name'),
            'value'	=> $this->form_validation->set_value('official')
		);
		$opt_group = $this->set_option('singcomp');
		$this->data['group'] = array(
			'name' 		=> 'group',
			'options' 	=> $opt_group,
			'selected'	=> $this->form_validation->set_value('group'),
			'class'	=> 'input100'
		);
		$this->data['song'] = array(
			'name' 		=> 'song',
            'placeholder' => lang('placeholder_song'),
			'value'	=> $this->form_validation->set_value('song'),
			'class'	=> 'input100'
		);
		$yamko  = 'Yamko Rambe Yamko';
		$sajojo = 'Sajojo';
		$song = array(
				'' => '--',
				strtolower($yamko) => $yamko,
				strtolower($sajojo) => $sajojo
		);
		$this->data['required_song'] = array(
			'name' 		=> 'required_song',
			'options' 	=> $song,
			'selected'	=> $this->form_validation->set_value('required_song'),
			'class'	=> 'input100'
		);

        /* Load Template */
        $this->template->public_render('public/singcomp', $this->data);
	}
	public function upload_singcomp($id = NULL)
	{
		$page_title = 'Upload Data Peserta';
		$this->data['header'] = $page_title . ' ' . $this->title['singcomp'];
        $this->data['title'] = $this->data['header'] .' - ' . $this->data['title'];
        $this->data['sk_url'] = $this->sk_url['singcomp'];
        $this->data['all_file'] = '';
        $error = TRUE;
        $this->data['singcomp_js'] = TRUE;

        $this->form_validation->set_rules(
	        'email', 'lang:email',
	        array(
	        	'required',
				array(
					'is_exist',
					function($value)
					{
						if ($this->common_model->check($this->table['singcomp'], $value) == FALSE) {
							return FALSE;
						}
						else
						{
							return TRUE;
						}
					}
				)
	        ),
	        array(
	        	'is_exist' => '{field} ' . set_value('email') . ' belum terdaftar.'
	        )
		);

        if($this->input->post('submit') && !empty($_FILES)){

			if ($this->form_validation->run() == TRUE) {

				$email = $this->input->post('email');

				$data_team = $this->common_model->get_data($this->table['singcomp'], $email, 'email');
				foreach ($data_team as $key) {
					$id_team = $key->id;
				}
				if ($this->common_model->check_any($this->table['par'], array('id_team'=>$id_team, 'id_content'=> 4))) {
					$this->data['error'] = 'Anda sudah upload data peserta';
				}
				else
				{
					$id_file = $this->multiple_upload('./upload/singcomp/data/');
					if ($id_file != FALSE) {
						$count = count($id_file)/2;
						$position = $this->input->post('position');
						foreach ($this->input->post('name') as $key => $value) {
							$data = array(
										'name' 	  => $value,
										'description'=> $position[$key],
										'id_team' => $id_team,
										'id_content'=> 4,
										'id_photo'=> $id_file[$key],
										'id_card' => $id_file[$key+$count]
									);

							if (!$this->common_model->register_one($data)) {
								
								$this->data['error'] = '<p>Terjadi kesalahan dalam input data pemain</p>';
								break;
							}else{
								$this->data['modal_success'] = modal_success('', $this->data['header'], base_url('singcomp/payment')/*$this->content_url['payment_singcomp']*/, base_url('singcomp/payment'));
							}
						}
					}
				}
			}

			//$this->data['all_file'] = $id;
        }
            /* Data */
		$this->data['name']['name'] = 'name[]';
		$this->data['position'] = array(
			'name'  => 'position[]',
			'type'  => 'text',
			'class'	=> 'input100',
            'placeholder' => lang('position'),
            'value'	=> $this->form_validation->set_value('position')
		);

		$this->data['photo'] = array(
			'name'  => 'photo[]',
			'type'  => 'file'
		);
		$this->data['ktm'] = array(
			'name'  => 'ktm[]',
			'type'  => 'file'
		);
		$opt_group = $this->set_option('singcomp');
		$this->data['group'] = array(
			'name' 		=> 'group',
			'options' 	=> $opt_group,
			'selected'	=> $this->form_validation->set_value('group'),
			'class'	=> 'input100'
		);
		$this->template->public_render('public/singcomp_upload', $this->data);

	}
	function set_option($name)
	{
        $groups = $this->common_model->get_groups($name);
		if ($groups) {
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

	function accept_terms($name = 'accept')
	{
        if ($this->input->post($name))
		{
			return TRUE;
		}
		else
		{
			$error = 'Silahkan membaca dan menerima syarat dan ketentuan kami.';
			$this->form_validation->set_message('accept_terms', $error);
			return FALSE;
		}
	}

	// function unique_email($email)
	// {
 //        if ($this->input->post($email))
	// 	{
	// 		return TRUE;
	// 	}
	// 	else
	// 	{
	// 		$error = 'Silahkan membaca dan menerima syarat dan ketentuan kami.';
	// 		$this->form_validation->set_message('accept_terms', $error);
	// 		return FALSE;
	// 	}
	// }
	
	function encrypt($string)
	{
		$this->init_encryption();
		$new = $this->encryption->encrypt($string);
		$new = str_replace(array('+', '/', '='), array('-', '_', '~'), $new);
		return $new;
	}

	function decrypt($string)
	{
		$this->init_encryption();
		$new = str_replace(array('-', '_', '~'), array('+', '/', '='), $string);
		$new = $this->encryption->decrypt($new);
		return $new;
	}

	function init_encryption()
	{
		return $this->encryption->initialize(array('cipher' => 'blowfish', 'mode' => 'ecb'));
	}

	function resize_image($path)
	{
		$this->load->library('image_lib');

		$config['image_library'] = 'gd2';
		$config['source_image'] = $path;
		$config['maintain_ratio'] = TRUE;
		$config['width']         = 600;
		$config['height']       = 600;

		$this->image_lib->clear();
	    $this->image_lib->initialize($config);
		$this->image_lib->resize();
	}
	
	function re_array($unset = array('photo', 'ktm'))
	{
		foreach ($_FILES as $name => $array)
		{
			foreach($array as $key => $val)
			{
				$i = 1;
				foreach($val as $v)
				{
					$field_name = $name . '_' . $i;
					$_FILES[$field_name][$key] = $v;
					$i++;
				}
			}
		}
		foreach ($unset as $key => $value) {
			unset($_FILES[$value]);
		}
	}

	function multiple_upload($path)
	{
		$error = TRUE;
		$config['upload_path']      = $path;
        $config['allowed_types']    = 'pdf|gif|jpg|png|jpeg';
        $config['max_size']         = 2048;
        $config['file_ext_tolower'] = TRUE;
        $this->load->library('upload', $config);

        $this->re_array();

		foreach($_FILES as $field_name => $file)
		{
			if ($this->upload->do_upload($field_name))
			{
				$image_data =   $this->upload->data();
				$this->resize_image($image_data['full_path']);
				$data_file = array(
					'file_name' 		=> $image_data['file_name'],
					'file_type'			=> $image_data['file_type'],
					'file_size'			=> $image_data['file_size'],
					'file_ext'			=> $image_data['file_ext']
				);
				$id_file[] = $this->common_model->upload($data_file);
				$error = FALSE;
			}
			else
			{
				$this->data['error'] = '<p>' . $file['name'] . ' : ' . $this->upload->display_errors('', '') . '</p>';
				$error = TRUE;
				break;
			}
		}

		if (!$error) {
			return $id_file;
		}
		else
		{
			return FALSE;
		}
	}
	public function send_email($email = 'otenk203@gmail.com', $name = 'Maftuh Mashuri')
	{
		$this->load->library('email');
		$this->email->from('maftuhsafii@gmail.com');
		$this->email->to($email);
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');

		$this->email->send();
	}
}
