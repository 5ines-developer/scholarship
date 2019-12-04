<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scholarship</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/materialize.min.css">
    <style>
    .reg-block .fog-block-content .reg-right {background: #fff; padding: 0; }
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
    color: 
    #fff;
    position: relative;
    font-weight: 700;
    font-size: 16px;
}
.reg-block .fog-block-content .reg-right .form-block .card-box .card-heading::after {
    position: absolute;
    content: '';
    width: 107%;
    background: 
    #00437d;
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

     <?php $this->load->view('includes/header'); ?>

    <!-- Registration form  -->
    <section class="reg-block row m0" id='app'>
        <div class="container-wrap2">
            <div class="col s12 m12 l10 push-l3 p0">
                    <div class="fog-block-content">
                    
                    <div class="col s12 m8  l8 reg-right">
                        <div class="form-block">
                            <div class="card-box">
                                <div class="card-heading">
                                    <p class="m0">Student Forgot Password</p>
                                </div>
                                <form ref="form" @submit.prevent="checkForm" action="<?php echo base_url('student/reset-pass') ?>" method="post" enctype="multipart/form-data" id="forgotForm">
                                <div class="card-body row m0 pt15 pb15">
                                    <div class="input-field col s12">
                                            <input  id="email" @change="emailCheck()" name="email" v-model="email" type="email" class="validate" required>
                                            <label for="email">Email ID</label>
                                            <span class="helper-text red-text">{{ emailError }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <input  id="password" v-model="psw" name="password" type="password" class="validate" required>
                                        <label for="password">Password</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <input  id="cpassword" v-on:keyup="checkCpsw" name="cnpassword" v-model="cpsw" type="password" class="validate" required>
                                        <label for="cpassword">Confirm Password</label>
                                        <span class="helper-text red-text">{{confError}}</span>
                                    </div>

                                    <input type="hidden" name="qstn" value="<?php echo (!empty($qstn))?$qstn:''; ?>">
                                    <input type="hidden" name="ans" value="<?php echo (!empty($ans))?$ans:''; ?>">

                                    <div class="input-field col s12">
                                        <button class="waves-effect waves-light hoverable btn-theme btn">Submit</button>
                                    </div>
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
    
  <?php $this->load->view('includes/footer'); ?>
              


<!-- scripts -->
<script src="<?php echo base_url() ?>assets/js/vue.js"></script>
<script src="<?php echo base_url() ?>assets/js/materialize.min.js"></script>
<script src="<?php echo base_url()?>assets/js/axios.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
    <?php $this->load->view('includes/message'); ?>
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var instances = M.FormSelect.init(document.querySelectorAll('select'));
    });


    var app = new Vue({
        el: '#app',
        data: {
            psw: '',
            cpsw:'',
            confError: '',
            emailError:'',
            email:'',            
        },

        methods:{

            checkCpsw() {
                if (this.psw != this.cpsw) {
                    this.confError = 'Password must match with previous entry!';

                } else {
                    this.confError = '';
                }
            },
            //check student email already exist
            emailCheck(){
                this.emailError='';
                const formData = new FormData();
                formData.append('email',this.email);
                axios.post('<?php echo base_url('student/emailcheck') ?>',formData)
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

            //check student email already exist
            checkForm() {
                if ((this.confError == '') && (this.emailError =='')) {
                    this.$refs.form.submit();
                } else {}
            }
        },
    })
</script>
</body>
</html>