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
                <?php $this->load->view('includes/student-sidebar.php'); ?> <!-- End menu-->

                    <div class="col s12 m8">
                        <div class="card  darken-1">
                            <div class="card-content bord-right">
                                <span class="card-title">Scholarship Status</span>
                                <div class="board-content">
                                    <div class="row m0">
                                       <ul class="status-list">
                                           <li class="center status-item">
                                               <div>Application</div>
                                               <div class="circle">1</div>
                                               <?php if ((($result->application_state == 1) || ($result->application_state == 2) || ($result->application_state == 3) || (($result->application_state == 4)))) {
                                                   echo '<div class="green-text">Submitted</div>';
                                                }else{
                                                    echo '<div class="blue-text">Pending</div>';
                                                } ?>                                               
                                           </li>
                                           <li class="center status-item">
                                               <div>Institution</div>
                                               <div class="circle">2</div> 
                                               <?php if (($result->status != 2) && (($result->application_state == 2) || ($result->application_state == 3) || (($result->application_state == 4)))) {
                                                   echo '<div class="green-text">Approved</div>';
                                                }else if (($result->status == 2) && ($result->application_state == 1) ){
                                                    echo '<div class="red-text">Rejected</div>';                                                    
                                                }else{
                                                    echo '<div class="blue-text">Pending</div>';
                                                } ?>  
                                           </li>
                                           <li class="center status-item">
                                               <div>Industry</div>
                                               <div class="circle">3</div>
                                               <?php if (($result->status != 2) && (($result->application_state == 3) || (($result->application_state == 4)))) {
                                                   echo '<div class="green-text">Approved</div>';
                                                }else if (($result->status == 2) && ($result->application_state == 2) ){
                                                    echo '<div class="red-text">Rejected</div>';                                                    
                                                }else{
                                                    echo '<div class="blue-text">Pending</div>';
                                                } ?> 
                                           </li>
                                           <li class="center status-item">
                                               <div>Government</div>
                                               <div class="circle">4</div>
                                               <?php if (($result->status != 2) && (($result->application_state == 4))) {
                                                   echo '<div class="green-text">Approved</div>';
                                                }else if (($result->status == 2) && ($result->application_state == 4)){
                                                    echo '<div class="red-text">Rejected</div>';                                                    
                                                }else{
                                                    echo '<div class="blue-text">Pending</div>';
                                                } ?>
                                           </li>
                                       </ul> 
                                            <?php 

                                            switch ($result->application_state) {
                                                case 1:
                                                    $level = 'Institution';
                                                    break;
                                                case 2:
                                                    $level = 'Industry';
                                                    break;                                                
                                                default:
                                                    $level = 'Government';
                                                    break;
                                            }
                                            
                                            
                                            if ($result->status == 2) {
                                                echo '<div class="reason-reject">
                                                <p class="center-align mb15">Your application has been Rejected from '.$level.' level</p>
                                                <table>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>'.$result->reject_reason.'</td>
                                                    </tr>
                                                </table>
                                                <p class="center">
                                                    <a href="'.base_url('student/application?item='.urlencode(base64_encode($result->id)).'').'" class="waves-effect waves-light hoverable btn-theme btn mt20"> Resubmit</a>
                                                </p>
                                                </div>';
                                            } ?>
                                       
                                       
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
<script>
    <?php $this->load->view('includes/message'); ?>
</script>
<script>
   


    var app = new Vue({
        el: '#app',
        data: {
            currentpsw: '',
            npsw: '',
            cpsw: ''

        },  

        methods:{
            
        }
    })
</script>
</body>
</html>