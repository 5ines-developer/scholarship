<?php

echo "<pre>";
print_r ($result);
echo "</pre>";

 ?>
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
                    <div class="col offset-l2 s12 m8">
                        <div class="formd-reg">
                            <div class="form-receipt">
                                <h3>FORM -'D'</h3>
                                <p>STATEMENT OF EMPLOYER'S AND EMPLOYEE'S CONTRIBUTION TO BE SENT BY THE EMPLOYER BY 15th JANUARY EVERY YEAR</p>
                            </div>
                            <!-- address detail -->
                            <div class="addre-pps">
                                <div class="row">
                                    <div class="col l12">
                                        <div class="table-form">
                                            <table class="table-pp ">
                                                <thead>
                                                    <tr>
                                                        <th width="70px">S.No</th>
                                                        <th>Title</th>
                                                        <th>Description</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Name & Address of the Establishment Total no. of units to be mentioned</td>
                                                        <td>Answer.....................</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Name of the Employers</td>
                                                        <td>Answer.....................</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Total No. of the Employees Whose Name & stand in the Establishment Register as on 31<sup>st</sup>December</td>
                                                        <td>Answer.....................</td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Employees Contribution @Rs.20</td>
                                                        <td>Answer.....................</td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>Employer's Contribution @Rs. 40</td>
                                                        <td>Answer.....................</td>
                                                    </tr>
                                                    <tr>
                                                        <td>6</td>
                                                        <td>Total No. of the Items 4 & 5</td>
                                                        <td>Answer.....................</td>
                                                    </tr>
                                                    <tr>
                                                        <td>7</td>
                                                        <td>Wether the Contribution is sent by Payment in favour of the Welfare Commissioner, Banglore</td>
                                                        <td>Answer.....................</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <div class="row">
                                                <div class="col l6 m6 s12">
                                                    <div class="place-date">
                                                        <p><b>Place :</b> Banglore</p>
                                                        <p><b>Date :</b> 12-12-2019</p>
                                                    </div>
                                                </div>
                                                <div class="col l6 m6 s12">
                                                    <div class="sign-emp">
                                                        <img src="<?php echo $this->config->item('web_url') ?>assets/image/sign.png" class="img-responsive sign-w
                                                        " alt="">
                                                        <h2>Signature of Employer And seal</h2>
                                                    </div>
                                                </div>
                                                <div class="col l12 m12 s12">
                                                    <div class="form-note">
                                                        <h6>Note :-</h6>
                                                        <ol>
                                                            <li>NEFT State Bank of India SB A/c No:30428019173 IFSC Code SBIN0040605 Mathikere Road Branch</li>
                                                            <li>Syndicate Bank A/c No:04282010181335 IFSC Code SYNB0000428,Yeshwanthpura,Banglore.</li>
                                                        </ol>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- End Body form  -->

        <!-- End Body form  -->
        <!-- footer -->
        <?php $this->load->view('include/footer'); ?>
        <!-- End footer -->
    </div>



    <!-- scripts -->
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems, {
                preventScrolling: false
            });
        });

        var app = new Vue({
            el: '#app',
            data: {
                disabled: false

            },
            mounted() {

            },
            methods: {
                SelectFile(type) {
                    this.type = type;
                    this.$refs.fileInput.click()
                },
                upload(e) {
                    const file = e.target.files[0];
                    formData = new FormData();
                    formData.append('file', file);
                    formData.append('type', this.type);

                    if (this.type == 'regfile') {
                        this.certificate = URL.createObjectURL(file);
                    } else if (this.type == 'signature') {
                        this.signature = URL.createObjectURL(file);
                    } else {
                        this.seal = URL.createObjectURL(file);
                    }

                    axios.post('<?php echo base_url() ?>institute-doc', formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then(function(response) {
                            var msg = response.data.msg;
                            M.toast({
                                html: msg,
                                classes: 'green darken-2'
                            });
                            self.disabled = true;
                        })
                        .catch(function(error) {
                            var msg = error.response.data.msg;
                            M.toast({
                                html: msg,
                                classes: 'red darken-4'
                            });
                        })
                }
            }
        })
    </script>
</body>

</html>