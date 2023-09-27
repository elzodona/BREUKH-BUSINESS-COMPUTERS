import { Component } from '@angular/core';
import { SharedBoolService } from 'src/app/services/other-fonctionnality/shared-bool-service/shared-bool.service';
import { ProduitsService } from 'src/app/services/produit/produits.service';

@Component({
  selector: 'app-list-produits',
  templateUrl: './list-produits.component.html',
  styleUrls: ['./list-produits.component.css']
})
export class ListProduitsComponent {

  produits: any
  links: any
  num: number = 0
  page: number = 4
  succId: number = 1

  ngOnInit()
  {
    this.allProduit()
  }

  constructor(private prodService: ProduitsService, private sharedService: SharedBoolService){
    const succ = localStorage.getItem('user');
    if (succ) {
      const succs = JSON.parse(succ);
      this.succId = succs.succursale.id
    }
  }

  toPaginate(url: string) {
    if (url) {
      this.prodService.allProduit(url, this.page).subscribe((res) => {
        this.produits = res.data.produits;
        this.links = res.data.link;
        console.log(this.produits);
        
      });
    } else {
      this.sharedService.setEditMode(true);
    }
  }

  onPerPageChange(event: Event) {
    const selectElement = event.target as HTMLSelectElement;
    const selectedValue = parseInt(selectElement.value, 10);
    this.page = selectedValue
    // console.log(this.page);

    this.prodService.allProduit(undefined, this.page).subscribe((res) => {
      this.produits = res.data.produits;
      this.links = res.data.link;
    });
  }

  allProduit()
  {
    this.prodService.allProduit().subscribe(res=>{
      // console.log(res);
      this.produits = res.data.produits
      this.links = res.data.link;
      this.num = res.numProd
      // console.log(this.produits);
    })
  }

}
