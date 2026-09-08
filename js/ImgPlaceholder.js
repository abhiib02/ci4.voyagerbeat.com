 document.querySelectorAll('img').forEach((img) => {
     img.addEventListener('error', (e) => {
         img.src = '/assets/img/vb-placeholder.png';
     })
 })