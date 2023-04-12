<dl>
	<dt><?= _('Description:') ?></dt>
	<dd><?= $data->description ?></dd>

	<dt><?= _('Appointment date and time:') ?></dt>
	<dd><?= \app\core\TimeHelper::DTOutput($data->datetime) ?></dd>
</dl>