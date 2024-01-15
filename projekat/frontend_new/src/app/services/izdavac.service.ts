import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class IzdavacService {

  constructor(private httpClient: HttpClient) { }

  vratiSveIzdavace(): Observable<any> {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.httpClient.get<any>("http://127.0.0.1:8000/api/izdavaci", httpOptions);
  }

  kreirajIzdavaca(podaci: any): Observable<any> {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.httpClient.post<any>("http://127.0.0.1:8000/api/izdavaci", podaci, httpOptions);
  }

  izmeniIzdavaca(podaci: any): Observable<any> {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.httpClient.put<any>(`http://127.0.0.1:8000/api/izdavaci/${podaci.izdavac_id}`, podaci, httpOptions);
  }

  obrisiIzdavaca(izdavacId: number) {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.httpClient.delete<any>(`http://127.0.0.1:8000/api/izdavaci/${izdavacId}`, httpOptions);
  }
}
