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
}

rents.addEventListener("click", async () => {
    try {
        const response = await fetch('./profileApi/fetchRent.api.php');
        
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
