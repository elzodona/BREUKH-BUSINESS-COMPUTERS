import { Component } from '@angular/core';

@Component({
  selector: 'app-produits',
  templateUrl: './produits.component.html',
  styleUrls: ['./produits.component.css']
})

export class ProduitsComponent {

  childToShow: string = '';

  showChild1() {
    this.childToShow = 'child1';
  }

  showChild2() {
    this.childToShow = 'child2';
  }

}

