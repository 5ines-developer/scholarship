<?php 
if($this->session->flashdata('success')){
    echo '<script>
        M.toast({html: "'.$this->session->flashdata('success').'", classes: "green"});
    </script>';
}
elseif($this->session->flashdata('error')){
    echo '<script>
    M.toast({html: "'.$this->session->flashdata('error').'", classes: "red"});
    </script>';
}

?>
