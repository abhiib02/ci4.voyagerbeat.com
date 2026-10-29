function downloadURI(uri, name) {
	var link = document.createElement("a");
	link.setAttribute('download', name);
	link.href = uri+'?v='+ Date.now();
	document.body.appendChild(link);
	link.click();
	link.remove();
}