import { Component, Inject } from '@angular/core';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material/dialog';
import { MatSnackBar } from '@angular/material/snack-bar';
import { AutorService } from 'src/app/services/autor.service';
import { CreateAutorComponent } from '../create-autor/create-autor.component';
import { Autor } from 'src/app/models/autor.model';

@Component({
  selector: 'app-edit-autor',
  templateUrl: './edit-autor.component.html',
  styleUrls: ['./edit-autor.component.scss']
})
export class EditAutorComponent {
  autor!: Autor;

  constructor(
    private autorService: AutorService,
    private snackBar: MatSnackBar,
    private dialogRef: MatDialogRef<CreateAutorComponent>,
    @Inject(MAT_DIALOG_DATA) private data: { autor: Autor }) {
    this.autor = data.autor;
  }

  ngOnInit(): void {
    this.autor = this.data.autor;
    console.log(this.autor);
  }

  izmeni(autor: Autor) {
    this.autorService.izmeniAutora(autor).subscribe({
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
