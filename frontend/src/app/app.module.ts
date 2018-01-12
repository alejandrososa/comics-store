import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule }    from '@angular/forms';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';


import { AppComponent } from './app.component';
import { routing } from './app.routing';

import { AlertComponent } from './directives/alert/alert.component';
import { AuthGuard } from './guard/auth.guard';
import { JwtInterceptor } from './helper/jwt.interceptor';
import { AlertService } from './service/alert.service';
import { AuthenticationService } from './service/authentication.service';
import { UserService } from './service/user.service';

import { HomeComponent } from './store/home/home.component';
import { SignupComponent } from './store/signup/signup.component';
import { SigninComponent } from './store/signin/signin.component';
import { HeroesComponent } from './store/heroes/heroes.component';
import { ApiService } from './service/api.service';
import { HeroDetailComponent } from './store/hero-detail/hero-detail.component';
import { HeroSearchComponent } from './store/hero-search/hero-search.component';


@NgModule({
    declarations: [
        AppComponent,
        HomeComponent,
        SignupComponent,
        SigninComponent,
        HeroesComponent,
        HeroDetailComponent,
        HeroSearchComponent,
        AlertComponent,
    ],
    imports: [
        BrowserModule,
        FormsModule,
        HttpClientModule,
        routing,
    ],
    providers: [
        AuthGuard,
        ApiService,
        AlertService,
        AuthenticationService,
        UserService,
        {
            provide: HTTP_INTERCEPTORS,
            useClass: JwtInterceptor,
            multi: true
        }
    ],
    bootstrap: [AppComponent]
})
export class AppModule { }
