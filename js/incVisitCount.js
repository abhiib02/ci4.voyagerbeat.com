// Fire event 3 seconds after page load to filter out immediate bounces/bots
window.addEventListener('DOMContentLoaded', () => {
  setTimeout(() => {
    fetch('increasePackageVisitCount' + PACKAGE_ID + '/visit', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ referrer: document.referrer })
    });
  }, 3000);
});