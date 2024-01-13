import { Component } from '@angular/core';
import { MatDialogRef } from '@angular/material/dialog';
import { MatSnackBar } from '@angular/material/snack-bar';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-create-korisnik',
  templateUrl: './create-korisnik.component.html',
  styleUrls: ['./create-korisnik.component.scss']
})
export class CreateKorisnikComponent {
  podaci = {
    email: '',
    username: '',
    password: '',
    ime: '',
    prezime: '',
  };

  constructor(private authService: AuthService, private snackBar: MatSnackBar, private dialogRef: MatDialogRef<CreateKorisnikComponent>) { }

  create() {
    this.authService.create(this.podaci).subscribe({
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
