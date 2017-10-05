import {City} from "./City";
export class Country{

    constructor(public id:number,public name:string,public ending: string,public cities:City[]){

    }
}
