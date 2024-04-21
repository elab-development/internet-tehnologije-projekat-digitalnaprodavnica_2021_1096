import { Autor } from "../models/autor.model";
import { ModelFactory } from "./model.factory";

export class AutorFactory implements ModelFactory<Autor> {
    createDefault(): Autor {
        return {
            autor_id: 0,
            ime: '',
            prezime: '',
            datum_rodjenja: '',
            mesto_rodjenja: '',
            biografija: ''
        }
    }
}