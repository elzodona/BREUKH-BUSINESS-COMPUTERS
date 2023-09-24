import { Component, ElementRef, EventEmitter, Output, ViewChild } from '@angular/core';
import { FormBuilder, FormArray, FormGroup, Validators, AbstractControl, ValidationErrors, ValidatorFn, FormControl } from '@angular/forms';
import { ProduitsService } from 'src/app/services/produit/produits.service';

@Component({
  selector: 'app-command',
  templateUrl: './command.component.html',
  styleUrls: ['./command.component.css']
})
export class CommandComponent {

  @ViewChild('authenticationModal') authenticationModal!: ElementRef;
  @Output() addCommand = new EventEmitter();

  commandForm!: FormGroup

  produit: any;
  reference!: string;
  imageSrc: any = 'https://images.unsplash.com/photo-1625895197185-efcec01cffe0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8ZGVtb24lMjBzbGF5ZXJ8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60';
  libelle: string = 'Name product'
  code: string = ''
  lib: string = ''
  qte: number = 0
  valeur: string = ''
  succ_prod_id = ''
  unite: string = ''
  description: string = ''
  display: boolean = true
  caracts: any;
  unites: any;
  disabled= true;
  mein: boolean = true;
  succs: any;
  succ: boolean = false;
  hop: number = 0;
  succ_name: string = ''
  

  constructor(private prodService: ProduitsService, private fb: FormBuilder)
  {
    this.commandForm = this.fb.group({
      'lib': ['', [Validators.required, Validators.pattern(/^[0-9]*$/)]],
      'qte': ['', [Validators.required, Validators.pattern(/^[0-9]*$/), this.checkQuantity.bind(this)]],
      'succ_prod': ['']
    });
  }
  
  ngOnInit(){
    // this.getp();
    // this.searchProd();   
    
  }

  onInputChange() {
    if (this.reference === '') {
      this.clearFields();
      return;
    }

    this.imageSrc = 'assets/designecologist-Pmh0UoG1vlE-unsplash.jpg';

    this.prodService.allUnite().subscribe(res => {
      this.unites = res;

      this.prodService.searchPrix(this.reference).subscribe(res => {
        this.produit = res.produit;
        this.display = !!this.produit;
        
          if (this.produit) {
            if (!res.amis) {
            this.succ = false;
            this.mein = true;
            this.disabled = false;
              this.imageSrc = 'http://localhost:8000/storage/' + this.produit.photo;
            this.libelle = this.produit.libelle;
            this.code = this.produit.code;
            this.description = this.produit.caracteristiques[0].pivot.description;
            this.caracts = this.produit.caracteristiques;
            this.succ_prod_id = this.produit.succursale[0].pivot.id;
            this.qte = this.produit.succursale[0].pivot.quantite;
            } else {
              // alert("Vous n'avez plus de stock disponible pour ce produit");
              this.succ = true;
              this.mein = false;
              this.disabled = false;
              this.imageSrc = 'http://localhost:8000/storage/' +  this.produit.photo;
              this.libelle = this.produit.libelle;
              this.code = this.produit.code;
              this.description = this.produit.caracteristiques[0].pivot.description;
              this.caracts = this.produit.caracteristiques;
              this.succs = res.amis;
              this.succ_prod_id = "no";
              // console.log(this.succs);
              
            }
          } else {
            this.clearFields();
          }
      });
    });
  }

  clearFields() {
    this.disabled = true;
    this.display = false;
    this.libelle = '';
    this.code = '';
    this.caracts = [];
    this.description = '';
  }

  checkQuantity(control: AbstractControl): ValidationErrors | null {
    const enteredQuantity = parseInt(control.value, 10);
    const remainingQuantity = this.qte; 
    
    if (enteredQuantity == 0 || enteredQuantity > remainingQuantity) {
      return { quantityExceeded: true };
    }
 
    return null;
  }

  getLibUnit(uniteId: number) {
    const unite = this.unites.find((u: any) => u.id === uniteId);
    return unite ? unite.libelle : '';
  }

  getp() {
    this.prodService.getProd().subscribe(res => {
      // console.log(res);

    })
  }

  addLineCommand()
  {
    //console.log(this.commandForm.value);
    const data = this.commandForm.value;
    this.addCommand.emit(data);
  }

  resetForm() {
    this.commandForm.reset();
  }

  openModal(data: any, succ_prod: number, name: string) {
    this.qte = data;
    this.hop = succ_prod;
    this.succ_name = name;
    const modalElement = this.authenticationModal.nativeElement;
    modalElement.classList.remove('hidden');
    modalElement.setAttribute('aria-hidden', 'false');
  }


}

