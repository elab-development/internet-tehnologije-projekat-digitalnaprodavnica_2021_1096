import { DatePipe } from '@angular/common';
import { Component } from '@angular/core';
import { MatDialogRef } from '@angular/material/dialog';
import { MatSnackBar } from '@angular/material/snack-bar';
import { AutorService } from 'src/app/services/autor.service';

@Component({
  selector: 'app-create-autor',
  templateUrl: './create-autor.component.html',
  styleUrls: ['./create-autor.component.scss']
})
export class CreateAutorComponent {
  podaci = {
    ime: '',
    prezime: '',
    datum_rodjenja: '',
    mesto_rodjenja: '',
    biografija: '',
  };

  constructor(private autorService: AutorService, private snackBar: MatSnackBar, private dialogRef: MatDialogRef<CreateAutorComponent>, private datePipe: DatePipe) { }

  create() {
    this.autorService.kreirajAutora(this.podaci).subscribe({
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
