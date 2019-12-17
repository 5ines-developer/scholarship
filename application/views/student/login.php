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
      <form action="<?php echo base_url()?>student/login-check" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="text" class="form-control" id="email" placeholder="Enter your email or phone no." name="username" required="">
          <span class="error"><?php echo form_error('username'); ?></span>
        </div>
        <div class="form-group">
          <label for="pswd">Password:</label>
          <input type="password" class="form-control" id="pswd" placeholder="Enter password" name="pswd" required="">
          <span class="error"><?php echo form_error('pswd'); ?></span>
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