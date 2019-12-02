<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

   public function getTaluk($var = null)
   {
      return $this->db->get('taluq')->result();
   }

   public function getDistrict($var = null)
   {
      return $this->db->get('city')->result();
   }

   // add school
   public function addSchoolDetail($data = null)
   {
      $this->db->insert('school', $data);
      return $this->db->insert_id();
   }

   // aut
   public function CreateAuth($data = null)
   {
      if($this->insertAuth($data['auth'])){
         $this->db->insert('school_address', $data['school_address']);
         if($this->db->affected_rows() > 0){
            return true;
         }else{
            return false;
         }
      }else{
         return false;
      }
   }

   public function insertAuth($data = null)
   {
      $this->db->insert('school_auth', $data);
      if($this->db->affected_rows() > 0){
         return true;
      }else{
         return false;
      }
   }




}

/* End of file M_auth.php */


