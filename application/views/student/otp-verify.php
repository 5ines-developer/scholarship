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
.helper-text.red-text.rel{ position: relative !important; }

    

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
                                    <p class="m0">OTP VERIFICATION CODE</p>
                                </div>
                                <form ref="form" @submit.prevent="checkForm" action="#" method="post" enctype="multipart/form-data" id="forgotForm">
                                    <div class="for-title">
                                        <p class="center-align">Use your device to Sign in to your Account</p>
                                        <center>
                                            <img src="<?php echo base_url('assets/image/otp.png'); ?>" alt="" class="otp-img">
                                        </center>
                                        <p class="bold center-align">Enter Your Verification Code</p>
                                        <p class="center-align">A text message with verification code was sent to (<?php echo $phone; ?>)</p>
                                        <input type="hidden" name="refid" v-model="refid">
                                        <input type="hidden"  name="phone" v-model="phone">
                                    </div>
                                <div class="card-body row m0 pb15">
                                    <div class="input-field col s12">
                                            <input  id="otp"  name="otp" type="text" v-model="otp" class="validate" required maxlength="6" minlength="6">
                                            <label for="otp">Enter 6 digit code</label>
                                        </div>
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    <div class="input-field col s12">
                                        <button class="waves-effect waves-light hoverable btn-theme btn flft">Submit</button>
                                        <a href="#" @click="resend" class="col mt15 mb15">Resend OTP</a> 
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- card end -->




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
            phone:'<?php echo $phone; ?>',
            refid:'<?php echo $ref_id; ?>',
            otp:'',
            
        },
     
        methods:{
            //check student email already exist
            checkForm(){
                const formData = new FormData();
                formData.append('phone', this.phone);
                formData.append('refid', this.refid);
                formData.append('otp', this.otp);
                formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');
                axios.post('<?php echo base_url() ?>student/otp-verify', formData)
                .then(response => {
                    if(response.data == ''){
                         M.toast({html: 'Please enter a valid OTP.', classes: 'red darken-2'});
                    }else{
                       M.toast({html: 'Account verification is successfull<br> you can login now.', classes: 'green darken-2'});
                       window.location = '<?php echo base_url('student/login') ?>';
                    }
                }).catch(error => {
                    if (error.response) {
                        this.errormsg = error.response.data.error;
                    }
                })
            },
            resend(){
                const formData = new FormData();
                formData.append('phone', this.phone);
                formData.append('refid', this.refid);
                formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');
                axios.post('<?php echo base_url() ?>student/resendOtp', formData)
                .then(response => {
                    if(response.data == '1'){
                        M.toast({html: 'OTP has been resent to '+ this.phone +'', classes: 'green darken-2'});
                    }else{
                        M.toast({html: 'Something went wrong<br>Please try again.', classes: 'red darken-2'});
                    }
                }).catch(error => {
                    if (error.response) {
                        this.errormsg = error.response.data.error;
                    }
                })
            }
        },
        
    })
</script>
</body>
</html>