import { Component, Inject } from '@angular/core';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material/dialog';
import { MatSnackBar } from '@angular/material/snack-bar';
import { AutorService } from 'src/app/services/autor.service';
import { CreateAutorComponent } from '../create-autor/create-autor.component';

@Component({
  selector: 'app-edit-autor',
  templateUrl: './edit-autor.component.html',
  styleUrls: ['./edit-autor.component.scss']
})
export class EditAutorComponent {
  podaci = {
    autor_id: '',
    ime: '',
    prezime: '',
    datum_rodjenja: '',
    mesto_rodjenja: '',
    biografija: '',
  };

  constructor(
    private autorService: AutorService,
    private snackBar: MatSnackBar,
    private dialogRef: MatDialogRef<CreateAutorComponent>,
    @Inject(MAT_DIALOG_DATA) private data: any) {
    this.podaci.autor_id = data.autor_id;
  }

  ngOnInit(): void {
    this.podaci = {
      autor_id: this.data.autor_id,
      ime: this.data.ime,
      prezime: this.data.prezime,
      datum_rodjenja: this.data.datum_rodjenja,
      mesto_rodjenja: this.data.mesto_rodjenja,
      biografija: this.data.biografija,
    };
  }

  izmeni(podaci: any) {
    this.autorService.izmeniAutora(podaci).subscribe({
      next: (response) => {
        console.log(response);
        this.snackBar.open(response.status, 'Zatvori', {
          duration: 3000,
          horizontalPosition: 'center',
          verticalPosition: 'bottom',
        });
        this.dialogRef.close(true);
      },
      error: console.log,
    })
  }

}
