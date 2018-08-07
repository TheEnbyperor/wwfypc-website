import React, { Component } from 'react';
import "./style/Device.scss";
import Indicators from "./Indicators";
import IPhoneSelection from './iPhone';

import Laptop from './img/Laptop.svg';
import Desktop from './img/Desktop.svg';
import iMac from './img/iMac.svg';
import iWatch from './img/iWatch.svg';
import iPad from './img/iPad.svg';
import iPhone from './img/iPhone.svg';

const iPhoneType = 1;

class Devices extends Component {
    render() {
        return (
          <div className="Devices">
              <img src={iPhone} alt="iPhone" className="iPhone" onClick={() => this.props.onSelect(iPhoneType)}/>
              <img src={iPad} alt="iPod" className="iPad"/>
              <img src={iWatch} alt="iWatch" className="iWatch"/>
              <img src={Laptop} alt="Laptop" className="Laptop"/>
              <img src={Desktop} alt="Desktop" className="Desktop"/>
              <img src={iMac} alt="iMac" className="iMac"/>
          </div>
        );
    }
}

export default class Device extends Component {

    constructor(props) {
        super(props);

        this.state = {
          deviceType: null,
        };

        this.selectType = this.selectType.bind(this);
        this.goBack = this.goBack.bind(this);
    }

    selectType(type) {
        this.setState({
            deviceType: type,
        })
    }

    goBack() {
        if (this.state.deviceType !== null) {
            this.setState({
                deviceType: null,
            })
        }
    }

    render() {
        let step = null;
        let disp = null;

        if (this.state.deviceType === null) {
            step = 1;
            disp = <Devices onSelect={this.selectType}/>;
        } else if (this.state.deviceType === iPhoneType) {
            step = 2;
            disp = <IPhoneSelection/>;
        }

        return (
          <div className={"Device step-" + step}>
              <h1>Select your device</h1>
              <div className="BackButton" onClick={this.goBack}>➜</div>
              <Indicators steps={4} step={step}/>
              {disp}
          </div>
        );
    }
}