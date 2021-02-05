**Aus Gründen der besseren Lesbarkeit wird im Folgenden auf die gleichzeitige Verwendung weiblicher und männlicher Sprachformen verzichtet und das generische Maskulinum verwendet. Sämtliche Personenbezeichnungen gelten gleichermaßen für beide Geschlechter.**

# Dokumentation

Finde heraus welche Ideen und Konzepte hinter FoodCart stecken und was FoodCart von anderen Bestellsystemen unterscheidet.

- [Dokumentation](#dokumentation)
  - [Prinzipien](#prinzipien)
    - [Kosteneffizient](#kosteneffizient)
    - [Maßgeschneidert](#maßgeschneidert)
    - [Geschwindigkeitsoptimiert](#geschwindigkeitsoptimiert)
      - [Server](#server)
      - [Eager-Loading vs. Lazy-Loading](#eager-loading-vs-lazy-loading)
      - [Zahlen und Fakten](#zahlen-und-fakten)
    - [Benutzererfahrung](#benutzererfahrung)
      - [Minimalismus](#minimalismus)
      - [Kontinuität](#kontinuität)
      - [Nativität](#nativität)

## Prinzipien

### Kosteneffizient

FoodCart hat das Ziel ein kostengünstiges Online-Bestellsystem für jedermann zu sein. Dazu wurden die Entscheidungen in der Architektur so getroffen, dass die Kosten für die Entwicklung und das Hosting minimal ausfallen. Eine Entscheidung betrifft beispielsweise das Verwenden von PHP und Laravel. PHP ist verglichen mit anderen Programmiersprachen besonders günstig und weit verbreitet im Webhosting. Des Weiteren wurden auf Drittanbieter-Dienstleistungen wie beispielsweise der Google Maps API verzichtet, um keine weiteren Kosten zu verursachen. Die Online-Zahlung wird mittels einer nativen Integration von PayPal ermöglicht. Es wurde auf die Nutzung von Zahlungs-Gateways, wie z.B.: Stripe, CrefoPay oder Adyen verzichtet, um die Anzahl der Drittanbieter und damit die Kosten zu verringern. 

### Maßgeschneidert

Viele Bestellsysteme, die derzeit eingesetzt werden, sind ursprünglich nicht für den Anwendungsfall der Lieferservices entwickelt worden. Dazu gehört das Content-Management-System WordPress. WordPress bietet die Möglichkeit mithilfe von Plugins erweitert zu werden und ist dadurch zu einer „universellen Waffe“ in der Webentwicklung geworden.

Lieferservice-Systeme basierend auf WordPress/ WooCommerce weisen zentrale Probleme auf:

-   Der Funktionsumfang ist nicht für Lieferdienste geeignet. Zum Beispiel ist das Unterbinden von Bestellungen außerhalb der Lieferzeiten nicht möglich.
-   WordPress-Systeme werden erst durch den Einsatz von zahlreichen Plugins zu Bestellsysteme transformiert. Der Prozess, bei dem geeignete Plugins gesucht und installiert werden, kann Zeitraubend sein.
-   WordPress ist relativ langsam, da oftmals die Geschwindigkeitsoptimierung nicht berücksichtigt wird.
-   Lieferkosten werden erst zu einem fortgeschrittenen Zeitpunkt im Bestellprozess berechnet.

### Geschwindigkeitsoptimiert

Die Geschwindigkeit einer Webseite ist ein kritischer Erfolgsfaktor und eine stärke von FoodCart. In FoodCart lassen sich Überlegungen zur Geschwindigkeitsoptimierung kontinuierlich beobachten.

#### Server

In der mitgelieferten Serverkonfiguration wird das **Caching** für sämtliche Anfragen aktiviert. Dadurch kommt es bei einem zweiten Aufruf der Internetseite zu einem stark reduzierten Datenverkehr im einstelligen Kilobyte-Bereich.

Fraglich ist an dieser Stelle was geschieht, wenn sich Teile der Webapplikation ändern.
Hier nutzt FoodCart die Etag-Header aus der HTTP-Anfrage. Bei einer Anfrage prüft der Server, ob sich der Inhalt tatsächlich geändert hat. Im Falle einer geänderten Speisekarte etwa stimmt das Etag aus der Anfrage und des Inhaltes nicht überein und der Server sendet die neuen veränderten Daten heraus. Selbstverständlich komprimiert mithilfe von **gzip**, um den Datenverkehr zu reduzieren.

Die Serveranwendung basiert auf Laravel. Um die Geschwindigkeit zu optimieren, wurde sämtliche nicht relevante Middleware entfernt und teilweise eingeschränkt.

Die Cookie-Middleware ist für Besucher entfernt worden, da:

-   FoodCart über keinen speziellen Bereich für angemeldete Benutzer verfügt.
-   Kein Tracking der Benutzer stattfindet.
-   Keine Zustimmung der Benutzer für die Speicherung von Cookies gemäß DSGVO eingeholt werden muss.
-   Die Rechenschritte reduziert werden und sich die Antwortzeit des Servers verkürzt - wenn auch nur minimal.

Mit dem Entfall der Cookie-Middleware entfällt auch die Notwendigkeit von CSRF-Tokens. Dem entsprechend wurde die dafür notwendige Middleware ebenfalls entfernt.

#### Eager-Loading vs. Lazy-Loading

> „Eager oder Lazy, das ist hier die Frage!“ - _Habibhaidari1, in Anlehnung an William Shakespeare_

Viel Aufmerksamkeit während der Entwicklung bekam die Frage, wie Inhalte geladen werden sollten.
Prinzipiell lassen sich Inhalte von vornherein laden („eager“, zu dt.: eifrig) oder erst wenn sie benötigt werden („lazy“, zu dt.: faul).

Eager werden beispielsweise die verschiedenen Variationen und Extras zu einer Speise geladen. Damit kann der Kunde nach dem Auswählen der Speise seine präferierte Variante der Speise wählen. Es entfällt eine Serveranfrage, die möglicherweise eine Verzögerung im Millisekundenbereich erzeugt hätte.
Auch die Anfragen an die Datenbank sind gemäß dem Eager-Loading gestaltet, um eine mögliche n+1-Problematik zu unterbinden und so das Maximum an Leistung zu erwirtschaften.

Lazy-Loading lässt sich auch beim Laden der Kategorie-Bilder beobachten. Da das Laden von Bildern mit viel Datentransfer einhergeht, werden diese nur geladen, sobald sie im Sichtfeld des Besuchers gelangen.
Das „Windowing“ bietet ebenfalls die Möglichkeit den Zeitpunkt des Renderns von Inhalten erst dann zu vollziehen, wenn sie in den Sichtbereich des Benutzers gelangen. Darauf wurde jedoch bisher verzichtet, weil dann die Suchfunktion des Browsers nicht ordnungsgemäß funktioniert. Sollte in Zukunft eine Suchfunktion implementiert werden, dann ist das „Windowing“ eine gute Möglichkeit den DOM-Baum mithilfe von Lazy-Loading stark zu verkleinern und somit mithilfe von Lazy-Loading noch mehr Usability zu generieren.

#### Zahlen und Fakten

Verglichen mit der führenden Plattform für Lieferdienste hat FoodCart\* deutlich bessere Ladezeiten. 

| Metrik                   | FoodCart  | Lieferservice Plattform |
| ------------------------ | --------- | ----------------------- |
| First Contentful Paint   | 3,2 s     | 4,7 s                   |
| Speed Index              | 3,4 s     | 5,5 s                   |
| Largest Contentful Paint | 3,3 s     | 9,8 s                   |
| **Time to Interactive**  | **4,3 s** | **8,7 s**               |
| Total Blocking Time      | 450 ms    | 750 ms                  |
| Cumulative Layout Shift  | 0,062     | 0                       |

Quelle: Google Lighthouse für Mobilgeräte

### Benutzererfahrung

FoodCart macht die Online-Bestellung zu einem Erlebnis.

#### Minimalismus

Die Benutzeroberfläche ist auf essenzielle Interaktionselemente reduziert. Es stehen lediglich Werkzeuge zur Verfügung, die der Besucher tatsächlich braucht um eine Bestellung zu tätigen. Das ermöglicht den Besucher einen schnellen und unkomplizierten Bestellprozess.
Die Kontinuität des Minimalistischen Ansatzes setzt sich ebenso in der visuellen Gestaltung fort. Die eingesetzten Komponenten entspringen der Material-Designsprache. Zahlreiche Komponenten wurden gestalterisch angepasst, um das Design noch weiter zu modernisieren. Beispielsweise wurden viele Elemente abgerundet und die Schriftart verändert.

#### Kontinuität

Die Oberfläche von FoodCart ähnelt strukturell der Oberfläche des größten Konkurenten. FoodCart wurde bewusst so gestaltet, um die Erfahrungen der Besucher mit anderen Benutzeroberflächen zu nutzen. Das hat zur Folge, dass der Benutzer FoodCart intuitiv richtig bedient. Die Kontinuität ist ebenfalls zwischen verschiedenen Endgeräten gewahrt worden. So kann ein Benutzer, der die Smartphone-Version von FoodCart kennt, auch die Desktop-Version intuitiv bedienen.

#### Nativität

Der umfangreiche Einsatz von Javascript-Technologien ermöglicht eine nativen Softwareprogrammen ähnelnde Benutzererfahrung. Abgerundet wird die Webapplikation mit dem PWA-Manifest. Endgeräte können unabhängig vom Betriebssystem die Webapplikation auf dem Homescreen oder Desktop installieren, als wäre sie eine native Applikation.

<img src="https://i.imgur.com/E4CVLUz.png" alt="icon" />

_Installation auf MacOs 10.15 Catalina_