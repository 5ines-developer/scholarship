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
                                  <span class="card-title center-align"><i class="material-icons">location_city</i></span>
                                   <p><?php echo $count['tot'] ?></p>
                                </div>
                                <div class="card-action center-align">
                                  <span class="white-text">Total Industries</span>
                                </div>
                              </div>
                            </div>
                            <div class="col s12 m3">
                              <div class="card orange hoverable">
                                <div class="card-content white-text center-align">
                                  <span class="card-title center-align"><i class="material-icons">how_to_reg</i></span>
                                   <p><?php echo $count['cr_scool'] ?></p>
                                </div>
                                <div class="card-action center-align">
                                  <span class="white-text">Registered in <?php echo date('Y') ?></span>
                                </div>
                              </div>
                            </div>
                            <div class="col s12 m3">
                              <div class="card blue darken-1 hoverable">
                                <div class="card-content white-text center-align">
                                  <span class="card-title center-align"><i class="material-icons">location_city</i></span>
                                   <p><?php echo $count['ac_ind'] ?></p>
                                </div>
                                <div class="card-action center-align">
                                  <span class="white-text">Active Industries</span>
                                </div>
                              </div>
                            </div>
                            <div class="col s12 m3">
                              <div class="card green  darken-4 hoverable">
                                <div class="card-content white-text center-align">
                                  <span class="card-title center-align"><i class="material-icons">insert_drive_file</i></span>
                                   <p><?php echo $count['tot_app'] ?></p>
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
                                    <span class="list-title ">Industry  List</span>
                                </div>
                                <div class="board-content ">
                                    <div class="row m0">

                                    <div class="table-detail">
                                        <select name="dist" fname="district" id="dis-drp" class="select-list">
                                                <option value="" disabled selected>District</option>
                                                <?php
                                                if (!empty($district)) {
                                                     $ds = $this->input->get('district');
                                                   foreach ($district as $key => $value) { ?>
                                                    <option value="<?php echo $value->districtId ?>" <?php if($value->districtId == $ds){ echo 'selected="true"'; } ?>><?php echo $value->district ?></option>
                                                <?php } } ?>
                                        </select>
                                        <select name="dist" fname="taluk" id="dis-drp" class="select-list">
                                                <option value="" disabled selected>Taluk</option>
                                                <?php if (!empty($taluk)) {
                                                    $tl = $this->input->get('taluk');
                                                   foreach ($taluk as $key => $value) { ?> 
                                                       <option value="<?php echo $value->tallukId ?>" <?php if($value->tallukId == $tl){ echo 'selected="true"'; } ?>><?php echo $value->talluk ?></option>
                                                <?php } } ?>
                                        </select>
                                    </div>
                                    </div>

                                    <div class="hr-list">
                                        <table id="dynamic" class="striped ">
                                            <thead class="thead-list">
                                                <th class="h5-para-p2">Name</th>
                                                <th class="h5-para-p2">Reg No.</th>
                                                <th class="h5-para-p2">Act</th>
                                                <th class="h5-para-p2">District</th>
                                                <th class="h5-para-p2">Taluk</th>
                                                <th class="h5-para-p2">Status</th>
                                                <th class="h5-para-p2">Action</th>
                                            </thead>
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
            var dataTable = $('#dynamic').DataTable({
                  'processing' : true,
                  'serverSide' : true,
                  'dom': 'Bfrtip',
                  'buttons': [
                     'copy', 'csv', 'pdf'
                  ], 
                  'order' : [],
                  'ajax':{
                    'url' : "<?php echo base_url(). 'industry/getIndustry' ?>",
                     'type' :'POST'
                  },
                  'columnDefs':[
                     {
                        "targets":[0, 3],
                        "orderable":false,
                     }
                  ]
               })
            $('select').formSelect();
            $('.modal').modal();

            $('.select-list').change(function(){
                if(window.location.href.indexOf("?") < 0){
                    var windowUrl = window.location.href+'?';
                } else{
                    var windowUrl = window.location.href;
                }
                var val = $(this).val();
                var name = '&'+$(this).attr('fname')+'=';
                var names=$(this).attr('fname');
                var url = windowUrl+name+val;
                var originalURL = windowUrl+name+val;
                var alteredURL = removeParam(names, originalURL);
                console.log(url);
                console.log(windowUrl);
                window.location = alteredURL+name+val;
            });
            function removeParam(key, sourceURL) {
                var rtn = sourceURL.split("?")[0],
                    param,
                    params_arr = [],
                    queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
                if (queryString !== "") {
                    params_arr = queryString.split("&");
                    for (var i = params_arr.length - 1; i >= 0; i -= 1) {
                        param = params_arr[i].split("=")[0];
                        if (param === key) {
                            params_arr.splice(i, 1);
                        }
                    }
                    rtn = rtn + "?" + params_arr.join("&");
                }
                return rtn;
            }


        });

        var app = new Vue({
            el: '#app',
            data: {
                loader:false,
                
            },
            methods:{
                
            },
        })

    </script>
</body>


</html>