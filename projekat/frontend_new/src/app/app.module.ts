import { MatTableModule } from '@angular/material/table';
import { MatInputModule } from '@angular/material/input';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatIconModule } from '@angular/material/icon';
import { LOCALE_ID, NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { AuthLoginComponent } from './components/auth/auth-login/auth-login.component';
import { AuthRegisterComponent } from './components/auth/auth-register/auth-register.component';
import { HeaderComponent } from './components/header/header.component';
import { HomeKnjigeComponent } from './components/home/home-knjige/home-knjige.component';
import { HomeDetaljiComponent } from './components/home/home-detalji/home-detalji.component';
import { MatToolbarModule } from '@angular/material/toolbar';
import { MatButtonModule } from '@angular/material/button';
import { MatCardModule } from '@angular/material/card';
import { HttpClientModule } from '@angular/common/http';
import { FlexLayoutModule } from '@angular/flex-layout';
import { MatSelectModule } from '@angular/material/select';
import { MatPaginatorModule } from '@angular/material/paginator';
import { KorpaComponent } from './components/korpa/korpa.component';
import { ProfilComponent } from './components/profil/profil.component';
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { DashboardKnjigeComponent } from './components/dashboard/dashboard-knjige/dashboard-knjige.component';
import { DashboardAutoriComponent } from './components/dashboard/dashboard-autori/dashboard-autori.component';
import { DashboardIzdavaciComponent } from './components/dashboard/dashboard-izdavaci/dashboard-izdavaci.component';
import { DashboardKorisniciComponent } from './components/dashboard/dashboard-korisnici/dashboard-korisnici.component';
import { MatMenuModule } from '@angular/material/menu';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { MatBadgeModule } from '@angular/material/badge';
import { NgxExtendedPdfViewerModule } from 'ngx-extended-pdf-viewer';
import { MatSnackBarModule } from '@angular/material/snack-bar';
import { MatListModule } from '@angular/material/list';
import { MatSidenavModule } from '@angular/material/sidenav';
import { CreateKorisnikComponent } from './components/dashboard/dashboard-korisnici/create-korisnik/create-korisnik.component';
import { CreateKnjigaComponent } from './components/dashboard/dashboard-knjige/create-knjiga/create-knjiga.component';
import { CreateAutorComponent } from './components/dashboard/dashboard-autori/create-autor/create-autor.component';
import { CreateIzdavacComponent } from './components/dashboard/dashboard-izdavaci/create-izdavac/create-izdavac.component';
import { MatDialogModule } from '@angular/material/dialog';
import { MatSortModule } from '@angular/material/sort';
import { EditKorisnikComponent } from './components/dashboard/dashboard-korisnici/edit-korisnik/edit-korisnik.component';

@NgModule({
  declarations: [
    AppComponent,
    AuthLoginComponent,
    AuthRegisterComponent,
    HeaderComponent,
    HomeKnjigeComponent,
    HomeDetaljiComponent,
    AuthLoginComponent,
    AuthRegisterComponent,
    KorpaComponent,
    ProfilComponent,
    DashboardComponent,
    DashboardKnjigeComponent,
    DashboardAutoriComponent,
    DashboardIzdavaciComponent,
    DashboardKorisniciComponent,
    CreateKorisnikComponent,
    CreateKnjigaComponent,
    CreateAutorComponent,
    CreateIzdavacComponent,
    EditKorisnikComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    MatToolbarModule,
    MatIconModule,
    MatButtonModule,
    MatCardModule,
    HttpClientModule,
    FlexLayoutModule,
    MatFormFieldModule,
    MatSelectModule,
    MatPaginatorModule,
    MatMenuModule,
    ReactiveFormsModule,
    MatInputModule,
    FormsModule,
    MatBadgeModule,
    NgxExtendedPdfViewerModule,
    MatSnackBarModule,
    MatListModule,
    MatSidenavModule,
    MatDialogModule,
    MatTableModule,
    MatSortModule,
  ],
  providers: [{
    provide: LOCALE_ID,
    useValue: 'fr'
  }],
  bootstrap: [AppComponent]
})
export class AppModule { }
