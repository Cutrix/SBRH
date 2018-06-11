<?php if isset($register_success) echo "<script></script>"?>
<div class="container-fluid">
<div class="content">
		<div class="header_content row">
			<h1 class="title_content">Creation d'un utilisateur</h2>
		</div>

		<div class="body_content row">

<div class="col-md-7 ml-5 mt-4" style="background: #fff; height: 500px; border-radius: 5px; border: 3px solid rgba(0,0,0,.2)">

<?php
echo form_open();
$attrIden = array(
	'name'        => 'identity',
	'id'          => 'iden',
	'placeholder' => 'username',
	'email'       => 'text',
);
echo form_input($attrIden)."<br>";
$attrsPass = array(
	'name'        => 'pwd',
	'type'        => 'password',
	'id'          => 'pass',
	'placeholder' => 'password',
);
echo form_input($attrsPass)."<br>";
$attrEmail = array(
	'name'        => 'email',
	'type'        => 'email',
	'placeholder' => 'Email',
	'id'          => 'mail',
);
echo form_input($attrEmail)."<br>";
?>
<label for="gru">Groupe utilisateur</label>
<select name="groups" id="gru">
<?php foreach ($users as $usr):?>
<option value="<?=($usr->id)?>"><?=($usr->name)?></option>
<?php endforeach;?>
</select><br>
<?php
$attrSub = array(
	'class' => 'btn btn-success',
);
echo form_submit($attrSub, 'Creer utilisateur')."<br>";
echo form_close();
?>
</div>
</div>
</div>
</div>
