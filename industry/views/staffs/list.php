<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scholarship</title>
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div id="app">
    <?php $this->load->view('include/header'); ?>

    <!-- Body form  -->
        <section class="board">
            <div class="container-wrap1">
                <div class="row m0">
                        <?php $this->load->view('include/menu'); ?>

                    <div class="col s12 m9">
                        <div class="card  darken-1">
                            <div class="card-content bord-right">
                            <div>
                                <a class="waves-effect waves-light hoverable btn-theme btn right capitalize" href="<?php echo base_url()  ?>staffs/create">  <i class="material-icons tiny left">add</i> Add new staff</a>
                                <span class="card-title">Verification staffs</span>
                            </div>
                                <div class="board-content">
                                    <div class="row m0">
                                        <table class="vue-data-table row-click ovrflw-tbl">
                                            <thead>
                                                <tr>
                                                    <th>Sl No</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $disb='';
                                                foreach ($staffs as $key => $value) { 
                                                    if(empty($value->status)) { 
                                                        $sts    =  '<span class="red-text">Inactive</span>'; 
                                                        $block  =   "display:block";
                                                        $un     =   "display:none";
                                                        $disb   =   "disabled='disabled'";
                                                    }else if((!empty($value->status)) && ($value->status == 1)) {
                                                        $sts    =  '<span class="green-text">Active</span>'; 
                                                        $block  =   "display:block";
                                                        $un     =   "display:none";
                                                    }else {
                                                        $sts    =  '<span class="red-text">Blocked</span>'; 
                                                        $block  =   "display:none";
                                                        $un     =   "display:block";
                                                    }

                                                    ?>
                                                    <tr>
                                                        <td><?php echo (!empty($staffs))?$key + 1:''; ?></td>
                                                        <td><?php echo (!empty($value->name))?$value->name:''; ?></td>
                                                        <td><?php echo (!empty($value->email))?$value->email:''; ?></td>
                                                        <td><?php echo (!empty($value->mobile))?$value->mobile:''; ?></td>
                                                        <td> <?php echo $sts ?> </td> 
                                                        <td>
                                                            <a <?php echo $disb ?> style="<?php echo $block ?>" href="<?php echo base_url('staffs/block?id='.$value->id.'') ?>"  class="btn-small right red darken-3 waves-effect waves-light">Block</a>
                                                            <a style="<?php echo $un ?>" href="<?php echo base_url('staffs/unblock?id='.$value->id.'') ?>" class="btn-small right green darken-3 waves-effect waves-light">Unblock</a>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo base_url('staffs/delete?id='.$value->id.'') ?>" class="btn-small right green darken-3 waves-effect waves-light">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php } if(empty($staffs)){ ?>
                                                    <tr>
                                                        <td colspan="6">No result found</td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End right board -->
                </div>
            </div>
        </section>


    <!-- End Body form  -->

    <!-- footer -->
        
    <?php $this->load->view('include/footer'); ?>
    <!-- End footer --> 
    </div>
             


<!-- scripts -->
<script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
<script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
<script src="<?php echo $this->config->item('web_url') ?>assets/js/axios.min.js"></script>
<script src="<?php echo $this->config->item('web_url') ?>assets/js/script.js"></script>
<script>
<?php $this->load->view('include/msg'); ?>
   


    var app = new Vue({
        el: '#app',
        data: {
            loader:false,
          
        },  
        mounted(){
        },
        methods:{
          
            
        }
    })
</script>
</body>
</html>