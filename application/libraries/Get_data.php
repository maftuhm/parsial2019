<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_data
{
	protected $CI;
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->model(array('common/common_model'));
		// $this->CI->config->load('ion_auth', TRUE);
		// $this->tables = $table;
	}

	public function get_data($table, $id = NULL, $edit = FALSE)
    {
        // $table = $this->tables['tryout'];
        if ($id == NULL) {
            $this->data['tryout'] = $this->CI->common_model->get_data($table);
        }
        else
        {
            $this->data['tryout'] = $this->CI->common_model->get_data($table, $id);            
        }
        foreach ($this->data['tryout'] as $k => $user)
        {
            if ($edit === TRUE) {
                $this->data['tryout'][$k] = $user;
            }
            $this->data['tryout'][$k]->choices  = $this->CI->common_model->get_users_group($user->id, 'choice');
            $this->data['tryout'][$k]->majors   = $this->CI->common_model->get_users_group($user->id, 'major');
            $this->data['tryout'][$k]->payment  = $this->CI->common_model->get_payment($user->id, $table);
            foreach ($this->data['tryout'][$k]->choices as $key => $value) {
                // $this->data['tryout'][$k]->format = $this->CI->admin_model->get_format_number($value->id);
            }
        }
        return $this->data;
    }
}
