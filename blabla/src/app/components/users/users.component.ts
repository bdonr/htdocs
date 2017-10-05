import { Component, OnInit } from '@angular/core';
import { Adress } from '../../models/models.Adress';

@Component({
  selector: 'app-users',
  templateUrl: './users.component.html',
  styleUrls: ['./users.component.css']
})
export class UsersComponent implements OnInit {
  name:string;
  alter:number;
  adresses:Adress[];
  constructor() { }

  ngOnInit() {
    this.name="1";
    this.alter=1;
    this.adresses=[{streetname:'Geveker-Kamp',streetnumber:75},{streetname:'Ernst-Abbe Straße',streetnumber:26}];
  }

}



