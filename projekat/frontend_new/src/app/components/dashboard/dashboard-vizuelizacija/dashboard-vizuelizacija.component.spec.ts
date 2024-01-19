import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DashboardVizuelizacijaComponent } from './dashboard-vizuelizacija.component';

describe('DashboardVizuelizacijaComponent', () => {
  let component: DashboardVizuelizacijaComponent;
  let fixture: ComponentFixture<DashboardVizuelizacijaComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [DashboardVizuelizacijaComponent]
    });
    fixture = TestBed.createComponent(DashboardVizuelizacijaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
