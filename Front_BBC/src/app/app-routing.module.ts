import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CommandeComponent } from './components/commande/commande.component';
import { ProduitsComponent } from './components/produits/produits.component';
import { TabBordComponent } from './components/tab-bord/tab-bord.component'; 
import { AccueilComponent } from './components/accueil/accueil.component';
import { ListProduitsComponent } from './components/produits/list-produits/list-produits.component';
import { LoginComponent } from './components/login/login.component';
import { RegisterComponent } from './components/register/register.component';
import { AuthGuard } from './guards/canActivated/auth.guard';

const routes: Routes = [
  { path: '', component: LoginComponent },
  { path: 'login', component: LoginComponent },
  { path: 'register', component: RegisterComponent },
  { path: 'home', component: AccueilComponent, canActivate: [AuthGuard] },
  { path: 'commande', component: CommandeComponent, canActivate: [AuthGuard] },
  { path: 'produit', component: ProduitsComponent, canActivate: [AuthGuard] },
  { path: 'tabBord', component: TabBordComponent, canActivate: [AuthGuard] },
  { path: 'addProd', component: ListProduitsComponent, canActivate: [AuthGuard] }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
