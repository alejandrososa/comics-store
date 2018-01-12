import { Component, OnInit } from '@angular/core';

import { User } from '../../domain/model/user';
import { UserService } from '../../service/user.service';

@Component({
  selector: 'app-root',
  moduleId: module.id,
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {

    currentUser: User;
    users: User[] = [];

    constructor(private userService: UserService) {
        this.currentUser = JSON.parse(localStorage.getItem('currentUser'));
    }

    ngOnInit() {
        // this.loadAllUsers();
    }

    deleteUser(id: number) {
        this.userService.delete(id).subscribe(() => { this.loadAllUsers() });
    }

    private loadAllUsers() {
        // this.userService.getAll().subscribe(users => { this.users = users; });
    }

    text = 'esto funciona';
}
