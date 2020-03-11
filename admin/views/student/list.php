<?php
$this->ci =& get_instance();
$this->load->library('encryption');
?>
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
        .vie-btn{padding-right: 12px; font-weight: 600; }
    </style>
</head>

<body>
    <div id="app">
        <?php $this->load->view('include/header'); ?>

        <!-- Body form  -->
        <section class="board ">
            <div class="container-wrap1 ">
                <div class="row m0 ">
                    <div class="col m3 l3  s12hide-on-med-and-down ">
                        <?php $this->load->view('include/menu'); ?>
                    </div>
                    <!-- End menu-->
                    <div class="col m9 l9  s12">
<div class="row">
<div class="top-count">                     
    <div class="col s12 m3">
      <div class="card green hoverable">
        <div class="card-content white-text center-align">
          <span class="card-title center-align"><i class="material-icons">supervisor_account</i></span>
           <p><?php echo $count['tot'] ?></p>
        </div>
        <div class="card-action center-align">
          <span class="white-text">Total Students</span>
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
          <span class="card-title center-align"><i class="material-icons">insert_drive_file</i></span>
           <p><?php echo $count['app_year'] ?></p>
        </div>
        <div class="card-action center-align">
          <span class="white-text">Total Scolarship Applied</span>
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
          <span class="white-text">Applied in <?php echo date('Y') ?></span>
        </div>
      </div>
    </div>
</div>
</div>              




                      

                        <div class="card darken-1 ">
                            <div class="card-content bord-right ">
                                <div class="title-list ">
                                    <span class="list-title ">Student  List</span>

                                    <a href="<?php echo base_url() ?>student-add" class="back-btn z-depth-1 waves-effect waves-ligh hoverable add-btn">
                                        <i class="material-icons add-icon ">add</i><span>Add New Student</span></a>

                                    <select class="browser-default" id="short" @change="yearChange()" v-model="year">
                                        <option value="">Choose Year</option>
                                        <option value="">All Year</option>

                                        <?php
                                            $yr = $this->input->get('year');
                                            for($i=date('Y'); $i>= 2000; $i--){ 
                                            $year = $i;
                                            ?>
                                            <option value="<?php echo $year ?>" <?php if($year == $yr){ echo 'selected="true"'; } ?> ><?php echo $year ?></option>
                                        <?php } ?>

                                        
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
                                            <thead class="thead-list std-list">
                                                <th class="h5-para-p2">Name</th>
                                                <th class="h5-para-p2">Email</th>
                                                <th class="h5-para-p2">Phone No</th>
                                                <th class="h5-para-p2">Reg Date</th>
                                                <th class="h5-para-p2">Status</th>
                                                <th class="h5-para-p2">Action</th>
                                            </thead>
                                            <tbody class="tbody-list">
                                                <?php if(!empty($result)){
                                                    foreach ($result as $key => $value) { 

                                                        $id = $this->ci->encryption_url->safe_b64encode($value->id);

                                                    ?>
                                                    <tr role="row" class="odd">
                                                    <td><a href="<?php echo base_url('student/').$id ?>"><?php echo (!empty($value->name))?$value->name:'---'; ?></a></td>
                                                    <td class="truncate"><a href="<?php echo base_url('student/').$id ?>"><?php echo (!empty($value->email))?$value->email:'---'; ?></a></td>
                                                    <td><a href="<?php echo base_url('student/').$id ?>"><?php echo (!empty($value->phone))?$value->phone:'---'; ?></a></td>
                                                    <td class=""><a href="<?php echo base_url('student/').$id ?>"><?php echo (!empty($value->date))?date('d M, Y',strtotime($value->date)):'---'; ?></a></td>
                                                    <td class=""><a href="<?php echo base_url('student/').$id ?>">
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
                                                        <a href="<?php echo base_url('student/').$id ?>" class="vie-btn blue-text waves-effect waves-light" > View </a>
                                                        <a href="<?php echo base_url('student-edit/').$id ?>" class="vie-btn blue-text waves-effect waves-light left" > Edit </a>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <a onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo base_url('student-delete/').$value->id ?>" class="red white-text"> <i class="material-icons action-icon ">delete</i></a>
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