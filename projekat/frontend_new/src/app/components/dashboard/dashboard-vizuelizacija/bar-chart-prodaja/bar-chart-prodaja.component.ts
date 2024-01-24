import { Component, OnInit } from '@angular/core';
import * as Highcharts from 'highcharts/highstock';
import { KnjigaService } from 'src/app/services/knjiga.service';

interface ProdajaTokomVremena {
  mesec: number;
  broj_prodatih_knjiga: number;
}

@Component({
  selector: 'app-bar-chart-prodaja',
  templateUrl: './bar-chart-prodaja.component.html',
  styleUrls: ['./bar-chart-prodaja.component.scss']
})
export class BarChartProdajaComponent implements OnInit {

  Highcharts: typeof Highcharts = Highcharts;
  updateFlag = false;

  data = [];

  constructor(private knjigaService: KnjigaService) { }

  ngOnInit(): void {
    this.vratiProdajuTokomVremena();
  }

  vratiProdajuTokomVremena() {
    this.knjigaService.vratiProdajuTokomVremena().subscribe({
      next: (response) => {
        if (response && response.prodaja_po_mesecima.length > 0) {
          this.data = response.prodaja_po_mesecima;
          this.updateFlag = true;
          this.chartOptions = {
            title: { text: 'Prodaja po mesecima' },
            xAxis: {
              categories: this.data.map((item: ProdajaTokomVremena) => `${item.mesec}. Mesec`)
            },
            yAxis: {
              title: { text: 'Broj prodatih knjiga' }
            },
            series: [{
              type: 'column',
              data: this.data.map((item: ProdajaTokomVremena) => item.broj_prodatih_knjiga)
            }],
          };
        }
      }, error: console.log,
    });
  }

  chartOptions: Highcharts.Options = {
    series: [
      {
        type: 'column',
        data: [],
      },
    ],
  };

}
