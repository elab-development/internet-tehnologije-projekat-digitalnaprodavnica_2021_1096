import { Component, OnInit } from '@angular/core';
import { KorisnikService } from 'src/app/services/korisnik.service';

interface Korisnik {
  email: string
  username: string,
  ime: string,
  prezime: string
}

@Component({
  selector: 'app-profil',
  templateUrl: './profil.component.html',
  styleUrls: ['./profil.component.scss']
})
export class ProfilComponent implements OnInit {

  korisnik: Korisnik | undefined;

  constructor(private korisnikService: KorisnikService) { }

  ngOnInit(): void {
    this.vratiDetaljeKorisnika();
  }

  vratiDetaljeKorisnika() {
    this.korisnikService.vratiDetaljeKorisnika().subscribe({
      next: (response) => {
        console.log(response.korisnik);
        this.korisnik = response.korisnik;
      }
    })
  }

  pokreniIzmenu() {

  }

}
