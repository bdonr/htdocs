import { Component, OnInit } from '@angular/core';
import {UserService} from "../../services/user/user.service";
import {Router} from "@angular/router";
import {User} from "../entities/User";
import {AuthService} from "../../services/auth/auth.service";

@Component({
  selector: 'app-navigation',
  templateUrl: './navigation.component.html',
  styleUrls: ['./navigation.component.css']
})
export class NavigationComponent implements OnInit {

  isloggedin:boolean;
  isAdmin:boolean;
  user:User;
  constructor(private router:Router,private authService:AuthService) {  this.getAuth(); this.getAdmin();   }

  logout(){
    this.authService.logout();
    console.log("ausloggen gedrückt");
    this.router.navigate(['/']).then();
  }

  getAuth(){
    this.authService.isLoggedin().subscribe(d=>{
      this.isloggedin=d;
      console.log("login?"+d);
      if(this.isloggedin){
        this.user = this.authService.getCurrentUser();
      }
    });
  }

  getAdmin(){

    this.authService.isAdmin().subscribe(d=>{
      console.log("admin?"+d);
      this.isAdmin=d;});
  }
  ngOnInit() {

  }

}
