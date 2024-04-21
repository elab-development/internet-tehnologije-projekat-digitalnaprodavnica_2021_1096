import { Autor } from "./autor.model";
import { Izdavac } from "./izdavac.model";

export interface Knjiga {
    knjiga_id: number,
    isbn: string,
    naziv: string,
    kategorija: string,
    opis: string,
    pismo: string,
    godina: number,
    strana: number,
    cena: number,
    autori: Autor[],
    izdavac: Izdavac,
}