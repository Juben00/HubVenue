const usertype = document.getElementById("usertype").innerHTML;
const posted = document.getElementById("posted");
const rents = document.getElementById("rents");
const saved = document.getElementById("saved");
const postTrigger = document.getElementById("post_trigger");

// Cache for storing content
let cachedPosted = null;
let cachedRents = null;
let cachedSaved = null;

document.addEventListener("DOMContentLoaded", function () {
  if (usertype === "user") {
    posted.classList.add("hidden");
    postTrigger.classList.add("hidden");
    rents.click();
  } else {
    posted.click();
  }
});

if (usertype === "user") {
  posted.classList.add("hidden");
  rents.click();
  rents.classList.add("bg-neutral-600");
}

posted.addEventListener("click", async () => {
  posted.classList.add("bg-neutral-600");
  saved.classList.remove("bg-neutral-600");
  rents.classList.remove("bg-neutral-600");
  postTrigger.classList.remove("hidden");
  postTrigger.classList.add("block");

  // If cached content is available, use it
  if (cachedPosted) {
    updateProfileDisp(cachedPosted);
    return;
  }

  try {
    const response = await fetch("./api/fetchPost.api.php");

    if (!response.ok) {
      throw new Error("Network response was not ok");
    }

    const html = await response.text();

    if (html) {
      cachedPosted = html; // Cache the content
      updateProfileDisp(html);
    }
  } catch (error) {
    console.error("Error:", error);
  }
});

rents.addEventListener("click", async () => {
  rents.classList.add("bg-neutral-600");
  saved.classList.remove("bg-neutral-600");
  posted.classList.remove("bg-neutral-600");
  postTrigger.classList.add("hidden");

  // If cached content is available, use it
  if (cachedRents) {
    updateProfileDisp(cachedRents);
    return;
  }

  try {
    const response = await fetch("./api/fetchRent.api.php");

    if (!response.ok) {
      throw new Error("Network response was not ok");
    }

    const html = await response.text();

    if (html) {
      cachedRents = html; // Cache the content
      updateProfileDisp(html);
    }
  } catch (error) {
    console.error("Error:", error);
  }
});

saved.addEventListener("click", async () => {
  rents.classList.remove("bg-neutral-600");
  saved.classList.add("bg-neutral-600");
  posted.classList.remove("bg-neutral-600");
  postTrigger.classList.add("hidden");

  // If cached content is available, use it
  if (cachedSaved) {
    updateProfileDisp(cachedSaved);
    return;
  }

  try {
    const response = await fetch("./api/fetchSaved.api.php");

    if (!response.ok) {
      throw new Error("Network response was not ok");
    }

    const html = await response.text();

    if (html) {
      cachedSaved = html; // Cache the content
      updateProfileDisp(html);
    }
  } catch (error) {
    console.error("Error:", error);
  }
});

function updateProfileDisp(html) {
  const profiledisp = document.getElementById("profiledisp");
  profiledisp.innerHTML = html;
}

// Function to check if the date is in the past in JavaScript
function isDateInThePast(endDate, checkOut) {
  const dateTimeString = `${endDate} ${checkOut}`;
  const rentEndDate = new Date(dateTimeString);
  const now = new Date();

  return rentEndDate < now;
}

function updateRentStatus() {
  const rentStatusElements = document.querySelectorAll(".enddatecheck");

  rentStatusElements.forEach((el) => {
    const endDate = el.getAttribute("data-end-date");
    const checkOut = el.getAttribute("data-check-out");

    if (isDateInThePast(endDate, checkOut)) {
      el.classList.remove("bg-green-500");
      el.classList.add("bg-red-500");
    } else {
      el.classList.remove("bg-red-500");
      el.classList.add("bg-green-500");
    }
  });
}

// Call the function immediately on page load
updateRentStatus();

// Optionally, set an interval to keep checking the status every minute (or any interval you prefer)
setInterval(updateRentStatus, 100);

const uploadBtn = document.getElementById("uploadbtn");
const uploadForm = document.getElementById("upload_form");
let isVisible = false;

const toggleFormVisibility = (visible) => {
  if (visible) {
    uploadForm.classList.remove("hidden");
    uploadForm.classList.add("flex", "flex-col");
  } else {
    uploadForm.classList.add("hidden");
    uploadForm.classList.remove("flex", "flex-col");
  }
  isVisible = visible;
};

uploadBtn.addEventListener("click", (e) => {
  e.stopPropagation();
  toggleFormVisibility(!isVisible);
});

document.addEventListener("click", (e) => {
  if (
    isVisible &&
    !uploadForm.contains(e.target) &&
    !uploadBtn.contains(e.target)
  ) {
    toggleFormVisibility(false);
  }
});

postTrigger.addEventListener("click", () => {
  console.log("post triggered");
});
