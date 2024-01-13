import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeKnjigeComponent } from './components/home/home-knjige/home-knjige.component';
import { AuthLoginComponent } from './components/auth/auth-login/auth-login.component';
import { AuthRegisterComponent } from './components/auth/auth-register/auth-register.component';
import { KorpaComponent } from './components/korpa/korpa.component';
import { ProfilComponent } from './components/profil/profil.component';
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { DashboardKnjigeComponent } from './components/dashboard/dashboard-knjige/dashboard-knjige.component';
import { DashboardAutoriComponent } from './components/dashboard/dashboard-autori/dashboard-autori.component';
import { DashboardIzdavaciComponent } from './components/dashboard/dashboard-izdavaci/dashboard-izdavaci.component';
import { DashboardKorisniciComponent } from './components/dashboard/dashboard-korisnici/dashboard-korisnici.component';
import { HomeDetaljiComponent } from './components/home/home-detalji/home-detalji.component';

const routes: Routes = [
  { path: '', component: HomeKnjigeComponent },
  { path: 'login', component: AuthLoginComponent },
  { path: 'register', component: AuthRegisterComponent },
  { path: 'korpa', component: KorpaComponent },
  { path: 'profil', component: ProfilComponent },
  { path: 'detalji/:id', component: HomeDetaljiComponent },
  {
    path: 'dashboard',
    component: DashboardComponent,
    children: [
      { path: 'knjige', component: DashboardKnjigeComponent },
      { path: 'autori', component: DashboardAutoriComponent },
      { path: 'izdavaci', component: DashboardIzdavaciComponent },
      { path: 'korisnici', component: DashboardKorisniciComponent },
    ]
  },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
