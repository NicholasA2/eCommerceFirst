<?php $this->view('shared/header',_('List of service appointments for the client')); ?>

<?php $this->view('Client/detailsPartial', $data); ?>

<a href='/Service/create/<?data->client_id ?>'><?= _('Create a new service appointment') ?></a>
<table>
	<tr><th><?= _('Date and Time') ?></th><th><?= _('Description') ?></th><th><?= _('actions') ?></th></tr>
<?php
//$data is an array of client objects
$services = $data->getServices();
foreach ($services as $service) { ?>
	<tr><td><?= TimeHelper::DTOutput($service) ?></td><!--TODO: output internationalized date -->
		<td><?= $service->description ?></td>
		<td><a href='/Service/delete/<?=$client->client_id?>'><?= _('delete') ?></a> | 
			<a href='/Service/edit/<?=$client->client_id?>'><?= _('edit') ?></a></td></tr>
<?php

}
?>
</table>
<?php $this->view('shared/footer'); ?>