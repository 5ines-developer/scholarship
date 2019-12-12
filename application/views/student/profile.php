<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scholarship</title>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div id="app">
        
    <?php $this->load->view('includes/header'); ?>

    <!-- Body form  -->
        <section class="board">
            <div class="container-wrap1">
                <div class="row m0">
                      <?php $this->load->view('includes/student-sidebar.php'); ?> <!-- End menu-->

                    <div class="col s12 m8">
                        <div class="card  darken-1">
                            <div class="card-content bord-right">
                                <span class="card-title">Account Settings</span>
                                <div class="board-content">
                                    <div class="row m0">
                                        <div class="col s12 m3 l3">
                                            <div class="board-profile">
                                                <img :src="student.profile" alt="" class="responsive-img" id="targetimg">
                                                <div class="overlay-button">
                                                    <a  @click="imageselect()"><i class="material-icons">edit</i></a>
                                                </div>
                                            </div>
                                            <p class="center">
                                                <a href="<?php echo base_url('student/change-password') ?>" class="change-psw"  >Change password</a>
                                            </p>
                                        </div>
                                        <div class="col s12 m8 l8">
                                            <form action="<?php echo base_url('student/updateprofile') ?>" method="post" @submit="formSubmit">
                                                <div class="input-field col s12">
                                                    <input id="name" autofocus="" v-model="student.name" type="text" class="validate">
                                                    <label for="name">Name</label>
                                                </div>
                                                
                                                <div class="input-field col s12">
                                                    <input id="email" autofocus="" readonly="" type="email"  v-model="student.email" class="validate">
                                                    <label for="email">Email Id</label>
                                                </div>
                                                
                                                <div class="input-field col s12">
                                                    <input id="phone" autofocus="" v-model="student.mobile" type="number" class="validate">
                                                    <label for="phone">Mobile Number</label>
                                                </div>
                                                
                                                <div class="input-field col s12">
                                                    <input type="file" id="profileimg" @change="upload()" onchange="putImage()" ref="fileInput" class="hide" accept="image/*">
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
    <?php $this->load->view('includes/footer'); ?>       
        
    <!-- End footer --> 
    </div>
             


<!-- scripts -->
<script src="<?php echo base_url() ?>assets/js/vue.js"></script>
<script src="<?php echo base_url() ?>assets/js/materialize.min.js"></script>
<script src="<?php echo base_url()?>assets/js/axios.min.js"></script>
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
            student: {
                name: '',
                email: '',
                mobile: '',
                profile: '',
            },
            profilePic: '',
            fileInput:'',
            loader:false,

        },  

        methods:{
            imageselect(){
                this.$refs.fileInput.click()
            },
            onFileChange(e) {
                const file = e.target.files[0];
                this.student.profile = URL.createObjectURL(file);
            },
            upload(){
                this.loader=true;
                this.fileInput = this.$refs.fileInput.files[0];
                const formData = new FormData();
                formData.append('file', this.fileInput);
                axios.post('<?php echo base_url() ?>std_account/addfile', formData,
                    formData,
                        { 
                            headers: {
                            'Content-Type': 'multipart/form-data'
                            } 
                        }
                    ).then(response => {
                        this.loader=false;                                            
                        if(response.data == '1'){
                            M.toast({html: 'Your profile has been updated successfully.', classes: 'green', displayLength : 5000 });
                        }else{
                            M.toast({html: 'Something went wrong!, please try again Later', classes: 'red', displayLength : 5000 });
                        }  
                    }).catch(error => {
                        this.loader=false;  

                        if (error.response) {
                            this.errormsg = error.response.data.error;
                        }
                    }) 
                },
                formSubmit(e){
                    e.preventDefault();
                    this.loader=true;
                    const formData = new FormData();
                    formData.append('name', this.student.name);
                    formData.append('mobile', this.student.mobile);
                    axios.post('<?php echo base_url() ?>std_account/updateprofile', formData)
                    .then(response => {
                    this.loader=false;
                    if(response.data == '1'){
                        M.toast({html: 'Your profile has been updated successfully.', classes: 'green', displayLength : 5000 });
                    }else{
                        M.toast({html: 'Something went wrong!, please try again Later', classes: 'red', displayLength : 5000 });
                    }

                    }).catch(error => {
                         this.loader=false;
                    if (error.response) {
                        this.errormsg = error.response.data.error;
                    }
                    })

                },
            getData(){
                this.loader=true;
                axios.post('<?php echo base_url() ?>std_account/getProfile')
                .then(response => {
                    this.loader=false;

                    if(response.data != ''){

                        this.student.email      = response.data.email;
                        this.student.name       = response.data.name;
                        this.student.mobile     = response.data.phone;                       

                        if(response.data.profile != ''){
                            this.student.profile    = response.data.profile;
                        }else{
                            this.student.profile  = 'https://img.icons8.com/pastel-glyph/2x/person-male.png';
                        }
                    }
                })
                .catch(error => {
                    this.loader=false;
                    
                    if (error.response) {
                        this.errormsg = error.response.data.error;
                    }
                })
            },
        },
        mounted: function() {
            this.getData();
        },
    })



    function showImage(src, target) {
        var fr = new FileReader();
 
        fr.onload = function(){
            target.src = fr.result;
        }
        fr.readAsDataURL(src.files[0]);
    }

    function putImage() {
        var src = document.getElementById("profileimg");
        var target = document.getElementById("targetimg");
        showImage(src, target);
    }
</script>
</body>
</html>