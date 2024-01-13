import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-auth-register',
  templateUrl: './auth-register.component.html',
  styleUrls: ['./auth-register.component.scss']
})
export class AuthRegisterComponent {

  podaci = {
    email: '',
    username: '',
    password: '',
    ime: '',
    prezime: '',
  };

  constructor(private authService: AuthService, private router: Router) { }

  register() {
    this.authService.register(this.podaci).subscribe({
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
