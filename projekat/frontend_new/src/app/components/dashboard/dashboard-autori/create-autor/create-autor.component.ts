import { DatePipe } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { MatDialogRef } from '@angular/material/dialog';
import { MatSnackBar } from '@angular/material/snack-bar';
import { AutorFactory } from 'src/app/factories/autor.factory';
import { Autor } from 'src/app/models/autor.model';
import { AutorService } from 'src/app/services/autor.service';

@Component({
  selector: 'app-create-autor',
  templateUrl: './create-autor.component.html',
  styleUrls: ['./create-autor.component.scss']
})
export class CreateAutorComponent implements OnInit {
  autor!: Autor;

  constructor(private autorService: AutorService, private snackBar: MatSnackBar, private dialogRef: MatDialogRef<CreateAutorComponent>, private datePipe: DatePipe) { }

  ngOnInit(): void {
    const autorFactory = new AutorFactory();
    this.autor = autorFactory.createDefault();
  }

  create() {
    this.autorService.kreirajAutora(this.autor).subscribe({
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
