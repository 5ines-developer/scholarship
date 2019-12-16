<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scholarship</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  



</head>
<body>

<?php $this->load->view('include/header'); ?>

    <!-- Registration form  -->
    <section class="reg-success valign-wrapper  row m0" id='app'>
        <div class="container-wrap2">
            <div class="col s12 m12 l10 push-l3 p0">
                    <div class="fog-block-content ">
                    
                    <div class="col s12 m8  l8 reg-right ">
                        <div class="form-block ">
                            <div class="card">
                                <!-- <div class="card-heading">
                                    <p class="m0">Student Forgot Password</p>
                                </div> -->
                                <div class="center pt30 pb30 regsucess">
                                    <a class="btn-floating btn-large green pulse"><i class="material-icons">done</i></a>
                                    <h1 class="h1">Registration completed successfully</h1>
                                    <p>Please check your registered email for email verification</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </section>

    <!-- footer -->
    
    <?php $this->load->view('include/footer'); ?>
              


<!-- scripts -->
<script src="assets/js/vue.js"></script>
<script src="assets/js/materialize.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var instances = M.FormSelect.init(document.querySelectorAll('select'));
    });


</script>
</body>
</html>