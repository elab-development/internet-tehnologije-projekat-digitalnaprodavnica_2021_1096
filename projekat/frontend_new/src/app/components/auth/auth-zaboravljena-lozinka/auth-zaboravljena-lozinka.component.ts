import { Component } from '@angular/core';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-auth-zaboravljena-lozinka',
  templateUrl: './auth-zaboravljena-lozinka.component.html',
  styleUrls: ['./auth-zaboravljena-lozinka.component.scss']
})
export class AuthZaboravljenaLozinkaComponent {

  email: string = "";
  token: string = "";

  constructor(private authService: AuthService) { }

  posaljiMejl() {
    console.log(this.email);
    this.authService.posaljiMejl(this.email).subscribe({
      next: (response) => {
        console.log(response);
        this.token = response.token;
        localStorage.setItem('reset-password-token', this.token);
      },
      error: console.log,
    })
  }

}
