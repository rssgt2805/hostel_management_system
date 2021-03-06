<?php
require_once('core/init.php');

$title = 'Home';
$options ='';
$user = new User();
if(!$user->isLoggedIn()){
	Session::flash('error','Please login to enter the website');
	Redirect::to('login.php');
}
if(Input::exists('get')&&($user->data()->GroupNo == 3)){
	$delMess = new Message();
	$delMess->delete_a_message(Input::get('deleting'));
}

require_once('functions/MessageBox.php');
$options = getNavBar($user->data()->GroupNo);


?>
<!DOCTYPE HTML>
<html manifest="MMC.appcahce" lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $title?></title>
<link rel="stylesheet" type="text/css" href="css/hostelRegistration.css">
</head>

<body>
	<!-- container -->
	<div id="container">
    	
        <!-- header -->
        <div id="header">
        <img src="image/project header.jpg" width="1024" height="100" />
        </div>
        <!-- end of header -->
        
        <!-- button -->
        <div id="NavBar">	
			<ul>
            	<li><a href="index.php">Home</a></li>
				<li><a href="EditForm.php">Edit Profile</a></li>
				<?php echo $options ?>
				<li><a href="Logout.php">Log Out</a></li>
			</ul>
		</div>
        <!-- end of button -->
        
        <!-- content -->
        <div id="content">
		<?php echo $title?>
		<h1>News Feed</h1>
		<?php
			$feed = new Message();
			if(!$feed->print_messages('feed',3)){
				echo '<br>'.'<br>'.'<br>'.'<br>';
				echo 'No feeds are in the database';
			}

		?>
        </div>
        <!-- end of content -->
        
        <!-- sidebar -->
        <div id="sidebar">

                
                <div id="Second_Box">
					<div id="Second_Head">
						<p align="center"> Messaging </p>
					</div>
                    
					<div id="Second_Body">
						<div id="MessagingForm">
							<form action="MessageBox.php" method="post" enctype="multipart/form-data" name="messageform" id="messageform" onsubmit="return validate_form();">
								<table align="center" cellpadding="1">
									<tr><td valign="right">Title :</td><td align="left"><input name="msgTitle" type="text" id="msgTitle" size="18" maxlength="24" /></td></tr>
									<tr><td valign="right">Body :<br><br><br><br><br><br><br><br></td><td align="left"><textarea name="msgBody" type="text" id="msgBody" size="15" cols="15" rows="10">Type your message here</textarea></td></tr>
									<tr><td valign="right">Type :</td><td align="left">
                                    										<select name="msgType">
																				<option value="private">Private</option>
																				<option value="feed" selected>Feed</option>
																			</select>	</td>
                                                                            </tr>
									<tr>
                                    	<td> To : </td>
                                        <td> <input name="msgReceipient" type="text" id="msgReceipient" size="18.5" maxlength="24"/> </td>
                                    </tr>
									<tr>
										<input name="token" type="hidden" value="<?php echo Token::generate();?>">
                                    	<td align="center" colspan="2"> <input name="Send" type="submit" value="Send" /> </td>
                                    </tr>
								</table>
							</form>
						</div>
					</div>
				</div>
        </div>
        <!-- end of sidebar -->
        
    </div>
    <!-- end of container --?
    
</body>
</html>
