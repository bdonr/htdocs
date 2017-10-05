import {Locale} from "./Locale";
import {City} from "./City";
export class Adress{


    constructor(public id:number,public street:string,public housenumber:string,public locale:Locale,public city:City){

    }
}
