import { KorisnikService } from 'src/app/services/korisnik.service';
import { Component, Inject, OnInit } from '@angular/core';
import { MatSnackBar } from '@angular/material/snack-bar';
import { CreateKorisnikComponent } from '../create-korisnik/create-korisnik.component';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material/dialog';
import { Korisnik } from 'src/app/models/korisnik.model';

@Component({
  selector: 'app-edit-korisnik',
  templateUrl: './edit-korisnik.component.html',
  styleUrls: ['./edit-korisnik.component.scss']
})
export class EditKorisnikComponent implements OnInit {

  korisnik!: Korisnik;

  constructor(
    private korisnikService: KorisnikService,
    private snackBar: MatSnackBar,
    private dialogRef: MatDialogRef<CreateKorisnikComponent>,
    @Inject(MAT_DIALOG_DATA) private data: { korisnik: Korisnik }) {
    this.korisnik = data.korisnik;
  }

  ngOnInit(): void {
    this.korisnik = this.data.korisnik;
  }

  izmeni(podaci: any) {
    this.korisnikService.izmeni(podaci).subscribe({
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
