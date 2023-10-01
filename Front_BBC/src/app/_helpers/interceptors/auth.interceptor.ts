import { Injectable, inject } from '@angular/core';
import { HttpRequest, HttpHandler, HttpEvent, HttpInterceptor } from '@angular/common/http';
import { Observable } from 'rxjs';
import { AuthService } from 'src/app/services/auth/auth.service';


@Injectable()
export class AuthInterceptor implements HttpInterceptor {

  constructor() {}

  intercept( req: HttpRequest<any>, next: HttpHandler ): Observable<HttpEvent<any>> 
  {
    const service = inject(AuthService);
    const token = service.getAccessToken();

    const authReq = req.clone({
      setHeaders: {
        Authorization: `Bearer ${token}`
      }
    });

    return next.handle(authReq);
  }


}
