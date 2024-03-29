<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Participants_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
		$this->load->database();
		$this->load->helper('cookie');
		$this->load->helper('date');
		$table = $this->config->item('tables', 'ion_auth');
		$this->lang->load('ion_auth');
    }

    public function input_participant($table, $data)
    {

    	return $this->db->insert($table, $data);
    }
    
    public function get_data($table, $email = NULL)
    {
    	if ($email === NULL)
    	{
	      	$query = $this->db->get($table);
    	}
    	else
    	{
    		$query = $this->db->get_where($table, array('email' => $email));
    	}
		return $query->result();
	}
    
    public function register_tryout()
    {
    	$table = $this->table['tryout'];
		$ip_address = $this->input->ip_address();

		$data = array(
    		'ip_address' 	=> $ip_address,
    		'created_on'	=> time(),
			'name'			=> $this->input->post('name'),
			'birthplace'	=> $this->input->post('birthplace'),
			'birthday'		=> $this->input->post('birthday'),
			'phone'			=> $this->input->post('phone'),
			'address'		=> $this->input->post('address'),
			'school'		=> $this->input->post('school'),
			'email'			=> strtolower($this->input->post('email')),
			'interest'		=> $this->input->post('interest')
		);

		$this->db->insert($table, $data);
		$id = $this->db->insert_id($table . '_id_seq');

		$id_choice = $this->get_id_group($this->input->post('choice'));
		$id_major = $this->get_id_group($this->input->post('major'));

		$this->add_to_group($id, $id_choice, $id_major);
    }

	public function get_groups($description = NULL)
	{
		$table = $this->table['par_groups'];
		if ($description != NULL) {
			$query = $this->db->query("SELECT name FROM $table WHERE description = '$description'");
		}
		else
		{
			$query = $this->db->get($table);
		}
		return $query->result();
	}

	public function get_id_group($name)
	{
		$group = $this->db->get_where($this->table['par_groups'], array('name' => $name), 1)->row();
 		$id = $group->id;
 		return $id;
	}

	// public function check($table, $email)
	// {
 //    	$query = $this->db->get_where($table, array('email' => $email));
 //    	if ($query->num_rows() > 0) {
 //    		return TRUE;
 //    	}else{
	//     	return FALSE;    		
 //    	}
	// }

	public function set_payment($table)
	{
		$email = $this->input->post('email');
		// if ($this->check($table, $email))
		// {	
		// 	// $this->set_error('account_creation_duplicate_email');
		// 	return FALSE;
		// }

		$query = $this->db->get_where($table, array('email' => $email))->row();
 		$id = $query->id;
		$data = array(
						'time'				=> time(),
						'participant_id'	=> $id,
						'payment_type'		=> $table,
						'account_owner'		=> $this->input->post('name'),
						'email'				=> $email,
						'file_name' 		=> $this->upload->data('file_name'),
    					'file_type'			=> $this->upload->data('file_type'),
    					'file_size'			=> $this->upload->data('file_size'),
    					'file_ext'			=> $this->upload->data('file_ext')
					);
		return $this->db->insert($this->table['payment'], $data);
	}

	public function register($table, $name, $email, $additional_data = array(), $groups = FALSE)
	{
		if ($this->check($table, $email))
		{	
			$this->set_error('account_creation_duplicate_email');
			return FALSE;
		}

		$ip_address = $this->_prepare_ip($this->input->ip_address());
		$data = array(
					'ip_address'	=> $ip_address,
		    		'created_on'	=> time(),
					'name' 			=> $name,
					'email' 		=> $email
				);
		$user_data = array_merge($this->_filter_data($table, $additional_data), $data);
		$this->db->insert($table, $user_data);

		$id = $this->db->insert_id($table . '_id_seq');

		if ($groups)
		{
			if ($table == $this->table['tryout']){

				$id_choice = $this->get_id_group($this->input->post('choice'));
				$id_major = $this->get_id_group($this->input->post('departement'));

				$this->add_to_tryout_group($id, $id_choice, $id_major);
			}
			else
			{
				$group_id = $this->get_id_group($this->input->post('group'));
	    		$this->add_to_group($id, $group_id);
			}
		}
		return (isset($id)) ? $id : FALSE;
	}

	public function add_to_tryout_group($user_id = FALSE, $choice_id, $major_id)
	{

		// if no id was passed use the current users id
		$user_id || $user_id = $this->session->userdata('user_id');
		
		$data = array(
					'participant_id' 	=> $user_id,
					'choice_id'			=> $choice_id,
					'major_id'			=> $major_id
				);
		$this->db->insert($this->table['to_groups'], $data);
	}

    public function add_to_group($user_id = FALSE, $group_id)
	{
		$user_id || $user_id = $this->session->userdata('user_id');
		$data = array(
					'participant_id' 	=> $user_id,
					'group_id'			=> $group_id,
				);
		$this->db->insert($this->table['common_groups'], $data);
	}

	public function upload_file($table, $data)
	{
		# code...
	}

	public function check($table, $email, $payment_type = NULL)
	{
		if ($payment_type != NULL) 
		{
			$this->db->where('payment_type', $payment_type);
		}		
		$this->db->where('email', $email);
		$this->db->limit(1);
		return  $this->db->count_all_results($table) > 0;
	}

	public function set_error($error)
	{
		$this->errors[] = $error;
		return $error;
	}

	protected function _filter_data($table, $data)
	{
		$filtered_data = array();
		$columns = $this->db->list_fields($table);

		if (is_array($data))
		{
			foreach ($columns as $column)
			{
				if (array_key_exists($column, $data))
					$filtered_data[$column] = $data[$column];
			}
		}

		return $filtered_data;
	}
	protected function _prepare_ip($ip_address) {
		return $ip_address;
	}
}
