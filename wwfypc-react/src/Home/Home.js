import React, {Component} from 'react';

import Top from "./Top/Top";
import Device from './Device/Device';
import About from './About/About';
import Location from './Location/Location';
import Footer from './Footer/Footer';


export default class App extends Component {
    componentDidMount() {
        new window.fullpage(".Home", {
            scrollOverflow: true,
            anchors: ["top", "device", "about", "location", "footer"],
            navigation: true,
            licenseKey: "OPEN-SOURCE-GPLV3-LICENSE",
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
                <div className="section"><Location/></div>
                <div className="section fp-auto-height"><Footer/></div>
            </div>
        );
    }
}
