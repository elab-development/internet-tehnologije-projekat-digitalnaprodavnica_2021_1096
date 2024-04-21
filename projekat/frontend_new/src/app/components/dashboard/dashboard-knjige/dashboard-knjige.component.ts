import { AfterViewInit, Component, OnInit, ViewChild } from '@angular/core';
import { MatDialog } from '@angular/material/dialog';
import { MatPaginator } from '@angular/material/paginator';
import { MatSnackBar } from '@angular/material/snack-bar';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { KnjigaService } from 'src/app/services/knjiga.service';
import { EditKnjigaComponent } from './edit-knjiga/edit-knjiga.component';
import { CreateKnjigaComponent } from './create-knjiga/create-knjiga.component';
import { Knjiga } from 'src/app/models/knjiga.model';
import { AddPdfComponent } from './add-pdf/add-pdf.component';

@Component({
  selector: 'app-dashboard-knjige',
  templateUrl: './dashboard-knjige.component.html',
  styleUrls: ['./dashboard-knjige.component.scss']
})
export class DashboardKnjigeComponent implements OnInit, AfterViewInit {
  kolone: string[] = [
    'knjiga_id',
    'isbn',
    'naziv',
    'kategorija',
    'opis',
    'pismo',
    'godina',
    'strana',
    'cena',
    'izdavac_id',
    'akcije',
  ]

  dataSource!: MatTableDataSource<Knjiga>;

  @ViewChild(MatPaginator) paginator!: MatPaginator;
  @ViewChild(MatSort) sort!: MatSort;

  constructor(private dialog: MatDialog, private knjigaService: KnjigaService, private snackBar: MatSnackBar) { }

  ngOnInit(): void {
    this.vratiSveKnjige();
  }

  ngAfterViewInit(): void {
    if (this.dataSource) {
      this.dataSource.paginator = this.paginator;
      this.dataSource.sort = this.sort;
    }
  }

  applyFilter(event: Event) {
    const filterValue = (event.target as HTMLInputElement).value;
    this.dataSource.filter = filterValue.trim().toLowerCase();

    if (this.dataSource.paginator) {
      this.dataSource.paginator.firstPage();
    }
  }

  vratiSveKnjige() {
    this.knjigaService.vratiSveKnjige().subscribe({
      next: (response) => {
        console.log(response);
        this.dataSource = new MatTableDataSource(response.knjige);
        this.dataSource.paginator = this.paginator;
        this.dataSource.sort = this.sort;
      },
      error: console.log,
    })
  }

  openEditKnjigaDialog(knjiga: Knjiga) {
    const dialogRef = this.dialog.open(EditKnjigaComponent, {
      data: { knjiga: knjiga },
    })
    dialogRef.afterClosed().subscribe({
      next: (val) => {
        if (val) {
          this.vratiSveKnjige();
        }
      }
    })
  }

  openCreateKnjigaDialog() {
    const dialogRef = this.dialog.open(CreateKnjigaComponent);
    dialogRef.afterClosed().subscribe({
      next: (val) => {
        if (val) {
          this.vratiSveKnjige();
        }
      }
    })
  }

  obrisiKnjigu(knjigaId: number) {
    console.log(knjigaId);
    this.knjigaService.obrisiKnjigu(knjigaId).subscribe({
      next: (response) => {
        console.log(response);
        this.snackBar.open(response.status, 'Zatvori', {
          duration: 3000,
          horizontalPosition: 'center',
          verticalPosition: 'bottom',
        });
        this.vratiSveKnjige();
      }
    })
  }

  openAddPdfFileDialog(knjigaId: number) {
    const dialogRef = this.dialog.open(AddPdfComponent, {
      data: { knjigaId: knjigaId },
    })
    dialogRef.afterClosed().subscribe({
      next: (val) => {
        if (val) {
          this.vratiSveKnjige();
        }
      }
    })
  }

}
