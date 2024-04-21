import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor(private http: HttpClient) { }

  private AUTH_URL: string = "http://127.0.0.1:8000/api/auth/";
  private AUTH_URL_LOGIN: string = this.AUTH_URL + "login";
  private AUTH_URL_REGISTER: string = this.AUTH_URL + "register";
  private AUTH_URL_LOGOUT: string = this.AUTH_URL + "logout";
  private AUTH_URL_PROMENA_LOZINKE: string = this.AUTH_URL + "promena-lozinke";
  private AUTH_URL_ZABORAVLJENA_LOZINKA: string = this.AUTH_URL + "zaboravljena-lozinka";

  login(podaci: any): Observable<any> {
    return this.http.post<any>(this.AUTH_URL_LOGIN, podaci);
  }

  logout(): Observable<any> {
    const token = localStorage.getItem('token');
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${token}`,
      })
    }
    return this.http.post<any>(this.AUTH_URL_LOGOUT, null, httpOptions);
  }

  register(podaci: any) {
    return this.http.post<any>(this.AUTH_URL_REGISTER, podaci);
  }

  posaljiMejl(email: string) {
    const formData = new FormData();
    formData.append('email', email);
    return this.http.post<any>(this.AUTH_URL_ZABORAVLJENA_LOZINKA, formData);
  }

  resetujLozinku(password: string) {
    const token = localStorage.getItem('reset-password-token');
    const formData = new FormData();
    formData.append('password', password);
    return this.http.post<any>(this.AUTH_URL_PROMENA_LOZINKE + '/' + token, formData);
  }
}
