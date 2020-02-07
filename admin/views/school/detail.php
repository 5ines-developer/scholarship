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
                                    Institute Detail
                                </div>
                                <div class="board-content">
                                    <div class="row m0">
                                        <div class="app-detail-items">
                                            <div class="col s12 l12 p0">
                                                <div class="white">
                                                    <div class="per-dd">
                                                        <div class="row m0">
                                                            <div class="col s12 l4 border-right">
                                                                <div class="profile-img">
                                                                    <?php 
                                                                    if((!empty($result[0]->reg_certification))){
                                                                        $img = $this->config->item('web_url').'institute/'.$result[0]->reg_certification;
                                                                    }else{
                                                                         $img = 'https://via.placeholder.com/150';
                                                                    } ?>
                                                                    <center> <img src="<?php echo $img ?>" alt="" class="circle responsive-img" width="130px"></center>
                                                                </div>

                                                            </div>
                                                            <div class=" col s12 l8 ">
                                                                <div class="block-de">
                                                                    <p class=""><?php if(!empty($apply)){ echo count($apply); } ?></p>
                                                                    <p>total Number Of Applied Scholarship</p>
                                                                    <a class="btn-small gap-m red darken-3 waves-effect waves-light" :disabled="block" @click="stdBlock">Block</a>
                                                                    <a class="btn-small green darken-3 waves-effect waves-light " @click="unBlock" :disabled="unblock">Unblock</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="p-detail app-detail-item">
                                                    <div class="app-item-heading ">
                                                        <p class="Profile-detail ">Profile Detail</p>
                                                    </div>
                                                    <div class="detail-list ">
                                                        <ul class="profile-ul">
                                                            <li>
                                                                <p class="app-item-content-head">Name</p>
                                                                <p class="app-item-content"><?php echo (!empty($result[0]->school_address))?$result[0]->school_address:'---'; ?></p>
                                                            </li>
                                                            <li>
                                                                <p class="app-item-content-head">Management Type</p>
                                                                <p class="app-item-content"><?php echo (!empty($result[0]->management_type))?$result[0]->management_type:'---'; ?></p>
                                                            </li>
                                                            <li>
                                                                <p class="app-item-content-head">Institute Category</p>
                                                                <p class="app-item-content"><?php echo (!empty($result[0]->school_category))?$result[0]->school_category:'---'; ?></p>
                                                            </li>
                                                            <li>
                                                                <p class="app-item-content-head">Institute Type</p>
                                                                <p class="app-item-content"><?php echo (!empty($result[0]->school_type))?$result[0]->school_type:'---'; ?></p>
                                                            </li>
                                                            <li>
                                                                <p class="app-item-content-head">Region Type</p>
                                                                <p class="app-item-content"><?php echo (!empty($result[0]->urban_rural))?$result[0]->urban_rural:'---'; ?></p>
                                                            </li>
                                                            <li>
                                                                <p class="app-item-content-head">Taluk</p>
                                                                <p class="app-item-content"><?php echo (!empty($result[0]->title))?$result[0]->title:'---'; ?></p>
                                                            </li>
                                                            <li>
                                                                <p class="app-item-content-head">District</p>
                                                                <p class="app-item-content"><?php echo (!empty($result[0]->district))?$result[0]->district:'---'; ?></p>
                                                            </li>

                                                            <li>
                                                                <p class="app-item-content-head">Principal</p>
                                                                <p class="app-item-content"><?php echo (!empty($result[0]->principal))?$result[0]->principal:'---'; ?></p>
                                                            </li>
                                                            <?php 
                                                                    if((!empty($result[0]->priciple_signature))){
                                                                        $sign = $this->config->item('web_url').'institute/'.$result[0]->priciple_signature;

                                                                    }else{
                                                                         $sign = 'https://via.placeholder.com/150';
                                                                    } ?>

                                                            <li>
                                                                <p class="app-item-content-head">Principal Signature</p>
                                                                <a target="_blank" href="<?php echo $sign ?>"><img src="<?php echo  $sign ?>" alt="" class="circle responsive-img" width="100px"></a>
                                                            </li>

                                                            <?php 
                                                                    if((!empty($result[0]->seal))){
                                                                        $seal = $this->config->item('web_url').'institute/'.$result[0]->seal;

                                                                    }else{
                                                                         $seal = 'https://via.placeholder.com/150';
                                                                    } ?>

                                                            <li>
                                                                <p class="app-item-content-head">Principal Seal</p>
                                                                <a target="_blank" href="<?php echo $seal ?>"><img src="<?php echo  $seal ?>" alt="" class="circle responsive-img" width="100px"></a>
                                                            </li>

                                                            <li>
                                                                <p class="app-item-content-head">Registered On</p>
                                                                <p class="app-item-content"> <?php echo (!empty($result[0]->created_on))?date('d M, Y',strtotime($result[0]->created_on)):'---'; ?></p>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="white app-detail-item">
                                                    <div class="app-item-heading ">
                                                        <p class="Profile-detail ">Scholarship Application</p>
                                                    </div>
                                                    <div class="app-item-body">
                                                        <div class="card-content bord-right ">
                                                            <div class="">
                                                                <div class="hr-list">
                                                                    <table id="dynamic" class="striped ">
                                                                        <thead class="thead-list">
                                                                            <th id="a" class="h5-para-p2">Sl No</th>
                                                                            <th id="a" class="h5-para-p2">Name</th>
                                                                            <th id="b" class="h5-para-p2">Class</th>
                                                                            <th id="c" class="h5-para-p2">Mark</th>
                                                                            <th id="g" class="h5-para-p2">Year</th>
                                                                            <th id="g" class="h5-para-p2">Action</th>
                                                                        </thead>
                                                                        <tbody class="tbody-list">
                                                                            <?php if(!empty($apply)){
                                                                            foreach ($apply as $key => $value) { $key++ ?>
                                                                            <tr role="row" class="odd">
                                                                                <td><a href="<?php echo base_url('applications/detail/').$value->id ?>"><?php echo (!empty($value))?$key:'---'; ?></a></td>
                                                                                <td><a href="<?php echo base_url('applications/detail/').$value->id ?>"><?php echo (!empty($value->name))?$value->name:'---'; ?></a></td>
                                                                                <td><a href="<?php echo base_url('applications/detail/').$value->id ?>"><?php echo (!empty($value->class))?$value->class:'---'; ?></a></td>
                                                                                <td><a href="<?php echo base_url('applications/detail/').$value->id ?>"><?php echo (!empty($value->mark))?$value->mark.' %':'---'; ?></a></td>
                                                                                <td class=""><a href="<?php echo base_url('applications/detail/').$value->id ?>"><?php echo (!empty($value->application_year))?$value->application_year:'---'; ?></a></td>
                                                                                <td class="action-btn center-align">
                                                                                    <a href="<?php echo base_url('applications/detail/').$value->id ?>" class="blue-text"> View</a>
                                                                                </td>
                                                                            </tr>
                                                                            <?php } } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="white app-detail-item">
                                                    <div class="app-item-heading ">
                                                        <p class="Profile-detail ">Employee List</p>
                                                    </div>
                                                    <div class="app-item-body">
                                                        <div class="card-content bord-right ">
                                                            <div class="">
                                                                <div class="hr-list">
                                                                    <table id="dynamic" class="striped ">
                                                                        <thead class="thead-list">
                                                                            <th id="a" class="h5-para-p2">Sl No</th>
                                                                            <th id="c" class="h5-para-p2">Email</th>
                                                                            <th id="b" class="h5-para-p2">Phone</th>
                                                                            <th id="c" class="h5-para-p2">Status</th>
                                                                            <th id="g" class="h5-para-p2">Date</th>
                                                                        </thead>
                                                                        <tbody class="tbody-list">
                                                                            <?php if(!empty($emp)){
                                                                            foreach ($emp as $key => $value) { $key++ ?>
                                                                            <tr role="row" class="odd">
                                                                                <td><?php echo (!empty($value))?$key:'---'; ?></td>
                                                                                <td><?php echo (!empty($value->email))?$value->email:'---'; ?></td>
                                                                                <td><?php echo (!empty($value->phone))?$value->phone:'---'; ?></td>
                                                                                <td><?php
                                                                                if($value->status==1){
                                                                                    echo '<p class="status darken-2">Active</p>';
                                                                                }else if($value->status== 0){
                                                                                    echo '<p class="status blue darken-2">Inactive</p>';
                                                                                }else{
                                                                                    echo '<p class="status red darken-2">Blocked</p>';
                                                                                } ?></td>
                                                                                <td><?php echo (!empty($value->created_on))?date('d M, Y',strtotime($value->created_on)):'---'; ?></td>
                                                                            </tr>
                                                                            <?php } } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
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
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/script.js"></script>
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
            $('.si-m >.collapsible-body').css({
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
                block: <?php echo ($result[0]->status !='3' && $result[0]->status !='1')?'true':'false'; ?>,
                unblock: <?php echo ($result[0]->status =='1')?'true':'false'; ?>,
                id:<?php echo ($result[0]->id) ?>,
            },
            methods:{
                unBlock(){
                    var self = this;
                    const formData = new FormData();
                   formData.append('id',this.id);
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