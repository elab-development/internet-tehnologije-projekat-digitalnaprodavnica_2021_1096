import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class KorisnikService {

  constructor(private http: HttpClient) { }

  vratiSveKorisnike(): Observable<any> {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.http.get<any>("http://127.0.0.1:8000/api/korisnici", httpOptions);
  }

  vratiDetaljeKorisnika(): Observable<any> {
    const korisnik_id = localStorage.getItem('korisnikID');
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.http.get<any>(`http://127.0.0.1:8000/api/korisnici/${korisnik_id}`, httpOptions);
  }

  obrisiKorisnika(korisnikId: number): Observable<any> {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.http.delete<any>(`http://127.0.0.1:8000/api/korisnici/${korisnikId}`, httpOptions);
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
}
