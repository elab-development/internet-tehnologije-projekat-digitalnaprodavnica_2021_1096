import { Korisnik } from "../models/korisnik.model";
import { ModelFactory } from "./model.factory";

export class KorisnikFactory implements ModelFactory<Korisnik> {
    createDefault(): Korisnik {
        return {
            korisnik_id: 0,
            email: '',
            username: '',
            password: '',
            ime: '',
            prezime: ''
        }
    }
}