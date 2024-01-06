import { ComponentFixture, TestBed } from '@angular/core/testing';

import { KorisnikComponent } from './korisnik.component';

describe('KorisnikComponent', () => {
  let component: KorisnikComponent;
  let fixture: ComponentFixture<KorisnikComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [KorisnikComponent]
    });
    fixture = TestBed.createComponent(KorisnikComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
