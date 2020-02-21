<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scholarship</title>
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons " rel="stylesheet ">
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
                            <div class="top-count">
                                <div class="col s12 m3">
                                    <div class="card green hoverable">
                                        <div class="card-content white-text center-align">
                                            <span class="card-title center-align"><i class="material-icons">insert_drive_file</i></span>
                                            <p>
                                                <?php echo (!empty($count['tot_app']))?$count['tot_app']:'0'; ?>
                                            </p>
                                        </div>
                                        <div class="card-action center-align">
                                            <span class="white-text">Total Scholarship</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m3">
                                    <div class="card orange hoverable">
                                        <div class="card-content white-text center-align">
                                            <span class="card-title center-align"><i class="material-icons">insert_drive_file</i></span>
                                            <p>
                                            <?php echo (!empty($count['cr_count']))?$count['cr_count']:'0'; ?>
                                            </p>
                                        </div>
                                        <div class="card-action center-align">
                                            <span class="white-text">Applied in <?php echo date('Y') ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m3">
                                    <div class="card blue darken-1 hoverable">
                                        <div class="card-content white-text center-align">
                                            <span class="card-title center-align"><i class="material-icons">location_city</i></span>
                                            <p>
                                            <?php echo (!empty($count['ac_inds']))?$count['ac_inds']:'0'; ?>
                                            </p>
                                        </div>
                                        <div class="card-action center-align">
                                            <span class="white-text">Active Industries</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m3">
                                    <div class="card green  darken-4 hoverable">
                                        <div class="card-content white-text center-align">
                                            <span class="card-title center-align"><i class="material-icons">school</i></span>
                                            <p>
                                            <?php echo (!empty($count['acti_inst']))?$count['acti_inst']:'0'; ?>
                                            </p>
                                        </div>
                                        <div class="card-action center-align">
                                            <span class="white-text">Active Institutes</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col m9 s12 l9">

                                <div class="card  darken-1">
                                    <div class="card-content ">
                                        <div class="x_panel">

                                            <div class="x_title">

                                                <h2 class="list-title ">Scholarship Application By Year</h2>

                                                <div class="clearfix"></div>

                                            </div>


                                            <div class="x_content das-chart chrt-width">

                                                <canvas id="myChart"></canvas>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col s12 m3 l3">
                                    <div class="card blue-grey    hoverable">
                                        <div class="card-content white-text center-align p20">
                                            <span class="card-title center-align"><i class="material-icons">school</i></span>
                                            <p>
                                            <?php echo $count['pay_comp'] ?>
                                            </p>
                                        </div>
                                        <div class="card-action center-align">
                                            <span class="white-text">Scholarship Payment Completed</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col s12 m3 l3">
                                    <div class="card green  hoverable">
                                        <div class="card-content white-text center-align p20">
                                            <span class="card-title center-align"><i class="material-icons">school</i></span>
                                            <p>
                                            <?php echo $count['pay_pend'] ?>
                                            </p>
                                        </div>
                                        <div class="card-action center-align">
                                            <span class="white-text">Scholarship Payment Pending</span>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="row">

                            <div class="col m4 s12 l4">

                                <div class="bar-line white">
                                    <p class="h5-para-p1 ">Industry Details</p>
                                    <div class="row m0">
                                        <div class="col s12">
                                            <div class="list-height">

                                            <?php 
                                                $industry   ='';
                                                $actInd     = '';
                                                $pending    = '';

                                                if(!empty($indcount['ac_inds'])){
                                                    $actInd = $indcount['ac_inds'];
                                                }
                                            
                                                if(!empty($indcount['tot_ind'])){
                                                    $industry = $indcount['tot_ind'];
                                                    $pending  = $industry - $indcount['ac_inds'];
                                                }                                            
                                            ?>
                                              <div class="progress-bar-set">
                                                    <div class="title-bar">
                                                        <span>Active</span>
                                                    </div>
                                                    <div class="progress progress-app ">
                                                        <span class="determinate deter1" style="width: <?php echo  $actInd; ?>%"></span>
                                                    </div>
                                                    <div class="">
                                                        <span><?php echo  $actInd; ?></span>
                                                    </div>
                                                </div>



                                                <div class="progress-bar-set">
                                                    <div class="title-bar">
                                                        <span>Pending</span>
                                                    </div>
                                                    <div class="progress progress-app ">
                                                        <span class="determinate deter2" style="width: <?php echo  $pending; ?>%"></span>
                                                    </div>
                                                    <div class="">
                                                        <span><?php echo  $pending; ?></span>
                                                    </div>
                                                </div>

                                                <div class="progress-bar-set">
                                                    <div class="title-bar">
                                                        <span>Total</span>
                                                    </div>
                                                    <div class="progress progress-app ">
                                                        
                                                        <span class="determinate deter3" style="width: <?php echo  $industry; ?>%"></span>
                                                    </div>
                                                    <div class="">
                                                        <span><?php echo $industry; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                               
                            </div>

                            <div class="col m4 s12 l4">
                             <div class="bar-line white">
                                    <p class="h5-para-p1 ">Institute Details </p>
                                    <div class="row m0">
                                        <div class="col s12">

                                        <?php 
                                                $institute   ='';
                                                $actInst     = '';
                                                $pendingi    = '';

                                                if(!empty($inscount['acti_inst'])){
                                                    $actInst = $inscount['acti_inst'];
                                                }
                                            
                                                if(!empty($inscount['tot_insti'])){
                                                    $institute = $inscount['tot_insti'];
                                                    $pendingi  = $institute - $inscount['acti_inst'];
                                                }                                            
                                            ?>


                                            <div class="list-height">
                                                <div class="progress-bar-set">
                                                    <div class="title-bar">
                                                        <span>Active</span>
                                                    </div>
                                                    <div class="progress progress-app ">
                                                        <span class="determinate deter1" style="width:<?php echo $actInst; ?>%"></span>
                                                    </div>
                                                    <div class="">
                                                        <span><?php echo $actInst; ?></span>
                                                    </div>
                                                </div>

                                                <div class="progress-bar-set">
                                                    <div class="title-bar">
                                                        <span>Pending</span>
                                                    </div>
                                                    <div class="progress progress-app ">
                                                        <span class="determinate deter2" style="width: <?php echo $pendingi; ?>%"></span>
                                                    </div>
                                                    <div class="">
                                                        <span><?php echo $pendingi; ?></span>
                                                    </div>
                                                </div>

                                                <div class="progress-bar-set">
                                                    <div class="title-bar">
                                                        <span>Total</span>
                                                    </div>
                                                    <div class="progress progress-app ">
                                                        <span class="determinate deter3" style="width: <?php echo $institute; ?>%"></span>
                                                    </div>
                                                    <div class="">
                                                        <span><?php echo $institute; ?></span>
                                                    </div>
                                                </div>
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
            var instances = M.Sidenav.init(document.querySelectorAll('.sidenav'));
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
    </script>

    <script>
        $(document).ready(function() {

            var lab = [];
            var con = [];
            var canCon = [];

            $.ajax({
                url: '<?php echo base_url("dashboard/getordergraph") ?>',
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
                                label: 'Application',
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

    <!-- <script>
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        datasets: [{
            label: 'line Dataset',
            data: [10, 20, 30, 40]
        }, 
        // {
        //     label: 'Line Dataset',
        //     data: [50, 20, 30, 10],

        //     // Changes this dataset to become a line
        //     type: 'line'
        // }
    
    ],
        labels: ['January', 'February', 'March', 'April']
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
</script> -->
</body>

</html>