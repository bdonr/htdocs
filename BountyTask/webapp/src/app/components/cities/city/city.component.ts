import {Component, Input, OnInit} from '@angular/core';
import {City} from "../../entities/City";
import {Country} from "../../entities/Country";

@Component({
  selector: 'app-city',
  templateUrl: './city.component.html',
  styleUrls: ['./city.component.css']
})
export class CityComponent implements OnInit {
  @Input() city:City;
  constructor() {
    console.log(this.city);
  }

  ngOnInit() {
  }

}
