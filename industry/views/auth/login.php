<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scholarship</title>
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/materialize.min.css">
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/axios.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
    <div id="app">
    <?php $this->load->view('include/header') ?>

    <!-- Registration form  -->
    <section class="reg-block row m0" id='app'>
        <div class="container-wrap2">
            <div class="col s12 m12 l10 push-l1 p0">
                <div class="reg-block-content">

                    <div class="col s12 m6 push-m6 push-l6 l6 reg-right">
                        <div class="form-block">
                            <div class="card-box">
                                <div class="card-heading">
                                    <p class="m0">Company Login</p>
                                </div>
                                <div class="card-body row m0 pt15 pb15">
                                    <form ref="form" @submit.prevent="checkForm" action="<?php echo base_url('login') ?>" method="post">
                                        <div class="input-field col s12">
                                            <input id="email" @change="emailCheck()" v-model="email" name="email" type="email" class="validate" required>
                                            <label for="email">Email ID</label>
                                            <span class="helper-text red-text">{{ emailError }}</span>
                                        </div>
                                        <div class="input-field col s12">
                                            <input id="password" v-model="psw" type="password" name="psw" class="validate" required>
                                            <label for="password">Password</label>
                                        </div>

                                        <div class="input-field col s12">
                                            <div class="g-recaptcha" data-sitekey="6Le6xNYUAAAAADAt0rhHLL9xenJyAFeYn5dFb2Xe"></div> 
                                            <span class="helper-text red-text">{{ captcha }}</span>
                                        </div>

                                        <a href="<?php echo base_url('forgot-password') ?>" class="col mt15 mb15">Forgot Password?</a>
                                        <div class="input-field col s12">
                                            <button class="waves-effect waves-light hoverable btn-theme btn">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 pull-m6 pull-l6 m6 l6 reg-left height352 valign-wrapper">
                        <div class="reg-left-box ">
                            <div class="contents">
                                <p>Welcom To</p>
                                <p>Karnataka Labour Welfare Board</p>
                                <p>If You Dont Have an Account ? <a href="<?php echo base_url('register') ?>">Register</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- footer -->
    <?php $this->load->view('include/footer') ?>

    </div>




    <!-- scripts -->
    <script>
        <?php $this->load->view('include/msg'); ?>
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var instances = M.FormSelect.init(document.querySelectorAll('select'));
        });


        var app = new Vue({
            el: '#app',
            data: {
                industry: '',
                mobile: '',
                email: '',
                psw: '',
                cpsw: '',
                emailError: '',
                captcha:'',
            },

            methods: {
                emailCheck(){
                    this.emailError='';
                    const formData = new FormData();
                    formData.append('email',this.email);
                    axios.post('<?php echo base_url('auth/emailcheck') ?>',formData)
                    .then(response =>{
                        if (response.data == '') {
                            this.emailError = 'Account does not exist!';
                        } else {
                            this.emailError = '';
                        }

                    }).catch(error => {
                        if (error.response) {
                            this.errormsg = error.response.data.error;
                        }
                    })
                },
                checkForm() {
                    if ((this.emailError == '')) {

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