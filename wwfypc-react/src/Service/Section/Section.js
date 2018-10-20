import React, {Component} from 'react';
import {BASE_URL} from "../../App";
import "./style/Section.scss";

export default class Section extends Component {
    render() {
        return (
            <div className="Section">
                <div>
                <img src={BASE_URL + this.props.data.image} alt=""/>
                <div>
                    <h1>{this.props.data.title}</h1>
                    <h2 dangerouslySetInnerHTML={{__html: this.props.data.subtitle}} />
                    <p dangerouslySetInnerHTML={{__html: this.props.data.text}} />
                </div>
                </div>
            </div>
        );
    }
}