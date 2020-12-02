<?php

	$errors = array();
	$conn = mysqli_connect('localhost','uafcdobw_siseko','@Househome40','uafcdobw_registerPerson');
	if(!$conn){
		echo 'Connection error' . mysqli_connect_error();
	}
	// Check if name has been entered
	if (!isset($_POST['name'])) {
		$errors['name'] = 'Please enter your name';
	}

	// Check if email has been entered and is valid
	if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = 'Please enter a valid email address';
	}

	//Check if message has been entered
	if (!isset($_POST['surname'])) {
		$errors['surname'] = 'Please enter your message';
	}
	if (!isset($_POST['people'])) {
		$errors['people'] = 'Please enter the number of people you coming with';
	}
	if (!isset($_POST['date'])) {
		$errors['date'] = 'Please enter the date you registering for';
	}
	$errorOutput = '';

	if(!empty($errors)){

		$errorOutput .= '<div class="alert alert-danger alert-dismissible" role="alert">';
 		$errorOutput .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

		$errorOutput  .= '<ul>';

		foreach ($errors as $key => $value) {
			$errorOutput .= '<li>'.$value.'</li>';
		}

		$errorOutput .= '</ul>';
		$errorOutput .= '</div>';

		echo $errorOutput;
		die();
	}



	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email =  mysqli_real_escape_string($conn, $_POST['email']);
	$surname = mysqli_real_escape_string($conn, $_POST['surname']);
	$cellNumber =  mysqli_real_escape_string($conn, $_POST['phone']);
	$people =  mysqli_real_escape_string($conn, $_POST['people']);
	$date =  mysqli_real_escape_string($conn, $_POST['date']);


	$result = '';
	$sql = "INSERT INTO user_registration(name,surname,email,mobile_number,Date_booked,	num_people) VALUES('$name','$surname','$email','$cellNumber','$date','$people')";

	//save to db
	$result = '';
	if(mysqli_query($conn,$sql)){
	$result .= '<div class="alert alert-success alert-dismissible" role="alert">';
 		$result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		$result .= 'Thank You! For registering, we will get in touch with you';
		echo $result;
		header("Location: r.html");
	
	}else{
		echo 'query error: ' . mysqli_error($conn);
	}

	//send email
	$from = $email;
	$to = 'siphomahlangu37@gmail.com';  // please change this email id
	$subject = 'Church registration Booking : Website';
      
	$body = "From: E-Mail:  $email\n Name: $name\n Surname: $surname\n Mobile: $cellNumber\n Date: $date\n Time: $time\n Number of people: $people";

	$result = '';
	if (mail ($to, $subject, $body, $headers)) {

		die();
	}

	$headers = "From: ".$from;

	$result = '';
	$result .= '<div class="alert alert-danger alert-dismissible" role="alert">';
	$result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	$result .= 'Something bad happend during sending this message. Please try again later';
	$result .= '</div>';

	echo $result;
