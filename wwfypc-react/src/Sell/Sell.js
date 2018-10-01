import React, {Component} from 'react';
import Footer from "../Shared/Footer/Footer";
import "./style/Contact.scss";

export default class Contact extends Component {
    constructor(props) {
        super(props);
    }

    componentDidMount() {
        new window.fullpage(".Sell", {
            anchors: ["sell", "footer"],
            navigationTooltips: ["Sell", "Footer"],
            navigationPosition: 'right',
            navigation: true,
            licenseKey: "OPEN-SOURCE-GPLV3-LICENSE",
        })
    }

    componentWillUnmount() {
        window.fullpage_api.destroy();
    }

    render() {
        return <div className="Sell">
            <div className="section SellInner">
                <div className="inner">
                    <div className="left">

                    </div>
                    <div className="right">

                    </div>
                </div>
            </div>
            <div className="section fp-auto-height"><Footer/></div>
        </div>;
    }
}