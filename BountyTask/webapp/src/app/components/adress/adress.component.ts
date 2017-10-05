import {Component, Input, OnInit} from '@angular/core';
import {Adress} from "../entities/Adress";

@Component({
  selector: 'app-adress',
  templateUrl: './adress.component.html',
  styleUrls: ['./adress.component.css']
})
export class AdressComponent implements OnInit {


  @Input() adress:Adress;
  constructor() {
    console.log(this.adress);
  }

  ngOnInit() {
  }

}
