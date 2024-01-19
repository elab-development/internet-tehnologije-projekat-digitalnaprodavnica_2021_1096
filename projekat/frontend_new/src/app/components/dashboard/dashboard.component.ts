// dashboard.component.ts
import { Component } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent {

  constructor(private router: Router) { }

  isDashboardHomePage(): boolean {
    return this.router.url.startsWith('/dashboard/knjige') || this.router.url.startsWith('/dashboard/korisnici')
      || this.router.url.startsWith('/dashboard/autori') || this.router.url.startsWith('/dashboard/izdavaci')
  }
}
