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
                                    <span class="list-title ">Scholarship Amount List</span>
                                    <a href="<?php echo base_url() ?>fees/add" class="back-btn z-depth-1 waves-effect waves-ligh hoverable add-btn">
                                        <i class="material-icons add-icon ">add</i><span>Add New</span></a>
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
                                </div>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                
                                <div class="board-content ">
                                    <div class="hr-list">
                                        <table id="dynamic" class="striped ">
                                            <thead class="thead-list">
                                                <th class="h5-para-p2">Sl No.</th>
                                                <th class="h5-para-p2">Course</th>
                                                <th class="h5-para-p2">Scholarship Amount</th>
                                                <th class="h5-para-p2 sorting_asc">Year</th>
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
                                                            <td><?php echo (!empty($value->title))?$value->title:''; ?></td>
                                                            <td><?php echo (!empty($value->amount))?$value->amount:''; ?></td>
                                                            <td><?php echo (!empty($value->date))?$value->date:''; ?></td>
                                                            <td class="action-btn">
                                                                <?php if ($value->date != date('Y')) { 

                                                                    echo '<span class="red-text">You Cannot make changes on previour year data</span>';
                                                                    
                                                                }else{ ?>

                                                                    <a href="<?php echo base_url('fees/edit/').$this->encryption_url->safe_b64encode($value->feesId) ?>" class="vie-btn blue-text waves-effect waves-light left" > Edit </a>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <a onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo base_url('fees/delete/').$value->feesId ?>" class="red white-text center-align"> <i class="material-icons action-icon ">delete</i></a>
                                                                    
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
                year:'<?php echo $this->input->get('year') ?>',
            },
            methods:{
                yearChange(){
                    window.location.href = "<?php echo base_url('fees/manage?year=') ?>"+this.year;
                },
            },
        })

    </script>
</body>


</html>`