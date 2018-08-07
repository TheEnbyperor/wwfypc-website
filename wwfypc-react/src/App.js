import React, { Component } from 'react';

import './App.scss';
import Top from "./Top/Top";
import Device from './Device/Device';
import About from './About/About';
import Location from './Location/Location';
import Footer from './Footer/Footer';


class App extends Component {
    componentDidMount() {
        new window.fullpage(".App", {
            scrollOverflow: true,
            anchors: ["top", "device", "about", "location"],
            licenseKey: "OPEN-SOURCE-GPLV3-LICENSE",
        })
    }

  render() {
    return (
      <div className="App">
          <div className="section"><Top/></div>
          <div className="section"><Device/></div>
          <div className="section"><About/></div>
          <div className="section"><Location/></div>
          <div className="section fp-auto-height"><Footer/></div>
      </div>
    );
  }
}

export default App;
