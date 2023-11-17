//JS FOR LAZY LOADING IMAGES
document.addEventListener("DOMContentLoaded", function () {
  const images = document.querySelectorAll("img");
  images.forEach(function (image) {
    image.setAttribute("loading", "lazy");
  });
});

//JS FOR HOMEPAGE -- BLUR SCROLLING IMAGES
const items = document.querySelectorAll(".scroller__inner");
items.forEach((item) => {
  item.addEventListener("mouseover", () => {
    items.forEach((otherItem) => {
      if (otherItem !== item) {
        otherItem.style.filter = "blur(3px)";
      }
    });
  });
  item.addEventListener("mouseout", () => {
    items.forEach((otherItem) => {
      otherItem.style.filter = "blur(0px)";
    });
  });
});

//JS FOR HOMEPAGE -- MAKING IMAGES MOVE CORRECTLY
const scrollers = document.querySelectorAll(".scroller");
if (!window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
  addAnimation();
}
function addAnimation() {
  scrollers.forEach((scroller) => {
    scroller.setAttribute("data-animated", true);
    const scrollerInner = scroller.querySelector(".scroller__inner");
    const scrollerContent = Array.from(scrollerInner.children);
    scrollerContent.forEach((item) => {
      const duplicatedItem = item.cloneNode(true);
      duplicatedItem.setAttribute("aria-hidden", true);
      scrollerInner.appendChild(duplicatedItem);
    });
  });
}

//JS FOR LOCATIONS.PHP -- ZOOMING LOCATIONS
var locs = document.querySelectorAll(".location");

locs.forEach(function (loc) {
  var locBg = loc.style.backgroundImage;
  var locContent = loc.querySelector(".loc__content");

  loc.addEventListener("mousemove", function (event) {
    var rect = loc.getBoundingClientRect();
    var mouseX = event.clientX - rect.left;
    var mouseY = event.clientY - rect.top;
    var percentX = mouseX / rect.width;
    var percentY = mouseY / rect.height;
    var zoom = "scale(1.2)";

    loc.style.backgroundPosition = percentX * 100 + "% " + percentY * 100 + "%";
    loc.style.backgroundImage = zoom + " " + locBg;
  });

  loc.addEventListener("mouseleave", function () {
    loc.style.backgroundPosition = "center";
    loc.style.backgroundImage = locBg;
  });
});

//JS FOR MUSIC.PHP AND STORE.PHP -- MAKE HTMX DIALOG BETTER (UX) (REPLACE DIALOG INNERHTML WITH A LOADER AFTER EXITING)
document.addEventListener("click", function (event) {
  if (event.target === document.getElementById("dialogElement")) {
    document.getElementById("dialogElement").close();
    document.getElementById("dialogElement").innerHTML =
      '<span class="loader"> </span>';
  }
});

//JS FOR MUSIC.PHP - MAKE FILTER BUTTONS AND SEARCHBAR WORK
const checkboxes = document.querySelectorAll("input[type=checkbox]");
const searchInput = document.getElementById("searchAlbums");
searchInput.addEventListener("input", function () {
  filterAlbums();
});
checkboxes.forEach((checkbox) => {
  checkbox.addEventListener("change", function () {
    filterAlbums();
  });
});
function filterAlbums() {
  const items = document.querySelectorAll(".album");
  const checkedBoxes = document.querySelectorAll(
    "input[type=checkbox]:checked"
  );
  const searchQuery = searchInput.value.toLowerCase();
  items.forEach((item) => {
    let show = true;
    if (checkedBoxes.length > 0) {
      show = false;
      checkedBoxes.forEach((box) => {
        if (item.classList.contains(box.name)) {
          show = true;
        }
      });
    }
    const title = item.querySelector("h2").textContent.toLowerCase();
    const artist = item
      .querySelector("span:nth-child(2)")
      .textContent.toLowerCase();
    const year = item
      .querySelector("span:nth-child(3)")
      .textContent.toLowerCase();
    if (
      searchQuery &&
      !(
        title.includes(searchQuery) ||
        artist.includes(searchQuery) ||
        year.includes(searchQuery)
      )
    ) {
      show = false;
    }
    if (show) {
      item.style.display = "block";
    } else {
      item.style.display = "none";
    }
  });
  if (!searchQuery && checkedBoxes.length === 0) {
    items.forEach((item) => {
      item.style.display = "block";
    });
  }
}

//JS FOR STORE.PHP -- CHANGE THE DIVS WHEN USER STARTS TYPING IN THE SEARCHBAR
const storeSearchInput = document.getElementById("searchAlbums");
const productShowDiv = document.getElementById("product-show");
const contentStoreDiv = document.getElementById("content-store");

storeSearchInput.addEventListener("input", function () {
  if (storeSearchInput.value.trim() === "") {
    productShowDiv.style.display = "block";
    contentStoreDiv.style.display = "none";
    contentStoreDiv.innerHTML =
      '<span class="loader" id="loading-indicator"></span>';
  } else {
    productShowDiv.style.display = "none";
    contentStoreDiv.style.display = "grid";
  }
});

if (storeSearchInput.value.trim() === "") {
  productShowDiv.style.display = "block";
  contentStoreDiv.style.display = "none";
  contentStoreDiv.innerHTML =
    '<span class="loader" id="loading-indicator"></span>';
} else {
  productShowDiv.style.display = "none";
  contentStoreDiv.style.display = "grid";
}

//JS FOR MUSIC.PHP -- SET COOKIE FOR STORE SEARCHING
function setSearchInputCookie(title) {
  document.cookie = "searchInput=" + title;
}

//JS FOR STORE.PHP -- DELETE THE COOKIE SET ABOVE
function deleteCookie(cookieName) {
  document.cookie = cookieName + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
}
deleteCookie("searchInput");

//JS FOR STORE.PHP -- CLOSE THE 'BUY PRODUCT' MODAL AFTER PRESSING ON THE BUTTON AND INCREMENT THE CART COUNT
function addToCartAndCloseDialog(cartCountId, dialogId) {
  var cartCountSpan = document.getElementById(cartCountId);
  var currentCount = parseInt(cartCountSpan.textContent);
  currentCount++;
  cartCountSpan.textContent = currentCount;

  var dialogElement = document.getElementById(dialogId);

  setTimeout(function () {
    dialogElement.close();
  }, 2000);

  setTimeout(function () {
    dialogElement.innerHTML = '<span class="loader"></span>';
  }, 2000);
}
