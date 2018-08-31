import React, {Component} from "react";
import Top from "./Top/Top";
import Section from "./Section/Section";

export default class PC extends Component {
    componentDidMount() {
        new window.fullpage(".PC", {
            scrollOverflow: true,
            anchors: ["top", "section-1"],
            navigationTooltips: ["Top", ""],
            navigationPosition: 'right',
            navigation: true,
            licenseKey: "OPEN-SOURCE-GPLV3-LICENSE",
        })
    }

    componentWillUnmount() {
        window.fullpage_api.destroy('all');
    }
    render() {
        return (
            <div className="PC">
                <div className="section"><Top/></div>
                <div className="section"><Section/></div>
                <div className="section"><Section/></div>
            </div>
        );
    }
}