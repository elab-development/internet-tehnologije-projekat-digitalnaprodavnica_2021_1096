import { Component, OnInit } from '@angular/core';
import { MatDialogRef } from '@angular/material/dialog';
import { MatSnackBar } from '@angular/material/snack-bar';
import { KorisnikFactory } from 'src/app/factories/korisnik.factory';
import { Korisnik } from 'src/app/models/korisnik.model';
import { KorisnikService } from 'src/app/services/korisnik.service';

@Component({
  selector: 'app-create-korisnik',
  templateUrl: './create-korisnik.component.html',
  styleUrls: ['./create-korisnik.component.scss']
})
export class CreateKorisnikComponent implements OnInit {
  korisnik!: Korisnik;

  constructor(private korisnikService: KorisnikService, private snackBar: MatSnackBar, private dialogRef: MatDialogRef<CreateKorisnikComponent>) { }

  ngOnInit(): void {
    const korisnikFactory = new KorisnikFactory();
    this.korisnik = korisnikFactory.createDefault();
  }

  create() {
    this.korisnikService.create(this.korisnik).subscribe({
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
