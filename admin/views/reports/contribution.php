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
                                    <span class="list-title ">Reports - Contribution</span>
                                    <select class="browser-default select-list" fname="year" id="short">
                                        <option value="">Choose Year</option>
                                        <?php $yr = $this->input->get('year');
                                                 for($i=date('Y'); $i>= 2000; $i--){ 
                                                $year = $i;
                                                ?>
                                                   <option value="<?php echo $year ?>" <?php if($year == $yr){ echo 'selected="true"'; } ?> ><?php echo $year ?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                                <div class="board-content ">
                                    <div class="hr-list">
                                        <table id="dynamic" class="striped ">
                                            <thead class="thead-list">
                                                <th id="c" class="h5-para-p2" style="width: 100px;">Sl No.</th>
                                                <th id="c" class="h5-para-p2" style="width: 100px;">Year</th>
                                                <th id="c" class="h5-para-p2" style="width: 100px;">Total Contribution Completed</th>
                                                <th id="c" class="h5-para-p2" style="width: 100px;">Total Contribution Pending</th>
                                                <th id="e" class="h5-para-p2" style="width: 100px;">Amount</th>
                                            </thead>
                                            <tbody class="tbody-list">
                                                <?php if (!empty($result)) {
                                                    $i = 0;
                                                   foreach ($result as $key => $value) { $i++; ?>
                                                      <tr>
                                                        <td><?php echo $i ?></td>
                                                        <td><?php echo $value->year ?></td>
                                                        <td><?php echo $value->completed ?></td>
                                                        <td><?php echo $value->pending ?></td>
                                                        <td><?php echo $value->amount ?></td>
                                                    </tr>
                                                <?php  } } ?> 

                                                
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
            $('.rpt-m >.collapsible-body').css({
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
            var yar     = '<?php echo $this->input->get('year') ?>';
            var dist    = '<?php echo $this->input->get('district') ?>';
            var tal     = '<?php echo $this->input->get('taluk') ?>';
            var cas     = '<?php echo $this->input->get('caste') ?>';
            var item     = '<?php echo $this->input->get('item') ?>';
            

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

            var dataTable = $('#dynamic').DataTable({
                  'processing' : true,
                  'dom': 'Bfrtip',
                  'buttons': [
                     'copy', 'csv', 'pdf'
                  ],
                  'language': {
                        'search': '<i class="material-icons dp48">search</i>',
                        'searchPlaceholder': 'Search Items'
                    }, 
               })



            $('select').formSelect();
            $('.modal').modal();
        });

    </script>
</body>


</html>