import { Component, OnInit } from '@angular/core';
import { MatSnackBar } from '@angular/material/snack-bar';
import { ActivatedRoute } from '@angular/router';
import { BrojStavkiService } from 'src/app/services/broj-stavki.service';
import { KnjigaService } from 'src/app/services/knjiga.service';
import { KorpaService } from 'src/app/services/korpa.service';

@Component({
  selector: 'app-home-detalji',
  templateUrl: './home-detalji.component.html',
  styleUrls: ['./home-detalji.component.scss']
})
export class HomeDetaljiComponent implements OnInit {

  knjiga: any;
  pdfSrc: any;

  constructor(private knjigaService: KnjigaService, private route: ActivatedRoute, private korpaService: KorpaService, private snackBar: MatSnackBar, private brojStavkiService: BrojStavkiService) { }

  ngOnInit(): void {
    this.route.params.subscribe(params => {
      const knjigaId = params['id'];
      this.vratiDetaljeKnjige(knjigaId);
    })
  }

  vratiDetaljeKnjige(knjigaId: number) {
    this.knjigaService.vratiDetaljeKnjige(knjigaId).subscribe({
      next: (response) => {
        console.log(response);
        this.knjiga = response.knjiga;
      },
      error: console.log,
    })
  }

  dodajUKorpu(knjigaId: number) {
    this.korpaService.dodajUKorpu(knjigaId).subscribe({
      next: (response) => {
        console.log(response);
        this.snackBar.open(response.poruka, 'Zatvori', {
          duration: 3000,
          horizontalPosition: 'center',
          verticalPosition: 'bottom',
        });
        this.brojStavkiService.azurirajBrojStavki(response.broj_stavki);
      }
    })
  }

}
