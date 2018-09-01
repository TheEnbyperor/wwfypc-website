import React, {Component} from 'react';
import "./style/Reviews.scss";

import Trophy from "./img/Trophy.svg"
import Location from "./img/Location.svg"
import Medal from "./img/Medal.svg"
import Star from './img/Star.svg';

export default class Reviews extends Component {
    render() {
        return (
            <div className="Reviews">
                <div>
                    <div className="bigReview">
                        <div className="stars">
                            <img src={Star} alt=""/>
                            <img src={Star} alt=""/>
                            <img src={Star} alt=""/>
                            <img src={Star} alt=""/>
                            <img src={Star} alt=""/>
                        </div>
                        <p>
                            "I received fantastic service. Everything was explained very well, and I am extremely
                            pleased with the service I received. I would recommend them any day."
                        </p>
                        <p>
                            Lisa Green - March 2018
                        </p>
                    </div>
                    <div className="pointers">
                        <img src={Trophy} alt=""/>
                        <img src={Location} alt=""/>
                        <img src={Medal} alt=""/>
                        <div>
                            <h2>Our goal:<br/>to be the best</h2>
                            <p>
                                I received fantastic service. Everything was explained very well, and I am extremely
                                pleased with the service I received. I would recommend them any day.
                            </p>
                        </div>
                        <div>
                            <h2>Friendly.<br/>Professional. Local</h2>
                            <p>
                                I received fantastic service. Everything was explained very well, and I am extremely
                                pleased with the service I received. I would recommend them any day.
                            </p>
                        </div>
                        <div>
                            <h2>Highly<br/>Recommended</h2>
                            <p>
                                I received fantastic service. Everything was explained very well, and I am extremely
                                pleased with the service I received. I would recommend them any day.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}