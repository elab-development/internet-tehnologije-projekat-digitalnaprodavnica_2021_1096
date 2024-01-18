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
import { AuthZaboravljenaLozinkaComponent } from './components/auth/auth-zaboravljena-lozinka/auth-zaboravljena-lozinka.component';
import { AuthPromenaLozinkeComponent } from './components/auth/auth-promena-lozinke/auth-promena-lozinke.component';
import { EditIzdavacComponent } from './components/dashboard/dashboard-izdavaci/edit-izdavac/edit-izdavac.component';
import { EditAutorComponent } from './components/dashboard/dashboard-autori/edit-autor/edit-autor.component';
import { MAT_DATE_LOCALE, MatNativeDateModule } from '@angular/material/core';
import { MatDatepickerModule } from '@angular/material/datepicker';
import { DatePipe } from '@angular/common';
import { EditKnjigaComponent } from './components/dashboard/dashboard-knjige/edit-knjiga/edit-knjiga.component';
import { PlacanjeSuccessComponent } from './components/placanje-success/placanje-success.component';
import { PlacanjeCancelComponent } from './components/placanje-cancel/placanje-cancel.component';
import { MojeKnjigeComponent } from './components/moje-knjige/moje-knjige.component';
import { AddPdfComponent } from './components/dashboard/dashboard-knjige/add-pdf/add-pdf.component';
import { TruncateTextPipe } from './pipes/skrati-text.pipe';
import { PokreniAnimacijuDirective } from './directives/pokreni-animaciju.directive';
import { DashboardVizuelizacijaComponent } from './components/dashboard/dashboard-vizuelizacija/dashboard-vizuelizacija.component';

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
    AuthZaboravljenaLozinkaComponent,
    AuthPromenaLozinkeComponent,
    EditIzdavacComponent,
    EditAutorComponent,
    EditKnjigaComponent,
    PlacanjeSuccessComponent,
    PlacanjeCancelComponent,
    MojeKnjigeComponent,
    AddPdfComponent,
    DashboardVizuelizacijaComponent,
    TruncateTextPipe,
    PokreniAnimacijuDirective,
    DashboardVizuelizacijaComponent,
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
    MatNativeDateModule,
    MatDatepickerModule,
  ],
  providers: [{
    provide: LOCALE_ID,
    useValue: 'fr'
  },
  {
    provide: MAT_DATE_LOCALE,
    useValue: 'en-GB'
  },
    DatePipe],
  bootstrap: [AppComponent]
})
export class AppModule { }
