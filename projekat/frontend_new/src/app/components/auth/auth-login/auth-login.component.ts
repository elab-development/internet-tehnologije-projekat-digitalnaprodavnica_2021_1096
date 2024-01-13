import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-auth-login',
  templateUrl: './auth-login.component.html',
  styleUrls: ['./auth-login.component.scss'],
})
export class AuthLoginComponent {
  podaci = {
    email: '',
    password: '',
  };

  constructor(private authService: AuthService, private router: Router) { }

  login() {
    this.authService.login(this.podaci).subscribe({
      next: (response) => {
        localStorage.setItem('token', response.token);
        localStorage.setItem('korisnikID', response.korisnik.korisnik_id);
        localStorage.setItem('isAdmin', response.korisnik.isAdmin);
        this.router.navigate(['']);
      },
      error: console.log
    })
  }
}

