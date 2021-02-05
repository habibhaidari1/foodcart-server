# Willkommen bei FoodCart

FoodCart ist das Online-Bestellsystem für deinen Lieferservice. Das vorliegende Projekt ist eines von Dreien. Es handelt sich hierbei um die Server-Anwendung basierend auf PHP / Laravel.

<p align="center">
<img src="https://github.com/habibhaidari1/food-cart-js/raw/master/public/icon.png" alt="icon" width="100"/>
</p>
<p align="center">
<img src="https://i.imgur.com/UfkWtpf.jpg" alt="screenshot" width="30%"/>
<img src="https://i.imgur.com/9QnZZhz.jpg" alt="screenshot" width="30%"/>
<img src="https://i.imgur.com/7fYNHVx.jpg" alt="screenshot" width="30%"/> 
</p>

- [Willkommen bei FoodCart](#willkommen-bei-foodcart)
  - [Dokumentation](#dokumentation)
  - [Roadmap](#roadmap)
  - [Beispiel](#beispiel)
  - [Konfiguration](#konfiguration)
    - [Umgebungsvariablen](#umgebungsvariablen)
    - [Speisekarte](#speisekarte)
    - [Lieferzeiten](#lieferzeiten)
    - [Liefergebiete](#liefergebiete)
    - [Zahlungsarten](#zahlungsarten)
    - [Benutzer](#benutzer)
  - [Installation](#installation)
  - [Client](#client)
    - [Rechtliches](#rechtliches)
    - [FoodCart-Projekte](#foodcart-projekte)
    - [Nice Befehle](#nice-befehle)

## Dokumentation

Finde heraus welche Ideen und Konzepte hinter FoodCart stecken und was FoodCart von anderen Bestellsystemen unterscheidet.

[Zur Dokumentation 🧪](DOKUMENTATION.md)

## Roadmap

Hier ist eine Roadmap aller Features

- [x] Integration aller deutschen Postleitzahlen 
- [x] Lieferkosten und Liefergebiete anhand der Postleitzahl konfigurierbar
- [x] Dynamisch konfigurierbare Variationen von Speisen
- [x] Dynamisch konfigurierbare Öffnungszeiten
- [x] Außerordentliche Schließung des Shops möglich
- [x] Allgemeine Geschäftsbedingungen gem. deutschen Recht
- [x] Geschwindigkeitsoptimiert für minimale Ladezeiten (< 500 KB Bundle size)
- [x] Dark-Mode entsprechend der Systemeinstellungen des Benutzers
- [x] Verzicht auf Cookies, um die Benutzungserfahrung und den Datenschutz zu stärken
- [x] Responsive Design
- [x] Integration der PayPal-API
- [x] Storno-Funktion inklusive Zurückerstattung bei Online-Zahlung
- [x] Automatischer Rechnungsversand
- [x] Android App zum Drucken von Belegen und Verwalten des Restaurants
- [x] Export aller Bestellungen als CSV-Report
- [x] Schreiben von WhatsApp-Nachrichten auf die hinterlegte Telefonnummer des Kundens möglich
- [ ] Blockchaining, der Bestellungen, um manipulation der Bestellungen zu verhindern
- [ ] Kundenverwaltung in der App
- [ ] Minimierung von Verpackungsmaterial über ein integriertes Pfand-System für wiederverwendbare Verpackungen
- [ ] Internationalisierung
- [ ] Integration von Freebies ab einem Mindestbestellwert
- [ ] Optionale Cookies
- [ ] eine Funktion zur Verfolgung der Lieferung
- [ ] Datenschutzkonforme Voreingabe der Versanddaten des Kunden
- [ ] Zahlungsarten per App de-/ aktivierbar
- [ ] Funktion zum Durchsuchen der Speisekarte im Client
- [ ] Gutscheincodes für bestimmte Produkte oder Bestelldaten
- [ ] Editierbare Fußzeile in den Kassenbons
- [ ] Integration von Allergene
- [ ] Benachrichtigungssystem basierend auf Websockets
- [ ] Speisekarte über App bearbeitbar
- [ ] Kombination von Speisen zu einem Menü mit besonderen Preisen

[Zur Dokumentation 🧪](DOKUMENTATION.md)


## Beispiel

Schau dir an wie FoodCart aussieht! Sollte dir es gefallen, dann würde ich mich über einen Stern freuen 😊

[Zur Demo-Installation](https://foodcart.habibhaidari1.de/)

**Tipp:** Tarife sind für die Postleitzahl 34119 hinterlegt.

## Konfiguration

### Umgebungsvariablen

Zunächst müssen Umgebungsvariablen konfiguriert werden. Eine beispielhafte Konfiguration befindet sich im `.env.example`. FoodCart-Server basiert auf Laravel, deshalb wird auf eine nähere Erläuterung der einzelnen Umgebungsvariablen verzichtet und auf die [Laravel-Dokumentation](https://laravel.com/docs/master/configuration#environment-configuration) verwiesen. Wichtige Konfigurationshinweise bezüglich Umgebungsvariablen sind dort beschrieben.
Um FoodCart verwenden zu können sind Datenbank- und E-Mail-Treiber verpflichtend zu konfigurieren.

### Speisekarte

FoodCart bietet die Möglichkeit unterschiedliche Speisen in verschiedenen Ausführungen mit unterschiedlichen Preisen und unteschiedlichen Extras abhängig von Variation zu speichern.
Die Speisekarte des Restaurants kann mithilfe der `database/seeds/MenuSeeder.php` einkonfiguriert werden. Um eine Speisekarte zu erstellen, müssen Objekte vom Typ `Category` erzeugt werden. Diese Objekte werden mittels PHP-Arrays befüllt. Eine beispielhafte Speisekarte ist bereits einkonfiguriert.

### Lieferzeiten

Bei FoodCart müssen Lieferzeiten einkonfiguriert werden. Bestellungen können dann nur innerhalb der Lieferzeiten oder im Voraus am selben Tag getätigt werden. Bestellungen sind nicht mehr möglich, sobald die letzte Öffnungszeiten-Periode des Tages vergangen ist.
Lieferzeiten werden unter `database/seeds/OpeningHourSeeder.php` mittels Perioden einkonfiguriert. Um eine neue Periode zu den Lieferzeiten hinzuzufügen, eignet sich folgender Befehl.

`App\OpeningHour::create(['n' => 0, 'from' => $this->timeToInt(11, 0), 'to' => $this->timeToInt(22, 0)]);`

Der Befehl erzeugt eine neue Öffnungszeit am Sonntag von 11:00 Uhr bis 22:00 Uhr. `N` steht für den Wochentag angefangen am Sonntag.

### Liefergebiete

Das System berechnet Lieferkosten anhand der Postleitzahl des Kunden. Liefertarife können unter `database/seeds/RegionSeeder.php` einkonfiguriert werden.
Dazu müssen zunächst mehrere Postleitzahlen zu einer Region zusammengefasst werden. Anschließend wendet man einen Tarif mit verschiedenen Lieferkosten auf die Region an. Liefertarife können auch abhängig vom Mindestbestellwert sein.

### Zahlungsarten

Es können verschiedene Zahlungsarten einkonfiguriert werden, zwischen denen der Kunde auswählen kann. Dabei handelt es sich um Werte, zwischen denen der Kunde auswählen kann. Es werden keine Verbindungen zu Zahlungsdienstleistern hergestellt. Standardmäßig ist die 'Barzahlung bei Lieferung' und die 'Kartenzahlung bei Lieferung' einkonfiguriert.

### Benutzer

Um auf die Bestellungen zugreifen zu können, muss mindestens ein Administrator festgelegt werden. Dieser kann in der Datei `database/seeds/UserSeeder.php` einkonfiguriert werden.

## Installation

1. FoodCart verwendet Composer, um Pakete zu verwalten. Stelle sicher, dass Composer auf deinem Server installiert ist und lade alle Abhängigkeiten mithilfe von `composer install` herunter.
2. Installiere die Datenbank-Relationen mit `php artisan migrate:fresh`
3. Befülle die Relationen mit deiner Konfiguration `php artisan db:seed`
4. Leere gegebenenfalls deinen Cache mithilfe von `php artisan config:clear && php artisan optimize`
5. Starte den Server mit `php artisan serve`

Essenzielle Befehle können bei einem PHP-Hoster ohne Kommandozeile auch über ihre URL ausgeführt werden. Es existieren Routen für `/install`, `/clear` und `/optimize`.
**Wichtig:** Die entsprechenden Routen für die Konfiguration sollten auskonfiguriert werden, bevor das System produktiv läuft.

## Client

Als letzter Installationsschritt muss der Client gebaut werden und die entsprechenden Dateien auf den Server kopiert werden. Das Projekt dazu findet sich unter [FoodCart Projekte 🍲](#FoodCart-Projekte)

### Rechtliches

Ich übernehme keine Gewährleistung dafür, dass die Anwendungen den gesetzlichen Normen und Richtlinien entspricht und übernehme keine Haftung für entstehende Schäden durch den Einsatz dieser Software. Jeder benutzt den Quellcode auf eigene Gefahr.

### FoodCart-Projekte

| Projekt                                                             | Beschreibung               |
| ------------------------------------------------------------------- | -------------------------- |
| [foodcart-server](https://github.com/habibhaidari1/foodcart-server) | Server-Anwendung           |
| [foodcart-client](https://github.com/habibhaidari1/foodcart-client) | Client-Anwendung           |
| [foodcart-admin](https://github.com/habibhaidari1/foodcart-admin)   | Client für Administratoren |

### Nice Befehle

`
composer dump-autoload
rm storage/framework/sessions/*
php artisan auth:clear-resets
php artisan cache:clear
php artisan config:clear
php artisan event:clear
php artisan optimize:clear
php artisan route:clear
php artisan view:clear
`
                   