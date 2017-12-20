<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $user; ?> Job Request</title>
  </head>
  <style media="screen">
    .button{
      padding: 6px 12px;
      color: #FFFFFF;
      background-color: #5cb85c;
    }
  </style>
  <body>
    
    <h3>Hi, <?php echo $builder['name']; ?></h3>
    
    <p>The user <strong><?php echo $user; ?></strong> already assign to a job to <strong><?php echo $job; ?></strong></p>
    
    <p>Access your account to accept the job offer.</p>
    
    <p><a class="button" href="http://hardworkinghire.herokuapp.com/allocation/<?php echo $allocation; ?>/allocated">Accept</a></p>
    
    <p>Regards,</p>
    
    <p>Hardworking Hire.</p>
    
  </body>
</html>