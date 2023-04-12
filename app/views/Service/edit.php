<?php $this->view('shared/header', _('Edit a service appointment')); ?>

<?php $this->view('Client/detailsPartial',$data->getClient()); ?>

<form method="post" action="">
	<label><?= _('Description:') ?></label><textarea name="description"><?= $data->description ?></textarea><br>
	<label><?= _('Appointment date and time:') ?></label><input type="datetime-local" name="datetime" value="<?= \app\core\TimeHelper::DTOutBrowser($data->datetime) ?>"><br>
	<input type="submit" name="action" value='<?= _('Create') ?>'>
	<a href="/Service/index/<?= $data->client_id ?>"><?= _('Cancel') ?></a>
</form>

<?php $this->view('shared/footer'); ?>