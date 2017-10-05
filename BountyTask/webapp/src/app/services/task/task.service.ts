import { Injectable } from '@angular/core';
import {Task} from "../../components/entities/Task";
import {Locale} from "../../components/entities/Locale";
import {AdressService} from "../adress/adress.service";
import {UserService} from "../user/user.service";
import {User} from "../../components/entities/User";
@Injectable()
export class TaskService {


  private static tasks:Task[];
  constructor(private adressService:AdressService,private userService:UserService) {
      this.getTasks();
      console.log(TaskService.tasks)
  }


  public findByName(name:string){
    return this.getTasks().filter(task=> task.name.match("^"+name));
  }


  public findById(id:number):Task{
     console.log(this.getTasks().find(task=> task.id== id));
      return this.getTasks().find(task=> task.id== id);
  }

  public findByUser(user:User){

  }

  public  getTasks(){
    if(TaskService.tasks==null){

      TaskService.tasks=[new Task(1,"bad littering",this.adressService.findAdress(1),[this.userService.findUserById(1)],this.userService.findUserById(1)),
          new Task(2,"baseball",this.adressService.findAdress(1),[this.userService.findUserById(1)],this.userService.findUserById(1)),
          new Task(3,"garten",this.adressService.findAdress(2),[this.userService.findUserById(2),this.userService.findUserById(1)],this.userService.findUserById(2)),
          new Task(3,"schiff",this.adressService.findAdress(2),[this.userService.findUserById(2)],this.userService.findUserById(2)),
          new Task(4,"queens crown",this.adressService.findAdress(3),[this.userService.findUserById(5)],this.userService.findUserById(5))];
    }
      console.log(TaskService.tasks);
    return TaskService.tasks;
  }




}
