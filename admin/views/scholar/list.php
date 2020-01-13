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
        #dynamic_wrapper {overflow: auto;}
        table.striped > tbody > tr > td {
            border-radius: 0;
            text-align: left;
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
                        <div class="card darken-1 ">
                            <div class="card-content bord-right ">
                                <div class="title-list ">
                                    <span class="list-title ">Scholarship List</span>
                                    <select class="browser-default" id="short">
                                        <option value="">Choose Year</option>
                                        <?php
                                            for($i=2000; $i<= date('Y')+1 ; $i++){
                                               echo '<option value="'.($i - 1) .'-'.($i ).'" >'.($i - 1) .'-'.($i ).'</option>';
                                        } ?>
                                    </select>
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
                                                <th id="a" class="h5-para-p2" style="width: 120px;">Name</th>
                                                <th id="c" class="h5-para-p2" style="width: 120px;">Institute</th>
                                                <th id="c" class="h5-para-p2" style="width: 120px;">Industry</th>
                                                <th id="g" class="h5-para-p2" style="width: 120px;">Present Class</th>
                                                <th id="d" class="h5-para-p2" style="width: 120px;">Year</th>
                                                <th id="e" class="h5-para-p2" style="width: 120px;">Applied Date</th>
                                                <th id="f" class="h5-para-p2" style="width: 120px;">District</th>
                                                <th id="g" class="h5-para-p2" style="width: 120px;">Talluk</th>
                                                <th id="h" class="h5-para-p2" style="width: 120px;">Status</th>
                                                <th id="i" class="h5-para-p2" style="width: 120px;">Action</th>
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
    <script>
        $(document).ready(function() {
            $('.sc-m >.collapsible-body').css({
                display: 'block',
            });
        });
    </script>

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
            var year = '<?php $this->input->get('year') ?>';

            $('#short').on('change',function(){
                var year = $(this).val();

                // if(window.location.href.indexOf("?") > 0) 
                // {
                //     var windowURL = window.location.href; 
                //     var arr = windowURL.split('?')[0];
                //     var url =  arr+'?year='+year;
                // }else{
                //     var url = window.location.href+'?year='+year;
                // }

                if(window.location.href.indexOf("?year") > 0) 
                {
                    var arr = window.location.href.split('?year')[0];
                    // var district = window.location.href.split('&district=')[1];
                    // var taluk = window.location.href.split('&taluk=')[1];
                    alert(arr)
                   
                    var url = windowURL = arr+'&year='+year; 
                }else{
                    alert('no')
                    var url = windowURL = window.location.href+'?year='+year; 
                }
                // window.location = url;
            });

            $('#district').on('change',function(){
                var district = $(this).val();
                if(window.location.href.indexOf("?") > 0) 
                {
                    var url = windowURL = window.location.href+'&district='+district; 
                }else{
                    var url = windowURL = window.location.href+'?district='+district; 
                }

                window.location = url;
            });

            $('#taluk').on('change',function(){
                var taluk = $(this).val();
                if(window.location.href.indexOf("?") > 0) 
                {
                    var url = windowURL = window.location.href+'&taluk='+taluk; 
                }else{
                    var url = windowURL = window.location.href+'?taluk='+taluk; 
                }

                window.location = url;
            });

            


            


            var dataTable = $('#dynamic').DataTable({
                  'processing' : true,
                  'serverSide' : true,
                  'dom': 'Bfrtip',
                  'buttons': [
                     'copy', 'csv', 'pdf'
                  ], 
                  'order' : [],
                  'ajax':{
                    'url' : "<?php echo base_url(). 'scholar/allApplication' ?>",
                     'type' :'POST',
                     "data": {
                        "param_name":  year
                    }
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
        });

    </script>
</body>


</html>