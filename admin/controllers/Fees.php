<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Fees extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_fees');
        if($this->session->userdata('said') == ''){ redirect('/','refresh'); }
        $this->adid = $this->session->userdata('said'); 
    }

    public function add($value='')
    {
    	$data['title'] = 'Add Fees';
        $this->load->helper('string');
        if($this->input->post()){
        	$grad   = $this->input->post('graduation', true);
            $fees  = $this->input->post('fees_am', true);
            $data   = array(
                'class'         => $grad, 
                'amount'        => $fees,
                'added_by' 		=> $this->adid,
            );
            if($this->m_fees->add($data)){
                $this->session->set_flashdata('success', 'Fees Amount added Successfully');
            }
            else{
                $this->session->set_flashdata('error', 'Some error occured. <br>Please try agin later');
            }

            redirect('fees/manage','refresh');

        }else{
        	$data['grad'] = $this->m_fees->getGrad();
    		$this->load->view('fees/add', $data, FALSE);
        }
    }

    public function manage($id='')
    {
    	$data['title'] = 'Fees';
    	$data['result'] = $this->m_fees->feesGet();
    	$this->load->view('fees/list', $data, FALSE);
    }

    public function edit($id='')
    {

    	$data['title'] = 'Fees';
    	$data['result'] = $this->m_fees->feesGet($id);
    	$data['grad'] = $this->m_fees->getGrad();
    	$this->load->view('fees/edit', $data, FALSE);
    }

    public function update($value='')
    {
    		$grad   = $this->input->post('graduation', true);
            $fees  = $this->input->post('fees_am', true);
            $id  = $this->input->post('id', true);
            $data   = array(
                'class'         => $grad, 
                'amount'        => $fees,
                'added_by' 		=> $this->adid,
            );
            if($this->m_fees->update($data,$id)){
                $this->session->set_flashdata('success', 'Fees Amount Updated Successfully');
            }
            else{
                $this->session->set_flashdata('error', 'Some error occured. <br>Please try agin later');
            }

            redirect('fees/edit/'.$id,'refresh');
    }

    public function delete($id='')
    {
    	 if($this->m_fees->delete($id)){
                $this->session->set_flashdata('success', 'Fees Amount Deleted Successfully');
            }
            else{
                $this->session->set_flashdata('error', 'Some error occured. <br>Please try agin later');
            }
            redirect('fees/manage','refresh');
    }

}