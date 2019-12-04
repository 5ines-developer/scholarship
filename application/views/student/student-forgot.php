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
                    

                <div class="fog-block-content" v-bind:class="{'hide-card': forgotpassword}">
                    
                    <div class="col s12 m8  l8 reg-right">
                        <div class="form-block">
                            <div class="card-box">
                                <div class="card-heading">
                                    <p class="m0">Student Forgot Password</p>
                                </div>
                                <form action="<?php echo base_url('student/forgot-validate') ?>" method="post" enctype="multipart/form-data" id="forgotForm">
                                    <div class="for-title">
                                        <p class="center-align">Answer the below security question to reset your password.</p>
                                    </div>
                                <div class="card-body row m0 pt15 pb15">
                                    <div class="input-field col s12">
                                        <select id="qstn" name="qstn" required>
                                        <option value="">Select the question</option>
                                        <?php if (!empty($question)) {
                                            foreach ($question as $key => $value) {
                                                echo '<option value="'.$value->id.'">'.$value->question.'</option>';
                                            }
                                        } ?>
                                        
                                        </select>
                                        <label for="qstn">Question</label>
                                    </div>
                                    <div class="input-field col s12">
                                            <input  id="ans"  name="ans" type="text" class="validate" required>
                                            <label for="ans">Answer</label>
                                        </div>
                                    <div class="input-field col s12">
                                        <button class="waves-effect waves-light hoverable btn-theme btn flft">Submit</button>
                                        <div class="forg-cgange">
                                            <p class="pl10 flft">OR</p>
                                            <a  @click="forgotpassword = !forgotpassword" class="flft col mt15 mb15 fclk">Reset with Email</a>
                                        </div>
                                    </div>
                                    <a href="<?php echo base_url('student/login') ?>" class="col mt15 mb15">Nevermind, I remember my password</a>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- card end -->



                <div class="fog-block-content" v-bind:class="{'hide-card': !forgotpassword}">
                    
                        <div class="col s12 m8  l8 reg-right">
                            <div class="form-block">
                                <div class="card-box">
                                    <div class="card-heading">
                                        <p class="m0">Student Forgot Password</p>
                                    </div>
                                    <form ref="form" @submit.prevent="checkForm" action="<?php echo base_url('student/forgot-password') ?>" method="post" enctype="multipart/form-data" id="forgotForm">
                                        <div class="for-title">
                                            <p class="center-align">Enter your Email ID, and we'll send you instruction on how to reset your password.</p>
                                        </div>
                                    <div class="card-body row m0 pt15 pb15">
                                        <div class="input-field col s12">
                                            <input  id="email" @change="emailCheck()" name="email" v-model="email" type="email" class="validate" required>
                                            <label for="email">Email ID</label>
                                            <span class="helper-text red-text">{{ emailError }}</span>
                                        </div>
                                        <div class="input-field col s12">
                                            <button class="waves-effect waves-light hoverable btn-theme btn flft">Submit</button>
                                            <div class="forg-cgange">
                                                <p class="flft pl10">OR</p>
                                                <a  @click="forgotpassword = !forgotpassword" class="col mt15 mb15 fclk ">Reset with Security Question</a>
                                            </div>
                                        </div>
                                        <a href="<?php echo base_url('student/login') ?>" class="col mt15 mb15">Nevermind, I remember my password</a>
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
            email: '',
            psw: '',
            forgotpassword: false,
            qsid:'',
            emailError:'',

            
        },
     
        methods:{
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