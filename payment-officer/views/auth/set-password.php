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

<?php $this->load->view('include/header'); ?>

    <!-- Registration form  -->
    <section class="reg-block valign-wrapper  row m0" id='app'>
        <div class="container-wrap2">
            <div class="col s12 m12 l10 push-l3 p0">
                    <div class="fog-block-content ">
                   
                    <div class="col s12 m8  l8 reg-right">
                        <div class="form-block frgotPass">
                            <div class="card-box">
                                <div class="card-heading">
                                    <p class="m0">Set your password</p>
                                </div>
                                <form id="forgotForm" @submit="validateBeforeSubmit" method="post" action="<?php echo base_url() ?>set-password">
                                <div class="card-body row m0 pt30 pb15">

                                    <div class="input-field col s12">
                                        <input  id="password" minlength=6  name="psw" v-model="psw" type="password" class="validate" required>
                                        <label for="password">Password</label>
                                    </div>

        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    

                                    <div class="input-field col s12">
                                        <input  id="cpassword" type="password" v-model="cpsw" name="cpsw" class="validate" required>
                                        <label for="cpassword">Confirm Password</label>
                                    </div>
                                    <input type="hidden" name="key" value="<?php echo $key ?>">
                                    <div class="col s12 red-text">{{error}}</div>

                                    <div class="input-field col s12">
                                        <button class="waves-effect waves-light hoverable btn-theme btn">Submit</button>
                                    </div>
                                </div>
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
              


<!-- scripts -->
<script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
<script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
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
            psw: '',
            cpsw: '',
            error: '',
        },

        methods:{
            validateBeforeSubmit(e){
                if(this.psw != this.cpsw){
                    this.error = 'Password not matching'
                    e.preventDefault();
                }
            }
        }
    })

</script>
</body>
</html>