import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class BrojStavkiService {

  private _brojStavki = new BehaviorSubject<number>(0);

  get brojStavki$() {
    return this._brojStavki.asObservable();
  }

  get brojStavki() {
    return this._brojStavki.value;
  }

  azurirajBrojStavki(noviBroj: number) {
    this._brojStavki.next(noviBroj);
  }
}
