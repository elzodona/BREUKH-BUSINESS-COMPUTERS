import { TestBed } from '@angular/core/testing';
import { CanActivateFn } from '@angular/router';

import { caFnGuard } from './ca-fn.guard';

describe('caFnGuard', () => {
  const executeGuard: CanActivateFn = (...guardParameters) => 
      TestBed.runInInjectionContext(() => caFnGuard(...guardParameters));

  beforeEach(() => {
    TestBed.configureTestingModule({});
  });

  it('should be created', () => {
    expect(executeGuard).toBeTruthy();
  });
});
