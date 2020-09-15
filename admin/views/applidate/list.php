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
        <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/style.css">
        <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/materialize.min.css">
        <link  rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/material-icons.css">
        <!-- data table -->
        <link rel="stylesheet " href="<?php echo $this->config->item('web_url') ?>assets/dataTable/datatables.min.css ">
        <link rel="stylesheet " href="<?php echo $this->config->item('web_url') ?>assets/dataTable/button/css/buttons.dataTables.css ">
        <script src="<?php echo $this->config->item('web_url') ?>assets/js/script.js "></script>
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
                                        <span class="list-title ">Application Date List</span>
                                        <a href="<?php echo base_url() ?>application-date/add" class="back-btn z-depth-1 waves-effect waves-ligh hoverable add-btn"> <i class="material-icons add-icon ">add</i><span>Add New Date</span></a>
                                    </div>
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    
                                    <div class="board-content ">
                                        <div class="hr-list">
                                            <table id="dynamic" class="striped ">
                                                <thead class="thead-list">
                                                    <th class="h5-para-p2">Sl No.</th>
                                                    <th class="h5-para-p2">APPlication Start Date</th>
                                                    <th class="h5-para-p2">APPlication End Date</th>
                                                    <th class="h5-para-p2">Action</th>
                                                </thead>
                                                <tbody class="tbody-list">
                                                    <?php
                                                    if (!empty($result)) {
                                                    $sl = 0;
                                                    foreach ($result as $key => $value) {
                                                    $sl++;
                                                    ?>
                                                    <tr role="row" class="odd">
                                                        <td><?php echo $sl; ?></td>
                                                        <td><?php echo (!empty($value->fromdate))?date('d M, Y',strtotime($value->fromdate)):''; ?></td>
                                                        <td><?php echo (!empty($value->todate))?date('d M, Y',strtotime($value->todate)):''; ?></td>
                                                        <td class="action-btn">
                                                            <?php if (date("Y", strtotime($value->fromdate)) < date('Y')) {
                                                            echo '<span class="red-text">You Cannot make changes on previour year data</span>';
                                                            
                                                            }else{ ?>
                                                            <a href="<?php echo base_url('application-date/edit/').$value->id ?>" class="vie-btn blue-text waves-effect waves-light left modal-trigger" > Edit </a>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                                            <a onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo base_url('application-date/delete/').$value->id ?>" class="red white-text center-align"> <i class="material-icons action-icon ">delete</i></a>
                                                            <?php } ?>
                                                            
                                                        </td>
                                                    </tr>
                                                    <?php   }
                                                    }
                                                    ?>
                                                    
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
        document.addEventListener('DOMContentLoaded', function() {
        var instances = M.Sidenav.init(document.querySelectorAll('.sidenav'));
        var gropDown = M.Dropdown.init(document.querySelectorAll('.dropdown-trigger'), {
        constrainWidth: false,
        alignment: 'right'
        })
        var elems = document.querySelectorAll('.datepicker');
        var instances = M.Datepicker.init(elems, {
        format: 'yyyy-mm-dd',
        });
        });
        </script>
        <script>
        $(document).ready(function() {
        var table = $('table').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'excel',
        ],
        language: {
        search: '<i class="material-icons dp48">search</i>',
        searchPlaceholder: 'Search Items'
        }
        });
        $('select').formSelect();
        $('.modal').modal();
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