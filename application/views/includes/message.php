<?php if ($this->session->flashdata('error')) { ?>
    		M.toast({html: '<?php echo $this->session->flashdata('error') ?>', classes: 'red', displayLength : 5000 });
        <?php } ?>

        <?php if ($this->session->flashdata('success')) { ?>
            M.toast({html: '<?php echo $this->session->flashdata('success') ?>', classes: 'green', displayLength : 5000 });
<?php } ?>

