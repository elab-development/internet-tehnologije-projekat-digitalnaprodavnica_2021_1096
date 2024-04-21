import { Component, ElementRef, OnInit, ViewChild } from '@angular/core';

import { MatSnackBar } from '@angular/material/snack-bar';
import { ActivatedRoute } from '@angular/router';
import { NgxExtendedPdfViewerComponent } from 'ngx-extended-pdf-viewer';
import { Knjiga } from 'src/app/models/knjiga.model';
import { BrojStavkiService } from 'src/app/services/broj-stavki.service';
import { KnjigaService } from 'src/app/services/knjiga.service';
import { KorpaService } from 'src/app/services/korpa.service';

@Component({
  selector: 'app-home-detalji',
  templateUrl: './home-detalji.component.html',
  styleUrls: ['./home-detalji.component.scss']
})
export class HomeDetaljiComponent implements OnInit {

  knjiga!: Knjiga;
  fileURL: any;
  vidiPDF: boolean = false;

  constructor(
    private knjigaService: KnjigaService,
    private route: ActivatedRoute,
    private korpaService: KorpaService,
    private snackBar: MatSnackBar,
    private brojStavkiService: BrojStavkiService,
  ) { }

  @ViewChild(NgxExtendedPdfViewerComponent) pdfViewer!: NgxExtendedPdfViewerComponent;
  @ViewChild('viewerContainer') viewerContainer!: ElementRef;

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
        this.fileURL = URL.createObjectURL(file);
        this.postaviBlurOnPageChange();
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

  postaviBlurOnPageChange() {
    this.pdfViewer.pageChange.pipe().subscribe((pageNumber: number) => {
      const blurAmount = Math.min(pageNumber / 5, 10);
      this.viewerContainer.nativeElement.style.filter = `blur(${blurAmount}px)`;
    });
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
