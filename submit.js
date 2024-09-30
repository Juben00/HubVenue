 document.addEventListener('DOMContentLoaded', function () {
            const carousel = document.getElementById('carousel');
            const dots = Array.from(document.querySelectorAll('.dot'));
            let currentIndex = 0;

            // Function to update the slide position
            function updateCarousel() {
                const slideWidth = carousel.children[0].clientWidth;
                carousel.style.transform = `translateX(-${currentIndex * slideWidth}px)`;

                // Update active dot
                dots.forEach((dot, index) => {
                    dot.classList.toggle('bg-red-500', index === currentIndex);
                });
            }

            // Function to move to the next slide
            function nextSlide() {
                if (currentIndex < carousel.children.length - 1) {
                    currentIndex++;
                } else {
                    currentIndex = 0; // Loop back to first slide
                }
                updateCarousel();
            }

            setInterval(nextSlide, 4000);

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentIndex = index;
                    updateCarousel();
                });
            });

            // Initialize the carousel position
            updateCarousel();
        });

//dots in the carousel
document.addEventListener('DOMContentLoaded', function () {
    const faqHeaders = document.querySelectorAll('.faq-header');

    faqHeaders.forEach(header => {
        header.addEventListener('click', function () {
            const faqContent = this.nextElementSibling;

            if (faqContent.classList.contains('hidden')) {
                faqContent.classList.remove('hidden');
            } else {
                faqContent.classList.add('hidden');
            }
        });
    });
});

// document.getElementById('searchForm').addEventListener('submit', (e) => {
//     e.preventDefault();

//     fetch('./api/searchsubmit.api.php', {
//         method: "POST",
//         headers: {
//             'Content-Type': 'application/x-www-form-urlencoded',
//         },
//         body: new URLSearchParams(new FormData(document.getElementById('searchForm')))
//     })
//     .then(response => response.text()) // Use text() to get HTML
//     .then(html => {
//         console.log('Success:', html);
//         // Update the dashboard with the HTML
//         updateDashboard(html);
//     })
//     .catch((error) => {
//         console.error('Error:', error);
//     });
// });

// // Function to update the dashboard with the fetched HTML
// function updateDashboard(html) {
//     const resultsContainer = document.getElementById('result'); // Update this ID to your results container
//     resultsContainer.innerHTML = html;
// }

//dynamic saving
document.addEventListener('DOMContentLoaded', function () {
    const bookmarkForms = document.querySelectorAll('form[id^="bookmark-"]');

    bookmarkForms.forEach(form => {
        form.addEventListener('submit', async (e) => {
            e.preventDefault(); // This ensures the default form submission is prevented

            try {
                const formData = new FormData(form);
                
                const response = await fetch(`./api/bookmark.api.php`, {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams(formData),
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const result = await response.text();
                console.log('Success:', result);

                // // Show success message to the user
                // alert('Bookmark function successfully! Redirecting...');

                //refresh the page
                window.location.reload();
            } catch (error) {
                console.error('Error:', error);
                alert('Failed to add bookmark. Please try again.');
            }
        });
    });
});


