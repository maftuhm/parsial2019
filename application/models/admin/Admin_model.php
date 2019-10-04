<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
		$this->table = $this->config->item('tables', 'ion_auth');
    }

	/*================= GET USERS DATA =================*/

	public function update($table, $id, $data, $data_group = array(), $content_id = 1)
	{
		$this->db->trans_begin();
		if (!empty($data_group)) {
			if ($table == $this->table['tryout']) {
				$par_groups = $this->table['to_groups'];
				$check = array('participant_id' => $id);
			}
			else
			{
				$par_groups = $this->table['common_groups'];
				$check = array('content_id' => $content_id, 'participant_id' => $id);
			}
			if ($this->check_any($par_groups, $check)) {
				$this->db->update($par_groups, $data_group, $check);
			}
			else
			{
				$new_data_group = array_merge($check, $data_group);
				$this->db->insert($par_groups, $new_data_group);
			}
		}

		$this->db->update($table, $data, array('id' => $id));
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		}
		$this->db->trans_commit();
		return TRUE;
	}

	public function set_number($table, $id, $group_id, $number = NULL, $digit = 4, $start)
	{
		$this->db->trans_begin();
		if ($number == NULL) {
			$no = $this->get_last_number($table, $start, $group_id);
		}
		else
		{
			if ($this->check_any($table, array('number' => $number)))
			{
				return FALSE;
			}
			$no = (int)$number;
		}

		$num = set_digit($digit, $no);
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		}

		$this->db->update($table, array('number' => $num), array('id' => $id), 1);
		$this->db->trans_commit();
		
		return TRUE;
	}

 //    public function get_tryout($id = NULL)
 //    {
 //    	if ($id === NULL)
 //    	{
	//       	$query = $this->db->get($this->table['tryout']);
 //    	}
 //    	else
 //    	{
 //    		$query = $this->db->get_where($this->table['tryout'], array('id' => $id));
 //    	}
	// 	return $query->result();
	// }

	// public function get_users_group($id, $group)
	// {
	// 	$table = $this->table['par_groups'];
	// 	$to_group = $this->table['to_groups'];
	// 	$to = $this->table['tryout'];

	// 	$this->db->select('*');
	// 	$this->db->from($to_group);
	// 	$this->db->join($table, $table.'.id = '.$to_group.'.'.$group.'_id');
	// 	$this->db->where('participant_id', $id);
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }
	
	// public function get_id_group($name)
	// {
	// 	$group = $this->db->get_where($this->table['par_groups'], array('name' => $name), 1)->row();
 // 		$id = $group->id;
 // 		return $id;
	// }

	// public function get_groups($description = NULL)
	// {
	// 	$table = $this->table['par_groups'];
	// 	if ($description != NULL) {
	// 		$query = $this->db->query("SELECT name FROM $table WHERE description = '$description'");
	// 	}
	// 	else
	// 	{
	// 		$query = $this->db->get($table);
	// 	}
	// 	return $query->result();
	// }
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

	public function get_last_number($table, $start, $group_id)
	{
		$to_group = $this->table['to_groups'];
		$this->db->select('*');
		$this->db->from($to_group)->where('choice_id', $group_id);
		$this->db->join($table, $table.'.id = '.$to_group.'.participant_id');

		$all = $this->db->get()->result();

		$set = array();
		foreach ($all as $key) {
			if ($key->number != '') {
				array_push($set, (int)$key->number);
			}
		}
		sort($set);
		$last = end($set);
		if ($start > $last) {
			return $start;			
		}else{
			$range = range($start,$last);
			$miss = array_diff($range, $set);
			if (!empty($miss)) {
				return reset($miss);
			}
			else
			{
				return $last+1;
			}
		}
	}

	/*
	* Ini untuk mengambil semua data format nomor berdasarkan id
	*/
	public function get_format_number($id_format)
	{
		$query = $this->db->select('*')
							->where('id', $id_format)
							->limit(1)
							->get('format_number')
							->result();
		return $query;
	}

	/*
	DELETE MASIH BELOM BENER KARENA MASIH BELUM DI TENTUKAN KONTEN MANA YANG MAU DI HAPUS
	*/
	public function delete($table, $id, $content_id = 1)
	{
		$check = $this->check_any($table, array('id' => $id));
		if ($check) 
		{
			$check_payment = $this->check_any($this->table['payment'], array('participant_id' => $id, 'payment_type' => $table));
			if ($check_payment) {
				$this->db->delete($this->table['payment'], array('participant_id' => $id, 'payment_type' => $table));
			}
			if ($table == $this->table['tryout']) {
				$table_group = $this->table['to_groups'];
				$this->db->delete($table_group, array('participant_id' => $id));
			}
			else
			{
				$table_group = $this->table['common_groups'];
				$this->db->delete($table_group, array('participant_id' => $id, 'content_id' => $content_id));
			}

			return $this->db->delete($table, array('id' => $id));
		}
		return FALSE;
	}

	public function check_any($table, $array)
    {
		$this->db->where($array);
		$this->db->limit(1);
		return  $this->db->count_all_results($table) > 0;
	}

	// public function set_digit($digit, $number)
	// {
	// 	$zero = '';
	// 	$digit = $digit - strlen($number);
	// 	for ($i=1; $i <= $digit; $i++) { 
	// 		$zero = $zero.'0';
	// 	}
	// 	$num = $zero.$number;
	// 	return $num;
	// }
}
