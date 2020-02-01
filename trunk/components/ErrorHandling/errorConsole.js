function console_toggle(togglediv, className)
{
	var detailsdiv = togglediv;
	do {
		detailsdiv = detailsdiv.nextSibling;
	} while(detailsdiv && detailsdiv.className != className);

	if(!detailsdiv || detailsdiv.className != className) {
		alert('detailsdiv not found');
		return;
	}

	if(detailsdiv.style.display == 'block') {
		detailsdiv.style.display = 'none';
		togglediv.innerHTML = '+';
	} else {
		detailsdiv.style.display = 'block';
		togglediv.innerHTML = '-';
	}
}
