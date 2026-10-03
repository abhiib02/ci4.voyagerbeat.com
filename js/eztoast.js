function runToast(message, status, duration) {
  let styleTag = document.createElement("style");
  styleTag.innerHTML = `
  
  .eztoast{
  padding:10px;
  min-width:100px;
  width:fit-content;
  height:auto;
  position:fixed;
  top:100px;
  right:50px;
  border-radius:5px;
  border:1px solid var(--status,#aaa);
  background-color:color-mix(in srgb, var(--status,#aaa) 20%, #fff);
  box-shadow:1px 1px 2px #999;
  opacity:0;
  pointer-events:none;
  z-index:10000;
  & p {
    font-size:14px;
    font-weight:bold;
    color:#222 !important;
    margin: 0;
  }
}
.toast-show{
  animation:delete var(--duration,4s) ease forwards;
}
@keyframes delete{
  0%{
    translate:0 -100px;
    display:block;
    opacity:1;
  }
  10%{
    translate:0 0px;
    display:block;
    opacity:1;
  }
  90%{
    translate: 0 0px;
    display:block;
    opacity:1;
  }
  100%{
    translate: 0 100px;
    opacity:0;
    display:none;
  }
}`;
  let toast = document.createElement("div");
  toast.classList.add("eztoast");
  document.body.appendChild(styleTag);
  document.body.appendChild(toast);

  let statusObject = {
    danger: "#dc3545",
    warning: "#ffc107",
    success: "#198754",
    info: "#0d6efd",
  };
  if (status) {
    toast.style.setProperty("--status", statusObject[status.toLowerCase()]);
  }
  if (duration) {
    toast.style.setProperty("--duration", duration);
  }

  toast.innerHTML = `<p>${message}</p>`;
  toast.classList.add("toast-show");
  toast.addEventListener("animationend", () => {
    document.body.removeChild(toast);
    document.body.removeChild(styleTag);
  });
}
