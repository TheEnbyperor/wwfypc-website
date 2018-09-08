import React, {Component} from 'react';

import Top from "./Top/Top";
import Device from './Device/Device';
import About from './About/About';
import Reviews from './Reviews/Reviews';
import WhyUs from './WhyUs/WhyUs';
import Location from './Location/Location';
import Footer from '../Shared/Footer/Footer';


export default class Home extends Component {
    componentDidMount() {
        new window.fullpage(".Home", {
            anchors: ["top", "device", "about", "reviews", "why-us", "location", "footer"],
            navigationTooltips: ["Home", "Repair your device", "About Us", "Reviews", "Why choose us",
                "How to find us", "Footer"],
            navigationPosition: 'right',
            navigation: true,
            licenseKey: "OPEN-SOURCE-GPLV3-LICENSE",
            paddingTop: "60px",
            paddingBottom: "70px",
            scrollOverflow: true,
        })
    }

    componentWillUnmount() {
        window.fullpage_api.destroy('all');
    }

    render() {
        return (
            <div className="Home">
                <div className="section"><Top/></div>
                <div className="section"><Device/></div>
                <div className="section"><About/></div>
                <div className="section"><Reviews/></div>
                <div className="section"><WhyUs/></div>
                <div className="section"><Location/></div>
                <div className="section fp-auto-height"><Footer/></div>
            </div>
        );
    }
}
