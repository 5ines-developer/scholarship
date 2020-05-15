<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scholarship</title>
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/materialize.min.css">
    <link href="<?php echo $this->config->item('web_url') ?>assets/css/select2.css" rel="stylesheet" />
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/axios.min.js"></script>
</head>

<body>
    <div id="app">
<?php $this->load->view('include/header'); ?>

    <!-- form section -->
    <section class="bg pt30 pb30 reg-block">
        <div class="container">
            <div class="row m0">
                <div class="col l10 offset-l1">
                    <div class="card instreg">
                        <div class="card-content">
                            <div class="card-outer-heading">
                            Industry Add Request
                            </div>
                            <div class="card-body">
                                <form ref="form" @submit.prevent="checkForm"  action="<?php echo base_url('company-request') ?>" method="post" enctype="multipart/form-data">
                                    <div class="input-field col m6">
                                        <input id="email" name="email" type="email" class="validate" required="" v-model="email"  @change="emailCheck()">
                                        <label for="email">Email</label>
                                        <span class="helper-text red-text">{{ emailError }}</span>
                                    </div>

                                    <div class="input-field col m6">
                                        <input id="phone" name="phone" type="text" class="validate" required="" v-model="mobile"  @change="mobileCheck()">
                                        <label for="phone">Mobile No</label>
                                        <span class="helper-text red-text">{{mobileError}}</span>
                                    </div>

        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                    
                                    <div class="input-field col s12 m6">
                                        <select id="taluk" name="taluk" required="" class="select2">
                                            <option value="" disabled selected>Choose your option</option>
                                            <?php if (!empty($taluk)) {
                                                foreach ($taluk as $key => $value) {
                                                    echo '<option value="'.$value->id.'">'.$value->title.'</option>';
                                            } } ?>
                                        </select>
                                        <label for="taluk">Taluk</label>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <select id="district" name="district" required="" class="select2">
                                            <option value="" disabled selected>Choose your option</option>
                                            <?php if (!empty($district)) {
                                                foreach ($district as $key => $value) {
                                                    echo '<option value="'.$value->id.'">'.$value->title.'</option>';
                                            } } ?>
                                        </select>
                                        <label for="district">District</label>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <select id="act" name="act" required="" class="select2" v-model="act">
                                            <option value="" disabled selected>Choose Act Type</option>
                                            <option value="1">Shops and Commercial Act</option>
                                            <option value="2">Factory ACt</option>
                                            <option value="3">Others</option>                                          
                                        </select>
                                        <label for="act">Industry Type</label>
                                    </div>
                                    <div class="row m0">                                    
                                        <div class="input-field col m6">
                                        <input id="company" type="text" name="company" class="c_conreg validate" required="">
                                        <label for="company">Industry Name</label>
                                        </div>
                                    </div>
                                    <div class="row m0">  
                                        <div class="input-field col m6">
                                            <input id="c_conreg" type="text" class="c_conreg validate" required="">
                                            <label class="crg" for="c_conreg">Industry Reg No</label>
                                        </div>
                                        <div class="file-field input-field col s12 m6">
                                        <div class="btn ">
                                            <span>File</span>
                                            <input type="file" name="reg_doc" required="">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" placeholder="Upload Industry Reg Doc" type="text">
                                        </div>
                                    </div> 
                                    </div>                                    
                                                                                                           
                                    <div class="input-field col s12 m12">
                                        <textarea id="address" name="address" class="materialize-textarea"></textarea>
                                        <label for="address">Address</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <div class="g-recaptcha" data-sitekey="6Le6xNYUAAAAADAt0rhHLL9xenJyAFeYn5dFb2Xe"></div> 
                                        <span class="helper-text red-text">{{ captcha }}</span>
                                    </div>
                                    
                                    <div class="input-field col m12 ">
                                        <button class="waves-effect waves-light hoverable btn-theme btn">Submit</button>
                                        <span class="com-reg">If You Have an Account ?<a href="<?php echo base_url('login') ?>">Login</a></span>
                                    </div>
                                    <div class="clearfix"></div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php $this->load->view('include/footer') ?>
    <div v-if="loader" class="loading">Loading&#8230;</div>

</div>



    <!-- scripts -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
    <?php $this->load->view('include/msg'); ?>
</script>
    <script>


        document.addEventListener('DOMContentLoaded', function() {
            var instances = M.FormSelect.init(document.querySelectorAll('.select2'));
        });


        var app = new Vue({
            el: '#app',
            data: {
                mobile: '',
                email: '',
                emailError: '',
                mobileError: '',
                captcha:'',
                active:false,
                istrue:false,
                act:'',
                loader:false,

            },

            methods: {

                            //check student email already exist
            emailCheck(){
                this.emailError='';
                const formData = new FormData();
                formData.append('email',this.email);
                formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');
                axios.post('<?php echo base_url('auth/emailcheck') ?>',formData)
                .then(response =>{
                    if (response.data == '1') {
                        this.emailError = 'This Email id already exist!';
                    } else {
                        this.emailError = '';
                    }

                }).catch(error => {
                    if (error.response) {
                        this.errormsg = error.response.data.error;
                    }
                })
            },
             //check student mobile already exist
             mobileCheck(){

                this.mobileError='';
                const formData = new FormData();
                formData.append('mobile',this.mobile);
                formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');
                axios.post('<?php echo base_url('auth/mobile_check') ?>', formData)
                .then(response => {
                    if (response.data == '1') {
                        this.mobileError = 'This Mobile number already exist!';
                    } else {
                        this.mobileError = '';
                    }

                }).catch(error =>{
                    if (error.response) {
                        this.errormsg = error.response.data.error;
                    }
                } )
            },
            checkForm() {
                if ((this.mobileError == '') && (this.emailError == '')) {


                    // if (grecaptcha.getResponse() == '') {
                    //     this.captcha = 'Captcha is required';
                    // } else {
                        this.$refs.form.submit();
                    // }
                } else {}
            }


            }
        })
    </script>
</body>

</html>