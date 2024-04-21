import { Izdavac } from "../models/izdavac.model";
import { ModelFactory } from "./model.factory";

export class IzdavacFactory implements ModelFactory<Izdavac> {
    createDefault(): Izdavac {
        return {
            izdavac_id: 0,
            naziv: '',
            adresa: ''
        }
    }
}