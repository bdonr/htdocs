import { Injectable } from '@angular/core';
import {BehaviorSubject, Observable, Subject} from "rxjs";
import {User} from "../../components/entities/User";
import {UserService} from "../user/user.service";

@Injectable()
export class AuthService {
  isLoginObserv=new BehaviorSubject<boolean>(this.hasToken());
  isAdminObserv=new BehaviorSubject<boolean>(this.hasAdminToken());
  user:User;
  constructor(private userService:UserService) { }

  private hasToken() : boolean {
    console.log("token?"+!!localStorage.getItem('currentuser'));
    return !!localStorage.getItem('currentuser');
  }
  private hasAdminToken() : boolean {
    if(this.hasToken()) {
      return JSON.parse(localStorage.getItem('currentuser')).admin;
    }
    return false;
  }

  isLoggedin():Observable<boolean>{
    return this.isLoginObserv.asObservable();
  }


  isAdmin():Observable<boolean>{
    return this.isAdminObserv.asObservable();
  }

  setCurrent(user:User){
    if(this.user==null){
      localStorage.setItem("current",JSON.stringify(user));
    }
  }

  getCurrentUser(): User {
    if (localStorage.getItem("currentuser") != null) {
      return JSON.parse(localStorage.getItem("currentuser"));
    }
    console.log(localStorage.getItem("currentuser"));
    return null;
  }


  logout() {
    localStorage.removeItem("currentuser");
    console.log(localStorage.getItem("currentuser"));
    this.user=null;
    this.isAdminObserv.next(false);
    this.isLoginObserv.next(false);
  }


  login(email: string, pwd: string) {
    let user = this.userService.findUserByEmailandPassword(email,pwd);
    console.log(user);
    if (user !==null) {
      localStorage.setItem("currentuser", JSON.stringify(user));
      console.log("local"+localStorage.getItem("currentuser"));
      this.user= JSON.parse(localStorage.getItem("currentuser"));
      this.isAdminObserv.next(user.admin);
      this.isLoginObserv.next(true);
    }
  }




}
