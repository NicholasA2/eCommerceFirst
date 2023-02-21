<?php $this->view('shared/header', 'Log into your account'); ?>

USER PROFILE!!!

<h1>Messages</h1>

<h2>My messages</h2>

<table>
	<tr><th>sender</th><th>receiver</th><th>message</th><th>time</th><th>actions</th></tr>
<?php
//display all messages
foreach($data as $message){
	echo "<tr>
	<td>$message->sender</td>
	<td>$message->receiver</td>
	<td>$message->message</td>
	<td>$message->timestamp</td>
	<td><a href='/User/messageDelete/$message->message_id'>DELETE</a></td>
	</tr>";
}
?>
</table>
<h2>Send a message</h2>
<p>Send a message using the following form:</p>
<form action='/User/sendMessage' method='post'>

	<label>TO: <input type="text" name="receiver"></label><br/>
	<label>Message: <textarea name="message"></textarea></label><br/>
	<input type="submit" name="action" value="Send message">

</form>



<a href='User/logout'>Logout</a>

<?php $this->view('shared/footer'); ?>