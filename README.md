# Unibrains Website

Statische Marketing-Website der Unibrains GmbH (Jobs in Deutschland mit Visum,
Umzug & Anerkennung). Reines HTML/CSS – kein Build-Schritt nötig.

## Dateien
- `index.html` – Startseite
- `impressum.html`, `datenschutz.html` – Rechtstexte (Platzhalter ausfüllen)
- `styles.css` – Styling
- `favicon.svg`

## Lokal ansehen
```bash
python3 -m http.server 8099
```

## Deployment
Wird per rsync/SSH auf CWP (unibrains.de) ausgeliefert – siehe `.github/workflows`.
