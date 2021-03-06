<?php
$this->ci =& get_instance();
$this->load->model('m_stdapplication');
$this->load->library('encryption');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible " content="ie=edge ">
    <title>Scholarship</title>
    <link rel="stylesheet " href="<?php echo base_url() ?>assets/css/style.css ">
    <link rel="stylesheet " href="<?php echo base_url() ?>assets/css/materialize.min.css ">
    <link  rel="stylesheet" href="<?php echo base_url() ?>assets/css/material-icons.css">
    <!-- data table -->
    <link rel="stylesheet " href="<?php echo base_url() ?>assets/dataTable/datatables.min.css ">
    <link rel="stylesheet " href="<?php echo base_url() ?>assets/dataTable/button/css/buttons.dataTables.css ">
    <style>
        .vie-btn {
            padding-right: 12px;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div id="app">
        <?php $this->load->view('includes/header'); ?>

        <!-- Body form  -->
        <section class="board ">
            <div class="container-wrap1 ">
                <div class="row m0 ">
                    <?php $this->load->view('includes/student-sidebar'); ?>
                    <!-- End menu-->

                    <div class="col m12 l9  s12">
                        <div class="card darken-1 ">
                            <div class="card-content bord-right ">
                                <div class="title-list ">
                                    <span class="list-title ">Scholarship  List</span>
                                    <select class="browser-default" id="short" @change="yearChange()" v-model="year">
                                        <option value="">Choose Year</option>
                                        <?php $yr = $this->input->get('year');
                                            for($i=date('Y'); $i>= 2000; $i--){ 
                                                    $year = $i;
                                            ?>
                                            <option value="<?php echo $year ?>" <?php if($year == $yr){ echo 'selected="true"'; } ?> ><?php echo $year ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="board-content">
                                    <div class="hr-list">
                                        <table id="dynamic" class="striped">
                                            <thead class="thead-list">
                                                <th class="h5-para-p2">Name</th>
                                                <th class="h5-para-p2">Instituite</th>
                                                <th class="h5-para-p2">Industry</th>
                                                <th class="h5-para-p2">Class</th>
                                                <th class="h5-para-p2">Amount</th>
                                                <th class="h5-para-p2">Year</th>
                                                <th class="h5-para-p2">Applied Date</th>
                                                <th class="h5-para-p2">Action</th>
                                            </thead>
                                            <tbody class="tbody-list">
                                                <?php if(!empty($result)){
                                                    foreach ($result as $key => $value) { 
                                                        // $id = urlencode(base64_encode($value->id));


                                                $id = $this->ci->encryption_url->safe_b64encode($value->id);


                                                    ?>
                                                <tr role="row" class="odd">

                                                    <td><a href="<?php echo base_url('student/application-list/').$id ?>"><?php echo (!empty($value->name))?$value->name:'---'; ?></a></td>

                                                    <td class="truncate"><a href="<?php echo base_url('student/application-list/').$id ?>"><?php echo (!empty($value->school))?$value->school:'---'; ?></a></td>

                                                    <td class=""><a href="<?php echo base_url('student/application-list/').$id ?>"><?php echo (!empty($value->industry))?$value->industry:'---'; ?></a></td>

                                                    <td><a href="<?php echo base_url('application-list/').$id ?>"><?php echo (!empty($value->course))?$value->course:''; ?><?php echo (!empty($value->clss))?$value->clss:''; ?></a></td>

                                                    <td><a href="<?php echo base_url('student/application-list/').$id ?>"><?php echo $this->ci->m_stdapplication->getamnt($value->application_year,$value->graduation) ?></a></td>

                                                    <td><a href="<?php echo base_url('student/application-list/').$id ?>"><?php echo (!empty($value->application_year))?$value->application_year:'---'; ?></a></td>

                                                    <td class=""><a href="<?php echo base_url('student/application-list/').$id ?>"><?php echo (!empty($value->date))?date('d M, Y',strtotime($value->date)):'---'; ?></a></td>


                                                    <td class="action-btn center-align">
                                                        <a href="<?php echo base_url('student/application-list/').$id ?>" class="vie-btn blue-text waves-effect waves-light"> View </a>
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
        <?php $this->load->view('includes/footer'); ?>
        <!-- End footer -->
    </div>




    <!-- scripts -->
    <script src="<?php echo base_url() ?>assets/js/jquery-3.4.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/vue.js "></script>
    <script src="<?php echo base_url() ?>assets/js/materialize.min.js "></script>
    <script src="<?php echo base_url() ?>assets/js/axios.min.js "></script>
    <script src="<?php echo base_url() ?>assets/js/script.js"></script>
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
    <?php $this->load->view('includes/message'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var instances = M.FormSelect.init(document.querySelectorAll('select'));
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
            var table = $('table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel',
                ],

            });
            $('select').formSelect();
            $('.modal').modal();
        });

        var app = new Vue({
            el: '#app',
            data: {
                loader: false,
                year: '<?php echo $this->input->get('year ') ?>',
            },
            methods: {
                yearChange() {
                    window.location.href = "<?php echo base_url('student/application-list?year=') ?>" + this.year;
                },
            },
        })
    </script>
</body>


</html>