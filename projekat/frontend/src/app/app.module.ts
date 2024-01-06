import { KnjigaListaComponent } from './components/knjiga-lista/knjiga-lista.component';
import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { KnjigaDetaljiComponent } from './components/knjiga-detalji/knjiga-detalji.component';
import { KorpaComponent } from './components/korpa/korpa.component';
import { KorisnikComponent } from './components/korisnik/korisnik.component';

@NgModule({
  declarations: [
    AppComponent,
    KnjigaListaComponent,
    KnjigaDetaljiComponent,
    KorpaComponent,
    KorisnikComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
