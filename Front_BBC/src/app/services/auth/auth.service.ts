import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';


@Injectable({
  providedIn: 'root'
})

export class AuthService {

  constructor(private breukh: HttpClient) {
  }

  login(data: any): Observable<any> {
    return this.breukh.post('http://127.0.0.1:8000/api/auth/Utilisateur', data);
  }

  logout(data: any) {
    localStorage.removeItem('token');
    localStorage.removeItem('user');
    return this.breukh.post('http://127.0.0.1:8000/api/auth/logout/user', data);
  }

  setAccessToken(token: string) {
    localStorage.setItem('token', token);
  }

  getAccessToken(): string | null {
    return localStorage.getItem('token');
  }


}
