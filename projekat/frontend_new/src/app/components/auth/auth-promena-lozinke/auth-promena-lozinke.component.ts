import { Component } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-auth-promena-lozinke',
  templateUrl: './auth-promena-lozinke.component.html',
  styleUrls: ['./auth-promena-lozinke.component.scss']
})
export class AuthPromenaLozinkeComponent {


  password: string = "";


  constructor(private authService: AuthService, private router: Router) {
  }

  resetujLozinku() {
    this.authService.resetujLozinku(this.password).subscribe({
      next: (response) => {
        console.log(response);
        localStorage.removeItem('reset-password-token');
        this.router.navigate(['/login']);
      },
      error: console.log,
    })
  }

}
