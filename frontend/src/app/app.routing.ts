import { Routes, RouterModule } from '@angular/router';


import { AuthGuard } from './guard/auth.guard';
import { HomeComponent } from './store/home/home.component';
import { SignupComponent } from './store/signup/signup.component';
import { SigninComponent } from './store/signin/signin.component';
import { HeroesComponent } from './store/heroes/heroes.component';

const routes: Routes = [
    { path: '', pathMatch: 'full', redirectTo: 'home' },
    { path: 'signup', component: SignupComponent },
    { path: 'signin', component: SigninComponent },
    { path: 'home', component: HomeComponent, canActivate: [AuthGuard] },
    { path: 'heroes', component: HeroesComponent, canActivate: [AuthGuard] },

    // otherwise redirect to home
    { path: '**', redirectTo: '' }
];

export const routing = RouterModule.forRoot(routes,{ enableTracing: false });