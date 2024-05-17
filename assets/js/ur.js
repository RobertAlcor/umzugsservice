$(document).ready(function () {
  console.log("Document ready - Initializing...");

  // Besichtigung Formular ein-/ausblenden
  $("#besichtigung-dropdown").change(function () {
    var value = $(this).val();
    console.log("Besichtigung dropdown changed to:", value);
    if (value === "ja") {
      $("#besichtigung-form").show();
      hideSteps(); // Versteckt Step 1 bis 6
    } else if (value === "nein") {
      $("#besichtigung-form").hide();
      showSteps(); // Zeigt Step 1 bis 6
    } else {
      $("#besichtigung-form").hide();
      hideSteps(); // Versteckt Step 1 bis 6
    }
  });

  // Navigation zwischen den Schritten ohne Validierung
  $(".next-step").click(function () {
    var nextStep = $(this).data("next");
    console.log("Next step button clicked, navigating to step:", nextStep);
    navigateToStep(nextStep);
  });

  $(".previous-step").click(function () {
    var previousStep = $(this).data("previous");
    console.log("Previous step button clicked, navigating to step:", previousStep);
    navigateToStep(previousStep);
  });

  // Initialisiert die Logik für Checkbox und Dropdown-Menüs zur Anzeige zusätzlicher Informationen
  initConditionalDisplay();

  // Lädt die Raumdaten aus einer JSON-Datei
  loadRooms();
});

// Funktion zum Ein-/Ausblenden von Steps
function showSteps() {
  console.log("Showing steps...");
  $("#umzugsrechner-form .form-step").removeClass("active");
  $("#step-1").addClass("active");
}

function hideSteps() {
  console.log("Hiding steps...");
  $("#umzugsrechner-form .form-step").removeClass("active");
}

// Funktion zum Ein-/Ausblenden von Formularen
function toggleFormVisibility(showFirst, firstFormSelector, secondFormSelector) {
  console.log(`Toggling form visibility: showFirst=${showFirst}, firstFormSelector=${firstFormSelector}, secondFormSelector=${secondFormSelector}`);
  $(firstFormSelector).toggle(showFirst);
  $(secondFormSelector).toggle(!showFirst);
}

// Initialisiert die Logik für Checkbox und Dropdown-Menüs zur Anzeige zusätzlicher Informationen
function initConditionalDisplay() {
  console.log("Initializing conditional display...");
  $("#kartons-liefern").change(function () {
    toggleVisibility("delivery-date", $(this).is(":checked"));
  });

  ["start", "ziel"].forEach(function (location) {
    var selectId = location + "-halteverbot";
    $("#" + selectId).change(function () {
      toggleVisibility(location + "-halteverbot-info", $(this).val() === "ja");
    });
  });
}

// Allgemeine Funktion zum Ein- und Ausblenden von Elementen
function toggleVisibility(elementId, condition) {
  console.log(`Toggling visibility of ${elementId}: ${condition}`);
  $("#" + elementId).toggle(condition);
}

// Navigation zwischen den Schritten
let currentStep = 0; // Initialize to the first step
function navigateToStep(step) {
  currentStep = step; // Update the current step globally
  console.log("Navigating to step:", step);
  showStep(step);
  updateProgressBar(step);
}

// Funktion zum Anzeigen von Steps
function showStep(step) {
  console.log("Showing step:", step);
  $(".form-step").removeClass("active");
  $("#step-" + step).addClass("active");
}

// Fortschrittsanzeige aktualisieren
function updateProgressBar(currentStep) {
  var totalSteps = $(".form-step").length;
  var progress = ((currentStep + 1) / totalSteps) * 100;
  console.log(`Updating progress bar: step=${currentStep}, progress=${progress}%`);
  $(".progress-bar")
    .css("width", progress + "%")
    .attr("aria-valuenow", progress)
    .text("Schritt " + (currentStep + 1) + " von " + totalSteps);
}

// Lädt die Raumdaten aus einer JSON-Datei
function loadRooms() {
  console.log("Loading rooms...");
  $.getJSON("/json/moebelinventar.json", function (data) { // Passe den Pfad hier an
    var roomHtml = "";
    $.each(data, function (room) {
      roomHtml +=
        '<button class="btn btn-info me-2" onclick="loadFurnitureItems(\'' +
        room +
        "')\">" +
        room +
        "</button>";
    });
    $("#room-buttons").html(roomHtml);
    console.log("Loaded rooms:", data);
  }).fail(function (jqxhr, textStatus, error) {
    var err = textStatus + ", " + error;
    console.error("Failed to load room data: " + err);
    alert("Fehler beim Laden der Raumdaten. Bitte versuchen Sie es später erneut. Details: " + err);
  });
}

// Lädt die Möbelstücke für einen spezifischen Raum
window.loadFurnitureItems = function (room) {
  console.log("Loading furniture items for room:", room);
  $.getJSON("/json/moebelinventar.json", function (data) { // Passe den Pfad hier an
    var furnitureHtml = "";
    var items = data[room];
    $.each(items, function (furniture, volume) {
      furnitureHtml += createFurnitureHtml(furniture, volume, room);
    });
    $("#furniture-selection").html(furnitureHtml);
    console.log("Loaded furniture items for room:", room, items);
  }).fail(function (jqxhr, textStatus, error) {
    var err = textStatus + ", " + error;
    console.error("Failed to load furniture items: " + err);
    alert("Fehler beim Laden der Möbelstücke. Bitte versuchen Sie es später erneut. Details: " + err);
  });
};

// Erzeugt das HTML für ein einzelnes Möbelstück
function createFurnitureHtml(furniture, volume, room) {
  console.log("Creating furniture HTML for:", furniture);
  var formattedFurniture = furniture.replace("_", " ");
  return (
    '<div class="furniture-item">' +
    '<div class="input-group">' +
    '<button class="btn btn-secondary" type="button" onclick="changeFurnitureCount(\'' +
    furniture +
    "', " +
    volume +
    ", -1, '" +
    room +
    "')\">-</button>" +
    '<input type="text" class="form-control text-center furniture-count" id="' +
    furniture +
    '-count" value="0" readonly>' +
    '<button class="btn btn-primary" type="button" onclick="changeFurnitureCount(\'' +
    furniture +
    "', " +
    volume +
    ", 1, '" +
    room +
    "')\">+</button>'" +
    '<label class="form-label ms-3">' + 
    formattedFurniture +
    " </label>" +
    "</div></div>"
  );
}

// Ändert die Anzahl der Möbelstücke und aktualisiert die Inventarliste
window.changeFurnitureCount = function (furnitureId, volume, delta, room) {
  console.log("Changing furniture count for:", furnitureId, "Delta:", delta);
  var countInput = $("#" + furnitureId + "-count");
  var currentCount = parseInt(countInput.val()) + delta;
  currentCount = Math.max(0, Math.min(currentCount, 99)); // Limitiert den Wert zwischen 0 und 99
  countInput.val(currentCount);
  updateInventoryList(furnitureId, volume, room);
  console.log("New count for", furnitureId, "is", currentCount);
};

// Aktualisiert die Inventarliste auf der Benutzeroberfläche
function updateInventoryList(furnitureId, volume, room) {
  console.log("Updating inventory list for:", furnitureId);
  var count = parseInt($("#" + furnitureId + "-count").val());
  var listItem = $("#" + furnitureId + "-list-item");
  if (count > 0) {
    var content =
      room +
      " - " +
      furnitureId.replace("_", " ") +
      ": " +
      count +
      " (" +
      (volume * count).toFixed(2) +
      " m³)";
    if (listItem.length === 0) {
      $("#inventory-list").append(
        '<li id="' + furnitureId + '-list-item" class="list-group-item">' +
          content +
          "</li>"
      );
    } else {
      listItem.html(content);
    }
  } else {
    listItem.remove();
  }
  calculateTotalVolume();
  console.log("Updated inventory list for:", furnitureId);
}

// Berechnet das gesamte Volumen aller ausgewählten Möbelstücke
function calculateTotalVolume() {
  console.log("Calculating total volume...");
  var totalVolume = 0;
  $("#inventory-list li").each(function () {
    var volume = parseFloat(
      $(this)
        .text()
        .match(/\((\d+\.\d+)/)[1]
    );
    totalVolume += volume;
  });
  $("#total-volume").text(totalVolume.toFixed(2) + " m³");
  console.log("Total volume is:", totalVolume);
}

// Generiert die Zusammenfassung aller Eingaben für die Überprüfung durch den Benutzer
function generateSummary() {
  console.log("Generating summary...");
  var summaryHtml = '<table class="table table-striped">';
  summaryHtml +=
    "<thead><tr><th>BEZEICHNUNG</th><th>Ihre Angaben</th></tr></thead><tbody>";

  // Durchläuft alle Eingabeelemente im Formular
  $("#umzugsrechner-form")
    .find("input, select, textarea")
    .each(function () {
      var element = $(this);
      var id = element.attr("id");
      var label =
        $('label[for="' + id + '"]')
          .first()
          .text()
          .trim() ||
        element.attr("name") ||
        id; // Holt das erste Label und entfernt Leerzeichen
      var value = element.val();
      var type = element.attr("type");

      if (
        (type === "checkbox" || type === "radio") &&
        !element.is(":checked")
      ) {
        return; // Überspringt nicht markierte Checkboxen und Radiobuttons
      } else if (element.is("select") && element.val() === "") {
        return; // Überspringt nicht ausgewählte Dropdown-Menüs
      } else if (type !== "checkbox" && type !== "radio" && !value) {
        return; // Überspringt leere Textfelder und Textareas
      } else if (type !== "option" && element.is(":hidden")) {
        return; // Überspringt nicht ausgewählte Dropdown-Menüs
      }

      // Bereitet den Anzeigewert vor
      if (type === "checkbox" || type === "radio") {
        value = "Ja"; // Setzt den Wert für markierte Checkboxen und Radiobuttons
      }

      // Fügt die Zeile zur Zusammenfassung hinzu
      summaryHtml += "<tr><td>" + label + "</td><td>" + value + "</td></tr>";
    });

  summaryHtml += "</tbody></table>";
  $("#summary").html(summaryHtml);
}

// PDF erstellen und speichern
function downloadPDF() {
  console.log("Downloading PDF...");
  // Verwendet jQuery, um auf das Element zuzugreifen
  var element = $("#summary")[0]; // Zugriff auf das native DOM-Element

  html2canvas(element)
    .then(function (canvas) {
      // Erzeugt ein Bild aus dem Canvas
      var imgData = canvas.toDataURL("image/png");

      // Erstellt ein jsPDF-Dokument
      const { jsPDF } = window.jspdf;
      const pdf = new jsPDF({
        orientation: "portrait",
        unit: "pt",
        format: "a4",
      });

      const imgProps = pdf.getImageProperties(imgData);
      const pdfWidth = pdf.internal.pageSize.getWidth();
      const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

      // Fügt das Bild zum PDF hinzu
      pdf.addImage(imgData, "PNG", 0, 0, pdfWidth, pdfHeight);
      pdf.save("formular-zusammenfassung.pdf"); // Speichert die PDF-Datei
    })
    .catch(function (error) {
      console.error("Fehler beim Erstellen der PDF: ", error);
      alert("Fehler beim Erstellen der PDF. Bitte versuchen Sie es später erneut.");
    });
}

// Fortschrittsanzeige aktualisieren
$(document).ready(function () {
  console.log("Initializing progress bar...");
  const progressBar = $(".progress-bar");
  let progress = 16.66; // Start bei Schritt 1 von 6

  // Funktion zum Aktualisieren des Fortschritts
  function updateProgress(step) {
    const totalSteps = 6;
    progress = (step / totalSteps) * 100;
    progressBar.css("width", `${progress}%`);
    progressBar.attr("aria-valuenow", progress);
    progressBar.text(`Schritt ${step} von ${totalSteps}`);
    console.log("Updated progress to step:", step);
  }

  // Beispiel für die Aktualisierung des Fortschritts (dies sollte an die Formularschritte gebunden sein)
  updateProgress(1); // Dies sollte dynamisch basierend auf den Formularschritten aktualisiert werden
});

window.loadFurnitureItems = function (room) {
  console.log("Loading furniture items for room:", room);
  $.getJSON("/json/moebelinventar.json", function (data) { // Passe den Pfad hier an
    var furnitureHtml = "";
    var items = data[room];
    $.each(items, function (furniture, volume) {
      furnitureHtml += createFurnitureHtml(furniture, volume, room);
    });
    $("#furniture-selection").html(furnitureHtml);
    console.log("Loaded furniture items for room:", room, items);
    navigateToStep(4); // Ensure we stay on step 4 after loading furniture items
  }).fail(function (jqxhr, textStatus, error) {
    var err = textStatus + ", " + error;
    console.error("Failed to load furniture items: " + err);
    alert("Fehler beim Laden der Möbelstücke. Bitte versuchen Sie es später erneut. Details: " + err);
  });
};
