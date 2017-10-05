import {Injectable} from '@angular/core';
import {Adress} from "../../components/entities/Adress";
import {Locale} from "../../components/entities/Locale";
import {Country} from "../../components/entities/Country";
import {City} from "../../components/entities/City";
import {Observable} from "rxjs";

@Injectable()
export class AdressService {

    private static adresses: Adress[]
    private static cities: City[];
    private static countries: Country[];

    constructor() {
        this.setCountrys();
        this.setCities();


        for (let x of AdressService.countries) {
            this.findCityByCountry(x).subscribe(y => {
                x.cities = y;
            })
        }
        console.log(AdressService.countries);
        this.setAdresses();
    }

    private setCountrys() {
        AdressService.countries = [
            new Country(1, "Germany".toLowerCase(), "DE", null),
            new Country(2, "Poland".toLowerCase(), "PL", null),
            new Country(3, "USA".toLowerCase(), "US", null),
            new Country(4, "England".toLowerCase(), "ENG", null),
            new Country(5, "Estland".toLowerCase(), "est", null)]
        ;
    }

    findCountry(id: number): Country {
        return AdressService.countries.find(country => country.id === id);
    }

    findCity(id: number): City {
        return AdressService.cities.find(city => city.id === id);
    }

    findAdress(id: number): Adress {
        return AdressService.adresses.find(city => city.id === id);
    }

    private findCityByCountry(_country: Country): Observable<City[]> {
        return Observable.of(AdressService.cities.filter(city => city.country == _country));
    }

    findCountryByName(name: string) {
        return AdressService.countries.filter(country => country.name.match("^"+name+"*"));
    }

    findCityByCountryName(name: string): Observable<City[]> {
        return Observable.of(AdressService.cities.filter(city => city.country.name===name));
    }


    private setCities() {
        AdressService.cities = [
            new City(1, ("Hildesheim").toLowerCase(), "31141", this.findCountry(1)),
            new City(2, "Hannover".toLowerCase(), "30159", this.findCountry(1)),
            new City(3, "Hannover".toLowerCase(), "30167", this.findCountry(1)),
            new City(4, "Berlin".toLowerCase(), "10115", this.findCountry(1)),
            new City(5, "Berlin".toLowerCase(), "10707", this.findCountry(1)),
            new City(6, "London".toLowerCase(), "N20 0AA", this.findCountry(4)),
            new City(7, "London".toLowerCase(), "N20 0BB", this.findCountry(4)),
            new City(8, "New York".toLowerCase(), "10001", this.findCountry(3)),
            new City(9, "Chicago".toLowerCase(), "60007", this.findCountry(3)),
            new City(10, "Allendale".toLowerCase(), "49401", this.findCountry(3)),
            new City(11, "Warschau".toLowerCase(), "00-001", this.findCountry(2)),
            new City(12, "Posen".toLowerCase(), "01-163", this.findCountry(2))
        ];
    }


    private setAdresses() {
        AdressService.adresses = [
            new Adress(1, "Ernst-Abbe Straße", "26", null, this.findCity(1)),
                new Adress(2, "Autobahn", "3", null, this.findCity(2)),
            new Adress(3, "Buckingham Palace", "1", null, this.findCity(7))
        ];
    }

    public getAdresses(): Observable<Adress[]> {
        return Observable.of(AdressService.adresses);
    }
}
