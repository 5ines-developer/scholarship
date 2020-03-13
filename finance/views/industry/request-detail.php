<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scholarship</title>
    <link rel="stylesheet " href="<?php echo $this->config->item('web_url') ?>assets/css/style.css ">
    <link rel="stylesheet " href="<?php echo $this->config->item('web_url') ?>assets/css/materialize.min.css">
    <!-- data table -->
    <link rel="stylesheet " href="<?php echo $this->config->item('web_url') ?>assets/dataTable/datatables.min.css ">
    <link rel="stylesheet " href="<?php echo $this->config->item('web_url') ?>assets/dataTable/button/css/buttons.dataTables.css ">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <div id="app">
         <?php $this->load->view('include/header'); ?>

        <!-- Body form  -->
        <section class="board res-p">
            <div class="container-wrap1">
                <div class="row m0">
                <div class="col s12 m3 l3 hide-on-med-and-down ">
                            <?php $this->load->view('include/menu'); ?>
                    </div>
                    <!-- End menu-->

                    <div class="col s12 m9">
                        <div class="card ">
                            <div class="card-content bord-right">
                                <div class="card-title">
                                    Institute Add Request Detail
                                     <a href="<?php echo base_url('industry-request') ?>"  class="back-btn z-depth-1 waves-effect waves-ligh">Back</a>
                                </div>
                                <div class="board-content">
                                    <div class="row m0">
                                        <div class="app-detail-items">
                                            <div class="col s12 l12 p0">
                                                
                                                <div class="p-detail app-detail-item">
                                                    <div class="app-item-heading ">
                                                        <p class="Profile-detail ">Detail</p>
                                                    </div>
                                                    <div class="detail-list ">
                                                        <ul class="profile-ul">
                                                            <li>
                                                                <p class="app-item-content-head">Name</p>
                                                                <p class="app-item-content"><?php echo (!empty($result[0]->company))?$result[0]->company:'---'; ?></p>
                                                            </li>
                                                            <li>
                                                                <p class="app-item-content-head">Email</p>
                                                                <p class="app-item-content"><?php echo (!empty($result[0]->email))?$result[0]->email:'---'; ?></p>
                                                            </li>
                                                            <li>
                                                                <p class="app-item-content-head">Mobile</p>
                                                                <p class="app-item-content"><?php echo (!empty($result[0]->mobile))?$result[0]->mobile:'---'; ?></p>
                                                            </li>
                                                            <li>
                                                                <p class="app-item-content-head">Act</p>
                                                                <p class="app-item-content"><?php if($result[0]->act == '1'){
                                                                        echo "Factory Act";
                                                                    }else{
                                                                        echo "Labour Act";
                                                                    }

                                                                ?></p>
                                                            </li>
                                                            <li>
                                                                <p class="app-item-content-head">Taluk</p>
                                                                <p class="app-item-content"><?php echo (!empty($result[0]->taluk))?$result[0]->taluk:'---'; ?></p>
                                                            </li>
                                                            <li>
                                                                <p class="app-item-content-head">District</p>
                                                                <p class="app-item-content"><?php echo (!empty($result[0]->district))?$result[0]->district:'---'; ?></p>
                                                            </li>

                                                            <li>
                                                                <p class="app-item-content-head">Address</p>
                                                                <p class="app-item-content"><?php echo (!empty($result[0]->address))?$result[0]->address:'---'; ?></p>
                                                            </li>
                                                            <?php 
                                                                    if((!empty($result[0]->register_doc))){
                                                                        $sign = $this->config->item('web_url').'industry/show-images/'.$result[0]->register_doc;

                                                                    }else{
                                                                         $sign = 'https://via.placeholder.com/150';
                                                                    } ?>

                                                            <li>
                                                                <p class="app-item-content-head">Industry Register Document</p>
                                                                <a target="_blank" href="<?php echo $sign ?>"><img src="<?php echo  $sign ?>" alt="" class="circle responsive-img" width="100px"></a>
                                                            </li>
                                                            <li>
                                                                <p class="app-item-content-head">Requested On</p>
                                                                <p class="app-item-content"> <?php echo (!empty($result[0]->date))?date('d M, Y',strtotime($result[0]->date)):'---'; ?></p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <!-- End-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End right board -->
                </div>
            </div>
        </section>


        <!-- End Body form  -->
        
        <!-- footer -->


        <?php $this->load->view('include/footer'); ?>
        <!-- End footer -->
    </div>



   
    <!-- scripts -->
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/jquery-3.4.1.min.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js "></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js "></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/axios.min.js "></script>
    <!-- data table -->
    <script type="text/javascript " src="<?php echo $this->config->item('web_url') ?>assets/dataTable/datatables.min.js "></script>
    <script type="text/javascript " src="<?php echo $this->config->item('web_url') ?>assets/dataTable/button/js/dataTables.buttons.min.js "></script>
    <script type="text/javascript " src="<?php echo $this->config->item('web_url') ?>assets/dataTable/button/js/buttons.flash.min.js "></script>
    <script type="text/javascript " src="<?php echo $this->config->item('web_url') ?>assets/dataTable/button/js/buttons.html5.min.js "></script>
    <script type="text/javascript " src="<?php echo $this->config->item('web_url') ?>assets/dataTable/button/js/pdfmake.min.js "></script>
    <script type="text/javascript " src="<?php echo $this->config->item('web_url') ?>assets/dataTable/button/js/vfs_fonts.js "></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js "></script>
    <!-- data table -->
    <?php $this->load->view('include/msg'); ?>
    <script>
        $(document).ready(function() {
            $('.sid-m >.collapsible-body').css({
                display: 'block',
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            var instances = M.Sidenav.init(document.querySelectorAll('.sidenav'));
            var gropDown = M.Dropdown.init(document.querySelectorAll('.dropdown-trigger'), {
                constrainWidth: false,
                alignment: 'right'
            })
        });
    </script>
    <script>
        $(document).ready(function() {
            var table = $('table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'csv'
                ]

            });
            $('select').formSelect();
            $('.modal').modal();
        });
    </script>

    <script>
         var app = new Vue({
            el: '#app',
            data: {
                block: <?php echo ($result[0]->status !='1')?'true':'false'; ?>,
                unblock: <?php echo ($result[0]->status =='1')?'true':'false'; ?>,
                id:<?php echo ($result[0]->id) ?>,
            },
            methods:{
                unBlock(){
                    var self = this;
                    const formData = new FormData();
                   formData.append('id',this.id);
                    formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');
                   axios.post('<?php echo base_url('school/unblock') ?>',formData)
                   .then(response => {
                        self.block = false;
                        self.unblock = true;
                        msg = response.data.msg;
                        M.toast({html: msg, classes: 'green', displayLength : 5000 });
                   })
                   .catch(error =>{
                     this.errormsg = error.response.data.error;
                   })
                },
                 stdBlock(){
                    var self = this;
                   const formData = new FormData();
                   formData.append('id',this.id);
                    formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');
                   axios.post('<?php echo base_url('school/block') ?>',formData)
                   .then(response => {
                        self.block = true;
                        self.unblock = false;
                        msg = response.data.msg;
                        M.toast({html: msg, classes: 'green', displayLength : 5000 });
                   })
                   .catch(error =>{
                     this.errormsg = error.response.data.error;
                   })
                },

                
            },
        })
    </script>
</body>

</html>