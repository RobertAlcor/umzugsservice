<?php
$folderPath = __DIR__ . '/../assets/img/gallery-index/';

// Überprüfen, ob der Ordner existiert und lesbar ist
if (is_dir($folderPath) && is_readable($folderPath)) {
 // Dateien im Verzeichnis auflisten und die . und .. Einträge entfernen
 $images = array_diff(scandir($folderPath), array('.', '..'));

 echo '<div class="image-gallery">';
 foreach ($images as $image) {
  $imagePath = $folderPath . $image;
  // Überprüfen, ob es sich um eine Datei handelt und ob das Format .webp ist
  if (is_file($imagePath) && pathinfo($imagePath, PATHINFO_EXTENSION) === 'webp') {
   // Berechnen des relativen Pfades für die Webanzeige
   $webPath = '../assets/img/gallery-index/' . $image;
   echo '<div class="image-box">';
   echo '<img src="' . htmlspecialchars($webPath) . '" alt="' . htmlspecialchars(pathinfo($imagePath, PATHINFO_FILENAME)) . '">';
   echo '</div>';
  }
 }
 echo '</div>';
} else {
 echo "Der Ordner $folderPath existiert nicht oder ist nicht lesbar.";
}
