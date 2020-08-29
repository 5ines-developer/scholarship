<?php
$this->ci =& get_instance();
$this->load->library('Encryption_url');
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
    <link  rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/material-icons.css">
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
                    <?php $this->load->view('include/menu'); ?>
                    <!-- End menu-->
                    <div class="col s12 m9 l9 ">
                        <div class="card darken-1 ">
                            <div class="card-content bord-right ">
                                <div class="title-list pb0">
                                    <span class="list-title ">Payment List</span>
                                </div>
                                <div class="board-content ">
                                    <div class="hr-list">
                                        <table id="dynamic" class="striped ">
                                            <thead class="thead-list">
                                                <th id="a" class="h5-para-p2">Company Name</th>
                                                <th id="b" class="h5-para-p2">Year</th>
                                                <th id="c" class="h5-para-p2">Male Employees</th>
                                                <th id="c" class="h5-para-p2">Female Employees</th>
                                                <th id="c" class="h5-para-p2">Total no of Employees</th>
                                                <th id="c" class="h5-para-p2">Amount</th>
                                                <th id="c" class="h5-para-p2">Form D</th>
                                                <th id="c" class="h5-para-p2">Receipt</th>
                                            </thead>
                                            <tbody class="tbody-list">

                                                <?php if (!empty($result)) {
                                                    foreach ($result as $key => $value) { 
                                                        $id = $this->ci->encryption_url->safe_b64encode($value->id);
                                                    ?>
                                                    <tr role="row" class="odd">
                                                        <td class="truncate"><?php echo !empty($value->comp)?$value->comp:''; ?></td>
                                                        <td><?php echo !empty($value->year)?$value->year:''; ?></td>
                                                        <td><?php echo !empty($value->male)?$value->male:''; ?></td>
                                                        <td><?php echo !empty($value->female)?$value->female:''; ?></td>
                                                        <td><?php echo $value->male + $value->female; ?></td>
                                                        <td><?php echo !empty($value->price)?$value->price:''; ?></td>
                                                        <td class=""><a class="green-text" href="<?php echo base_url('formd-download/').$id; ?>">Download</a></td>
                                                        <td class=""><a class="green-text" href="<?php echo base_url('receipt/').$id; ?>">View</a></td>
                                                    </tr>
                                                <?php   } } ?>


                                                
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

        <!-- bulk upload file -->
        <!-- Modal Structure -->
        <!-- Modal Structure -->
        <div id="import" class="modal">
            <div class="modal-content company-mc">
                <h4>Bulk Upload Document</h4>
                <a href="#!" class="modal-close">
                    <i class="material-icons cc-close">close</i>
                </a>
            </div>
            <div class="modal-footer company-mf">
                <form action="">
                    <div class="form-file">
                        <div class="row">
                            <div class="col l12 s12 m12">
                                <div class="file-field input-field col l12 m0 upload-fil">
                                    <div class="btn ">
                                        <span>File</span>
                                        <input type="file">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" placeholder="Upload hr detail" type="text" required="">
                                    </div>
                                </div>
                                <div class="col l12">
                                    <div class="ff-inp">
                                        <p><b>Note:</b>File should be in .pdf / .jpg format Size should be not more than 200KB</p>
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
                buttons: []
            });
            $('select').formSelect();
            $('.modal').modal();
        });

        var app = new Vue({
            el: '#app',
            data: {
                loader:false,
            },
            mounted() {

            },
            methods: {

            }
        });
    </script>
</body>


</html>