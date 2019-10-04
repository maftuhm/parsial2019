<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 *cara penggunaan
 *load dulu helper kirim_sms nya
 *untuk menjalankannya cukup dengan kirim_sms('no hp tujuan','isi pesan')
 *Author : Anton (Jhe)
 * terimakasih

*/
class Welcome extends CI_Controller {

	public function __construct() {
       	 parent::__construct();
        $this->load->helper('kirim_sms');
    }
	public function index()
	{
		kirim_sms('085777455031','percobaan kirim sms dari zenziva');
	}
	
}
