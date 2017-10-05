import { Component, OnInit } from '@angular/core';
import {Country} from "../entities/Country";
import {AdressService} from "../../services/adress/adress.service";
import {Observable} from "rxjs";

@Component({
  selector: 'app-countries',
  templateUrl: './countries.component.html',
  styleUrls: ['./countries.component.css']
})
export class CountriesComponent implements OnInit {
  search:string;
  country:Country[];
  constructor(private adressService:AdressService) {
    this.getCounty();

  }


  private getCounty(){
    this.getSearch().subscribe(d=>{
      console.log("asdad");
     this.country= this.adressService.findCountryByName(d);
    });

    console.log(this.country);
  }

  getSearch():Observable<string>{
    console.log("eingabe");
    return Observable.of(this.search);
  }
  ngOnInit() {
  }
}
