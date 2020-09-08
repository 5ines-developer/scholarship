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
    <link  rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/material-icons.css">
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
                                    <span>Student Detail</span>
                                    <span><a href="<?php echo base_url('student') ?>" class="back-btn z-depth-1 waves-effect waves-ligh right">Back</a></span>
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
                                                                    if((!empty($result[0]->profile_pic))){
                                                                        $img = $this->config->item('web_url').'show-image/'.$result[0]->profile_pic;
                                                                    }else{
                                                                         $img = 'https://via.placeholder.com/150';
                                                                    } ?>
                                                                    <center> <img src="<?php echo $img ?>" alt="" class="circle responsive-img" width="130px"></center>
                                                                </div>

                                                            </div>
                                                            <div class=" col s12 l8 ">
                                                                <div class="block-de">
                                                                    <p class=""><?php if(!empty($apply)){ echo count($apply); }else{ echo '0'; } ?></p>
                                                                    <p>Total Number Of Applied Scholarship</p>
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
                                                                <p class="app-item-content"><?php echo (!empty($result[0]->name))?$result[0]->name:'---'; ?></p>
                                                            </li>

                                                            <li>
                                                                <p class="app-item-content-head">Email</p>
                                                                <p class="app-item-content"><a href="mailto:<?php echo (!empty($result[0]->email))?$result[0]->email:'#'; ?>"><?php echo (!empty($result[0]->email))?$result[0]->email:'---'; ?></a></p>
                                                            </li>

                                                            <li>
                                                                <p class="app-item-content-head">Phone</p>
                                                                <p class="app-item-content"><a href="tel:<?php echo (!empty($result[0]->phone))?$result[0]->phone:'#'; ?>"><?php echo (!empty($result[0]->phone))?$result[0]->phone:'---'; ?></a></p>
                                                            </li>

                                                            <li>
                                                                <p class="app-item-content-head">Registration Date</p>
                                                                <p class="app-item-content"><?php echo (!empty($result[0]->date))?date('d M, Y',strtotime($result[0]->date)):'---'; ?></p>
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
                                                                            <th id="e" class="h5-para-p2" style="width: 120px;">Applied Date</th>
                                                                            <th id="g" class="h5-para-p2">Action</th>
                                                                        </thead>
                                                                        <tbody class="tbody-list">
                                                                            <?php if(!empty($apply)){
                                                                            foreach ($apply as $key => $value) { $key++;

                                                                                $ids = $this->encryption_url->safe_b64encode($value->id);

                                                                            ?>
                                                                            <tr role="row" class="odd">
                                                                                <td><a href="<?php echo base_url('applications/detail/').$ids ?>"><?php echo (!empty($value))?$key:'---'; ?></a></td>
                                                                                <td><a href="<?php echo base_url('applications/detail/').$ids ?>"><?php echo (!empty($value->name))?$value->name:'---'; ?></a></td>
                                                                                <td><a href="<?php echo base_url('applications/detail/').$ids ?>"><?php echo (!empty($value->corse))?$value->corse:''; echo (!empty($value->cLass))?$value->cLass:''; ?></a></td>
                                                                                <td><a href="<?php echo base_url('applications/detail/').$ids ?>"><?php echo (!empty($value->mark))?$value->mark.' %':'---';  ?></a></td>
                                                                                <td class=""><a href="<?php echo base_url('applications/detail/').$ids ?>"><?php echo (!empty($value->application_year))?$value->application_year:'---'; ?></a></td>
                                                                                <td class=""><a href="<?php echo base_url('applications/detail/').$ids ?>"><?php echo (!empty($value->date))?date('d M, Y', strtotime($value->date)):'---'; ?></a></td>
                                                                                <td class="action-btn center-align">
                                                                                    <a href="<?php echo base_url('applications/detail/').$ids ?>" class="blue-text"> view</a>
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
                   axios.post('<?php echo base_url('Student/unblock') ?>',formData)
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
                   axios.post('<?php echo base_url('Student/block') ?>',formData)
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