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
    <div id="app">
    <?php $this->load->view('include/header'); ?>

    <!-- Body form  -->
        <section class="board">
            <div class="container-wrap1">
                <div class="row m0">
                        <?php $this->load->view('include/menu'); ?>
                    <!-- End menu-->

                    <div class="col s12 m8">
                        <div class="card  darken-1">
                            <div class="card-content bord-right">
                            <div>
                                <!-- <a class="waves-effect waves-light hoverable btn-theme btn right capitalize" href="<?php echo base_url()  ?>staffs">  <i class="material-icons tiny left">arrow_back</i> Back</a> -->
                                <span class="card-title">Account Settings</span>
                            </div>
                                <div class="board-content">
                                    <div class="row m0">
                                       <form ref="form" @submit.prevent="checkForm"   action="<?php echo base_url() ?>account/hrupdate" method="post">
                                            <div class="col s12 m8 l7">
                                                <div class="input-field col s12">
                                                    <input id="name" name="name" type="text" required class="validate" value="<?php echo (!empty($info->name))?$info->name:''; ?>">
                                                    <label for="name">Full Name</label>
                                                </div>

                                                <div class="input-field col s12"> 
                                                    <input id="email" name="email" type="email" readonly="" value="<?php echo (!empty($info->name))?$info->name:''; ?>">
                                                    <label for="email">Email</label>
                                                    <span class="helper-text red-text">{{ emailError }}</span>
                                                </div>

                                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">


                                                <div class="input-field col s12">
                                                    <input id="phone" name="phone" type="number" required class="validate" v-model="mobile" @change="mobileCheck" >
                                                    <label for="phone">Phone number</label>
                                                    <span class="helper-text red-text">{{mobileError}}</span>
                                                </div>
                                                <input type="hidden" name="id" value="<?php echo (!empty($info->id))?$info->id:''; ?>">

                                                <div class="input-field col s12">
                                                    <button type="submit" class="waves-effect waves-light hoverable btn-theme btn  capitalize">Submit</button>
                                                </div>
                                            </div>
                                       </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End right board -->
                </div>
            </div>
        </section>


    <!-- End Body form  -->

    <!-- footer -->
        
    <?php $this->load->view('include/footer'); ?>
    <!-- End footer --> 
    </div>
             


<!-- scripts -->
<script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
<script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
<script src="<?php echo $this->config->item('web_url') ?>assets/js/axios.min.js"></script>
<script src="<?php echo $this->config->item('web_url') ?>assets/js/script.js"></script>
<script>
<?php $this->load->view('include/msg'); ?>
</script>
<script>
   


    var app = new Vue({
        el: '#app',
        data: {
            loader:false,
            emailError:'',
            mobileError :'',
            mobile:'<?php echo (!empty($info->mobile))?$info->mobile:''; ?>',
            email:'',
          
        },  
        mounted(){
        },
        methods:{
            
            //check student mobile already exist
             mobileCheck(){

                this.mobileError='';
                const formData = new FormData();
                formData.append('mobile',this.mobile);
        formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');
                
                axios.post('<?php echo base_url('account/mobile_check') ?>', formData)
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
                    this.$refs.form.submit();
                } else {}
            }
            
        }
    })
</script>
</body>
</html>