import { Component, OnInit } from '@angular/core';
import {UserService} from "../../services/user/user.service";
import {User} from "../entities/User";

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
  user:User;
  users:User[];
  email:string;
  password:string;
  constructor(private userservice: UserService) {
    this.userservice.getAllUser().subscribe(users=>{
      this.users=users;
      console.log(this.users);
    });
  }

  addUser(){
    this.user = new User(8,this.email,this.password,false,null);
    this.userservice.addUser(this.user).subscribe(users=>{
        this.users = users;
    });
  }



  ngOnInit() {
  }

}
