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
                    <div class="col s12 m3 hide-on-small-only">
                        <?php $this->load->view('include/menu'); ?>
                    </div> <!-- End menu-->

                    <div class="col s12 m8">
                        <div class="card  darken-1">
                            <div class="card-content bord-right">
                            <div>
                                <a class="waves-effect waves-light hoverable btn-theme btn right capitalize" href="<?php echo base_url()  ?>staffs">  <i class="material-icons tiny left">arrow_back</i> Back</a>
                                <span class="card-title">Add new verification staff</span>
                            </div>
                                <div class="board-content">
                                    <div class="row m0">
                                       <form action="<?php echo base_url() ?>staffs/create" method="post">
                                            <div class="col s12 m8 l7">
                                                <div class="input-field col s12">
                                                    <input id="name" name="name" type="text" required class="validate">
                                                    <label for="name">Full Name</label>
                                                </div>

                                                <div class="input-field col s12"> 
                                                    <input id="email" name="email" type="email" required class="validate">
                                                    <label for="email">Email</label>
                                                </div>

                                                <div class="input-field col s12">
                                                    <input id="phone" name="phone" type="number" required class="validate">
                                                    <label for="phone">Phone number</label>
                                                </div>

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
<?php $this->load->view('include/msg'); ?>
<script>
   


    var app = new Vue({
        el: '#app',
        data: {
          
        },  
        mounted(){
        },
        methods:{
            
        }
    })
</script>
</body>
</html>