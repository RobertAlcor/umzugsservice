module.exports = {
  php: "C:\\xampp\\php\\php.exe",
  // Standardport für den Server (anpassen, wenn belegt)
  port: 5500, // Sie können einen anderen Port verwenden

  // Überwachte Dateien oder Ordner, die Live Reload auslösen
  watch: [
      "**/*.html",
      "**/*.css",
      "**/*.js",
      "**/*.php",
      "**/*.json",
      "images/*",
  ], // Erweiterte Überwachung

  // Dateien oder Verzeichnisse, die vom Live Reload ausgeschlossen sind
  ignore: ["node_modules", ".git", "config.js", "logs/*"], // Erweitert, um Protokolle auszuschließen

  // SSL-Konfiguration (wenn HTTPS benötigt wird)
  ssl: {
      enabled: false, // Aktivieren, wenn SSL erforderlich ist
      key: "/ssl/key.pem", // Pfad zum SSL-Schlüssel
      cert: "/ssl/cert.pem", // Pfad zum SSL-Zertifikat
  },

  // Konsolenausgabe-Level (0=minimal, 3=ausführlich)
  logLevel: 2, // Höheres Level für mehr Details

  // Automatische Routen oder Umleitungen
  routes: {
      "/": "index.php", // Hauptumleitung
      "/about": "about.html", // Benutzerdefinierte Route
      "/api/*": "api/index.js", // Wildcard-Route für APIs
  },

  // HTTP-Header anpassen für zusätzliche Sicherheit oder CORS-Konfiguration
  headers: {
      "Access-Control-Allow-Origin": "*", // CORS-Konfiguration
      "X-Frame-Options": "DENY", // Sicherheitsheader
      "Strict-Transport-Security": "max-age=31536000; includeSubDomains", // SSL-Sicherheit
      "X-Content-Type-Options": "nosniff", // Schutz vor MIME-Sniffing
      "Content-Security-Policy": "default-src 'self'", // CSP für erhöhte Sicherheit
  },

  // Ereignishandler für benutzerdefinierte Aktionen
  events: {
      onServerStart: () => {
          console.log("Five Server erfolgreich gestartet."); // Protokollierung beim Start
      },
      onFileChange: (filePath) => {
          console.log(`Datei geändert: ${filePath}`); // Protokollierung bei Dateiänderung
          // Automatisches Neuladen oder benutzerdefinierte Aktion
      },
      onServerError: (error) => {
          console.error("Serverfehler:", error); // Fehlerbehandlung
      },
  },

  // Hot Reload statt Live Reload für schnellere Aktualisierung
  hotReload: true, // Aktivieren für schnellere Aktualisierung

  // Erweiterte Konfiguration für automatisches Öffnen im Browser
  openBrowser: true, // Der Browser öffnet sich automatisch beim Serverstart
};
