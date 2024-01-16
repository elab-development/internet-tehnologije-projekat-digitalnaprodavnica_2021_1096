import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class PlacanjeService {

  constructor(private http: HttpClient) { }

  inicirajPlacanje(): Observable<any> {
    const korisnikId = localStorage.getItem('korisnikID');
    const token = localStorage.getItem('token');

    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json',
      }),
      withCredentials: false,
    };

    return this.http.post<any>(`http://127.0.0.1:8000/api/${korisnikId}/placanje`, {}, httpOptions);
  }

  otvoriProzorZaPlacanje(): void {
    this.inicirajPlacanje().subscribe({
      next: (response) => {
        window.open(response.url, '_blank');
      },
      error: console.log,
    })
  }

  success(): Observable<any> {
    const korisnikId = localStorage.getItem('korisnikID');
    const token = localStorage.getItem('token');

    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      }),
    }
    return this.http.post<any>(`http://127.0.0.1:8000/api/${korisnikId}/success`, {}, httpOptions);
  }
}
