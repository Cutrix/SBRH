<div class="container-fluid">
<div class="content">
		<div class="header_content row">
			<h1 class="title_content">liste des utilisateurs</h1>
		</div>

		<div class="body_content row">

<div class="col-md-7 ml-5 mt-4" style="background: #fff; height: 500px; border-radius: 5px; border: 3px solid rgba(0,0,0,.2)">
<?php foreach ($users as $usr):?>
	<?php var_dump($usr->username)?>
<?php endforeach;?>

</div>
</div>
</div>
</div>

<script src="<?=js_url('jquery.min')?>"></script>