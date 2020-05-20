<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scholarship</title>
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets//css/style.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets//css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="<?php echo $this->config->item('web_url') ?>assets//js/vue.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets//js/materialize.min.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets//js/axios.min.js"></script>
</head>
<body>
    <div id="app">
        
    <?php $this->load->view('include/header'); ?>

    <!-- Body form  -->
        <section class="board">
            <div class="container-wrap1">
                <div class="row m0">                      
                        <?php $this->load->view('include/menu'); ?>                    

                    <div class="col s12 m8">
                        <div class="card  darken-1">
                            <div class="card-content bord-right">
                                <span class="card-title">Account Settings</span>
                                <div class="board-content">
                                    <div class="row m0">
                                        <div class="col s12 m8 l8">
                                            <form action="<?php echo base_url('dashboard/updateprofile') ?>" method="post">
                                                <div class="input-field col s12">
                                                    <input id="name" required type="text" class="validate" value="<?php echo (!empty($result->name))?$result->name:''; ?>" name="name">
                                                    <label for="name">Name</label>
                                                </div>
                                                
                                                <div class="input-field col s12">
                                                    <input id="email" readonly required type="email" class="validate" value="<?php echo (!empty($result->email))?$result->email:''; ?>" name="email">
                                                    <label for="email">Email Id</label>
                                                </div>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                
                                                
                                                <div class="input-field col s12">
                                                    <input id="phone" required type="number" class="validate" value="<?php echo (!empty($result->phone))?$result->phone:''; ?>" name="phone">
                                                    <label for="phone">Mobile Number</label>
                                                </div>
                                                
                                                <div class="input-field col s12">
                                                    <button type="submit" class="waves-effect waves-light hoverable btn-theme btn">Save</button>
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
    <?php $this->load->view('include/footer'); ?>    
        
    <!-- End footer --> 
    </div>
             


<!-- scripts -->
<script>
<?php $this->load->view('include/msg'); ?>
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var instances = M.Sidenav.init(document.querySelectorAll('.sidenav'));
        var gropDown = M.Dropdown.init(document.querySelectorAll('.dropdown-trigger'), {
            constrainWidth: false,
            alignment:'right'
        })
    });

    var app = new Vue({
        el: '#app',
        data: {
            
        },  

        methods:{
            
        },
        
    })



   
</script>
</body>
</html>