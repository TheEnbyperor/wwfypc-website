import React, {Component} from 'react';
import "./style/About.scss";

import Trophy from "./img/Trophy.svg"
import Location from "./img/Location.svg"
import Medal from "./img/Medal.svg"
import Star from './img/Star.svg';

export default class About extends Component {
    render() {
        return (
            <div className="About">
                <header>
                    <h1>Since the dawn of time we've been numbero uno</h1>
                    <hr/>
                    <p>
                        What separates We Will Fix Your PC from other computer repairers?
                        No one in Cardiff will work harder for you. No one in Cardiff enjoys our
                        outstanding referrals, customer loyalty and personal testimonials.
                    </p>
                </header>
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
                        <h2>Our goal: to be the best</h2>
                        <p>
                            I received fantastic service. Everything was explained very well, and I am extremely
                            pleased with the service I received. I would recommend them any day.
                        </p>
                    </div>
                    <div>
                        <h2>Friendly. Professional. Local</h2>
                        <p>
                            I received fantastic service. Everything was explained very well, and I am extremely
                            pleased with the service I received. I would recommend them any day.
                        </p>
                    </div>
                    <div>
                        <h2>Highly Recommended</h2>
                        <p>
                            I received fantastic service. Everything was explained very well, and I am extremely
                            pleased with the service I received. I would recommend them any day.
                        </p>
                    </div>
                </div>
                <div className="whyUs">
                    <h1>Why choose us?</h1>
                    <p>
                        We enjoy an excellent reputation built on fifteen years of delivering outstanding service
                        and value for money. When you ask us to repair you'r computer, you can expect to receive
                        personal
                        and courteous advice and assistance from experts who care. We'll explain what's wrong with
                        your device in plain, jargon-free english, and tell you exactly how much it will cost to fix
                        - we guarantee it'll be the lowest price you find anywhere.
                    </p>
                    <p>
                        We're a local company based in an easily accessible location in Cardiff, but if you're unable to
                        get to us don't worry. We offer a free pickup and return delivery service, and if you're stuck
                        without a computer we'll even loan you a free courtesy laptop while we carry out your repair.
                        We also operate a no fix, no fee guarantee, so you can be confident that in the unlikely event
                        that we're unable to fix your device it won't cost you a penny.
                    </p>
                </div>
            </div>
        );
    }
}