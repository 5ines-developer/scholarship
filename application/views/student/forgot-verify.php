<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Account verification - Scholarship</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
      <h2>OTP verification</h2>
      <form action="<?php echo base_url()?>student/forgot-verify" method="post" enctype="multipart/form-data" id="otpform">
        <div class="form-group">
          <label for="otp">OTP:</label>
          <input type="text" class="form-control" id="otp" placeholder="Enter otp" name="otp" required="">
          <input type="hidden" id="phone" name="phone" value="<?php echo $phone ?>" />
          <span class="error"><?php echo form_error('otp'); ?></span>
        </div>
        <div class="form-valdation-error">
          <?php echo ($this->session->flashdata('error'))? '<span class="error">'.$this->session->flashdata('error').'</span>' : '' ?>

          <?php echo ($this->session->flashdata('success'))? '<span class="success">'.$this->session->flashdata('success').'</span>' : '' ?>
          
        </div>
        <p id="paswrd-error" class="error required"></p>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>

    <script>
      $(document).ready(function() {
        $("#otpform").on('submit', function(event) {
            event.preventDefault();
            var otp   = $("#otp").val();
            var phone = $("#phone").val();
            var max = '3';
            if (otp == '') {
                return false;
            } else {
              $.ajax({
                  url: "<?php echo base_url();?>student/forgot_verify",
                  type: "get",
                  dataType: "html",
                  data: {"otp": otp, 'phone': phone },
                  success: function(data) {

                    if (data == otp) {
                      location.href = "<?php echo base_url('forgot-password')?>"
                    }else if (data < '3' && data >= '1') {
                      $("#paswrd-error>span").remove();
                      $("#paswrd-error").append("<span>You have entered invalid OTP, You have only " + (
                                    max - data) + " attempts left</span>");
                    }else{
                          $('#my_div').html(data);
                          $('body').html(data);
                        }

                  }
              });

            }

          });
      });

    </script>
  </body>
</html>