import { AutorService } from './../../../../services/autor.service';
import { IzdavacService } from './../../../../services/izdavac.service';
import { Component, OnInit } from '@angular/core';
import { MatDialogRef } from '@angular/material/dialog';
import { MatSnackBar } from '@angular/material/snack-bar';
import { KnjigaFactory } from 'src/app/factories/knjiga.factory';
import { Autor } from 'src/app/models/autor.model';
import { Izdavac } from 'src/app/models/izdavac.model';
import { Knjiga } from 'src/app/models/knjiga.model';
import { KnjigaService } from 'src/app/services/knjiga.service';

@Component({
  selector: 'app-create-knjiga',
  templateUrl: './create-knjiga.component.html',
  styleUrls: ['./create-knjiga.component.scss']
})
export class CreateKnjigaComponent implements OnInit {

  knjiga!: Knjiga;
  sviIzdavaci: Izdavac[] = [];
  sviAutori: Autor[] = [];

  constructor(private knjigaService: KnjigaService, private autorService: AutorService, private izdavacService: IzdavacService, private snackBar: MatSnackBar, private dialogRef: MatDialogRef<CreateKnjigaComponent>) { }

  ngOnInit(): void {
    this.vratiSveIzdavace();
    this.vratiSveAutore();
    const knjigaFactory = new KnjigaFactory();
    this.knjiga = knjigaFactory.createDefault();
  }

  vratiSveIzdavace() {
    this.izdavacService.vratiSveIzdavace().subscribe({
      next: (response) => {
        this.sviIzdavaci = response.izdavaci;
      },
      error: console.log,
    })
  }

  vratiSveAutore() {
    this.autorService.vratiSveAutore().subscribe({
      next: (response) => {
        this.sviAutori = response.autori;
      },
      error: console.log,
    })
  }

  create() {
    this.knjigaService.kreirajKnjigu(this.knjiga).subscribe({
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
