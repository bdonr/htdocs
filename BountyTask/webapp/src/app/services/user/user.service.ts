import {Injectable} from '@angular/core';
import {User} from "../../components/entities/User";
import {BehaviorSubject, Observable, Observer, Subject} from "rxjs";
import {debounceTime} from "rxjs/operator/debounceTime";
import {Http} from "@angular/http";
import 'rxjs/add/operator/map'
import {AuthService} from "../auth/auth.service";


@Injectable()
export class UserService {
    users: User[];

    constructor() {
        console.log("erstekkt");
    }

    getAllUser(): Observable<User[]> {
        return Observable.of(this.getUsers());
    }

    findUserById(id: number): User {
        return this.getUsers().find(profile => profile.id == id);
    }

    findUserByEmail(email: string): User {
        return this.getUsers().find(profile => profile.email ==email);
    }



    findUserByEmailandPassword(email: string, password:string): User {
        let user = this.findUserByEmail(email);
        if(user.pwd === password){
            return user;
        }
        return null;

    }

    getUsers(): User[] {
        if (this.users == null) {
            this.users = [
                new User(1,"don@web.de", "1234", true,null),
                new User(2,"don1@web.de", "1234", false,null),
                new User(3,"don2@web.de", "1234", false,null),
                new User(4,"don3@web.de", "1234", true,null),
                new User(5,"don4@web.de", "1234", false,null),
                new User(6,"don5@web.de", "1234", false,null),
                new User(7,"don6@web.de", "1234", false,null)
            ];
        }
        return this.users;
    }

    addUser(user: User): Observable<User[]> {
        this.getUsers().push(user);
        return Observable.of(this.getUsers());
    }

    /**
     getUsers2() {
        return this.http.get('https://jsonplaceholder.typicode.com/users').map(res => res.json());
    }

     setUser(user:User) {
         return this.http.post('https://jsonplaceholder.typicode.com/users',user);
    }
     **/

}
