import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { AuthService } from '../auth/auth.service';

@Injectable({
  providedIn: 'root'
})

export class ProduitsService {

  user: any
  succId: any

  constructor(private breukh: HttpClient, private auth: AuthService) {
    const userString = localStorage.getItem('user');
    if (userString) {
      this.user = JSON.parse(userString);
      this.succId = this.user.succursale.id;
    }
  }

  searchPrix(code: string): Observable<any> {
    return this.breukh.get<any>(`http://127.0.0.1:8000/api/search/1/${code}`);
  }

  getProd(): Observable<any> {
    return this.breukh.get('http://127.0.0.1:8000/api/prod');
  }

  allUnite(): Observable<any> {
    return this.breukh.get('http://127.0.0.1:8000/api/unite');
  }

  allCaract(): Observable<any> {
    return this.breukh.get('http://127.0.0.1:8000/api/caract');
  }

  allMarque(): Observable<any> {
    return this.breukh.get('http://127.0.0.1:8000/api/marque');
  }

  allCategorie(): Observable<any> {
    return this.breukh.get('http://127.0.0.1:8000/api/categorie');
  }

  allProduit(url: string = `http://127.0.0.1:8000/api/allprod/succ/${this.succId}`, per_page: number = 4): Observable<any> {
    const params = { per_page };
    return this.breukh.post(url, params);
  }

  addComm(data: any): Observable<any> {
    const headers = new HttpHeaders({
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${this.auth.getAccessToken()}`
    });

    return this.breukh.post('http://127.0.0.1:8000/api/comm', data, { headers });
  }

  addProd(data: any): Observable<any> {
    const headers = new HttpHeaders({
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${this.auth.getAccessToken()}`
    });

    return this.breukh.post('http://127.0.0.1:8000/api/prod', data, { headers });
  }



}

