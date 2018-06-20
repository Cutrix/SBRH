<?php if (isset($register_succes)) {echo "<script>alert('utilisateur bien entrgistree')</script>";
}
?>
<div class="container-fluid">
<div class="content">
		<div class="header_content row">
			<h1 class="title_content">Creation d'un utilisateur</h1>
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
	'value'       => strtolower(genPwd())
);
echo form_input($attrsPass)."<br>";
?>
<button type="button" class="btn btn-primary" id="unlock"><span class="fa fa-lock fa-2x text-right"></span></button>
<?php
$attrEmail = array(
	'name'        => 'email',
	'type'        => 'email',
	'placeholder' => 'Email',
	'id'          => 'mail'
);
echo form_input($attrEmail)."<br>";
?>
	<small id="output_email"></small>
	<br>
<label for="gru">Groupe utilisateur</label>
<select name="groups" id="gru">
<?php foreach ($users as $usr):?>
<option value="<?=($usr->id)?>"><?=($usr->description)?></option>
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

<script src="<?=js_url('jquery.min')?>"></script>
<script>
	$(function() {
		var $pass = $('#pass')
		$('#unlock').on('mouseover', function(e) {
			$pass.attr('type', 'text')
			$('#unlock span').removeClass('fa-lock')
			$('#unlock span').addClass('fa-unlock')

		})

		$('#unlock').on('mouseout', function(e) {
			$pass.attr('type', 'password')
			$('#unlock span').removeClass('fa-unlock')
			$('#unlock span').addClass('fa-lock')

		})

	})
</script>
<script>
	$('#mail').on('keyup', () => {
		$.ajax({
			url: "<?= base_url() ?>MyAuth/createUserAjax",
			method: "post",
			data: {email_aj : $('#mail').val()},
			success: (data) => {
				if (data === 'ok') {
					$('#output_email').html('<span style="color: red">Email deja enregistre</span>')
				} else {
					$('#output_email').html('')
				}
			}
		})
	})
</script>
