<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends Public_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->data['required'] = lang('form_required');
    }
    public function upload_payment($content = NULL)
	{
		$content_exist = $this->common_model->check_any('contents', array('slug' => $content));

        if (!$content_exist){
			show_404();
        }
        else
        {
        	// $data_content = $this->common_model->get_data('contents', $content, 'slug');
        	// foreach ($data_content as $key) {
        	// 	$title = $key->title;
        	// 	$id_content = $key->id;
        	// }
	        $this->data['header'] = $this->common_model->get_content($content, 'title');
			$this->data['page_title'] = 'Konfirmasi Pembayaran';
			//$this->data['header'] = $this->data['content_title'][$content];
	        $this->data['title'] = $this->data['page_title'] . ' ' . $this->data['header'] .' - ' . $this->data['title'];
	        $this->data['sk_url'] = $this->sk_url[$content];
	        //$this->data['tes'] = $data_content;
	        $this->data['show_filedrag'] = TRUE;
	        // if ($this->data['tes']) {
	        // 	$this->data['tes'] = '122';
	        // }
	        /* Conf */
	        $config['upload_path']      = './upload/'.$content.'/';
	        $config['allowed_types']    = 'pdf|gif|jpg|png|jpeg';
	        $config['max_size']         = 4096;
	        $config['max_width']        = 4096;
	        $config['max_height']       = 4096;
	        $config['file_ext_tolower'] = TRUE;

	        $this->load->library('upload', $config);
			
			$this->table_content = $this->table[$content];
			$this->form_validation->set_rules('name', 'lang:fullname', 'required');
			$this->form_validation->set_rules(
		        'email', 'lang:email',
		        array(
		        	'required',
					array(
						'is_exist',
						function($value)
						{
							if ($this->common_model->check($this->table_content, $value) == FALSE) {
								return FALSE;
							}
							else
							{
								return TRUE;
							}
						}
					),
					array(
						'has_uploaded',
						function($value)
						{
							if ($this->common_model->check($this->table['payment'], $value, $this->table_content)) {
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
		        	'is_exist' => '{field} ' . set_value('email') . ' belum terdaftar.',
		        	'has_uploaded' => '{field} ' . set_value('email') . ' sudah upload bukti pembayaran.'
		        )
			);
			$email 				= strtolower($this->input->post('email'));
//			$is_exist 			= $this->common_model->check($this->table_content, $email);
//			$has_uploaded 		= $this->common_model->check($this->table['payment'], $email, $this->table_content);
			
			$upload = FALSE;

			if ($this->form_validation->run() == TRUE)
			{
				$email_value = $this->form_validation->set_value('email');
				// if ($is_exist == FALSE) {
				// 	$this->data['message'] = '<p>Email '. $email_value.' belum terdaftar.</p>';
				// }
				// else
				// {
					// if ($has_uploaded) {
					// 	$this->data['message'] = '<p>Email '. $email_value.' sudah upload bukti pembayaran.</p>';
					// }
					// else
					// {
			            $upload = $this->upload->do_upload('userfile');						
					// }
				// }
			}
			else
			{
				$this->data['message'] = validation_errors('<p>', '</p>');
			}
			
			if ($upload == TRUE)
			{

				if ($this->common_model->set_payment($this->table_content))
				{
					$this->form_validation->reset_validation();
					if ($content == 'tryout') {
						$add_message = ' Terima kasih atas konfirmasi pembayaran anda, kami akan segera memeriksanya. Jika pembayaran Anda sudah masuk ke rekening bank kami, kami akan kirimkan link download kartu peserta melalui email nomor handphone anda.';
						$this->data['modal_success'] = modal_success('Konfirmasi Pembayaran', $this->data['header'] , base_url('tryout/print')/*$this->content_url['print_tryout']*/, base_url('tryout/print'), 'Cetak Kartu Peserta', $add_message);
					}
					else
					{
						$this->data['modal_success'] = modal_success('Konfirmasi Pembayaran', $this->data['header']);
					}
					
					// redirect('payment', 'refresh');

				}
				else
				{
					$this->data['message'] =  validation_errors('<p>', '</p>');
				}

			}
			else
			{
				$this->data['error'] = $this->upload->display_errors();
			}

	            /* Data */
			$this->data['name'] = array(
				'name'  => 'name',
				'type'  => 'text',
				'class'	=> 'input100',
	            'placeholder' => lang('placeholder_name'),
                'value'	=> $this->form_validation->set_value('name')
			);
			$this->data['email'] = array(
				'name'  => 'email',
				'type'  => 'email',
				'class'	=> 'input100',
	            'placeholder' => lang('placeholder_email'),
                'value'	=> $this->form_validation->set_value('email')
			);
			$this->data['file'] = array(
				'name'  => 'userfile',
				'id'    => 'fileselect',
				'size'	=> '20',
				'type'  => 'file',
			);
			$this->data['accept'] = array(
				'name'  => 'accept_terms_checkbox',
				'class'    => 'checkbox',
				'type'  => 'checkbox',
	            'checked'	=> set_checkbox('accept_terms_checkbox')
			);
	        //$add_message = ' Terima kasih atas konfirmasi pembayaran anda, kami akan segera memeriksanya. Jika pembayaran Anda sudah masuk ke rekening bank kami, kami akan kirimkan link download kartu peserta melalui email anda.';
						//$this->data['modal_success'] = modal_success('Konfirmasi Pembayaran', $this->data['header'] , base_url('print/tryout'), 'Cetak Kartu Peserta', $add_message);
			$this->template->public_render('public/payment', $this->data);
		}
	}
	// function is_exist($email, $table)
	// {
	// 	if ($this->common_model->check($table, $email)) {
	// 		return TRUE;
	// 	}
	// 	else
	// 	{
	// 		$this->form_validation->set_message('is_exist', '{field} ' . set_value('email') . ' belum terdaftar.');
	// 		// $error = 'Email '. $email . ' belum terdaftar';
	// 		// $this->form_validation->set_message('email', $message);
	// 		return FALSE;
	// 	}
	// }
}