<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push(lang('menu_resources'));
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, lang('menu_resources'), 'admin/resources');
    }


	public function index()
	{
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}
        else
        {
            $this->data['show_ckeditor'] = TRUE;
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            /* Load Template */
            $this->template->admin_render('admin/email/send', $this->data);
        }
	}
    public function send($value='')
    {
        $config = array(    
              'protocol' => 'sendmail',
              'smtp_host' => 'ssl://smtp.gmail.com',
              'smtp_port' => 465,
              'smtp_user' => 'maftuhsafii@gmail.com',
              'smtp_pass' => 'm4ftuhmpuh',
              'smtp_timeout' => '4',
              'mailtype' => 'html',
              'charset' => 'iso-8859-1'
            );
        $config['mailtype'] = 'html';

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $this->email->set_header('Content-type', 'text/html');
        $this->email->from('parsialhimatika.uinjkt@gmail.com', 'PARSIAL 2019');

        $data = array(
            'title'=> 'Pendaftaran Berhasil',
            'judul_email' => 'Pendaftaran Berhasil',
            'nama_peserta' => 'Nadhira Adinda Salsabila',
            'text' => 'Terimakasih telah mendaftarkan diri anda untuk mengikuti Mathematics Competition Parsial 2019. Harap menghadiri kegiatan yang sudah kami tentukan. Mohon maaf atas keterlambatan kami dalam mengkonfirmasi pendaftaran anda.',
            'cp' => 'Maftuh'
        );

        $this->email->to('nadhira.asalsabila@gmail.com');
        $this->email->subject($data['title']);
        $message = $this->load->view('email_template.php', $data, TRUE);
        //$message = '<h1>Maftuh Mashuri</h1> <p>tes email aja</p>';
        $this->email->message($message); 
        $this->email->send();
    }

    public function send_all($range = '')
    {
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        else
        {
            //$table = 'email_sample';
            $this->data['all'] = $this->common_model->get_data($table);
            $config = array(    
                  'protocol' => 'sendmail',
                  'smtp_host' => 'ssl://smtp.gmail.com',
                  'smtp_port' => 465,
                  'smtp_user' => 'maftuhsafii@gmail.com',
                  'smtp_pass' => 'm4ftuhmpuh',
                  'smtp_timeout' => '4',
                  'mailtype' => 'html',
                  'charset' => 'iso-8859-1'
                );
            $this->load->library('email', $config);
            //$range_number = explode('-',$range);
            //$i = 1;
            foreach ($this->data['all'] as $k) {
                //if ($i >= $range_number[0] AND $i <= $range_number[1]) {
                    $arr = explode(' ',trim($k->name));
                    $new_name =  upper_first($arr[0]);
                    $email = $k->email;
                    $data['name'] = $new_name;
                    $this->email->set_newline("\r\n");
                    $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
                    $this->email->set_header('Content-type', 'text/html');
                    $this->email->from('maftuhsafii@gmail.com', 'Maftuh');

                    $this->email->to($email);
                    $this->email->subject('PARSIAL 2019 Closing Ceremony');
                    $message = $this->load->view('email_template_promosi.php', $data, TRUE);
                    $this->email->message($message); 
                    $this->email->send();
                //}
                //$i++;
            }
        }
    }
}
