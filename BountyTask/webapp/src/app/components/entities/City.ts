import {Country} from "./Country";
export class City{

    public id:number;
    public name:string;
    public postal:string;
    public country:Country;
    constructor(public _id:number,public _name:string,public _postal:string,public _country:Country){
        this.id=_id;
        this.country=_country;
        this.postal=_postal;
        this.name=name;
    }
}
