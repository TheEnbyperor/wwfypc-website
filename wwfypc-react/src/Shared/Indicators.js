import React, { Component } from 'react';
import "./style/Indicators.scss";

export default class Indicators extends Component {
    render() {
        let indicators = [];
        for (let i =0; i < this.props.steps; i++) {
            if (i+1 === this.props.step) {
                indicators.push(<div key={i * 2} className="selected"/>);
            } else {
                indicators.push(<div key={i * 2}/>);
            }
            indicators.push(<div key={i*2+1}/>);
        }
        indicators.pop();
        return (
          <div className="Indicators">
              {indicators}
          </div>
        );
    }
}