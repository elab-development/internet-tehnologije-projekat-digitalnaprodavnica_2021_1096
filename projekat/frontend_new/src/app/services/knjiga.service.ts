import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { map, Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class KnjigaService {

  constructor(private http: HttpClient) { }

  vratiSveKnjige(): Observable<any> {
    return this.http.get<any>("http://127.0.0.1:8000/api/knjige");
  }

  vratiKnjigePoKategoriji(kategorija: string): Observable<any> {
    return this.http.get<any>(`http://127.0.0.1:8000/api/knjige/kategorija/${kategorija}`);
  }

  vratiDetaljeKnjige(knjigaId: number): Observable<any> {
    return this.http.get<any>(`http://127.0.0.1:8000/api/knjige/${knjigaId}`);
  }

  dodajPdf(knjigaId: number, pdf_fajl: File | null): Observable<any> {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/pdf',
      }),
    };
    return this.http.post<any>(`http://127.0.0.1:8000/api/knjiga/${knjigaId}/dodaj-pdf`, httpOptions);
  }

  vratiPdf(knjigaId: number): Observable<any> {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      }),
      responseType: 'blob' as 'json',
    };

    return this.http.get<any>(`http://127.0.0.1:8000/api/knjiga/${knjigaId}/preuzmi-pdf`, httpOptions);
  }

  kreirajKnjigu(podaci: any): Observable<any> {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      }),
    }
    return this.http.post<any>("http://127.0.0.1:8000/api/knjige", podaci, httpOptions);
  }

  izmeniKnjigu(podaci: any) {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      }),
    }
    return this.http.put<any>(`http://127.0.0.1:8000/api/knjige/${podaci.knjiga_id}`, podaci, httpOptions);
  }

  obrisiKnjigu(knjigaId: any) {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      }),
    }
    return this.http.delete<any>(`http://127.0.0.1:8000/api/knjige/${knjigaId}`, httpOptions);
  }

  vratiKupljeneKnjige(): Observable<any> {
    const korisnikId = localStorage.getItem('korisnikID');
    return this.http.get<any>(`http://127.0.0.1:8000/api/${korisnikId}/moje-knjige`);
  }
}
