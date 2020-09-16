<?php 
if($this->session->flashdata('success')){
    echo 'M.toast({html: "'.$this->session->flashdata('success').'", classes: "green"});';
}
elseif($this->session->flashdata('error')){
    echo 'M.toast({html: "'.$this->session->flashdata('error').'", classes: "red"});';
}



?>