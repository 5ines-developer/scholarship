<?php
$this->ci =& get_instance();
$this->load->model('m_application');
$this->load->library('encryption');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible " content="ie=edge ">
    <title><?php echo $title ?></title>
    <link rel="stylesheet " href="<?php echo $this->config->item('web_url') ?>assets/css/style.css ">
    <link rel="stylesheet " href="<?php echo $this->config->item('web_url') ?>assets/css/materialize.min.css ">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons " rel="stylesheet ">
    <!-- data table -->
    <link rel="stylesheet " href="<?php echo $this->config->item('web_url') ?>assets/dataTable/datatables.min.css ">
    <link rel="stylesheet " href="<?php echo $this->config->item('web_url') ?>assets/dataTable/button/css/buttons.dataTables.css ">
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/jquery-3.4.1.min.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js "></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js "></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/axios.min.js "></script>
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
                                <div class="title-list ">
                                    <span class="list-title ">Scholarship Approved List (<?php echo (!empty($result))?count($result):'0'; ?>)</span>
                                    <select class="browser-default" id="short" name="years" @change="yearChange()" v-model="year">
                                    <option value="" >Select by Year</option>
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
                                                <th id="a" class="h5-para-p2">SL NO.</th>
                                                <th id="a" class="h5-para-p2">NAME</th>
                                                <th id="c" class="h5-para-p2">MARKS</th>
                                                <th id="g" class="h5-para-p2">PRESENT CLASS</th>
                                                <th id="g" class="h5-para-p2">Amount</th>
                                                <th id="g" class="h5-para-p2">Action</th>
                                            </thead>
                                            <tbody class="tbody-list">
                                                
                                                    <?php
                                                    $i=0;
                                                    if (!empty($result)) {
                                                       foreach ($result as $key => $value) { 
                                                           $i++;
                                                           // $id = urlencode(base64_encode($value->id));

                                                           $id = $this->ci->encryption_url->safe_b64encode($value->id);

                                                        echo '<tr role="row" class="odd"><td class="h5-para-p2"><a href="'.base_url('application/').$id.'">'.$i.'</a></td>
                                                        <td class="h5-para-p2"><a class="truncate" href="'.base_url('application/').$id.'">'.$value->name.'</a></td>
                                                        <td class="h5-para-p2"><a class="truncate" href="'.base_url('application/').$id.'">'.$value->mark.'</a></td>
                                                        <td class="h5-para-p2"><a class="truncate" href="'.base_url('application/').$id.'">'.$value->course.$value->class.'</a></td>
                                                        <td class="h5-para-p2"><a class="truncate" href="'.base_url('application/').$id.'">'.$this->ci->m_application->getamnt($value->application_year,$value->graduation).'</a></td>
                                                        <td class="center-align">
                                                            <a href="'.base_url('application/').$id.'" class="blue-text waves-effect waves-light"> View</a>
                                                        </td></tr>';
                                                    } } ?>                                                    
                                                
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
        
        <!-- footer -->
        <?php $this->load->view('include/footer'); ?>
        
        <!-- End footer -->
    </div>



    <!-- scripts -->
    
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
                buttons: [
                    'excel', 'pdf',
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
                    window.location.href = "<?php echo base_url('application-approved?year=') ?>"+this.year;
                },
            },
        })

    </script>
</body>


</html>