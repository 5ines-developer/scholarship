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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@desislavsd/vue-select/dist/vue-select.css">

</head>
<body>
   <div id="app">
    
    <?php $this->load->view('include/header'); ?>

   <!-- form section -->
    <section class="bg pt30 pb30">
        <div class="container mob-block">
            <div class="row m0">
                <div class="col s12 m12 l10 push-l1">
                    <div class="card instreg">
                        <div class="card-content">
                            <div class="card-outer-heading">
                                Institution Registration
                            </div>

                            <div class="card-body">
                                <form action="<?php echo base_url() ?>register" method="post" enctype="multipart/form-data">

                                    <div class="input-field col s12 m6">
                                        <input type="hidden" name="district" :value="district.id">       
                                        <v-select  v-model="district"  as="title::id" placeholder="Select District" @input="talukFilter" tagging :from="districtSelect" />
                                    </div>

                                    <div class="input-field col s12 m6">
                                        <input type="hidden" name="taluk" :value="tlq.id">       
                                        <v-select v-model="tlq"  as="title::id" :disabled='disabled' placeholder="Select Taluk" @input="instituteFilter"  tagging :from="taluk" />
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
                                        <input id="prname"    type="text" name="prname" required class="validate">
                                        <label for="prname">Principal Name</label>
                                    </div>

                                    <div class="input-field col m6">
                                        <input id="pin" name="pin" required type="number" class="validate">
                                        <label for="pin">Pin Code</label>
                                    </div>

                                    <div class="input-field col s12 m6">
                                        <textarea id="address" required name="address" class="materialize-textarea"></textarea>
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

    <!-- footer -->
    <?php $this->load->view('include/footer'); ?>
    
   </div> 
              


<!-- scripts -->
<script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@desislavsd/vue-select"></script>
<script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
<!-- <script src="<?php echo $this->config->item('web_url') ?>assets/js/script.js"></script> -->
<script src="<?php echo $this->config->item('web_url')?>assets/js/axios.min.js"></script>
<?php $this->load->view('include/msg'); ?>

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
        },

        methods:{
            talukFilter(){
                var self = this;
                self.taluk = '';
                self.tlq = '';
                self.instituteSelect = '';
                self.institute = '';
                axios.post('<?php echo base_url() ?>auth/talukFilter?filter='+this.district.id)
                .then(res => {
                    self.disabled = false;
                    self.taluk = res.data;
                })
                .catch(err => {
                    console.error(err); 
                    self.disabled = true;
                })
            },
            instituteFilter(){
                var self = this;
                self.instituteSelect = '';
                self.institute = '';
                axios.post('<?php echo base_url() ?>auth/instituteFilter?filter='+this.tlq.id)
                .then(res => {
                    self.disabled1 = false;
                    self.institute = res.data;
                })
                .catch(err => {
                    console.error(err); 
                    self.disabled1 = true;
                })
            },
            checkInstituteExist(){
                var self = this;
                axios.post('<?php echo base_url() ?>auth/checkInstituteExist?filter='+this.instituteSelect.id)
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
                axios.post('<?php echo base_url() ?>auth/checkEmailExist?filter='+this.email)
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
                axios.post('<?php echo base_url() ?>auth/checkPhoneExist?filter='+this.phone)
                .then(res => {
                    self.phoneError = '';
                    self.type = 'submit';
                })
                .catch(err => {
                    self.phoneError = err.response.data.msg;
                    self.type = 'button';
                })
            },
        }
    })
</script>


</body>
</html>