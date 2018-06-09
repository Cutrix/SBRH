<body>
<div class="container-fluid" style="margin-top: 55px;">
	<div class="row">
		<div class="col-md-5 col-xs-12 col-sm-12 col-lg-6 check_pwd" style="background: url('../assets/img/money.jpg') no-repeat; background-size: cover;">

		</div>

		<div class="col-md-6 col-xs-12 col-sm-12 col-lg-6 auth_zone">
			<h1 class="py-3 px-3 jumbotron" style="font-weight: bold;">Connexion</h1>
			<form action="" method="post" style="font-size: 25px; border: 1px solid white;">
				<span class="input input--nao">

				<input type="text" name="login" id="login" class="input__field input__field--nao">
				<label for="" class="input__label input__label--nao">
					<span class="input__label-content">Username</span>
				</label>
				<svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60" preserveAspectRatio="none">
					<path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"></path>
				</svg>
				</span>

				<span class="input input--nao">

				<input type="password" name="pwd" id="pwd" class="input__field input__field--nao">
				<label for="" class="input__label input__label--nao">
					<span class="input__label-content">Mot de passe </span>
				</label>
				<svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60" preserveAspectRatio="none">
					<path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"></path>
				</svg>
				</span>

				<span class="input input--nao">
					<p class="form__password-strength" id="strength-output"></p>
					<input type="submit" value="Connexion" class="btn btn-primary text-center">
				</span>

			</form>
		</div>
	</div>
</div>

<script>document.documentElement.className="js";
var supportsCssVars=function(){var e,t=document.createElement("style");return t.innerHTML="root: { --tmp-var: bold; }",document.head.appendChild(t),e=!!(window.CSS&&window.CSS.supports&&window.CSS.supports("font-weight","var(--tmp-var)")),t.parentNode.removeChild(t),e};
supportsCssVars()||alert("Please view this demo in a modern browser that supports CSS Variables.");
</script>
<script src="<?=js_url('classie')?>"></script>
<script>
	(function() {
		// trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
		if (!String.prototype.trim) {
			(function() {
				// Make sure we trim BOM and NBSP
				var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
				String.prototype.trim = function() {
					return this.replace(rtrim, '');
				};
			})();
		}

		[].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
			// in case the input is already filled..
			if( inputEl.value.trim() !== '' ) {
				classie.add( inputEl.parentNode, 'input--filled' );
			}

			// events:
			inputEl.addEventListener( 'focus', onInputFocus );
			inputEl.addEventListener( 'blur', onInputBlur );
		} );

		function onInputFocus( ev ) {
			classie.add( ev.target.parentNode, 'input--filled' );
		}

		function onInputBlur( ev ) {
			if( ev.target.value.trim() === '' ) {
				classie.remove( ev.target.parentNode, 'input--filled' );
			}
		}
	})();
</script>
<script src="<?=js_url('imagesloaded.pkgd.min')?>"></script>
<script src="<?=js_url('zxcvbn')?>"></script>
<script src="<?=js_url('strenghtly')?>"></script>
</body>