import { Component, OnInit, OnChanges, SimpleChanges, Input } from '@angular/core';
import { User } from './domain/model/user';

@Component({
    selector: 'app-root',
    moduleId: module.id,
    templateUrl: './app.component.html',
    styleUrls: ['./app.component.css'],
})
export class AppComponent implements OnInit, OnChanges {
    title = 'Comics Store';
    currentUser: User;
    @Input() isAuthenticated: boolean;

    constructor() {
        this.checkIfCurrentUserAuthenticated();
    }

    ngOnInit() {
        this.currentUser = JSON.parse(localStorage.getItem('currentUser'));
        this.checkIfCurrentUserAuthenticated();
        console.log(this.isAuthenticated);
    }

    ngOnChanges(changes: SimpleChanges) {
        // only run when property "data" changed
        if (changes['isAuthenticated']) {
            this.isAuthenticated = changes['isAuthenticated'].previousValue;
        }
    }

    private checkIfCurrentUserAuthenticated(){
        this.isAuthenticated = false;
        if (localStorage.getItem('currentUser') !== null){
            this.isAuthenticated = true;
        }
    }
}