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
</head>

<body>
    <div id="app">
        <?php $this->load->view('include/header'); ?>
        <!-- Body form  -->
        <section class="board">
            <div class="container-wrap1">
                <div class="row m0">
                    <div class="col offset-l1 s12 m10 l10">
                        <div class="download">
                            <button class="rec-down waves-effect waves-light">Download</button>
                        </div>
                        <div class="fund-reg">
                            <div class="title-track">
                                <h5>K.A.S Letter(60606)</h5>
                                <h6>Payment Receipt</h6>
                            </div>
                            <div class="date-fund">
                                <p>ISRTC Pvt Ltd <b>Office</b></p>
                                <p><b>Place : </b>Bangalore</p>
                                <p><b>Date : </b>12-12-2019</p>
                            </div>
                            <div class="receipt-detail">
                                <b>_________________________
                                    <span>For this</span>___________________________________________________
                                    <span>Rupees</span>_____________________________________
                                    <span>From them we have received adn each Book</span> ___________________________
                                    <span>No. Page</span>______<span>Baby</span>______________________<span>Day Deposited</span></b>
                            </div>
                            <div class="office-ex">
                                <p>Office Executive</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- End Body form  -->

        <!-- End Body form  -->
        <!-- footer -->
         <?php $this->load->view('include/footer'); ?>
        <!-- End footer -->
    </div>



    <!-- scripts -->
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems, {
                preventScrolling: false
            });
        });

        var app = new Vue({
            el: '#app',
            data: {
                disabled: false

            },

            methods: {


            }
        });
    </script>
</body>

</html>