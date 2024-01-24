import { Component } from '@angular/core';
import { MatSnackBar } from '@angular/material/snack-bar';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-auth-zaboravljena-lozinka',
  templateUrl: './auth-zaboravljena-lozinka.component.html',
  styleUrls: ['./auth-zaboravljena-lozinka.component.scss']
})
export class AuthZaboravljenaLozinkaComponent {

  email: string = "";
  token: string = "";

  constructor(private authService: AuthService, private snackBar: MatSnackBar) { }

  posaljiMejl() {
    console.log(this.email);
    this.authService.posaljiMejl(this.email).subscribe({
      next: (response) => {
        console.log(response);
        this.token = response.token;
        localStorage.setItem('reset-password-token', this.token);
      },
      error: (err) => {
        console.error(err)
        this.snackBar.open('Greška', 'Zatvori', {
          duration: 3000,
          horizontalPosition: 'center',
          verticalPosition: 'bottom',
        });
      }
    })
  }

}
