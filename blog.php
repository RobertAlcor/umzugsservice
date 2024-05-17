<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="de">

<head>
  <?php include 'includes/meta.html'; ?>
  <meta name="description" content="Umzugsrechner Wien: Füllen Sie dieses Formular aus und wir erstellen Ihnen direkt ein unverbindliches Angebot für Ihren geplanten Umzug.">
  <meta name='robots' content='max-image-preview:large'>
  <meta name="geo.placename" content="Wien">
  <meta name="geo.position" content="48.137162;16.248877">
  <meta name="geo.region" content="AT">
  <title>Umzug Umzugsfirma Umzugsservice Übersiedlung Wien</title>
  <link rel="canonical" href="https://www.dieumzugsexperten.at/blog.php">
</head>

<body>
  <?php include 'includes/nav.php'; ?>

  <main>


    <div class="container mt-5">
      <div class="row">
        <?php
        $dir = __DIR__ . '/posts/';
        if (is_dir($dir) && ($handle = opendir($dir))) {
          while (false !== ($file = readdir($handle))) {
            if ($file != '.' && $file != '..' && strtolower(substr($file, strrpos($file, '.') + 1)) == 'php') {
              $path = $dir . $file;
              $postUrl = "/posts/" . $file;
              if (is_readable($path)) {
                $content = file_get_contents($path);

                if (
                  preg_match('/<div id="blog-titel">.*?<h1[^>]*>(.*?)<\/h1>.*?<\/div>/s', $content, $title) &&
                  preg_match('/<div id="blog-lead">.*?<p[^>]*>(.*?)<\/p>.*?<\/div>/s', $content, $lead) &&
                  preg_match('/<div id="blog-date">.*?<p[^>]*>(.*?)<\/p>.*?<\/div>/s', $content, $date) &&
                  preg_match('/<div id="blog-category">.*?<p[^>]*>(.*?)<\/p>.*?<\/div>/s', $content, $category) &&
                  preg_match('/<div id="blog-image">(.*?)<\/div>/s', $content, $image)

                ) {
                  echo "<a href='$postUrl' class='col-md-4 mb-4 blog-post-link'>";
                  echo "<div>";
                  // echo strip_tags($image[1], '<img>');
                  echo preg_replace('/<img/', '<img class="blog-image"', strip_tags($image[1], '<img>'));
                  echo '<h2 class="blog-titel">' . strip_tags($title[1]) . '</h2>';
                  echo '<p class="blog-lead">' . substr(strip_tags($lead[1]), 0, 150) . '...</p>';  // Displays the first 150 characters of the lead
                  echo '<p class="blog-date">' . strip_tags($date[1]) . '</p>';
                  echo '<p class="blog-lead">' . strip_tags($category[1]) . '</p>';
                  echo "</div>";
                  echo "</a>";
                } else {
                  echo "<p>Content not matching for $file.</p>";
                }
              } else {
                echo "<p>Cannot read $file.</p>";
              }
            }
          }
          closedir($handle);
        } else {
          echo "<p>Directory not found or cannot be opened.</p>";
        }
        ?>
      </div>
    </div>


  </main>

  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/footer-small.php'; ?>
  <?php include 'includes/scripts.html'; ?>
</body>

</html>