import { Component, ViewChild } from '@angular/core';
import { PanierComponent } from './panier/panier.component';
import { FormArray, FormBuilder } from '@angular/forms';
import { CommandComponent } from './command/command.component';

@Component({
  selector: 'app-commande',
  templateUrl: './commande.component.html',
  styleUrls: ['./commande.component.css']
})
export class CommandeComponent {

  @ViewChild(PanierComponent) panierComponent!: PanierComponent;
  @ViewChild(CommandComponent) commandComponent!: CommandComponent;


  ngOnInit(): void {
    // this.addComm();
  }

  constructor(private fb: FormBuilder){}
  
  addComm(data: any) {
    // console.log(data);
    
    if (this.commandComponent.libelle !== 'Name product') {
      const succ_prod_id = this.commandComponent.succ_prod_id;

      if ((!this.verify(this.panierComponent.panier, succ_prod_id)) && (!this.verify(this.panierComponent.panier, data.succ_prod))) 
      {
        const panier = this.fb.group({
          succ_prod_id: (succ_prod_id == 'no') ? data.succ_prod : succ_prod_id,
          libelle: this.commandComponent.libelle,
          prix: data.lib,
          quantite: data.qte,
          total: data.lib * data.qte,
        });
        //console.log(panier.value);
        
        this.panierComponent.panier.push(panier);
      } else {
        alert('Ce produit a déjà été ajouté! Veuillez réajuster sa quantité directement');
      }
    }
  }

  verify(control: FormArray, succProdId: any): boolean {
    return control.controls.some(control =>
      control.get('succ_prod_id')?.value === succProdId
    );
  }


}
