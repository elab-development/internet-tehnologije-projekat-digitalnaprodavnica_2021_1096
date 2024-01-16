import { Component, Inject, OnInit } from '@angular/core';
import { MatSnackBar } from '@angular/material/snack-bar';
import { KnjigaService } from 'src/app/services/knjiga.service';
import { DashboardKnjigeComponent } from '../dashboard-knjige.component';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material/dialog';

@Component({
  selector: 'app-edit-knjiga',
  templateUrl: './edit-knjiga.component.html',
  styleUrls: ['./edit-knjiga.component.scss']
})
export class EditKnjigaComponent implements OnInit {
  podaci: {
    knjiga_id: number,
    isbn: string,
    naziv: string,
    kategorija: string,
    opis: string,
    pismo: string,
    godina: string,
    strana: string,
    cena: string,
    autor: any[],
    izdavac_id: string,
  } = {
      knjiga_id: 0,
      isbn: '',
      naziv: '',
      kategorija: '',
      opis: '',
      pismo: '',
      godina: '',
      strana: '',
      cena: '',
      autor: [],
      izdavac_id: '',
    };

  izdavaci: any[] = [];
  sviAutori: any[] = [];
  izabraniAutori: any[] = [];

  constructor(
    private knjigaService: KnjigaService,
    private snackBar: MatSnackBar,
    private dialogRef: MatDialogRef<DashboardKnjigeComponent>,
    @Inject(MAT_DIALOG_DATA) private data: any) {
    this.podaci.knjiga_id = data.knjiga_id;
  }

  ngOnInit(): void {
    this.podaci = {
      knjiga_id: this.data.knjiga_id,
      isbn: this.data.isbn,
      naziv: this.data.naziv,
      kategorija: this.data.kategorija,
      opis: this.data.opis,
      pismo: this.data.pismo,
      godina: this.data.godina,
      strana: this.data.strana,
      cena: this.data.cena,
      autor: this.data.autor,
      izdavac_id: this.data.izdavac_id,
    }
  }

  izmeni(podaci: any) {
    this.podaci.autor = this.izabraniAutori;

    this.knjigaService.izmeniKnjigu(podaci).subscribe({
      next: (response) => {
        console.log(response);
        this.snackBar.open(response.status, 'Zatvori', {
          duration: 3000,
          horizontalPosition: 'center',
          verticalPosition: 'bottom',
        });
        this.dialogRef.close(true);
      }
    })
  }
}
