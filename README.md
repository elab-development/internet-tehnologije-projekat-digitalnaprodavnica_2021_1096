[![Laravel Version](https://img.shields.io/badge/laravel-10.10-blue.svg)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/php-8.3-brightgreen.svg)](https://www.php.net/)
[![Angular Version](https://img.shields.io/badge/angular-16.2.2-red.svg)](https://angular.io/)
[![npm Version](https://img.shields.io/badge/npm-9.6.7-blue.svg)](https://www.npmjs.com/)

![banner](projekat/frontend_new/src/assets/readme-banner.png)


## Opis

Aplikacija je platforma koja omogućava korisnicima istraživanje, kupovinu i preuzimanje knjiga u digitalnom formatu (.pdf), odnosno e-knjige. Pruža različite funkcionalnosti za registrovane korisnike, neregistrovane korisnike i administratore.<br>
Rađeno za potrebe seminarskog rada iz predmeta **Internet tehnologije**.

## Funkcionalnosti

### Neregistrovani korisnici

- Pregled široke ponude knjiga
- Pretraga celokupne biblioteke
- Detaljne informacije o knjigama
- Neobavezno kreiranje korisničkog naloga za pristup sadržaju

### Registrovani korisnici

- Dodavanje knjiga u korpu za kupovinu
- Preuzimanje kupljenih knjiga u PDF formatu
- Promena detalja profila i lozinke

### Administratori

- CRUD operacije za knjige, autore, izdavače i korisnike
- Postavljanje (.pdf) fajlova za knjige

## Registracija i Prijavljivanje

- Prilikom registracije potrebni podaci: email, lozinka, korisničko ime, ime i prezime
- Za prijavljivanje dovoljni su email i lozinka

## Detalji Knjiga, Autora i Izdavača

- Knjige: ISBN, naziv, podaci o autorima, izdavaču, kategorija, pismo, broj strana, godina izdanja, kratak opis, cena
- Autori: ime, prezime, datum rođenja, mesto rođenja, kratka biografija
- Izdavači: naziv, adresa

## Proces Kupovine

- Registracija i prijava korisničkog naloga pre kupovine
- Dodavanje knjiga u korpu
- Plaćanje sadržaja korpe za preuzimanje PDF fajlova kupljenih knjiga
- Mogućnost prekida transakcije i uklanjanja stavki iz korpe

## Contributing

1. Klonirati repositorijum i kreirati novu granu: `$ git checkout https://github.com/elab-development/internet-tehnologije-projekat-digitalnaprodavnica_2021_1096 -b naziv_nove_grane`
2. Napraviti promene i testirati
3. Poslati Pull Request sa detaljnim opisom promena
