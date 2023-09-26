import { Injectable } from '@angular/core';
import { CanActivate, Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth/auth.service';

@Injectable({
  providedIn: 'root'
})
export class AuthbGuard implements CanActivate {

  constructor(private auth: AuthService, private router: Router) { }

  canActivate(): boolean {
    const token = this.auth.getAccessToken();
    if (token) {
      this.router.navigateByUrl('/commande')
      return false;
    }
    return true;
  }
}
