import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BehaviorSubject, Observable, tap } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class KorpaService {

  public brojStavki: BehaviorSubject<number> = new BehaviorSubject<number>(0);

  constructor(private http: HttpClient) { }

  dodajUKorpu(knjigaId: number): Observable<any> {
    const korisnikId = localStorage.getItem('korisnikID');
    const kolicina = 1;
    const token = localStorage.getItem('token');

    const podaci = { knjiga_id: knjigaId, kolicina: kolicina };
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    };
    return this.http.post<any>(`http://127.0.0.1:8000/api/${korisnikId}/korpa`, podaci, httpOptions)
      .pipe(
        tap(response => {
          this.brojStavki.next(response.broj_stavki);
        })
      );
  }

  prikaziKorpu(korisnikID: string | null, token: string | null): Observable<any> {
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    };
    return this.http.get<any>(`http://127.0.0.1:8000/api/${korisnikID}/korpa`, httpOptions);
  }

  obrisiStavkuKorpe(redniBrojStavke: number): Observable<any> {
    const korisnikId = localStorage.getItem('korisnikID');
    const token = localStorage.getItem('token');

    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    };
    return this.http.delete<any>(`http://127.0.0.1:8000/api/${korisnikId}/korpa/${redniBrojStavke}`, httpOptions);
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
