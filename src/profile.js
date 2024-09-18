const usertype = document.getElementById('usertype').innerHTML;
const posted = document.getElementById('posted');
const rents = document.getElementById('rents');

document.addEventListener('DOMContentLoaded', function () {
  if (usertype === 'user') {
    posted.classList.add('hidden');
    rents.click();
  }
});

if (usertype === 'user') {
  posted.classList.add('hidden');
  rents.click();
  rents.classList.add('bg-neutral-600')
}

rents.addEventListener("click", async () => {
    try {
        const response = await fetch('./api/fetchRent.api.php');
        
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        const html = await response.text();

        if (html) {
            updateProfileDisp(html);
        }

    } catch (error) {
        console.error('Error:', error);
    }
});

function updateProfileDisp(html) {
    const profiledisp = document.getElementById('profiledisp'); 
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
      const endDate = el.getAttribute('data-end-date');
      const checkOut = el.getAttribute('data-check-out');

      if (isDateInThePast(endDate, checkOut)) {
          el.classList.remove('bg-green-500');
          el.classList.add('bg-red-500');
      } else {
          el.classList.remove('bg-red-500');
          el.classList.add('bg-green-500');
      }
  });
}

// Call the function immediately on page load
updateRentStatus();

// Optionally, set an interval to keep checking the status every minute (or any interval you prefer)
setInterval(updateRentStatus, 100);
