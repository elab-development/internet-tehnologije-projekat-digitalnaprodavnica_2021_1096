import { Component } from '@angular/core';
import { MatDialogRef } from '@angular/material/dialog';
import { MatSnackBar } from '@angular/material/snack-bar';
import { IzdavacService } from 'src/app/services/izdavac.service';

@Component({
  selector: 'app-create-izdavac',
  templateUrl: './create-izdavac.component.html',
  styleUrls: ['./create-izdavac.component.scss']
})
export class CreateIzdavacComponent {
  podaci = {
    naziv: '',
    adresa: '',
  };

  constructor(private izdavacService: IzdavacService, private snackBar: MatSnackBar, private dialogRef: MatDialogRef<CreateIzdavacComponent>) { }

  create() {
    this.izdavacService.kreirajIzdavaca(this.podaci).subscribe({
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
