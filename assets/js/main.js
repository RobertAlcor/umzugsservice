// BILDGALLERY LIGHTBOX

// BILDGALLERY LIGHTBOX ENDE

// FOOTER YEAR

// Funktion, um das aktuelle Jahr zu bekommen
function getCurrentYear() {
    return new Date().getFullYear();
}

// Das aktuelle Jahr in das HTML einfügen, wenn das DOM geladen ist
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("currentYear").innerText = getCurrentYear();
});

// FOOTER YEAR ENDE

// BEWERTUNGEN

// BEWERUNGEN LADEN
var loadedReviewsCount = 0; // Anzahl der bisher geladenen Bewertungen
var reviewsPerLoad = 10; // Anzahl der Bewertungen, die pro Klick geladen werden sollen

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
function loadReviews() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                var reviewContainer =
                    document.getElementById("review-container");
                var endIndex = loadedReviewsCount + reviewsPerLoad;
                var reviewsToAdd = data.slice(loadedReviewsCount, endIndex);

                reviewsToAdd.forEach(function (review) {
                    var cardHtml = createReviewHTML(review);
                    reviewContainer.insertAdjacentHTML("beforeend", cardHtml);
                });

                loadedReviewsCount += reviewsToAdd.length; // Aktualisieren der gezählten Bewertungen

                initializeMasonry(); // Initialisieren oder aktualisieren des Masonry-Layouts

                if (loadedReviewsCount >= data.length) {
                    document.getElementById("load-more-message").textContent =
                        "Keine weiteren Bewertungen vorhanden";
                    document.getElementById("load-more-btn").style.display =
                        "none"; // Verstecke den Button
                }
            } else {
                console.error("Fehler beim Laden der Bewertungen:", xhr.status);
            }
        }
    };
    xhr.open("GET", "/json/reviews.json", true);
    xhr.send();
}

function initializeMasonry() {
    var grid = document.querySelector("#review-container");
    if (grid) {
        // Initialisierung von Masonry ohne imagesLoaded
        new Masonry(grid, {
            itemSelector: ".review",
            columnWidth: ".review", // Oder eine feste Größe, wenn Sie möchten
            gutter: 10,
            fitWidth: true, // Zentriert das Grid im Elternelement
        });
    }
}

document.addEventListener("DOMContentLoaded", function () {
    loadReviews(); // Laden Sie initiale Bewertungen, wenn das Dokument geladen wird
});

document.getElementById("load-more-btn").addEventListener("click", loadReviews);

// Funktion zum Zurück-Scrollen zum Seitenanfang
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: "smooth" }); // Weiches Scrollen nach oben
}

// HERO HINTERGRUND

// HERO HINTERGRUND ENDE


// TOOL TIP
document.getElementById('from_area').addEventListener('focus', function() {
  var tooltip = this.parentNode.querySelector('.tooltiptext');
  tooltip.style.visibility = 'visible';
  tooltip.style.opacity = '1';
});

document.getElementById('from_area').addEventListener('blur', function() {
  var tooltip = this.parentNode.querySelector('.tooltiptext');
  tooltip.style.visibility = 'hidden';
  tooltip.style.opacity = '0';
});
