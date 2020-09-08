<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scholarship</title>
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/materialize.min.css">
    <link  rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/material-icons.css">
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

                                <div class="title-list ">
                                    <span class="list-title ">Scholarship  Application Request ({{tableRow.length}})</span>
                                    <select class="browser-default" id="short" @change="yearChange()" v-model="year">
                                        <option value="">Choose Year</option>
                                        <?php $yr = $this->input->get('year');
                                            for($i=date('Y'); $i>= 2000; $i--){ 
                                                    $year = $i;
                                            ?>
                                            <option value="<?php echo $year ?>" <?php if($year == $yr){ echo 'selected="true"'; } ?> ><?php echo $year ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="board-content hb">
                                    <div class="row m0">
                                        <table class="vue-data-table row-click">
                                            <thead class="thead-list">
                                                <tr>
                                                    <th @click="sorting(i)" v-for="(heading , i) in tableHeading" :class="{'sorting': heading.sorting}">{{heading.title}}</th>
                                                </tr>
                                            </thead>
                                            <tbody class="tbody-list gb">
                                                <tr v-for="(item , k) in tableRow" :key="k" @click="detail(urlenc(item.id))">
                                                    <td>{{k + 1}}</td>
                                                    <td>{{item.name}}</td>
                                                    <td>{{item.mark}} %</td>
                                                    <td>{{item.course}}{{item.class}}</td>
                                                    <td>{{item.amount}}</td>
                                                    <td>{{item.application_year}}</td>
                                                    <td>{{item.date}}</td>
                                                    <td><a :href="'<?php echo base_url()?>student/'+urlenc(item.id) " class="waves-effect waves-light">view</a></td>
                                                </tr>
                                                <tr v-if="tableRow.length == 0">
                                                    <td colspan="8">No data found</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!-- <div class="row m0">
                                            <div class="col s12 m6">
                                                <small>Showing 0 to 10 of 15 Entries</small>
                                            </div>
                                            <div class="col s12 m6 ">
                                                <ul class="pagination right">
                                                    <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                                                    <li class="active"><a href="#!">1</a></li>
                                                    <li class="waves-effect"><a href="#!">2</a></li>
                                                    <li class="waves-effect"><a href="#!">3</a></li>
                                                    <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
                                                </ul>
                                            </div>
                                        </div> -->
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
<script src="<?php echo $this->config->item('web_url')?>assets/js/axios.min.js"></script>
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
               { title :'Amount', sorting: false },
               { title :'Year', sorting: false },
               { title :'Applied Date', sorting: false },
               { title :'Action', sorting: false },
           ],
           tableRow: [],
           year: '<?php echo $this->input->get('year') ?>',
        },  
        mounted(){
            this.getData();
        },
        methods:{
            sorting(key){
                console.log(this.tableRow);
            },
            urlenc(id){
                var enc = btoa(id);
                return enc;
            },
            detail(id){
                var url = '<?php echo base_url() ?>student/' + id;
                window.location = url;
            },

            getData(){
                var self= this;
                axios.get('<?php echo base_url() ?>scholarship-request?year='+ self.year)
                .then(function (response) {
                    self.tableRow = response.data
                })
                .catch(function (error) {
                })
            },yearChange() {
                    window.location.href = "<?php echo base_url('dashboard?year=') ?>" + this.year;
                },
        }
    })
</script>
</body>
</html>