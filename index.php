<?php

  // Check If User Coming From A Request

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assign Variables

    $user = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $mail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $cell = filter_var($_POST['cellphone'], FILTER_SANITIZE_NUMBER_INT);
    $msg = filter_var($_POST['message'], FILTER_SANITIZE_STRING);



      // Creat Array of Errors

      $formErrors = array();

      if (strlen($user) <= 3) {
        $formErrors[] = 'User name must be larger than <strong>3</strong> characters';
      }

      if (strlen($msg) < 10) {
        $formErrors[] = 'Message Can\'t be less than <strong>10</strong> character' ;
      }
	  
	  
	  // If No Errors Send The Email [mail();]
	  
	  $myEmail = 'majdelhm@gmail.com';
	  $subject = 'Contact Form';
	  
	  if(empty($formErrors)){
		  
		  mail($myEmail , $subject , $msg);
		  
		  $user = '';
		  $mail = '';
		  $cell = '';
		  $msg = '';
		  
		  $success = '<div class="alert alert-success"> We Have Recieved Your Message</div>';
	  }
 

  }







?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/all.css">
  <link rel="stylesheet" href="./css/fontawesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,700,900,900i&display=swap">
  <link rel="stylesheet" href="css/stylee.css">
  <title>Contact Form</title>
</head>
<body>

  <!-- Start Form -->

  
  <div class="container">
      <h1 class="text-center">Contact Us</h1>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="contact-form">

        <?php if (! empty($formErrors )) { ?>

        <div class="alert alert-danger alert-dismissible" role="start">
          <button type="button" class="close" data-dismiss="alert" aria-label="close"> 
            <span aria-hidden="true">&times;</span> 
          </button>

            <?php
              foreach($formErrors as $errors) {
                echo $errors.'<br>';
              }

              ?>
        </div>
            <?php } ?>
		<?php if(isset($success)){ echo $success; } ?>
     
      <div class="form-group">
        <input
          class="form-control"
          type="text"
          name="username"
          placeholder="Type Your Username"
          value="<?php if(isset($user)){ echo $user; } ?>"
        >
        <i class="fa fa-user fa-fw"></i>
        <span class="aster">*</span>
      </div>

      <div class="form-group">
        <input 
          class="form-control" 
          type="email" name="email" 
          placeholder="Please Type a Valid Email"
          value="<?php if(isset($mail)){ echo $mail; } ?>"
        >
        <i class="fa fa-envelope fa-fw"></i>
        <span class="aster">*</span>
      </div>
      <input 
        class="form-control" 
        type="text" name="cellphone" 
        placeholder="Type Your Cell Phone"
        value="<?php if(isset($cell)){ echo $cell; } ?>"
      >
      <i class="fa fa-phone fa-fw"></i>
      

      <textarea 
        class="form-control"
        placeholder="Your Message!"
        name="message"><?php if(isset($msg)){ echo $msg; } ?></textarea>

      <input type="submit" class="btn btn-success" value="Send Message">
      <i class="fa fa-paper-plane fa-fw send-icon" aria-hidden="true"></i>
      
    </form>
  </div>

  <!-- End Form -->



	  <script src="./js/jquery-3.4.1.min.js"></script>
	  <script src="./js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>