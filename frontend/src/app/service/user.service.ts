import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { Observable } from 'rxjs/Observable';
import { of } from 'rxjs/observable/of';
import { catchError, map, tap } from 'rxjs/operators';

import { User } from '../domain/model/user';
import { environment } from "../../environments/environment";

const httpOptions = {
    headers: new HttpHeaders({
        'Content-Type': 'application/x-www-form-urlencoded',
        'Accept': 'application/json'
    })
};

@Injectable()
export class UserService {
    private baseUrl = environment.apiUrl;  // URL to web api

    constructor(private http: HttpClient) { }

    /** POST: add a new user to the server */
    create (user: User): Observable<User> {
        const url = this.baseUrl + '/signup';
        const httpParams = this.toHttpParams(user);

        return this.http.post<User>(url, httpParams, httpOptions).pipe(
            tap((user: User) => this.log(`added hero w/ id=${user.id}`)),
            catchError(this.handleError<User>('addHero'))
        );
    }

    /**
     * Handle Http operation that failed.
     * Let the app continue.
     * @param operation - name of the operation that failed
     * @param result - optional value to return as the observable result
     */
    private handleError<T> (operation = 'operation', result?: T) {
        return (error: any): Observable<T> => {

            // TODO: send the error to remote logging infrastructure
            console.error(error); // log to console instead

            // TODO: better job of transforming error for user consumption
            this.log(`${operation} failed: ${error.message}`);

            // Let the app keep running by returning an empty result.
            return of(result as T);
        };
    }

    /** Log a HeroService message with the MessageService */
    private log(message: string) {
        console.log('UserService: ' + message);
        // this.messageService.add('UserService: ' + message);
    }

    private toHttpParams(params) {
        return Object.getOwnPropertyNames(params)
            .reduce((p, key) => p.set(key, params[key]), new HttpParams());
    }
}