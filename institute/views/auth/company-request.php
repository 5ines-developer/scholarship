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
        <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/vue-select.css">
    </head>
    <body>
        <div id="app">
            <?php $this->load->view('include/header'); ?>
            <!-- form section -->
            <section class="bg pt30 pb30 inst-rg-block">
                <div class="container">
                    <div class="row m0">
                        <div class="col l10 offset-l1">
                            <div class="card instreg">
                                <div class="card-content">
                                    <div class="card-outer-heading">
                                        Institute Requested Detail
                                    </div>
                                    <div class="card-body">
                                        <form ref="form" @submit.prevent="checkForm" action="<?php echo base_url() ?>institute-request" method="post" enctype="multipart/form-data">
                                            <div class="input-field col m6 s12">
                                                <input id="email" v-model="email" @change="checkEmailExist" name="email" type="email" required class="validate">
                                                <label for="email">Email</label>
                                                <span class="red-text helper-text">{{emailError}}</span>
                                            </div>
                                            
                                            <div class="input-field col m6 s12">
                                                <input id="number" v-model="phone" @change="checkPhoneExist" name="number" type="number" required class="validate">
                                                <label for="number">Phone Number</label>
                                                <span class="red-text helper-text">{{phoneError}}</span>
                                            </div>
                                            <div class="row m0">
                                                <div class="input-field col m6 s12 ">
                                                    <div>
                                                        <input type="hidden" name="district" :value="district.id">
                                                        <v-select  v-model="district"  as="title::id" placeholder="Select District" @input="talukFilter"  tagging :from="districtSelect" />
                                                    </div>
                                                    <br><span class="helper-text red-text">{{ intdstError }}</span>
                                                </div>
                                                <div class="input-field col m6 s12 ">
                                                    <div>
                                                        <input type="hidden" name="taluk" :value="tlq.id">
                                                        <v-select v-model="tlq"  as="title::id" :disabled='disabled' placeholder="Select Taluk"   tagging :from="taluk" />
                                                    </div>
                                                    <br><span class="helper-text red-text">{{ intalError }}</span>
                                                </div>
                                            </div>
                                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                            
                                            
                                            <div class="input-field col m6 s12">
                                                    <input required id="name" name="name" pattern="[a-zA-Z0-9-]+"  v-model="institute" @change="checkInstituteExist" type="text" class="validate">
                                                    <label for="name">Institute Name</label>
                                                <span class="red-text helper-text"> {{instituteError}}</span>
                                            </div>
                                            
                                            <div class="input-field col m6 s12">
                                                <input required id="pincode" name="c_pincode"  pattern="[0-9-]+" type="text" class="validate">
                                                <label for="pincode">Pin Code</label>
                                            </div>
                                            <div class="file-field input-field col  m6 s12 ">
                                                <div class="btn ">
                                                    <span>File</span>
                                                    <input type="file" required name="reg_doc" accept=".png, .jpg, .jpeg, .svg, .gif">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" placeholder="Upload Institute Reg Doc" type="text">
                                                </div>
                                            </div>
                                            <div class="input-field col s12 m12">
                                                <textarea id="textarea1" name="c_address" required class="materialize-textarea" pattern="[a-zA-Z0-9-]+"></textarea>
                                                <label for="textarea1">Address</label>
                                            </div>
                                            <div class="input-field col s12">
                                                <div class="g-recaptcha" required data-sitekey="6Le6xNYUAAAAADAt0rhHLL9xenJyAFeYn5dFb2Xe"></div>
                                                <span class="helper-text red-text">{{ captcha }}</span>
                                            </div>
                                            <div class="input-field col m12 ">
                                                <button type="submit" class="waves-effect waves-light hoverable btn-theme btn">Submit</button>
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
            <?php $this->load->view('include/footer'); ?>
            
        </div>
        <!-- scripts -->
        <script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('web_url') ?>assets/js/vue-select.js"></script>
        <script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
        <!-- <script src="<?php echo $this->config->item('web_url') ?>assets/js/script.js"></script> -->
        <script src="<?php echo $this->config->item('web_url')?>assets/js/axios.min.js"></script>
        <?php $this->load->view('include/msg'); ?>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script>
        var app = new Vue({
        el: '#app',
        components: {
        vSelect: VueSelect.vSelect,
        },
        data: {
        district: '',
        taluk: [],
        disabled: true,
        disabled1: true,
        tlq:'',
        districtSelect: <?php echo json_encode($district) ?>,
        instituteSelect: '',
        institute: '',
        instituteError: '',
        emailError: '',
        phoneError: '',
        email:'',
        phone:'',
        type: 'submit',
        captcha:'',
        intdstError:'',
        intalError:'',

        },
        methods:{
        talukFilter(){
                var self = this;
                self.taluk = '';
                self.tlq = '';
                self.instituteSelect = '';
                self.institute = '';
                const formData = new FormData();
                formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');
                formData.append('filter',self.district.id);
                axios.post('<?php echo base_url() ?>auth/talukFilter',formData)
                .then(res => {
                self.disabled = false;
                self.taluk = res.data;
                })
                .catch(err => {
                console.error(err);
                self.disabled = true;
            })
        },
        checkInstituteExist(){
                var self = this;
                const formData = new FormData();
                formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');
                formData.append('filter',self.institute);
                axios.post('<?php echo base_url() ?>auth/instititeCheck',formData)
                .then(res => {
                self.instituteError = '';
                self.type = 'submit';
                })
                .catch(err => {
                self.instituteError = err.response.data.msg;
                self.type = 'button';
            })
        },
        checkEmailExist(){
        var self = this;
        const formData = new FormData();
        formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');
        formData.append('filter',self.email);
        axios.post('<?php echo base_url() ?>auth/checkEmailExist',formData)
        .then(res => {
        self.emailError = '';
        self.type = 'submit';
        })
        .catch(err => {
        self.emailError = err.response.data.msg;
        self.type = 'button';
        })
        },
        checkPhoneExist(){
        var self = this;
        const formData = new FormData();
        formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');
        formData.append('filter',self.phone);
        if( (self.phone.length !=10)){
        self.phoneError = 'Mobile number must be 10 digits';
        }else{
        axios.post('<?php echo base_url() ?>auth/checkPhoneExist',formData)
        .then(res => {
        self.phoneError = '';
        self.type = 'submit';
        })
        .catch(err => {
        self.phoneError = err.response.data.msg;
        self.type = 'button';
        })
        }
        
        },
        checkForm() {

            this.intdstError='';
            this.intalError='';

            if((this.district.id ==null) || (this.district.id == 'undefined')){ 
                    this.intdstError = 'Please Select the District'; 
            }

            if((this.tlq.id ==null) || (this.tlq.id == 'undefined')){ 
                    this.intalError = 'Please Select the Taluk'; 
            }


            if ((this.phoneError == '') && (this.emailError == '') && (this.instituteError == '') && (this.intdstError == '') && (this.intalError == '')) {
                if (grecaptcha.getResponse() == '') {
                    this.captcha = 'Captcha is required';
                } else {
                this.$refs.form.submit();
                }
                } else {}
            }
        }
        })
        </script>
    </body>
</html>