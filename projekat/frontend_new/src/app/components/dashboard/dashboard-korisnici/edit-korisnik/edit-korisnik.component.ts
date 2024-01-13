import { Component, Inject, OnInit } from '@angular/core';
import { MatSnackBar } from '@angular/material/snack-bar';
import { AuthService } from 'src/app/services/auth.service';
import { CreateKorisnikComponent } from '../create-korisnik/create-korisnik.component';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material/dialog';

@Component({
  selector: 'app-edit-korisnik',
  templateUrl: './edit-korisnik.component.html',
  styleUrls: ['./edit-korisnik.component.scss']
})
export class EditKorisnikComponent implements OnInit {

  podaci = {
    korisnik_id: '',
    email: '',
    username: '',
    password: '',
    ime: '',
    prezime: '',
  };

  constructor(
    private authService: AuthService,
    private snackBar: MatSnackBar,
    private dialogRef: MatDialogRef<CreateKorisnikComponent>,
    @Inject(MAT_DIALOG_DATA) private data: any) {
    this.podaci.korisnik_id = data.korisnik_id;
  }

  ngOnInit(): void {
    this.podaci = {
      korisnik_id: this.data.korisnik_id,
      email: this.data.email,
      username: this.data.username,
      password: this.data.password,
      ime: this.data.ime,
      prezime: this.data.prezime,
    };
  }

  izmeni(podaci: any) {
    this.authService.izmeni(podaci).subscribe({
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
