<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scholarship</title>
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/materialize.min.css">
    <link  rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/material-icons.css">
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/jquery-3.4.1.min.js"></script>
<script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
<script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
<script src="<?php echo $this->config->item('web_url') ?>assets/js/script.js"></script>
</head>
<body>
    <div id="app">
        <?php $this->load->view('include/header'); ?>
        <!-- Registration form  -->
        <section class="reg-block row m0 inst-rg-block">
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
                                        <form ref="form" @submit.prevent="checkForm" action="<?php echo base_url('auth/index') ?>" method="post">
                                            <div class="input-field col s12">
                                                <input  id="email" name="email" type="email" class="validate" required>
                                                <label for="email">Email ID</label>
                                            </div>

                                        
                                            <div class="input-field col s12">
                                                <input  id="password" name="pswd"  type="password" class="validate" required>
                                                <label for="password">Password</label>
                                            </div>

                                            <div class="input-field col s12">
                                            <p id="captImg"><?php echo $captchaImg; ?></p>
                                            <p>Can't read the image? click <a href="javascript:void(0);" class="refreshCaptcha">here</a> to refresh.</p>
                                    </div>

                                    <div class="input-field col s12">
                                        <input id="cap" type="text" name="captcha" value="" v-model="captcha"/>
                                        <label for="cap">Enter the text from above image</label>
                                        <span class="red-text">{{captchaError}}</span>
                                    </div>

        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                        


                                            <a href="<?php echo base_url() ?>forgot-password" class="col mt15 mb15">Forgot Password?</a>
                                            <div class="input-field col s12">
                                                <button class="waves-effect waves-light hoverable btn-theme btn">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col s12 pull-m6 pull-l6 m6 l6 reg-left height352 valign-wrapper hide-on-small-only">
                            <div class="reg-left-box ">
                                <div class="contents">
                                    <center>
                                        <div class="logn-img">
                                            <img class="responsive-img" src="<?php echo $this->config->item('web_url') ?>assets/image/logo.png" alt="">
                                        </div>
                                    </center>
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
              
<script>
$(document).ready(function(){
    $('.refreshCaptcha').on('click', function(){
        $.get('<?php echo base_url().'auth/refresh'; ?>', function(data){
            $('#captImg').html(data);
        });
    });
});
</script>

<!-- scripts -->

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
           captcha:'',
            captchaError:'',

            
        },

        methods:{
            checkForm() {

                    this.captchaError ="";
                        if (this.captcha == '') {
                            this.captchaError = 'Captcha is required';
                        } else {
                            this.$refs.form.submit();
                        }
                }
           

            
        }
    })
</script>
</body>
</html>