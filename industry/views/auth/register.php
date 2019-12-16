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
                            Industry Registration
                            </div>
                            <div class="card-body">
                                <form ref="form" @submit.prevent="checkForm"  action="<?php echo base_url('register') ?>" method="post" enctype="multipart/form-data">
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
                                        <select id="act" name="act" required="" class="select2" v-model="act" @change="getCompany()" >
                                            <option value="" disabled selected>Choose your option</option>
                                            <option value="1">Labour Act</option>
                                            <option value="2">Factory Act</option>                                            
                                        </select>
                                        <label for="act">Industry Type</label>
                                    </div>
                                    <div class="row m0">                                    
                                        <div class="input-field col m6">
                                            <select id="company" name="company" v-model="company">
                                                <option value="" disabled >Select Your Industry</option>
                                                <option v-for="comp in companies" v-bind:value="comp.id">
                                                    {{ comp.name }}
                                                </option>                                           
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row m0">  
                                        <div class="input-field col m6">
                                            <input id="c_conreg" type="text" readonly class="c_conreg validate" required="">
                                            <input id="c_comp" type="hidden" name="c_comp" >
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
                                    
                                    <div class="input-field col m6">
                                        <input id="password" type="password" class="c_password" class="validate" name="password"   required="" v-model="psw">
                                        <label for="password">Password</label>
                                    </div>
                                    <div class="input-field col m6">
                                        <input id="cpassword" @keyup="checkCpsw()" type="password" class="c_confpassword validate" name="cpassword" required="" v-model="cpsw">
                                        <label for="cpassword">Confirm Password</label>
                                        <span class="helper-text red-text">{{confError}}</span>
                                    </div>                                                                       
                                    <div class="input-field col s12 m12">
                                        <textarea id="address" name="address" class="materialize-textarea"></textarea>
                                        <label for="address">Address</label>
                                    </div>
                                    <!-- <div class="input-field col s12">
                                        <div class="g-recaptcha"data-sitekey="6LfgeS8UAAAAAFzucpwQQef7KXcRi7Pzam5ZIqMX"></div> 
                                        <span class="helper-text red-text">{{ captcha }}</span>
                                    </div> -->
                                    
                                    <div class="input-field col m12 ">
                                        <button class="waves-effect waves-light hoverable btn-theme btn">Submit</button>
                                        <span class="com-reg">If You Have an Account ?<a href="<?php echo base_url('login') ?>">Login</a></span>
                                    </div>
                                    <div class="input-field col m12 ">
                                        <p class="click-com">If Your Industry is Not Available in Above List - <a href="#">Click Here To Submit your Details</a></p>
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
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/jquery-3.4.1.min.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/select2.js"></script>
    <script>
    <?php $this->load->view('include/msg'); ?>
</script>
    <script>
$(document).ready(function() {
    $('#company').select2({width: "100%"});
    
    
    $(document).on('change','#company',function(){
        var cmp = $(this).val();
        $('#c_comp').val(cmp);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('auth/companyChange') ?>",
            data: { comp : cmp},
            dataType: "html",
            success: function (response) {
                $('#c_conreg').val(response);
                $(".crg").addClass('active');
                
            }
        });

    });
});

        document.addEventListener('DOMContentLoaded', function() {
            var instances = M.FormSelect.init(document.querySelectorAll('.select2'));
        });


        var app = new Vue({
            el: '#app',
            data: {
                mobile: '',
                email: '',
                psw: '',
                cpsw: '',
                emailError: '',
                mobileError: '',
                confError:'',
                captcha:'',
                company:'',
                active:false,
                istrue:false,
                act:'',
                companies:[],
                loader:false,

            },

            methods: {

                            //check student email already exist
            emailCheck(){
                this.emailError='';
                const formData = new FormData();
                formData.append('email',this.email);
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
            getCompany(){
                this.loader = true;
                const formData = new FormData();
                formData.append('act',this.act);
                axios.post('<?php echo base_url('auth/getCompany') ?>', formData)
                .then(response => {
                    this.companies = response.data;
                    this.loader = false;
                }).catch(error =>{
                    if (error.response) {
                        this.errormsg = error.response.data.error;
                    }
                    this.loader = false;
                } )
            },
            // check Password matching
            checkCpsw() {
                if (this.psw != this.cpsw) {
                    this.confError = 'Password must match with previous entry!';

                } else {
                    this.confError = '';
                }
            },
            checkForm() {
                if ((this.confError == '') && (this.mobileError == '') && (this.emailError == '')) {

                    this.$refs.form.submit();

                    // if (grecaptcha.getResponse() == '') {
                    //     this.captcha = 'Captcha is required';
                    // } else {
                    //     this.$refs.form.submit();
                    // }// 
                } else {}
            }


            }
        })
    </script>
</body>

</html>