// Fire event 3 seconds after page load to filter out immediate bounces/bots
window.addEventListener('DOMContentLoaded', () => {
  setTimeout(() => {
    fetch('/api/increasePackageVisitCount/' + PACKAGE_ID + '/visit');
  }, 3000);
});