<?php
// getting value for post param
$room = $_POST['room'];

// checking string size

if(strlen($room)>20 or strlen($room)<2)
{
	$message = "Please Choose a name between 2 to 20 characters";
	echo '<script language="javascript">';
	echo 'alert("'.$message.'");';
	echo 'window.location="https://rahul214.github.io/MyPersonalChat";';
	echo '</script>';
}
// check string is alphanum

else if(!ctype_alnum($room))
{
	$message = "Please Choose an alphanumeric name";
	echo '<script language="javascript">';
	echo 'alert("'.$message.'");';
	echo 'window.location="https://rahul214.github.io/MyPersonalChat";';
	echo '</script>';	
}
else
{
	//connecting to database
	include 'db_connect.php';
}
//check if room already exists
$sql = "SELECT * FROM `rooms` WHERE roomname = '$room'";
$result = mysqli_query($conn,$sql);
if($result)
{
	if(mysqli_num_rows($result)>0)
	{
	$message = "Please Choose different room. This room is already claimed.";
	echo '<script language="javascript">';
	echo 'alert("'.$message.'");';
	echo 'window.location="https://rahul214.github.io/MyPersonalChat";';
	echo '</script>';
	}
	else
	{
		$sql = "INSERT INTO `rooms` (`roomname`, `stime`) VALUES ('$room', current_timestamp());";
		if(mysqli_query($conn,$sql))
		{
			$message = "Your room is ready. Start Chatting now.";
			echo '<script language="javascript">';
			echo 'alert("'.$message.'");';
			echo 'window.location="https://rahul214.github.io/MyPersonalChat.php?roomname='.$room.'";';
			echo '</script>';
		}
	}
}
else
{
	echo "Error: ".mysqli_error($conn);
}
?>