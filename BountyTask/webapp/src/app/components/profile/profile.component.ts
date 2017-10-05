import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Params, RouterState, RouterStateSnapshot} from "@angular/router";
import {UserService} from "../../services/user/user.service";
import {isUndefined} from "util";
import {User} from "../entities/User";

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent implements OnInit {

  id:number;
  user:User;
  src:any;

  constructor(private activatedRoute:ActivatedRoute, private userService:UserService) {

  }
  ngOnInit() {
  }

}
