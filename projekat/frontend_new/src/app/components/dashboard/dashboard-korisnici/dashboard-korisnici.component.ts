import { MatDialog } from '@angular/material/dialog';
import { AfterViewInit, Component, OnInit, ViewChild } from '@angular/core';
import { CreateKorisnikComponent } from './create-korisnik/create-korisnik.component';
import { MatTableDataSource } from '@angular/material/table';
import { MatPaginator } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { KorisnikService } from 'src/app/services/korisnik.service';
import { MatSnackBar } from '@angular/material/snack-bar';
import { EditKorisnikComponent } from './edit-korisnik/edit-korisnik.component';

@Component({
  selector: 'app-dashboard-korisnici',
  templateUrl: './dashboard-korisnici.component.html',
  styleUrls: ['./dashboard-korisnici.component.scss']
})
export class DashboardKorisniciComponent implements OnInit, AfterViewInit {

  kolone: string[] = [
    'korisnik_id',
    'email',
    'username',
    'password',
    'ime',
    'prezime',
    'akcije',
  ];

  dataSource!: MatTableDataSource<any>;

  @ViewChild(MatPaginator) paginator!: MatPaginator;
  @ViewChild(MatSort) sort!: MatSort;


  constructor(private dialog: MatDialog, private korisnikService: KorisnikService, private snackBar: MatSnackBar) { }

  ngOnInit(): void {
    this.vratiSveKorisnike();
  }

  ngAfterViewInit(): void {
    if (this.dataSource) {
      this.dataSource.paginator = this.paginator;
      this.dataSource.sort = this.sort;
    }
  }

  openCreateKorisnikDialog() {
    const dialogRef = this.dialog.open(CreateKorisnikComponent);
    dialogRef.afterClosed().subscribe({
      next: (val) => {
        if (val) {
          this.vratiSveKorisnike();
        }
      }
    })
  }


  openEditKorisnikDialog(podaci: any) {
    this.dialog.open(EditKorisnikComponent, {
      data: podaci,
    });
  }

  applyFilter(event: Event) {
    const filterValue = (event.target as HTMLInputElement).value;
    this.dataSource.filter = filterValue.trim().toLowerCase();

    if (this.dataSource.paginator) {
      this.dataSource.paginator.firstPage();
    }
  }

  vratiSveKorisnike() {
    this.korisnikService.vratiSveKorisnike().subscribe({
      next: (response) => {
        console.log(response);
        this.dataSource = new MatTableDataSource(response.korisnici);
        this.dataSource.paginator = this.paginator;
        this.dataSource.sort = this.sort;
      },
      error: console.log,
    })
  }

  obrisiKorisnika(korisnikId: number) {
    this.korisnikService.obrisiKorisnika(korisnikId).subscribe({
      next: (response) => {
        console.log(response);
        this.snackBar.open(response.status, 'Zatvori', {
          duration: 3000,
          horizontalPosition: 'center',
          verticalPosition: 'bottom',
        });
        this.vratiSveKorisnike();
      },
      error: console.log,
    })
  }

}
