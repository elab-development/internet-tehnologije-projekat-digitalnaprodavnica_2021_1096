import { Component } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {

  constructor(private route: Router) { }

  isAuthPage(): boolean {
    return this.route.url.startsWith('/login') || this.route.url.startsWith('/register') || this.route.url.startsWith('/zaboravljena-lozinka') || this.route.url.startsWith('/promena-lozinke');
  }

  isDashboardPage(): boolean {
    return this.route.url.startsWith('/dashboard');
  }

}
