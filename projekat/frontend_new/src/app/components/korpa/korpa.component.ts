import { Component, OnInit } from '@angular/core';
import { MatSnackBar } from '@angular/material/snack-bar';
import { Router } from '@angular/router';
import { BrojStavkiService } from 'src/app/services/broj-stavki.service';
import { KorpaService } from 'src/app/services/korpa.service';
import { PlacanjeService } from 'src/app/services/placanje.service';

@Component({
  selector: 'app-korpa',
  templateUrl: './korpa.component.html',
  styleUrls: ['./korpa.component.scss']
})
export class KorpaComponent implements OnInit {

  detaljiKorpe: any;
  token = localStorage.getItem('token');
  korisnikID = localStorage.getItem('korisnikID');

  constructor(private korpaService: KorpaService, private brojStavkiService: BrojStavkiService, private placanjeService: PlacanjeService, private snackBar: MatSnackBar) { }

  ngOnInit(): void {
    this.osveziKorpu();
  }

  osveziKorpu() {
    if (this.korisnikID && this.token) {
      this.korpaService.prikaziKorpu(this.korisnikID, this.token).subscribe({
        next: (response) => {
          this.detaljiKorpe = response;
          this.brojStavkiService.azurirajBrojStavki(response.broj_stavki);
        },
        error: console.log,
      })

    }
  }

  obrisiStavkuKorpe(redniBrojStavke: number) {
    this.korpaService.obrisiStavkuKorpe(redniBrojStavke).subscribe({
      next: (response) => {
        console.log(response);
        this.brojStavkiService.azurirajBrojStavki(response.broj_stavki);
        this.osveziKorpu();
        this.snackBar.open(response.poruka, 'Zatvori', {
          duration: 3000,
          horizontalPosition: 'center',
          verticalPosition: 'bottom',
        });
      },
      error:
        console.log,
    })
  }

  isprazniKorpu() {
    this.korpaService.isprazniKorpu(this.korisnikID, this.token).subscribe({
      next: (response) => {
        console.log(response);
        this.brojStavkiService.azurirajBrojStavki(0);
        this.osveziKorpu();
      },
      error: console.log,
    })
  }

  kupi() {
    this.placanjeService.otvoriProzorZaPlacanje();
  }

}
