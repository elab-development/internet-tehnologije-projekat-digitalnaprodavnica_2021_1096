import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { map, Observable } from 'rxjs';
import { Knjiga } from '../models/knjiga.model';

@Injectable({
  providedIn: 'root'
})
export class KnjigaService {

  constructor(private http: HttpClient) { }

  private KNJIGA_URL: string = 'http://127.0.0.1:8000/api/knjige/';

  vratiSveKnjige(): Observable<any> {
    return this.http.get<any>(this.KNJIGA_URL);
  }

  vratiKnjigePoKategoriji(kategorija: string): Observable<any> {
    return this.http.get<any>(this.KNJIGA_URL + kategorija);
  }

  vratiDetaljeKnjige(knjigaId: number): Observable<any> {
    return this.http.get<any>(this.KNJIGA_URL + knjigaId);
  }

  vratiBrojKnjigaPoKategoriji(): Observable<any> {
    return this.http.get<any>("http://127.0.0.1:8000/api/broj-knjiga-po-kategoriji");
  }

  vratiBrojKupljenihKnjigaPoKategoriji(): Observable<any> {
    return this.http.get<any>("http://127.0.0.1:8000/api/broj-kupljenih-knjiga-po-kategoriji");
  }

  vratiProdajuTokomVremena(): Observable<any> {
    return this.http.get<any>(`http://127.0.0.1:8000/api/prodaja-tokom-vremena`);
  }

  kreirajKnjigu(knjiga: Knjiga): Observable<any> {
    console.log(knjiga);
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      }),
    }
    return this.http.post<any>(this.KNJIGA_URL, knjiga, httpOptions);
  }

  izmeniKnjigu(knjiga: Knjiga) {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      }),
    }
    return this.http.put<any>(this.KNJIGA_URL + knjiga.knjiga_id, knjiga, httpOptions);
  }

  obrisiKnjigu(knjigaId: any) {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      }),
    }
    return this.http.delete<any>(this.KNJIGA_URL + knjigaId, httpOptions);
  }

  dodajPdf(knjigaId: number, pdf_fajl: File): Observable<any> {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/pdf',
      }),
    };
    const formData = new FormData();
    formData.append('pdf_fajl', pdf_fajl);

    return this.http.post<any>(this.KNJIGA_URL + knjigaId + '/dodaj-pdf', formData, httpOptions);
  }

  vratiPdf(knjigaId: number): Observable<any> {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      }),
      responseType: 'blob' as 'json',
    };

    return this.http.get<any>(this.KNJIGA_URL + knjigaId + '/preuzmi-pdf', httpOptions);
  }

}
