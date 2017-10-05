import { Pipe, PipeTransform } from '@angular/core';
import {City} from "./components/entities/City";

@Pipe({
  name: 'citysearch'
})
export class CitysearchPipe implements PipeTransform {

  transform(allcities: City[]) {
    return allcities.filter(city => city.name);

  }

}
