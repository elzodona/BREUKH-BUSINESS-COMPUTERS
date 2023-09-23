import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AjoutProduitsComponent } from './ajout-produits.component';

describe('AjoutProduitsComponent', () => {
  let component: AjoutProduitsComponent;
  let fixture: ComponentFixture<AjoutProduitsComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [AjoutProduitsComponent]
    });
    fixture = TestBed.createComponent(AjoutProduitsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
