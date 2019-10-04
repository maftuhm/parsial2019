<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
		$this->load->database();
		$this->load->helper('cookie');
		$this->load->helper('date');
		$table = $this->config->item('tables', 'ion_auth');
		$this->lang->load('ion_auth');
    }

	/*================= GET USERS DATA =================*/

    public function get_data($table, $value = NULL, $get_by = 'id')
    {
    	// if ($by_id) {
    	// 	$key = 'id';
    	// }else{
    	// 	$key = 'email';
    	// }

    	if ($value === NULL)
    	{
	      	$query = $this->db->get($table);
    	}
    	else
    	{
    		if (!is_array($get_by)) {
    			$get_by = array($get_by => $value);
    		}
    		$query = $this->db->get_where($table, $get_by);
    	}
		return $query->result();
	}

	public function get_users_group($id, $name, $content_id = FALSE)
	{
		$table = $this->table['par_groups'];
		$this->db->select('*');
		if ($content_id == FALSE) {
			$group = $this->table['to_groups'];
			$this->db->from($group);
			$this->db->join($table, $table.'.id = '.$group.'.'.$name.'_id');
		}else{
			$group = $this->table['common_groups'];
			$this->db->from($group);
			$this->db->join($table, $table.'.id = '.$group.'.group_id');
			$this->db->where('content_id', $content_id);
		}
		$this->db->where('participant_id', $id);
		$query = $this->db->get();
		return $query->result();
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

	public function check($table, $email = NULL, $value = '', $additional_key = 'payment_type')
	{
		if (!empty($value)) 
		{
			$this->db->where($additional_key, $value);
		}
		if ($email != NULL) {
			$this->db->where('email', $email);
		}
		$this->db->limit(1);
		return  $this->db->count_all_results($table) > 0;
	}

	public function check_any($table, $array)
    {

		$this->db->where($array);
		$this->db->limit(1);
		return  $this->db->count_all_results($table) > 0;
	}


	public function get_payment($id = NULL, $payment_type = NULL)
	{
		$query = $this->db->get_where($this->table['payment'], array('participant_id' => $id, 'payment_type' => $payment_type));
		if ($query->num_rows() > 0) {
 			return $query->result();
		}
		else
		{
 			return FALSE;
		}
	}
	public function get_format_number($id_format, $get = 'number')
	{
		$query = $this->db->select($get)
							->where('id', $id_format)
							->limit(1)
							->get('format_number')
							->row();
		return $query->$get;
	}

	public function get_content($value, $result = 'id', $key = 'slug')
	{
		$query = $this->db->select($result)
							->where($key, $value)
							->limit(1)
							->get('contents')
							->row();
		return $query->$result;;
	}
	/*================= GET USERS DATA =================*/

	/*================= INPUT USERS DATA =================*/

	public function set_payment($table)
	{
		$email = $this->input->post('email');
		$query = $this->db->get_where($table, array('email' => $email))->row();
		$content_id = $this->get_content($table, 'id', 'name');
 		$id = $query->id;
		$data = array(
						'time'				=> time(),
						'participant_id'	=> $id,
						'payment_type'		=> $table,
						'content_id'		=> $content_id,
						'account_owner'		=> $this->input->post('name'),
						'email'				=> $email,
						'file_name' 		=> $this->upload->data('file_name'),
    					'file_type'			=> $this->upload->data('file_type'),
    					'file_size'			=> $this->upload->data('file_size'),
    					'file_ext'			=> $this->upload->data('file_ext')
					);
		return $this->db->insert($this->table['payment'], $data);
	}

	public function register($table, $name, $email, $additional_data = array(), $groups = FALSE, $content_id = NULL)
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
	    		$this->add_to_common_group($id, $group_id, $content_id);
			}
		}
		return (isset($id)) ? $id : FALSE;
	}

	public function register_one($data)
	{
		return $this->db->insert('participants', $data);
	}

	public function upload($data)
	{
		$this->db->insert($this->table['file'], $data);
		$id = $this->db->insert_id($this->table['file'] . '_id_seq');

		return $id;
	}
	public function add_to_tryout_group($user_id, $choice_id, $major_id)
	{

		$data = array(
					'participant_id' 	=> $user_id,
					'choice_id'			=> $choice_id,
					'major_id'			=> $major_id
				);
		$this->db->insert($this->table['to_groups'], $data);
	}

    public function add_to_common_group($user_id, $group_id, $content_id)
	{
		$data = array(
					'content_id'		=> (int)$content_id,
					'participant_id' 	=> (int)$user_id,
					'group_id'			=> (int)$group_id
				);
		$this->db->insert('common_groups', $data);
	}

	/*================= INPUT USERS DATA =================*/

	/*================= ACTIONS =================*/

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
	/*================= ACTIONS =================*/
}
