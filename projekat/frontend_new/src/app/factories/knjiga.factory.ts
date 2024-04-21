import { Knjiga } from "../models/knjiga.model";
import { ModelFactory } from "./model.factory";

export class KnjigaFactory implements ModelFactory<Knjiga> {
    createDefault(): Knjiga {
        return {
            knjiga_id: 0,
            isbn: '',
            naziv: '',
            kategorija: '',
            opis: '',
            pismo: '',
            godina: 0,
            strana: 0,
            cena: 0,
            autori: [],
            izdavac: { izdavac_id: 0, naziv: '', adresa: '' },
        }
    }
}