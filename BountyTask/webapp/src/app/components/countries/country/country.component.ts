import {Component, Input, OnInit} from '@angular/core';
import {Country} from "../../entities/Country";
import {AdressService} from "../../../services/adress/adress.service";
import {City} from "../../entities/City";

@Component({
  selector: 'app-country',
  templateUrl: './country.component.html',
  styleUrls: ['./country.component.css'],
})
export class CountryComponent implements OnInit {
  search:string;
  @Input() country:Country;
  constructor(private adressService:AdressService) {
  }


  private getCounty(){
  }
  ngOnInit() {
  }

}
