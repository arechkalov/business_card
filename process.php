<?php
if (($_SERVER['REQUEST_METHOD'] == 'POST') && (!empty($_POST['action']))):

	if (isset($_POST['myname'])) { $myname = $_POST['myname']; }
        if (isset($_POST['email'])) { $email = $_POST['email']; }
	if (isset($_POST['comment'])) {
			$comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING ); 
	}

	if (isset($_POST['ajaxrequest'])) { $ajaxrequest = $_POST['ajaxrequest']; }

	$formerrors = false;

	if ($myname === '') :
		$err_myname = '<div class="error">Sorry, your name is a required field</div>';
		$formerrors = true;
	endif; // input field empty

        if ($email === '') :
		$err_email = '<div class="error">Sorry, your e-mail is a required field</div>';
		$formerrors = true;
	endif; // input field empty


  $formdata = array (
    'myname' => $myname,
    'email' => $email,
    'comment' => $comment,

  );

	if (!($formerrors)) :
		$to				= 	"youremail@yourdomain.com";
		$subject	=		"From $myname -- Signup Page";
		$message	=		json_encode($formdata);

		$replyto	=		"From: fromprocessor@iviewsource.com \r\n".
									"Reply-To: donotreply@iviewsource.com \r\n";

		if (mail($to, $subject, $message)):
			$msg = "Thanks for filling out our form";
			if ( $ajaxrequest ) :
				echo "<script>$('#target').before('<div id=\"formmessage\"><p>Thanks for filling out our form. An email has been sent with your request</p></div>'); $('#target').hide();</script>";
		  endif;
		else:
			$msg = "Problem sending the message";
		endif; // mail form data

	endif; // check for form errors

endif; //form submitted
?>

