{
	const pwdInput = document.querySelector('#mdp');
	const pwdFeedBack = document.querySelector('#strength-output');
	const strengthStr = {
		0: 'Worst',
		1: 'Mauvais',
		2: 'Weak',
		3: 'Bon',
		4: 'Fort'
	};
	const canvasWrapper = document.querySelector('.canvas-wrapper');
	const canvas = document.querySelector('canvas');
	const poster = document.querySelector('.check_pwd');
	const posterImg = poster.style.backgroundImage.match(/\((.*?)\)/)[1].replace(/('|")/g,'');
	console.log(posterImg);

	imagesLoaded(poster, { background: true }, () => {
		document.body.classList.remove('loading');
	});


	const ctx = canvas.getContext('2d');
	const img = new Image();
	let imgRatio;
	let wrapperRatio;
	let newWidth;
	let newHeight;
	let newX;
	let newY;

	let pxFactor = 100;

	img.src = posterImg;
	img.onload = () => {
		const imgWidth = img.width;
		const imgHeight = img.height;
		imgRatio = imgWidth / imgHeight;
		setCanvasSize();
		render();
	}

	const setCanvasSize = () => {
		canvas.width = canvasWrapper.offsetWidth;
		canvas.height = canvasWrapper.offsetHeight;
	}

	const render = () => {
		const w = canvasWrapper.offsetWidth;
		const h = canvasWrapper.offsetHeight;

		newWidth = w;
		newHeight = h;
		newX = 0;
		newY = 0;
		wrapperRatio = newWidth / newHeight;

		if ( wrapperRatio > imgRatio ) {
			newHeight = Math.round(w / imgRatio);
			newY = (h - newHeight) / 2;
		}
		else {
			newWidth = Math.round(h * imgRatio);
			newX = (w - newWidth) / 2;
		}

		// pxFactor will depend on the current typed password.
		// values will be in the range [1,100].
		const size = pxFactor * 0.01;

		// turn off image smoothing - this will give the pixelated effect
		ctx.webkitImageSmoothingEnabled = size === 1;
		ctx.imageSmoothingEnabled = size === 1;

		ctx.clearRect(0, 0, canvas.width, canvas.height);
		// draw original image to the scaled size
		ctx.drawImage(img, 0, 0, w*size, h*size);
		// then draw that scaled image thumb back to fill canvas
		// As smoothing is off the result will be pixelated
		ctx.drawImage(canvas, 0, 0, w*size, h*size, newX, newY, newWidth+.05*w, newHeight+.05*h);
	};

	window.addEventListener('resize', () => {
		setCanvasSize();
		render();
	});

	pwdInput.addEventListener('input', () => {
		const val = pwdInput.value;
		const result = zxcvbn(val);
		// We want to reveal the image as the password gets stronger. Since the zxcvbn.score has
		// only 5 different values (0-4) we will use the zxcvbn.guesses_log10 output.
		// The guesses_log10 will be >= 11 when the password is considered strong,
		// so we want to map a factor of 3 (pixelated) to 100 (clear image) to
		// a value of 0 to 11 of guesses_log10.
		// This result will be used in the render function.
		pxFactor = -97/11*Math.min(11,Math.round(result.guesses_log10)) + 100 ;

		// so we see most of the time pixels rather than approaching a clear image sooner..
		if ( pxFactor !== 3 && pxFactor !== 100 ) {
			pxFactor -= pxFactor/100*50;
		}

		pwdFeedBack.innerHTML = val !== '' ? `Password strength: ${strengthStr[result.score]}` : '';
		render();
	});
}
