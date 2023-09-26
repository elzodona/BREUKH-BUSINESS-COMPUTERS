import { Component } from '@angular/core';
import { AuthService } from 'src/app/services/auth/auth.service';
import { Router } from '@angular/router';


@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent {

  username: string = 'Breukh'
  user: any
  succursaleName: string = ''

  constructor(private auth: AuthService, private router: Router){
    const userString = localStorage.getItem('user');
    if (userString) {
      this.user = JSON.parse(userString);
      console.log(this.user);
      this.username = this.user.nomComplet;
      this.succursaleName = this.user.succursale.nom;
    }
    
  }

  logout()
  {
    this.auth.logout();
    this.router.navigateByUrl('/login');
  }


}
