import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class KorpaService {

  public brojStavki: number = 0;

  constructor(private http: HttpClient) { }

  dodajUKorpu(korisnikID: string | null, knjigaId: number, kolicina: number, token: string | null): Observable<any> {
    const podaci = { knjiga_id: knjigaId, kolicina: kolicina };
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    };
    return this.http.post<any>(`http://127.0.0.1:8000/api/${korisnikID}/korpa`, podaci, httpOptions);
  }

  prikaziKorpu(korisnikID: string | null, token: string | null): Observable<any> {
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    };
    return this.http.get<any>(`http://127.0.0.1:8000/api/${korisnikID}/korpa`, httpOptions);
  }

  obrisiStavkuKorpe(korisnikID: string | null, redniBrojStavke: number, token: string | null): Observable<any> {
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    };
    return this.http.delete<any>(`http://127.0.0.1:8000/api/${korisnikID}/korpa/${redniBrojStavke}`, httpOptions);
  }

  isprazniKorpu(korisnikID: string | null, token: string | null): Observable<any> {
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    };
    return this.http.delete<any>(`http://127.0.0.1:8000/api/${korisnikID}/korpa`, httpOptions);
  }
}
