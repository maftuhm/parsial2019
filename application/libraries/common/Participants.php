<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Participants {

	public function __construct()
	{
		$this->load->library(array('email'));
		$this->load->helper(array('cookie', 'language','url'));

		$this->load->library('session');

		$this->load->model('public/participants_model');
	}
	
	public function register($table, $name, $email, $additional_data = array(), $groups = array())
	{
		# code...
	}
	public function set_payment($content)
	{
		# code...
	}
	public function upload_file($table, $data)
	{
		# code...
	}
}
