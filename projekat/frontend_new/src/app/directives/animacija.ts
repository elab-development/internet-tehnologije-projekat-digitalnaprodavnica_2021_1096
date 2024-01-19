import { animate, state, style, transition, trigger } from "@angular/animations";

const obicnaVelicina = '1';
const uvecanaVelicina = '1';

export const pokreniAnimaciju = trigger('pokreniAnimaciju', [
    state('neaktivna', style({
        transform: `scale(${obicnaVelicina})`,
    })),
    state('aktivna', style({
        transform: `scale(${uvecanaVelicina})`,
    })),
]);