import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class KorisnikService {

  constructor(private http: HttpClient) { }

  vratiSveKorisnike() {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.http.get<any>("http://127.0.0.1:8000/api/korisnici", httpOptions);
  }

  vratiDetaljeKorisnika() {
    const korisnik_id = localStorage.getItem('korisnikID');
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.http.get<any>(`http://127.0.0.1:8000/api/korisnici/${korisnik_id}`, httpOptions);
  }

  obrisiKorisnika(korisnikId: number) {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.http.delete<any>(`http://127.0.0.1:8000/api/korisnici/${korisnikId}`, httpOptions);
  }
}
