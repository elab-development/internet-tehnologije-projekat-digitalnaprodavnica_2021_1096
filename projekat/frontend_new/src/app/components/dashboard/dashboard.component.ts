import { Component } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent {

  constructor(private router: Router) { }

  private DASHBOARD_URL: string = '/dashboard/';

  isDashboardHomePage(): boolean {
    return this.router.url.startsWith(this.DASHBOARD_URL);
  }
}
