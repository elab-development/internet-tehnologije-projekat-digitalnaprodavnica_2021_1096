import { Component, Inject } from '@angular/core';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material/dialog';
import { MatSnackBar } from '@angular/material/snack-bar';
import { KnjigaService } from 'src/app/services/knjiga.service';
import { DashboardKnjigeComponent } from '../dashboard-knjige.component';

@Component({
  selector: 'app-add-pdf',
  templateUrl: './add-pdf.component.html',
  styleUrls: ['./add-pdf.component.scss']
})
export class AddPdfComponent {

  izabranFajl!: File;
  knjigaId: number;

  constructor(
    private knjigaService: KnjigaService,
    private snackBar: MatSnackBar,
    private dialogRef: MatDialogRef<DashboardKnjigeComponent>,
    @Inject(MAT_DIALOG_DATA) private data: { knjigaId: number }) {
    this.knjigaId = data.knjigaId;
  }

  onIzabranFajl(event: any) {
    if (event.target.files && event.target.files.length > 0) {
      this.izabranFajl = event.target.files[0];
    }
  }

  dodajPdf() {
    if (this.izabranFajl) {
      this.knjigaService.dodajPdf(this.knjigaId, this.izabranFajl).subscribe({
        next: (response) => {
          console.log(response);
        },
        error: console.error
      })
    }
  }

}
