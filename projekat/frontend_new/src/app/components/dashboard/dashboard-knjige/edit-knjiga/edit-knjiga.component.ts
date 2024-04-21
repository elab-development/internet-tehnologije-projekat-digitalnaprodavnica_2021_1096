import { Component, Inject, OnInit } from '@angular/core';
import { MatSnackBar } from '@angular/material/snack-bar';
import { KnjigaService } from 'src/app/services/knjiga.service';
import { DashboardKnjigeComponent } from '../dashboard-knjige.component';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material/dialog';
import { Knjiga } from 'src/app/models/knjiga.model';

@Component({
  selector: 'app-edit-knjiga',
  templateUrl: './edit-knjiga.component.html',
  styleUrls: ['./edit-knjiga.component.scss']
})
export class EditKnjigaComponent implements OnInit {
  knjiga!: Knjiga;

  constructor(
    private knjigaService: KnjigaService,
    private snackBar: MatSnackBar,
    private dialogRef: MatDialogRef<DashboardKnjigeComponent>,
    @Inject(MAT_DIALOG_DATA) private data: { knjiga: Knjiga }) {
    this.knjiga = data.knjiga;
  }

  ngOnInit(): void {
    this.knjiga = this.data.knjiga;
  }

  izmeni(knjiga: Knjiga) {
    this.knjigaService.izmeniKnjigu(knjiga).subscribe({
      next: (response) => {
        console.log(response);
        this.snackBar.open(response.status, 'Zatvori', {
          duration: 3000,
          horizontalPosition: 'center',
          verticalPosition: 'bottom',
        });
        this.dialogRef.close(true);
      }
    })
  }

}
