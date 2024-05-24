


// Initialisierung von Variablen
var loadedReviewsCount = 0; // Anzahl der bisher geladenen Bewertungen
var reviewsPerLoad = 10; // Anzahl der Bewertungen, die pro Klick geladen werden sollen

// Funktion, um das aktuelle Jahr zu bekommen und im DOM anzuzeigen
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("currentYear").innerText = new Date().getFullYear();
    loadReviews(); // Laden der initialen Bewertungen
});

// Funktion zur Erstellung von HTML für eine Bewertung
function createReviewHTML(review) {
    var stars = "★".repeat(review.rating); // Sterne darstellen
    return `
        <div class="review" data-review-id="${review.id}">
            <div class="review-body">
                <h5 class="review-title">${review.name}</h5>
                <p class="review-stars">${stars}</p>
                <p class="review-text">${review.text}</p>
            </div>
        </div>
    `;
}

// Funktion zum Laden von Bewertungen
function loadReviews() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                var reviewContainer = document.getElementById("review-container");
                var endIndex = loadedReviewsCount + reviewsPerLoad;
                var reviewsToAdd = data.slice(loadedReviewsCount, endIndex);
                
                reviewsToAdd.forEach(function (review) {
                    var cardHtml = createReviewHTML(review);
                    reviewContainer.insertAdjacentHTML("beforeend", cardHtml);
                });

                loadedReviewsCount += reviewsToAdd.length;
                initializeMasonry();

                if (loadedReviewsCount >= data.length) {
                    document.getElementById("load-more-btn").style.display = "none";
                    document.getElementById("load-more-message").textContent = "Keine weiteren Bewertungen vorhanden";
                }
            } else {
                console.error("Fehler beim Laden der Bewertungen:", xhr.status);
            }
        }
    };
    xhr.open("GET", "/json/reviews.json", true);
    xhr.send();
}

// Funktion zur Initialisierung des Masonry-Layouts
function initializeMasonry() {
    var grid = document.querySelector("#review-container");
    if (grid && typeof Masonry !== 'undefined') {
        new Masonry(grid, {
            itemSelector: ".review",
            columnWidth: ".review",
            gutter: 10,
            fitWidth: true
        });
    }
}
