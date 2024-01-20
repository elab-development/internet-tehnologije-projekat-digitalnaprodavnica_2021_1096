import { Component, OnInit, ViewChild } from '@angular/core';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatSnackBar } from '@angular/material/snack-bar';
import { pokreniAnimaciju } from 'src/app/directives/animacija';
import { BrojStavkiService } from 'src/app/services/broj-stavki.service';
import { KnjigaService } from 'src/app/services/knjiga.service';
import { KorpaService } from 'src/app/services/korpa.service';

@Component({
  selector: 'app-home-knjige',
  templateUrl: './home-knjige.component.html',
  styleUrls: ['./home-knjige.component.scss'],
  animations: [pokreniAnimaciju],
})
export class HomeKnjigeComponent implements OnInit {

  knjige: any;
  izabranaKategorija: string = "Sve";
  jedinstveneKategorije: string[] = [];
  pageSlice: any;
  pokreniAnimacijuState: string = 'inactive';

  constructor(private knjigaService: KnjigaService, private korpaService: KorpaService, private snackBar: MatSnackBar, private brojStavkiService: BrojStavkiService) { }

  @ViewChild(MatPaginator) paginator!: MatPaginator;

  ngOnInit(): void {
    this.vratiKnjigePoKategoriji(this.izabranaKategorija);
    console.log(this.pageSlice)
  }

  vratiSveKnjige() {
    this.knjigaService.vratiSveKnjige().subscribe({
      next: (response) => {
        this.knjige = response.knjige;
        console.log(response);
        this.vratiJedinstveneKategorije();
        this.pageSlice = this.knjige.slice(0, 12);
      },
      error: console.log,
    })
  }

  vratiJedinstveneKategorije() {
    const kategorije: string[] = this.knjige?.map((knjiga: any) => knjiga.kategorija);
    if (kategorije) {
      this.jedinstveneKategorije = [...new Set(kategorije)];
    }
  }

  vratiKnjigePoKategoriji(kategorija: string): any {
    if (kategorija === "Sve" || !kategorija) {
      this.vratiSveKnjige();
    } else {
      this.knjigaService.vratiKnjigePoKategoriji(kategorija).subscribe({
        next: (response) => {
          this.knjige = response.knjige;
          this.pageSlice = this.knjige.slice(0, 12);
        },
        error: console.log
      })
    }
  }

  onKategorijaChange(izabranaKategorija: string): void {
    this.izabranaKategorija = izabranaKategorija;
    this.vratiKnjigePoKategoriji(this.izabranaKategorija);
    this.pageSlice = this.knjige.slice(0, 12);
  }

  onPageChange(event: PageEvent) {
    console.log(event);
    const startIndex = event.pageIndex * event.pageSize;
    let endIndex = startIndex + event.pageSize;
    if (endIndex > this.knjige.length) {
      endIndex = this.knjige.length;
    }
    this.pageSlice = this.knjige.slice(startIndex, endIndex);
  }

  dodajUKorpu(knjigaId: number) {
    this.pokreniAnimacijuState = 'active';
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
    setTimeout(() => {
      this.pokreniAnimacijuState = 'inactive';
    }, 300);
  }

}
