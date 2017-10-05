
import {Task} from "./Task";
export class User{

    constructor(public id:number,public email:string,public pwd:string,public admin:boolean,public tasks:Task[]){}
}