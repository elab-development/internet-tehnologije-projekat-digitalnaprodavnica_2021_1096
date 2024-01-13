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
}
