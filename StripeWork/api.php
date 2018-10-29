<?php 

 $action=$_REQUEST['action'];
 switch($action)
{
	
	case 'stripe_payment':
		stripe_payment();
		break;
         
}

function stripe_payment()
{   
		//traala.com/trainee/stripe_payment/api.php?action=stripe_payment&amount=50&stripeToken=token
		extract($_REQUEST);
		require_once('stripe_pay/init.php');
		Stripe\Stripe::setApiKey('sk_test_7T68y1h1K5wRgCkE90WSyBrR');
		$charge = Stripe\Charge::create(array(
					  "amount" => $amount,
					  "currency" => "usd",
					  "card" => $stripeToken,
					  "description" => "Charge for Facebook Login code."
					));
					
		//~ echo $charge['outcome'];
		$row= $charge['outcome']['network_status'];
		echo $row;
		
		$json=array('id'=>"1",'message'=>'Payment successfull');
		//~ echo"<pre>";print_r($json['status']);"</pre>";
		//~ die;
		echo "{\"response\":" . json_encode($json) . "}";
}
?>
