<?php $this->view('shared/header', 'Your Profile'); ?>

<dl>
<dt>First name</dt>
<dd><?=$data->first_name?></dd>
<dt>Last name</dt>
<dd><?=$data->last_name?></dd>
<dt>Middle name</dt>
<dd><?=$data->middle_name?></dd>
</dl>

<a href='/Profile/edit'>Edit my profile</a>
<a href='/User/profile'>Back</a>

<?php $this->view('shared/footer'); ?>