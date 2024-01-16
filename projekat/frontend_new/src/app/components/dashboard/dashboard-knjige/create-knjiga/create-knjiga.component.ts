import { AutorService } from './../../../../services/autor.service';
import { IzdavacService } from './../../../../services/izdavac.service';
import { Component, OnInit } from '@angular/core';
import { MatDialogRef } from '@angular/material/dialog';
import { MatSnackBar } from '@angular/material/snack-bar';
import { KnjigaService } from 'src/app/services/knjiga.service';

@Component({
  selector: 'app-create-knjiga',
  templateUrl: './create-knjiga.component.html',
  styleUrls: ['./create-knjiga.component.scss']
})
export class CreateKnjigaComponent implements OnInit {

  podaci: {
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

  constructor(private knjigaService: KnjigaService, private autorService: AutorService, private izdavacService: IzdavacService, private snackBar: MatSnackBar, private dialogRef: MatDialogRef<CreateKnjigaComponent>) { }

  ngOnInit(): void {
    this.vratiSveIzdavace();
    this.vratiSveAutore()
  }

  vratiSveIzdavace() {
    this.izdavacService.vratiSveIzdavace().subscribe({
      next: (response) => {
        console.log(response);
        this.izdavaci = response.izdavaci;
      },
      error: console.log,
    })
  }

  vratiSveAutore() {
    this.autorService.vratiSveAutore().subscribe({
      next: (response) => {
        console.log(response);
        this.sviAutori = response.autori;
      }
    })
  }

  create() {
    this.podaci.autor = this.izabraniAutori;

    this.knjigaService.kreirajKnjigu(this.podaci).subscribe({
      next: (response) => {
        console.log(response);
        this.snackBar.open(response.status, 'Zatvori', {
          duration: 3000,
          horizontalPosition: 'center',
          verticalPosition: 'bottom',
        });
        this.dialogRef.close(true);
      },
      error: console.log,
    })
  }

}
