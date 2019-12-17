<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
      <h2>Stacked form</h2>
      <form action="<?php echo base_url()?>student/update-password" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="cpswd">Current Password:</label>
          <input type="password" class="form-control" id="cpswd" placeholder="Enter your current password" name="cpswd" required="">
          <span class="error"><?php echo form_error('cpswd'); ?></span>
        </div>
        <div class="form-group">
          <label for="npswd">Password:</label>
          <input type="password" class="form-control" id="npswd" placeholder="Enter password" name="npswd" required="">
          <span class="error"><?php echo form_error('npswd'); ?></span>
        </div>
        <div class="form-group">
          <label for="cn_pswd">Confirm Password:</label>
          <input type="password" class="form-control" id="cn_pswd" placeholder="Confirm password" name="cn_pswd" required="">
          <span class="error"><?php echo form_error('cn_pswd'); ?></span>
        </div>
        
        <div class="form-valdation-error">
          <?php echo ($this->session->flashdata('error'))? '<span class="error">'.$this->session->flashdata('error').'</span>' : '' ?>

          <?php echo ($this->session->flashdata('success'))? '<span class="success">'.$this->session->flashdata('success').'</span>' : '' ?>
          
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </body>
</html>