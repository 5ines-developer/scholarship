<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scholarship</title>
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" rel="stylesheet">

</head>

<body>
    <div id="app">
        <?php $this->load->view('include/header'); ?>

        <!-- Body form  -->
        <section class="board pr0">
            <div class="container-wrap1">
                <div class="row m0">
                        <div class="col s12 m3 l3 hide-on-med-and-down ">
                        <?php $this->load->view('include/menu'); ?>
                        </div>
                    <!-- End menu-->

                    <div class="col l9 s12 m12">

                        <div class="row">
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

                        <div class="row">
                            <div class="top-count">
                                <div class="col s12 m3">
                                    <div class="card green hoverable">
                                        <div class="card-content white-text center-align">
                                            <span class="card-title center-align"><span class="material-icons">thumb_up_alt</span></span>
                                            <p>
                                                <?php echo (!empty($completed))?$completed:'0'; ?>
                                            </p>
                                        </div>
                                        <div class="card-action center-align">
                                            <span class="white-text">Contribution Completed industry in <?php echo $years; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m3">
                                    <div class="card orange hoverable">
                                        <div class="card-content white-text center-align">
                                            <span class="card-title center-align"><span class="material-icons">thumb_down_alt</span>
                                            <p> <?php echo (!empty($pending))?$pending:'0'; ?> </p>
                                        </div>
                                        <div class="card-action center-align">
                                            <span class="white-text">Contribution Pending industry in <?php echo $years; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m3">
                                    <div class="card blue darken-1 hoverable">
                                        <div class="card-content white-text center-align">
                                            <span class="card-title center-align"><span class="cust-icon">&#8377; </span></span>
                                            <p> <?php echo (!empty($amount))?$amount:'0'; ?> </p>
                                        </div>
                                        <div class="card-action center-align">
                                            <span class="white-text">Amount Recieved in <?php echo $years; ?> </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m3">
                                    <div class="card green  darken-4 hoverable">
                                        <div class="card-content white-text center-align">
                                            <span class="card-title center-align"><span class="cust-icon">&#8377; </span></span>
                                            <p> <?php echo (!empty($total))?$total:'0'; ?> </p>
                                        </div>
                                        <div class="card-action center-align">
                                            <span class="white-text">Total Amount Recieved Till now</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col m12 s12 l12">

                                <div class="card  darken-1">
                                    <div class="card-content ">
                                        <div class="x_panel">

                                            <div class="x_title">

                                                <h2 class="list-title ">Contribution By Year</h2>

                                                <div class="clearfix"></div>

                                            </div>


                                            <div class="x_content das-chart chrt-width2">

                                                <canvas id="myChart"></canvas>

                                            </div>

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


        <!-- End Body form  -->
        <section>

        </section>

        <!-- footer -->

        <?php $this->load->view('include/footer'); ?>
        <!-- End footer -->
    </div>



    <!-- scripts -->
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/jquery-3.4.1.min.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/script.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js">
    </script>


    <?php $this->load->view('include/msg') ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var instances = M.FormSelect.init(document.querySelectorAll('select'));
        });
        document.addEventListener('DOMContentLoaded', function() {
            var side = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(side);
            var gropDown = M.Dropdown.init(document.querySelectorAll('.dropdown-trigger'), {
                constrainWidth: false,
                alignment: 'right'
            })
        });


        var app = new Vue({
            el: '#app',
            data: {},
            methods: {}
        })

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
        });
    </script>

    <script>
        $(document).ready(function() {

            var lab = [];
            var con = [];
            var canCon = [];

            $.ajax({
                url: '<?php echo base_url("reports/getordergraph") ?>',
                method: 'GET',
                async: true,
                dataType: 'json',
                success: function(dat) {
                    for (let i = 0; i < dat.length; i++) {
                        lab.push(dat[i].year);
                        con.push(dat[i].values);
                    }


                    // Line charts
                    var ctx = document.getElementById('myChart');
                    var myChart = new Chart(ctx, {

                        type: 'line',
                        data: {
                            labels: lab,
                            datasets: [{
                                label: 'Contribution',
                                fill: true,
                                lineTension: 0.0,
                                backgroundColor: 'rgba(75, 192, 192, 1)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderCapStyle: 'butt',
                                borderDash: [],
                                borderDashOffset: 0.0,
                                borderJoinStyle: 'miter',
                                pointBorderColor: '#000',
                                pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                                pointBorderWidth: 3,
                                pointHoverRadius: 5,
                                pointHoverBackgroundColor: 'rgba(75, 192, 192, 1)',
                                pointHoverBorderColor: 'rgba(220, 220, 220, 1)',
                                pointHoverBorderWidth: 5,
                                pointRadius: 1,
                                pointHitRadius: 10,
                                data: con,
                                spanGaps: false,
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                }
            });


        });
    </script>

   
</body>

</html>