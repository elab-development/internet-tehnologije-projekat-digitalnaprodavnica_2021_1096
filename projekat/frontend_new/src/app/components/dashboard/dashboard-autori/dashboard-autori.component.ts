import { AfterViewInit, Component, OnInit, ViewChild } from '@angular/core';
import { MatDialog } from '@angular/material/dialog';
import { MatPaginator } from '@angular/material/paginator';
import { MatSnackBar } from '@angular/material/snack-bar';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { AutorService } from 'src/app/services/autor.service';
import { CreateAutorComponent } from './create-autor/create-autor.component';
import { EditAutorComponent } from './edit-autor/edit-autor.component';

@Component({
  selector: 'app-dashboard-autori',
  templateUrl: './dashboard-autori.component.html',
  styleUrls: ['./dashboard-autori.component.scss']
})
export class DashboardAutoriComponent implements OnInit, AfterViewInit {

  kolone: string[] = [
    'autor_id',
    'ime',
    'prezime',
    'datum_rodjenja',
    'mesto_rodjenja',
    'biografija',
    'akcije',
  ]

  dataSource!: MatTableDataSource<any>;

  @ViewChild(MatPaginator) paginator!: MatPaginator;
  @ViewChild(MatSort) sort!: MatSort;

  constructor(private autorService: AutorService, private dialog: MatDialog, private snackBar: MatSnackBar) { }

  ngOnInit(): void {
    this.vratiSveAutore();
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

  vratiSveAutore() {
    this.autorService.vratiSveAutore().subscribe({
      next: (response) => {
        console.log(response);
        this.dataSource = new MatTableDataSource(response.autori);
        this.dataSource.paginator = this.paginator;
        this.dataSource.sort = this.sort;
      }
    })
  }

  obrisiAutora(autorId: number) {
    this.autorService.obrisiAutora(autorId).subscribe({
      next: (response) => {
        console.log(response);
        this.snackBar.open(response.status, 'Zatvori', {
          duration: 3000,
          horizontalPosition: 'center',
          verticalPosition: 'bottom',
        });
        this.vratiSveAutore();
      }
    })
  }

  openCreateAutorDialog() {
    const dialogRef = this.dialog.open(CreateAutorComponent);
    dialogRef.afterClosed().subscribe({
      next: (val) => {
        if (val) {
          this.vratiSveAutore();
        }
      }
    })
  }

  openEditAutorDialog(podaci: any) {
    this.dialog.open(EditAutorComponent, {
      data: podaci,
    })
  }

}
