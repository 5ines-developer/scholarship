<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible " content="ie=edge ">
    <title>Scholarship</title>
    <link rel="stylesheet " href="<?php echo $this->config->item('web_url') ?>assets/css/style.css ">
    <link rel="stylesheet " href="<?php echo $this->config->item('web_url') ?>assets/css/materialize.min.css ">
    <link  rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/material-icons.css">
    <!-- data table -->
    <link rel="stylesheet " href="<?php echo $this->config->item('web_url') ?>assets/dataTable/datatables.min.css ">
    <link rel="stylesheet " href="<?php echo $this->config->item('web_url') ?>assets/dataTable/button/css/buttons.dataTables.css ">
    <style>
        #dynamic_wrapper {
            overflow: auto;
        }
        
        table.striped>tbody>tr>td {
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
                    <?php $this->load->view('include/menu'); ?>
                    <!-- End menu-->
                    <div class="col s12 m9 l9 ">


                        <div class="row">
                            <div class="top-count">
                                <div class="col s12 m3">
                                    <div class="card green hoverable">
                                        <div class="card-content white-text center-align">
                                            <span class="card-title center-align"><i class="material-icons">school</i></span>
                                            <p>
                                                <?php echo $count['tot'] ?>
                                            </p>
                                        </div>
                                        <div class="card-action center-align">
                                            <span class="white-text">Total Applications</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m3">
                                    <div class="card orange hoverable">
                                        <div class="card-content white-text center-align">
                                            <span class="card-title center-align"><i class="material-icons">how_to_reg</i></span>
                                            <p>
                                                <?php echo $count['approved'] ?>
                                            </p>
                                        </div>
                                        <div class="card-action center-align">
                                            <span class="white-text">Approved Applications</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m3">
                                    <div class="card red darken-1 hoverable">
                                        <div class="card-content white-text center-align">
                                            <span class="card-title center-align"><i class="material-icons">school</i></span>
                                            <p>
                                                <?php echo $count['rejected'] ?>
                                            </p>
                                        </div>
                                        <div class="card-action center-align">
                                            <span class="white-text">Rejected Applications</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m3">
                                    <div class="card green  darken-4 hoverable">
                                        <div class="card-content white-text center-align">
                                            <span class="card-title center-align"><i class="material-icons">insert_drive_file</i></span>
                                            <p>
                                                <?php echo $count['ap_this'] ?>
                                            </p>
                                        </div>
                                        <div class="card-action center-align">
                                            <span class="white-text">Applied in <?php echo date('Y') ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                         <!-- End Body form  -->
       <div id="import" class="modal">
            <div class="modal-content company-mc">
                <h4>Upload Application Payment Status</h4>
                <a class="modal-close">
                    <i class="material-icons cc-close">close</i>
                </a>
            </div>
            <div class="modal-footer company-mf">
                <form action="<?php echo base_url('application-status') ?>" method="post" enctype="multipart/form-data">
                    <div class="form-file">
                        <div class="left p5">
                            <a href="<?php echo $this->config->item('web_url') ?>assets/docs/payment-status.xlsx">Download Sample excel</a>
                        </div>
                        <div class="row">
                            <div class="col l12 s12 m12">
                                <div class="file-field input-field col l12 m0 upload-fil">
                                    <div class="btn ">
                                        <span>File</span>
                                        <input type="file" name="file">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" placeholder="Import the excel file here" type="text" required="" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                    </div>
                                </div>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                <div class="col l12">
                                    <div class="ff-inp">
                                        <p><b>Note:</b>File should be in .csv / .xsl format Size should be not more than 200KB</p>
                                    </div>
                                </div>
                                <div class="col l12 m12 s12">
                                    <center> <button class="btn-sub z-depth-1 waves-effect waves-light">
                                        Submit</button></center>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

                        <div class="card darken-1 ">
                            <div class="card-content bord-right ">
                                <div class="title-list ">
                                    <span class="list-title ">Scholarship List</span>

                                    <a href="<?php echo base_url('scholar/csv?item='.$this->input->get('item')) ?>" class="z-depth-1 excel-downbtn">Excel</a>

                                    <a href="#import"  class="bulk-btn z-depth-1 white-text green darken-3 waves-effect waves-ligh modal-trigger">Payment Status Bulk Upload</a>

                                    <select class="browser-default select-list" fname="year" id="short">
                                        <option value="">Choose Year</option>
                                        <option value="">All Year</option>
                                        <?php $yr = $this->input->get('year');
                                                 for($i=date('Y'); $i>= 2000; $i--){ 
                                                $year = $i;
                                                ?>
                                                   <option value="<?php echo $year ?>" <?php if($year == $yr){ echo 'selected="true"'; } ?> ><?php echo $year ?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                                <div class="board-content ">
                                    <div class="row m0">

                                    <div class="table-detail">
                                        <select name="dist" fname="district" id="dis-drp" class="select-list">
                                                <option value="" selected>District</option>
                                                <?php if (!empty($district)) {
                                                    $ds = $this->input->get('district');
                                                   foreach ($district as $key => $value) { ?> 
                                                       <option value="<?php echo $value->district ?>" <?php if($value->district == $ds){ echo 'selected="true"'; } ?>><?php echo $value->district ?></option>
                                                <?php } } ?>
                                               
                                        </select>
                                        <select name="dist" fname="taluk" id="dis-drp" class="select-list">
                                                <option value="" selected>Taluk</option>
                                                <?php
                                                if (!empty($taluk)) {
                                                    $tl = $this->input->get('taluk');
                                                   foreach ($taluk as $key => $value) { ?> 
                                                       <option value="<?php echo $value->talluk ?>" <?php if($value->talluk == $tl){ echo 'selected="true"'; } ?>><?php echo $value->talluk ?></option>
                                                <?php } } ?>
                                        </select>
                                        <select name="dist" fname="caste" id="dis-drp" class="select-list">
                                            <option value="" selected>Caste</option>
                                            <option value="sc" <?php if($this->input->get('caste') == 'sc'){ echo 'selected="true"'; } ?>>SC</option>
                                            <option value="st" <?php if($this->input->get('caste') == 'st'){ echo 'selected="true"'; } ?>>ST</option>
                                            <option value="general" <?php if($this->input->get('caste') == 'general'){ echo 'selected="true"'; } ?>>General</option>
                                            <option value="obc" <?php if($this->input->get('caste') == 'obc'){ echo 'selected="true"'; } ?>>OBC</option>
                                        </select>



                                        <?php if ((isset($_GET["district"]) || isset($_GET["taluk"]) || isset($_GET["caste"]) || isset($_GET["year"]) )) {
                                            $item = $this->input->get('item');
                                            ?>
                                            <a href="<?php echo base_url('applications?item='.$item)?>" class="p5 grey white-text  waves-effect waves-light clear-filter">Clear All <i class="material-icons"> close </i></a> 
                                        <?php } ?>
                                        
                                    </div>
                                    </div>

                                    <div class="hr-list">
                                        <table id="dynamic" class="striped ">
                                            <thead class="thead-list">
                                                <th id="a" class="h5-para-p2" style="width: 120px;">SL No.</th>
                                                <th id="a" class="h5-para-p2" style="width: 120px;">Name</th>
                                                <th id="g" class="h5-para-p2" style="width: 120px;">Present Class</th>
                                                <th id="d" class="h5-para-p2" style="width: 120px;">Year</th>
                                                <th id="d" class="h5-para-p2" style="width: 120px;">Payment Status</th>
                                                <th id="d" class="h5-para-p2" style="width: 120px;">Adhaar No.</th>
                                                <th id="e" class="h5-para-p2" style="width: 120px;">Applied Date</th>
                                                <th id="f" class="h5-para-p2" style="width: 120px;">District</th>
                                                <th id="g" class="h5-para-p2" style="width: 120px;">Taluk</th>
                                                <th id="h" class="h5-para-p2" style="width: 120px;">Status</th>
                                                <th id="h" class="h5-para-p2" style="width: 120px;">Amount</th>
                                                <th id="h" class="h5-para-p2" style="width: 120px;">Account Holder</th>
                                                <th id="h" class="h5-para-p2" style="width: 120px;">Account No.</th>
                                                <th id="h" class="h5-para-p2" style="width: 120px;">IFSC  Code</th>
                                                <th id="h" class="h5-para-p2" style="width: 120px;">Bank Name</th>
                                                <th id="h" class="h5-para-p2" style="width: 120px;">Branch</th>
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
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <!--   <script src="//cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script> -->
    <!-- data table -->


    <script>
        <?php $this->load->view('include/msg'); ?>
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
            var yar = '<?php echo $this->input->get('year') ?>';
            var dist = '<?php echo $this->input->get('district') ?>';
            var tal = '<?php echo $this->input->get('taluk') ?>';
            var cas = '<?php echo $this->input->get('caste') ?>';
            var item = '<?php echo $this->input->get('item') ?>';


            $('.select-list').change(function() {

                if (window.location.href.indexOf("?") < 0) {
                    var windowUrl = window.location.href + '?';
                } else {
                    var windowUrl = window.location.href;
                }

                var val = $(this).val();
                var name = '&' + $(this).attr('fname') + '=';
                var names = $(this).attr('fname');
                var url = windowUrl + name + val;
                var originalURL = windowUrl + name + val;
                var alteredURL = removeParam(names, originalURL);
                window.location = alteredURL + name + val;
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

            var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
            csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

            var dataTable = $('#dynamic').DataTable({
                'processing': true,
                'serverSide': true,
                'dom': 'Bfrtip',
                'buttons': [
                    'excel',
                ],
                'order': [],
                'ajax': {
                    'url': "<?php echo base_url(). 'scholar/allApplication' ?>",
                    'type': 'POST',
                    "data": {
                        "year": yar,
                        "district": dist,
                        "taluk": tal,
                        "caste": cas,
                        "item": item,
                        [csrfName]: csrfHash,
                    }
                },
                'columnDefs': [{
                    "targets": [0, 3],
                    "orderable": false,
                }]
            })



            $('select').formSelect();
            $('.modal').modal();
        });
    </script>
</body>


</html>