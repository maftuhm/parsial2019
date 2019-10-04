<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Print_card extends Public_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->data['required'] = lang('form_required');
    }

    public function print($content = NULL)
	{
        $this->data['tryout'] = array();
        if (!key_content($content, $this->data['content_title'])){
			show_404();
        }
        else
        {
			$table = $this->table[$content];
			$this->data['header'] = 'Cetak Kartu ' . $this->data['content_title'][$content];
	        $this->data['title'] = $this->data['header'] . ' - ' . $this->data['title'];
	        $this->data['sk_url'] = $this->sk_url['tryout'];

			$this->form_validation->set_rules('date', 'lang:date', 'required');
			$this->form_validation->set_rules('month', 'lang:month', 'required');
			$this->form_validation->set_rules('year', 'lang:year', 'required');
			$this->form_validation->set_rules('email', 'lang:email', 'required|valid_email');
			$email 				= strtolower($this->input->post('email'));
			$is_exist 			= $this->common_model->check($table, $email);
			if ($this->form_validation->run() == TRUE)
			{
				$email_value = $this->form_validation->set_value('email');
				if ($is_exist == FALSE) {
					$this->data['message'] = modal_error($this->data['header'], '<p>Email '. $email_value.' belum terdaftar.</p>', FALSE);;
				}
				else
				{
					$input_date = set_digit(2, $this->input->post('date')) .'-'. set_digit(2, $this->input->post('month')) .'-'. $this->input->post('year');

					$this->data['tryout'] = $this->common_model->get_data($table, $email, 'email');

					foreach ($this->data['tryout'] as $k => $user)
			        {
			        	$user_name = $user->name;
			        	$user_birthday 	= $user->birthday;
		                $number = $this->data['tryout'][$k]->number;
			            $this->data['tryout'][$k]->choices  = $this->common_model->get_users_group($user->id, 'choice');
			            $this->data['tryout'][$k]->majors   = $this->common_model->get_users_group($user->id, 'major');
			            foreach ($this->data['tryout'][$k]->choices as $key => $value) {

				        	$format = $this->common_model->get_format_number($value->id);
			                $digit = $this->common_model->get_format_number($value->id, 'digit');
			                $position = $this->common_model->get_format_number($value->id, 'position');
			                $number = $this->data['tryout'][$k]->number;
			                $this->data['tryout'][$k]->choice = $value->name;
			                $this->data['tryout'][$k]->color = $value->bgcolor;
			                $this->data['tryout'][$k]->old_number = $number;
			                if ($number != 0) {
			                    $this->data['tryout'][$k]->number = insert_at_position($format, set_digit($digit, $number), $position);
			                }else{
			                    $this->data['tryout'][$k]->number = '';
			                }
			            }
			        }

					if ($input_date == $user_birthday) {
						$has_uploaded 		= $this->common_model->check($this->table['payment'], $email, $this->table['tryout']);
						if ($has_uploaded) {
							if (!empty($number)) {
								$this->download($this->data, $user_name);
							}
							else
							{
								$this->data['message'] = modal_error($this->data['header'], '<p>Bukti pembayaran yang anda kirim belum kami periksa. Mohon kesediaannya untuk menunggu konfirmasi dari kami.</p>', FALSE);
							}
						}
						else
						{
							$this->data['message'] = modal_error($this->data['header'], '<p>Anda belum upload bukti pembayaran.</p>', FALSE);
						}
					}else{
						//$this->data['message'] = 'Tanggal lahir yang anda masukkan salah.';
						$this->data['message'] = modal_error($this->data['header'], '<p>Tanggal lahir yang anda masukkan salah.</p>');
					}
					
				}
			}
			else
			{
				//$this->data['message'] = modal_error($this->data['title'], validation_errors());
			}

			/* Data */
			$this->data['email'] = array(
				'name'  => 'email',
				'type'  => 'email',
				'class'	=> 'input100',
	            'placeholder' => lang('email'),
                'value'	=> $this->form_validation->set_value('email')
			);
			$this->data['date'] = array(
				'name'  => 'date',
				'id'    => 'date',
				'options' 	=> set_option_date('d'),
				'selected'	=> $this->form_validation->set_value('date'),
				'class'	=> 'first input100',
			);
			$this->data['month'] = array(
				'name'  => 'month',
				'id'    => 'month',
				'options' 	=> set_option_date('m'),
				'selected'	=> $this->form_validation->set_value('month'),
				'class'	=> 'second input100',
                // 'required' => 'required'
			);
			$this->data['year'] = array(
				'name'  => 'year',
				'id'    => 'year',
				'options' 	=> set_option_date('y'),
				'selected'	=> $this->form_validation->set_value('year'),
				'class'	=> 'third input100',
                // 'required' => 'required'
			);
			$this->data['accept'] = array(
				'name'  => 'accept_terms_checkbox',
				'class'    => 'checkbox',
				'type'  => 'checkbox',
	            'checked'	=> set_checkbox('accept_terms_checkbox')
			);
	        
			$this->template->public_render('public/print_card', $this->data);
		}
	}
	public function download($data, $name)
	{
	    $this->load->library('html2pdf');
		$this->load->helper('file');
	    //Set folder to save PDF to
	    $folder = './assets/pdfs/';
	    $this->html2pdf->folder($folder);

	    //Set the filename to save/download as
	    $name = time().' '.$name.' Tryout SBMPTN PARSIAL2019.pdf';
	    $filename = str_replace(' ', '_', $name);
	    $this->html2pdf->filename($filename);
	    
	    //Set the paper defaults
	    $this->html2pdf->paper('a4', 'landscape');
	    
	    //Load html view
	    $this->html2pdf->html($this->load->view('pdf', $data, true));
	    
	    if($this->html2pdf->create('save')) {
	    	$data = get_file_info($folder.$filename);
	    	$data_file = array(
	    		'file_name' => $data['name'],
	    		'file_size' => $data['size'],
	    		'file_ext'  => '.pdf',
	    		'file_type' => 'pdf'
	    	);
	    	$this->common_model->upload($data_file);
	    	redirect('/assets/pdfs/'.$filename, 'refresh');
	    }
	}
}