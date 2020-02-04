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
        <section class="board hiegt-box">
            <div class="container-wrap1">
                <div class="row m0">
                    <div class="col s12 m3 hide-on-med-and-down">
                    <?php $this->load->view('include/menu'); ?>
                    </div>
                    <!-- End menu-->

                    <div class="col s12 m8">
                        <div class="card  darken-1">
                            <div class="card-content bord-right">
                                <div class="title-list">
                                    <span class="list-title">Student Add</span>
                                </div>
                                <div class="board-content">
                                    <div class="row m0">
                                        <div class="col s12 m12 l12">
                                            <form action="<?php echo base_url() ?>student-add" method="post">

                                                <div class="input-field col m8 l5">
                                                    <input id="email" name="email" type="email" v-model="email" class="validate" @change="emailCheck">
                                                    <label for="email">Email</label>
                                                    <span class="helper-text red-text">{{ emailError }}</span>
                                                </div>
                                                <div class="clearfix"></div>

                                                <div class="input-field col m8 l5">
                                                    <input id="phone" name="phone" type="text" required v-model="phone" class="validate" @change="mobileCheck">
                                                    <label for="phone">Phone Number</label>
                                                    <span class="helper-text red-text">{{mobileError}}</span><br>
                                                </div>
                                                <div class="clearfix"></div>


                                                <div class="input-field col m8 l5">
                                                    <input id="password" name="password" required type="password" class="validate">
                                                    <label for="password">Password</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <button class="waves-effect waves-light hoverable btn-theme btn mr10">Submit</button>
                                                    <button class="waves-effect waves-light hoverable btn-theme btn" type="button">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End right board -->
                </div>
            </div>
        </section>


      

        <?php $this->load->view('include/footer'); ?>
        <!-- End footer -->
    </div>



    <!-- scripts -->
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/script.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/axios.min.js"></script>
    <?php $this->load->view('include/msg'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var instances = M.FormSelect.init(document.querySelectorAll('.select2'));
        });
        document.addEventListener('DOMContentLoaded', function() {
            var instances = M.Sidenav.init(document.querySelectorAll('.sidenav'));
            var gropDown = M.Dropdown.init(document.querySelectorAll('.dropdown-trigger'), {
                constrainWidth: false,
                alignment: 'right'
            })
        });


        var app = new Vue({
            el: '#app',
            data: {
                email: '',
                phone: '',
                emailError: '',
                mobileError: '',
            },

            methods: {
                //check student mobile already exist
                mobileCheck(){

                    this.mobileError='';
                    const formData = new FormData();
                    formData.append('phone',this.phone);
                    axios.post('<?php echo base_url('student-mobile_check') ?>', formData)
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
                //check student email already exist
                emailCheck(){
                    this.emailError='';
                    const formData = new FormData();
                    formData.append('email',this.email);
                    axios.post('<?php echo base_url('student-emailcheck') ?>',formData)
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
                checkForm() {
                if ((this.mobileError == '') && (this.emailError == '')) {
                        this.$refs.form.submit();
                    }
                }

            }
        })
    </script>
</body>

</html>