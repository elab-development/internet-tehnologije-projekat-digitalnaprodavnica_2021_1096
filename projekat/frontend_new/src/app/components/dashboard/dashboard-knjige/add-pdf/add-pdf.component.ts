import { Component, Inject, OnInit } from '@angular/core';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material/dialog';
import { MatSnackBar } from '@angular/material/snack-bar';
import { KnjigaService } from 'src/app/services/knjiga.service';
import { DashboardKnjigeComponent } from '../dashboard-knjige.component';

@Component({
  selector: 'app-add-pdf',
  templateUrl: './add-pdf.component.html',
  styleUrls: ['./add-pdf.component.scss']
})
export class AddPdfComponent implements OnInit {

  knjiga_id: number = -1;
  pdf_fajl: File | null = null;

  constructor(
    private knjigaService: KnjigaService,
    private snackBar: MatSnackBar,
    private dialogRef: MatDialogRef<DashboardKnjigeComponent>,
    @Inject(MAT_DIALOG_DATA) private data: any) {
    this.knjiga_id = data.knjiga_id;
  }

  ngOnInit(): void {
    this.knjiga_id = this.data.knjiga_id;
  }

  dodajPdf() {
    this.knjigaService.dodajPdf(this.knjiga_id, this.pdf_fajl)
  }

}
