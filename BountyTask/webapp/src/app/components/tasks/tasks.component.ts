import {Component, OnInit} from '@angular/core';
import {Task} from "../entities/Task";
import {TaskService} from "../../services/task/task.service";
import {AdressService} from "../../services/adress/adress.service";
import {Observable, Subject} from "rxjs";
import {from} from "rxjs/observable/from";

@Component({
    selector: 'app-tasks',
    templateUrl: './tasks.component.html',
    styleUrls: ['./tasks.component.css']
})
export class TasksComponent implements OnInit {

    tasks: Task[];
    input = new Subject();
    search:string;
    objArray:TestObject[];
    selectedObject:TestObject;
    constructor(private taskservice: TaskService, private adressService: AdressService) {
        this.setTasks();
        this.objArray = [{name: 'foo', value: 1}, {name: 'bar', value: 1}];
        this.selectedObject = this.objArray[1];
    }

    onChange(e:string) {
        this.input.next(e);
    }


    setTasks() {
        this.input.subscribe(()=>{
            this.tasks = this.taskservice.findByName(this.search);
        });
    }

    ngOnInit() {
    }

}
interface TestObject {
    name:string;
    value:number;
}
