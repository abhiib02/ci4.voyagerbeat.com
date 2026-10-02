

  const loader  = document.getElementById('form-loader');
  const title   = document.getElementById('fl-title');
  const message = document.getElementById('fl-message');
  

  function showLoader(form) {
    title.textContent = form.dataset.loaderTitle || 'Please wait...';
    message.textContent = form.dataset.loaderMessage || '';
    loader.classList.add('show');
  }

  function hideLoader() {
    loader.classList.remove('show');
  }

  document.addEventListener('submit', function (e) {
    const form = e.target;
    if (e.defaultPrevented) return;
    if (form.dataset.submitting) { e.preventDefault(); return; }
    form.dataset.submitting = '1';
    setTimeout(() => form.querySelectorAll('[type=submit]').forEach(b => b.disabled = true), 0);
    showLoader(form);
  });