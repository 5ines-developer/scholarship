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
                            <div class="card  darken-1">
                                <div class="card-content bord-right">
                                    <div class="title-list">
                                        <span class="list-title">Application Date Add</span>
                                        <a href="<?php echo base_url('application-date') ?>" class="back-btn z-depth-1 waves-effect waves-ligh right">Back</a>
                                    </div>
                                    <div class="board-content">
                                        <div class="row m0">
                                            <div class="col s12 m12 l12">
                                                <form id="appliform" action="<?php echo base_url() ?>application-date/update" method="post">
                                                    <div class="input-field col s12 m8 l5 ad-selt2">
                                                        <input id="start_date" name="start_date" required type="text"  class="datepicker" value="<?php echo (!empty($result->fromdate))?$result->fromdate:''; ?>">
                                                        <label for="start_date">Start Date</label>
                                                        <p class="serror"></p>
                                                    </div>
                                                    <div class="input-field col s12 m8 l5 ad-selt2">
                                                        <input id="end_date" name="end_date" required type="text" class="datepicker" value="<?php echo (!empty($result->todate))?$result->todate:''; ?>">
                                                        <label for="end_date">End Date</label>
                                                        <p class="enerror"></p>
                                                    </div>
                                                    <input type="hidden" name="id" value="<?php echo (!empty($result->id))?$result->id:''; ?>">
                                                    <input type="hidden" name="ser">
                                                    <input type="hidden" name="ener">
                                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                    <div class="input-field col s12">
                                                        <button class="waves-effect waves-light hoverable btn-theme btn mr10">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
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

        $(document).on('change', 'input[name=start_date]', function() {
            event.preventDefault();
            var syear = $(this).val();
            var id = $('input[name=id]').val();
            $('.serror > span').remove();
            $('input[name=ser]').val('');
            $.ajax({
                url: '<?php echo base_url('appli_date/checkyear') ?>',
                type: 'get',
                dataType: 'html',
                data: {syear: syear,id:id},
                success:function(response){
                    if (response !='') {
                        $('.serror').append('<span class="red-text error">The application Start date   for the year has been already added.</span>');
                        $('input[name=ser]').val(response);
                    }else{
                        $('input[name=ser]').val('');
                        $('.enerror > span').remove();
                    }
                }
            })
        });

         $(document).on('change', 'input[name=end_date]', function() {
            event.preventDefault();
            var eyear = $(this).val();
            var id = $('input[name=id]').val();
            $('.enerror > span').remove();
            $('input[name=ener]').val('');
            $.ajax({
                url: '<?php echo base_url('appli_date/checkendyear') ?>',
                type: 'get',
                dataType: 'html',
                data: {eyear: eyear,id:id},
                success:function(response){

                    if (response !='') {
                        $('input[name=ener]').val(response);
                        $('.enerror').append('<span class="red-text error">The application End date for the year has been already added.</span>');

                    }else{
                        $('input[name=ener]').val('');
                        $('.enerror > span').remove();
                    }


                }
            })
        });

         $(document).on('submit', '#appliform', function() {
            var ser = $('input[name=ser]').val();
            var ener = $('input[name=ener]').val();
            var syear = $('input[name=start_date]').val();
            var eyear = $('input[name=end_date]').val();
            if (syear > eyear) {
                event.preventDefault();
                 M.toast({html: 'The operation could not possible<br> End date must be greater that start date', classes: 'red', displayLength : 5000 });
            }else if (ser !='' || ener !='') {
                event.preventDefault();
                M.toast({html: 'The operation could not possible<br> please select differnt years of dates', classes: 'red', displayLength : 5000 });
             }else{
                $('#appliform').submit();
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