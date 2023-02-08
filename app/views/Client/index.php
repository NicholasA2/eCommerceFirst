<?php $this->view('shared/header', 'List of clients'); ?>

<table>
	<tr><th>First name</th><th>actions</th></tr><tr><th>Last name</th><th>actions</th></tr><tr><th>Middle name</th><th>actions</th></tr>
<?php
//$data is an array of client objects
foreach($data as $key=>$logEntry) { ?>
	<tr><td><?= htmlentities($client->first_name) ?></td>
		<tr><td><?= htmlentities($client->last_name) ?></td>
		<tr><td><?= htmlentities($client->middle_name) ?></td>
		<td><a href='/Client/delete/<?=$client->client_id?>'>delete</a></td></tr>
<?php 

}
?>
</table>
<?php $this->view('shared/footer'); ?>