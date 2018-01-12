import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map'
import { environment } from "../../environments/environment";
import { User } from '../domain/model/user';

const httpOptions = {
    headers: new HttpHeaders({
        'Content-Type': 'application/x-www-form-urlencoded',
        'Accept': 'application/json'
    })
};

@Injectable()
export class AuthenticationService {

    private baseUrl = environment.apiUrl;  // URL to web api

    constructor(private http: HttpClient) { }

    login(email: string, password: string) {
        const url = this.baseUrl + '/signin';
        const httpParams = this.toHttpParams({ email: email, password: password });

        return this.http.post<any>(url, httpParams, httpOptions)
            .map(data => {
                // login successful if there's a jwt token in the response
                if (data.user.hasOwnProperty('id')) {
                    // store user details and jwt token in local storage to keep user logged in between page refreshes
                    localStorage.setItem('currentUser', JSON.stringify(data.user));
                }

                return data.user;
            });
    }

    logout() {
        // remove user from local storage to log user out
        localStorage.removeItem('currentUser');
        // location.reload();
    }



    private toHttpParams(params) {
        return Object.getOwnPropertyNames(params)
            .reduce((p, key) => p.set(key, params[key]), new HttpParams());
    }
}