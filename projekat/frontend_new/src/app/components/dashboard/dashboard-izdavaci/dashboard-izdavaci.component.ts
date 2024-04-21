import { MatDialog } from '@angular/material/dialog';
import { AfterViewInit, Component, OnInit, ViewChild } from '@angular/core';
import { MatTableDataSource } from '@angular/material/table';
import { MatPaginator } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { KorisnikService } from 'src/app/services/korisnik.service';
import { MatSnackBar } from '@angular/material/snack-bar';
import { IzdavacService } from 'src/app/services/izdavac.service';
import { CreateIzdavacComponent } from './create-izdavac/create-izdavac.component';
import { EditIzdavacComponent } from './edit-izdavac/edit-izdavac.component';
import { Izdavac } from 'src/app/models/izdavac.model';

@Component({
  selector: 'app-dashboard-izdavaci',
  templateUrl: './dashboard-izdavaci.component.html',
  styleUrls: ['./dashboard-izdavaci.component.scss']
})
export class DashboardIzdavaciComponent {
  kolone: string[] = [
    'izdavac_id',
    'naziv',
    'adresa',
    'akcije',
  ];

  dataSource!: MatTableDataSource<Izdavac>;

  @ViewChild(MatPaginator) paginator!: MatPaginator;
  @ViewChild(MatSort) sort!: MatSort;


  constructor(private dialog: MatDialog, private izdavacService: IzdavacService, private snackBar: MatSnackBar) { }

  ngOnInit(): void {
    this.vratiSveIzdavace();
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

  vratiSveIzdavace() {
    this.izdavacService.vratiSveIzdavace().subscribe({
      next: (response) => {
        console.log(response);
        this.dataSource = new MatTableDataSource(response.izdavaci);
        this.dataSource.paginator = this.paginator;
        this.dataSource.sort = this.sort;
      },
      error: console.log,
    })
  }

  obrisiIzdavaca(izdavac_id: number) {
    this.izdavacService.obrisiIzdavaca(izdavac_id).subscribe({
      next: (response) => {
        console.log(response);
        this.snackBar.open(response.status, 'Zatvori', {
          duration: 3000,
          horizontalPosition: 'center',
          verticalPosition: 'bottom',
        });
        this.vratiSveIzdavace();
      }
    })
  }

  openCreateIzdavacDialog() {
    const dialogRef = this.dialog.open(CreateIzdavacComponent);
    dialogRef.afterClosed().subscribe({
      next: (val) => {
        if (val) {
          this.vratiSveIzdavace();
        }
      }
    })
  }

  openEditIzdavacDialog(izdavac: Izdavac) {
    this.dialog.open(EditIzdavacComponent, {
      data: { izdavac: izdavac }
    });
  }
}
