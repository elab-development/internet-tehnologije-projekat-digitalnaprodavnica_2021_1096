import { Router } from '@angular/router';
import { Component, OnInit } from '@angular/core';
import { AuthService } from 'src/app/services/auth.service';
import { MatSnackBar } from '@angular/material/snack-bar';
import { KorpaService } from 'src/app/services/korpa.service';
import { BrojStavkiService } from 'src/app/services/broj-stavki.service';


@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent implements OnInit {
  brojStavki: number = 0;

  constructor(private router: Router, private authService: AuthService, private snackBar: MatSnackBar, private korpaService: KorpaService, private brojStavkiService: BrojStavkiService) { }

  ngOnInit(): void {
    this.brojStavkiService.brojStavki$.subscribe(noviBroj => {
      this.brojStavki = noviBroj;
    })
  }

  isLoggedIn(): boolean {
    return localStorage.getItem('token') !== null;
  }

  isAdmin(): boolean {
    return localStorage.getItem('isAdmin') === '1';
  }

  redirectToKorpa(): void {
    if (!this.isLoggedIn()) {
      this.router.navigate(['/login']);
    } else {
      this.router.navigate(['/korpa']);
    }
  }

  redirectToProfil(): void {
    if (!this.isLoggedIn()) {
      this.router.navigate(['/login']);
    } else {
      this.router.navigate(['/profil']);
    }
  }

  redirectToDashboard(): void {
    if (!this.isLoggedIn()) {
      this.router.navigate(['/login']);
    } else {
      this.router.navigate(['/dashboard']);
    }
  }

  redirectToLogin(): void {
    this.router.navigate(['/login']);
  }

  redirectToMojeKnjige(): void {
    if (!this.isLoggedIn()) {
      this.router.navigate(['/login']);
    } else {
      this.router.navigate(['/moje-knjige']);
    }
  }

  logout(): void {
    this.authService.logout().subscribe({
      next: (response) => {
        console.log(response);
        localStorage.removeItem('token');
        localStorage.removeItem('korisnikID');
        localStorage.removeItem('isAdmin');

        this.snackBar.open('Uspešno ste se odjavili.', 'Zatvori', {
          duration: 3000,
          horizontalPosition: 'center',
          verticalPosition: 'bottom',
        });

        this.router.navigate(['']);
      }
    })
  }
}
