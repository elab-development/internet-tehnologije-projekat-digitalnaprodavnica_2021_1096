import { animate, state, style, transition, trigger } from '@angular/animations';
import { Component } from '@angular/core';
import { MatSnackBar } from '@angular/material/snack-bar';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-auth-login',
  templateUrl: './auth-login.component.html',
  styleUrls: ['./auth-login.component.scss'],
  animations: [
    trigger('fadeInOut', [
      state('void', style({
        opacity: 0
      })),
      transition('void <=> *', animate(1000)),
    ]),
  ],
})
export class AuthLoginComponent {
  podaci = {
    email: '',
    password: '',
  };

  constructor(private authService: AuthService, private router: Router, private snackBar: MatSnackBar) { }

  login() {
    this.authService.login(this.podaci).subscribe({
      next: (response) => {
        localStorage.setItem('token', response.token);
        localStorage.setItem('korisnikID', response.korisnik.korisnik_id);
        localStorage.setItem('isAdmin', response.korisnik.isAdmin);
        this.router.navigate(['']);
      },
      error: (err) => {
        console.error(err)
        this.snackBar.open('Greška prilikom unosa podataka', 'Zatvori', {
          duration: 3000,
          horizontalPosition: 'center',
          verticalPosition: 'bottom',
        });
      }
    })

  }
}

