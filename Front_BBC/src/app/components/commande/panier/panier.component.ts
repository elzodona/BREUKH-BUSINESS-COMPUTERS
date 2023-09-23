import { Component } from '@angular/core';
import { AbstractControl, FormArray, FormBuilder, FormGroup, FormsModule, ValidationErrors, Validators } from '@angular/forms';
import { ProduitsService } from 'src/app/services/produit/produits.service';

@Component({
  selector: 'app-panier',
  templateUrl: './panier.component.html',
  styleUrls: ['./panier.component.css']
})

export class PanierComponent {

  panierForm!: FormGroup;
  reduceForm!: FormGroup;

  totalQte: number = 0;
  rendu: number = 0;
  mtn: number = 0;


  constructor(private fb: FormBuilder, private prodService: ProduitsService) {
    
    this.reduceForm = this.fb.group({
      reduce: ['', [Validators.pattern(/^[0-9]*$/), this.Reduce.bind(this)]],
      total: ['']
    });
    
    this.reduceForm.get('reduce')?.valueChanges.subscribe((value) => {
      const currentTotal = this.reduceForm.get('total')?.value;
      // console.log(value);
      
      if (value == null || value == 0) {
        this.reduceForm.patchValue({
          total: this.totalQte
        });
        
      }else{
          const totalValue = (currentTotal * value) / 100;
          this.reduceForm.patchValue({
            total: totalValue
          });

          // this.saveReduceToLocalStorage()
      }
      
    });



    this.panierForm = this.fb.group({
      panier: this.fb.array([])
    });

    this.panier.valueChanges.subscribe((pan) => {
      pan.forEach((item: any) => {
        item.total = +item.prix * +item.quantite
      });
      // console.log(pan);
      const quantites = pan.map((item: any) => item.total);
      this.totalQte = quantites.reduce((acc: any, curr: any) => +acc + +curr, 0);

      this.reduceForm.patchValue({
        total: this.totalQte
      })

      this.savePanierToLocalStorage();
    });

  }

  ngOnInit() {
    
    const storedPanier = localStorage.getItem('panier');
    // console.log(storedPanier);
    
    if (storedPanier) {
      const parsedPanier = JSON.parse(storedPanier);
      parsedPanier.forEach((item: any) => {
        this.panier.push(this.fb.group({
          succ_prod_id: item.succ_prod_id,
          libelle: item.libelle,
          prix: item.prix,
          quantite: item.quantite,
          total: item.total
        }));
      });
    }

    // const storeReduce = localStorage.getItem('reduce');
    
    // if (storeReduce) {
    //   const parsedReduce = JSON.parse(storeReduce);
    //   console.log(parsedReduce);
    //   // console.log(this.reduceForm.value);
    //   this.reduceForm.patchValue({
    //     reduce: parsedReduce.reduce,
    //     total: parsedReduce.total
    //   })
    // }

  }

  Reduce(control: AbstractControl): ValidationErrors | null {
    const remise = parseInt(control.value, 10);

    if (remise > 100) {
      return { reduceExceeded: true };
    }

    return null;
  }

  savePanierToLocalStorage() {
    localStorage.setItem('panier', JSON.stringify(this.panier.value));
  }

  saveReduceToLocalStorage() {
    localStorage.setItem('reduce', JSON.stringify(this.reduceForm.value));
  }

  get panier(): FormArray {
    return this.panierForm.get('panier') as FormArray;
  }

  addPanier() {
    this.panier.push(this.fb.group({
      succ_prod_id: null,
      libelle: null,
      prix: null,
      quantite: null,
      total: null,
    }));

  }

  supprimerElement(index: number) {
    this.panier.removeAt(index);
  }

  sendComm()
  {
    this.mtn = 0;
    this.rendu = 0;
    const data = this.panier.value
    // console.log(data);
    if (data.length > 0) {
      this.prodService.addComm(data).subscribe(res => {
        alert(res.message);
      })

      localStorage.removeItem('panier');
      // localStorage.removeItem('reduce');
      this.panier.clear();
    }
  }

  recupVal()
  {
    // console.log(this.mtn);
    this.rendu = this.reduceForm.get('total')?.value - this.mtn
    
  }



}

