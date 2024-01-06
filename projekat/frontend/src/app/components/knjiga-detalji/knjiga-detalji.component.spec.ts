import { ComponentFixture, TestBed } from '@angular/core/testing';

import { KnjigaDetaljiComponent } from './knjiga-detalji.component';

describe('KnjigaDetaljiComponent', () => {
  let component: KnjigaDetaljiComponent;
  let fixture: ComponentFixture<KnjigaDetaljiComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [KnjigaDetaljiComponent]
    });
    fixture = TestBed.createComponent(KnjigaDetaljiComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
