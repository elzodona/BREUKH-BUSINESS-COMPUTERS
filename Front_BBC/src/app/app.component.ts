import { Component } from '@angular/core';
import { Router } from '@angular/router';

import { initFlowbite } from 'flowbite';


@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'Front_BBC';

  ngOnInit(): void {
    initFlowbite();
  }

  constructor(public router: Router) { }

  
}
