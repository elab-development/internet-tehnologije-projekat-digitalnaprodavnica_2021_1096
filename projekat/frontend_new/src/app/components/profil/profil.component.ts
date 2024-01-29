import { Component, OnInit } from '@angular/core';
import { KorisnikService } from 'src/app/services/korisnik.service';

interface Korisnik {
  email: string
  username: string,
  ime: string,
  prezime: string
  // ovde dodati polje i za profilnu
}

@Component({
  selector: 'app-profil',
  templateUrl: './profil.component.html',
  styleUrls: ['./profil.component.scss']
})
export class ProfilComponent implements OnInit {

  korisnik: Korisnik | undefined;
  profilna: string = '';

  constructor(private korisnikService: KorisnikService) { }

  ngOnInit(): void {
    this.vratiDetaljeKorisnika();
    this.vratiProfilnuSliku();
  }

  vratiDetaljeKorisnika() {
    this.korisnikService.vratiDetaljeKorisnika().subscribe({
      next: (response) => {
        console.log(response.korisnik);
        this.korisnik = response.korisnik;
      }
    })
  }

  vratiProfilnuSliku() {
    this.korisnikService.vratiProfilnuSliku().subscribe({
      next: (response) => {
        console.log(response.url);
        this.profilna = response.url || 'assets/profilna_placeholder.jpg';
      },
      error: (error) => {
        this.profilna = 'assets/profilna_placeholder.jpg';
      }
    })
  }

  onProfilnaChange(event: any) {
    const files = event.target.files as FileList;

    if (files.length > 0) {
      const _profilna = URL.createObjectURL(files[0]);
      console.log(files[0]);

      this.korisnikService.dodajProfilnuSliku(files[0]).subscribe({
        next: (response) => {
          console.log(response);
        },
        error: console.log,
      })

      this.profilna = _profilna;
      this.resetInput();
    }
  }

  resetInput() {
    const input = document.getElementById('avatar-input-file') as HTMLInputElement;
    if (input) {
      input.value = "";
    }
  }

  pokreniIzmenu() {
    // todo
  }

}
