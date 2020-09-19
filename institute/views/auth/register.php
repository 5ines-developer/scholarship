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
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
    <script type="text/javascript" src="<?php echo $this->config->item('web_url') ?>assets/js/vue-select.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
    <script src="<?php echo $this->config->item('web_url')?>assets/js/axios.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>
<body>
   <div id="app">
    
    <?php $this->load->view('include/header'); ?>

   <!-- form section -->
    <section class="bg pt30 pb30 inst-rg-block">
        <div class="container mob-block">
            <div class="row m0">
                <div class="col s12 m12 l10 push-l1">
                    <div class="card instreg">
                        <div class="card-content">
                            <div class="card-outer-heading">
                                Institution Registration
                            </div>

                            <div class="card-body">
                                <form ref="form" @submit.prevent="checkForm" action="<?php echo base_url() ?>register" method="post" enctype="multipart/form-data">

                                    <div class="input-field col s12 m6">
                                        <div>
                                            <input type="hidden" name="district" :value="district.id">       
                                            <v-select  v-model="district"  as="title::id" placeholder="Select District" @input="talukFilter" tagging :from="districtSelect" />
                                        </div>
                                        <br><span class="red-text">{{intdstError}}</span>
                                    </div>

                                    <div class="input-field col s12 m6">
                                        <div>
                                            <input type="hidden" name="taluk" :value="tlq.id">       
                                            <v-select v-model="tlq"  as="title::id" :disabled='disabled' placeholder="Select Taluk" @input="instituteFilter"  tagging :from="taluk" />
                                        </div>
                                        <br><span class="red-text">{{intalError}}</span>
                                    </div>
                                    <div class="input-field col m6">
                                        <div>
                                            <input type="hidden" name="iname" :value="instituteSelect.id"> 
                                            <v-select v-model="instituteSelect" @input="checkInstituteExist"  as="title::id" :disabled='disabled1' placeholder="Select Institute"  tagging :from="institute" />
                                        </div>
                                        <span class="red-text helper-text"> {{instituteError}}</span>
                                    </div>
                                    
                                    <div class="input-field col m6 ">
                                        <input id="regno" :value="instituteSelect.reg_no" readonly required placeholder="Registration Number" name="regno" type="text" class="validate">
                                        <span class="red-text helper-text"></span>
                                    </div>
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                    <div class="input-field col m6">
                                        <input id="email" v-model="email" @change="checkEmailExist" name="email" type="email" required class="validate">
                                        <label for="email">Email</label>
                                        <span class="red-text helper-text">{{emailError}}</span>
                                    </div>

                                    <div class="input-field col m6">
                                        <input id="number" v-model="phone" @change="checkPhoneExist" name="number" type="number" required class="validate">
                                        <label for="number">Phone Number</label>
                                        <span class="red-text helper-text">{{phoneError}}</span>
                                    </div>

                                    <div class="input-field col m6">
                                        <input id="prname"    type="text" name="prname" required class="validate" pattern="^[a-zA-Z0-9,._-!?@ ]*$">
                                        <label for="prname">Principal Name</label>
                                    </div>

                                    <div class="input-field col m6">
                                        <input id="pin" name="pin" required type="number" class="validate">
                                        <label for="pin">Pin Code</label>
                                    </div>

                                    <div class="input-field col s12 m6">
                                        <textarea id="address" required name="address" class="materialize-textarea" pattern="^[a-zA-Z0-9,._-!?@ ]*$"></textarea>
                                        <label for="address">Full Address</label>
                                    </div>

                                    <!-- <div class="card-full-divider clearfix"></div> -->
                                    
                                    
                                    
                                    <div class="file-field input-field col s12 m6">
                                        <div class="btn ">
                                            <span>File</span>
                                            <input type="file" required name="regfile">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" placeholder="Upload Institution Reg file" type="text">
                                        </div>
                                    </div>

                                    <div class="file-field input-field col s12 m6">
                                        <div class="btn ">
                                            <span>File</span>
                                            <input type="file" required name="signature">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" required placeholder="Upload Principal Signature" type="text">
                                        </div>
                                    </div>

                                    <div class="file-field input-field col s12 m6">
                                        <div class="btn ">
                                            <span>File</span>
                                            <input type="file" required name="seal">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" placeholder="Upload Institution seal" type="text">
                                        </div>
                                    </div>

                                    <div class="input-field col s12">
                                        <div class="g-recaptcha" data-sitekey="6Le6xNYUAAAAADAt0rhHLL9xenJyAFeYn5dFb2Xe"></div> 
                                        <span class="helper-text red-text">{{ captcha }}</span>
                                    </div>

                                    <div class="card-full-divider clearfix"></div>

                                    

                                    <div class="col s12">
                                       <button class="waves-effect waves-light hoverable btn-theme btn mt10" :type="type">Register</button> 
                                       <div class="right">
                                           <p class="pt20 pb10">
                                               <a href="<?php echo base_url() ?>institute-request" class="mt10 ahover">Incase Institute not in above list add here.</a> 
                                           </p>
                                       </div>
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
       <div v-if="loader" class="loading">Loading&#8230;</div>

    <!-- footer -->
    <?php $this->load->view('include/footer'); ?>
    
   </div> 
              


<!-- scripts -->

<?php $this->load->view('include/msg'); ?>
<script src="<?php echo $this->config->item('web_url') ?>assets/js/script.js"></script>
<script>


    var app = new Vue({
        el: '#app',
        components: {
            vSelect: VueSelect.vSelect,
        },
        data: {
            loader:false,
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
                self.loader=true;
                self.taluk = '';
                self.tlq = '';
                self.instituteSelect = '';
                self.institute = '';
                const formData = new FormData();
                formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');
                formData.append('filter',self.district.id);
                axios.post('<?php echo base_url() ?>auth/talukFilter',formData)
                .then(res => {
                    self.loader=false;
                    self.disabled = false;
                    self.taluk = res.data;
                })
                .catch(err => {
                    self.loader=false;
                    self.disabled = true;
                })
            },
            instituteFilter(){
                var self = this;
                self.loader=true;
                self.instituteSelect = '';
                self.institute = '';
                const formData = new FormData();
                formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');
                formData.append('filter',self.tlq.id);
                axios.post('<?php echo base_url() ?>auth/instituteFilter',formData)
                .then(res => {
                    self.loader=false;
                    self.disabled1 = false;
                    self.institute = res.data;
                })
                .catch(err => {
                    self.loader=false;
                    self.disabled1 = true;
                })
            },
            checkInstituteExist(){
                var self = this;
                const formData = new FormData();
                formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');
                formData.append('filter',self.instituteSelect.id);
                axios.post('<?php echo base_url() ?>auth/checkInstituteExist',formData)
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
                formData.append('filter',this.email);
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
                formData.append('filter',this.phone);

                if( (this.phone.length !=10)){
                    this.phoneError = 'Mobile number must be 10 digits';
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
                
            },checkForm() {

                this.intdstError='';
                this.intalError='';
                this.instituteError='';

                if((this.district.id ==null) || (this.district.id == 'undefined')){ 
                        this.intdstError = 'Please Select the District'; 
                }

                if((this.tlq.id ==null) || (this.tlq.id == 'undefined')){ 
                        this.intalError = 'Please Select the Taluk'; 
                }

                if((this.instituteSelect.id ==null) || (this.instituteSelect.id == 'undefined')){ 
                        this.instituteError = 'Please Select the Institute'; 
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