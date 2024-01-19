import { Directive, ElementRef, HostListener, Input, Renderer2 } from "@angular/core";

@Directive({
    selector: '[pokreniAnimaciju]'
})
export class PokreniAnimacijuDirective {
    @Input() pokreniAnimacijuState: string = 'neaktivna';

    constructor(private el: ElementRef, private renderer: Renderer2) { }

    @HostListener('mouseenter') onMouseEnter() {
        this.pokreniAnimaciju('aktivna');
    }

    @HostListener('mouseleave') onMouseLeave() {
        this.pokreniAnimaciju('neaktivna');
    }

    private pokreniAnimaciju(novoStanje: string) {
        this.pokreniAnimacijuState = novoStanje;
        this.renderer.setStyle(this.el.nativeElement, 'transform', this.stilZaStanje(this.pokreniAnimacijuState));
    }

    private stilZaStanje(stanje: string): string {
        return stanje === 'neaktivna' ? 'scale(1)' : 'scale(1.1)';
    }
}