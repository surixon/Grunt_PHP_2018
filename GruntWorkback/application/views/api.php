<?php
include_once('config.php');
include('PHPMailer/PHPMailerAutoload.php'); 
$action=$_REQUEST['action'];
switch($action)
{
	
  case 'social_login':
		social_login();
		break;
			
  case 'profile':
		profile();
		break;	
		
  case 'profile_update':
	    profile_update();
	    break;
	
  case 'employerProfileUpdate':
	    employerProfileUpdate();
	    break;	
	    
  case 'employeeProfileUpdate':
	    employeeProfileUpdate();
	    break;	
		
  case 'register':
		register();
		break;	
		
  case 'login':
		login();
		break;	
		
  case 'forgot_password':
		forgot_password();
		break;
		
  case 'changepassword':
		changepassword();
		break;	
		
  case 'get_logs':
		get_logs();
		break;
			
  case 'getJobsList':
		getJobsList();
		break;
		
  case 'jobPost':
		jobPost();
		break;
		
  case 'myJobs':
       	myJobs();
       	break;
       	
  case 'getEmployerJobs':
       	getEmployerJobs();
       	break;
       	
  case 'jobApply':
       	jobApply();
       	break; 
       	
  case 'getJobDetails':
       	getJobDetails();
       	break; 
       	
  case 'getEmployerProfile':
       	getEmployerProfile();
       	break;
       	
  case 'getEmployeeProfile':
       	getEmployeeProfile();
       	break;
       	
  case 'deleteJob':
       	deleteJob();
       	break; 
       	
  case 'getApplicantsDetail':
       	getApplicantsDetail();
       	break; 
       	
  case 'updateImage':
       	updateImage();
       	break; 
       	
  case 'getImageAndName':
       	getImageAndName();
       	break;   			
	
	
  case 'hireEmployee':
       	hireEmployee();
       	break;	
       	
  case 'getJobOffer':
       	getJobOffer();
       	break;
       	
  case 'getUserName':
       	getUserName();
       	break; 
       	
  case 'jobStatus':
       	jobStatus();
       	break;		
   
  case 'createStripeToken':
       	createStripeToken();
       	break;
       		
  case 'stripe_payment':
       	stripe_payment();
       	break;
       	
  case 'confirmJob':
       	confirmJob();
       	break;
       	
  case 'cancelJob':
       	cancelJob();
       	break;
       	
  case 'completeJob':
       	completeJob();
       	break;	 
       	  
  case 'employeeJobProgress':
       	employeeJobProgress();
       	break;	
       	
  case 'employerJobProgress':
       	employerJobProgress();
       	break;	
       	
      
  case 'jobHistory':
       	jobHistory();
       	break;
       	
  
  case 'jobRating':
       	jobRating();
       	break;
       	
        
  case 'getStripeToken':
        getStripeToken();
        break;
        
  case 'workHistory':
        workHistory();
        break;  
            
  case 'ios_noti':
        ios_noti();
        break;   
           
  case 'test_noti':
        test_noti();
        break; 
             
  case 'android_noti':
        android_noti();
        break; 
             
  case 'android_noti1':
        android_noti1();
        break; 
             
  case 'jobSearch':
        jobSearch();
        break;
              
  case 'upload_image':
        upload_image();
        break; 
             
  case 'send_email':
        send_email();
        break;      
        
  case 'userStat':
        userStat();
        break;      
     	         	     	  	   
}


//http://traala.com/gruntwork/api.php?action=social_login&social_id=123&firstname=a&lastname=b&email=abc@gmail.com&user_type=2&device_type=I&device_token=rhrh
function social_login()
{
	global $pdo;
	extract($_REQUEST);
	$query="select * from register where social_id=:social_id";
	$stmt=$pdo->prepare($query);
	$array=array(':social_id'=>$social_id);
	$stmt->execute($array);
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	
	if(empty($row))
	{
		$query_insert="insert into register(social_id,fullname,email,user_type,device_type,device_token)
		               values(:social_id,:fullname,:email,:user_type,:device_type,:device_token)";
		$stmt_insert=$pdo->prepare($query_insert);  
		$array_insert=array(':social_id'=>$social_id,
		                    ':fullname'=>$firstname . ' ' . $lastname,
		                    ':email'=>$email,
		                    ':user_type'=>$user_type,
		                    ':device_type'=>$device_type,
		                    ':device_token'=>$device_token
		                    ); 
		$stmt_insert->execute($array_insert);
		if($stmt_insert->rowCount() && $device_type!='' && $device_token!='')
		{
			 $json=array('user_id'=>$pdo->lastInsertId(),'message'=>'Login successfull');
		     $status='1';
		     $message='success';
		}
		else
		{
		     $json=array('user_id'=>"-2" ,'message'=>'server error');
		     $status='1';
		     $message='success';
		}
	}
	else
	{
		$query_upt="update register set device_type=:device_type,device_token=:device_token where social_id=:social_id";     	           
		$stmt_upt=$pdo->prepare($query_upt);
		$array_upt=array(':social_id'=>$social_id,
		                 ':device_type'=>$device_type,
		                 ':device_token'=>$device_token
		                );
		$stmt_upt->execute($array_upt);
		
		$status='1';
		$message='login successfully';
		$json=array('user_id'=>$row['user_id'],'user_type'=>$user_type);                
	}
	    $json=array('message'=>$message,'status'=>$status,'data'=>$json);
	    echo "{\"response\":" . json_encode($json) . "}";
}


//http://traala.com/gruntwork/api.php?action=profile&user_id=1&user_type=1
function profile()
{
   global $pdo;
   extract($_REQUEST);
   $query="select * from register where user_id=:user_id and user_type=:user_type";
   $stmt=$pdo->prepare($query);
   $array=array(':user_id'=>$user_id,':user_type'=>$user_type);
   $stmt->execute($array);
   $row=$stmt->fetch(PDO::FETCH_ASSOC);
   
   if(!empty($row))
   {
	  $json=array('message'=>'success','status'=>'1','data'=>$row);
   }
   else
   {
	  $json=array('message'=>'success','status'=>'1','data'=>''); 
   }
   echo "{\"response\":" . json_encode($json) . "}";
}
//http://traala.com/gruntwork/api.php?action=register&email=g@gmail.com&password=123&firstname=gou&lastname=sa&dob=14-12-1990&country=Ind&device_type=A&device_token=123&gruntwork_use=abc&user_type=2
function register()
{
	global $pdo;
	extract($_REQUEST);
	$query="select * from register where email=:email";
	$stmt=$pdo->prepare($query);
	$array=array(':email'=>$email);
	$stmt->execute($array);
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	if(empty($row))
	{
		$query_insert="insert into register(email,password,fullname,dob,country,device_type,device_token,gruntwork_use,user_type) values(:email,:password,:fullname,:dob,:country,:device_type,:device_token,:gruntwork_use,:user_type)";
		$stmt_insert=$pdo->prepare($query_insert);
		$array_insert=array(':email'=>$email,':password'=>$password,':fullname'=>$firstname .' '. $lastname,':dob'=>$dob,':country'=>$country,':device_type'=>$device_type,':device_token'=>$device_token,':gruntwork_use'=>$gruntwork_use,':user_type'=>$user_type);
		$stmt_insert->execute($array_insert);
		if($stmt_insert->rowCount())
		{
		  $json=array('user_id'=>$pdo->lastInsertId(),'username'=>$firstname .' '. $lastname,'message'=>'Register successfully');
		  $status='1';
		  $message='success';
	    }
	    else
	    {
		   
		  $json=array('user_id'=>'-2','message'=>'server error');
		  $status='0';
		  $message='failure';
	    }
	 }
	 else
	 {
		  $json=array('user_id'=>'-1','message'=>'User already exist');
		  $status='1';
		  $message='success'; 
	 }
	 $json=array('message'=>$message,'status'=>$status,'data'=>$json);
	 echo "{\"response\":" . json_encode($json) . "}";
}

//http://traala.com/gruntwork/api.php?action=login&email=g@gmail.com&user_type=1&password=123&device_token=asdasd&device_type=I
function login()
{
	global $pdo;
	extract($_REQUEST);
	$data=array();
	$query="select * from register where email=:email AND user_type=:user_type";
    $stmt=$pdo->prepare($query);
    $array=array(':email'=>$email,':user_type'=>$user_type);
    $stmt->execute($array);
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    //~ echo"<pre>";print_r($row);"</pre>";
    //~ die;
    if(empty($row))
    {
	   $status='0';
	   $message='Invalid E-mail Id';
	}
	else
	{
	    if($row['password']==$password)
	    {
			$qry="update register set device_token=:device_token,device_type=:device_type where user_id=:user_id";
			$stmt_qry=$pdo->prepare($qry);
			$arr=array(':device_token'=>$device_token,':device_type'=>$device_type,':user_id'=>$row['user_id']);
			$stmt_qry->execute($arr);
			
			$status='1';
			$message='Login Successfully';
			$data= array('user_id'=>$row['user_id'],'user_type'=>$user_type,'username'=>$firstname .' '. $lastname);
			
		}
		else
		{	
		    $status='0';
	        $message='Invalid Password';
		}	
	}
	$json=array('message'=>$message,'status'=>$status,'data'=>$data);
	echo "{\"response\":" . json_encode($json) . "}";
}


//http://traala.com/gruntwork/api.php?action=forgot_password&email=gouravs@appzorro.com
function forgot_password()
{
	global $pdo;
	extract($_REQUEST);
	$query="select * from register where email=:email";
    $stmt=$pdo->prepare($query);
    $array=array(':email'=>$email);
    $stmt->execute($array);
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    //~ echo"<pre>";print_r($row);"</pre>";
    //~ die;
	if($row)
	{
		if(!empty($row['password']))
		{
			$to =$email;
			$subject = 'Forgot Password';
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset: utf8\r\n";
			$headers .= "From: <gouravs@appzorro.com>";
			$message = "<html><head></head><body>Hello ".$row['fullname']."<br>Your password is : ".$row['password']."</body></html>";
			
			$mail = new PHPMailer;
			$mail->CharSet = 'UTF-8';
			$mail->isSMTP();
			$mail->Host = 'mail.appzorro.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'gouravs@appzorro.com';
			$mail->Password = 'Zt{t6-Pd)$Ez';
			$mail->SMTPSecure = 'STARTTLS';
			$mail->Port = 587;
			$mail->setFrom('gouravs@appzorro.com', 'Gruntwork');
			$mail->addReplyTo($email);

			// Add a recipient
			$mail->addAddress($email);
			$mail->Subject = 'Forgot Password';
		   
			// Set email format to HTML
			$mail->isHTML(true);

			// Email body content
			$mailContent = "<html><head></head><body>Hello ".$row['fullname']."<br>Your password is : ".$row['password']."</body></html>";
			$mail->Body = $mailContent;
		    if(!$mail->send()) 
		    {
			   $json=array('status'=>'0','message'=>"Some server error.Try gain!");
			   echo 'Mailer Error: ' . $mail->ErrorInfo;
		    } 
		    else 
		    {
			   $json=array('status'=>'1','message'=>"Your password has been sent to your email-id.");
		    }
	   }
	}   
	else
	{
		$json=array('status'=>'0','message'=>"Email-Id does not exist");   	    	
	}
	echo "{\"response\":" . json_encode($json) . "}";
}


//http://traala.com/gruntwork/api.php?action=changepassword&user_id=1&oldpassword=pw&newpassword=0987
function changepassword()
{
	global $pdo;
	extract($_REQUEST);
	$stmt=$pdo->prepare("select * from register where password=:oldpassword and user_id=:user_id");
	$stmt->execute(array(':oldpassword'=>$oldpassword,':user_id'=>$user_id));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	//~ echo"<pre>";print_r($row);"</pre>";
	//~ die;
	if($row['password']!=$oldpassword)
	{
		$json=array('user_id'=>'-1','message'=>'invalid oldpassword');
		$status='1';
		$message='success';
	}
	else
	{
		$stmt1=$pdo->prepare("update register set password=:newpassword where user_id=:user_id");
		$stmt1->execute(array(':newpassword'=>$newpassword,':user_id'=>$user_id));
		
		$json=array('user_id'=>$row['user_id'],'message'=>'password changed');
		$status='1';
		$message='success';
	}
	    $json=array('message'=>$message,'status'=>$status,'data'=>$json);
	    echo "{\"response\":" . json_encode($json) . "}";	
}


//http://traala.com/gruntwork/api.php?action=profile_update&user_id=101&user_type=1&firstname=gou&lastname=ar&email=anu@gmail.com&gender=male&dob=123&country=INDIA
function profile_update()
{
	global $pdo;
	extract($_REQUEST);
	$query="select * from register where user_id=:user_id and user_type=:user_type";
    $stmt=$pdo->prepare($query);
    $array=array(':user_id'=>$user_id,':user_type'=>$user_type);
    $stmt->execute($array);
    $row=$stmt->fetch(PDO::FETCH_ASSOC); 
    //~ print_r($row);
    //~ die;
	if($row)
	{
		$query_upt="update register set fullname=:fullname,email=:email,gender=:gender,dob=:dob,country=:country where user_id=:user_id";
		$stmt_upt=$pdo->prepare($query_upt);
		$array_upt=array(':user_id'=>$user_id,':fullname'=>$firstname . ' ' . $lastname,':email'=>$email,':gender'=>$gender,':dob'=>$dob,':country'=>$country);
	    $stmt_upt->execute($array_upt);
	    
	    $json['user_id']=$row['user_id'];
	    $json['message']="update successfully";
	    $status='1';
	    $message='success';
	}
	else
	{
		$json['user_id']="-1";
	    $json['message']="no record found";
	    $status='0';
	    $message='success';
	}
	    $json=array('message'=>$message,'status'=>$status,'data'=>$json);
	    echo "{\"response\":" . json_encode($json) . "}";
}

//http://traala.com/gruntwork/api.php?action=employerProfileUpdate&user_id=1&user_type=1&skills=bca&previous_experience=1year&job_prefrence_for_employers=dfgg
function employerProfileUpdate()
{
    global $pdo;
    extract($_REQUEST);
    $query="select * from register where user_id=:user_id and user_type=:user_type";
    $stmt=$pdo->prepare($query);
    $array=array(':user_id'=>$user_id,':user_type'=>$user_type);
    $stmt->execute($array);
    $row=$stmt->fetch(PDO::FETCH_ASSOC);  
	if($row)
	{
		
			$query_upt="update register set skills=:skills,previous_experience=:previous_experience,
						job_prefrence_for_employers=:job_prefrence_for_employers where user_id=:user_id";
						
			$stmt_upt=$pdo->prepare($query_upt);
			$array_upt=array(':user_id'=>$user_id,
							 ':skills'=>$skills,
							 ':previous_experience'=>$previous_experience,
							 ':job_prefrence_for_employers'=>$job_prefrence_for_employers
							);
			$stmt_upt->execute($array_upt);
			$json['user_id']=$row['user_id'];
			$json['message']="update successfully";
			$status='1';
			$message='success';
	}
	else
	{
		$json['user_id']="-1";
	    $json['message']="no record found";
	    $status='0';
	    $message='success';
	}
	    $json=array('message'=>$message,'status'=>$status,'data'=>$json);
	    echo "{\"response\":" . json_encode($json) . "}";	
}

//http://traala.com/gruntwork/api.php?action=employeeProfileUpdate&user_id=1&user_type=2&skills=bca&previous_experience=1year&job_prefrence_for_employees=dfgg
function employeeProfileUpdate()
{
    global $pdo;
    extract($_REQUEST);
    $query="select * from register where user_id=:user_id and user_type=:user_type";
    $stmt=$pdo->prepare($query);
    $array=array(':user_id'=>$user_id,':user_type'=>$user_type);
    $stmt->execute($array);
    $row=$stmt->fetch(PDO::FETCH_ASSOC);  
	if($row)
	{
		
			$query_upt="update register set skills=:skills,previous_experience=:previous_experience,
						job_prefrence_for_employees=:job_prefrence_for_employees where user_id=:user_id";
						
			$stmt_upt=$pdo->prepare($query_upt);
			$array_upt=array(':user_id'=>$user_id,
							 ':skills'=>$skills,
							 ':previous_experience'=>$previous_experience,
							 ':job_prefrence_for_employees'=>$job_prefrence_for_employees
							);
			$stmt_upt->execute($array_upt);
			$json['user_id']=$row['user_id'];
			$json['message']="update successfully";
			$status='1';
			$message='success';
	}
	else
	{
		$json['user_id']="-1";
	    $json['message']="no record found";
	    $status='0';
	    $message='success';
	}
	    $json=array('message'=>$message,'status'=>$status,'data'=>$json);
	    echo "{\"response\":" . json_encode($json) . "}";	
}


//~ function rating()
//~ {
	//~ global $pdo;
	//~ extract($_REQUEST);
	//~ $query="select * from rating where rating_to_id=:user_id";
    //~ $stmt=$pdo->prepare($query);
    //~ $array=array(':user_id'=>$user_id);
    //~ $stmt->execute($array);
    //~ $row=$stmt->fetch(PDO::FETCH_ASSOC);
	//~ if($row)
	//~ {
	   //~ $query_insert="insert into rating(rating_from_id,rating_to_id,rating,comments) values (:rating_from_id,:rating_to_id,:rating,:comments)";
	   //~ $stmt_insert=$pdo->prepare($query_insert);
       //~ $array_insert=array(':rating_from_id'=>$rating_from_id,':rating_to_id'=>$rating_to_id,':rating'=>$rating,':comments'=>$comments);  
	   //~ $stmt_insert->execute($array_insert);
       //~ if($stmt_insert->rowCount())
       //~ {
		  //~ $json=array('user_id'=>$pdo->lastInsertId(),'message'=>'Register successfully');
		  //~ $status='1';
		  //~ $message='success';
	   //~ }
	   //~ else
	   //~ {
		  //~ $json=array('user_id'=>'-2','message'=>'server error');
		  //~ $status='0';
		  //~ $message='failure';
		   //~ 
	   //~ }   
	//~ }
//~ }

//http://traala.com/gruntwork/api.php?action=get_logs
function get_logs()
{
    global $pdo;
	extract($_REQUEST);
	$query="select * from logs";
    $stmt=$pdo->prepare($query);
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);	
	if($row)
	{
		$json=array('total_employees'=>$row['total_employees'],
				    'total_employers'=>$row['total_employers'],
				    'jobs_done'=>$row['jobs_done'],
				    'jobs_pending'=>$row['jobs_pending'],
				    'jobs_failed'=>$row['jobs_failed']
		           );  
		  $status='1';
		  $message='success';	
	}
	else
	{
		$json=array();
		$status='0';
		$message='success';	
	}
	$json=array('message'=>$message,'status'=>$status,'data'=>$json);
	echo "{\"response\":" . json_encode($json) . "}";	
}

function noti_user($registrationID,$message_data,$noti_type)
{
  	//Replace with the real server API key from Google APIs
  	if($device_type=='A')
  	{
  	    $apiKey = "AAAA32ATbUc:APA91bGHB6ahlP2GVV7ZCX0E5RymQE4H37nt_F_yYKf8FNfXxktWjVyINYQbrRL9rXhk4X1GpFQGfyggvTnAfiGQF0H33qFOcu6jOLXA0gMwoA1huN-Ai0vy-J7eT2-3p8EZ1WH8U4L8";
		$fields = array(
						'registration_ids'  => array($registrationID),
						'data'              => array("message" => $message_data,
						                             "noti_type" => $noti_type,
						                             )
				   );
	}
	else if($device_type=='I')
	{
		$apiKey='AAAA59Jv2aI:APA91bG9Z5TnGFghgRJecKajPmRKrVIkpDcYrM2uUgVD5OdBy3V5z-_aaJd33k-HD79b_lZm223R-66zEqfLkmmnRT6BhYOw77rHiwW-Odb-JiOM2fCF85nbKrjvX5THwnfKcxcyCyM7';
		$notification = array('title' =>'', 
		                      'text' => $message_data,
							  'noti_type' => $noti_type,
                             
                             );

		//This array contains, the token and the notification. The 'to' attribute stores the token.
		$fields = array('to' => $registrationID,'notification' => $notification,'priority'=>'high');
	}
	$url = 'https://fcm.googleapis.com/fcm/send';
	$headers = array( 
						'Authorization: key=' . $apiKey,
						'Content-Type: application/json'
					);
    $ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_POST, true );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
	$res = curl_exec($ch);
    echo"<pre>";print_r($res);"</pre>";
   
	
   
	if($res===FALSE)
	{
		die('Curl failed: ' . curl_erroe($ch));
	}
	curl_close($ch);	
}

//http://traala.com/gruntwork/api.php?action=jobPost&user_id=1&user_type=1&job_title=php&description=sd&job_type=rhg&duration=tgijh&est_amount=ghg&datetime=09-01-2018,09:00am&location=ind&success_rate=65&bonus=20&rating=4
function jobPost()
{
	global $pdo;
	extract($_REQUEST);
	$query="select * from register where user_id=:user_id and user_type=:user_type";
    $stmt=$pdo->prepare($query);
    $stmt->execute(array(':user_id'=>$user_id,':user_type'=>$user_type));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    if($row)
    {
		
			$query_insert="insert into jobPost(employer_name,employer_id,job_title,description,job_type,duration,est_amount,datetime,location,success_rate,bonus,rating)  
					values (:employer_name,:employer_id,:job_title,:description,:job_type,:duration,:est_amount,:datetime,:location,:success_rate,:bonus,:rating)";
			$stmt_insert=$pdo->prepare($query_insert);
			$array_insert=array(':employer_name'=>$row['fullname'],
			                    ':employer_id'=>$user_id,
			                    ':job_title'=>$job_title,
			                    ':description'=>$description,
			                    ':job_type'=>$job_type,
			                    ':duration'=>$duration,
			                    ':est_amount'=>$est_amount,
			                    ':datetime'=>$datetime,
			                    ':location'=>$location,
			                    ':success_rate'=>$success_rate,
			                    ':bonus'=>$bonus,
			                    ':rating'=>$rating
			                    );
			$stmt_insert->execute($array_insert);
			if($stmt_insert->rowCount())
		    {
			  $json=array('job_id'=>$pdo->lastInsertId(),'message'=>'Job Posted successfully');
			  $status='1';
			  $message='success';
	        }
	        else
	        {
		   
			  $json=array('user_id'=>'-2','message'=>'Some server error..Try again later..!');
			  $status='0';
			  $message='failure';
	        }
				
	}
	else
	{
		    $json=array('job_id'=>'-1','message'=>'no user found');
			$status='0';
			$message='success';
	}	
	    $json=array('message'=>$message,'status'=>$status,'data'=>$json);
	    echo "{\"response\":" . json_encode($json) . "}";
}


//http://traala.com/gruntwork/api.php?action=getJobsList&user_id=1&pageNo=1
function getJobsList()
{
	global $pdo;
	extract($_REQUEST);
    $Size='5';
	$query="select * from jobPost where employer_id=:user_id ORDER BY job_id desc";
	$stmt=$pdo->prepare($query);
	$stmt->execute(array(':user_id'=>$user_id));
	$row=$stmt->fetchAll(PDO::FETCH_ASSOC);
	if($r)
	{
		$totalCount = $stmt->rowCount();
		$total_pages = ceil($totalCount/$Size);
		$page = $pageNo;
		//echo $page;
		if(!isset($page)) 
		{
		 $pageno = 1;
		} 
		else
		{
		 $pageno = $page;
		}
		
		   $starting_limit = ($pageno-1)*$Size;
		   $show  = "SELECT * FROM jobPost where employer_id=:user_id ORDER BY job_id desc LIMIT $starting_limit, $Size";
		   $r = $pdo->prepare($show);
		   $r->execute(array(':user_id'=>$user_id));
		//echo "<pre>";print_r($total_pages);"</pre>";
		//~ die;
		if($r)
		{
			foreach($r as $job)
			{
				$json[]=array(
							'job_id'=>$job['job_id'],
							'employer_name'=>$job['employer_name'],
							'employer_id'=>$job['employer_id'],
							'job_title'=>$job['job_title'],
							'description'=>$job['description'],
							'job_type'=>$job['job_type'],
							'duration'=>$job['duration'],
							'est_amount'=>$job['est_amount'],
							'datetime'=>$job['datetime'],
							'location'=>$job['location'],
							'success_rate'=>$job['success_rate'],
							'rating'=>$job['rating']
							
							);
					$status='1';
					$message='success';
					
		   }
		   $json=array('message'=>$message,'status'=>$status,'total_records'=>$totalCount,'indexNo'=>$total_pages,'data'=>$json);
		}   
		else
		{
			  $json=array( 'status'=>'0','message'=>'No record found');  
		}
   }
   else
   {
	   $json=array( 'status'=>'0','message'=>'No record found');  
   } 
    echo "{\"response\":" . json_encode($json) . "}";	
}

//http://traala.com/gruntwork/api.php?action=myJobs&user_id=13&pageNo=1
function myJobs()
{
	global $pdo;
	extract($_REQUEST);
	$Size='5';
	$query="select  * from jobPost where employer_id=:user_id and (status=0 or status=2) ORDER BY job_id desc";
	$stmt=$pdo->prepare($query);
	$array=array(':user_id'=>$user_id);
	$stmt->execute($array);
	$row=$stmt->fetchAll(PDO::FETCH_ASSOC);
	 //~ echo "<pre>";print_r($row);"</pre>";
	//~ die;
	if($row)
	{
		//PAGINATION
		
		$totalCount = $stmt->rowCount();
		$total_pages = ceil($totalCount/$Size);
		$page = $pageNo;
		
		if(!isset($page)) 
		{
		 $pageno = 1;
		} 
		else
		{
		 $pageno = $page;
		}
		
		
		   $starting_limit = ($pageno-1)*$Size;
		   $show  = "select  * from jobPost where employer_id=:user_id and (status=0 or status=2) LIMIT $starting_limit, $Size";
		   $r = $pdo->prepare($show);
		   $r->execute(array(':user_id'=>$user_id));
		//PAGINATION END
		if($r)
		{
		foreach($r as $value)
		{
			$query1="SELECT count(id) as job_applicants,job_id from job_applicants 
			         where job_id=:job_id";
			$stmt1=$pdo->prepare($query1);
			$array1=array(':job_id'=>$value['job_id']);
			$stmt1->execute($array1);
			$row1=$stmt1->fetch(PDO::FETCH_ASSOC);
			if($row1)
			{
				$json[]=array('applicants'=>$row1['job_applicants'],'job_id'=>$value['job_id'],'job_title'=>$value['job_title'],
						'datetime'=>$value['datetime'],'description'=>$value['description'],
						'est_amount'=>$value['est_amount']);
				$status='1';
				$message='success';
			}
			else
			{
				$json[]=array('job_applicants'=>'0','job_id'=>$value['job_id'],'job_title'=>$value['job_title'],
								'datetime'=>$value['datetime'],'description'=>$value['description'],
							'est_amount'=>$value['est_amount']);
			
				$status='1';
				$message='success';
			}				
				
			}
			  $json=array('message'=>$message,'status'=>$status,'current_page'=>$pageNo,'page_size'=>$Size,'total_records'=>"$totalCount",'last_page'=>"$total_pages",'data'=>$json);
		      echo "{\"response\":" . json_encode($json) . "}";	
       }
       else
       {
	            
				$json=array('message'=>'No record found','status'=>'0');
				echo "{\"response\":" . json_encode($json) . "}";
				
       }
   }
   else
   {
	           $json=array('message'=>'No record found','status'=>'0');
				echo "{\"response\":" . json_encode($json) . "}";
			
   }
		 
 }


//http://traala.com/gruntwork/api.php?action=getEmployerJobs&pageNo=1&search=aa
function getEmployerJobs()
{
	global $pdo;
	extract($_REQUEST);
	$Size='5';
	if($search == '')
	{
					$query="select * from jobPost ORDER BY job_id desc";
					$stmt=$pdo->prepare($query);
					$array=array();
					$stmt->execute();
					$row=$stmt->fetchAll(PDO::FETCH_ASSOC);
					//~ echo "<pre>";print_r($row);"</pre>";
					//~ die;
					if($row)
					{
						//PAGINATION
						
						$totalCount = $stmt->rowCount();
						$total_pages = ceil($totalCount/$Size);
						$page = $pageNo;
						
						if(!isset($page)) 
						{
						 $pageno = 1;
						} 
						else
						{
						 $pageno = $page;
						}
						
						
						   $starting_limit = ($pageno-1)*$Size;
						   $show  = "select * from jobPost  LIMIT $starting_limit, $Size";
						   $r = $pdo->prepare($show);
						   $array=array();
						   $r->execute();
						//PAGINATION END
						if($r)
						{
							foreach($r as $job)
							{
								
								$query1="select * from register where user_id=:employer_id";
								$stmt1=$pdo->prepare($query1);
								$array1=array(':employer_id'=>$job['employer_id']);
								$stmt1->execute($array1);
								$row1=$stmt1->fetch(PDO::FETCH_ASSOC);
								
								$json[]=array('job_id'=>$job['job_id'],
											  'employer_name'=>$job['employer_name'],
											  'employer_id'=>$job['employer_id'],
											  'job_title'=>$job['job_title'],
											  'description'=>$job['description'],
											  'job_type'=>$job['job_type'],
											  'duration'=>$job['duration'],
											  'est_amount'=>$job['est_amount'],
											  'datetime'=>$job['datetime'],
											  'location'=>$job['location'],
											  'success_rate'=>$job['success_rate'],
											  'bonus'=>$job['bonus'],
											  'rating'=>$job['rating'],
											  'image'=>$row1['profile_pic']
											 );
							$status='1';
							$message='success';
							}
							  $json=array('message'=>$message,'status'=>$status,'current_page'=>$pageNo,'page_size'=>$Size,'total_records'=>"$totalCount",'last_page'=>"$total_pages",'data'=>$json);
							  echo "{\"response\":" . json_encode($json) . "}";
						}
						else
						{
					   
						  $json=array('message'=>'No record found','status'=>'0');
						  echo "{\"response\":" . json_encode($json) . "}";
						} 
				  }
				  else
				  {
						  $json=array('message'=>'No record found','status'=>'0');
						  echo "{\"response\":" . json_encode($json) . "}";
						  die;
				  }
  }
  else
  {
	                $query="select * from jobPost WHERE job_title LIKE '%$search%' OR description LIKE '%$search%' and status = 0 OR status = 2 ORDER BY job_id desc";
					$stmt=$pdo->prepare($query);
					$array=array();
					$stmt->execute();
					$row=$stmt->fetchAll(PDO::FETCH_ASSOC);
					//~ echo "<pre>";print_r($row);"</pre>";
					//~ die;
					if($row)
					{
						//PAGINATION
						
						$totalCount = $stmt->rowCount();
						$total_pages = ceil($totalCount/$Size);
						$page = $pageNo;
						
						if(!isset($page)) 
						{
						 $pageno = 1;
						} 
						else
						{
						 $pageno = $page;
						}
						
						
						   $starting_limit = ($pageno-1)*$Size;
						   $show  = "select * from jobPost WHERE job_title LIKE '%$search%' OR description LIKE '%$search%' and status = 0 OR status = 2 ORDER BY job_id desc LIMIT $starting_limit, $Size";
						   $r = $pdo->prepare($show);
						   $array=array();
						   $r->execute();
						//PAGINATION END
						if($r)
						{
							foreach($r as $job)
							{
								
								$query1="select * from register where user_id=:employer_id";
								$stmt1=$pdo->prepare($query1);
								$array1=array(':employer_id'=>$job['employer_id']);
								$stmt1->execute($array1);
								$row1=$stmt1->fetch(PDO::FETCH_ASSOC);
								
								$json[]=array('job_id'=>$job['job_id'],
											  'employer_name'=>$job['employer_name'],
											  'employer_id'=>$job['employer_id'],
											  'job_title'=>$job['job_title'],
											  'description'=>$job['description'],
											  'job_type'=>$job['job_type'],
											  'duration'=>$job['duration'],
											  'est_amount'=>$job['est_amount'],
											  'datetime'=>$job['datetime'],
											  'location'=>$job['location'],
											  'success_rate'=>$job['success_rate'],
											  'bonus'=>$job['bonus'],
											  'rating'=>$job['rating'],
											  'image'=>$row1['profile_pic']
											 );
							$status='1';
							$message='success';
							}
							  $json=array('message'=>$message,'status'=>$status,'current_page'=>$pageNo,'page_size'=>$Size,'total_records'=>"$totalCount",'last_page'=>"$total_pages",'data'=>$json);
							  echo "{\"response\":" . json_encode($json) . "}";
							  die;
						}
						else
						{
					   
						  $json=array('message'=>'No record found','status'=>'0');
						  echo "{\"response\":" . json_encode($json) . "}";
						  die;
						} 
				  }
				  else
				  {
						  $json=array('message'=>'No record found','status'=>'0');
						  echo "{\"response\":" . json_encode($json) . "}";
						  die;
				  }
	  
	  
  }				      	
}


//http://traala.com/gruntwork/api.php?action=jobApply&user_id=175&job_id=
function jobApply()
{
	global $pdo;
	extract($_REQUEST);
	$query="select * from jobPost where job_id=:job_id";
	$stmt=$pdo->prepare($query);
	$array=array(':job_id'=>$job_id);
	$stmt->execute($array);
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
    //echo "<pre>";print_r($row);"</pre>";
	//~ die;
	if($row)
	{
		$query1="select * from job_applicants where user_id=:user_id and job_id=:job_id";
		$stmt1=$pdo->prepare($query1);
		$array1=array(':user_id'=>$user_id,':job_id'=>$job_id);
		$stmt1->execute($array1);
		$row1=$stmt1->fetch(PDO::FETCH_ASSOC);
		//~ echo "<pre>";print_r($row);"</pre>";
		//~ die;
		if(empty($row1))
		{
				$query_insert="insert into job_applicants(user_id,job_id,employer_id)  
						values (:user_id,:job_id,:employer_id)";
				$stmt_insert=$pdo->prepare($query_insert);
				$array_insert=array(':user_id'=>$user_id,
									':job_id'=>$job_id,
									':employer_id'=>$row['employer_id']
									);
				$stmt_insert->execute($array_insert);
				$stmt_insert->rowCount();
				
				//PUSH NOTIFICATION
				$query_noti="select * from register where user_id=:user_id";
				$stmt_noti=$pdo->prepare($query_noti);
				$array_noti=array(':user_id'=>$row['employer_id']);
				$stmt_noti->execute($array_noti);
				$row_noti=$stmt_noti->fetch(PDO::FETCH_ASSOC); 
		        //~ echo "<pre>";print_r($row_noti);"</pre>";
				//~ die;
                $query_noti1="select * from register where user_id=:user_id";
				$stmt_noti1=$pdo->prepare($query_noti1);
				$array_noti1=array(':user_id'=>$user_id);
				$stmt_noti1->execute($array_noti1);
				$row_noti1=$stmt_noti1->fetch(PDO::FETCH_ASSOC);
				//~ echo "<pre>";print_r($row_noti1);"</pre>";
				//~ die;
				if($row_noti['device_type']=='A')
			    {
					$message = ''.$row_noti1['fullname'].' apply on job '.$row['job_title'].'';
					//echo "android";
					android_noti1($row_noti['device_token'],$message,$noti_type='new apply job',$user_id= $row_noti1['user_id']);  
		        }
		        else
		        {
					$message = ''.$row_noti1['fullname'].' apply on job '.$row['job_title'].'';
				    //echo "ios";
				    ios_noti($row_noti['device_token'],$message,$noti_type='new apply job',$user_id= $row_noti1['user_id']); 
			    }
			    //PUSH NOTI END
				$json=array('id'=>$pdo->lastInsertId(),'message'=>'Apply successfully');
				$status='1';
				$message='success';
		}
		else
		{
			  $json=array('user_id'=>'-1','message'=>'This user already have apply in this job ');
			  $status='1';
			  $message='success';
		}
	}	
			  $json=array('message'=>$message,'status'=>$status,'data'=>$json);
			  echo "{\"response\":" . json_encode($json) . "}";	
}


//http://traala.com/gruntwork/api.php?action=getJobDetails&job_id=1
function getJobDetails()
{
	global $pdo;
	extract($_REQUEST);
	$query="select * from jobPost where job_id=:job_id";
	$stmt=$pdo->prepare($query);
	$array=array(':job_id'=>$job_id);
	$stmt->execute($array);
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	if($row)
    {
		$query1="select * from register where user_id=:employer_id";
		$stmt1=$pdo->prepare($query1);
		$array1=array(':employer_id'=>$row['employer_id']);
		$stmt1->execute($array1);
		$row1=$stmt1->fetch(PDO::FETCH_ASSOC);
		
		$data=array('job_id'=>$row['job_id'],
			        'employer_name'=>$row['employer_name'],
			        'employer_id'=>$row['employer_id'],
			        'job_title'=>$row['job_title'],
			        'description'=>$row['description'],
			        'job_type'=>$row['job_type'],
			        'duration'=>$row['duration'],
			        'est_amount'=>$row['est_amount'],
			        'datetime'=>$row['datetime'],
			        'location'=>$row['location'],
			        'success_rate'=>$row['success_rate'],
			        'bonus'=>$row['bonus'],
			        'rating'=>'4',
			        'image'=>$row1['profile_pic']
			        );
			

		$json=array('message'=>'success','status'=>'1','data'=>$data);
   }
   else
   {
	  $json=array('message'=>'success','status'=>'0','data'=>''); 
   }
   echo "{\"response\":" . json_encode($json) . "}";
}


//http://traala.com/gruntwork/api.php?action=getEmployerProfile&user_id=1&user_type=1
function getEmployerProfile()
{
	global $pdo;
	extract($_REQUEST);
	$query="select * from register where user_id=:user_id and user_type=:user_type";
	$stmt=$pdo->prepare($query);
	$array=array(':user_id'=>$user_id,':user_type'=>$user_type);
	$stmt->execute($array);
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	if($row)
	{
		$json=array('user_id'=>$row['user_id'],
					'skills'=>$row['skills'],
					'user_type'=>$row['user_type'],
					'previous_experience'=>$row['previous_experience'],
					'job_prefrence_for_employers'=>$row['job_prefrence_for_employers']
		           );
		$status='1';
		$message='success';           
	}
	else
	{
		$json['user_id']="-1";
	    $json['message']="no record found";
	    $status='0';
	    $message='success';
	}
	    $json=array('message'=>$message,'status'=>$status,'data'=>$json);
	    echo "{\"response\":" . json_encode($json) . "}";
}


//http://traala.com/gruntwork/api.php?action=getEmployeeProfile&user_id=2&user_type=2
function getEmployeeProfile()
{
	global $pdo;
	extract($_REQUEST);
	$query="select * from register where user_id=:user_id and user_type=:user_type";
	$stmt=$pdo->prepare($query);
	$array=array(':user_id'=>$user_id,':user_type'=>$user_type);
	$stmt->execute($array);
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	if($row)
	{
		$json=array('user_id'=>$row['user_id'],
					'skills'=>$row['skills'],
					'user_type'=>$row['user_type'],
					'previous_experience'=>$row['previous_experience'],
					'job_prefrence_for_employees'=>$row['job_prefrence_for_employees']
		           );
		$status='1';
		$message='success';           
	}
	else
	{
		$json['user_id']="-1";
	    $json['message']="no record found";
	    $status='0';
	    $message='success';
	}
	    $json=array('message'=>$message,'status'=>$status,'data'=>$json);
	    echo "{\"response\":" . json_encode($json) . "}";
}


//http://traala.com/gruntwork/api.php?action=deleteJob&job_id=15&user_id=1
function deleteJob()
{
	global $pdo;
	extract($_REQUEST);
	$query="DELETE from jobPost where job_id=:job_id and employer_id=:user_id";
	$stmt=$pdo->prepare($query);
	$array=array(':job_id'=>$job_id,':user_id'=>$user_id);
	$stmt->execute($array);
	$json=array('message'=>'Job Deleted Successfully','status'=>'1');
	echo "{\"response\":" . json_encode($json) . "}";
}

//http://traala.com/gruntwork/api.php?action=getApplicantsDetail&job_id=1
function getApplicantsDetail()
{
	global $pdo;
	extract($_REQUEST);
	$query="select * from job_applicants where job_id=:job_id";
	$stmt=$pdo->prepare($query);
	$array=array(':job_id'=>$job_id);
	$stmt->execute($array);
	$row=$stmt->fetchAll(PDO::FETCH_ASSOC);
	
	if($row)
	{
		foreach($row as $value)
		{
			
            $query1="select * from register where user_id=:user_id";
	        $stmt1=$pdo->prepare($query1);
	        $array1=array(':user_id'=>$value['user_id']);
	        $stmt1->execute($array1);
	        $row2=$stmt1->fetchAll(PDO::FETCH_ASSOC);
	        foreach($row2 as $value2)
		    {
			
				$json[]=array('user_id'=>$value2['user_id'],
				              'job_id'=>$value['job_id'],
							  'fullname'=>$value2['fullname'],
							  'rating'=>'4',
							  'image'=>$value2['profile_pic'],
							  'total_hours'=>'24',
							  'hourly_rate'=>'100',
							  'total_earned'=>'500',
							  'skills'=>$value2['skills'],
							  'qualification'=>'btech'
							);
				$status='1';
				$message='success';
	       }
      }
	}   
	else
	{
	      $json=array();
	      $status='0';
		  $message='success';
    }
          $json=array('message'=>$message,'status'=>$status,'data'=>$json);
	      echo "{\"response\":" . json_encode($json) . "}";
}


//http://traala.com/gruntwork/api.php?action=updateImage&user_id=1&profile_pic=aa.png&user_type=1&fullname=gou ar
function updateImage()
{
	global $pdo;
	extract($_REQUEST);
	$profile_pic = str_replace(' ', '+', $profile_pic);
	$data = base64_decode($profile_pic);
	$profile_pic=rand(1000,9000)."_".time().".png";
	file_put_contents(dirname(__FILE__)."/profile_pics/".$profile_pic, $data);
	
	
	$qry="update register set profile_pic=:profile_pic,fullname=:fullname where user_id=:user_id and user_type=:user_type";
	$stmt = $pdo->prepare($qry);
	$array=array(':user_id'=>$user_id,':user_type'=>$user_type,':profile_pic'=>$profile_pic,':fullname'=>$fullname);
	$stmt->execute($array);
	
	$qry1="select * from register where user_id=:user_id";
	$stmt1 = $pdo->prepare($qry1);
	$array1=array(':user_id'=>$user_id);
	$stmt1->execute($array1);
    $row=$stmt1->fetchAll(PDO::FETCH_ASSOC);
    if($row)
    {
		$json=array('user_id'=>$user_id,'user_type'=>$user_type,'profile_pic'=>$profile_pic,'fullname'=>$fullname);
		$message='success';
		$status='1';
	}
	else
	{
		$json=array();
		$message='success';
		$status='0';
	}	
	 $json=array('message'=>$message,'status'=>$status,'data'=>$json);
	 echo "{\"response\":" . json_encode($json) . "}";
	
}


//~ function upload_image()
//~ {
	//~ global $pdo;
	//~ extract($_REQUEST);
	//~ define('UPLOAD_DIR', 'profile_pics/');
    //~ $image_parts = explode(";base64,", $_POST['profile_pic']);
    //~ $image_type_aux = explode("profile_pics/", $image_parts[0]);
    //~ $image_type = $image_type_aux[1];
    //~ $image_base64 = base64_decode($image_parts[1]);
    //~ $profile_pic = UPLOAD_DIR . uniqid() . '.png';
    //~ file_put_contents($profile_pic, $image_base64);
	//~ //print $success ? $file : 'Unable to save the file.';
	//~ 
	//~ 
	//~ $qry1="update register set profile_pic=:profile_pic where user_id=:user_id ";
	//~ $stmt1 = $pdo->prepare($qry1);
	//~ $array1=array(':user_id'=>$user_id,':profile_pic'=>$profile_pic);
	//~ $stmt1->execute($array1);
	//~ 
	//~ $query="select * from register where user_id=:user_id";
	//~ $stmt= $pdo->prepare($query);
	//~ $array=array(':user_id'=>$user_id);
	//~ $stmt->execute($array);
	//~ $row=$stmt->fetch(PDO::FETCH_ASSOC);
	//~ echo "<pre>";print_r($row);"</pre>";
	//~ die;
	//~ if($row)
	//~ {
		//~ $json=array('user_id'=>$user_id,'profile_pic'=>$profile_pic,'message'=>'Apply successfully');
		//~ $message='success';
		//~ $status='1';
	//~ }
	//~ else
	//~ {
		//~ $json=array();
		//~ $message='success';
		//~ $status='0';
	//~ }
	//~ $json=array('message'=>$message,'status'=>$status,'data'=>$json);
	//~ echo "{\"response\":" . json_encode($json) . "}";
//~ }


//http://traala.com/gruntwork/api.php?action=getImageAndName&user_id=1&user_type=1
function getImageAndName()
{
	global $pdo;
	extract($_REQUEST);
	$qry1="select * from register where user_id=:user_id and user_type=:user_type";
	$stmt1 = $pdo->prepare($qry1);
	$array1=array(':user_id'=>$user_id,':user_type'=>$user_type);
	$stmt1->execute($array1);
    $row=$stmt1->fetch(PDO::FETCH_ASSOC);
    if($row)
    {
	    $json=array('profile_pic'=>$row['profile_pic'],'fullname'=>$row['fullname']);
		$message='success';
		$status='1';	
	}
	else
	{
		$json=array();
		$message='success';
		$status='0';
	}	
	 $json=array('message'=>$message,'status'=>$status,'data'=>$json);
	 echo "{\"response\":" . json_encode($json) . "}";
}

//http:traala.com/gruntwork/api.php?action=hireEmployee&employer_id=176&employee_id=1&job_id=21&amount=123&bonus=12&duration=3&term_condition=jf
function hireEmployee()
{
	global $pdo;
	extract($_REQUEST);
	$query="select * from jobHire where employer_id=:employer_id and employee_id=:employee_id and job_id=:job_id";
	$stmt=$pdo->prepare($query);
	$array=array(':employer_id'=>$employer_id,':employee_id'=>$employee_id,':job_id'=>$job_id);
	$stmt->execute($array);
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
   
	if(empty($row))
	{
	   
		$query2="update jobPost set est_amount=:amount where job_id=:job_id and employer_id=:employer_id ";
		$stmt2=$pdo->prepare($query2);
		$array2=array(':job_id'=>$job_id,':employer_id'=>$employer_id,':amount'=>$amount);
		$stmt2->execute($array2);
		
		
		$query3="DELETE from job_applicants where job_id=:job_id and employer_id=:employer_id and user_id=:employee_id";
		$stmt3=$pdo->prepare($query3);
		$array3=array(':job_id'=>$job_id,':employer_id'=>$employer_id,':employee_id'=>$employee_id);
		$stmt3->execute($array3);
		
		
	   $query_insert="insert into jobHire(employer_id,employee_id,job_id,amount,duration,bonus,term_condition,employer_status,employee_status) values(:employer_id,:employee_id,:job_id,:amount,:duration,:bonus,:term_condition,1,0)";
	   $stmt_insert=$pdo->prepare($query_insert);
	   $array_insert=array(':employer_id'=>$employer_id,':employee_id'=>$employee_id,':job_id'=>$job_id,':amount'=>$amount,':bonus'=>$bonus,':duration'=>$duration,':term_condition'=>$term_condition);
	   $stmt_insert->execute($array_insert);
	   $stmt_insert->rowCount();
	   
	   
	   //PUSH NOTIFICATION
	   $query_noti="select * from job_applicants where employer_id=:employer_id and user_id=:employee_id and job_id=:job_id";
	   $stmt_noti=$pdo->prepare($query_noti);
	   $array_noti=array(':employer_id'=>$employer_id,':employee_id'=>$employee_id,':job_id'=>$job_id);
	   $stmt_noti->execute($array_noti);
	   $row_noti=$stmt_noti->fetch(PDO::FETCH_ASSOC);
			
	   $query_noti1="select * from register where user_id=:employee_id";
	   $stmt_noti1=$pdo->prepare($query_noti1);
	   $array_noti1=array(':employee_id'=>$employee_id);
	   $stmt_noti1->execute($array_noti1);
	   $row_noti1=$stmt_noti1->fetch(PDO::FETCH_ASSOC); 
	   //~ echo"<pre>";print_r($row_noti1);"</pre>";
	   //~ die;
	   
	    $query1="select * from jobPost where job_id=:job_id";
		$stmt1=$pdo->prepare($query1);
		$array1=array(':job_id'=>$job_id);
		$stmt1->execute($array1);
		$row1=$stmt1->fetch(PDO::FETCH_ASSOC);
    //~ echo "<pre>";print_r($row1);"</pre>";
	//~ die;
	   	
		if($row_noti1['device_type']=='A')
		{
			$message = ''.$row_noti1['fullname'].' Hired you on job: '.$row1['job_title'].'';
			//echo "hi";
			android_noti1($row_noti1['device_token'],$message,$noti_type='new hire');  
		}
		else
	    {
					$message = ''.$row_noti1['fullname'].' hired '.$row['job_title'].'';
				    //echo "ios";
				    ios_noti($row_noti['device_token'],$message_data,$noti_type='new hire'); 
	    }
		//PUSH NOTI END
		
		$json=array('user_id'=>$pdo->lastInsertId(),'message'=>'successfully');
		$status='1';
		$message='success';
	 }
	 else
	 {
		  $json=array('user_id'=>'-1','message'=>'user already hire in job');
		  $status='1';
		  $message='success'; 
	 }
	 $json=array('message'=>$message,'status'=>$status,'data'=>$json);
	 echo "{\"response\":" . json_encode($json) . "}";
}


//http://traala.com/gruntwork/api.php?action=getUserName&user_id=13
function getUserName()
{
	global $pdo;
	extract($_REQUEST);
	$query="select * from register where user_id=:user_id";
	$stmt=$pdo->prepare($query);
	$array=array(':user_id'=>$user_id);
	$stmt->execute($array);
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	//~ echo "<pre>";print_r($row);"</pre>";
	//~ die;
	if($row)
	{
		$json=array('fullname'=>$row['fullname']);
		$message='success';
		$status='1';
	}
	else
	{
		$json=array();
		$message='success';
		$status='0';
	}	
	 $json=array('message'=>$message,'status'=>$status,'data'=>$json);
	 echo "{\"response\":" . json_encode($json) . "}";
}
//http://traala.com/gruntwork/api.php?action=getJobOffer&user_id=2

function getJobOffer()  // This is for employee/developer
{
	global $pdo;
	extract($_REQUEST);
	$query="select * from jobHire where employee_id=:user_id and employee_status=0";
	$stmt=$pdo->prepare($query);
	$array=array(':user_id'=>$user_id);
	$stmt->execute($array);
	$row=$stmt->fetchAll(PDO::FETCH_ASSOC);
	//~ echo "<pre>";print_r($row);"</pre>";
	//~ die;
	if($row)
	{
		foreach($row as $value)
		{
			$query1="select r.user_id,r.fullname,r.profile_pic,jp.job_title,jp.*
					 from register r,jobPost jp where r.user_id=:employer_id and jp.job_id=:job_id";
			$stmt1=$pdo->prepare($query1);
			$array1=array(':employer_id'=>$value['employer_id'],':job_id'=>$value['job_id']);
			$stmt1->execute($array1);
			$row1=$stmt1->fetch(PDO::FETCH_ASSOC);
			//~ echo "<pre>";print_r($row1);"</pre>";
			//~ die;
			$data[]=array('job_id'=>$row1['job_id'],
						'employer_id'=>$value['employer_id'],
						'employer_name'=>$row1['fullname'],
						'image'=>$row1['profile_pic'],			       
						'job_title'=>$row1['job_title'],
						'job_description'=>$row1['description'],
						'est_amount'=>$row1['est_amount'],
						'term_condition'=>$value['term_condition']
					   );
		}		

	    $json=array('message'=>'success','status'=>'1','data'=>$data);
   }
   else
   {
	  $data=array();
	  $json=array('message'=>'success','status'=>'0','data'=>$data); 
   }
   echo "{\"response\":" . json_encode($json) . "}";
}


//http://traala.com/gruntwork/api.php?action=jobStatus&job_id=1&status=1
function jobStatus()
{
	global $pdo;
	extract($_REQUEST);
	$query="select * from jobHire where job_id=:job_id";
	$stmt=$pdo->prepare($query);
	$array=array(':job_id'=>$job_id);
	$stmt->execute($array);
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	//~ echo "<pre>";print_r($row);"</pre>";
	//~ die;
	if($row)
	{
    $qry_upd="update jobHire set status=:status where job_id=:job_id";
	$stmt_upd = $pdo->prepare($qry_upd);
	$array_upd=array(':job_id'=>$job_id,':status'=>$status);
	$stmt_upd->execute($array_upd);	
	 
    $json=array('message'=>'success','status'=>'1');
    }
    else
    {
	  $json=array('message'=>'success','status'=>'0','data'=>''); 
    }
    echo "{\"response\":" . json_encode($json) . "}";
}


//http://traala.com/gruntwork/api.php?action=confirmJob&job_id=2&employer_id=53&employee_id=1
function confirmJob()
{
	global $pdo;
	extract($_REQUEST);
	$query="update jobHire set employee_status=1 where job_id=:job_id and employer_id=:employer_id and employee_id=:employee_id";
	$stmt=$pdo->prepare($query);
	$array=array(':job_id'=>$job_id,':employer_id'=>$employer_id,':employee_id'=>$employee_id);
	$stmt->execute($array);
	
	//~ $query="update jobHire set employer_status=1 where job_id=:job_id and employer_id=:employer_id and employee_id=:employee_id";
	//~ $stmt=$pdo->prepare($query);
	//~ $array=array(':job_id'=>$job_id,':employer_id'=>$employer_id,':employee_id'=>$employee_id);
	//~ $stmt->execute($array);
	//~ 
	
	 //PUSH NOTIFICATION
	   $query_noti="select * from job_applicants where employer_id=:employer_id and user_id=:employee_id and job_id=:job_id";
	   $stmt_noti=$pdo->prepare($query_noti);
	   $array_noti=array(':employer_id'=>$employer_id,':employee_id'=>$employee_id,':job_id'=>$job_id);
	   $stmt_noti->execute($array_noti);
	   $row_noti=$stmt_noti->fetch(PDO::FETCH_ASSOC);
			
	   $query_noti1="select * from register where user_id=:employer_id";
	   $stmt_noti1=$pdo->prepare($query_noti1);
	   $array_noti1=array(':employer_id'=>$employer_id);
	   $stmt_noti1->execute($array_noti1);
	   $row_noti1=$stmt_noti1->fetch(PDO::FETCH_ASSOC); 
	   //~ echo"<pre>";print_r($row_noti1);"</pre>";
	   //~ die;
	   
	    $query1="select * from jobPost where job_id=:job_id";
		$stmt1=$pdo->prepare($query1);
		$array1=array(':job_id'=>$job_id);
		$stmt1->execute($array1);
		$row1=$stmt1->fetch(PDO::FETCH_ASSOC);
    //~ echo "<pre>";print_r($row1);"</pre>";
	//~ die;
	   	
		if($row_noti1['device_type']=='A')
		{
			$message = ''.$row_noti1['fullname'].' Confirm the job: '.$row1['job_title'].'';
			//echo "hi";
			android_noti1($row_noti1['device_token'],$message,$noti_type='confirm');  
		}
		else
	    {
					//~ $message = ''.$row_noti1['fullname'].' Confirm '.$row['job_title'].'';
				    //~ //echo "ios";
				    //~ ios_noti1($row_noti['device_token'],$message_data,$noti_type='confirm'); 
	    }
		//PUSH NOTI END
	
	
	$query1="update jobPost set status=1 where job_id=:job_id and employer_id=:employer_id";
	$stmt1=$pdo->prepare($query1);
	$array1=array(':job_id'=>$job_id,':employer_id'=>$employer_id);
	$stmt1->execute($array1);
	
    $json=array('message'=>'success','status'=>'1');
    echo "{\"response\":" . json_encode($json) . "}";
}

//http://traala.com/gruntwork/api.php?action=cancelJob&job_id=1&employer_id=74&employee_id=2
function cancelJob()
{
	global $pdo;
	extract($_REQUEST);
	$query="update jobHire set status=2 where job_id=:job_id and employer_id=:employer_id and employee_id=:employee_id";
	$stmt=$pdo->prepare($query);
	$array=array(':job_id'=>$job_id,':employer_id'=>$employer_id,':employee_id'=>$employee_id);
	$stmt->execute($array);
	
	
	
	 //PUSH NOTIFICATION
	   $query_noti="select * from job_applicants where employer_id=:employer_id and user_id=:employee_id and job_id=:job_id";
	   $stmt_noti=$pdo->prepare($query_noti);
	   $array_noti=array(':employer_id'=>$employer_id,':employee_id'=>$employee_id,':job_id'=>$job_id);
	   $stmt_noti->execute($array_noti);
	   $row_noti=$stmt_noti->fetch(PDO::FETCH_ASSOC);
			
	   $query_noti1="select * from register where user_id=:employee_id";
	   $stmt_noti1=$pdo->prepare($query_noti1);
	   $array_noti1=array(':employee_id'=>$employee_id);
	   $stmt_noti1->execute($array_noti1);
	   $row_noti1=$stmt_noti1->fetch(PDO::FETCH_ASSOC); 
	   //~ echo"<pre>";print_r($row_noti1);"</pre>";
	   //~ die;
	   
	    $query1="select * from jobPost where job_id=:job_id";
		$stmt1=$pdo->prepare($query1);
		$array1=array(':job_id'=>$job_id);
		$stmt1->execute($array1);
		$row1=$stmt1->fetch(PDO::FETCH_ASSOC);
    //~ echo "<pre>";print_r($row1);"</pre>";
	//~ die;
	   	
		if($row_noti1['device_type']=='A')
		{
			$message = ''.$row_noti1['fullname'].' Cancel the Job '.$row1['job_title'].'';
			//echo "hi";
			android_noti1($row_noti1['device_token'],$message,$noti_type='Cancel');  
		}
		else
	    {
					$message = ''.$row_noti1['fullname'].' Cancel Job '.$row['job_title'].'';
				    //echo "ios";
				    ios_noti($row_noti['device_token'],$message_data,$noti_type='Cancel'); 
	    }
		//PUSH NOTI END
	
	
	$query1="update jobPost set status=2 where job_id=:job_id and employer_id=:employer_id";
	$stmt1=$pdo->prepare($query1);
	$array1=array(':job_id'=>$job_id,':employer_id'=>$employer_id);
	$stmt1->execute($array1);
	
	
	$json=array('message'=>'success','status'=>'1');
	echo "{\"response\":" . json_encode($json) . "}";
}

//http://traala.com/gruntwork/api.php?action=completeJob&job_id=1&employer_id=74&employee_id=2&user_type=1
function completeJob()
{
	global $pdo;
	extract($_REQUEST);
	if($user_type=='1')
	{
	$query="update jobHire set employer_status=3,employee_status=3 where job_id=:job_id and employer_id=:employer_id and employee_id=:employee_id ";
	$stmt=$pdo->prepare($query);
	$array=array(':job_id'=>$job_id,':employer_id'=>$employer_id,':employee_id'=>$employee_id);
	$stmt->execute($array);
	//~ echo"<pre>";print_r($stmt);"</pre>";
	   //~ die;
	
	
	    $query1="update jobPost set status=3 where job_id=:job_id and employer_id=:employer_id";
		$stmt1=$pdo->prepare($query1);
		$array1=array(':job_id'=>$job_id,':employer_id'=>$employer_id);
		$stmt1->execute($array1);
	
	//PUSH NOTIFICATION
	   $query_noti="select * from job_applicants where employer_id=:employer_id and user_id=:employee_id and job_id=:job_id";
	   $stmt_noti=$pdo->prepare($query_noti);
	   $array_noti=array(':employer_id'=>$employer_id,':employee_id'=>$employee_id,':job_id'=>$job_id);
	   $stmt_noti->execute($array_noti);
	   $row_noti=$stmt_noti->fetch(PDO::FETCH_ASSOC);
			
	   $query_noti1="select * from register where user_id=:employee_id";
	   $stmt_noti1=$pdo->prepare($query_noti1);
	   $array_noti1=array(':employee_id'=>$employee_id);
	   $stmt_noti1->execute($array_noti1);
	   $row_noti1=$stmt_noti1->fetch(PDO::FETCH_ASSOC); 
	   //~ echo"<pre>";print_r($row_noti1);"</pre>";
	   //~ die;
	   
	    $query1="select * from jobPost where job_id=:job_id";
		$stmt1=$pdo->prepare($query1);
		$array1=array(':job_id'=>$job_id);
		$stmt1->execute($array1);
		$row1=$stmt1->fetch(PDO::FETCH_ASSOC);
    //~ echo "<pre>";print_r($row1);"</pre>";
	//~ die;
	   	
		if($row_noti1['device_type']=='A')
		{
			$message = ''.$row_noti1['fullname'].' Complete the Job '.$row1['job_title'].'';
			//echo "hi";
			android_noti1($row_noti1['device_token'],$message,$noti_type='Complete');  
		}
		else
	    {
					$message = ''.$row_noti1['fullname'].' Cancel Job '.$row['job_title'].'';
				    //echo "ios";
				    ios_noti($row_noti['device_token'],$message_data,$noti_type='Complete'); 
	    }
		//PUSH NOTI END
	}
	else
	{
	   //~ $query="update jobHire set employee_status=3,employer_status=1 where job_id=:job_id and employer_id=:employer_id and employee_id=:employee_id ";
	   //~ $stmt=$pdo->prepare($query);
	   //~ $array=array(':job_id'=>$job_id,':employer_id'=>$employer_id,':employee_id'=>$employee_id);
	   //~ $stmt->execute($array);
	   
	    
	 //~ echo "<pre>";print_r($stmt11);"</pre>";
	//~ die;
	
	//PUSH NOTIFICATION
	   $query_noti="select * from job_applicants where employer_id=:employer_id and user_id=:employee_id and job_id=:job_id";
	   $stmt_noti=$pdo->prepare($query_noti);
	   $array_noti=array(':employer_id'=>$employer_id,':employee_id'=>$employee_id,':job_id'=>$job_id);
	   $stmt_noti->execute($array_noti);
	   $row_noti=$stmt_noti->fetch(PDO::FETCH_ASSOC);
			
	   $query_noti1="select * from register where user_id=:employer_id";
	   $stmt_noti1=$pdo->prepare($query_noti1);
	   $array_noti1=array(':employer_id'=>$employer_id);
	   $stmt_noti1->execute($array_noti1);
	   $row_noti1=$stmt_noti1->fetch(PDO::FETCH_ASSOC); 
	   //~ echo"<pre>";print_r($row_noti1);"</pre>";
	   //~ die;
	   
	    $query1="select * from jobPost where job_id=:job_id";
		$stmt1=$pdo->prepare($query1);
		$array1=array(':job_id'=>$job_id);
		$stmt1->execute($array1);
		$row1=$stmt1->fetch(PDO::FETCH_ASSOC);
    //~ echo "<pre>";print_r($row1);"</pre>";
	//~ die;
	   	
		if($row_noti1['device_type']=='A')
		{
			$message = ''.$row_noti1['fullname'].' Complete the Job '.$row1['job_title'].'';
			//echo "hi";
			android_noti1($row_noti1['device_token'],$message,$noti_type='Complete');  
		}
		else
	    {
					$message = ''.$row_noti1['fullname'].' Cancel Job '.$row['job_title'].'';
				    //echo "ios";
				    ios_noti($row_noti['device_token'],$message_data,$noti_type='Complete'); 
	    }
		//PUSH NOTI END	
		
	}
	
		//~ $query1="update jobPost set status=3 where job_id=:job_id and employer_id=:employer_id";
		//~ $stmt1=$pdo->prepare($query1);
		//~ $array1=array(':job_id'=>$job_id,':employer_id'=>$employer_id);
		//~ $stmt1->execute($array1);
		
	$json=array('message'=>'success','status'=>'1');
	echo "{\"response\":" . json_encode($json) . "}";
}

//http://traala.com/gruntwork/api.php?action=createStripeToken&user_id=13&name=sanu&card_no=123&ex_month=2&ex_year=1&card_type=visa&stripe_token=088765
function createStripeToken()
{
	global $pdo;
	extract($_REQUEST);
	$query="select * from stripe where card_no=:card_no and employer_id=:user_id";
	$stmt=$pdo->prepare($query);
	$array=array(':user_id'=>$user_id,':card_no'=>$card_no);
	$stmt->execute($array);
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
    //~ echo "<pre>";print_r($row);"</pre>";
	//~ die;
	if(empty($row))
	{
	   $query_insert="insert into stripe(employer_id,name,card_no,ex_month,ex_year,card_type,stripe_token) 
	                  values (:user_id,:name,:card_no,:ex_month,:ex_year,:card_type,:stripe_token)";
	   $stmt_insert=$pdo->prepare($query_insert);
       $array_insert=array(':user_id'=>$user_id,
                           ':name'=>$name,
                           ':card_no'=>$card_no,
                           ':ex_month'=>$ex_month,
                           ':ex_year'=>$ex_year,
                           ':card_type'=>$card_type,
                           ':stripe_token'=>$stripe_token
                           );  
	   $stmt_insert->execute($array_insert);
      
	   if($stmt_insert->rowCount())
	   {
		   $json=array('status'=>'1','message'=>'Card Added Successfully');  
	   }
	   else
	   {
	       $json=array('status'=>'0','message'=>'Some server error..Try Again!');  
	   }
	 }
	else
	{
	   	   $json=array('status'=>'1','message'=>'Card Already Exist');    
    }
	echo "{\"response\":" . json_encode($json) . "}";
		
}

//http://traala.com/gruntwork/api.php?action=stripe_payment&amount=50&stripeToken=tok_visa
function stripe_payment() 
{ 
	global $pdo; 
	extract($_REQUEST); 
	require_once('StripeWork/stripe_pay/init.php'); 
	Stripe\Stripe::setApiKey('sk_test_G01r2RvlpGV1TnOLu0f6FgCw'); 
	$charge = Stripe\Charge::create(
	              array( "amount" => $amount, 
	                     "currency" => "usd", 
	                     "card" => $stripeToken, 
	                     "description" => "Charge for Gruntwork." 
	                     )); 
	                     //~ echo "<pre>";print_r($charge['status']);"</pre>"; 
	                     //~ die;	
	                     //~ if($charge['status']=='succeeded') 
	                     //~ { 
							 //~ $stmt=$pdo->prepare("update jobHire set amount=:amount where job_id=:job_id and employer_id=:employer_id and employee_id=:employee_id "); 
							 //~ $arr=array(':job_id'=>$job_id,':amount'=>$amount,':employer_id'=>$employer_id,':employee_id'=>$employee_id); 
							 //~ $stmt->execute($arr);
							 //~ 
							 //~ $qry1="INSERT INTO stripe(job_id,employer_id,employee_id,stripe_token) VALUES (:job_id,:employer_id,:employee_id,:stripeToken)";
							 //~ $stmt_qry1 = $pdo->prepare($qry1);
							 //~ $arr1=array(':job_id'=>$job_id,':employer_id'=>$employer_id,':employee_id'=>$employee_id,':stripeToken'=>$stripeToken);
							 //~ $stmt_qry1 = $stmt_qry1->execute($arr1);
							  //~ 
							 //~ $status='1';
						     //~ $message='success';
						     //~ $json=array('id'=>"1",'message'=>'Payment successfull');
						     //~ 
						     //~ $json=array('message'=>$message,'status'=>$status,'data'=>$json);
							 //~ echo "{\"response\":" . json_encode($json) . "}"; 
						//~ }
}

//http://traala.com/gruntwork/api.php?action=employeeJobProgress&user_id=1
function employeeJobProgress()
{
	global $pdo;
	extract($_REQUEST);
	$query="select * from jobHire where employee_id=:user_id and employee_status=1";
	$stmt=$pdo->prepare($query);
	$array=array(':user_id'=>$user_id);
	$stmt->execute($array);
	$row=$stmt->fetchAll(PDO::FETCH_ASSOC);
	//~ echo "<pre>";print_r($row);"</pre>";
	//~ die;
	if($row)
	{
	   foreach($row as $value)
	   {
		    $query1="select jp.*,r.profile_pic from jobPost jp,register r where jp.job_id=:job_id and jp.status=1
		             and r.user_id = jp.employer_id";
			$stmt1=$pdo->prepare($query1);
			$array1=array(':job_id'=>$value['job_id']);
			$stmt1->execute($array1);
			$row1=$stmt1->fetchAll(PDO::FETCH_ASSOC);
			//~ echo "<pre>";print_r($row1);"</pre>";
	        //~ die;
	        if($row1)
	        {
		    foreach($row1 as $value1)
		    {
				$json[]=array('job_id'=>$value['job_id'],
				              'job_title'=>$value1['job_title'],
				              'job_description'=>$value1['description'],
				              'employer_id'=>$value['employer_id'],
				              'employer_name'=>$value1['employer_name'],
				              'profile_pic'=>$value1['profile_pic'],
				              'job_type'=>$value1['job_type'],
			                  'duration'=>$value1['duration'],
			                  'est_amount'=>$value1['est_amount'],
			                  'datetime'=>$value1['datetime'],
			                  'location'=>$value1['location'],
			                  'success_rate'=>$value1['success_rate'],
			                  'bonus'=>$value1['bonus'],
			                  'rating'=>$value1['rating']
				              );
			    $status='1';
				$message='success';
		    }
		  }
		  else
		  {	
			    $json=array();
	            $status='0';
			    $message='success';
		  }	    
		}
	}
	else
	{
	      $json=array();
	      $status='0';
		  $message='success';
    }
    $json=array('message'=>$message,'status'=>$status,'data'=>$json);	
	echo "{\"response\":" . json_encode($json) . "}";
}

//http://traala.com/gruntwork/api.php?action=employerJobProgress&user_id=13
function employerJobProgress()
{
	global $pdo;
	extract($_REQUEST);
	$query="select * from jobHire where employer_id=:user_id and employer_status=1";
	$stmt=$pdo->prepare($query);
	$array=array(':user_id'=>$user_id);
	$stmt->execute($array);
	$row=$stmt->fetchAll(PDO::FETCH_ASSOC);
	//~ echo "<pre>";print_r($row);"</pre>";
	//~ die;
	if($row)
	{
		foreach($row as $value)
		{
			$query2="select * from register where user_id=:employee_id";
			$stmt2=$pdo->prepare($query2);
			$array2=array(':employee_id'=>$value['employee_id']);
			$stmt2->execute($array2);
			$row2=$stmt2->fetch(PDO::FETCH_ASSOC);
			
			//~ echo "<pre>";print_r($row2);"</pre>";
	       //~ die;
			
			$query1="select jp.*,r.profile_pic,r.fullname from jobPost jp,register r 
			         where jp.job_id=:job_id and jp.status=1
			         and r.user_id = jp.employer_id";
			$stmt1=$pdo->prepare($query1);
			$array1=array(':job_id'=>$value['job_id']);
			$stmt1->execute($array1);
			$row1=$stmt1->fetchAll(PDO::FETCH_ASSOC);
			//~ echo "<pre>";print_r($row1);"</pre>";
	        
			if($row1)
			{
				foreach($row1 as $value1)
				{
					$json[]=array('job_id'=>$value['job_id'],
								  'job_title'=>$value1['job_title'],
								  'job_description'=>$value1['description'],
								  'employer_id'=>$value1['employer_id'],
								  'employee_id'=>$value['employee_id'],
								  'employee_name'=>$row2['fullname'],
								  'profile_pic'=>$row2['profile_pic'],
								  'job_type'=>$value1['job_type'],
								  'duration'=>$value1['duration'],
								  'est_amount'=>$value1['est_amount'],
								  'datetime'=>$value1['datetime'],
								  'location'=>$value1['location'],
								  'success_rate'=>$value1['success_rate'],
								  'bonus'=>$value1['bonus'],
								  'rating'=>$value1['rating']
								 );
					$status='1';
					$message='success';
				}
				//$json=array('message'=>$message,'status'=>$status,'data'=>$json);	
				
			}
			//~ else
	       //~ {
	      //~ $json=array();
	      //~ $status='0';
		  //~ $message='success';
          //~ }
		}
		//die;
	}//echo "{\"response\":" . json_encode($json) . "}";
	else
	{
	      $json=array();
	      $status='0';
		  $message='success';
    }
    $json=array('message'=>$message,'status'=>$status,'data'=>$json);	
	echo "{\"response\":" . json_encode($json) . "}";
}

//http://traala.com/gruntwork/api.php?action=jobHistory&user_id=53&user_type=1
function jobHistory()
{
	global $pdo;
	extract($_REQUEST);
	if($user_type=='1')
	{
		$query="select * from jobHire where employer_id =:user_id and employer_status=3 and employee_status=3";
		$stmt=$pdo->prepare($query);
		$array=array(':user_id'=>$user_id);
		$stmt->execute($array);
		$row=$stmt->fetchAll(PDO::FETCH_ASSOC);
		//~ echo "<pre>";print_r($row);"</pre>";
		//~ die;
		if($row)
		{
			foreach($row as $value)
			{
				$query1="select jp.* from jobPost jp,jobHire jh where jp.job_id=jh.job_id and
				         jh.job_id=:job_id and jh.employer_status=3";
				$stmt1=$pdo->prepare($query1);
				$array1=array(':job_id'=>$value['job_id']);
				$stmt1->execute($array1);
				$row1=$stmt1->fetchAll(PDO::FETCH_ASSOC);
				//~ echo "<pre>";print_r($row1);"</pre>";
				//~ die;
				foreach($row1 as $value1)
				{
					  $json[]=array('job_id'=>$value['job_id'],
								  'job_title'=>$value1['job_title'],
								  'job_description'=>$value1['description'],
								  'employer_id'=>$value['employer_id'],
								  'employee_id'=>$value['employee_id'],
								  'employer_name'=>$value1['employer_name'],
								  'amount'=>$value['amount'],
								  'job_type'=>$value1['job_type'],
								  'duration'=>$value1['duration'],
								  'est_amount'=>$value1['est_amount'],
								  'datetime'=>$value1['datetime'],
								  'location'=>$value1['location'],
								  'success_rate'=>$value1['success_rate'],
								  'bonus'=>$value1['bonus']
								  );
					$status='1';
					$message='success';
				}
		   }
		}
		else
		{
			  $json=array();
			  $status='0';
			  $message='success';
		}
		$json=array('message'=>$message,'status'=>$status,'data'=>$json);	
		echo "{\"response\":" . json_encode($json) . "}";
   }
   else
   {
		$query="select * from jobHire where employee_id =:user_id and employee_status=3 and employer_status=3";
		$stmt=$pdo->prepare($query);
		$array=array(':user_id'=>$user_id);
		$stmt->execute($array);
		$row=$stmt->fetchAll(PDO::FETCH_ASSOC);
		//~ echo "<pre>";print_r($row);"</pre>";
		//~ die;
		if($row)
		{
			foreach($row as $value)
			{
				$query1="select jp.* from jobPost jp,jobHire jh where jp.job_id=jh.job_id and
				         jh.job_id=:job_id and jh.employee_status=3";
				$stmt1=$pdo->prepare($query1);
				$array1=array(':job_id'=>$value['job_id']);
				$stmt1->execute($array1);
				$row1=$stmt1->fetchAll(PDO::FETCH_ASSOC);
				//~ echo "<pre>";print_r($row1);"</pre>";
				//~ die;
				foreach($row1 as $value1)
				{
					  $json[]=array('job_id'=>$value['job_id'],
								  'job_title'=>$value1['job_title'],
								  'job_description'=>$value1['description'],
								  'employer_id'=>$value['employer_id'],
								  'employee_id'=>$value['employee_id'],
								  'employer_name'=>$value1['employer_name'],
								  'amount'=>$value['amount'],
								  'job_type'=>$value1['job_type'],
								  'duration'=>$value1['duration'],
								  'est_amount'=>$value1['est_amount'],
								  'datetime'=>$value1['datetime'],
								  'location'=>$value1['location'],
								  'success_rate'=>$value1['success_rate'],
								  'bonus'=>$value1['bonus']
								  );
					$status='1';
					$message='success';
				}
		   }
		}
		else
		{
			  $json=array();
			  $status='0';
			  $message='success';
		}
		$json=array('message'=>$message,'status'=>$status,'data'=>$json);	
		echo "{\"response\":" . json_encode($json) . "}";   
   }
}  


//http://traala.com/gruntwork/api.php?action=jobRating&user_id=176&employee_id=1&job_id=21&rating=4&feedback=abc
function jobRating()
{
	global $pdo;
	extract($_REQUEST);
	$query1="select * from jobHire where employer_id=:user_id and employee_id=:employee_id and job_id=:job_id";
	$stmt1=$pdo->prepare($query1);
	$array1=array(':user_id'=>$user_id,':employee_id'=>$employee_id,':job_id'=>$job_id);
	$stmt1->execute($array1);
	$row1=$stmt1->fetch(PDO::FETCH_ASSOC);
	//~ echo "<pre>";print_r($row1);"</pre>";
    //~ die;
	if($row1)
	{
		$query="select * from rating where job_id=:job_id and rating_from_id=:rating_from_id and rating_to_id=:rating_to_id";
		$stmt=$pdo->prepare($query);
		$array=array(':rating_from_id'=>$row1['employer_id'],':job_id'=>$job_id,':rating_to_id'=>$row1['employee_id']);
		$stmt->execute($array);
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		//~ echo "<pre>";print_r($row);"</pre>";
	//~ die;
		if(empty($row))
		{
			$query_insert="insert into rating(job_id,rating_from_id,rating_to_id,rating,feedback) values (:job_id,:user_id,:employee_id,:rating,:feedback)";
			$stmt_insert=$pdo->prepare($query_insert);
			$array_insert=array(':job_id'=>$job_id,':user_id'=>$user_id,':employee_id'=>$row1['employee_id'],':rating'=>$rating,':feedback'=>$feedback);
			$stmt_insert->execute($array_insert);
			
			
			//PUSH NOTIFICATION
				$query_noti="select * from register where user_id=:user_id";
				$stmt_noti=$pdo->prepare($query_noti);
				$array_noti=array(':user_id'=>$row1['employee_id']);
				$stmt_noti->execute($array_noti);
				$row_noti=$stmt_noti->fetch(PDO::FETCH_ASSOC); 
		        //~ echo "<pre>";print_r($row_noti);"</pre>";
				//~ die;
                
				if($row_noti['device_type']=='A')
			    {
					$message = ''.$row_noti['fullname'].' Rating on job '.$row['job_title'].'';
					//echo "android";
					android_noti1($row_noti['device_token'],$message,$noti_type='Rating');  
		        }
		        else
		        {
					$message = ''.$row_noti1['fullname'].' Rating on job '.$row['job_title'].'';
				    //echo "ios";
				    ios_noti($row_noti['device_token'],$message_data,$noti_type='Rating'); 
			    }
			    //PUSH NOTI END
			
			
			if($stmt_insert->rowCount())
			{
				$json=array('message'=>'Rating successfully');
				$message='success';
				$status='1';
			}
			else
			{
				$json=array();
				$status='0';
				$message='Some Server error..Try Again!';	
			}
		}
		else
		{
			$message='failure';
			$status='0';
			$json=array('id'=>'-2','message'=>'you have given rating already !');	
		}
	}
	else
	{
		    $message='failure';
			$status='0';
			$json=array();
		
	}	
	$json=array('status'=>$status,'message'=>$message,'data'=>$json);
	echo "{\"response\":" . json_encode($json) . "}";		
}
	

//http://traala.com/gruntwork/api.php?action=getStripeToken&user_id=13
function getStripeToken()
{
	global $pdo;
	extract($_REQUEST);
	$query="select * from stripe where employer_id=:user_id";
	$stmt=$pdo->prepare($query);
	$array=array(':user_id'=>$user_id);
	$stmt->execute($array);
	$row=$stmt->fetchAll(PDO::FETCH_ASSOC);
	if($row)
	{
		foreach($row as $value)
		{
		$json[]=array('user_id'=>$value['employer_id'],
				      'name'=>$value['name'],
				      'card_no'=>$value['card_no'],
				      'ex_month'=>$value['ex_month'],
				      'ex_year'=>$value['ex_year'],
				      'card_type'=>$value['card_type'],
				      'stripe_token'=>$value['stripe_token']
		             );  
		  $status='1';
		  $message='success';
	   }	
	}
	else
	{
		$json=array();
		$status='0';
		$message='success';	
	}
	$json=array('message'=>$message,'status'=>$status,'data'=>$json);
	echo "{\"response\":" . json_encode($json) . "}";	
}


//http://traala.com/gruntwork/api.php?action=workHistory&employee_id=73
function workHistory()
{
	global $pdo;
	extract($_REQUEST);
	$query="select * from jobHire where employee_id=:employee_id and employee_status=3";
	$stmt=$pdo->prepare($query);
	$array=array(':employee_id'=>$employee_id);
	$stmt->execute($array);
	$row=$stmt->fetchAll(PDO::FETCH_ASSOC);
	//~ echo "<pre>";print_r($row);"</pre>";
		//~ die;
	if($row)
	{
		foreach($row as $value)
		{
		$query1="select jp.job_title,jp.duration,jp.est_amount,jp.description,r.rating,r.feedback from jobPost jp,rating r 
		         where r.rating_to_id=:employee_id and jp.job_id=r.job_id and r.job_id=:job_id and  jp.status=3";
	    $stmt1=$pdo->prepare($query1);
	    $array1=array(':employee_id'=>$value['employee_id'],':job_id'=>$value['job_id']);
	    $stmt1->execute($array1);
	    $row1=$stmt1->fetch(PDO::FETCH_ASSOC);
	    
	    $json[]=array('employee_id'=>$value['employee_id'],
	                  'job_id'=>$value['job_id'],
	                  'job_title'=>$row1['job_title'],
	                  'duration'=>$row1['duration'],
					  'job_description'=>$row1['description'],
					  'est_amount'=>$row1['est_amount'],
					  'rating'=>$row1['rating'],
					  'feedback'=>$row1['feedback']
					   );
	    }
	    $json=array('message'=>'success','status'=>'1','data'=>$json);
		
      }
   else
   {
	  $json=array();
	  $json=array('message'=>'success','status'=>'0','data'=>$json); 
   }
   echo "{\"response\":" . json_encode($json) . "}";
}


function android_noti($registrationID,$message_data,$noti_type,$user_id)
{
  	$apiKey = "AAAASzXUix8:APA91bF3j60HTfR7Ih3ejOX9E8kQT6YK_bBPeIk0huHENaHKapHPoKMHfbwfqSiKiL1IsjvfB-PYzq0gRebT3SOY9EX0dpIY83ke5e2_LfatDOyEOtU1XKunDBvJ2J00LotOMsy_eB9b";
    $fields = array(
						'registration_ids'  => array($registrationID),
						'data'              => array("message" => $message_data,
						                             "noti_type" => $noti_type,
						                             "user_id" => $user_id
						                            )
				   );
	//echo"<pre>";print_r($fields);"</pre>";
	$url = 'https://fcm.googleapis.com/fcm/send';
	$headers = array( 
						'Authorization: key=' . $apiKey,
						'Content-Type: application/json'
					);
    $ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_POST, true );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
	$res = curl_exec($ch);
    echo"<pre>";print_r($res);"</pre>";
   
	
   
	if($res===FALSE)
	{
		die('Curl failed: ' . curl_erroe($ch));
	}
	curl_close($ch);	
}
function android_noti1($registrationID,$message_data,$noti_type)
{
  	$apiKey = "AAAASzXUix8:APA91bF3j60HTfR7Ih3ejOX9E8kQT6YK_bBPeIk0huHENaHKapHPoKMHfbwfqSiKiL1IsjvfB-PYzq0gRebT3SOY9EX0dpIY83ke5e2_LfatDOyEOtU1XKunDBvJ2J00LotOMsy_eB9b";
    $fields = array('registration_ids'  => array($registrationID),'data' => array("message" => $message_data,"noti_type" => $noti_type));
	//echo"<pre>";print_r($fields);"</pre>";
	$url = 'https://fcm.googleapis.com/fcm/send';
	$headers = array( 
						'Authorization: key=' . $apiKey,
						'Content-Type: application/json'
					);		
    $ch = curl_init();
    
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_POST, true );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
	$res = curl_exec($ch);
    //echo"<pre>";print_r($res);"</pre>";
	curl_close($ch);	
}

//http://traala.com/gruntwork/api.php?action=test_noti&device_token=fP_SKIEYRIY:APA91bE8WhYyFDuikqiRETiE_ovpIHYUwM70dr6Gi1jZQ-3xfxKm_mAV1u9qx7NJIKXVuDEbJmGNSqpaFgQ_1TpXifQMnhEFTG90l8dgJqEMnm4S6_xz5ZF6kb24y-UiITNRF2rDbgng
function test_noti()
{
	global $pdo;
	extract($_REQUEST);
	ios_noti($device_token,'asd','a');
}
function ios_noti($recivertok_id,$message_data,$type)
{  
	error_reporting(0);
		// Put your device token here (without spaces):
		$deviceToken = $recivertok_id;
		//echo $deviceToken;
		//echo $recivertok_id;
        // Put your private key's passphrase here:
        $passphrase = '';

       // Put your alert message here:
		$message_data = $message_data;
        //echo $message;
     

		$ctx = stream_context_create();
		//stream_context_set_option($ctx, 'ssl', 'local_cert', 'cabmaps.pem');
		stream_context_set_option($ctx, 'ssl', 'local_cert', 'CertificateGrunt.pem'); //9 march 2015
		//stream_context_set_option($ctx, 'ssl', 'local_cert', 'APNS_Sub_Lite.pem');
		stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

		// Open a connection to the APNS server
		$fp = stream_socket_client(
			'ssl://gateway.sandbox.push.apple.com:2195', $err,
			//'ssl://gateway.push.apple.com:2195', $err,
			$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

		if (!$fp)
			exit("Failed to connect: $err $errstr" . PHP_EOL);

			// echo 'Connected to APNS' . PHP_EOL;

			// Create the payload body
			$body['aps'] = array(
    
			'alert' => $message_data,
			'sound' => 'default',
			'message' => 'product', 
			'type' => $type, 
		);

		// Encode the payload as JSON
			$payload = json_encode($body);
		    //~ echo "<pre>";print_r($payload);"</pre>";
		//~ die;
			// Build the binary notification
			$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
			// Send it to the server
			$result = fwrite($fp, $msg, strlen($msg));

			//~ if (!$result)
				//~ echo 'Message not delivered' . PHP_EOL;
			//~ else
				//~ echo 'Message successfully delivered' . PHP_EOL;

			// Close the connection to the server
			fclose($fp);

}


//http://traala.com/gruntwork/api.php?action=jobSearch&jobTitle=milk&pageNo=1
function jobSearch()
{
	global $pdo;
	extract($_REQUEST);
    $Size='5';
	$query="select * from jobPost WHERE job_title LIKE '%$jobTitle%' OR description LIKE '%$jobTitle%' ORDER BY datetime desc";
	$stmt=$pdo->prepare($query);
	$stmt->execute();
	$row=$stmt->fetchAll(PDO::FETCH_ASSOC);
	//~ echo"<pre>";print_r($row);"</pre>";
	if($row)
	{
			
			//PAGINATION
			$totalCount = $stmt->rowCount();
			$total_pages = ceil($totalCount/$Size);
			$page = $pageNo;
			if(!isset($page)) 
			{
				$pageno = 1;
			} 
			else
			{
				$pageno = $page;
			}
			
			$starting_limit = ($pageno-1)*$Size;
			$show  = "select * from jobPost WHERE job_title LIKE '%$jobTitle%' OR description LIKE '%$jobTitle%' and status = 0 ORDER BY datetime desc LIMIT $starting_limit, $Size";
			$r = $pdo->prepare($show);
			$r->execute();
			if($r)
		    {
				foreach($r as $pro)
				{
					$query1="select * from register where user_id=:employer_id";
					$stmt1=$pdo->prepare($query1);
					$array1=array(':employer_id'=>$pro['employer_id']);
					$stmt1->execute($array1);
					$row1=$stmt1->fetch(PDO::FETCH_ASSOC);
					
					$data[]=array(  'job_id'=>$pro['job_id'],
									'employer_name'=>$pro['employer_name'],
									'employer_id'=>$pro['employer_id'],
									'job_title'=>$pro['job_title'],
									'description'=>$pro['description'],
									'job_type'=>$pro['job_type'],
									'duration'=>$pro['duration'],
									'est_amount'=>$pro['est_amount'],
									'datetime'=>$pro['datetime'],
									'location'=>$pro['location'],
									'success_rate'=>$pro['success_rate'],
									'bonus'=>$pro['bonus'],
									'rating'=>$pro['rating'],
									'image'=>$row1['profile_pic']
							   );
					$status='1';
					$message='success';           	
				}
			}	
		   }
		   else
		   {
				$json=array('status'=>'0','message'=>'No job found');
				echo "{\"response\":" . json_encode($json) . "}";
				die;
		   }	
	 $json=array('message'=>'success','status'=>'1','current_page'=>$pageNo,'page_size'=>$Size,'total_records'=>"$totalCount",'last_page'=>"$total_pages",'data'=>$data);
	 echo "{\"response\":" . json_encode($json) . "}";
}

//http://traala.com/gruntwork/api.php?action=send_email&user_id=13&user_type=1&email=sanu.rana@appzorro.com&message=abcd
function send_email()
{
	global $pdo;
	extract($_REQUEST);
    $query="select * from register where user_id=:user_id and user_type=:user_type";
    $stmt=$pdo->prepare($query);
    $array=array(':user_id'=>$user_id,':user_type'=>$user_type);
    $stmt->execute($array);
    $row=$stmt->fetch(PDO::FETCH_ASSOC); 
    if($row)
    {
		    $mail = new PHPMailer;
			$mail->CharSet = 'UTF-8';
			$mail->isSMTP();
			$mail->Host = 'mail.appzorro.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'gouravs@appzorro.com';
			$mail->Password = 'Zt{t6-Pd)$Ez';
			$mail->SMTPSecure = 'STARTTLS';
			$mail->Port = 587;
			$mail->setFrom($email);
			$mail->addReplyTo('surixon123@gmail.com');

			// Add a recipient
			$mail->addAddress('surixon123@gmail.com');
			$mail->Subject = 'Gruntwork Help';
		   
			// Set email format to HTML
			$mail->isHTML(true);

			// Email body content
			$mailContent = "<html><head></head><body>".$message."</body></html>";
			$mail->Body = $mailContent;
		    if(!$mail->send()) 
		    {
			   $json=array('status'=>'0','message'=>"Some server error.Try gain!");
			   echo 'Mailer Error: ' . $mail->ErrorInfo;
		    } 
		$json=array('message'=>'Email send successfully','status'=>'1');
	}
	else
	{
		   $json=array( 'status'=>'0','message'=>'No record found'); 
		
	}
	    
	    echo "{\"response\":" . json_encode($json) . "}";
}

//http://traala.com/gruntwork/api.php?action=userStat&user_id=76
function userStat()
{
	global $pdo;
	extract($_REQUEST);
    $Size='5';
	$query="SELECT COUNT(id) as ID FROM jobHire where employee_id=:user_id";
	$stmt=$pdo->prepare($query);
	$array=array(':user_id'=>$user_id);
	$stmt->execute($array);
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
    //echo"<pre>";print_r($row);"</pre>";
    if($row)
    {
		$query_count="SELECT COUNT(id) as COMP_ID FROM jobHire where employee_id=:user_id and employer_status=3 and employee_status = 3";
		$stmt_count=$pdo->prepare($query_count);
		$array_count=array(':user_id'=>$user_id);
		$stmt_count->execute($array_count);
		$row_count=$stmt_count->fetch(PDO::FETCH_ASSOC);
		//echo"<pre>";print_r($row_count);"</pre>";
		if($row_count['COMP_ID']!='0')
        {
	
	       $JobCompletionRate= $row_count['COMP_ID']/$row['ID'] * 100;
	       $json=array( 'status'=>'1','message'=>'success','jobSuccess'=>'70','jobCompleted'=>$row_count['COMP_ID'],'jobCompletedPercentage'=>"$JobCompletionRate");
	    }
	    else
	    {
		   $json=array( 'status'=>'1','message'=>'success','jobSuccess'=>'70','jobCompleted'=>$row_count['COMP_ID'],'jobCompletedPercentage'=>'0');
			
		}
	}	
	else
	{
		 $json=array( 'status'=>'0','message'=>'No record found');
	}
	echo "{\"response\":" . json_encode($json) . "}";
}
?>

	
