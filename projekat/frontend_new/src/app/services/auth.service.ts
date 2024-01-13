import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor(private http: HttpClient) { }

  login(podaci: any): Observable<any> {
    return this.http.post<any>("http://127.0.0.1:8000/api/auth/login", podaci);
  }

  logout(): Observable<any> {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/pdf',
      })
    }
    return this.http.post<any>("http://127.0.0.1:8000/api/auth/logout", null, httpOptions);
  }

  register(podaci: any) {
    return this.http.post<any>("http://127.0.0.1:8000/api/auth/logout", podaci);
  }

  create(podaci: any) {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.http.post<any>("http://127.0.0.1:8000/api/korisnici", podaci, httpOptions);
  }

  izmeni(podaci: any) {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.http.put<any>(`http://127.0.0.1:8000/api/korisnici/${podaci.korisnik_id}`, podaci, httpOptions);
  }
}
