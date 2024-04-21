import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Izdavac } from '../models/izdavac.model';

@Injectable({
  providedIn: 'root'
})
export class IzdavacService {

  constructor(private httpClient: HttpClient) { }

  private IZDAVAC_URL: string = 'http://127.0.0.1:8000/api/izdavaci/';

  vratiSveIzdavace(): Observable<any> {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.httpClient.get<any>(this.IZDAVAC_URL, httpOptions);
  }

  kreirajIzdavaca(izdavac: Izdavac): Observable<any> {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.httpClient.post<any>(this.IZDAVAC_URL, izdavac, httpOptions);
  }

  izmeniIzdavaca(izdavac: Izdavac): Observable<any> {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.httpClient.put<any>(this.IZDAVAC_URL + izdavac.izdavac_id, izdavac, httpOptions);
  }

  obrisiIzdavaca(izdavacId: number) {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.httpClient.delete<any>(this.IZDAVAC_URL + izdavacId, httpOptions);
  }
}
