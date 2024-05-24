<!doctype html>
<html lang="de" prefix="og: https://ogp.me/ns#">

<head>
  <?php include 'includes/meta.html'; ?>
  <meta name="description" content="Umzugsrechner Wien: Füllen Sie dieses Formular aus und wir erstellen Ihnen direkt ein unverbindliches Angebot für Ihren geplanten Umzug." />
  <meta name="robots" content="max-image-preview:large" />
  <meta name="geo.placename" content="Wien" />
  <meta name="geo.position" content="48.137162;16.248877" />
  <meta name="geo.region" content="AT" />
  <title>Umzug Umzugsfirma Umzugsservice Übersiedlung Wien</title>
  <link rel="canonical" href="https://www.dieumzugsexperten.at/umzugsrechner-wien.php" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name": "Umzugsrechner",
      "description": "Füllen Sie das Formular aus, um ein individuelles Angebot für Ihren Umzug zu erhalten.",
      "publisher": {
        "@type": "Organization",
        "name": "Ihr Unternehmen"
      }
    }
  </script>
</head>

<body>
  <?php include 'includes/nav.php'; ?>

  <section id="introduction" class="py-5 bg-light">
    <div class="container">
      <div class="row d-flex align-items-center">
        <div class="col-lg-6 intro-content">
          <header>
            <h1 class="animated-text">Willkommen beim <span class="highlight">Umzugsrechner!</span></h1>
          </header>
          <article>
            <p class="lead">Füllen Sie das Formular aus, um ein individuelles Angebot für Ihren Umzug zu erhalten. Unser Formular führt Sie Schritt für Schritt durch den Prozess.</p>
          </article>
        </div>

        <div class="col-lg-6 progress-container my-4 text-center">
          <svg width="150" height="150" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon-rotate">
            <path d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8.009 8.009 0 0 1-8 8zm1-13h-2v6h6v-2h-4zm-1 10.5a1.5 1.5 0 1 1 1.5-1.5 1.501 1.501 0 0 1-1.5 1.5z" fill="#d11217" />
          </svg>
        </div>
        <div class="progress-container container my-4">
          <div class="progress" style="height: 50px;">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 16.66%; background: var(--red);" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100">Schritt 1 von 6</div>
          </div>
        </div>
      </div>
    </div>
  </section>




  <main class="container mt-5">
    <!-- Step 0: BESICHTIGUNG -->
    <div id="step-0" class="form-step active">
      <div class="form-group mb-3">
        <label for="besichtigung-dropdown">Persönliche Besichtigung gewünscht?</label>
        <select class="form-select" id="besichtigung-dropdown">
          <option value="">Bitte wählen</option>
          <option value="ja">Ja</option>
          <option value="nein">Nein</option>
        </select>
      </div>

      <!-- Formular für Besichtigungstermin und Adresse -->
      <div id="besichtigung-form" class="mb-3" style="display: none;">
        <div class="form-group mb-3">
          <label for="besichtigung-termin">Besichtigungstermin (Datum)</label>
          <input type="date" class="form-control" id="besichtigung-termin">
        </div>
        <div class="form-group mb-3">
          <label for="besichtigung-adresse">Adresse, Hausnummer, Stiege, Stock, TürNr</label>
          <input type="text" class="form-control" id="besichtigung-adresse">
        </div>
        <div class="form-group mb-3">
          <label for="besichtigung-plz-ort-land">PLZ Ort Land</label>
          <input type="text" class="form-control" id="besichtigung-plz-ort-land">
        </div>
        <div class="form-group mb-3">
          <label for="besichtigung-telefonnummer">Telefonnummer</label>
          <input type="text" class="form-control" id="besichtigung-telefonnummer">
        </div>
        <button type="button" class="btn btn-primary" id="besichtigung-absenden">Absenden</button>
      </div>
    </div>

    <form id="umzugsrechner-form" action="umzugsrechner-wien.php" method="post" novalidate>
      <!-- Step 1: Persönliche Informationen -->
      <div id="step-1" class="form-step">
        <h2>Persönliche Informationen</h2>
        <div class="row g-3">
          <div class="col-md-2">
            <label for="anrede" class="form-label">Anrede <span class="musthave">*</span></label>
            <select class="form-select" id="anrede" required>
              <option selected disabled value="">Bitte wählen...</option>
              <option>Frau</option>
              <option>Herr</option>
              <option>Unternehmen</option>
              <option>Verein</option>
              <option>Behörde</option>
              <option>Divers</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="vorname" class="form-label">Vorname <span class="musthave">*</span></label>
            <input type="text" class="form-control" id="vorname" required>
          </div>
          <div class="col-md-6">
            <label for="nachname" class="form-label">Nachname <span class="musthave">*</span></label>
            <input type="text" class="form-control" id="nachname" required>
          </div>
          <div class="col-md-5">
            <label for="rechnungs-adresse" class="form-label">Anschrift der Adresse für die Rechnungslegung <span class="musthave">*</span></label>
            <input type="text" class="form-control" id="rechnungs-adresse" required>
          </div>
          <div class="col-md-2">
            <label for="rechnungs-plz" class="form-label">PLZ <span class="musthave">*</span></label>
            <input type="number" class="form-control" id="rechnungs-plz" title="Bitte geben Sie eine gültige Postleitzahl ein." required>
          </div>
          <div class="col-md-3">
            <label for="rechnungs-ort" class="form-label">Ort <span class="musthave">*</span></label>
            <input type="text" class="form-control" id="rechnungs-ort" required>
          </div>
          <div class="col-2">
            <label for="rechnungs-land" class="form-label">Land <span class="musthave">*</span></label>
            <input type="text" class="form-control" id="rechnungs-land" required>
          </div>
          <div class="col-md-6">
            <label for="telefonnummer" class="form-label">Telefonnummer</label>
            <input type="tel" class="form-control" id="telefonnummer">
            <small id="phoneHelp" class="form-text text-muted">Wir benötigen Ihre Telefonnummer im Zusammenhang mit Ihrem Umzug.</small>
          </div>
          <div class="col-md-6">
            <label for="email" class="form-label">E-Mail-Adresse <span class="musthave">*</span></label>
            <input type="email" class="form-control" id="email" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Bitte geben Sie eine gültige E-Mail-Adresse ein." required>
          </div>
          <div class="col-12">
            <label for="anmerkungen" class="form-label">Sonstige Anmerkungen</label>
            <textarea class="form-control" id="anmerkungen" rows="5"></textarea>
          </div>
        </div>
        <button type="button" class="btn btn-primary next-step mt-3" data-next="2">Weiter</button>
      </div>

      <!-- Step 2: Umzugsdaten für die Startadresse -->
      <div id="step-2" class="form-step">
        <h2>Umzugsdaten für die Startadresse</h2>
        <div class="row g-3 align-items-center">
          <div class="col-md-2">
            <label for="wunschdatum" class="form-label">Wunschdatum Umzug<span class="musthave">*</span></label>
            <input type="date" class="form-control" id="wunschdatum" name="wunschdatum" required>
          </div>
          <div class="col-md-6">
            <label for="startadresse" class="form-label">Straße/Gasse<span class="musthave">*</span></label>
            <input type="text" class="form-control" id="startadresse" placeholder="Straße/Gasse" required>
          </div>
          <div class="col-md-1">
            <label for="starthausnummer" class="form-label">Haus Nr<span class="musthave">*</span></label>
            <input type="number" class="form-control" id="starthausnummer" placeholder="HNr" required>
          </div>
          <div class="col-md-1">
            <label for="startstiege" class="form-label">Stiege</label>
            <input type="number" class="form-control" id="startstiege" placeholder="Stiege">
          </div>
          <div class="col-md-1">
            <label for="startstock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="startstock" placeholder="Stock">
          </div>
          <div class="col-md-1">
            <label for="starttuernr" class="form-label">Tür Nr</label>
            <input type="number" class="form-control" id="starttuernr" placeholder="TNr">
          </div>
          <div class="col-2">
            <label for="startplz" class="form-label">PLZ <span class="musthave">*</span></label>
            <input type="number" class="form-control" id="startplz" required>
          </div>
          <div class="col-3">
            <label for="startort" class="form-label">Ort <span class="musthave">*</span></label>
            <input type="text" class="form-control" id="startort" required>
          </div>
          <div class="col-4">
            <label for="startland" class="form-label">Land <span class="musthave">*</span></label>
            <input type="text" class="form-control" id="startland" required>
          </div>
          <div class="col-md-3">
            <label for="start-lift" class="form-label">Aufzug <span class="musthave">*</span></label>
            <select class="form-select" id="start-lift" required>
              <option value="ja">Ja</option>
              <option value="nein">Nein</option>
            </select>
          </div>
          <div class="col-md-2">
            <label for="wohnungsgroesse" class="form-label">Wohnungsgröße in m²<span class="musthave">*</span></label>
            <input type="number" class="form-control" id="wohnungsgroesse" placeholder="Quadratmeter" required>
          </div>
          <div class="col-2">
            <label for="startmeter" class="form-label">Meter Parkmöglichkeit?</label>
            <input type="number" class="form-control" id="startmeter" placeholder="Schätzung in Meter">
          </div>
          <div class="col-md-2">
            <label for="start-halteverbot" class="form-label">Halteverbot einrichten?</label>
            <select class="form-select" id="start-halteverbot" name="start-halteverbot" onchange="toggleHalteverbotInfo('start')">
              <option value="nein">Nein</option>
              <option value="ja">Ja</option>
            </select>
          </div>
          <div id="start-halteverbot-info" class="col-md-12" style="display: none;">
            <p>Wir können für Sie eine oder mehrere Halteverbotszone(n) bei der zuständigen Behörde beantragen. Bitte teilen Sie uns dies 10 Tage vor dem Umzug mit.</p>
          </div>
          <div class="col-12">
            <h3>Zusatzservices</h3>
          </div>
          <div class="col-md-6">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="kartons-liefern" name="kartons-liefern">
              <label class="form-check-label" for="kartons-liefern">Kartons liefern lassen</label>
            </div>
            <div id="delivery-date" class="col-md-6" style="display: none;">
              <label for="lieferdatum" class="form-label">Gewünschtes Lieferdatum</label>
              <input type="date" class="form-control" id="lieferdatum">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="kartons-einpacken" name="kartons-einpacken">
              <label class="form-check-label" for="kartons-einpacken">Kartons einpacken</label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="moebelabbau" name="moebelabbau">
              <label class="form-check-label" for="moebelabbau">Möbelabbau</label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="kueche-demontieren" name="kueche-demontieren">
              <label class="form-check-label" for="kueche-demontieren">Küche demontieren</label>
            </div>
          </div>

          <div class="col-12">
            <button type="button" class="btn btn-secondary previous-step mt-3" data-previous="1">Zurück</button>
            <button type="button" class="btn btn-secondary next-step mt-3" data-next="3">Weiter</button>
          </div>
        </div>
      </div>

      <!-- Step 3: Umzugsdaten für die Zieladresse -->
      <div id="step-3" class="form-step">
        <h2>Umzugsdaten für die Zieladresse</h2>
        <div class="row g-3 align-items-center">
          <div class="col-md-8">
            <label for="zieladresse" class="form-label">Straße/Gasse<span class="musthave">*</span></label>
            <input type="text" class="form-control" id="zieladresse" placeholder="Straße/Gasse" required>
          </div>
          <div class="col-md-1">
            <label for="zielhausnummer" class="form-label">Haus Nr<span class="musthave">*</span></label>
            <input type="number" class="form-control" id="zielhausnummer" placeholder="HNr" required>
          </div>
          <div class="col-md-1">
            <label for="zielstiege" class="form-label">Stiege</label>
            <input type="number" class="form-control" id="zielstiege" placeholder="Stiege">
          </div>
          <div class="col-md-1">
            <label for="zielstock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="zielstock" placeholder="Stock">
          </div>
          <div class="col-md-1">
            <label for="zieltuernr" class="form-label">Tür Nr</label>
            <input type="number" class="form-control" id="zieltuernr" placeholder="TNr">
          </div>
          <div class="col-2">
            <label for="zielplz" class="form-label">PLZ<span class="musthave">*</span></label>
            <input type="number" class="form-control" id="zielplz" required>
          </div>
          <div class="col-3">
            <label for="zielort" class="form-label">Ort<span class="musthave">*</span></label>
            <input type="text" class="form-control" id="zielort" required>
          </div>
          <div class="col-4">
            <label for="zielland" class="form-label">Land<span class="musthave">*</span></label>
            <input type="text" class="form-control" id="zielland" required>
          </div>
          <div class="col-md-3">
            <label for="ziel-lift" class="form-label">Aufzug<span class="musthave">*</span></label>
            <select class="form-select" id="ziel-lift" required>
              <option value="ja">Ja</option>
              <option value="nein">Nein</option>
            </select>
          </div>
          <div class="col-2">
            <label for="zielmeter" class="form-label">Meter Parkmöglichkeit?</label>
            <input type="number" class="form-control" id="zielmeter" placeholder="Schätzung in Meter">
          </div>
          <div class="col-md-3">
            <label for="ziel-halteverbot" class="form-label">Halteverbot einrichten?</label>
            <select class="form-select" id="ziel-halteverbot" name="ziel-halteverbot" onchange="toggleHalteverbotInfo('ziel')">
              <option value="nein">Nein</option>
              <option value="ja">Ja</option>
            </select>
          </div>
          <div id="ziel-halteverbot-info" class="col-md-12" style="display: none;">
            <p>Wir können für Sie eine oder mehrere Halteverbotszone(n) bei der zuständigen Behörde beantragen. Bitte teilen Sie uns dies 10 Tage vor dem Umzug mit.</p>
          </div>

          <div class="col-12">
            <h3>Zusatzservices</h3>
          </div>
          <div class="col-md-12">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="kartons-auspacken" name="kartons-auspacken">
              <label class="form-check-label" for="kartons-auspacken">Kartons auspacken</label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="moebelaufbau" name="moebelaufbau">
              <label class="form-check-label" for="moebelaufbau">Möbelaufbau</label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="kueche-montieren" name="kueche-montieren">
              <label class="form-check-label" for="kueche-montieren">Küche montieren</label>
            </div>
          </div>
          <div class="col-12">
            <button type="button" class="btn btn-secondary previous-step mt-3" data-previous="2">Zurück</button>
            <button type="button" class="btn btn-secondary next-step mt-3" data-next="4">Weiter</button>
          </div>
        </div>
      </div>

      <!-- Step 4: Möbelinventarliste -->
      <div id="step-4" class="form-step">
        <h2>Möbelinventarliste</h2>
        <div class="mt-3">
          <h4>Gesamtsumme der m³ (durchschnitt): <span id="total-volume">0</span></h4>
        </div>
        <div class="row">
          <!-- Left Column: Room Buttons -->
          <div class="col-md-6" id="room-buttons">
            <!-- Dynamically loaded room buttons -->
          </div>

          <!-- Right Column: Furniture Selection -->
          <div class="col-md-6" id="furniture-selection">
            <!-- Dynamically loaded furniture items -->
          </div>
        </div>
        <div class="mt-3">
          <h4>Ausgewählte Möbelstücke</h4>
          <ul id="inventory-list" class="list-group">
            <!-- Dynamically updated inventory list -->
          </ul>
        </div>
        <button type="button" class="btn btn-secondary previous-step mt-3" data-previous="3">Zurück</button>
        <button type="button" class="btn btn-secondary next-step mt-3" data-next="5">Weiter</button>
      </div>






      <!-- Step 5: Wünsche, Anmerkungen und Fotoupload -->
      <div id="step-5" class="form-step">
        <h2>Wünsche, Anmerkungen und Fotoupload</h2>
        <div class="row g-3">
          <div class="col-md-12">
            <label for="comments" class="form-label">Wünsche und Anmerkungen</label>
            <textarea class="form-control" id="comments" rows="3"></textarea>
          </div>
          <div class="col-md-12">
            <label for="photo-upload" class="form-label">Fotos hochladen (max. 2MB, nur JPG)</label>
            <input class="form-control" type="file" id="photo-upload" accept=".jpg, .jpeg">
          </div>
        </div>
        <button type="button" class="btn btn-secondary previous-step mt-3" data-previous="4">Zurück</button>
        <button type="button" class="btn btn-secondary next-step mt-3" data-next="6">Weiter</button>
      </div>

      <!-- Step 6: Überprüfung und Bestätigung -->
      <div id="step-6" class="form-step">
        <h2>Überprüfung und Bestätigung</h2>
        <div class="row g-3">
          <div class="col-md-12">
            <h4>Überprüfen Sie Ihre Angaben:</h4>
            <div id="summary">
              <!-- Dynamisch generierte Zusammenfassung aller Eingaben -->
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="confirmation-check" required>
              <label class="form-check-label" for="confirmation-check">
                <span class="musthave">*</span>Hiermit bestätige ich, dass alle Daten korrekt angegeben wurden.
              </label>
            </div>
          </div>
        </div>
        <button type="button" class="btn btn-secondary mt-3 previous-step" data-previous="5">Zurück</button>
        <!-- Download PDF Button -->
        <button type="button" class="btn btn-secondary mt-3" onclick="downloadPDF()">PDF herunterladen</button>

        <button type="submit" class="btn btn-success mt-3" id="submit-button">Absenden</button>
      </div>
    </form>

    <!-- Popup für die Erfolgsnachricht -->
    <div id="successModal" class="modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Erfolgsnachricht</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Herzlichen Dank, dass Sie uns gewählt haben. Wir werden uns so schnell wie möglich mit Ihnen in Verbindung setzen.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="back-to-home">Zur Startseite</button>
          </div>
        </div>
      </div>
    </div>
  </main>





  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/footer-small.php'; ?>








  <!-- jQuery von Google CDN einbinden -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
  <?php include 'includes/scripts.html'; ?>
  <script src="/assets/js/ur.js"></script>
</body>

</html>