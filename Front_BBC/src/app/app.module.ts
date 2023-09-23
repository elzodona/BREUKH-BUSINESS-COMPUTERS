import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { NavbarComponent } from './components/navbar/navbar/navbar.component';
import { CommandeComponent } from './components/commande/commande.component';
import { ProduitsComponent } from './components/produits/produits.component';
import { TabBordComponent } from './components/tab-bord/tab-bord.component';
import { AccueilComponent } from './components/accueil/accueil.component';
import { PanierComponent } from './components/commande/panier/panier.component';
import { CommandComponent } from './components/commande/command/command.component';
import { ProduitsService } from './services/produit/produits.service';
import { AjoutProduitsComponent } from './components/produits/ajout-produits/ajout-produits.component';
import { ListProduitsComponent } from './components/produits/list-produits/list-produits.component';

@NgModule({
  declarations: [
    AppComponent,
    NavbarComponent,
    CommandeComponent,
    ProduitsComponent,
    TabBordComponent,
    AccueilComponent,
    PanierComponent,
    CommandComponent,
    AjoutProduitsComponent,
    ListProduitsComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    ReactiveFormsModule,
    FormsModule
  ],
  providers: [ProduitsService],
  bootstrap: [AppComponent]
})
export class AppModule { }
