import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AutorService {

  constructor(private http: HttpClient) { }


  vratiSveAutore(): Observable<any> {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.http.get<any>("http://127.0.0.1:8000/api/autori", httpOptions);
  }

  kreirajAutora(podaci: any): Observable<any> {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.http.post<any>("http://127.0.0.1:8000/api/autori", podaci, httpOptions);
  }

  obrisiAutora(autorId: number): Observable<any> {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.http.delete<any>(`http://127.0.0.1:8000/api/autori/${autorId}`, httpOptions);
  }

  izmeniAutora(podaci: any): Observable<any> {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.http.put<any>(`http://127.0.0.1:8000/api/autori/${podaci.autor_id}`, podaci, httpOptions);
  }
}
