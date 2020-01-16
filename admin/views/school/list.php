<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible " content="ie=edge ">
    <title>Scholarship</title>
    <link rel="stylesheet " href="<?php echo $this->config->item('web_url') ?>assets/css/style.css ">
    <link rel="stylesheet " href="<?php echo $this->config->item('web_url') ?>assets/css/materialize.min.css ">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons " rel="stylesheet ">
    <!-- data table -->
    <link rel="stylesheet " href="<?php echo $this->config->item('web_url') ?>assets/dataTable/datatables.min.css ">
    <link rel="stylesheet " href="<?php echo $this->config->item('web_url') ?>assets/dataTable/button/css/buttons.dataTables.css ">
    <style>
        .vie-btn{
            padding-right: 12px;
            font-weight: 600;
        }
        
    </style>
</head>

<body>
    <div id="app">
        <?php $this->load->view('include/header'); ?>

        <!-- Body form  -->
        <section class="board ">
            <div class="container-wrap1 ">
                <div class="row m0 ">
                    <div class="col s12 m3 l3 hide-on-med-and-down ">
                            <?php $this->load->view('include/menu'); ?>
                    </div>
                    <!-- End menu-->

                    <div class="col s12 m9 l9 ">

                        <div class="row">
                        <div class="top-count">                     
                            <div class="col s12 m3">
                              <div class="card green hoverable">
                                <div class="card-content white-text center-align">
                                  <span class="card-title center-align"><i class="material-icons">school</i></span>
                                   <p><?php echo $count['tot'] ?></p>
                                </div>
                                <div class="card-action center-align">
                                  <span class="white-text">Total Institute</span>
                                </div>
                              </div>
                            </div>
                            <div class="col s12 m3">
                              <div class="card orange hoverable">
                                <div class="card-content white-text center-align">
                                  <span class="card-title center-align"><i class="material-icons">how_to_reg</i></span>
                                   <p><?php echo $count['reg_yer'] ?></p>
                                </div>
                                <div class="card-action center-align">
                                  <span class="white-text">Registered in <?php echo date('Y') ?></span>
                                </div>
                              </div>
                            </div>
                            <div class="col s12 m3">
                              <div class="card blue darken-1 hoverable">
                                <div class="card-content white-text center-align">
                                  <span class="card-title center-align"><i class="material-icons">school</i></span>
                                   <p><?php echo $count['app_year'] ?></p>
                                </div>
                                <div class="card-action center-align">
                                  <span class="white-text">Active Institute</span>
                                </div>
                              </div>
                            </div>
                            <div class="col s12 m3">
                              <div class="card green  darken-4 hoverable">
                                <div class="card-content white-text center-align">
                                  <span class="card-title center-align"><i class="material-icons">insert_drive_file</i></span>
                                   <p><?php echo $count['app_schl'] ?></p>
                                </div>
                                <div class="card-action center-align">
                                  <span class="white-text">Scholarship Applied</span>
                                </div>
                              </div>
                            </div>
                        </div>
                        </div>

                        <div class="card darken-1 ">
                            <div class="card-content bord-right ">
                                <div class="title-list ">
                                    <span class="list-title ">Institute  List</span>
                                    <a href="<?php echo base_url('institute-add') ?>"><button class="back-btn z-depth-1 waves-effect waves-ligh add-btn">
                                        <i class="material-icons add-icon ">add</i><span>Add</span></button></a>
                                </div>
                                <div class="board-content ">

                                    <div class="table-detail">
                                        <select name="dist" id="dis-drp" class="district">
                                                <option value="" disabled selected>District</option>
                                                <?php
                                                if (!empty($district)) {
                                                   foreach ($district as $key => $value) { 
                                                       echo '<option value="'.$value->districtId.'">'.$value->district.'</option>';
                                                } } ?>
                                        </select>
                                        <select name="dist" id="dis-drp" class="taluk">
                                                <option value="" disabled selected>Taluk</option>
                                                <?php if (!empty($taluk)) {
                                                   foreach ($taluk as $key => $value) { ?> 
                                                       <option value="<?php echo $value->tallukId ?>"><?php echo $value->talluk ?></option>
                                                <?php } } ?>
                                        </select>
                                    </div>

                                    <div class="hr-list">
                                        <table id="dynamic" class="striped ">
                                            <thead class="thead-list">
                                                <th class="h5-para-p2">Name</th>
                                                <th class="h5-para-p2">Reg No.</th>
                                                <th class="h5-para-p2">Mangement Type</th>
                                                <th class="h5-para-p2">Taluk</th>
                                                <th class="h5-para-p2">District</th>
                                                <th class="h5-para-p2">Status</th>
                                                <th class="h5-para-p2">Action</th>
                                            </thead>
                                            <tbody class="tbody-list">
                                                <?php if(!empty($result)){
                                                    foreach ($result as $key => $value) { ?>
                                                    <tr role="row" class="odd">
                                                    <td class="truncate"><a href="<?php echo base_url('institute/').$value->id ?>"><?php echo (!empty($value->school_address))?$value->school_address:'---'; ?></a></td>
                                                    <td><a href="<?php echo base_url('institute/').$value->id ?>"><?php echo (!empty($value->reg_no))?$value->reg_no:'---'; ?></a></td>
                                                    <td><a href="<?php echo base_url('institute/').$value->id ?>"><?php echo (!empty($value->management_type))?$value->management_type:'---'; ?></a></td>
                                                    <td><a href="<?php echo base_url('institute/').$value->id ?>"><?php echo (!empty($value->title))?$value->title:'---'; ?></a></td>
                                                    <td><a href="<?php echo base_url('institute/').$value->id ?>"><?php echo (!empty($value->district))?$value->district:'---'; ?></a></td>

                                                    
                                                    <td class=""><a href="<?php echo base_url('institute/').$value->id ?>">
                                                        <?php
                                                        if($value->status==1){
                                                            echo '<p class="status darken-2">Active</p>';
                                                        }else if($value->status== 0){
                                                            echo '<p class="status blue darken-2">Inactive</p>';
                                                        }else{
                                                            echo '<p class="status red darken-2">Blocked</p>';
                                                        }
                                                        ?></a>
                                                    </td>
                                                    <td class="action-btn center-align">
                                                        <a href="<?php echo base_url('institute/').$value->id ?>" class="vie-btn blue-text waves-effect waves-light"> View</a>
                                                        <a onclick="return confirm('Are you sure you want to delete this item?');" href="" class="red white-text"> <i class="material-icons action-icon ">delete</i></a>
                                                    </td>
                                                </tr>
                                                <?php    } } ?>
                                            </tbody>
                                        </table>
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
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/script.js "></script>
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

        var app = new Vue({
            el: '#app',
            data: {
                loader:false,
                year:'<?php echo $this->input->get('year') ?>',
            },
            methods:{
                yearChange(){
                    window.location.href = "<?php echo base_url('student?year=') ?>"+this.year;
                },
            },
        })

    </script>
</body>


</html>