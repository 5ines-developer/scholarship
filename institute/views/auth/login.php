<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scholarship</title>
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/materialize.min.css">
</head>
<body>
    <div id="app">
        <?php $this->load->view('include/header'); ?>
        <!-- Registration form  -->
        <section class="reg-block row m0">
            <div class="container-wrap2">
                <div class="col s12 m12 l10 push-l1 p0">
                        <div class="reg-block-content">
                        
                        <div class="col s12 m6 push-m6 push-l6 l6 reg-right">
                            <div class="form-block">
                                <div class="card-box">
                                    <div class="card-heading">
                                        <p class="m0">Institute Login</p>
                                    </div>
                                    <div class="card-body row m0 pt15 pb15">
                                        <form action="<?php echo base_url() ?>" method="post">
                                            <div class="input-field col s12">
                                                <input  id="email" name="email" type="email" class="validate" required>
                                                <label for="email">Email ID</label>
                                            </div>

                                        
                                            <div class="input-field col s12">
                                                <input  id="password" name="pswd"  type="password" class="validate" required>
                                                <label for="password">Password</label>
                                            </div>

                                            <a href="<?php echo base_url() ?>forgot-password" class="col mt15 mb15">Forgot Password?</a>
                                            <div class="input-field col s12">
                                                <button class="waves-effect waves-light hoverable btn-theme btn">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col s12 pull-m6 pull-l6 m6 l6 reg-left height352 valign-wrapper">
                            <div class="reg-left-box ">
                                <div class="contents">
                                    <p>Welcome To</p>
                                    <p>Karnataka Labour Welfare Board</p>
                                    <p><a href="<?php echo base_url() ?>register">If You Don't Have an Account  Register now</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
        <!-- footer -->
        <?php $this->load->view('include/footer'); ?>
    </div>
              


<!-- scripts -->
<script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
<script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
<script src="<?php echo $this->config->item('web_url') ?>assets/js/script.js"></script>
<?php $this->load->view('include/msg'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var instances = M.FormSelect.init(document.querySelectorAll('select'));
    });


    var app = new Vue({
        el: '#app',
        data: {
            industry: '',
            mobile: '',
            email: '',
            psw: '',
            cpsw: '',
            emailError: '',
            mobileError: '',

            
        },

        methods:{
            
           

            
        }
    })
</script>
</body>
</html>