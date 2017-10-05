import { Pipe, PipeTransform } from '@angular/core';
import {Country} from "./components/entities/Country";

@Pipe({
  name: 'countrysearch'
})
export class CountrysearchPipe implements PipeTransform {


    transform(allCountry: Country[]) {
      return allCountry.filter(country => country.name);

  }

}
