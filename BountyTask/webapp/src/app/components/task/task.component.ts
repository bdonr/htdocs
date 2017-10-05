import {Component, Input, OnInit} from '@angular/core';
import {TaskService} from "../../services/task/task.service";
import {AdressService} from "../../services/adress/adress.service";
import {Task} from "../entities/Task";
import {Params, ActivatedRoute} from "@angular/router";
import {isUndefined} from "util";
import {UserService} from "../../services/user/user.service";
import {AuthService} from "../../services/auth/auth.service";

@Component({
    selector: 'app-task',
    templateUrl: './task.component.html',
    styleUrls: ['./task.component.css']
})
export class TaskComponent implements OnInit {

    task: Task;
    id: number;
    isAdmin:boolean;
    isOwn: boolean;
    isloggedin: boolean;

    constructor(private authService: AuthService, private taskManager: TaskService, private userService: UserService, private activatedRoute: ActivatedRoute) {
        this.activatedRoute.params.subscribe((params: Params) => {
            if (!isUndefined(params.id)) {
                this.id = params.id;
                this.task = this.taskManager.findById(this.id);
                console.log(this.task);
                if (this.task.owner.id == authService.getCurrentUser().id) {
                    this.isOwn = true;
                }
                if(authService.getCurrentUser().admin){
                    this.isAdmin=true;
                }
                console.log(this.task);
            }
        });
    }


    ngOnInit() {
    }

}
