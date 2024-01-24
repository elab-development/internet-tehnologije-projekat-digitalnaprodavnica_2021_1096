import { Component, OnInit } from '@angular/core';
import * as Highcharts from 'highcharts';
import { KnjigaService } from 'src/app/services/knjiga.service';

interface KnjigaPoKategoriji {
  kategorija: string;
  broj_knjiga: number;
}

@Component({
  selector: 'app-pie-chart-kupljene-knjige-po-kategoriji',
  templateUrl: './pie-chart-kupljene-knjige-po-kategoriji.component.html',
  styleUrls: ['./pie-chart-kupljene-knjige-po-kategoriji.component.scss']
})
export class PieChartKupljeneKnjigePoKategorijiComponent implements OnInit {
  Highcharts: typeof Highcharts = Highcharts;
  updateFlag = false;

  data = [];

  constructor(private knjigaService: KnjigaService) { }

  ngOnInit(): void {
    this.vratiBrojKupljenihKnjigaPoKategoriji();
  }

  vratiBrojKupljenihKnjigaPoKategoriji() {
    this.knjigaService.vratiBrojKupljenihKnjigaPoKategoriji().subscribe({
      next: (response) => {
        if (response && response.length > 0) {
          this.data = response[0].map((item: KnjigaPoKategoriji) => ({
            name: item.kategorija,
            y: item.broj_knjiga,
          }));
          this.updateFlag = true;
          this.chartOptions = {
            title: { text: 'Broj kupljenih knjiga po kategoriji' },
            series: [
              {
                type: 'pie',
                data: this.data,
              },
            ],
          };
        }
      }, error: console.log,
    });
  }

  chartOptions: Highcharts.Options = {
    series: [
      {
        type: 'pie',
        data: this.data,
      },
    ],
  };
}
