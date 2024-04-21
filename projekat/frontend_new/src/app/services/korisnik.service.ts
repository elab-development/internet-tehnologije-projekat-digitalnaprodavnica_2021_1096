import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Korisnik } from '../models/korisnik.model';

@Injectable({
  providedIn: 'root'
})
export class KorisnikService {

  constructor(private http: HttpClient) { }

  private KORISNIK_URL: string = 'http://127.0.0.1:8000/api/korisnici/';

  vratiSveKorisnike(): Observable<any> {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.http.get<any>(this.KORISNIK_URL, httpOptions);
  }

  vratiDetaljeKorisnika(): Observable<any> {
    const korisnik_id = localStorage.getItem('korisnikID');
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.http.get<any>(this.KORISNIK_URL + korisnik_id, httpOptions);
  }

  obrisiKorisnika(korisnikId: number): Observable<any> {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.http.delete<any>(this.KORISNIK_URL + korisnikId, httpOptions);
  }

  create(korisnik: Korisnik) {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.http.post<any>(this.KORISNIK_URL, korisnik, httpOptions);
  }

  izmeni(korisnik: Korisnik) {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.http.put<any>(this.KORISNIK_URL + korisnik.korisnik_id, korisnik, httpOptions);
  }

  vratiKupljeneKnjige(): Observable<any> {
    const korisnikId = localStorage.getItem('korisnikID');
    return this.http.get<any>(`http://127.0.0.1:8000/api/${korisnikId}/moje-knjige`);
  }

  vratiProfilnuSliku(): Observable<any> {
    const korisnikId = localStorage.getItem('korisnikID');
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.http.get<any>(`http://127.0.0.1:8000/api/${korisnikId}/vrati-profilnu-sliku`, httpOptions);
  }

  dodajProfilnuSliku(profilnaSlika: File): Observable<any> {
    const korisnikId = localStorage.getItem('korisnikID');
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    const formData = new FormData();
    formData.append('profilna_slika', profilnaSlika)
    return this.http.post<any>(`http://127.0.0.1:8000/api/${korisnikId}/dodaj-profilnu-sliku`, formData, httpOptions);
  }
}
