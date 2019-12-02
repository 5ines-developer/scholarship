<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Scholarship</title>
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <?php $this->load->view('includes/header'); ?>
            <!-- Body form  -->
            <section class="board">
                <div class="container-wrap1">
                    <div class="row m0">
                        <?php $this->load->view('includes/student-sidebar.php'); ?>
                        <!-- End menu-->
                        <div class="col s12 m8">
                            <div class="card  darken-1">
                                <div class="card-content bord-right">
                                    <span class="card-title">Change Password</span>
                                    <div class="board-content">
                                        <div class="row m0">
                                            
                                            <div class="col s12 m8 l8">
                                                <form ref="form" @submit.prevent="checkForm" action="<?php echo base_url('student/update-password') ?>" method="post">
                                                    <div class="input-field col s12">
                                                        <input id="name" v-on:change="currntPass" v-model="currentpsw"  type="password" class="validate" name="cpswd" required="">
                                                        <label for="name">Current Password</label>
                                                        <span class="helper-text red-text">{{crpError}}</span>
                                                    </div>
                                                    
                                                    <div class="input-field col s12">
                                                        <input id="email" type="password" v-on:change="samePass"  v-model="npsw" class="validate" name="npswd" required="">
                                                        <label for="email">New Password</label>
                                                        <span class="helper-text red-text">{{samepassError}}</span>

                                                    </div>
                                                    
                                                    <div class="input-field col s12">
                                                        <input id="phone" v-model="cpsw" type="password" class="validate" name="cn_pswd" required="" v-on:change="checkCpsw">
                                                        <label for="phone">Confirm Password</label>
                                                        <span class="helper-text red-text">{{confError}}</span>
                                                    </div>
                                                    
                                                    <div class="input-field col s12">
                                                        <button class="waves-effect waves-light hoverable btn-theme btn">Reset Password</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div> <!-- End right board -->
                        </div>
                    </div>
                </section>
                <!-- End Body form  -->
                <section>
                </section>
                <!-- footer -->
                
                <?php $this->load->view('includes/footer'); ?>
                <!-- End footer -->
            </div>
            
            <!-- scripts -->
            <script src="<?php echo base_url() ?>assets/js/vue.js"></script>
            <script src="<?php echo base_url() ?>assets/js/materialize.min.js"></script>
            <script src="<?php echo base_url() ?>assets/js/script.js"></script>
            <script src="<?php echo base_url()?>assets/js/axios.min.js"></script>
            <script>
                <?php $this->load->view('includes/message'); ?>
            </script>
            <script>
            
            var app = new Vue({
            el: '#app',
            data: {
                currentpsw: '',
                npsw: '',
                cpsw: '',
                crpError:'',
                confError:'',
                samepassError:'',
            },
            methods:{
                currntPass(){
                    const formData = new FormData();
                    formData.append('crpass', this.currentpsw);
                    axios.post('<?php echo base_url() ?>std_account/checkpsw', formData)
                    .then(response => {
                        if(response.data == ''){
                            this.crpError = 'You have entered invalid current password';
                        }else{
                            this.crpError ='';
                        }
                    }).catch(error => {
                        if (error.response) {
                            this.errormsg = error.response.data.error;
                        }
                    })
                },
                // check psw
                checkCpsw() {
                    if (this.npsw != this.cpsw) {
                        this.confError = 'Password must match with previous entry!';
                    } else {
                        this.confError = '';
                    }
                },
                samePass(){
                    if (this.currentpsw == this.npsw) {
                        this.samepassError = 'Please enter a password you have never used before!'
                    }else{
                         this.samepassError = '';
                    }

                },
                checkForm() {
                    if ((this.confError == '')) {
                        this.$refs.form.submit()
                    }
                }
                }
            })
            </script>
        </body>
    </html>