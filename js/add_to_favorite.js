// /////////// Travel Card JS //////////////////////////////////////
// ///////////////////////////////// add to favorite /////////////////////////////////////////

// function RefreshButtons() {
//     let t = [];
//     null == localStorage.getItem("Favorite_Arr") && localStorage.setItem("Favorite_Arr", JSON.stringify(t)), (t = JSON.parse(localStorage.getItem("Favorite_Arr")));
//     document.querySelectorAll(".like").forEach((e) => {
//         t.includes(e.getAttribute("data-id")) ?
//             (e.innerHTML = `<span class="${e.getAttribute("data-count") == 0 ? '': 'like_count'}" id="lc${e.getAttribute("data-id")}">${e.getAttribute("data-count") == 0 ? '': e.getAttribute("data-count")}</span><i class="bx bxs-heart red-text added like_animation" onclick="remFav(${e.getAttribute("data-id")})"></i>`):
//             (e.innerHTML = `<span class="${e.getAttribute("data-count") == 0 ? '': 'like_count'}" id="lc${e.getAttribute("data-id")}">${e.getAttribute("data-count") == 0 ? '': e.getAttribute("data-count")}</span><i class="bx bx-heart" onclick="addFav(${e.getAttribute("data-id")})"></i>`)
//     });
// }

// function RefreshButtons2() {
//     let t = [];
//     null == localStorage.getItem("Favorite_Arr") && localStorage.setItem("Favorite_Arr", JSON.stringify(t)), (t = JSON.parse(localStorage.getItem("Favorite_Arr")));
//     document.querySelectorAll(".package_like").forEach((e) => {
//         t.includes(e.getAttribute("data-id")) ?
//             (e.innerHTML = `<i class="bx bx-heart red-text added like_animation" style="font-size:2em;" onclick="remFav(${e.getAttribute("data-id")})"></i>`) :
//             (e.innerHTML = `<i class="bx bx-heart " style="font-size:2em;" onclick="addFav(${e.getAttribute("data-id")})"></i>`)
//     });
// }

// async function fetchFavorite(r, dec) {

//     const requestOptions = {
//         method: 'GET',
//         headers: {
//             'Content-Type': 'application/json'
//         },
//     };
//     if (dec === true) {
//         fetch(`https://voyagersbeat.com/Dec/${r}`, requestOptions)
//             .then(response => response.json())
//             .then(data => console.log(data.message));

//     }
//     if (dec === false) {
//         fetch(`https://voyagersbeat.com/Inc/${r}`, requestOptions)
//             .then(response => response.json())
//             .then(data => console.log(data.message));

//     }
// }

// function addFav(package_id) {

//     let Favorite_Arr = [];
//     null == localStorage.getItem("Favorite_Arr") && localStorage.setItem("Favorite_Arr", JSON.stringify(Favorite_Arr)),
//         (Favorite_Arr = JSON.parse(localStorage.getItem("Favorite_Arr"))).push(package_id.toString()),
//         (Favorite_Arr = [...new Set(Favorite_Arr)]),
//         localStorage.removeItem("Favorite_Arr"),
//         localStorage.setItem("Favorite_Arr", JSON.stringify(Favorite_Arr)),
//         fetchFavorite(package_id, false);

//     RefreshButtons();
//     RefreshButtons2();
//     incLikeCount(package_id);
// }

// function remFav(package_id) {

//     //console.log("remFav run");
//     let Favorite_Arr = [];
//     if (null == localStorage.getItem("Favorite_Arr")) return;
//     let package_id_Index_Favorite_Arr = (Favorite_Arr = JSON.parse(localStorage.getItem("Favorite_Arr"))).indexOf(package_id.toString());

//     Favorite_Arr.splice(package_id_Index_Favorite_Arr, 1), (Favorite_Arr = [...new Set(Favorite_Arr)]), localStorage.removeItem("Favorite_Arr");
//     localStorage.setItem("Favorite_Arr", JSON.stringify(Favorite_Arr));
//     fetchFavorite(package_id, true);
//     RefreshButtons();
//     RefreshButtons2();
//     decLikeCount(package_id);
// }

// function incLikeCount(package_id) {

//     document.querySelector("#lc" + package_id).textContent = parseInt(document.querySelector("#lc" + package_id).textContent) + 1;
// }
// function decLikeCount(package_id) {

//     document.querySelector("#lc" + package_id).textContent = parseInt(document.querySelector("#lc" + package_id).textContent) - 1;
// }

/////////////////////////// Travel Card JS ///////////////////////////
var HOSTNAME = window.location.hostname;
var PROTOCOL = window.location.protocol;
function showFavOnly() {
  let e = document.querySelector(".showFav"),
    s = document.querySelectorAll(".travel_card_new");
  if (e.classList.contains("pressed")) {
    (e.classList.remove("pressed"),
      s.forEach((e) => {
        e.classList.remove("hide");
      }));
    return;
  }
  e.classList.add("pressed");
  let t = [];
  ((t = JSON.parse(localStorage.getItem("Favorite_Arr"))),
    s.forEach((e) => {
      t.includes(e.getAttribute("title")) || e.classList.add("hide");
    }));
}

// ---------- Helpers ----------
function getFavorites() {
  return JSON.parse(localStorage.getItem("Favorite_Arr")) || [];
}

function saveFavorites(favArr) {
  localStorage.setItem("Favorite_Arr", JSON.stringify([...new Set(favArr)]));
}

// ---------- Backend Call ----------
async function fetchFavorite(package_id, isRemove) {
  const endpoint = isRemove
    ? `${PROTOCOL}//${HOSTNAME}/api/DecFavorite/${package_id}`
    : `${PROTOCOL}//${HOSTNAME}/api/IncFavorite/${package_id}`;

  try {
    const res = await fetch(endpoint, {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    });
    const data = await res.json();
    console.log(data.message);
  } catch (err) {
    console.error("Error updating favorite count:", err);
  }
}

// ---------- Like Counter ----------
function incLikeCount(package_id) {
  const el = document.querySelector("#lc" + package_id);
  if (el) el.textContent = parseInt(el.textContent || "0") + 1;
}

function decLikeCount(package_id) {
  const el = document.querySelector("#lc" + package_id);
  if (el) el.textContent = Math.max(0, parseInt(el.textContent || "0") - 1);
}

// ---------- Toggle Favorite (updates only clicked button) ----------
function toggleFav(package_id, el) {
  let favArr = getFavorites();
  const packageIdStr = package_id.toString();
  const index = favArr.indexOf(packageIdStr);

  // find current count from DOM instead of data-count
  let countEl = document.querySelector("#lc" + packageIdStr);
  let currentCount =
    countEl.textContent.trim() === "" ? 0 : parseInt(countEl.textContent);
  console.log(countEl);
  el.innerHTML = ""; // clear existing content
  if (index === -1) {
    // Add to favorites
    favArr.push(packageIdStr);
    saveFavorites(favArr);
    fetchFavorite(package_id, false);
    currentCount++; // increment likes

    el.setAttribute("data-count", currentCount); // sync attribute
    el.innerHTML = `
            <i class="bx bxs-heart text-danger added like_animation" ></i>
            <span class="${currentCount == 0 ? "" : "like_count"}" id="lc${packageIdStr}">${currentCount == 0 ? "" : currentCount}</span>
        `;
  } else {
    // Remove from favorites
    favArr.splice(index, 1);
    saveFavorites(favArr);
    fetchFavorite(package_id, true);
    currentCount = Math.max(0, currentCount - 1); // decrement likes, prevent negative

    el.setAttribute("data-count", currentCount); // sync attribute
    el.innerHTML = `
            <i class="bx bx-heart"></i>
            <span class="${currentCount == 0 ? "" : "like_count"}" id="lc${packageIdStr}">
                ${currentCount == 0 ? "" : currentCount}
            </span>
        `;
  }
}

// ---------- Refresh UI (used only at page load / init) ----------
function RefreshButtons() {
  const favArr = getFavorites();
  document.querySelectorAll(".like").forEach((el) => {
    const packageId = el.getAttribute("data-id");
    const count = el.getAttribute("data-count");
    el.innerHTML = ""; // clear existing content
    if (favArr.includes(packageId)) {
      el.innerHTML = `
                <i class="bx bxs-heart red-text added "></i>
                <span class="${count == 0 ? "" : "like_count"}" id="lc${packageId}">
                    ${count == 0 ? "" : count}
                </span>
                
            `;
    } else {
      el.innerHTML = `
                <i class="bx bx-heart" ></i>
                <span class="${count == 0 ? "" : "like_count"}" id="lc${packageId}">
                    ${count == 0 ? "" : count}
                </span>
                
            `;
    }
  });
}

function RefreshButtons2() {
  const favArr = getFavorites();
  document.querySelectorAll(".package_like").forEach((el) => {
    const packageId = el.getAttribute("data-id");
    el.innerHTML = ""; // clear existing content
    if (favArr.includes(packageId)) {
      el.innerHTML = `<i class="bx bx-heart red-text added " style="font-size:2em;"></i>`;
    } else {
      el.innerHTML = `<i class="bx bx-heart" style="font-size:2em;"></i>`;
    }
  });
}

// ---------- Init on Page Load ----------
document.addEventListener("DOMContentLoaded", () => {
  RefreshButtons();
  RefreshButtons2();
});
