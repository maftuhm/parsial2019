<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Load_data extends CI_Controller{

    protected $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->model('admin/admin_model');
	}
	public function get_data_tryout()
	{
	    $this->data['tryout'] = $this->CI->admin_model->get_tryout();
        foreach ($this->data['tryout'] as $k => $user)
        {
            $this->data['tryout'][$k]->choices  = $this->CI->admin_model->get_users_group($user->id, 'choice');
            $this->data['tryout'][$k]->majors   = $this->CI->admin_model->get_users_group($user->id, 'major');
            $this->data['tryout'][$k]->payment  = $this->CI->admin_model->get_payment($user->id, 'tryout_sbmptn');
            foreach ($this->data['tryout'][$k]->choices as $key => $value) {
                $this->data['tryout'][$k]->format = $this->CI->admin_model->get_format_number($value->id);
            }
        }
        return $this->data;
	}
}