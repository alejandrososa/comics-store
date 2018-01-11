import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { User } from '../domain/model/user';
import {environment} from "../../environments/environment";
import {Hero} from "../domain/model/hero";

@Injectable()
export class UserService {
    private baseUrl = environment.apiUrl;  // URL to web api

    constructor(private http: HttpClient) { }

    getById(id: number) {
        return this.http.get('/api/users/' + id);
    }

    /** POST: add a new hero to the server */
    signup (user: User): Observable<Hero> {
        return this.http.post<Hero>(this.baseUrl, hero, httpOptions).pipe(
            tap((hero: Hero) => this.log(`added hero w/ id=${hero.id}`)),
            catchError(this.handleError<Hero>('addHero'))
        );
    }

    create(user: User) {
        return this.http.post('/api/users', user);
    }

    update(user: User) {
        return this.http.put('/api/users/' + user.id, user);
    }

    delete(id: number) {
        return this.http.delete('/api/users/' + id);
    }
}