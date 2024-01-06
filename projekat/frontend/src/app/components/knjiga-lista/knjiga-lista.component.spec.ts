import { ComponentFixture, TestBed } from '@angular/core/testing';

import { KnjigaListaComponent } from './knjiga-lista.component';

describe('KnjigaListaComponent', () => {
  let component: KnjigaListaComponent;
  let fixture: ComponentFixture<KnjigaListaComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [KnjigaListaComponent]
    });
    fixture = TestBed.createComponent(KnjigaListaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
