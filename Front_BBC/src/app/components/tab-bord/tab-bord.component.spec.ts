import { ComponentFixture, TestBed } from '@angular/core/testing';

import { TabBordComponent } from './tab-bord.component';

describe('TabBordComponent', () => {
  let component: TabBordComponent;
  let fixture: ComponentFixture<TabBordComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [TabBordComponent]
    });
    fixture = TestBed.createComponent(TabBordComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
