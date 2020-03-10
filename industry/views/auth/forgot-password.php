<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scholarship</title>
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/materialize.min.css">
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/axios.min.js"></script>
    <style>
        .reg-block .fog-block-content .reg-right {
            background: #fff;
            padding: 0;
        }
        
        .reg-block .fog-block-content::after {
            content: '';
            display: block;
            clear: both;
        }
        
        .reg-block .fog-block-content .reg-right .form-block {
            padding: 0 15px 20px 15px;
        }
        
        .reg-block .fog-block-content .reg-right .form-block .card-box .card-heading {
            margin: 0 -15px;
            position: relative;
            overflow: hidden;
            height: 75px;
        }
        
        .reg-block .fog-block-content .reg-right .form-block .card-box .card-heading p {
            text-align: center;
            padding: 15px 0px;
            z-index: 2;
            color: #fff;
            position: relative;
            font-weight: 700;
            font-size: 16px;
        }
        
        .reg-block .fog-block-content .reg-right .form-block .card-box .card-heading::after {
            position: absolute;
            content: '';
            width: 107%;
            background: #00437d;
            height: 67px;
            left: -9px;
            top: -14px;
            z-index: 0;
        }
        
        .reg-block .fog-block-content .reg-right .form-block .card-box .card-body {
            margin-top: 15px !important;
        }
        
        .reg-block .fog-block-content .reg-right .form-block .card-box .card-body .input-field {
            margin: 6px 0;
        }
        
        .reg-block .fog-block-content .reg-right .form-block .card-box .card-body input {
            font-size: 13px;
        }
        
        .reg-block .fog-block-content .reg-right .form-block .card-box .card-body label {
            font-size: 12px;
        }
        
        .for-title {
            width: 70%;
            margin: auto;
        }
        
        #forgotForm {
            padding: 0 30px;
        }
    </style>



</head>

<body>
    <div id="app">
        <?php $this->load->view('include/header') ?>

    <!-- Registration form  -->
    <section class="reg-block row m0" id='app'>
        <div class="container-wrap2">
            <div class="col s12 m12 l10 push-l3 p0">
                <div class="fog-block-content">

                    <div class="col s12 m8  l8 reg-right">
                        <div class="form-block">
                            <div class="card-box">
                                <div class="card-heading">
                                    <p class="m0">Industry Forgot Password</p>
                                </div>
                                <form ref="form" @submit.prevent="checkForm"  action="<?php echo base_url('/forgot-password') ?>" id="forgotForm" method="post">
                                    <div class="for-title">
                                        <p class="center-align">Enter your Email ID, and we'll send you instruction on how to reset your password.</p>
                                    </div>
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    <div class="card-body row m0 pt15 pb15">
                                        <div class="input-field col s12">
                                            <input @change="emailCheck()" v-model="email" name="email" id="email" type="email" class="validate" required>
                                            <label for="email">Email ID</label>
                                            <span class="helper-text red-text">{{ emailError }}</span><br>
                                        </div>
                                        <div class="input-field col s12">
                                            <button class="waves-effect waves-light hoverable btn-theme btn">Submit</button>
                                        </div>
                                        <a href="<?php echo base_url('login') ?>" class="col mt15 mb15">Never mind, I remember my password</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- footer -->

    <!-- footer -->
    <?php $this->load->view('include/footer') ?>

    </div>


    <!-- scripts -->
   <script>
        <?php $this->load->view('include/msg'); ?>
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var instances = M.FormSelect.init(document.querySelectorAll('select'));
        });

        var app = new Vue({
        el: '#app',
        data: {
            email: '',
            emailError:'',

            
        },
     
        methods:{
            //check student email already exist
            emailCheck(){
                this.emailError='';
                const formData = new FormData();
                formData.append('email',this.email);
                formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');
                axios.post('<?php echo base_url('auth/emailcheck') ?>',formData)
                .then(response =>{
                    if (response.data == '') {
                        this.emailError = 'Account does not exist!';
                    } else {
                        this.emailError = '';
                    }

                }).catch(error => {
                    if (error.response) {
                        this.errormsg = error.response.data.error;
                    }
                })
            },
            checkForm() {
                if ((this.emailError == '')) {

                    this.$refs.form.submit();

                } else {}
            },
            
        },
        
    })

    </script>
</body>

</html>