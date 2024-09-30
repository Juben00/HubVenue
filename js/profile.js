const usertype = document.getElementById("usertype").innerHTML;
const posted = document.getElementById("posted");
const rents = document.getElementById("rents");
const saved = document.getElementById("saved");
const uploadPropertyForm = document.getElementById("upload_property_form");
const postTrigger = document.getElementById("post_trigger");

// Cache for storing content
let cachedPosted = null;
let cachedRents = null;
let cachedSaved = null;

// Utility function to handle adding/removing class lists
function toggleActive(element, isActive) {
  if (isActive) {
    element.classList.add(
      "bg-neutral-400",
      "font-semibold",
      "text-neutral-100"
    );
  } else {
    element.classList.remove(
      "bg-neutral-400",
      "font-semibold",
      "text-neutral-100"
    );
  }
}

// Handle page load
document.addEventListener("DOMContentLoaded", function () {
  if (usertype === "user") {
    posted.classList.add("hidden");
    postTrigger.classList.add("hidden");
    rents.click();
  } else {
    posted.click();
  }
});

// Set initial view based on user type
if (usertype === "user") {
  posted.classList.add("hidden");
  rents.click();
  toggleActive(rents, true);
}

// Handle the 'Posted' tab click event
posted.addEventListener("click", async () => {
  toggleActive(posted, true);
  toggleActive(saved, false);
  toggleActive(rents, false);
  postTrigger.classList.remove("hidden");
  postTrigger.classList.add("flex");

  // Use cached content if available
  if (cachedPosted) {
    updateProfileDisp(cachedPosted);
    return;
  }

  // Fetch the 'Posted' content
  try {
    const response = await fetch("./api/fetchPost.api.php");
    if (!response.ok) throw new Error("Network response was not ok");
    const html = await response.text();
    if (html) {
      cachedPosted = html;
      updateProfileDisp(html);
    }
  } catch (error) {
    console.error("Error:", error);
  }
});

// Handle the 'Rents' tab click event
rents.addEventListener("click", async () => {
  toggleActive(rents, true);
  toggleActive(saved, false);
  toggleActive(posted, false);

  // Use cached content if available
  if (cachedRents) {
    updateProfileDisp(cachedRents);
    return;
  }

  // Fetch the 'Rents' content
  try {
    const response = await fetch("./api/fetchRent.api.php");
    if (!response.ok) throw new Error("Network response was not ok");
    const html = await response.text();
    if (html) {
      cachedRents = html;
      updateProfileDisp(html);
    }
  } catch (error) {
    console.error("Error:", error);
  }
});

// Handle the 'Saved' tab click event
saved.addEventListener("click", async () => {
  toggleActive(saved, true);
  toggleActive(rents, false);
  toggleActive(posted, false);

  // Use cached content if available
  if (cachedSaved) {
    updateProfileDisp(cachedSaved);
    return;
  }

  // Fetch the 'Saved' content
  try {
    const response = await fetch("./api/fetchSaved.api.php");
    if (!response.ok) throw new Error("Network response was not ok");
    const html = await response.text();
    if (html) {
      cachedSaved = html;
      updateProfileDisp(html);
    }
  } catch (error) {
    console.error("Error:", error);
  }
});

// Function to update the content display
function updateProfileDisp(html) {
  const profiledisp = document.getElementById("profiledisp");
  profiledisp.innerHTML = html;
}

// Utility function to check if a date is in the past
function isDateInThePast(endDate, checkOut) {
  const dateTimeString = `${endDate} ${checkOut}`;
  const rentEndDate = new Date(dateTimeString);
  const now = new Date();
  return rentEndDate < now;
}

// Function to update the rent status on the page
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

// Check rent status on page load and at regular intervals
updateRentStatus();
setInterval(updateRentStatus, 100);

// Handle property add form visibility toggle
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

// Toggle the visibility of the upload form
uploadBtn.addEventListener("click", (e) => {
  e.stopPropagation();
  toggleFormVisibility(!isVisible);
});

// Close the upload form if clicking outside of it
document.addEventListener("click", (e) => {
  if (
    isVisible &&
    !uploadForm.contains(e.target) &&
    !uploadBtn.contains(e.target)
  ) {
    toggleFormVisibility(false);
  }
});

// Handle the property add form trigger
postTrigger.addEventListener("click", () => {
  window.scrollTo(0, 0); // Scroll to top
  uploadPropertyForm.classList.add("fixed");
  uploadPropertyForm.classList.remove("hidden");
  document.body.style.overflow = "hidden"; // Disable scroll
});

// Close property add form
document.getElementById("close").addEventListener("click", (e) => {
  uploadPropertyForm.classList.add("hidden");
  uploadPropertyForm.classList.remove("fixed");
  document.body.style.overflow = "auto"; // Re-enable scroll
});
