<?php if (isset($register_succes)) {echo "<script>alert('utilisateur bien entrgistree')</script>";
}
?>
<div class="container mr-0 py-3 px-3" style="">
	<div class="row">
			<div class="col-md-12">
				<div class="content">
					<div class="header_content row bg-primary px-3 py-2" style="border-radius: 5px">
						<h1 class="title_content">Creation d'un utilisateur</h1>
					</div>

					<div class="body_content row py-3 px-3" style="border: 1px solid blue;">

			<div class="col-md-12 py-2">

				<div class="col-md-8">
<?php
echo form_open();
?>
<div class="col-md-12">
<?php
$attrName = array(
	'name'        => 'nom',
	'placeholder' => 'Nom',
	'type'        => 'text',
	'class'       => 'form-control',
);
echo form_input($attrName)."<br>";
?>
</div>

<div class="col-md-12">
<?php
$attrName = array(
	'name'        => 'prenom',
	'placeholder' => 'Prenom',
	'type'        => 'text',
	'class'       => 'form-control',
);
echo form_input($attrName)."<br>";
?>
</div>

<div class="col-md-12">
<?php
$attrIden = array(
	'name'        => 'identity',
	'id'          => 'iden',
	'placeholder' => 'login',
	'email'       => 'text',
	'class'       => 'form-control input-md',
	'style'       => "width:100%",
);
echo form_input($attrIden)."<br>";
?>
</div>
		<div class="col-md-12">
<?php
$attrsPass = array(
	'name'        => 'pwd',
	'type'        => 'password',
	'id'          => 'pass',
	'placeholder' => 'password',
	'value'       => strtolower(genPwd()),
	'style'       => 'display: inline-block',
	'class'       => 'form-control'
);
echo form_input($attrsPass);
?>
<div style="display: inline-block;">

			<button type="button" class="btn btn-primary" id="unlock"><span class="fa fa-lock"></span></button>
		</div>
		</div><br>
		<div class="col-md-12">
<?php
$attrEmail = array(
	'name'        => 'email',
	'type'        => 'email',
	'placeholder' => 'Email',
	'id'          => 'mail',
	'class'       => 'form-control',
);
echo form_input($attrEmail)."<br>";
?>
</div>
		<div class="col-md-12">
		<small id="output_email"></small>
				<br>
			<label for="gru">Groupe utilisateur</label>
			<select name="groups" id="gru">
<?php foreach ($users as $usr):?>
			<option value="<?=($usr->id)?>"><?=($usr->description)?></option>
<?php endforeach;?>
</select>
		</div>
		<br>

<?php
$attrSub = array(
	'class' => 'btn btn-success',
);
echo form_submit($attrSub, "Creer utilisateur")."<br>";
echo form_close();
?>


			</div>


			</div>
			</div>
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
			url: "<?=base_url()?>MyAuth/createUserAjax",
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
