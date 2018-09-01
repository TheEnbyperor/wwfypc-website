import React, {Component} from 'react';
import Laptop from './img/laptop.png';
import "./style/Section.scss";

export default class Section extends Component {
    render() {
        return (
            <div className="Section">
                <div>
                <img src={Laptop} alt=""/>
                <div>
                    <h1>{this.props.data.title}</h1>
                    <h2>{this.props.data.subtitle}</h2>
                    <p>{this.props.data.text}</p>
                </div>
                </div>
            </div>
        );
    }
}