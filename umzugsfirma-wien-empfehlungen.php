<!DOCTYPE html>
<html lang="de" prefix="og: https://ogp.me/ns#">

<head>
 <?php include 'includes/meta.html'; ?>
 <meta name='robots' content='max-image-preview:large' />
 <meta name="geo.placename" content="Wien" />
 <meta name="geo.position" content=";" />
 <meta name="geo.region" content="AT" />
 <title>Bewertungssystem - Die Umzugsexperten</title>
 <link rel="canonical" href="https://www.dieumzugsexperten.at/umzugsfirma-wien-empfehlungen.php">
 <script type="application/ld+json">
  {
   "@context": "https://schema.org",
   "@type": "Organization",
   "name": "Die Umzugsexperten / moving experts Int. Transporte und Umzugsservice",
   "alternateName": "Die Umzugsexperten",
   "url": "https://www.dieumzugsexperten.at/umzugsfirma-wien-empfehlungen.php/",
   "logo": "https://www.dieumzugsexperten.at/wp-content/uploads/2018/05/logo-neu-1-1-1.png"
  }
 </script>
</head>

<body>
 <!-- <?php include 'includes/child-header.php'; ?> -->
 <?php include 'includes/nav.php'; ?>

 <main>

  <div class="container-fluid p-5 text-center">
   <h1 class="text-center mb-4">Kundenbewertungen</h1>
   <div id="review-container" class="masonry">
    <!-- Bewertungen werden hier dynamisch eingefügt -->
   </div>
   <div class="text-center mt-4">
    <button id="load-more-btn" class="btn btn-primary">Weitere Bewertungen laden</button>
    <p id="load-more-message"></p> <!-- Nachricht für den Benutzer -->
   </div>

  </div>


  <!-- "Scroll to Top"-Schaltfläche -->
  <button id="scroll-to-top" class="btn btn-secondary" onclick="scrollToTop()" title="Zurück nach oben">⬆</button>
  </div>



 </main>




 <?php include 'includes/footer.php'; ?>
 <?php include 'includes/footer-small.php'; ?>
 <!-- Main JS -->
 <?php include 'includes/scripts.html'; ?>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js"></script>
</body>

</html>