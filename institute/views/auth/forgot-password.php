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

    <?php $this->load->view('include/header'); ?>
    <!-- Registration form  -->
    <section class="reg-block row m0" id="app">
        <div class="container-wrap2">
            <div class="col s12 m12 l10 push-l3 p0">
                    <div class="fog-block-content">
                    
                    <div class="col s12 m8  l8 reg-right">
                        <div class="form-block frgotPass">
                            <div class="card-box">
                                <div class="card-heading">
                                    <p class="m0">Student Forgot Password</p>
                                </div>
                                <form id="forgotForm" action="<?php echo base_url() ?>forgot-password-check" method="post" class="pt20">
                                    <div class="card-body row m0 pt15 pb15">
                                        <div class="for-title">
                                            <h6 class="center-align">Enter your register Email ID, and we'll send you instruction on how to reset your password.</h6>
                                        </div>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                    <div class="input-field col s12">
                                        <input  id="email" type="email" v-model="email" name="email" class="validate" required @change="checkMail">
                                        <label for="email">Enter Register email ID</label>
                                        <div class="red-text">{{crpError}}</div>
                                    </div>
                                    <div class="input-field col s12">
                                        <button class="waves-effect waves-light hoverable btn-theme btn">Submit</button>
                                    </div>
                                    <a href="<?php echo base_url() ?>" class="col mt15 mb15">Never mind, I remember my password</a>
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
    <?php $this->load->view('include/footer'); ?>


<!-- scripts -->
<script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
<script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
<script src="<?php echo $this->config->item('web_url') ?>assets/js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
<?php $this->load->view('include/msg'); ?>
<script>
  var app = new Vue({
    el: '#app',
    data: {
        email: '',
        crpError: '',
    },
    methods:{
        checkMail(){
            const formData = new FormData();
            formData.append('mail', this.email);
        formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');
            
            axios.post('<?php echo base_url() ?>checkEmail', formData)
            .then(response => {
                if(response.data == ''){
                    this.crpError = 'You have entered invalid  Email id';
                }else{
                    this.crpError ='';
                }
            }).catch(error => {
                if (error.response) {
                    this.errormsg = error.response.data.error;
                }
            })
        }
    }
  });
</script>

</body>
</html>