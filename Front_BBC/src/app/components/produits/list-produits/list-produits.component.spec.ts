import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ListProduitsComponent } from './list-produits.component';

describe('ListProduitsComponent', () => {
  let component: ListProduitsComponent;
  let fixture: ComponentFixture<ListProduitsComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [ListProduitsComponent]
    });
    fixture = TestBed.createComponent(ListProduitsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
