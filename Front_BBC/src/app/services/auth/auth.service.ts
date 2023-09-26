import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';


@Injectable({
  providedIn: 'root'
})

export class AuthService {

  public isLoggedIn = false;

  constructor(private breukh: HttpClient) {
  }

  login(data: any): Observable<any> {
    this.isLoggedIn = true;
    return this.breukh.post('http://127.0.0.1:8000/api/auth/Utilisateur', data);
  }

  logout(): void {
    this.isLoggedIn = false;
    localStorage.removeItem('token');
    localStorage.removeItem('user');
  }

  setAccessToken(token: string) {
    localStorage.setItem('token', token);
  }

  getAccessToken(): string | null {
    return localStorage.getItem('token');
  }

  get isAuthenticated() {
    return this.isLoggedIn;
  }


}
