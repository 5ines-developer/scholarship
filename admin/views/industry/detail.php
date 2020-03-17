<?php
$this->ci =& get_instance();
$this->load->library('encryption');
?>
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
                                    Industry Detail
                                    <a href="<?php echo base_url('industry') ?>" class="back-btn z-depth-1 waves-effect waves-ligh right">Back</a>
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
                                                                        $img = $this->config->item('web_url').'industry/show-images/'.$result[0]->register_doc;
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
                                                                <p class="app-item-content"><?php echo (!empty($result[0]->indNAme))?$result[0]->indNAme:'---'; ?></p>
                                                            </li>
                                                            <li>
                                                                <p class="app-item-content-head">Act</p>
                                                                <p class="app-item-content"><?php echo (!empty($result[0]->act ) && $result[0]->act == '1')?'Labour Act':'Factory Act'; ?></p>
                                                            </li>
                                                            <li>
                                                                <p class="app-item-content-head">Register Number</p>
                                                                <p class="app-item-content"><?php echo (!empty($result[0]->reg_id))?$result[0]->reg_id:'---'; ?></p>
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
                                                                <p class="app-item-content-head">Registered On</p>
                                                                <p class="app-item-content"> <?php echo (!empty($result[0]->date))?date('d M, Y',strtotime($result[0]->date)):'---'; ?></p>
                                                            </li>
                                                            <li>
                                                                <p class="app-item-content-head">Director</p>
                                                                <p class="app-item-content"><?php echo (!empty($result[0]->director))?$result[0]->director:'---'; ?></p>
                                                            </li>
                                                            <li>
                                                                <p class="app-item-content-head">Email</p>
                                                                <p class="app-item-content"><?php echo (!empty($result[0]->email))?$result[0]->email:'---'; ?></p>
                                                            </li>
                                                            <li>
                                                                <p class="app-item-content-head">Phone</p>
                                                                <p class="app-item-content"><?php echo (!empty($result[0]->mobile))?$result[0]->mobile:'---'; ?></p>
                                                            </li>
                                                            <?php 
                                                                    if((!empty($result[0]->sign))){
                                                                        $sign = $this->config->item('web_url').'industry/show-images/'.$result[0]->sign;

                                                                    }else{
                                                                         $sign = 'https://via.placeholder.com/150';
                                                                    } ?>

                                                            <li>
                                                                <p class="app-item-content-head">Director/ Authorized Signature</p>
                                                                <a target="_blank" href="<?php echo $sign ?>"><img src="<?php echo  $sign ?>" alt="" class="circle responsive-img" width="100px"></a>
                                                            </li>

                                                            <?php 
                                                                    if((!empty($result[0]->seal))){
                                                                        $seal = $this->config->item('web_url').'industry/show-images/'.$result[0]->seal;

                                                                    }else{
                                                                         $seal = 'https://via.placeholder.com/150';
                                                                    } ?>

                                                            <li>
                                                                <p class="app-item-content-head">Director Seal</p>
                                                                <a target="_blank" href="<?php echo $seal ?>"><img src="<?php echo  $seal ?>" alt="" class="circle responsive-img" width="100px"></a>
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
                                                                            foreach ($apply as $key => $value) { $key++;
                                                                            $id = $this->ci->encryption_url->safe_b64encode($value->id);
                                                                            ?>
                                                                            <tr role="row" class="odd">
                                                                                <td><a href="<?php echo base_url('applications/detail/').$id ?>"><?php echo (!empty($value))?$key:'---'; ?></a></td>
                                                                                <td><a href="<?php echo base_url('applications/detail/').$id ?>"><?php echo (!empty($value->name))?$value->name:'---'; ?></a></td>
                                                                                <td><a href="<?php echo base_url('applications/detail/').$id ?>"><?php echo (!empty($value->class))?$value->class:'---'; ?></a></td>
                                                                                <td><a href="<?php echo base_url('applications/detail/').$id ?>"><?php echo (!empty($value->mark))?$value->mark.' %':'---'; ?></a></td>
                                                                                <td class=""><a href="<?php echo base_url('applications/detail/').$id ?>"><?php echo (!empty($value->application_year))?$value->application_year:'---'; ?></a></td>
                                                                                <td class="action-btn center-align">
                                                                                    <a href="<?php echo base_url('applications/detail/').$id ?>" class="blue-text"> View</a>
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
                                                                            <th id="c" class="h5-para-p2 mail-wdth">Email</th>
                                                                            <th id="b" class="h5-para-p2">Phone</th>
                                                                            <th id="c" class="h5-para-p2">Status</th>
                                                                            <th id="g" class="h5-para-p2">Date</th>
                                                                            <th id="g" class="h5-para-p2">Action</th>
                                                                        </thead>
                                                                        <tbody class="tbody-list">
                                                                            <?php if(!empty($emp)){
                                                                            foreach ($emp as $key => $value) { $key++ ?>
                                                                            <tr role="row" class="odd">
                                                                                <td><?php echo (!empty($value))?$key:'---'; ?></td>
                                                                                <td><?php echo (!empty($value->email))?$value->email:'---'; ?></td>
                                                                                <td><?php echo (!empty($value->mobile))?$value->mobile:'---'; ?></td>
                                                                                <td><?php
                                                                                if($value->status==1){
                                                                                    echo '<p class="status darken-2">Active</p>';
                                                                                }else if($value->status== 0){
                                                                                    echo '<p class="status blue darken-2">Inactive</p>';
                                                                                }else{
                                                                                    echo '<p class="status red darken-2">Blocked</p>';
                                                                                } ?></td>
                                                                                <td><?php echo (!empty($value->date))?date('d M, Y',strtotime($value->date)):'---'; ?></td>
                                                                                <td>
                                                                                <?php if($value->status == '1'){ ?>
                                                                                    <a class="btn-small white-text gap-m red darken-3 waves-effect waves-light" href="<?php echo base_url('industry/empblock/?id='.$value->id.'&ind='.$result[0]->indId.'') ?>" >Block</a>
                                                                                <?php }else{ ?>
                                                                                    <a class="btn-small white-text green darken-3 waves-effect waves-light" href="<?php echo base_url('industry/empunblock/?id='.$value->id.'&ind='.$result[0]->indId.'') ?>">Unblock</a>
                                                                               <?php  } ?>
                                                                                    
                                                                                    
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
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
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
                id:<?php echo ($result[0]->indId) ?>,
            },
            methods:{
                unBlock(){
                    var self = this;
                    const formData = new FormData();
                   formData.append('id',this.id);
                    formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');
                   axios.post('<?php echo base_url('industry/unblock') ?>',formData)
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
                   axios.post('<?php echo base_url('industry/block') ?>',formData)
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