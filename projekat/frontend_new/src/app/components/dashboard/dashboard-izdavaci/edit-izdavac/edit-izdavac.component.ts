import { Component, Inject } from '@angular/core';
import { IzdavacService } from 'src/app/services/izdavac.service';
import { CreateIzdavacComponent } from '../create-izdavac/create-izdavac.component';
import { MatSnackBar } from '@angular/material/snack-bar';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material/dialog';

@Component({
  selector: 'app-edit-izdavac',
  templateUrl: './edit-izdavac.component.html',
  styleUrls: ['./edit-izdavac.component.scss']
})
export class EditIzdavacComponent {
  podaci = {
    izdavac_id: '',
    naziv: '',
    adresa: '',
  };

  constructor(
    private izdavacService: IzdavacService,
    private snackBar: MatSnackBar,
    private dialogRef: MatDialogRef<CreateIzdavacComponent>,
    @Inject(MAT_DIALOG_DATA) private data: any) {
    this.podaci.izdavac_id = data.izdavac_id;
  }

  ngOnInit(): void {
    this.podaci = {
      izdavac_id: this.data.izdavac_id,
      naziv: this.data.naziv,
      adresa: this.data.adresa,
    };
  }

  izmeni(podaci: any) {
    this.izdavacService.izmeniIzdavaca(podaci).subscribe({
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
