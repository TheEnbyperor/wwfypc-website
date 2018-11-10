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
        window.$.scrollify({
            section: ".section",
            sectionName : "anchor",
            interstitialSection: ".fp-auto-height",
        })
    }

    componentWillUnmount() {
        window.$.scrollify.destroy();
    }


    render() {
        return (
            <div className="Home">
                <div className="section" data-anchor="top"><Top/></div>
                <div className="section" data-anchor="device"><Device/></div>
                <div className="section" data-anchor="about"><About/></div>
                <div className="section" data-anchor="reviews"><Reviews/></div>
                <div className="section" data-anchor="why-us"><WhyUs/></div>
                <div className="section" data-anchor="location"><Location/></div>
                <div className="section fp-auto-height" data-anchor="footer"><Footer/></div>
            </div>
        );
    }
}
