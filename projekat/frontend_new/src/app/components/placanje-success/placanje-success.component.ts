import { Component, OnInit } from '@angular/core';
import { PlacanjeService } from 'src/app/services/placanje.service';

@Component({
  selector: 'app-placanje-success',
  templateUrl: './placanje-success.component.html',
  styleUrls: ['./placanje-success.component.scss']
})
export class PlacanjeSuccessComponent implements OnInit {

  constructor(private placanjeService: PlacanjeService) { }

  ngOnInit(): void {
    this.success();
  }

  success() {
    this.placanjeService.success().subscribe({
      next: (response) => {
        console.log(response);
      },
      error: console.log,
    })
  }

}
