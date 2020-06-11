<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_fees extends CI_Model {

	public function getGrad($value='')
	{
		return $this->db->get('gradution')->result();
	}	

	public function add($insert='')
	{
		$this->db->where('class', $insert['class']);
		$this->db->where('date=', date('Y'));
		$query = $this->db->get('fees')->row();
		if(!empty($query)){
			$this->db->where('class', $insert['class']);
			return $this->db->update('fees', $insert);
		}else{
			return $this->db->insert('fees', $insert);
		}
	}

	public function feesGet($id='',$year='')
	{
		if (!empty($id)) { $this->db->where('f.id', $id); }

		if (!empty($year)) {
			$this->db->where('f.date', $year);
		}else{
			$this->db->where('f.date', date('Y'));
		}
		$this->db->select('f.id as feesId,f.amount,f.class,f.date,g.title');
		$this->db->order_by('f.id', 'asc');
		$this->db->from('fees f');
		$this->db->join('gradution g', 'g.id = f.class', 'left');
		return $this->db->order_by('f.id', 'asc')->get()->result();
	}

	public function update($data='',$id='')
	{
		$this->db->where('id', $id);
		return $this->db->update('fees', $data);
	}

	public function delete($id='')
	{
		$this->db->where('id', $id);
		return $this->db->delete('fees');
	}

}

/* End of file M_fees.php */
/* Location: .//C/xampp/htdocs/scholarship/admin/models/M_fees.php */