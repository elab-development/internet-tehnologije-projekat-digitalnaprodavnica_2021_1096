import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { KorpaService } from 'src/app/services/korpa.service';

@Component({
  selector: 'app-korpa',
  templateUrl: './korpa.component.html',
  styleUrls: ['./korpa.component.scss']
})
export class KorpaComponent implements OnInit {

  detaljiKorpe: any;
  token = localStorage.getItem('token');
  korisnikID = localStorage.getItem('korisnikID');

  constructor(private korpaService: KorpaService) { }

  ngOnInit(): void {
    this.osveziKorpu();
  }

  osveziKorpu() {
    if (this.korisnikID && this.token) {
      this.korpaService.prikaziKorpu(this.korisnikID, this.token).subscribe({
        next: (response) => {
          this.detaljiKorpe = response;
        },
        error: console.log,
      })

    }
  }

  obrisiStavkuKorpe(redniBrojStavke: number) {
    this.korpaService.obrisiStavkuKorpe(this.korisnikID, redniBrojStavke, this.token).subscribe({
      next: (response) => {
        console.log(response);
        this.korpaService.brojStavki--;
        this.osveziKorpu();
      },
      error:
        console.log,
    })
  }


  isprazniKorpu() {
    this.korpaService.isprazniKorpu(this.korisnikID, this.token).subscribe({
      next: (response) => {
        console.log(response);
        this.korpaService.brojStavki = 0;
        this.osveziKorpu();
      },
      error: console.log,
    })
  }

}
