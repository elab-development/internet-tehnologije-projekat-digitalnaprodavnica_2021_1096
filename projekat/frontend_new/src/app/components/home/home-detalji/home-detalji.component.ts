import { Component, OnInit } from '@angular/core';
import { MatSnackBar } from '@angular/material/snack-bar';
import { ActivatedRoute } from '@angular/router';
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

  constructor(private knjigaService: KnjigaService, private route: ActivatedRoute, private korpaService: KorpaService, private snackBar: MatSnackBar) { }

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

  vratiPDF(knjigaId: number) {
    this.knjigaService.vratiPdf(knjigaId).subscribe({
      next: (blob) => {
        const file = new Blob([blob], { type: 'application/pdf' });
        const fileURL = URL.createObjectURL(file);
        window.open(fileURL, '_blank');
      },
      error: (err) => {
        console.error(err)
        this.snackBar.open('Izabrana knjiga nema PDF fajl.', 'Zatvori', {
          duration: 3000,
          horizontalPosition: 'center',
          verticalPosition: 'bottom',
        });
      }
    })
  }

  dodajUKorpu(knjigaId: number) {
    const korisnikId = localStorage.getItem('korisnikID');
    const kolicina = 1;
    const token = localStorage.getItem('token');
    this.korpaService.dodajUKorpu(korisnikId, knjigaId, kolicina, token);
  }

}
