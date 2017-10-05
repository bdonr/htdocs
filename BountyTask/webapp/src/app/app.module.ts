import { BrowserModule } from '@angular/platform-browser';
import {CUSTOM_ELEMENTS_SCHEMA, NgModule, NO_ERRORS_SCHEMA} from '@angular/core';

import { AppComponent } from './app.component';
import { ProfileComponent } from './components/profile/profile.component';
import { LoginComponent } from './components/login/login.component';
import { RegisterComponent } from './components/register/register.component';
import { NavigationComponent } from './components/navigation/navigation.component';
import {UserService} from "./services/user/user.service";
import {RouterModule} from "@angular/router";
import {FormsModule} from "@angular/forms";
import { CommonModule } from '@angular/common';
import { AdminComponent } from './components/admin/admin.component';
import {Http, HttpModule} from "@angular/http";
import { TaskComponent } from './components/task/task.component';
import {TaskService} from "./services/task/task.service";
import { DetailComponent } from './components/profile/detail/detail.component';
import {AdressService} from "./services/adress/adress.service";
import { AdressComponent } from './components/adress/adress.component';
import { CountryComponent } from './components/countries/country/country.component';
import { CityComponent } from './components/cities/city/city.component';
import { CountrysearchPipe } from './countrysearch.pipe';
import { CitysearchPipe } from './citysearch.pipe';
import { CountriesComponent } from './components/countries/countries.component';
import { CitiesComponent } from './components/cities/cities.component';
import {AuthService} from "./services/auth/auth.service";
import { TasksComponent } from './components/tasks/tasks.component';
import { EditprofileComponent } from './components/profile/editprofile/editprofile.component';
import { EdittaskComponent } from './components/task/edittask/edittask.component';

@NgModule({
  declarations: [
    AppComponent,
    ProfileComponent,
    LoginComponent,
    RegisterComponent,
    NavigationComponent,
    AdminComponent,
    TaskComponent,
    DetailComponent,
    AdressComponent,
    CountryComponent,
    CityComponent,
    CountrysearchPipe,
    CitysearchPipe,
    CountriesComponent,
    CitiesComponent,
    TasksComponent,
    EditprofileComponent,
    EdittaskComponent,

  ],
  imports: [
    BrowserModule,


    FormsModule,
    BrowserModule,
    HttpModule,
    CommonModule,
    RouterModule.forRoot([
      {path:'login',component:LoginComponent },
      {path:'register',component:RegisterComponent},
      {path:'profile/:id',component:DetailComponent},
      {path:'profile/edit/:id',component:EditprofileComponent},
      {path:'profile',component:ProfileComponent},
      {path:'admin',component:AdminComponent},
      {path:'task',component:TasksComponent},
      {path:'task/edit/:id',component:EdittaskComponent},
      {path:'task/:id',component:TaskComponent},
    ])
  ],


  providers: [UserService,HttpModule,TaskService,AdressService,AuthService,TaskService],
  bootstrap: [AppComponent],
  schemas: [ CUSTOM_ELEMENTS_SCHEMA ]
})
export class AppModule { }
