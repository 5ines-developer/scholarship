<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scholarship</title>
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/materialize.min.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/select2.css">
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

                    <div class="col s12 m9">
                        <div class="card  darken-1">
                            <div class="card-content bord-right">
                                <span class="card-title">Rejected Scholarship  Application  ({{tableRow.length}})</span>
                                <div class="board-content hb">
                                    <div class="row m0">
                                        <table class="vue-data-table row-click">
                                            <thead class="thead-list">
                                                <tr>
                                                    <th @click="sorting(i)" v-for="(heading , i) in tableHeading" :class="{'sorting': heading.sorting}">{{heading.title}}</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody class="tbody-list gb">
                                                <tr v-for="(item , k) in tableRow" :key="k" @click="detail(item.id)">
                                                    <td :data-label="tableHeading[0].title">{{k + 1}}</td>
                                                    <td :data-label="tableHeading[1].title">{{item.name}}</td>
                                                    <td :data-label="tableHeading[2].title">{{item.mark}}</td>
                                                    <td :data-label="tableHeading[3].title">{{item.course}} {{item.class}}</td>
                                                    <td :data-label="tableHeading[4].title"><a :href="'<?php echo base_url()?>student/'+item.id " class="waves-effect waves-light">view</a></td>
                                                </tr>
                                                <tr v-if="tableRow.length == 0">
                                                    <td colspan="5">No data found</td>
                                                </tr>
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
           tableHeading: [
               { title :'Sl No.', sorting: false },
               { title :'Name', sorting: false },
               { title :'Marks', sorting: false },
               { title :'Present Class', sorting: false },
               { title :'Action', sorting: false },
           ],
           tableRow: [],
        },  
        mounted(){
            this.getData();
        },
        methods:{
            sorting(key){
                console.log(this.tableRow);
            },

            detail(id){
                var url = '<?php echo base_url() ?>student/' + id;
                window.location = url;
            },

            getData(){
                var self= this;
                axios.get('<?php echo base_url() ?>student-rejects')
                .then(function (response) {
                    self.tableRow = response.data
                })
                .catch(function (error) {
                })
            }
        }
    })
</script>
</body>
</html>