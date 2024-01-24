<p align="center">
  <img alt="Laravel Verzija" src="https://img.shields.io/badge/laravel-10.10-blue.svg">
  <img alt="PHP Verzija" src="https://img.shields.io/badge/php-8.3-brightgreen.svg">
  <img alt="Angular Verzija" src="https://img.shields.io/badge/angular-16.2.2-red.svg">
  <img alt="npm Verzija" src="https://img.shields.io/badge/npm-9.6.7-blue.svg">
</p>

<p align="center">
  <img alt="Banner" src="projekat/frontend_new/src/assets/readme-banner.png">
</p>

## Opis

Aplikacija predstavlja platformu koja omogućava korisnicima jednostavno istraživanje, kupovinu i preuzimanje knjiga u digitalnom formatu (.pdf). Pruža različite funkcionalnosti za neregistrovane korisnike, registrovane korisnike i administratore.

## Funkcionalnosti

Aplikacija nudi različite funkcionalnosti koje zavise od vrste korisnika.

### Funkcionalnosti za neregistrovane korisnike

- Pretraga kataloga knjiga
- Pregled sadržaja `.pdf` fajlova
- Kreiranje korisničkog naloga

### Funkcionalnosti za registrovane korisnike

- Dodavanje knjiga u korpu
- Kupovina odabranih knjiga
- Personalizacija korisničkog profila (dodavanje profilne slike, izmena korisničkih podataka)
- Preuzimanje `.pdf` fajlova kupljenih knjiga

### Funkcionalnosti za administratore

- CRUD operacije za korisnike
- CRUD operacije za knjige
- CRUD operacije za autore
- CRUD operacije za izdavače

## Uputstvo za Pokretanje Aplikacije

Ovde će biti prikazano detaljno uputstvo kako preuzeti i pokrenuti aplikaciju.

### Preduslovi

Pre preuzimanja, kloniranja ili pokretanja aplikacije, neophodno je instalirati sledeće:

- **PHP:** [Instalacija PHP-a](https://www.php.net/manual/en/install.php)
- **Node.js:** [Instalacija Node.js](https://nodejs.org/en/download/)
- **Laravel:** [Instalacija Laravel-a](https://laravel.com/docs/8.x/installation)
- **Angular:** [Instalacija Angular-a](https://angular.io/guide/setup-local)

*za bazu se predlaže korišćenje [MySQL](https://dev.mysql.com/doc/mysql-installation-excerpt/5.7/en/)*

### Instaliranje aplikacije

1. Otvorite terminal i idite do proizvoljnog direktorijuma
2. Klonirajte aplikaciju:
```bash
  git clone https://github.com/elab-development/internet-tehnologije-projekat-digitalnaprodavnica_2021_1096.git
```
3. Otvorite klonirani direktorijum u proizvoljnom okruženju

#### Konfigurisanje Laravel fajlova

- Unutar direktorijuma aplikacije potrebno je da se ode na `backend`: <br>
```bash
  cd projekat/backend
```
- Instalirati Laravel pakete
```bash
  composer install
```
- Pokrenuti Laravel deo aplikacije
```bash
  php artisan serve
```

#### Konfigurisanje Angular fajlova

- Unutar direktorijuma aplikacije potrebno je da se ode na `frontend`: <br>
```bash
  cd projekat/frontend_new
```
- Instalirati Angular CLI i `npm` pakete
```bash
  npm install -g @angular/cli@16.2.2
```
- Pokrenuti Angular deo aplikacije
```bash
  ng serve
```

## API i Korišćenje Javnih Servisa Aplikacije

Detaljna API dokumentacija se može pronaći [ovde](https://documenter.getpostman.com/view/28553137/2s9YsT5TQS#dc4ca0e5-8a60-4c02-968d-b58e679c8208).

#### Stripe API
Plaćanje korišćenjem Stripe API javnog servisa se može lako implementirati. Neophodno je generisati SK (secret key) i PK (publishable key). Pogledati zvaničnu Stripe [dokumentaciju](https://stripe.com/docs/keys).
Nakon toga, potrebno je dodati ove dve linije u `.env`:
```bash
STRIPE_SK=OVDE UNOSITE VAŠ SK
STRIPE_PK=OVDE UNOSITE VAŠ PK
```
#### Mailtrap e-mail server
Promena lozinke u slučaju zaboravljene lozinke je implementirana korišćenjem [Mailtrap](mailtrap.io) mejl servera. Za detaljne instrukcije konfigurisanja mejl servera pogledati [Mailtrap uputstvo](https://help.mailtrap.io/article/5-testing-integration)

## Contributing

Za detaljne informacije o načinu doprinošenja projektu pogledati [CONTRIBUTING.md](CONTRIBUTING.md).

*rađeno za potrebe seminarskog rada iz predmeta Internet tehnologije.*
