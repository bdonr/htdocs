import { Component, OnInit } from '@angular/core';
import {UserService} from "../../services/user/user.service";
import {Router} from "@angular/router";
import {AuthService} from "../../services/auth/auth.service";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  email:string;
  pwd:string;
  constructor(private userservice:UserService,private router:Router,private authService:AuthService) { }


  login(){
    this.authService.login(this.email,this.pwd);
    if(this.authService.getCurrentUser()!=null){
      console.log("re");
      this.router.navigate(['/profile/'+this.authService.getCurrentUser().id]);
    }
  }
  ngOnInit() {
  }

}
