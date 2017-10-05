
import {Locale} from "../entities/Locale";
import {Adress} from "./Adress";
import {User} from "./User";
export class Task{


    constructor(public id:number,public name:string,public adress:Adress,public users:User[],public owner:User){}
}
