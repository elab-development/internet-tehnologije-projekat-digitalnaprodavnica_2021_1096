import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Autor } from '../models/autor.model';

@Injectable({
  providedIn: 'root'
})
export class AutorService {

  constructor(private http: HttpClient) { }

  private AUTOR_URL: string = 'http://127.0.0.1:8000/api/autori/';

  vratiSveAutore(): Observable<any> {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.http.get<any>(this.AUTOR_URL, httpOptions);
  }

  kreirajAutora(autor: Autor): Observable<any> {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.http.post<any>(this.AUTOR_URL, autor, httpOptions);
  }

  obrisiAutora(autorId: number): Observable<any> {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.http.delete<any>(this.AUTOR_URL + autorId, httpOptions);
  }

  izmeniAutora(autor: Autor): Observable<any> {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.http.put<any>(this.AUTOR_URL + autor.autor_id, autor, httpOptions);
  }
}
