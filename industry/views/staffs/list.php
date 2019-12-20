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

                    <div class="col s12 m9">
                        <div class="card  darken-1">
                            <div class="card-content bord-right">
                            <div>
                                <a class="waves-effect waves-light hoverable btn-theme btn right capitalize" href="<?php echo base_url()  ?>staffs/create">  <i class="material-icons tiny left">add</i> Add new staff</a>
                                <span class="card-title">Verification staffs</span>
                                <input type="hidden" v-model="id">
                            </div>
                                <div class="board-content">
                                    <div class="row m0">
                                        <table class="vue-data-table row-click ovrflw-tbl">
                                            <thead>
                                                <tr>
                                                    <th>Sl No</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($staffs as $key => $value) { ?>
                                                    <tr>
                                                        <td><?php echo (!empty($staffs))?$key + 1:''; ?></td>
                                                        <td><?php echo (!empty($value->name))?$value->name:''; ?></td>
                                                        <td><?php echo (!empty($value->email))?$value->email:''; ?></td>
                                                        <td><?php echo (!empty($value->mobile))?$value->mobile:''; ?></td>
                                                        <td>
                                                            <span v-bind:style="{ color: activeColor}">{{actve}}</span>
                                                        </td>
                                                        <td>
                                                            <a :class="{hide:hiden}"  class="btn-small right red darken-3 waves-effect waves-light" @click="staffBlock">Block</a>
                                                            <a :class="{hide:hiden1}" @click="unBlock" class="btn-small right green darken-3 waves-effect waves-light">UNBlock</a>
                                                        </td>
                                                    </tr>      
                                                <?php } if(empty($staffs)){ ?>
                                                    <tr>
                                                        <td colspan="6">No result found</td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
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
            loader:false,
            deactivate:'',
            id:'<?php echo (!empty($value->id))?$value->id:''; ?>',
            loginType:'',
            hiden:'<?php echo ($value->status == '2')?true:false; ?>',
            hiden1:'<?php echo ($value->status == '1')?true:false; ?>',
            actve:'<?php if($value->status == 0){ echo 'Inactive'; }else if($value->status == 1){ echo 'Active'; }else
            { echo 'Blocked'; } ?>',
            activeColor:'<?php if($value->status == 1){ echo 'green'; }else{ echo 'red'; } ?>',
          
        },  
        mounted(){
        },
        methods:{
            staffBlock(){
                 loader = true;
               const formData = new FormData();
               formData.append('id',this.id);
               axios.post('<?php echo base_url('staffs/block') ?>',formData)
               .then(response => {
                    loader = false;
                    msg = response.data.msg;
                    this.hiden1 = false;
                    this.hiden = true;
                    this.actve = 'Blocked';
                    this.activeColor = 'red';
                    M.toast({html: msg, classes: 'green', displayLength : 5000 });
               })
               .catch(error =>{
                 this.errormsg = error.response.data.error;
               })
            },
            unBlock(){
                loader = true;
                    const formData = new FormData();
                   formData.append('id',this.id);
                   axios.post('<?php echo base_url('staffs/unblock') ?>',formData)
                   .then(response => {
                        msg = response.data.msg;
                        loader = false;
                        this.hiden = false;
                        this.hiden1 = true;
                        this.actve = 'Active';
                        this.activeColor = 'green';
                        M.toast({html: msg, classes: 'green', displayLength : 5000 });
                   })
                   .catch(error =>{
                     this.errormsg = error.response.data.error;
                   })
            }
            
        }
    })
</script>
</body>
</html>