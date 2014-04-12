<?php
// Check for a form submission.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Threshold
  $th = 5;

  // Stores when the contact form was displayed to the user for the first time.
  $time1 = $_POST['time1'];

  // Stores when the conctact form was submitted by the user.
  $time2 = time();

  // Receiver or receivers of the email.
  $to = 'user@example.com';

  // Subject of the email to be sent.
  $subject = '[Site Feedback] ' . $_POST['subject'];

  // Message to be sent.
  $message = wordwrap($_POST['message'], 70, "\r\n");

  // Headers
  $headers = 'From: ' . $_POST['name'] . ' <' . $_POST['email'] . '>';

  if ($time2 - $time1 >= $th) {

    $delivery = mail($to, $subject, $message, $headers);

    if ($delivery) {

      $msg = '<div class="alert alert-success">The message was successfully accepted for delivery.</div>';

    } else {

      $msg = '<div class="alert alert-warning">The message was not successfully accepted for delivery. Please try again.</div>';

    }

  } else {

    $msg = '<div class="alert alert-danger">There was an error!</div>';

  }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- saved from url=(0014)about:internet -->
<meta charset="utf-8" />
<title>Demo - How to avoid fake feedback messages without a captcha field</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!-- Bootstrap -->
<link href="css/bootstrap.css" rel="stylesheet" />
<style type="text/css">
.container {
	margin-top: 5px;
}

@media (min-width: 992px){
  h2, p, .contact-box {
    margin-left: 20px;
  }

  span {
    color: rgb(204,0,0);
  }
}
</style>
<script src="js/validation.js"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
</head>

<body>
  <div class="container">
    <div class="jumbotron">
      <h1>How to avoid fake feedback messages without a captcha field</h1>
      <p class="lead">This contact form is able to avoid fake feedback messages without the use of a captcha field. It uses a new technique based on how much time you take to fill it out.</p>
    </div>
    <h2>Contact</h2>
    <p>The threshold for this contact form is 5 seconds. If the user takes five seconds or fewer to fill out the form, the script will flag the email as a junk mail because a true user wouldn't be able to fill out the contact form in less than/or in five seconds.</p>
    <div class="row">
      <div class="col-md-5 contact-box">
        <?php if ($msg) { echo $msg; } ?>
        <form action="index.php" method="post" onSubmit="return validateForm()" name="contact_form">
          <div class="form-group">
            <label for="name">Your name<span> *</span></label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name" />
          </div>
          <div class="form-group">
            <label for="email">Your email<span> *</span></label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" />
          </div>
          <div class="form-group">
            <label for="subject">Subject<span> *</span></label>
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Enter the subject of your email" />
          </div>
          <div class="form-group">
            <label for="message">Message<span> *</span></label>
            <textarea class="form-control" name="message" id="message" rows="5" placeholder="Enter your message"></textarea>
          </div>
          <input type="hidden" name="time1" id="time1" value="<?php echo time(); ?>" />
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
      </div><!-- End of .row -->
    </div><!-- End of .contact-box -->
  </div><!-- End of .container -->
</body>
</html>
