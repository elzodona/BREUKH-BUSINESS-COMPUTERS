import { Component } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { AuthService } from 'src/app/services/auth/auth.service';
import { Router } from '@angular/router';


@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {

  loginForm!: FormGroup;
  
  ngOnInit() {

  }

  constructor(private fb: FormBuilder, private auth: AuthService, private router: Router)
  {
    this.loginForm = fb.group({
      login: ['kadia'],
      password: ['kadia']
    })
  }

  login()
  {
    const data = this.loginForm.value;
    // console.log(data);
    this.auth.login(data).subscribe(res => {
      console.log(res);
      if (res.status) {
        this.auth.setAccessToken(res.token);
        this.router.navigateByUrl('/produit');
      }else{
        this.router.navigateByUrl('/login');
      }
    })
  }


}
