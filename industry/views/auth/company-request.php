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
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/vue-select.css">
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/axios.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/jquery-3.4.1.min.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/select2.js"></script>
    <script type="text/javascript" src="<?php echo $this->config->item('web_url') ?>assets/js/vue-select.js"></script>
</head>

<body>
    <div id="app">
<?php $this->load->view('include/header'); ?>

    <!-- form section -->
    <section class="bg pt30 pb30 reg-block indstry-rg-block">
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


                                    <div class="input-field col s12 m6">
                                         <div>
                                            <input type="hidden" name="district" :value="district.id">       
                                            <v-select  v-model="district"  as="title::id" placeholder="Select District" @input="talukFilter" tagging :from="districtSelect" />
                                        </div>
                                        <br>
                                         <span class="red-text">{{inDistError}}</span>
                                    </div>

                                    <div class="input-field col s12 m6">
                                        <div>
                                        <input type="hidden" name="taluk" :value="tlq.id">       
                                        <v-select v-model="tlq"  as="title::id" :disabled='disabled' placeholder="Select Taluk"  tagging :from="taluk" /></div><br>
                                        <span class="red-text">{{indtalError}}</span>
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

                                    <div class="row m0">                                    
                                        <div class="input-field col m12">
                                        <input id="company" type="text" name="company" class="c_conreg validate" pattern="^[a-zA-Z0-9,._-!?@ ]*$" required="">
                                        <label for="company">Industry Name</label>
                                        </div>
                                    </div>
                                     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                        
                                                                                                           
                                    <div class="input-field col s12 m12">
                                        <textarea id="address" name="address" required class="materialize-textarea" pattern="^[a-zA-Z0-9,._-!?@ ]*$"></textarea>
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

        $(document).ready(function() {

            $("select").css({display: "inline", height: 0, padding: 0, width: 0});

        });


        document.addEventListener('DOMContentLoaded', function() {
            var instances = M.FormSelect.init(document.querySelectorAll('.select2'));
        });


        var app = new Vue({
            el: '#app',
            components: {
            vSelect: VueSelect.vSelect,
        },
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
                districtSelect: <?php echo json_encode($district) ?>,
                district: '',
                taluk: [],
                tlq:'',
                disabled: true,
                disabled1: true,
                inDistError:'',
                indtalError:'',
            },

            methods: {

                talukFilter(){
                var self = this;
                self.loader = true;
                self.taluk = '';
                self.tlq = '';
                self.instituteSelect = '';
                self.institute = '';
                const formData = new FormData();
                formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');
                formData.append('filter',this.district.id);
                axios.post('<?php echo base_url() ?>auth/talukFilter',formData)
                .then(res => {
                    self.loader = false;
                    self.disabled = false;
                    self.taluk = res.data;
                })
                .catch(err => {
                    self.loader = false; 
                    self.disabled = true;
                })
            },


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

                if( (this.mobile.length !=10)){
                    this.mobileError = 'Mobile number must be 10 digits';
                }else{

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
                    })

                }
                
            },
            checkForm() {

                this.inDistError = '';
                this.indtalError = '';
                if((this.district.id ==null) || (this.district.id== 'undefined')){ 
                    this.inDistError = 'Please Select the District'; 
                }
                if((this.tlq.id ==null) || (this.tlq.id =='undefined')){ this.indtalError = 'Please Select the Talluk';  } 

                if ((this.mobileError == '') && (this.emailError == '') && (this.inDistError == '') && (this.indtalError == '')) {
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