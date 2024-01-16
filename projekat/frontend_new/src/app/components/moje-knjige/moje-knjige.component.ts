import { Component, OnInit } from '@angular/core';
import { MatSnackBar } from '@angular/material/snack-bar';
import { KnjigaService } from 'src/app/services/knjiga.service';

@Component({
  selector: 'app-moje-knjige',
  templateUrl: './moje-knjige.component.html',
  styleUrls: ['./moje-knjige.component.scss']
})
export class MojeKnjigeComponent implements OnInit {


  kupljeneKnjige: any;

  constructor(private knjigaService: KnjigaService, private snackBar: MatSnackBar) { }

  ngOnInit(): void {
    this.vratiKupljeneKnjige();
  }


  vratiKupljeneKnjige() {
    this.knjigaService.vratiKupljeneKnjige().subscribe({
      next: (response) => {
        console.log(response);
        this.kupljeneKnjige = response.knjige;
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
}
