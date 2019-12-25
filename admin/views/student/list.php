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
</head>

<body>
    <div id="app">
        <?php $this->load->view('include/header'); ?>

        <!-- Body form  -->
        <section class="board ">
            <div class="container-wrap1 ">
                <div class="row m0 ">
                    <div class="col s12 m3 l3 hide-on-med-and-down ">
                        <div class="menu-left ">
                            <?php $this->load->view('include/menu'); ?>
                        </div>
                    </div>
                    <!-- End menu-->

                    <div class="col s12 m9 l9 ">
                        <div class="card darken-1 ">
                            <div class="card-content bord-right ">
                                <div class="title-list ">
                                    <span class="list-title ">Student  List</span>
                                    <select class="browser-default" id="short" @change="yearChange()" v-model="year">
                                        <?php
                                            for($i=2000; $i<= date('Y')+1 ; $i++){
                                               echo '<option value="'.($i - 1) .'-'.($i ).'" >'.($i - 1) .'-'.($i ).'</option>';
                                        } ?>
                                    </select>
                                    <!-- <select class="browser-default" id="short" @change="yearChange()" v-model="year">
                                         <option value=""></option>
                                    </select>
                                    <select class="browser-default" id="short" @change="yearChange()" v-model="year">
                                        <option value=""></option>
                                    </select> -->
                                </div>
                                <div class="board-content ">
                                    <div class="hr-list">
                                        <table id="dynamic" class="striped ">
                                            <thead class="thead-list">
                                                <th class="h5-para-p2">Name</th>
                                                <th class="h5-para-p2">Email</th>
                                                <th class="h5-para-p2">Phone No</th>
                                                <th class="h5-para-p2">Reg Date</th>
                                                <th class="h5-para-p2">Status</th>
                                                <th class="h5-para-p2">Action</th>
                                            </thead>
                                            <tbody class="tbody-list">
                                                <?php if(!empty($result)){
                                                    foreach ($result as $key => $value) { ?>
                                                    <tr role="row" class="odd">
                                                    <td><a href="<?php echo base_url('student/').$value->id ?>"><?php echo (!empty($value->name))?$value->name:'---'; ?></a></td>
                                                    <td class="truncate"><a href="<?php echo base_url('student/').$value->id ?>"><?php echo (!empty($value->email))?$value->email:'---'; ?></a></td>
                                                    <td><a href="<?php echo base_url('student/').$value->id ?>"><?php echo (!empty($value->phone))?$value->phone:'---'; ?></a></td>
                                                    <td class=""><a href="<?php echo base_url('student/').$value->id ?>"><?php echo (!empty($value->date))?date('d M, Y',strtotime($value->date)):'---'; ?></a></td>
                                                    <td class=""><a href="<?php echo base_url('student/').$value->id ?>">
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
                                                        <a href="<?php echo base_url('student/').$value->id ?>" class="green white-text"> <i class="material-icons action-icon ">remove_red_eye</i></a>
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