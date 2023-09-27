import { inject } from '@angular/core';
import { CanActivateFn, Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth/auth.service';


export const caFnGuard: CanActivateFn = (route, state) => {
  
  const router = inject(Router);
  const service = inject(AuthService);
  const token = service.getAccessToken();

  if (token) {
    router.navigateByUrl('/commande')
    return false;

  } else {
    return true;
  }

};

